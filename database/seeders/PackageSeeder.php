<?php

namespace Database\Seeders;

use App\Models\Interfaces\StatusInterface;
use App\Models\Package;
use App\Models\TripType;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create([
            'experience_id' => 5,
            'name' => 'Top Package',
            'price' => 2200,
            'start_package_activity' => '2020-03-12',
            'end_package_activity' => '2020-03-19',
            'status' => 1,
            'description' => fake()->text,
        ]);

        Package::create([
            'experience_id' => 6,
            'name' => 'Middle Package',
            'price' => 2400,
            'start_package_activity' => '2020-04-15',
            'end_package_activity' => '2020-04-20',
            'status' => 1,
            'description' => fake()->text,
        ]);

        Package::create([
            'experience_id' => 10,
            'name' => 'Low Package',
            'price' => 2900,
            'start_package_activity' => '2022-07-2',
            'end_package_activity' => '2022-07-15',
            'status' => 1,
            'description' => fake()->text,
        ]);


    }

}
