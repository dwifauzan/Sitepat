#!/bin/bash

echo "🔍 Deep Login Debug - Finding the Real Issue"

# Step 1: Get a fresh CSRF token
echo "1. 🔑 Getting fresh CSRF token..."
CSRF_TOKEN=$(curl -s http://localhost:8080 | grep -o 'name="_token" value="[^"]*"' | cut -d'"' -f4)
echo "CSRF Token: $CSRF_TOKEN"

# Step 2: Test with proper CSRF token
echo "\n2. 🧪 Testing login with proper CSRF token..."
RESPONSE=$(curl -s -X POST http://localhost:8080/login/exceute \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "name=admin&password=admin22&_token=$CSRF_TOKEN" \
  -w "HTTP_CODE:%{http_code}" \
  -L)

HTTP_CODE=$(echo "$RESPONSE" | grep -o 'HTTP_CODE:[0-9]*' | cut -d':' -f2)
echo "HTTP Response Code: $HTTP_CODE"

if echo "$RESPONSE" | grep -q "login failed"; then
    echo "❌ Login failed message detected"
elif echo "$RESPONSE" | grep -q "dashboard\|home\|welcome"; then
    echo "✅ Login successful - redirected to dashboard"
else
    echo "❓ Unexpected response"
fi

# Step 3: Check what Laravel sees
echo "\n3. 🔍 Testing Laravel Auth directly..."
docker-compose exec app php artisan tinker --execute="
echo 'Direct Laravel test:' . PHP_EOL;
\$user = \App\Models\User::where('name', 'admin')->first();
if (\$user) {
    echo 'User found: ' . \$user->name . ' (ID: ' . \$user->id . ')' . PHP_EOL;
    \$credentials = ['name' => 'admin', 'password' => 'admin22'];
    \$result = \Illuminate\Support\Facades\Auth::attempt(\$credentials);
    echo 'Auth attempt: ' . (\$result ? 'SUCCESS' : 'FAILED') . PHP_EOL;
    if (\$result) {
        echo 'Authenticated as: ' . \Illuminate\Support\Facades\Auth::user()->name . PHP_EOL;
        \Illuminate\Support\Facades\Auth::logout();
    }
} else {
    echo 'User not found!' . PHP_EOL;
}
"

# Step 4: Check session configuration
echo "\n4. 📂 Checking session setup..."
docker-compose exec app php artisan tinker --execute="
echo 'Session driver: ' . config('session.driver') . PHP_EOL;
echo 'Session files path: ' . config('session.files') . PHP_EOL;
echo 'Session lifetime: ' . config('session.lifetime') . PHP_EOL;
"

# Step 5: Check file permissions
echo "\n5. 🔐 Checking storage permissions..."
docker-compose exec app ls -la storage/framework/sessions/ | head -5

echo "\n📝 Summary:"
echo "If Laravel Auth works but browser login fails:"
echo "   - CSRF token issue (need fresh token from form)"
echo "   - Session storage problem"
echo "   - JavaScript/browser issue"
echo "\nTry logging in through browser now with:"
echo "   Username: admin"
echo "   Password: admin22"
echo "   URL: http://localhost:8080"
