<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración básica del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Te Apoyamos S.A.S. - Acceso al Portal</title>
    
    <!-- Bootstrap CSS desde CDN para estilos responsivos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- La hoja de CSS personalizada -->
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>"> 

    <!-- Fuentes desde Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar transparente -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
            <div class="container">
                <div class="text-center">
                        <img src="<?php echo e(asset('css/logoprovisionalnegro.png')); ?>" alt="Logo Te Apoyamos S.A.S.">
                        <span class="fw-bold p-4 ">Te Apoyamos S.A.S.</span>
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Contenedor principal de Bootstrap -->
    <div class="container">
        <!-- Fila centrada -->
        <div class="row justify-content-center">
            <!-- Columna de 6 unidades en pantallas medianas y grandes -->
            <div class="col-md-6">
                <!-- Tarjeta de Bootstrap para el formulario -->
                <div class="card">
                    <!-- Encabezado de la tarjeta -->
                    <div class="card-header text-center">
                        <h1 class="h3 mb-2 fw-bold">Bienvenido</h1>
                    </div>
                    <!-- Cuerpo de la tarjeta -->
                    <div class="card-body">
                        <!-- Mostrar mensaje de error si las credenciales son incorrectas -->
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>

                        <!-- Formulario de inicio de sesión -->
                        <form action="/login" method="POST">
                            <!-- Token de seguridad de Laravel -->
                            <?php echo csrf_field(); ?>

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
                            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                        </form>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="text-center mt-4">
                    <p class="text-muted mb-1 small">Ejercicio - Frameworks para desarrollo web</p>
                    <p class="text-muted mb-1 small">Por: Rosa Elena Panta Correa, Argeis Rengifo Córdoba </p>
                    <p class="text-muted mb-1 small">Grupo: 3</p>
                </footer>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/proyecto-laravel/resources/views/inicio.blade.php ENDPATH**/ ?>