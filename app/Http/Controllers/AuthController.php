<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validate(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'Usuario registrado correctamente',
            'user' => $user
        ], 201);
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
                'idUsuario' => Auth()->user()->id,
                'idTrabajador' => $request->trabajador,
                'idServicio' => $request->servicio,
                'fechaReserva' => $timestampFecha,
                'horaReserva' => $request->hora
            ]);

            DB::commit();

            return response()->json(['success' => 'Reserva creada correctamente'], 200);

        } catch (Exception $th) {

            DB::rollBack();
            dd($th);
        }    
    }

    public function misReservas()
    {
        $reservas = Reserva::join('sedes', 'sedes.id', '=', 'reservas.idSede')
        ->join('users', 'users.id', '=', 'reservas.idUsuario')
        ->join('trabajadores', 'trabajadores.id', '=', 'reservas.idTrabajador')
        ->join('servicios', 'servicios.id', '=', 'reservas.idServicio')
        ->select('reservas.id', 'sedes.nombre AS sedeNombre', 'users.name', 'users.email', 'trabajadores.nombre AS trabajadorNombre', 'servicios.nombre AS servicioNombre', DB::raw("DATE_FORMAT(FROM_UNIXTIME(reservas.fechaReserva), '%Y-%m-%d') AS fechaReserva"), 'reservas.horaReserva')
        ->where('reservas.idUsuario', Auth()->user()->id)
        ->get();

        if (!empty($reservas) && $reservas != null) {
            return response()->json(['reservas' => $reservas], 200);
        }

        return response()->json(['reservas' => 'Sin reservas'], 200);

    }

    public function destroy($id)
    {
        Reserva::find($id)
        ->delete();

        return response()->json(['success', 'Reserva eliminada correctamente'], 200);
    }

    public function update($id, Request $request)
    {
        try {

            DB::beginTransaction();
            $reserva = Reserva::find($id);

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

            return response()->json(['success', 'Reserva editada correctamente'], 200);

        } catch (Exception $th) {
            DB::rollBack();
            return response()->json(['error', 'Ediccion de reserva fallida'], 300);

        }
    }
}