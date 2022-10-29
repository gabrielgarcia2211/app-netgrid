<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid mt-5">
        <h2 class="text-center mb-3">Listado de Pokemons Favoritos</h2>
        <div class="justify-content-end mb-4">
        </div>
        <table class="table table-striped">
            <thead>
                <tr class="table-danger">
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th style="text-align:center" scope="col">Sprites</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($info))
                    @foreach ($info as $key => $d)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td> {{ $d['name'] }}</td>
                            <td style="text-align:center;width: 40%">
                                <div class="text-center" style="width:100%">
                                    <img src={{ $d['sprites']['f'] }} style="width:50%" class="rounded" alt="N/A">
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
<script src="{{ asset('js/app.js') }}" defer></script>

</html>
