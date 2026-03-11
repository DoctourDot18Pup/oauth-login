<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #0f1117;
            color: #e2e8f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 1rem;
        }

        .card {
            background: #1a1d27;
            border: 1px solid #2d3148;
            border-radius: 16px;
            padding: 3rem 2.5rem;
        }

        .logo {
            width: 42px;
            height: 42px;
            background: #4f6ef7;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.75rem;
        }

        .logo svg {
            width: 22px;
            height: 22px;
            fill: white;
        }

        h1 {
            font-size: 1.4rem;
            font-weight: 600;
            color: #f1f5f9;
            margin-bottom: 0.4rem;
            letter-spacing: -0.3px;
        }

        .subtitle {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 2.25rem;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .divider span {
            font-size: 0.75rem;
            color: #475569;
            white-space: nowrap;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #2d3148;
        }

        .btn {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 0.75rem 1rem;
            background: #23263a;
            border: 1px solid #2d3148;
            border-radius: 10px;
            color: #e2e8f0;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            margin-bottom: 0.75rem;
            transition: background 0.15s, border-color 0.15s;
            cursor: pointer;
        }

        .btn:hover {
            background: #2a2e45;
            border-color: #4f6ef7;
        }

        .btn:last-child { margin-bottom: 0; }

        .btn-icon {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .btn-icon img { width: 16px; height: 16px; filter: invert(1); }

        .discord-icon  { background: #5865F2; }
        .spotify-icon  { background: #1DB954; }
        .twitch-icon   { background: #9146FF; }

        .btn-label { flex: 1; }

        .arrow {
            color: #475569;
            font-size: 0.85rem;
        }

        .footer {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.78rem;
            color: #475569;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">

            <div class="logo">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V8h2v8zm4 0h-2V8h2v8z"/>
                </svg>
            </div>

            <h1>Iniciar sesión</h1>
            <p class="subtitle">Elige un proveedor para continuar</p>

            <div class="divider"><span>OAuth 2.0</span></div>

            <a href="/auth/discord/redirect" class="btn">
                <span class="btn-icon discord-icon">
                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/discord.svg" alt="Discord">
                </span>
                <span class="btn-label">Continuar con Discord</span>
                <span class="arrow">›</span>
            </a>

            <a href="/auth/spotify/redirect" class="btn">
                <span class="btn-icon spotify-icon">
                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/spotify.svg" alt="Spotify">
                </span>
                <span class="btn-label">Continuar con Spotify</span>
                <span class="arrow">›</span>
            </a>

            <a href="/auth/twitch/redirect" class="btn">
                <span class="btn-icon twitch-icon">
                    <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/twitch.svg" alt="Twitch">
                </span>
                <span class="btn-label">Continuar con Twitch</span>
                <span class="arrow">›</span>
            </a>

            <p class="footer">Tus datos son gestionados de forma segura<br>mediante OAuth 2.0 / OpenID Connect</p>
        </div>
    </div>
</body>
</html>