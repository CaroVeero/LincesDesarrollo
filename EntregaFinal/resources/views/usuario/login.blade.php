<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Inicio de sesión</h1>

    <!-- Mostrar errores  -->
    @if ($errors->any())
    <ul>
        @foreach ($errors as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif

    <form action="{{Route('usuario.validar')}}" method="POST">
        @csrf
        <input type="text" name="email" placeholder="Ingrese email"><br>
        <input type="password" name="password" placeholder="Ingrese su contraseña"><br>
        <button type="submit">Ingresar</button>
    </form>

    <hr>

    Si no tiene una cuenta, haga click <a href="{{Route('usuario.registrar')}}"> aquí</a>


</body>
</html>