<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$titulo}}</title>
</head>
<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Duracion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursos as $curso)
            <tr>
                <th>{{$curso->nombre}}</th>
                <th>{{$curso->descripcion}}</th>
                <th>{{$curso->duracion}}</th>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>