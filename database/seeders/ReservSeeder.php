<?php

namespace Database\Seeders;

use App\Models\Reserv;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reserv::factory()
            ->count(60)
            ->create();
    }
}
