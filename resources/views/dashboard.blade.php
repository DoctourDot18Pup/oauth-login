<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            max-width: 420px;
            padding: 1rem;
        }

        .card {
            background: #1a1d27;
            border: 1px solid #2d3148;
            border-radius: 16px;
            padding: 2.5rem;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #2d3148;
        }

        .avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #2d3148;
            flex-shrink: 0;
        }

        .avatar-placeholder {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #23263a;
            border: 2px solid #2d3148;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #475569;
            flex-shrink: 0;
        }

        .profile-info h1 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #f1f5f9;
            margin-bottom: 0.25rem;
        }

        .profile-info p {
            font-size: 0.825rem;
            color: #64748b;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.25rem 0.65rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .badge img { width: 12px; height: 12px; filter: invert(1); }
        .badge.discord { background: rgba(88,101,242,0.2); color: #818cf8; border: 1px solid rgba(88,101,242,0.3); }
        .badge.spotify  { background: rgba(29,185,84,0.2);  color: #4ade80; border: 1px solid rgba(29,185,84,0.3); }
        .badge.twitch   { background: rgba(145,70,255,0.2); color: #c084fc; border: 1px solid rgba(145,70,255,0.3); }

        .info-grid {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            background: #23263a;
            border-radius: 10px;
            border: 1px solid #2d3148;
        }

        .info-row .label {
            font-size: 0.8rem;
            color: #64748b;
        }

        .info-row .value {
            font-size: 0.85rem;
            color: #e2e8f0;
            font-weight: 500;
        }

        .logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 0.75rem;
            background: transparent;
            border: 1px solid #3d2020;
            border-radius: 10px;
            color: #f87171;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.15s, border-color 0.15s;
        }

        .logout:hover {
            background: rgba(248,113,113,0.08);
            border-color: #f87171;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            @auth
            <div class="profile-header">
                @if(Auth::user()->avatar)
                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="avatar">
                @else
                    <div class="avatar-placeholder">👤</div>
                @endif

                <div class="profile-info">
                    <h1>{{ Auth::user()->name }}</h1>
                    <p>{{ Auth::user()->email ?? 'Sin correo registrado' }}</p>
                    <span class="badge {{ Auth::user()->provider }}">
                        <img src="https://cdn.jsdelivr.net/npm/simple-icons@v9/icons/{{ Auth::user()->provider }}.svg" alt="">
                        {{ ucfirst(Auth::user()->provider) }}
                    </span>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-row">
                    <span class="label">ID de usuario</span>
                    <span class="value">{{ Auth::user()->provider_id }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Proveedor</span>
                    <span class="value">{{ ucfirst(Auth::user()->provider) }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Protocolo</span>
                    <span class="value">OAuth 2.0</span>
                </div>
                <div class="info-row">
                    <span class="label">Registrado en la app</span>
                    <span class="value">{{ Auth::user()->created_at->format('d M Y') }}</span>
                </div>
            </div>

            <a href="/logout" class="logout">
                Cerrar sesión
            </a>
            @endauth
        </div>
    </div>
</body>
</html>