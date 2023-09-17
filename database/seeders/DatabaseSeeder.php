<?php

namespace Database\Seeders;

use App\Models\ProductAddOns;
use App\Models\Products;
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

        //PRODUCTS
        Products::create([
            'product_name' => 'Manicure',
            'service_id' => 1,
            'price' => 90
        ]);

        Products::create([
            'product_name' => 'Pedicure',
            'service_id' => 1,
            'price' => 100
        ]);

        Products::create([
            'product_name' => 'Gel polish (Orly brand)',
            'service_id' => 1,
            'price' => 280
        ]);

        Products::create([
            'product_name' => 'Gel polish (China brand)',
            'service_id' => 1,
            'price' => 180
        ]);

        Products::create([
            'product_name' => 'Gel polish (Coucou brand)',
            'service_id' => 1,
            'price' => 220
        ]);

        Products::create([
            'product_name' => 'Gel polish removal',
            'service_id' => 1,
            'price' => 50
        ]);

        Products::create([
            'product_name' => 'Foot Spa Ordinary',
            'service_id' => 1,
            'price' => 160
        ]);

        Products::create([
            'product_name' => 'Gel Foot Spa',
            'service_id' => 1,
            'price' => 220
        ]);

        Products::create([
            'product_name' => 'Hand Spa',
            'service_id' => 1,
            'price' => 120
        ]);

        Products::create([
            'product_name' => 'Foot Massage (30mins)',
            'service_id' => 1,
            'price' => 150
        ]);

        Products::create([
            'product_name' => 'Parrafin Wax (Hand)',
            'service_id' => 1,
            'price' => 150
        ]);

        Products::create([
            'product_name' => 'Parrafin Wax (Foot)',
            'service_id' => 1,
            'price' => 200
        ]);

        Products::create([
            'product_name' => 'Softgel w/ china gel polish',
            'service_id' => 2,
            'price' => 750,
        ]);

        Products::create([
            'product_name' => 'Polygel w/ china gel polish',
            'service_id' => 2,
            'price' => 900
        ]);

        Products::create([
            'product_name' => 'Nail Extension removal',
            'service_id' => 2,
            'price' => 150
        ]);

        Products::create([
            'product_name' => 'Nail Art',
            'service_id' => 2,
            'price' => 150
        ]);

        Products::create([
            'product_name' => 'Rhinestone',
            'service_id' => 2,
            'price' => 50
        ]);

        Products::create([
            'product_name' => 'Eyebrow waxing',
            'service_id' => 3,
            'price' => 100
        ]);

        Products::create([
            'product_name' => 'Upper lip waxing',
            'service_id' => 3,
            'price' => 50
        ]);

        Products::create([
            'product_name' => 'Under Arm waxing',
            'service_id' => 3,
            'price' => 150
        ]);

        Products::create([
            'product_name' => 'Half Leg waxing',
            'service_id' => 3,
            'price' => 250
        ]);

        Products::create([
            'product_name' => 'Full Leg waxing',
            'service_id' => 3,
            'price' => 400
        ]);

        Products::create([
            'product_name' => 'Brazillian waxing',
            'service_id' => 3,
            'price' => 500
        ]);

        Products::create([
            'product_name' => 'Eyelash lift',
            'service_id' => 4,
            'price' => 200
        ]);

        Products::create([
            'product_name' => 'with Tint',
            'service_id' => 4,
            'price' => 250
        ]);

        Products::create([
            'product_name' => 'Natural Look',
            'service_id' => 5,
            'price' => 250
        ]);

        Products::create([
            'product_name' => 'Mascara / Volume look',
            'service_id' => 5,
            'price' => 400
        ]);

        //PRODUCT ADDONS
        ProductAddOns::create([
            'product_id' => 13,
            'additional' => 'Additional 150 if Orly Brand',
            'additional_price' => 150,
        ]);

        ProductAddOns::create([
            'product_id' => 14,
            'additional' => 'Additional 150 if Orly Brand',
            'additional_price' => 150,
        ]);

        ProductAddOns::create([
            'product_id' => 27,
            'additional' => 'Hybrid',
            'additional_price' => 500,
        ]);

        ProductAddOns::create([
            'product_id' => 27,
            'additional' => 'Cat Eye',
            'additional_price' => 500,
        ]);

        ProductAddOns::create([
            'product_id' => 27,
            'additional' => 'Whispy',
            'additional_price' => 500,
        ]);
    }
}
