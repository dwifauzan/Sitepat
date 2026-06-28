#!/bin/bash

echo "🔐 Testing Sitepat Login System"

# Test database connection
echo "📊 Testing database connection..."
docker-compose exec db mysql -u sitepat_user -pdb_password -e "USE sitepat_db; SELECT 'Database connected successfully';" 2>/dev/null

# Check users table
echo "👥 Checking users in database..."
docker-compose exec db mysql -u sitepat_user -pdb_password -e "USE sitepat_db; SELECT u.id, u.name, u.email, r.name as role FROM users u LEFT JOIN roles r ON u.role_id = r.id;" 2>/dev/null

# Test authentication with Laravel
echo "🔍 Testing Laravel authentication..."
docker-compose exec app php artisan tinker --execute="
\$user = \App\Models\User::where('name', 'admin')->first();
if (\$user) {
    echo 'User found: ' . \$user->name . ' (ID: ' . \$user->id . ')' . PHP_EOL;
    echo 'Email: ' . \$user->email . PHP_EOL;
    echo 'Has password: ' . (!empty(\$user->password) ? 'YES' : 'NO') . PHP_EOL;
    
    // Test password verification
    \$passwordCheck = \Illuminate\Support\Facades\Hash::check('admin22', \$user->password);
    echo 'Password check: ' . (\$passwordCheck ? 'VALID' : 'INVALID') . PHP_EOL;
} else {
    echo 'Admin user not found!' . PHP_EOL;
}"

echo "\n✅ Login credentials:"
echo "   Username: admin"
echo "   Password: admin22"
echo "   OR"
echo "   Username: operator"
echo "   Password: admin22"

echo "\n🌐 Website: http://localhost:8080"
