<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Protocolos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Relatório de Protocolos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Data de registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($protocols as $protocol)
            <tr>
                <td>{{ $protocol->id }}</td>
                <td>{{ $protocol->description }}</td>
                <td>{{ \Carbon\Carbon::parse($protocol->created_at)->format('d/m/Y H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
