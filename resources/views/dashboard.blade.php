<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        img { border-radius: 50%; width: 80px; margin-bottom: 1rem; }
        h1 { color: #1a1a2e; margin-bottom: 0.5rem; }
        p  { color: #666; }
        .badge {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: white;
        }
        .discord { background: #5865F2; }
        .spotify  { background: #1DB954; }
        .twitch   { background: #9146FF; }
        .logout {
            display: inline-block;
            margin-top: 1.5rem;
            color: #e74c3c;
            text-decoration: none;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="card">
        @auth
            @if(Auth::user()->avatar)
                <img src="{{ Auth::user()->avatar }}" alt="Avatar">
            @endif
            <h1>Hola, {{ Auth::user()->name }}</h1>
            <p>{{ Auth::user()->email }}</p>
            <span class="badge {{ Auth::user()->provider }}">
                {{ ucfirst(Auth::user()->provider) }}
            </span>
            <br>
            <a href="/logout" class="logout">Cerrar sesión</a>
        @endauth
    </div>
</body>
</html>