<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte pdf de Categorias</title>
</head>
<body>
    <main>
        <section>Cabezera</section>

        <main>Wiliam Dida</main>

        <section>
            <h2>Reporte Categorias</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Fecha Creacion</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categorias as $item)
                    <tr>
                        <td>{{$item->nombre_categoria}}</td>
                        <td>{{$item->descripcion}}</td>
                        <td>{{$item->estado}}</td>
                        <td>{{$item->created_at}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No hay Datos</td>
                    </tr>  
                    @endforelse
                </tbody>
            </table>
        </section>

        <section>Footer</section>
    </main>
</body>
</html>