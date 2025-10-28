<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración básica del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    
    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container mt-5">
        <!-- Fila centrada -->
        <div class="row justify-content-center">
            <!-- Columna de 6 unidades en pantallas medianas y grandes -->
            <div class="col-md-6">
                <!-- Tarjeta de Bootstrap para el mensaje de bienvenida -->
                <div class="card">
                    <!-- Encabezado de la tarjeta -->
                    <div class="card-header text-center">
                        <h1 class="h3">¡Bienvenido!</h1>
                    </div>
                    <!-- Cuerpo de la tarjeta -->
                    <div class="card-body text-center">
                        <!-- Mensaje de bienvenida usando la variable de sesión -->
                        <h2 class="mb-3"><?php echo e(session('usuario')); ?></h2>
                        <p class="mb-4">Has iniciado sesión correctamente.</p>
                        <!-- Botón para cerrar sesión -->
                        <a href="/" class="btn btn-danger">Cerrar Sesión</a>
                    </div>
                </div>
                <!-- Pie de página -->
                <footer class="text-center mt-4">
                    <p class="text-muted">Ejercicio - Frameworks para desarrollo web</p>
                    <p class="text-muted">Por: Rosa Elena Panta Correa</p>
                    <p class="text-muted">Grupo: 3</p>
                </footer>
                </footer>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/proyecto-laravel/resources/views/bienvenida.blade.php ENDPATH**/ ?>