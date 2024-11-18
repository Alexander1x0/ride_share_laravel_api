<?php

namespace Database\Seeders;

use App\Models\Transport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transports = ['car', 'bike', 'cycle', 'taxi'];
        foreach ($transports as $transport) {
            Transport::create([
                "name" => $transport,
            ]);
        }
    }
}
