<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'reservas';
    protected $fillable = [
        'idSede',
        'idUsuario',
        'idTrabajador',
        'idServicio',
        'fechaReserva',
        'horaReserva'
    ];
}
