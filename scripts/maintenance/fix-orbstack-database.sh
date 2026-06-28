#!/bin/bash

echo "🔧 Fixing Database Issues After OrbStack Migration"

# The issue: OrbStack created fresh containers, so the database is empty
# Solution: Run migrations and recreate users

echo "🗄️ Step 1: Running database migrations..."
docker-compose exec app php artisan migrate --force

echo "👥 Step 2: Creating user roles..."
docker-compose exec app php artisan tinker --execute="
\App\Models\Role::firstOrCreate(['name' => 'admin']);
\App\Models\Role::firstOrCreate(['name' => 'operator']);
echo 'Roles created successfully';
"

echo "🔑 Step 3: Creating admin and operator users..."
docker-compose exec app php artisan tinker --execute="
\$adminRole = \App\Models\Role::where('name', 'admin')->first();
\$operatorRole = \App\Models\Role::where('name', 'operator')->first();

\$admin = \App\Models\User::updateOrCreate(
    ['name' => 'admin'],
    [
        'name' => 'admin',
        'email' => 'admin@sitepat.com',
        'password' => bcrypt('admin22'),
        'role_id' => \$adminRole->id
    ]
);

\$operator = \App\Models\User::updateOrCreate(
    ['name' => 'operator'],
    [
        'name' => 'operator', 
        'email' => 'operator@sitepat.com',
        'password' => bcrypt('admin22'),
        'role_id' => \$operatorRole->id
    ]
);

echo 'Admin user: ' . \$admin->name . ' (' . \$admin->email . ')';
echo 'Operator user: ' . \$operator->name . ' (' . \$operator->email . ')';
"

echo "📋 Step 4: Verifying database setup..."
docker-compose exec db mysql -u sitepat_user -pdb_password -e "USE sitepat_db; SELECT 'Database connected successfully';"
docker-compose exec db mysql -u sitepat_user -pdb_password -e "USE sitepat_db; SELECT COUNT(*) as user_count FROM users;"

echo "🧪 Step 5: Testing website..."
sleep 3
if curl -f -s http://localhost:8080 >/dev/null; then
    echo "✅ SUCCESS! Website is working"
    echo "🌐 URL: http://localhost:8080"
    echo "🔑 Login credentials:"
    echo "   Username: admin"
    echo "   Password: admin22"
    echo "   OR"
    echo "   Username: operator" 
    echo "   Password: admin22"
else
    echo "❌ Website still not working. Checking logs..."
    docker-compose logs --tail=10 app
fi

echo "\n✅ Database migration complete!"
echo "🚀 OrbStack is now running your Sitepat app with a fresh database!"
