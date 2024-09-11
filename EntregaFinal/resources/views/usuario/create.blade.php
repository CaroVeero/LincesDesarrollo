<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear</title>
</head>
<body>
    <h1>Crear Usuario</h1>

    <!-- Para que aparezcan todos los errores que podrían haber -->
    @if ($errors->any())
    <ul>
        @foreach ($errors as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <form action="{{Route ('usuario.registrar')}}" method="POST">
    @csrf
    @method('POST')
        <input type="text" name="nombre" placeholder="Ingrese nombre"><br>
        <input type="text" name="email" placeholder="Ingrese email"><br>
        <input type="password" name="password" placeholder="Ingrese su contraseña"><br>
        <input type="password" name="rePassword" placeholder="Ingrese nuevamente su contraseña"><br>
        <input type="password" name="dayCode" placeholder="Ingrese el código del día"><br>
        <button type="submit">Crear</button>
    </form>

    <hr>

    Si usted tiene una cuenta, haga click <a href="/login"> aquí</a>


</body>
</html>