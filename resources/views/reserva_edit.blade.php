<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Aprendible</title>
 </head>
 <body>
    @include('partials.nav')
    <div id="intro" class="bg-image shadow-2-strong">
        <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <img src="https://media.istockphoto.com/id/1183092667/es/vector/interfaz-del-programa-de-aplicaci%C3%B3n-api.jpg?s=612x612&w=0&k=20&c=jnSwrARjnfo_1D1rUGaMm3HhjRJ60nPDCPvhEYJKKdY=" style="width: 185px;" alt="logo" id="imagen_form">
                            </div>

                            <form class="bg-white rounded shadow-5-strong p-5" action="{{ route('guardar_ediccion_reserva') }}" method="POST">
                                @csrf

                                <h1>Solicitud de Reserva</h1>
                                <br>

                                <input type="hidden" name="id_reserva" value="{{ $reserva->id }}">

                                <!-- Sede input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="selectSede">Sede <span class="rojo">*</span></label>
                                    <select class="form-control select2" id="selectSede" name="sede" required>
                                        <option value="{{ $reserva->idSede }}">{{ $reserva->sedeNombre }}</option>
                                        @foreach ($sedes as $sede)
                                            <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- trabajador input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="selectTrabajador">Trabajador <span class="rojo">*</span></label>
                                    <select class="form-control select2" id="selectTrabajador" name="trabajador" required>
                                        <option value="{{ $reserva->idTrabajador }}">{{ $reserva->trabajadorNombre }}</option>
                                        @foreach ($trabajadores as $trabajador)
                                            <option value="{{ $trabajador->id }}">{{ $trabajador->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- servicio input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="selectServicio">Servicio <span class="rojo">*</span></label>
                                    <select class="form-control select2" id="selectServicio" name="servicio" required>
                                        <option value="{{ $reserva->idServicio }}">{{ $reserva->servicioNombre }}</option>
                                        @foreach ($servicios as $servicio)
                                            <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Fecha input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="fecha">Fecha</label>
                                    <input class="form-control" type="date" id="fecha" name="fecha" value="{{ $reserva->fechaReserva }}" required>
                                </div>

                                <!-- Hora input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="hora">Hora de Reserva</label>
                                    <input type="time" name="hora" id="hora" value="{{ $reserva->horaReserva }}" required>
                                </div>

                                <!-- Submit button -->
                                <div class="form-outline boton">
                                    <button type="submit" class="btn btn-primary">Guardar Edicción</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <footer class="bg-light text-lg-start">

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    <!-- Copyright -->
    </footer>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<style>
    *{
        margin: 0;
        padding: 0;
    }
    
    #intro {
        background-image: url(https://p1.pxfuel.com/preview/939/674/492/smoke-black-background-white-abstract-texture.jpg);
        height: 150%;
      }

    select {
        max-width: 400px; /* Ancho máximo de 400 píxeles */
    }

    .card-header {
        display: flex;
        justify-content: center; /* Centrar horizontalmente */
        align-items: center; /* Centrar verticalmente */
    }

    h1 {
        color:darkslategrey;
    }

    .rojo {
        color: red;
    }

    .boton {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<script src="/assets/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });   
</script>
