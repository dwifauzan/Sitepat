#!/bin/bash

echo "🔍 Debugging Login Issues"

# Check if sessions are working
echo "📂 Checking session configuration..."
docker-compose exec app php artisan tinker --execute="
echo 'Session driver: ' . config('session.driver') . PHP_EOL;
echo 'Session lifetime: ' . config('session.lifetime') . PHP_EOL;
echo 'Session path: ' . config('session.files') . PHP_EOL;
"

# Check storage permissions
echo "🔐 Checking storage permissions..."
docker-compose exec app ls -la storage/framework/sessions/

# Clear all caches
echo "🧹 Clearing all caches..."
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan session:table 2>/dev/null || echo "No session table needed (using files)"

# Fix permissions again
echo "🔧 Fixing permissions..."
docker-compose exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose exec app chmod -R 775 storage bootstrap/cache

# Test a manual authentication
echo "🧪 Testing manual authentication..."
docker-compose exec app php artisan tinker --execute="
\$user = \App\Models\User::where('name', 'admin')->first();
if (\$user) {
    \Illuminate\Support\Facades\Auth::login(\$user);
    echo 'Manual login successful for: ' . \Illuminate\Support\Facades\Auth::user()->name . PHP_EOL;
    \Illuminate\Support\Facades\Auth::logout();
    echo 'Logout successful' . PHP_EOL;
} else {
    echo 'User not found for manual test' . PHP_EOL;
}"

echo "\n✅ Try logging in again with:"
echo "   Username: admin"
echo "   Password: admin22"
echo "\n🌐 Go to: http://localhost:8080"
