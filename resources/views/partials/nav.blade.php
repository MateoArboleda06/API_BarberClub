<nav class="navbar navbar-expand-md shadow-sm" style="background-color: black;">
    <div class="container">
        <a class="navbar-brand btn" href="/" style="color: aliceblue;">
            API_BarberClub
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" >

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto" >
                <!-- Authentication Links -->
                @auth
                    <a class="btn btn-warning" href="/dashboard">Dashboard</a>
                    <a class="btn btn-success" href="{{ route('reservas') }}">Reservar</a>
                    <a class="btn btn-rounded btn-info" href="{{ route('mis_reservas', ['usuario' => Auth::user()->id]) }}">Mis Reservas</a>
                         
                    <form action="/logout" method="POST" style="display: inline;">
                        @csrf

                        <a href="#" class="btn btn-danger logout" onclick="this.closest('form').submit()" style="color: white;">Logout</a>
                    </form>
                          
                @else
                    <li class="nav-item">
                        <a class="btn btn-success login" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-rounded btn-info register" href="/register">Register</a>
                    </li>
                @endauth
    
            </ul>
        </div>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('status'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '{{ session('status') }}',
            showConfirmButton: false,
            timer: 3000
        })
    </script>
@endif

@if (session('success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000
        })
    </script>
@endif

<style>
    .login {
        margin-inline-end: 15%;
    }

    .register {
        margin-inline-start: 10%;
    }

    .logout {
        margin-left: 100%;
    }
</style>
