<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración básica del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Te Apoyamos S.A.S. - Acceso al Portal</title>
    
    <!-- Bootstrap CSS desde CDN para estilos responsivos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Bootstrap JS desde CDN (necesario para los alerts) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- La hoja de CSS personalizada -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 

    <!-- Fuentes desde Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar transparente -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent pt-4">
            <div class="container">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('css/logoprovisionalnegro.png') }}" alt="Logo Te Apoyamos S.A.S." class="logo-header">
                </div>
            </div>
        </nav>
    </header>
    <!-- Contenido principal -->
    <div>
        <div class="container main-content">
        <!-- Fila con contenido centrado -->
            <div class="row justify-content-center">
            <!-- Columna de 6 unidades en pantallas medianas y grandes -->
            <div class="col-md-6">
                <!-- Título del formulario -->
                <h1 class="login-title text-center">Bienvenido</h1>

                <!-- Mostrar mensaje de éxito si existe (con auto-dismiss después de 4 segundos) -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <script>
                        setTimeout(function() {
                            const alert = document.getElementById('alert-success');
                            if (alert) {
                                alert.style.display = 'none';
                            }
                        }, 4000);
                    </script>
                @endif

                <!-- Mostrar mensaje de error si las credenciales son incorrectas (con auto-dismiss después de 4 segundos) -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-error">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <script>
                        setTimeout(function() {
                            const alert = document.getElementById('alert-error');
                            if (alert) {
                                alert.style.display = 'none';
                            }
                        }, 4000);
                    </script>
                @endif

                <!-- Formulario de inicio de sesión -->
                <form action="/login" method="POST" class="login-form-content">
                    <!-- Token de seguridad de Laravel -->
                    @csrf

                    <!-- Campo de tipo de usuario -->
                    <div class="mb-3">
                        <label for="tipo_usuario" class="form-label">Tipo de Usuario:</label>
                        <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                            <option value="">Seleccione su tipo de usuario</option>
                            <option value="cliente">Cliente</option>
                            <option value="profesional">Profesional</option>
                        </select>
                    </div>

                    <!-- Campo de usuario -->
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su usuario" required>
                    </div>

                    <!-- Campo de contraseña -->
                    <div class="mb-3">
                        <label for="clave" class="form-label">Clave:</label>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Ingrese su clave" required>
                    </div>
                    
                    <!-- Checkbox Recuérdame -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="recuerdame" name="recuerdame">
                        <label class="form-check-label" for="recuerdame">
                            Recuérdame
                        </label>
                    </div>

                    <!-- Botón de envío -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <!-- Columna Izquierda: Logo y Nombre -->
                <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ asset('css/logocuadrado.png') }}" alt="Logo Te Apoyamos S.A.S." class="footer-logo">
                </div>

                <!-- Columna Central: Redes Sociales -->
                <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                    <h4 class="footer-section-title">Síguenos en:</h4>
                    <div class="d-flex gap-4 justify-content-center">
                        <a href="#" class="footer-social-link text-white text-decoration-none" aria-label="LinkedIn">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="#" class="footer-social-link text-white text-decoration-none" aria-label="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="footer-social-link text-white text-decoration-none" aria-label="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Columna Derecha: Reconocimientos -->
                <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                    <h4 class="footer-section-title">Reconocimientos:</h4>
                    <div class="footer-recognitions">
                        <img src="{{ asset('css/reconocimiento1.svg') }}" alt="Chambers and Partners" class="footer-recognition-img">
                        <img src="{{ asset('css/reconocimiento2.svg') }}" alt="The Legal 500" class="footer-recognition-img">
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>