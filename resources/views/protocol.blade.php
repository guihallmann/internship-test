<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Protocolo</title>

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
    <h1>Relatório de Protocolo</h1>
    <p><strong>ID Protocolo:</strong> {{ $protocol->id }}</p>
    <p><strong>Descrição:</strong> {{ $protocol->description }}</p>
    <p><strong>Data de Registro:</strong> {{ \Carbon\Carbon::parse($protocol->created_at)->format('d/m/Y H:i:s') }}</p>

    @if($followUps && count($followUps) > 0)
        <h3>Acompanhamentos</h3>
        <table>
            <thead>
                <tr>
                    <th>Observação</th>
                    <th>Data de Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach($followUps as $followUp)
                <tr>
                    <td>{{ $followUp->observation }}</td>
                    <td>{{ \Carbon\Carbon::parse($followUp->created_at)->format('d/m/Y H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
