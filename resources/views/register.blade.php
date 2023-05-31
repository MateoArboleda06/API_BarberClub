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
    <form method="POST">
        @csrf
        <section class="vh-100 gradient-custom" style="height: 100%;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem; height: 80%;">
                            <div class="card-body p-5 text-center" style="height: 80%">
                
                                <div class="mb-md-5 mt-md-4 pb-5">
                    
                                    <h2 class="fw-bold mb-2 text-uppercase">Register</h2>
                                    <p class="text-white-50 mb-5">Please enter your name, email and password!</p>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="name">
                                            Name
                                        </label>
                                        <input type="text" id="name" name="name" required autofocus class="form-control form-control-lg" value="{{ old('name') }}" />
                                        @error('name') {{ $message }} @enderror
                                    </div>
                    
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" required autofocus class="form-control form-control-lg" value="{{ old('email') }}" />
                                        @error('email') {{ $message }} @enderror
                                    </div>
                    
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="typePasswordX">Password</label>
                                        <input type="password" id="password" name="password" required class="form-control form-control-lg" />
                                        @error('password') {{ $message }} @enderror
                                    </div>
                    
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                    </div>
                    
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
 </body>
 </html>

 <style>
    .gradient-custom {
    /* fallback for old browsers */
    background: #6a11cb;

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
    }
 </style>
