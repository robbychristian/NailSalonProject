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
            'contact_no' => '+639123456789',
            'address' => 'Quezon City'
        ]);

        User::create([
            'first_name' => 'Tyler',
            'last_name' => 'Creator',
            'email' => 'tylerc08@gmail.com',
            'email_verified_at' => now(),
            'username' => 'TylerC',
            'password' => Hash::make('password'),
            'user_role' => 2,
            'is_notify' => 0
        ]);

        UserProfile::create([
            'user_id' => 3,
            'middle_name' => 'Santos',
            'birthday' => '1999-09-22',
            'contact_no' => '+639951540553',
            'address' => 'Pasig'
        ]);

        User::create([
            'first_name' => 'Marq',
            'last_name' => 'Dela Cruz',
            'email' => 'marq_anku@hotmail.com',
            'email_verified_at' => now(),
            'username' => 'marqanku123',
            'password' => Hash::make('Password2!'),
            'user_role' => 2,
            'is_notify' => 0,
            'is_loyal' => NULL
        ]);

        UserProfile::create([
            'user_id' => 4,
            'middle_name' => 'Isean',
            'birthday' => '1997-03-11',
            'contact_no' => '+639123456780',
            'address' => 'Quezon, City'
        ]);

        User::create([
            'first_name' => 'Tren',
            'last_name' => 'Est',
            'email' => 'tren_est123@gmail.com',
            'email_verified_at' => now(),
            'username' => 'TrenEst21',
            'password' => Hash::make('Password3!'),
            'user_role' => 2,
            'is_notify' => 1,
            'is_loyal' => 1
        ]);

        UserProfile::create([
            'user_id' => 5,
            'middle_name' => 'Tonfe',
            'birthday' => '1996-02-09',
            'contact_no' => '+639123456799',
            'address' => 'Sampaloc, Manila'
        ]);

        User::create([
            'first_name' => 'Shirley',
            'last_name' => 'Dela Cruz',
            'email' => 'shir.ley832@gmail.com',
            'email_verified_at' => now(),
            'username' => 'MsShirley',
            'password' => Hash::make('Password4!'),
            'user_role' => 2,
            'is_notify' => 1,
            'is_loyal' => NULL
        ]);

        UserProfile::create([
            'user_id' => 6,
            'middle_name' => 'Lim',
            'birthday' => '2000-04-21',
            'contact_no' => '+639123456705',
            'address' => '123-H Leyte Street, Sampaloc, Manila'
        ]);

        User::create([
            'first_name' => 'Lay',
            'last_name' => 'Loma',
            'email' => 'lay_loma321@hotmail.com',
            'email_verified_at' => now(),
            'username' => 'LayTest24',
            'password' => Hash::make('Password5!'),
            'user_role' => 2,
            'is_notify' => 0,
            'is_loyal' => 1
        ]);

        UserProfile::create([
            'user_id' => 7,
            'middle_name' => 'Rima',
            'birthday' => '1996-01-09',
            'contact_no' => '+639123456123',
            'address' => '126 Panay Avenue, Quezon City'
        ]);

        User::create([
            'first_name' => 'Casper',
            'last_name' => 'Miguel',
            'email' => 'casper_mig262@gmail.com',
            'email_verified_at' => now(),
            'username' => 'CasperTries6',
            'password' => Hash::make('Password6!'),
            'user_role' => 2,
            'is_notify' => 1,
            'is_loyal' => NULL
        ]);

        UserProfile::create([
            'user_id' => 8,
            'middle_name' => 'Gumban',
            'birthday' => '1999-02-01',
            'contact_no' => '+639123421789',
            'address' => '201-F Craig Street, Sampaloc, Manila'
        ]);

        User::create([
            'first_name' => 'Naomi',
            'last_name' => 'Suarez',
            'email' => 'naomi.suarez423@yahoo.com',
            'email_verified_at' => now(),
            'username' => 'Naomi24',
            'password' => Hash::make('Password7!'),
            'user_role' => 2,
            'is_notify' => 1,
            'is_loyal' => NULL
        ]);

        UserProfile::create([
            'user_id' => 9,
            'middle_name' => 'No',
            'birthday' => '1993-07-12',
            'contact_no' => '+639129556789',
            'address' => 'Quezon, City'
        ]);

        User::create([
            'first_name' => 'Joy',
            'last_name' => 'De Vera',
            'email' => 'jouyouz.dv42@gmail.com',
            'email_verified_at' => now(),
            'username' => 'YojDV42',
            'password' => Hash::make('Password8!'),
            'user_role' => 2,
            'is_notify' => 0,
            'is_loyal' => NULL
        ]);

        UserProfile::create([
            'user_id' => 10,
            'middle_name' => 'Garcia',
            'birthday' => '1997-06-21',
            'contact_no' => '+639123416489',
            'address' => 'Cavite, City'
        ]);

        User::create([
            'first_name' => 'Mae',
            'last_name' => 'Sinto',
            'email' => 'mae.sinto291@yahoo.com',
            'email_verified_at' => now(),
            'username' => 'SintoMae23',
            'password' => Hash::make('Password9!'),
            'user_role' => 2,
            'is_notify' => 1,
            'is_loyal' => 1
        ]);

        UserProfile::create([
            'user_id' => 11,
            'middle_name' => 'Marquez',
            'birthday' => '1994-01-01',
            'contact_no' => '+639423455789',
            'address' => 'Quezon City'
        ]);

        User::create([
            'first_name' => 'Sandra',
            'last_name' => 'Co',
            'email' => 's.co.mei42@hotmail.com',
            'email_verified_at' => now(),
            'username' => 'Sandrey42',
            'password' => Hash::make('Password10!'),
            'user_role' => 2,
            'is_notify' => 1,
            'is_loyal' => 1
        ]);

        UserProfile::create([
            'user_id' => 12,
            'middle_name' => 'Mei',
            'birthday' => '1999-01-01',
            'contact_no' => '+639123456789',
            'address' => 'Quezon, City'
        ]);

        User::create([
            'first_name' => 'Lorenz',
            'last_name' => 'Men',
            'email' => 'nikkinny9@gmail.com',
            'email_verified_at' => now(),
            'username' => 'Sample123',
            'password' => Hash::make('Password11!'),
            'user_role' => 2,
            'is_notify' => 1,
            'is_loyal' => NULL
        ]);

        UserProfile::create([
            'user_id' => 13,
            'middle_name' => 'Try',
            'birthday' => '2002-04-24',
            'contact_no' => '+639954626736',
            'address' => '123-C Leyte Street, Sampaloc, Manila'
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
        $user1 = User::create([
            'first_name' => 'Marie',
            'last_name' => 'Laureta',
            'email' => 'staff_user1@gmail.com',
            'email_verified_at' => now(),
            'username' => 'staff_user1',
            'password' => Hash::make('password'),
            'user_role' => 3, // staff role
        ]);
        $userProfile = UserProfile::create([
            'user_id' => $user1->id,
            'middle_name' => NULL,
        ]);
        $staff1 = Staff::create([
            'user_id' => $user1->id,
            'staff_name' => 'Marie Laureta',
            'staff_image' => 'sample-profile.jpg'
        ]);
        $staff1->services()->attach([$service1->id, $service2->id, $service3->id]);
        $image1 = WorkImages::create([
            'filename' => 'sample-img.PNG'
        ]);
        $image11 = WorkImages::create([
            'filename' => 'sample-img2.PNG'
        ]);
        $staff1->workImages()->attach([$image1->id, $image11->id]);

        //STAFF 2
        $user2 = User::create([
            'first_name' => 'Marivic',
            'last_name' => 'Daroy',
            'email' => 'staff_user2@gmail.com',
            'email_verified_at' => now(),
            'username' => 'staff_user2',
            'password' => Hash::make('password'),
            'user_role' => 3, // staff role
        ]);
        $userProfile = UserProfile::create([
            'user_id' => $user2->id,
            'middle_name' => NULL,
        ]);
        $staff2 = Staff::create([
            'user_id' => $user2->id,
            'staff_name' => 'Marivic Daroy',
            'staff_image' => 'sample-profile.jpg'
        ]);
        $staff2->services()->attach([$service1->id, $service2->id, $service3->id, $service4->id, $service5->id]);
        $image2 = WorkImages::create([
            'filename' => 'sample-img.PNG'
        ]);
        $image22 = WorkImages::create([
            'filename' => 'sample-img2.PNG'
        ]);
        $staff2->workImages()->attach([$image2->id, $image22->id]);

        //STAFF 3
        $user3 = User::create([
            'first_name' => 'Princess',
            'last_name' => 'Glori',
            'email' => 'staff_user3@gmail.com',
            'email_verified_at' => now(),
            'username' => 'staff_user3',
            'password' => Hash::make('password'),
            'user_role' => 3, // staff role
        ]);
        $userProfile = UserProfile::create([
            'user_id' => $user3->id,
            'middle_name' => NULL,
        ]);
        $staff3 = Staff::create([
            'user_id' => $user3->id,
            'staff_name' => 'Princess Glori',
            'staff_image' => 'sample-profile.jpg'
        ]);
        $staff3->services()->attach([$service1->id, $service2->id, $service3->id]);
        $image3 = WorkImages::create([
            'filename' => 'sample-img.PNG'
        ]);
        $staff3->workImages()->attach([$image3->id]);

        //STAFF 4
        $user4 = User::create([
            'first_name' => 'Pearl',
            'last_name' => 'Segarra',
            'email' => 'staff_user4@gmail.com',
            'email_verified_at' => now(),
            'username' => 'staff_user4',
            'password' => Hash::make('password'),
            'user_role' => 3, // staff role
        ]);
        $userProfile = UserProfile::create([
            'user_id' => $user4->id,
            'middle_name' => NULL,
        ]);
        $staff4 = Staff::create([
            'user_id' => $user4->id,
            'staff_name' => 'Pearl Segarra',
            'staff_image' => 'sample-profile.jpg'
        ]);
        $staff4->services()->attach([$service1->id, $service2->id, $service3->id, $service4->id, $service5->id]);
        $image4 = WorkImages::create([
            'filename' => 'sample-img.PNG'
        ]);
        $staff4->workImages()->attach([$image4->id]);

        //STAFF 5
        $user5 = User::create([
            'first_name' => 'Charlyn',
            'last_name' => 'Segarra',
            'email' => 'staff_user5@gmail.com',
            'email_verified_at' => now(),
            'username' => 'staff_user5',
            'password' => Hash::make('password'),
            'user_role' => 3, // staff role
        ]);
        $userProfile = UserProfile::create([
            'user_id' => $user5->id,
            'middle_name' => NULL,
        ]);
        $staff5 = Staff::create([
            'user_id' => $user5->id,
            'staff_name' => 'Charlyn Segarra',
            'staff_image' => 'sample-profile.jpg'
        ]);
        $staff5->services()->attach([$service1->id, $service2->id, $service4->id, $service5->id]);
        $image5 = WorkImages::create([
            'filename' => 'sample-img.PNG'
        ]);
        $staff5->workImages()->attach([$image5->id]);

        //STAFF 6
        $user6 = User::create([
            'first_name' => 'Jazrell',
            'last_name' => 'Fabianess',
            'email' => 'staff_user6@gmail.com',
            'email_verified_at' => now(),
            'username' => 'staff_user6',
            'password' => Hash::make('password'),
            'user_role' => 3, // staff role
        ]);
        $userProfile = UserProfile::create([
            'user_id' => $user6->id,
            'middle_name' => NULL,
        ]);
        $staff6 = Staff::create([
            'user_id' => $user6->id,
            'staff_name' => 'Jazrell Fabianess',
            'staff_image' => 'sample-profile.jpg'
        ]);
        $staff6->services()->attach([$service1->id, $service2->id, $service4->id, $service5->id]);
        $image6 = WorkImages::create([
            'filename' => 'sample-img.PNG'
        ]);
        $staff6->workImages()->attach([$image6->id]);

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

        // COUCOU

        NailColors::create([
            'brand' => 'Gel polish (Coucou brand)',
            'color' => '#2f80b5'
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Coucou brand)',
            'color' => '#b491b9'
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Coucou brand)',
            'color' => '#ac6871'
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Coucou brand)',
            'color' => '#a38c85'
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Coucou brand)',
            'color' => '#bc9c8f'
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Coucou brand)',
            'color' => '#b2a094'
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Coucou brand)',
            'color' => '#51756d'
        ]);
        NailColors::create([
            'brand' => 'Gel polish (Coucou brand)',
            'color' => '#084041'
        ]);
    }
}
