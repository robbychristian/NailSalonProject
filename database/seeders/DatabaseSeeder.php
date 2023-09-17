<?php

namespace Database\Seeders;

use App\Models\Services;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'first_name' => 'Admin',
            'last_name' => NULL,
            'email' => 'admin@graceynails.com',
            'email_verified_at' => now(),
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'user_role' => 1,
            'is_notify' => 0
        ]);

        UserProfile::create([
            'user_id' => 1,
            'middle_name' => NULL,
            'birthday' => NULL,
            'contact_no' => NULL,
            'address' => NULL,
        ]);

        User::create([
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'email' => 'juandelacruz@graceynails.com',
            'email_verified_at' => now(),
            'username' => 'juandelacruz',
            'password' => Hash::make('password'),
            'user_role' => 2,
            'is_notify' => 0
        ]);

        UserProfile::create([
            'user_id' => 2,
            'middle_name' => 'Garcia',
            'birthday' => '1999-01-01',
            'contact_no' => '09123456789',
            'address' => 'Quezon City'
        ]);

        // SERVICES
        Services::create(['service_name' => 'General Service']);
        Services::create(['service_name' => 'Nail Extension']);
        Services::create(['service_name' => 'Waxing']);
        Services::create(['service_name' => 'Eyelash']);
        Services::create(['service_name' => 'Eyelash Extensions']);
    }
}
