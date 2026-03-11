<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

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
            width: 100%;
            max-width: 380px;
            text-align: center;
        }

        h1 {
            font-size: 1.5rem;
            color: #1a1a2e;
            margin-bottom: 0.5rem;
        }

        p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            margin-bottom: 1rem;
            transition: opacity 0.2s;
        }

        .btn:hover { opacity: 0.85; }

        .btn-discord  { background: #5865F2; color: white; }
        .btn-spotify  { background: #1DB954; color: white; }
        .btn-twitch   { background: #9146FF; color: white; }

        .btn img { width: 22px; height: 22px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Bienvenido</h1>
        <p>Inicia sesión con tu cuenta de:</p>

        <a href="/auth/discord/redirect" class="btn btn-discord">
            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/discord.svg"
                 style="filter: invert(1);" alt="Discord">
            Continuar con Discord
        </a>

        <a href="/auth/spotify/redirect" class="btn btn-spotify">
            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/spotify.svg"
                 style="filter: invert(1);" alt="Spotify">
            Continuar con Spotify
        </a>

        <a href="/auth/twitch/redirect" class="btn btn-twitch">
            <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/twitch.svg"
                 style="filter: invert(1);" alt="Twitch">
            Continuar con Twitch
        </a>
    </div>
</body>
</html>