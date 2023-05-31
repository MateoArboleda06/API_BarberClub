<!doctype html>
<html lang="en">

<head>
  <title>API_BarberClub</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    @include('partials.nav')

    <div class="reservas">

        @foreach ($reservas as $reserva)

            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://st4.depositphotos.com/15237386/22009/i/450/depositphotos_220090696-stock-photo-barber-shop-for-men.jpg" alt="Card image cap">
                <div class="card-header">
                    <h2>{{ $reserva->servicioNombre }}</h2>
                </div>
                <div class="card-body">
                    <h5>USUARIO:</h5>
                    <p>{{ $reserva->name }}</p>
                    <h5>EMAIL:</h5>
                    <p>{{ $reserva->email }}</p>
                    <h5>SEDE:</h5>
                    <p>{{ $reserva->sedeNombre }}</p>
                    <h5>ENCARGADO:</h5>
                    <p>{{ $reserva->trabajadorNombre }}</p>
                    <h5>FECHA:</h5>
                    <p>{{ $reserva->fechaReserva }}</p>
                    <h5>HORA DE ATENCION:</h5>
                    <p>{{ $reserva->horaReserva }}</p>
                </div>

                <div class="button-container">
                    <a class="btn btn-info" href="{{ route('editar', ['reserva' => $reserva->id]) }}">Editar</a>
                    <button class="btn btn-danger" onclick="eliminar({{ $reserva->id }}, '{{ csrf_token() }}')">Eliminar</button>
                </div>
            </div>
            
        @endforeach
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
    <script src="/assets/jquery.js"></script>

</body>
</html>


<script>
    function eliminar(id, csrfToken){

        $.ajax({
        url: "{{ route('eliminar_reserva') }}",
        type: "POST",
        data: {
            "idReserva": id,
            "_token": csrfToken
        },
        dataType: "json",
        success: function(response){

            if (response.res === 'success') {

                swal.fire({
                    icon: "success",
                    title: "Elimación",
                    text: "Reserva Eliminada Correctamente",
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 2000
                });

                setTimeout(() => {
                    window.location.reload();
                }, 2100);
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
        });

    }  
</script>

<style>
    .button-container {
        display: flex;
        justify-content: space-around;
    }

    body {
        background-image: url(https://p1.pxfuel.com/preview/939/674/492/smoke-black-background-white-abstract-texture.jpg);
        height: 130%;
    }

    .reservas {
        display: flex;
        justify-content: space-around;
    }

    .card {
        margin-top: 80px;
    }

    footer {
        margin-top: 50px;
    }
</style>