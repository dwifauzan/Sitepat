#!/bin/bash

echo "👥 Recreating Users for Sitepat Login System"

# Problem: Users table was empty after OrbStack migration
# Solution: Recreate admin and operator users properly

echo "1. 🗑️ Clearing existing users (if any)..."
docker-compose exec db mysql -u sitepat_user -pdb_password -e "USE sitepat_db; DELETE FROM users;"

echo "\n2. ➕ Creating admin user..."
docker-compose exec app php artisan tinker --execute="
\$admin = \App\Models\User::create([
    'name' => 'admin',
    'email' => 'admin@sitepat.com',
    'password' => bcrypt('admin22'),
    'role_id' => 1
]);
echo 'Admin user created: ID=' . \$admin->id . ', Name=' . \$admin->name;
"

echo "\n3. ➕ Creating operator user..."
docker-compose exec app php artisan tinker --execute="
\$operator = \App\Models\User::create([
    'name' => 'operator',
    'email' => 'operator@sitepat.com', 
    'password' => bcrypt('admin22'),
    'role_id' => 2
]);
echo 'Operator user created: ID=' . \$operator->id . ', Name=' . \$operator->name;
"

echo "\n4. 📋 Verifying users in database..."
docker-compose exec db mysql -u sitepat_user -pdb_password -e "USE sitepat_db; SELECT id, name, email, role_id FROM users;"

echo "\n5. 🧪 Testing authentication..."
docker-compose exec app php artisan tinker --execute="
// Test admin login
\$adminTest = \Illuminate\Support\Facades\Auth::attempt(['name' => 'admin', 'password' => 'admin22']);
echo 'Admin login test: ' . (\$adminTest ? 'SUCCESS' : 'FAILED') . PHP_EOL;
if (\$adminTest) {
    \Illuminate\Support\Facades\Auth::logout();
}

// Test operator login
\$operatorTest = \Illuminate\Support\Facades\Auth::attempt(['name' => 'operator', 'password' => 'admin22']);
echo 'Operator login test: ' . (\$operatorTest ? 'SUCCESS' : 'FAILED') . PHP_EOL;
if (\$operatorTest) {
    \Illuminate\Support\Facades\Auth::logout();
}
"

echo "\n6. 🔧 Final cleanup..."
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear

echo "\n✅ USER CREATION COMPLETE!"
echo "🌐 Website: http://localhost:8080"
echo "🔑 Login credentials:"
echo "   Username: admin | Password: admin22"
echo "   Username: operator | Password: admin22"
echo "\n📝 Note: Use the USERNAME (not email) to login!"
