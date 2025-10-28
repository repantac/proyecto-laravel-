<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración básica del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Profesional - Te Apoyamos S.A.S.</title>
    
    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">

    <!-- Fuentes desde Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container-fluid">
        <!-- Fila principal -->
        <div class="row">
            <!-- Sidebar de navegación -->
            <div class="col-md-3 bg-dark text-white sidebar d-flex flex-column" style="min-height: 100vh;">
                <div class="p-5">
                    <!-- Logo de la empresa -->
                    <div class="text-center mb-5 p-5">
                        <img src="<?php echo e(asset('css/logoprovisional.png')); ?>" alt="Logo Te Apoyamos S.A.S." class="mb-3">
                    </div>
                    
                    <!-- Menú de navegación -->
                    <nav class="nav flex-column flex-grow-1">
                        <div class="mb-4 text-center">
                            <a class="nav-link active text-white py-4" href="#casos">📁 Mis Casos</a>
                            <a class="nav-link text-white py-4" href="#perfil">👤 Perfil de Usuario</a>
                            <a class="nav-link text-white py-4" href="#archivos">📎 Archivos</a>
                        </div>
                        
                        <div class="mt-auto py-5 text-center">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <a href="/" class="btn btn-danger btn-sm">Cerrar Sesión</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            
            <!-- Contenido principal -->
            <div class="col-md-9 py-5">
                <div class="p-4">
                    <!-- Encabezado del portal -->
                    <div class="d-flex justify-content-between align-items-center mb-4 py-5">
                        <h3>Te damos la bienvenida, <?php echo e(session('usuario')); ?></h3>
                    </div>
                    
                    <!-- Resumen de casos gestionados -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Casos asignados</h5>
                        </div>
                        <div class="card-body">
                            <!-- Tabla de casos gestionados -->
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cliente</th>
                                            <th>Tipo de proceso</th>
                                            <th>Fecha de inicio</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>001</td>
                                            <td>Juan Pérez</td>
                                            <td>Divorcio</td>
                                            <td>15/10/2025</td>
                                            <td>En proceso</td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <div class="p-2">
                                                    <button class="btn btn-sm btn-primary">Detalles</button>
                                                </div>
                                                <div class="p-2">
                                                    <button class="btn btn-sm btn-success">Actualizar</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>002</td>
                                            <td>Ana López</td>
                                            <td>Contrato</td>
                                            <td>10/10/2025</td>
                                            <td>Completado</td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <div class="p-2">
                                                    <button class="btn btn-sm btn-primary">Detalles</button>
                                                </div>
                                                <div class="p-2">
                                                    <button class="btn btn-sm btn-success">Actualizar</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>003</td>
                                            <td>Pedro Martínez</td>
                                            <td>Herencia</td>
                                            <td>20/10/2025</td>
                                            <td>En revisión</td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <div class="p-2">
                                                    <button class="btn btn-sm btn-primary">Detalles</button>
                                                </div>
                                                <div class="p-2">
                                                    <button class="btn btn-sm btn-success">Actualizar</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/proyecto-laravel/resources/views/portal-profesional.blade.php ENDPATH**/ ?>