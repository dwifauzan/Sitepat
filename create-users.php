<?php

// Create admin and operator users for Sitepat

require_once 'vendor/autoload.php';

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

// Create roles first
try {
    $adminRole = Role::firstOrCreate(['name' => 'admin']);
    $operatorRole = Role::firstOrCreate(['name' => 'operator']);
    
    echo "Roles created/found:\n";
    echo "Admin Role ID: " . $adminRole->id . "\n";
    echo "Operator Role ID: " . $operatorRole->id . "\n";
    
    // Create admin user
    $adminUser = User::updateOrCreate(
        ['name' => 'admin'],
        [
            'name' => 'admin',
            'email' => 'admin@sitepat.com',
            'password' => Hash::make('admin22'),
            'role_id' => $adminRole->id
        ]
    );
    
    // Create operator user
    $operatorUser = User::updateOrCreate(
        ['name' => 'operator'],
        [
            'name' => 'operator',
            'email' => 'operator@sitepat.com',
            'password' => Hash::make('admin22'),
            'role_id' => $operatorRole->id
        ]
    );
    
    echo "\nUsers created/updated:\n";
    echo "Admin: " . $adminUser->name . " (Email: " . $adminUser->email . ")\n";
    echo "Operator: " . $operatorUser->name . " (Email: " . $operatorUser->email . ")\n";
    
    echo "\nLogin credentials:\n";
    echo "Username: admin, Password: admin22\n";
    echo "Username: operator, Password: admin22\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
