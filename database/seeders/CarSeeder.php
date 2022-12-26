<?php

namespace Database\Seeders;

use App\Models\car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::create(['name' => 'BMW']);
        Car::create(['name' => 'Maruti']);
        Car::create(['name' => 'Honda']);

    }
}
