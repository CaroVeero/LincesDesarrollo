<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard del Backoffice</title>
</head>
<body>
    {{$user}}
    <hr>
    <p>Nombre: {{$user->nombre}}</p>
    <p>Email: {{$user->email}}</p>
    <hr>
    <form action="{{Route('usuario.logout')}}" method="POST">
        @csrf
        <button type="submit">Cerrar Sesión</button>
    </form>
</body>
</html>