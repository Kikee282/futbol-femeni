<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #2d3748; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background-color: #4a5568; color: white; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; color: #718096; }
        .btn { display: inline-block; background-color: #3182ce; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hola, {{ $arbitre->name }}! 👋</h1>
        
        <p>Aquest és el llistat dels partits on has estat assignat com a àrbitre:</p>

        @if($partits->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Local</th>
                        <th>Visitant</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($partits as $partit)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y') }}</td>
                            <td>{{ $partit->local->nom }}</td>
                            <td>{{ $partit->visitant->nom }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align: center; color: #e53e3e;">Actualment no tens partits assignats.</p>
        @endif

        <div style="text-align: center;">
            <a href="{{ route('partits.index') }}" class="btn">Veure a l'aplicació</a>
        </div>

        <div class="footer">
            <p>Gràcies per la teva tasca a la Lliga de Futbol Femení.</p>
        </div>
    </div>
</body>
</html>