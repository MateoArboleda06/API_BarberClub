<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <section>
		<h1>Bienvenido {{ Auth::user()->name }}</h1>
	</section>
    
</body>
</html>

<style>
    *{
        margin: 0;
        padding: 0;
    }
    section{
        width: 100%;
        height: 100vh;
        color: #fff;
        background: linear-gradient(45deg,black,rgb(0, 217, 255),green,black,white);
        background-size: 400% 400%;
        position: relative;
        animation: cambiar 10s ease-in-out infinite;
    }
    h1{
        font-size: 4rem;
        letter-spacing: 2px;
        border: solid 3px #fff;
        border-radius: 25px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        padding: 2rem 3rem;
    }

    @keyframes cambiar{
        0%{background-position: 0 50%;}
        50%{background-position: 100% 50%;}
        100%{background-position: 0 50%;}
    }
</style>