# 🔐 OAuth Login — Laravel

Aplicación web desarrollada en **Laravel** que implementa autenticación federada mediante **OAuth 2.0** utilizando tres proveedores externos: **Discord**, **Spotify** y **Twitch**.

El proyecto fue desarrollado como práctica del estándar OAuth 2.0 y OpenID Connect, utilizando el paquete oficial **Laravel Socialite** para gestionar los flujos de autenticación.

---

## 📋 Tabla de contenidos

- [Descripción](#-descripción)
- [Tecnologías utilizadas](#-tecnologías-utilizadas)
- [Requisitos previos](#-requisitos-previos)
- [Instalación](#-instalación)
- [Configuración de proveedores OAuth](#-configuración-de-proveedores-oauth)
- [Uso de ngrok](#-uso-de-ngrok)
- [Estructura del proyecto](#-estructura-del-proyecto)
- [Uso](#-uso)

---

## 📖 Descripción

Esta aplicación permite a los usuarios iniciar sesión utilizando sus cuentas existentes de Discord, Spotify o Twitch, sin necesidad de crear un nuevo usuario o contraseña. Al autenticarse, la aplicación:

- Recibe los datos del usuario desde el proveedor (nombre, email, avatar)
- Crea o actualiza el registro del usuario en la base de datos local
- Inicia la sesión del usuario y lo redirige al dashboard
- Muestra la información del perfil obtenida mediante el token OAuth

---

## 🛠 Tecnologías utilizadas

| Tecnología | Versión | Uso |
|---|---|---|
| PHP | 8.3 | Lenguaje base |
| Laravel | 12 | Framework web |
| Laravel Socialite | 5.x | Gestión de OAuth 2.0 |
| SocialiteProviders/Discord | latest | Driver para Discord |
| SocialiteProviders/Spotify | latest | Driver para Spotify |
| SQLite | 3.45 | Base de datos local |
| ngrok | latest | Túnel HTTPS para desarrollo |

---

## ✅ Requisitos previos

Antes de instalar el proyecto asegúrate de tener:

- **PHP 8.2 o superior** con las extensiones: `curl`, `mbstring`, `xml`, `zip`, `sqlite3`, `bcmath`, `intl`
- **Composer 2.x**
- **Git**
- **ngrok** (necesario para Spotify y Twitch en desarrollo local)
- Cuentas de desarrollador en Discord, Spotify y Twitch

---

## 🚀 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/DoctourDot18Pup/oauth-login.git
cd oauth-login
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Crear el archivo de entorno

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar la base de datos

En el archivo `.env`, asegúrate de tener:

```env
DB_CONNECTION=sqlite
```

Crea el archivo de base de datos:

```bash
touch database/database.sqlite
```

Ejecuta las migraciones:

```bash
php artisan migrate
```

### 5. Levantar el servidor

```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`.

---

## 🔑 Configuración de proveedores OAuth

Cada proveedor requiere que registres una aplicación en su panel de desarrolladores para obtener el `Client ID` y `Client Secret`.

### Discord

1. Ve a https://discord.com/developers/applications
2. Crea una nueva aplicación
3. En la sección **OAuth2** copia el `Client ID` y `Client Secret`
4. Agrega la Redirect URI: `https://TU-URL-NGROK/auth/discord/callback`

### Spotify

1. Ve a https://developer.spotify.com/dashboard
2. Crea una nueva app
3. En **Settings** copia el `Client ID` y `Client Secret`
4. Agrega la Redirect URI: `https://TU-URL-NGROK/auth/spotify/callback`

### Twitch

1. Ve a https://dev.twitch.tv/console/apps
2. Registra una nueva aplicación
3. Copia el `Client ID` y genera un `Client Secret`
4. Agrega la Redirect URI: `https://TU-URL-NGROK/auth/twitch/callback`

### Variables de entorno

Una vez que tengas las credenciales, agrégalas al archivo `.env`:

```env
DISCORD_CLIENT_ID=tu_client_id
DISCORD_CLIENT_SECRET=tu_client_secret
DISCORD_REDIRECT=https://TU-URL-NGROK/auth/discord/callback

SPOTIFY_CLIENT_ID=tu_client_id
SPOTIFY_CLIENT_SECRET=tu_client_secret
SPOTIFY_REDIRECT=https://TU-URL-NGROK/auth/spotify/callback

TWITCH_CLIENT_ID=tu_client_id
TWITCH_CLIENT_SECRET=tu_client_secret
TWITCH_REDIRECT=https://TU-URL-NGROK/auth/twitch/callback
```

> ⚠️ **Nunca subas el archivo `.env` al repositorio.** Ya está incluido en el `.gitignore` por defecto.

---

## 🌐 Uso de ngrok

Spotify y Twitch requieren que la Redirect URI use el protocolo **HTTPS**. En desarrollo local esto no es posible directamente, por lo que se utiliza **ngrok** para crear un túnel HTTPS público.

### Instalación de ngrok

```bash
curl -sSL https://ngrok-agent.s3.amazonaws.com/ngrok.asc \
  | sudo tee /etc/apt/trusted.gpg.d/ngrok.asc >/dev/null \
  && echo "deb https://ngrok-agent.s3.amazonaws.com buster main" \
  | sudo tee /etc/apt/sources.list.d/ngrok.list \
  && sudo apt update \
  && sudo apt install ngrok
```

Configura tu token de autenticación (obtenlo en https://ngrok.com):

```bash
ngrok config add-authtoken TU_TOKEN
```

### Uso

Necesitas dos terminales abiertas simultáneamente:

**Terminal 1 — Laravel:**
```bash
php artisan serve
```

**Terminal 2 — ngrok:**
```bash
ngrok http 8000
```

ngrok mostrará una URL pública como:
```
Forwarding   https://xxxx-xxx-xxx-xxx-xx.ngrok-free.app -> http://localhost:8000
```

Usa esa URL como base para todas las Redirect URIs en los paneles de los proveedores y en tu `.env`.

### ⚠️ Importante: la URL cambia en cada sesión

En el plan gratuito de ngrok, **la URL se regenera cada vez que reinicias el túnel**. Cuando esto ocurra debes actualizar:

1. Las Redirect URIs en el panel de **Discord**, **Spotify** y **Twitch**
2. Las variables `DISCORD_REDIRECT`, `SPOTIFY_REDIRECT` y `TWITCH_REDIRECT` en el `.env`
3. Limpiar la caché de configuración de Laravel:

```bash
php artisan config:clear
```

---

## 📁 Estructura del proyecto

```
oauth-login/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── Auth/
│   │           └── SocialiteController.php   # Maneja redirect y callback OAuth
│   └── Models/
│       └── User.php                          # Modelo con campos OAuth
├── database/
│   └── migrations/
│       └── xxxx_create_users_table.php       # Migración con campos provider, provider_id, avatar
├── resources/
│   └── views/
│       ├── login.blade.php                   # Vista de login con los 3 proveedores
│       └── dashboard.blade.php               # Vista del perfil tras autenticarse
├── routes/
│   └── web.php                               # Rutas de login, callback, dashboard y logout
├── config/
│   └── services.php                          # Credenciales de los proveedores OAuth
└── .env                                      # Variables de entorno (no incluido en el repo)
```

---

## 💻 Uso

Una vez configurado e iniciado el servidor, accede a:

```
https://TU-URL-NGROK/login
```

Desde ahí puedes autenticarte con cualquiera de los tres proveedores. Tras el login serás redirigido al dashboard donde se muestra tu nombre, avatar, email, proveedor utilizado y fecha de registro en la aplicación.

Para cerrar sesión usa el botón **"Cerrar sesión"** en el dashboard.
