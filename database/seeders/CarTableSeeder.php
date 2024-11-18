<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cars')->insert([
            [
                'rate' => 4.6,
                'capacity' => 760,
                'available' => 1,
                'transport_id' => 1,
                'name' => 'Mazda Mazda3 Red',
                'model' => 'Mazda3',
                'fuel_type' => 'Gasoline',
                'gear_type' => 'Manual',
                'color' => 'Red',
                'max_power' => 233,
                'max_speed' => 233,
                'fuel' => 52,
                'image_path' => '/storage/cars/Mazda Mazda3 Red.jpg',
            ],
            [
                'rate' => 4.9,
                'capacity' => 560,
                'available' => 1,
                'transport_id' => 1,
                'name' => 'MGMG6 Red',
                'model' => 'MG6',
                'fuel_type' => 'Gasoline',
                'gear_type' => 'Automatic',
                'color' => 'Red',
                'max_power' => 153,
                'max_speed' => 194,
                'fuel' => 48,
                'image_path' => '/storage/cars/MGMG6 Red.jpg',
            ],
            [
                'rate' => 3.8,
                'capacity' => 710,
                'available' => 1,
                'transport_id' => 1,
                'name' => 'CitroenC-Elysee Sedan Blue',
                'model' => 'C-Elysee',
                'fuel_type' => 'Gasoline',
                'gear_type' => 'Manual',
                'color' => 'Blue',
                'max_power' => 89,
                'max_speed' => 181,
                'fuel' => 49,
                'image_path' => '/storage/cars/CitroenC-Elysee Sedan Blue.jpg',
            ],
            [
                'rate' => 4.0,
                'capacity' => 640,
                'available' => 1,
                'transport_id' => 1,
                'name' => 'OpelInsigniaSedan White',
                'model' => 'Insignia Sedan',
                'fuel_type' => 'Diesel',
                'gear_type' => 'Manual',
                'color' => 'White',
                'max_power' => 196,
                'max_speed' => 224,
                'fuel' => 58,
                'image_path' => '/storage/cars/OpelInsigniaSedan White.jpg',
            ],
            [
                'rate' => 3.5,
                'capacity' => 580,
                'available' => 1,
                'transport_id' => 1,
                'name' => 'Kia Optima White',
                'model' => 'Optima',
                'fuel_type' => 'Gasoline',
                'gear_type' => 'Automatic',
                'color' => 'White',
                'max_power' => 223,
                'max_speed' => 148,
                'fuel' => 62,
                'image_path' => '/storage/cars/Kia Optima White.jpg',
            ],
            [
                'rate' => 4.1,
                'capacity' => 860,
                'available' => 1,
                'transport_id' => 1,
                'name' => 'SuzukiCiaz Silver',
                'model' => 'Ciaz',
                'fuel_type' => 'Gasoline',
                'gear_type' => 'Manual',
                'color' => 'Silver',
                'max_power' => 95,
                'max_speed' => 181,
                'fuel' => 44,
                'image_path' => '/storage/cars/SuzukiCiaz Silver.jpg',
            ],
            [
                'rate' => 4.7,
                'capacity' => 750,
                'available' => 1,
                'transport_id' => 1,
                'name' => 'CadillacATS Sports Silver',
                'model' => 'ATS',
                'fuel_type' => 'Gasoline',
                'gear_type' => 'Automatic',
                'color' => 'Silver',
                'max_power' => 377,
                'max_speed' => 186,
                'fuel' => 59,
                'image_path' => '/storage/cars/CadillacATS Sports Silver.jpeg',
            ],
            [
                'rate' => 2.5,
                'capacity' => 690,
                'available' => 1,
                'transport_id' => 1,
                'name' => 'CitroenDS4 Coupe White',
                'model' => 'DS4',
                'fuel_type' => 'Gasoline',
                'gear_type' => 'Automatic',
                'color' => 'White',
                'max_power' => 160,
                'max_speed' => 235,
                'fuel' => 65,
                'image_path' => '/storage/cars/CitroenDS4 Coupe White.jpg',
            ],
            [
                'rate' => 4.8,
                'capacity' => 700,
                'available' => 1,
                'transport_id' => 1,
                'name' => 'SkodaScala Sedan Silver',
                'model' => 'Skoda',
                'fuel_type' => 'Gasoline',
                'gear_type' => 'Manual',
                'color' => 'Silver',
                'max_power' => 95,
                'max_speed' => 209,
                'fuel' => 46,
                'image_path' => '/storage/cars/SkodaScala Sedan Silver.jpg',
            ],
            [
                'rate' => 3.0,
                'capacity' => 850,
                'available' => 1,
                'transport_id' => 1,
                'name' => 'RenaultMegane Hatchback Blue',
                'model' => 'Renault',
                'fuel_type' => 'Gasoline',
                'gear_type' => 'Automatic',
                'color' => 'Blue',
                'max_power' => 127,
                'max_speed' => 208,
                'fuel' => 60,
                'image_path' => '/storage/cars/RenaultMegane Hatchback Blue.jpg',
            ],
        ]);
    }
}
