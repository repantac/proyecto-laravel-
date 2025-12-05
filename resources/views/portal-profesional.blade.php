<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración básica del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Profesional - Te Apoyamos S.A.S.</title>
    
    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS desde CDN (necesario para los alerts) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Fuentes desde Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container-fluid">
        <!-- Fila principal -->
        <div class="row">
            <!-- Sidebar de navegación -->
            <div class="col-md-2 text-white sidebar d-flex flex-column">
                <div class="p-4 d-flex flex-column sidebar-inner">
                    <!-- Logo de la empresa -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('css/logocuadrado.png') }}" alt="Logo Te Apoyamos S.A.S." class="mb-3 sidebar-logo">
                    </div>
                    
                    <!-- Menú de navegación centrado -->
                    <div class="d-flex flex-column justify-content-center align-items-center flex-grow-1 sidebar-menu-container">
                        <nav class="nav flex-column text-center">
                            <a class="nav-link active text-white py-3" href="#casos">📁 Mis Casos</a>
                            <a class="nav-link text-white py-3" href="#perfil">👤 Perfil</a>
                            <a class="nav-link text-white py-3" href="#archivos">📎 Archivos</a>
                        </nav>
                        
                        <!-- Botón de cerrar sesión -->
                        <div class="mt-4 text-center">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Cerrar Sesión</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contenido principal -->
            <div class="col-md-10 py-5">
                <div class="p-4">
                    <!-- Encabezado del portal -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-5">Te damos la bienvenida, {{ Auth::user()->name ?? 'Profesional' }}</h3>
                        <!-- Botón para crear un nuevo caso -->
                        <a href="{{ route('casos.create') }}" class="btn btn-primary mb-5">Nuevo Caso</a>
                    </div>

                    <!-- Contenedor para mensajes (se oculta completamente cuando no hay mensajes) -->
                    @if(session('success') || session('error'))
                        <div id="mensajes-container" class="mb-3">
                            <!-- Mensaje de éxito o error si existe (con auto-dismiss después de 4 segundos) -->
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success-portal">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                                <script>
                                    setTimeout(function() {
                                        const alert = document.getElementById('alert-success-portal');
                                        const container = document.getElementById('mensajes-container');
                                        if (alert) {
                                            alert.style.display = 'none';
                                        }
                                        if (container) {
                                            setTimeout(function() {
                                                if (!container.querySelector('.alert:not([style*="display: none"])')) {
                                                    container.style.display = 'none';
                                                }
                                            }, 100);
                                        }
                                    }, 4000);
                                </script>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-error-portal">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                                <script>
                                    setTimeout(function() {
                                        const alert = document.getElementById('alert-error-portal');
                                        const container = document.getElementById('mensajes-container');
                                        if (alert) {
                                            alert.style.display = 'none';
                                        }
                                        if (container) {
                                            setTimeout(function() {
                                                if (!container.querySelector('.alert:not([style*="display: none"])')) {
                                                    container.style.display = 'none';
                                                }
                                            }, 100);
                                        }
                                    }, 4000);
                                </script>
                            @endif
                        </div>
                    @endif
                    
                    <!-- Resumen de casos gestionados -->
                    <div class="card mx-auto mt-5 card-casos">
                        <div class="card-header">
                            <h5 class="mb-0">Casos asignados</h5>
                        </div>
                        <div class="card-body">
                            <!-- Verifica si hay casos en la base de datos -->
                            @if($casos->count() > 0)
                                <!-- Tabla de casos gestionados con datos reales de la base de datos -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Cliente</th>
                                                <th>Tipo de proceso</th>
                                                <th>Fecha de inicio</th>
                                                <th>Estado</th>
                                                <th>Progreso</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Itera sobre cada caso de la base de datos -->
                                            @foreach($casos as $caso)
                                                <tr>
                                                    <td>{{ $caso->codigo_caso }}</td>
                                                    <td>{{ $caso->cliente ? $caso->cliente->name : 'Sin asignar' }}</td>
                                                    <td>{{ $caso->tipo_proceso }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($caso->fecha_inicio)->format('d/m/Y') }}</td>
                                                    <td>
                                                        <span class="badge 
                                                            @if($caso->estado == 'Completado') bg-success
                                                            @elseif($caso->estado == 'En proceso') bg-primary
                                                            @elseif($caso->estado == 'En revisión') bg-warning
                                                            @else bg-secondary
                                                            @endif">
                                                            {{ $caso->estado }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar 
                                                                @if($caso->progreso == 100) bg-success
                                                                @elseif($caso->progreso >= 50) bg-warning
                                                                @else bg-info
                                                                @endif" 
                                                                role="progressbar" 
                                                                style="width: {{ $caso->progreso }}%" 
                                                                aria-valuenow="{{ $caso->progreso }}" 
                                                                aria-valuemin="0" 
                                                                aria-valuemax="100">
                                                                {{ $caso->progreso }}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <!-- Botón para ver detalles del caso (más pequeño) -->
                                                            <a href="{{ route('casos.show', $caso->id) }}" class="btn btn-xs btn-primary">Detalles</a>
                                                            <!-- Botón para editar el caso (más pequeño) -->
                                                            <a href="{{ route('casos.edit', $caso->id) }}" class="btn btn-xs btn-success">Editar</a>
                                                            <!-- Formulario para eliminar el caso (más pequeño) -->
                                                            <form action="{{ route('casos.destroy', $caso->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este caso?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <!-- Mensaje cuando no hay casos en la base de datos -->
                                <div class="alert alert-info text-center">
                                    <p class="mb-0">No hay casos registrados aún. <a href="{{ route('casos.create') }}">Crea tu primer caso</a></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>