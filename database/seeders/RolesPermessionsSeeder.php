<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $customerRole = Role::create(['name' => 'customer']);
        $doctorRole = Role::create(['name' => 'doctor']);

        Permission::create(['name' => 'view-dashboard']);
        Permission::create(['name' => 'manage-patients']);
        Permission::create(['name' => 'manage-appointments']);
        Permission::create(['name' => 'manage-customers']);
        Permission::create(['name' => 'customer']);

        $adminRole->givePermissionTo(Permission::all());
        $doctorRole->givePermissionTo(['manage-patients', 'manage-appointments', 'manage-customers']);
        $customerRole->givePermissionTo('customer');

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'mobile' => "123",
            'gender' => 'male',
            'password' => bcrypt('admin'),
        ]);
        $admin->assignRole('admin');


        $customer = User::create([
            'name' => 'customer',
            'email' => 'customer@example.com',
            'mobile' => "456",
            'gender' => 'male',
            'password' => bcrypt('customer'),
        ]);
        $customer->assignRole('customer');

        $doctor = User::create([
            'name' => 'doctor',
            'email' => 'doctor@example.com',
            'mobile' => "789",
            'gender' => 'female',
            'password' => bcrypt('doctor'),
        ]);
        $doctor->assignRole('doctor');
    }
}
