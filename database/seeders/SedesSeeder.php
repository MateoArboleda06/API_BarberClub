<?php

namespace Database\Seeders;

use App\Models\Sede;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sede = new Sede();
        $sede->nombre = 'Itagui';
        $sede->save();

        $sede2 = new Sede();
        $sede2->nombre = 'Estrella';
        $sede2->save();

        $sede3 = new Sede();
        $sede3->nombre = 'Envigado';
        $sede3->save();

        $sede4 = new Sede();
        $sede4->nombre = 'Medellín';
        $sede4->save();

        $sede5 = new Sede();
        $sede5->nombre = 'Industriales';
        $sede5->save();

        $sede6 = new Sede();
        $sede6->nombre = 'Poblado';
        $sede6->save();

        $sede7 = new Sede();
        $sede7->nombre = 'Sabaneta';
        $sede7->save();

        $sede8 = new Sede();
        $sede8->nombre = 'San Diego';
        $sede8->save();
    }
}
