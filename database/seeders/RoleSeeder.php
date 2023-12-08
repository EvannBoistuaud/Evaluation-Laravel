<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Silber\Bouncer\Bouncer;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $bouncer = app(Bouncer::class);

        $bouncer->role()->firstOrCreate(['name' => 'admin']);
        $bouncer->role()->firstOrCreate(['name' => 'user']);

        $bouncer->ability()->firstOrCreate(['name' => 'salle-index']);
        $bouncer->ability()->firstOrCreate(['name' => 'reserv-index']);
        $bouncer->ability()->firstOrCreate(['name' => 'client-index']);

        $bouncer->allow('admin')->to('salle-index');
        $bouncer->allow('user')->to('reserv-index');
        $bouncer->allow('user')->to('client-index');
    }
}
