<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Sede;
use App\Models\Servicio;
use App\Models\Trabajador;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $sedes = Sede::all();
        $trabajadores = Trabajador::all();
        $servicios = Servicio::all();

        return view('reservas', compact('sedes', 'trabajadores', 'servicios'));
    }

    public function store(Request $request)
    {
        try {

            $fecha = explode('-', $request->fecha);
            $hora = explode(':', $request->hora);

            $fechaReserva = Carbon::create($fecha[0], $fecha[1], $fecha[2], $hora[0], $hora[1]);
            $timestampFecha = $fechaReserva->timestamp;

            DB::beginTransaction();

            Reserva::create([
                'idSede' => $request->sede,
                'idUsuario' => Auth::user()->id,
                'idTrabajador' => $request->trabajador,
                'idServicio' => $request->servicio,
                'fechaReserva' => $timestampFecha,
                'horaReserva' => $request->hora
            ]);

            DB::commit();

            return Redirect::back()->with('success', 'Reserva realizada correctamente');

        } catch (Exception $th) {

            DB::rollBack();
            dd($th);
        }
    }

    public function misReservas($usuario)
    {
        // dd($usuario);
        $reservas = Reserva::join('sedes', 'sedes.id', '=', 'reservas.idSede')
        ->join('users', 'users.id', '=', 'reservas.idUsuario')
        ->join('trabajadores', 'trabajadores.id', '=', 'reservas.idTrabajador')
        ->join('servicios', 'servicios.id', '=', 'reservas.idServicio')
        ->select('reservas.id', 'sedes.nombre AS sedeNombre', 'users.name', 'users.email', 'trabajadores.nombre AS trabajadorNombre', 'servicios.nombre AS servicioNombre', DB::raw("DATE_FORMAT(FROM_UNIXTIME(reservas.fechaReserva), '%Y-%m-%d') AS fechaReserva"), 'reservas.horaReserva')
        ->where('idUsuario', $usuario)
        ->get();

        return view('mis_reservas', compact('reservas'));
    }

    public function destroy(Request $request)
    {
        try {
            Reserva::find($request->idReserva)
            ->delete();

            return response()->json(['res' => 'success']);

        } catch (Exception $th) {
            dd($th);
        }
        
    }

    public function edit($id)
    {
        $sedes = Sede::all();
        $trabajadores = Trabajador::all();
        $servicios = Servicio::all();

        $reserva = Reserva::join('sedes', 'sedes.id', '=', 'reservas.idSede')
        ->join('users', 'users.id', '=', 'reservas.idUsuario')
        ->join('trabajadores', 'trabajadores.id', '=', 'reservas.idTrabajador')
        ->join('servicios', 'servicios.id', '=', 'reservas.idServicio')
        ->select('reservas.id', 'reservas.idSede', 'sedes.nombre AS sedeNombre', 'users.name', 'users.email', 'reservas.idTrabajador', 'trabajadores.nombre AS trabajadorNombre', 'reservas.idServicio', 'servicios.nombre AS servicioNombre', DB::raw("DATE_FORMAT(FROM_UNIXTIME(reservas.fechaReserva), '%Y-%m-%d') AS fechaReserva"), 'reservas.horaReserva')
        ->where('reservas.id', $id)
        ->first();

        return view('reserva_edit', compact('sedes', 'trabajadores', 'servicios', 'reserva'));
    }

    public function update(Request $request)
    {

        try {

            DB::beginTransaction();
            $reserva = Reserva::find($request->id_reserva);

            $fecha = explode('-', $request->fecha);
            $hora = explode(':', $request->hora);

            $fechaReserva = Carbon::create($fecha[0], $fecha[1], $fecha[2], $hora[0], $hora[1]);
            $timestampFecha = $fechaReserva->timestamp;

            $reserva->idSede = $request->sede;
            $reserva->idTrabajador = $request->trabajador;
            $reserva->idServicio = $request->servicio;
            $reserva->fechaReserva = $timestampFecha;
            $reserva->horaReserva = $request->hora;
            $reserva->save();

            DB::commit();

            return Redirect::back()->with('success', 'Reserva actualizada correctamente');

        } catch (Exception $th) {
            DB::rollBack();
            dd($th);
        }
    }
}
