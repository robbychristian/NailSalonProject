<?php

namespace Database\Seeders;

use App\Models\Branches;
use App\Models\NailColors;
use App\Models\Packages;
use App\Models\ProductAddOns;
use App\Models\Products;
use App\Models\Services;
use App\Models\Staff;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\WorkImages;
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
        $service1 = Services::create(['service_name' => 'General Service']);
        $service2 = Services::create(['service_name' => 'Nail Extension']);
        $service3 = Services::create(['service_name' => 'Waxing']);
        $service4 = Services::create(['service_name' => 'Eyelash']);
        $service5 = Services::create(['service_name' => 'Eyelash Extensions']);

        //PRODUCTS
        $product1 = Products::create([
            'product_name' => 'Manicure',
            'service_id' => 1,
            'price' => 90
        ]);

        $product2 = Products::create([
            'product_name' => 'Pedicure',
            'service_id' => 1,
            'price' => 100
        ]);

        $product3 = Products::create([
            'product_name' => 'Gel polish (Orly brand)',
            'service_id' => 1,
            'price' => 280
        ]);

        $product4 = Products::create([
            'product_name' => 'Gel polish (China brand)',
            'service_id' => 1,
            'price' => 180
        ]);

        $product5 = Products::create([
            'product_name' => 'Gel polish (Coucou brand)',
            'service_id' => 1,
            'price' => 220
        ]);

        $product6 = Products::create([
            'product_name' => 'Gel polish removal',
            'service_id' => 1,
            'price' => 50
        ]);

        $product7 = Products::create([
            'product_name' => 'Foot Spa Ordinary',
            'service_id' => 1,
            'price' => 160
        ]);

        $product8 = Products::create([
            'product_name' => 'Gel Foot Spa',
            'service_id' => 1,
            'price' => 220
        ]);

        $product9 = Products::create([
            'product_name' => 'Hand Spa',
            'service_id' => 1,
            'price' => 120
        ]);

        $product10 = Products::create([
            'product_name' => 'Foot Massage (30mins)',
            'service_id' => 1,
            'price' => 150
        ]);

        $product11 = Products::create([
            'product_name' => 'Parrafin Wax (Hand)',
            'service_id' => 1,
            'price' => 150
        ]);

        $product12 = Products::create([
            'product_name' => 'Parrafin Wax (Foot)',
            'service_id' => 1,
            'price' => 200
        ]);

        $product13 = Products::create([
            'product_name' => 'Softgel w/ china gel polish',
            'service_id' => 2,
            'price' => 750,
        ]);

        $product14 = Products::create([
            'product_name' => 'Polygel w/ china gel polish',
            'service_id' => 2,
            'price' => 900
        ]);

        $product15 = Products::create([
            'product_name' => 'Nail Extension removal',
            'service_id' => 2,
            'price' => 150
        ]);

        $product16 = Products::create([
            'product_name' => 'Nail Art',
            'service_id' => 2,
            'price' => 150
        ]);

        $product17 = Products::create([
            'product_name' => 'Rhinestone',
            'service_id' => 2,
            'price' => 50
        ]);

        $product18 = Products::create([
            'product_name' => 'Eyebrow waxing',
            'service_id' => 3,
            'price' => 100
        ]);

        $product19 = Products::create([
            'product_name' => 'Upper lip waxing',
            'service_id' => 3,
            'price' => 50
        ]);

        $product20 = Products::create([
            'product_name' => 'Under Arm waxing',
            'service_id' => 3,
            'price' => 150
        ]);

        $product21 = Products::create([
            'product_name' => 'Half Leg waxing',
            'service_id' => 3,
            'price' => 250
        ]);

        $product22 = Products::create([
            'product_name' => 'Full Leg waxing',
            'service_id' => 3,
            'price' => 400
        ]);

        $product23 = Products::create([
            'product_name' => 'Brazillian waxing',
            'service_id' => 3,
            'price' => 500
        ]);

        $product24 = Products::create([
            'product_name' => 'Eyelash lift',
            'service_id' => 4,
            'price' => 200
        ]);

        $product25 = Products::create([
            'product_name' => 'with Tint',
            'service_id' => 4,
            'price' => 250
        ]);

        $product26 = Products::create([
            'product_name' => 'Natural Look',
            'service_id' => 5,
            'price' => 250
        ]);

        $product27 = Products::create([
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

        // PACKAGES
        $package1 = Packages::create([
            'package_name' => 'Package A',
            'price' => '330'
        ]);
        $package1->products()->attach([$product1->id, $product2->id, $product7->id]);

        $package2 = Packages::create([
            'package_name' => 'Package B',
            'price' => '330'
        ]);
        $package2->products()->attach([$product1->id, $product2->id, $product10->id]);

        $package3 = Packages::create([
            'package_name' => 'Package C',
            'price' => '530'
        ]);
        $package3->products()->attach([$product1->id, $product2->id, $product12->id, $product7->id]);

        $package4 = Packages::create([
            'package_name' => 'Package D',
            'price' => '500'
        ]);
        $package4->products()->attach([$product1->id, $product2->id, $product4->id, $product7->id]);

        $package5 = Packages::create([
            'package_name' => 'Package E',
            'price' => '700'
        ]);
        $package5->products()->attach([$product1->id, $product2->id, $product3->id, $product7->id]);

        $package6 = Packages::create([
            'package_name' => 'Package F',
            'price' => '420'
        ]);
        $package6->products()->attach([$product1->id, $product2->id, $product4->id, $product7->id]);

        $package7 = Packages::create([
            'package_name' => 'Package G',
            'price' => '520'
        ]);
        $package7->products()->attach([$product1->id, $product2->id, $product3->id, $product7->id]);

        $package8 = Packages::create([
            'package_name' => 'Package H',
            'price' => '610'
        ]);
        $package8->products()->attach([$product1->id, $product2->id, $product3->id, $product24->id]);

        $package9 = Packages::create([
            'package_name' => 'Package I',
            'price' => '800'
        ]);
        $package9->products()->attach([$product1->id, $product2->id, $product3->id, $product24->id]);

        $package9 = Packages::create([
            'package_name' => 'Package J',
            'price' => '600'
        ]);
        $package9->products()->attach([$product1->id, $product2->id, $product4->id, $product24->id]);

        $package10 = Packages::create([
            'package_name' => 'Package K',
            'price' => '1000'
        ]);
        $package10->products()->attach([$product13->id, $product2->id, $product7->id]);

        $package10 = Packages::create([
            'package_name' => 'Package L',
            'price' => '1050'
        ]);
        $package10->products()->attach([$product13->id, $product2->id, $product4->id, $product7->id]);

        //BRANCHES
        Branches::create(['branch_address' => 'Sampaloc Manila']);
        Branches::create(['branch_address' => 'Quezon City']);

        //STAFF
        //STAFF 1
        $staff1 = Staff::create([
            'staff_name' => 'Marvie Japilla',
            'staff_image' => 'sample-profile.jpg'
        ]);
        $staff1->services()->attach([$service1->id, $service2->id]);
        $image1 = WorkImages::create([
            'filename' => 'sample-img.jpg'
        ]);
        $staff1->workImages()->attach([$image1->id]);

        //STAFF 2
        $staff2 = Staff::create([
            'staff_name' => 'Princess Glori',
            'staff_image' => 'sample-profile.jpg'
        ]);
        $staff2->services()->attach([$service4->id, $service5->id]);
        $image2 = WorkImages::create([
            'filename' => 'sample-img.jpg'
        ]);
        $staff2->workImages()->attach([$image2->id]);

        //STAFF 3
        $staff3 = Staff::create([
            'staff_name' => 'Marie Laureta',
            'staff_image' => 'sample-profile.jpg'
        ]);
        $staff3->services()->attach([$service1->id, $service2->id, $service3->id]);
        $image3 = WorkImages::create([
            'filename' => 'sample-img.jpg'
        ]);
        $staff3->workImages()->attach([$image3->id]);

        //STAFF 4
        $staff4 = Staff::create([
            'staff_name' => 'Heverly Dela Cruz',
            'staff_image' => 'sample-profile.jpg'
        ]);
        $staff4->services()->attach([$service1->id, $service2->id, $service3->id]);
        $image4 = WorkImages::create([
            'filename' => 'sample-img.jpg'
        ]);
        $staff4->workImages()->attach([$image4->id]);

        //STAFF 5
        $staff5 = Staff::create([
            'staff_name' => 'Marivic Daroy',
            'staff_image' => 'sample-profile.jpg'
        ]);
        $staff5->services()->attach([$service1->id, $service2->id, $service3->id]);
        $image5 = WorkImages::create([
            'filename' => 'sample-img.jpg'
        ]);
        $staff5->workImages()->attach([$image5->id]);

        // NAIL COLORS
        // CHINA BRAND
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#b4768a',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#e1a791',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#e9bdcc',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#a8a0d3',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#e5b839',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#e7c669',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#b1d688',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#93c7dc',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#d8c7b5',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#a7867f',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#5a5f97',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#636557',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#96a77b',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#55605c',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#776c74',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#9b8c8c',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#94a3ba',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#bdc2bb',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#bdb994',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#995c59',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#736565',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#6a737a',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#bd813b',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#bf7d5b',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#845d4e',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#bc9e86',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#8c5153',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#b44a45',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#bc4450',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#d23a39',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#a34a5e',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#b33f4a',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#715157',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#77709c',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#6b6e77',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#696876',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#706992',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#73737d',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#74788d',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#6e707d',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#b3b1bf',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#5e7690',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#62a0bf',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#85aac4',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#b5d0f0',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#86a9bf',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#f7783a',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#836c7e',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#f0a48a',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#aa8c96',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#7b6d6d',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#f68984',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#f6d6c9',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#eaaea6',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#c1747c',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#524d53',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#c3404b',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#f1f5f8',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#71666f',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#dfdee3',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#d5d8e1',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#c6b3af',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#d9a6ab',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (China brand)',
            'color' => '#bdbfcc',
        ]);

        // END OF CHINA

        // ORLY
        NailColors::create([
            'brand' => 'Gel polish (Orly brand)',
            'color' => '#9d1521',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Orly brand)',
            'color' => '#c46159',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Orly brand)',
            'color' => '#a50f18',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Orly brand)',
            'color' => '#2e1f24',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Orly brand)',
            'color' => '#ba4152',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Orly brand)',
            'color' => '#292526',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Orly brand)',
            'color' => '#64717a',
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Orly brand)',
            'color' => '#39232f',
        ]);
        // END OF ORLY
    }
}
