#!/bin/bash

echo "🔍 Diagnosing and Fixing Login Issues"

# Check if users exist
echo "1. 👥 Checking users in database..."
docker-compose exec db mysql -u sitepat_user -pdb_password -e "USE sitepat_db; SELECT id, name, email, role_id FROM users;"

# Test password verification
echo "\n2. 🔑 Testing password verification..."
docker-compose exec app php artisan tinker --execute="
\$user = \App\Models\User::where('name', 'admin')->first();
if (\$user) {
    echo 'Admin user found: ' . \$user->name . PHP_EOL;
    \$passwordCheck = \Illuminate\Support\Facades\Hash::check('admin22', \$user->password);
    echo 'Password check result: ' . (\$passwordCheck ? 'VALID' : 'INVALID') . PHP_EOL;
} else {
    echo 'Admin user NOT found!' . PHP_EOL;
}
"

# Test Laravel Auth attempt
echo "\n3. 🔍 Testing Laravel Auth::attempt..."
docker-compose exec app php artisan tinker --execute="
\$credentials = ['name' => 'admin', 'password' => 'admin22'];
echo 'Testing credentials: ' . json_encode(\$credentials) . PHP_EOL;
\$result = \Illuminate\Support\Facades\Auth::attempt(\$credentials);
echo 'Auth::attempt result: ' . (\$result ? 'SUCCESS - Login should work' : 'FAILED - There is an issue') . PHP_EOL;
if (\$result) {
    echo 'Authenticated user: ' . \Illuminate\Support\Facades\Auth::user()->name . PHP_EOL;
    \Illuminate\Support\Facades\Auth::logout();
}
"

# Check session configuration
echo "\n4. 📂 Checking session configuration..."
docker-compose exec app php artisan tinker --execute="
echo 'Session driver: ' . config('session.driver') . PHP_EOL;
echo 'Session path: ' . config('session.files') . PHP_EOL;
echo 'Session domain: ' . config('session.domain') . PHP_EOL;
"

# Fix permissions and clear caches
echo "\n5. 🔧 Fixing permissions and clearing caches..."
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan view:clear
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app chmod -R 775 storage bootstrap/cache

# Test website response
echo "\n6. 🌐 Testing website..."
RESPONSE=$(curl -s -o /dev/null -w "%{http_code}" http://localhost:8080)
if [ "$RESPONSE" = "200" ]; then
    echo "✅ Website responds with HTTP 200"
else
    echo "❌ Website responds with HTTP $RESPONSE"
fi

echo "\n📝 Summary:"
echo "If authentication is working in Laravel but not in browser:"
echo "   1. Try clearing browser cache and cookies"
echo "   2. Check browser developer tools for JavaScript errors"
echo "   3. Ensure you're using 'admin' as username (not email)"
echo "   4. Make sure password is exactly 'admin22'"
echo "   5. Try different browser or incognito mode"

echo "\n🌐 Login URL: http://localhost:8080"
echo "🔑 Username: admin"
echo "🔑 Password: admin22"
