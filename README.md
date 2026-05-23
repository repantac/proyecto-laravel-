# Te Apoyamos S.A.S. — Portal web (Laravel)

Aplicación web básica desarrollada con **Laravel 12** y **PHP 8.2**, pensada como portal de acceso para una firma de apoyo legal. Permite iniciar sesión como **cliente** o **profesional**, y al profesional le permite gestionar **casos jurídicos** (crear, ver, editar y eliminar) con datos guardados en base de datos.

Proyecto académico / de aprendizaje: parte desde una instalación Laravel estándar y avanza por fases hasta un CRUD funcional con autenticación real.

---

## Tabla de contenidos

- [¿Qué hace esta aplicación?](#qué-hace-esta-aplicación)
- [Tecnologías utilizadas](#tecnologías-utilizadas)
- [Evolución del proyecto (paso a paso)](#evolución-del-proyecto-paso-a-paso)
- [Estructura del proyecto](#estructura-del-proyecto)
- [Requisitos](#requisitos)
- [Instalación local (XAMPP)](#instalación-local-xampp)
- [Usuarios de prueba](#usuarios-de-prueba)
- [Rutas principales](#rutas-principales)
- [Base de datos](#base-de-datos)
- [Subir el proyecto a GitHub](#subir-el-proyecto-a-github)
- [Licencia](#licencia)

---

## ¿Qué hace esta aplicación?

1. **Página de inicio / login** (`/`): formulario con usuario, contraseña y tipo de usuario (cliente o profesional).
2. **Autenticación real**: valida credenciales contra la tabla `users` usando el sistema de sesiones de Laravel (`Auth`).
3. **Portal cliente** (`/portal-cliente`): vista de bienvenida para usuarios tipo cliente (sin CRUD de casos por ahora).
4. **Portal profesional** (`/casos`): lista de casos asignados al profesional logueado.
5. **CRUD de casos**:
   - Listar casos del profesional actual.
   - Crear caso (código automático `C-001`, `C-002`, …).
   - Ver detalle, editar y eliminar.
   - Cada caso se vincula a un **cliente** (`users`) y a un **profesional** (`users`).
6. **Alta de clientes desde modal**: al crear un caso, se puede registrar un cliente nuevo vía AJAX (`POST /clientes`).

---

## Tecnologías utilizadas

| Área | Tecnología |
|------|------------|
| Backend | Laravel 12, PHP 8.2+ |
| Base de datos | MySQL (XAMPP) o SQLite (configurable en `.env`) |
| Frontend | Blade, Bootstrap 5.3, Bootstrap Icons |
| Estilos | CSS propio (`public/css/styles.css`), Google Fonts (Libre Baskerville, Montserrat) |
| Servidor local | Apache + MySQL con [XAMPP](https://www.apachefriends.org/) |

---

## Evolución del proyecto (paso a paso)

Resumen de lo construido en cada fase, según el historial del repositorio:

### Fase 3 — Proyecto Laravel inicial

- Instalación del framework Laravel.
- Configuración básica del entorno (`.env`, migraciones por defecto de `users`, `cache`, `jobs`).
- Primeras vistas estáticas: login, portal cliente y portal profesional.
- Rutas en `routes/web.php` y assets en `public/css/`.
- Identidad visual inicial para **Te Apoyamos S.A.S.** (logo, colores, tipografía).

### Fase 4 — Lógica de negocio y base de datos

- **Modelo `Caso`** con relaciones a `User` (cliente y profesional).
- **Migraciones**:
  - Tabla `casos` (código, abogado, tipo de proceso, estado, progreso, fecha, `cliente_id`).
  - Campo `profesional_id` en `casos` (cada caso pertenece a un profesional).
- **`CasoController`**: CRUD completo con `Route::resource('casos', ...)`.
- **`AuthController`**: login y logout con `Hash::check` y `Auth::login`.
- **`ClienteController`**: creación de clientes en JSON para el formulario de nuevo caso.
- **`CasoSeeder`**: datos de prueba (3 casos y usuarios ejemplo).
- Validación de formularios y mensajes de error en español.

### Fase 5 — Diseño y pulido

- Sistema de colores y tipografía unificados en `styles.css`.
- Mejoras en vistas `create`, `edit` y `show` de casos.
- Verificación de email deshabilitada en el modelo `User` (no se usa en este proyecto).
- Comentarios en código orientados a aprendizaje.

---

## Estructura del proyecto

```
proyecto-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php      # Login y logout
│   │   ├── CasoController.php      # CRUD de casos
│   │   └── ClienteController.php   # Alta de clientes (API JSON)
│   └── Models/
│       ├── Caso.php
│       └── User.php
├── database/
│   ├── migrations/                 # Esquema de tablas
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── CasoSeeder.php
├── public/css/
│   └── styles.css                  # Estilos principales
├── resources/views/
│   ├── inicio.blade.php            # Login
│   ├── portal-cliente.blade.php
│   ├── portal-profesional.blade.php
│   └── casos/
│       ├── create.blade.php
│       ├── edit.blade.php
│       └── show.blade.php
└── routes/web.php                  # Definición de rutas
```

---

## Requisitos

- PHP >= 8.2 con extensiones habituales de Laravel (`mbstring`, `openssl`, `pdo`, etc.)
- [Composer](https://getcomposer.org/)
- XAMPP (Apache + MySQL) u otro stack LAMP
- Git (para clonar o subir a GitHub)

---

## Instalación local (XAMPP)

1. **Clonar o copiar** el proyecto en la carpeta de XAMPP, por ejemplo:
   ```
   /Applications/XAMPP/xamppfiles/htdocs/proyecto-laravel
   ```

2. **Instalar dependencias de PHP** (en la carpeta del proyecto):
   ```bash
   composer install
   ```

3. **Configurar entorno**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Base de datos** — editar `.env` para MySQL en XAMPP:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=proyecto_laravel
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   Crear la base `proyecto_laravel` en phpMyAdmin.

5. **Migrar y poblar datos de prueba**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Levantar la aplicación** (elige una opción):
   - Abrir en el navegador: `http://localhost/proyecto-laravel/public`
   - O usar el servidor integrado de Laravel:
     ```bash
     php artisan serve
     ```
     Luego visitar: `http://127.0.0.1:8000`

> **Importante:** el archivo `.env` no se sube a GitHub (está en `.gitignore`). Cada persona que clone el repo debe crear su propio `.env` a partir de `.env.example`.

---

## Usuarios de prueba

Después de ejecutar `php artisan db:seed`:

| Rol | Email / usuario | Contraseña | Uso |
|-----|-----------------|------------|-----|
| Profesional | `profesional@test.com` | `123456` | Entrar como **profesional** → gestionar casos |
| Cliente (seeder) | `test@example.com` o el primer usuario creado | `password123` | Entrar como **cliente** |
| Cliente creado desde modal | el email que registres | `temporal123` | Contraseña temporal al crear cliente |

En el login, el campo **usuario** acepta email o nombre. Debes elegir el **tipo de usuario** correcto (cliente / profesional) para que redirija al portal adecuado.

---

## Rutas principales

| Método | Ruta | Nombre | Descripción |
|--------|------|--------|-------------|
| GET | `/` | `login` | Formulario de inicio de sesión |
| POST | `/login` | `login.post` | Procesar login |
| POST | `/logout` | `logout` | Cerrar sesión |
| GET | `/portal-cliente` | `portal.cliente` | Portal del cliente |
| GET | `/casos` | `casos.index` | Lista de casos (profesional) |
| GET | `/casos/create` | `casos.create` | Formulario nuevo caso |
| POST | `/casos` | `casos.store` | Guardar caso |
| GET | `/casos/{id}` | `casos.show` | Detalle del caso |
| GET | `/casos/{id}/edit` | `casos.edit` | Editar caso |
| PUT/PATCH | `/casos/{id}` | `casos.update` | Actualizar caso |
| DELETE | `/casos/{id}` | `casos.destroy` | Eliminar caso |
| POST | `/clientes` | `clientes.store` | Crear cliente (JSON) |

> El middleware `auth` en las rutas de casos puede activarse cuando quieras exigir sesión obligatoria en todas las acciones del CRUD.

---

## Base de datos

### Tabla `users`

Usuarios del sistema (clientes y profesionales comparten la misma tabla).

### Tabla `casos`

| Campo | Descripción |
|-------|-------------|
| `codigo_caso` | Identificador único (ej. `C-001`) |
| `abogado_asignado` | Nombre del abogado |
| `tipo_proceso` | Ej. Divorcio, Herencia |
| `estado` | En proceso, Completado, En revisión, Pendiente |
| `progreso` | 0–100 |
| `fecha_inicio` | Fecha de inicio del caso |
| `cliente_id` | FK → `users` |
| `profesional_id` | FK → `users` (dueño del caso en el portal) |

---

## Subir el proyecto a GitHub

Este repositorio ya está conectado a:

**https://github.com/repantac/proyecto-laravel-fase3**

Si trabajas en otra máquina o quieres repetir el proceso desde cero, los pasos generales son:

### 1. Cuenta y repositorio en GitHub

1. Crear cuenta en [github.com](https://github.com) si no tienes una.
2. En GitHub: **New repository** → nombre (ej. `proyecto-laravel`) → **Create repository** (sin README si ya tienes uno local).

### 2. Tener Git instalado

En Mac, en Terminal:

```bash
git --version
```

Si no está instalado, Git te pedirá instalar las Command Line Tools de Xcode.

### 3. En la carpeta del proyecto

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/proyecto-laravel
```

Ver estado:

```bash
git status
```

Guardar cambios (ejemplo):

```bash
git add README.md
git add .
git commit -m "Documentación del proyecto y últimos ajustes"
```

### 4. Enlazar con GitHub (solo la primera vez)

Si aún no hay `origin`:

```bash
git remote add origin https://github.com/TU_USUARIO/TU_REPOSITORIO.git
```

En este proyecto ya existe:

```bash
git remote -v
```

### 5. Subir al remoto

```bash
git push -u origin main
```

GitHub pedirá **usuario** y **contraseña**. La contraseña ya no es la de la cuenta: debes usar un **Personal Access Token** (Settings → Developer settings → Personal access tokens → Generate new token).

### Si Git rechaza el `push` (historiales distintos)

A veces el repositorio en GitHub se creó subiendo archivos por la web y el historial local es diferente. Si estás segura de que **tu copia en la Mac es la correcta** y nadie más colabora en el repo:

```bash
git push -u origin main --force
```

⚠️ `--force` sobrescribe lo que hay en GitHub. Úsalo solo si entiendes que reemplazarás la versión remota.

### Qué NO subir a GitHub

- `.env` (contraseñas y claves)
- Carpeta `vendor/` (se regenera con `composer install`)
- Base de datos local

Todo eso ya está contemplado en `.gitignore`.

---

## Licencia

Proyecto educativo. El framework [Laravel](https://laravel.com) se distribuye bajo licencia [MIT](https://opensource.org/licenses/MIT).

---

## Autor

Desarrollado como proyecto de aprendizaje de Laravel y desarrollo web.

Repositorio: [repantac/proyecto-laravel-fase3](https://github.com/repantac/proyecto-laravel-fase3)
