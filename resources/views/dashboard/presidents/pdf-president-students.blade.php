<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de associados - {{$president->sala->name}} - Presidente(a): {{$president->user->name}}</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 80%
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
<span style="text-transform: uppercase !important;font-size: 85%">
   {{$president->sala->name}} -  Clube: {{$president->name_clube}} - Presidente: {{$president->user->name}}
    </span>
<hr>
<table style="width:100%">
    <tr>
        <th style="width: 3rem">Turma</th>
        <th>Alunos: {{$clubes->count()}}</th>
        <th style="width: 4rem">Início</th>
    </tr>
    @foreach($clubes as $clube)
        <tr>
            <td>{{$clube->student->room->name}}</td>
            <td>{{$clube->student->name}}</td>
            <td>{{\Carbon\Carbon::parse($clube->created_at)->format('d/m/Y')}}</td>
        </tr>

    @endforeach
</table>
<p style="font-size: 0.7rem !important;text-transform: uppercase">Documento impresso
    em: {{\Carbon\Carbon::now('America/Sao_Paulo')->format('d/m/Y')}}
    as {{\Carbon\Carbon::now('America/Sao_Paulo')->format('H:i')}} por {{auth()->user()->name}}</p>
</body>
</html>
