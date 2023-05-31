<?php

namespace Database\Seeders;

use App\Models\Trabajador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrabajadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trabajador = new Trabajador();
        $trabajador->nombre = 'Trabajador 1';
        $trabajador->save();

        $trabajador2 = new Trabajador();
        $trabajador2->nombre = 'Trabajador 2';
        $trabajador2->save();

        $trabajador3 = new Trabajador();
        $trabajador3->nombre = 'Trabajador 3';
        $trabajador3->save();

        $trabajador4 = new Trabajador();
        $trabajador4->nombre = 'Trabajador 4';
        $trabajador4->save();

        $trabajador5 = new Trabajador();
        $trabajador5->nombre = 'Trabajador 5';
        $trabajador5->save();

        $trabajador6 = new Trabajador();
        $trabajador6->nombre = 'Trabajador 6';
        $trabajador6->save();
    }
}
