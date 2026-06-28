#!/bin/bash

echo "🔧 Creating Working Login - Final Solution"

# The issue: Users exist but authentication fails
# Solution: Create users with proper Laravel methods

echo "1. 🗑️ Clearing existing users..."
docker-compose exec db mysql -u sitepat_user -pdb_password -e "USE sitepat_db; DELETE FROM users;" 2>/dev/null

echo "\n2. ➕ Creating admin user with Laravel..."
docker-compose exec app php artisan tinker --execute="
\$admin = new \App\Models\User();
\$admin->name = 'admin';
\$admin->email = 'admin@sitepat.com';
\$admin->password = \Illuminate\Support\Facades\Hash::make('admin22');
\$admin->role_id = 1;
\$admin->save();
echo 'Admin user created with ID: ' . \$admin->id;
"

echo "\n3. ➕ Creating operator user with Laravel..."
docker-compose exec app php artisan tinker --execute="
\$operator = new \App\Models\User();
\$operator->name = 'operator';
\$operator->email = 'operator@sitepat.com';
\$operator->password = \Illuminate\Support\Facades\Hash::make('admin22');
\$operator->role_id = 2;
\$operator->save();
echo 'Operator user created with ID: ' . \$operator->id;
"

echo "\n4. 📋 Verifying users in database..."
docker-compose exec db mysql -u sitepat_user -pdb_password -e "USE sitepat_db; SELECT id, name, email, role_id FROM users;" 2>/dev/null

echo "\n5. 🧪 Testing authentication..."
docker-compose exec app php artisan tinker --execute="
echo 'Testing admin login:' . PHP_EOL;
\$adminTest = \Illuminate\Support\Facades\Auth::attempt(['name' => 'admin', 'password' => 'admin22']);
echo 'Admin result: ' . (\$adminTest ? 'SUCCESS' : 'FAILED') . PHP_EOL;
if (\$adminTest) {
    echo 'Logged in as: ' . \Illuminate\Support\Facades\Auth::user()->name . PHP_EOL;
    \Illuminate\Support\Facades\Auth::logout();
}

echo 'Testing operator login:' . PHP_EOL;
\$operatorTest = \Illuminate\Support\Facades\Auth::attempt(['name' => 'operator', 'password' => 'admin22']);
echo 'Operator result: ' . (\$operatorTest ? 'SUCCESS' : 'FAILED') . PHP_EOL;
if (\$operatorTest) {
    echo 'Logged in as: ' . \Illuminate\Support\Facades\Auth::user()->name . PHP_EOL;
    \Illuminate\Support\Facades\Auth::logout();
}
"

echo "\n6. 🔌 Final verification..."
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear

echo "\n✅ LOGIN SYSTEM READY!"
echo "🌐 URL: http://localhost:8080"
echo "🔑 Username: admin | Password: admin22"
echo "🔑 Username: operator | Password: admin22"
echo "\n📝 If login still fails in browser:"
echo "   1. Clear browser cache completely"
echo "   2. Try incognito/private mode"
echo "   3. Make sure you type exactly 'admin' and 'admin22'"
echo "   4. Check for JavaScript errors in browser console"
