<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicio = new Servicio();
        $servicio->nombre = 'Corte';
        $servicio->save();

        $servicio2 = new Servicio();
        $servicio2->nombre = 'Tintura';
        $servicio2->save();

        $servicio3 = new Servicio();
        $servicio3->nombre = 'Barba';
        $servicio3->save();

        $servicio4 = new Servicio();
        $servicio4->nombre = 'Tratamiento';
        $servicio4->save();
    }
}
