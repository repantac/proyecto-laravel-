<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración básica del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Cliente - Te Apoyamos S.A.S.</title>
    
    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

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
                        <img src="{{ asset('css/logoprovisional.png') }}" alt="Logo Te Apoyamos S.A.S." class="mb-3">
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
                        <h3>Te damos la bienvenida, {{ session('usuario') }}</h3>
                    </div>
                    
                    <!-- Resumen de casos del cliente -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Resumen de tus Procesos</h5>
                        </div>
                        <div class="card-body">
                            <!-- Tabla de casos del cliente -->
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID del Caso</th>
                                            <th>Abogado Asignado</th>
                                            <th>Tipo de Proceso</th>
                                            <th>Estado</th>
                                            <th>Progreso del Caso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>C-001</td>
                                            <td>Dr. María González</td>
                                            <td>Divorcio</td>
                                            <td>En proceso</td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>C-002</td>
                                            <td>Dr. Carlos Ruiz</td>
                                            <td>Contrato de Compraventa</td>
                                            <td>Completado</td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>C-003</td>
                                            <td>Dr. Laura Torres</td>
                                            <td>Herencia</td>
                                            <td>En revisión</td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
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
</html>
