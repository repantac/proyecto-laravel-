<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración básica del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Caso - Te Apoyamos S.A.S.</title>
    
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Tarjeta de detalles del caso -->
                <div class="card">
                    <div class="card-header card-header-detalles">
                        <h4 class="mb-0">Detalles del Caso: {{ $caso->codigo_caso }}</h4>
                    </div>
                    <div class="card-body">
                        <!-- Tabla con los detalles del caso -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="col-md-3">Código del Caso</th>
                                        <td>{{ $caso->codigo_caso }}</td>
                                    </tr>
                                    <tr>
                                        <th>Cliente</th>
                                        <td>{{ $caso->cliente ? $caso->cliente->name : 'Sin asignar' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tipo de Proceso</th>
                                        <td>{{ $caso->tipo_proceso }}</td>
                                    </tr>
                                    <tr>
                                        <th>Abogado Asignado</th>
                                        <td>{{ $caso->abogado_asignado }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de Inicio</th>
                                        <td>{{ \Carbon\Carbon::parse($caso->fecha_inicio)->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Estado</th>
                                        <td>
                                            <span class="badge 
                                                @if($caso->estado == 'Completado') bg-success
                                                @elseif($caso->estado == 'En proceso') bg-primary
                                                @elseif($caso->estado == 'En revisión') bg-warning
                                                @else bg-secondary
                                                @endif" class="badge-normal">
                                                {{ $caso->estado }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Progreso</th>
                                        <td>
                                            <div class="progress progress-detail">
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
                                    </tr>
                                    <tr>
                                        <th>Fecha de Creación</th>
                                        <td>{{ \Carbon\Carbon::parse($caso->created_at)->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Última Actualización</th>
                                        <td>{{ \Carbon\Carbon::parse($caso->updated_at)->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Sección de Observaciones -->
                        <div class="mt-4">
                            <h5 class="mb-3">Observaciones</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <p class="text-muted mb-0">
                                        <em>Esta sección estará disponible próximamente para agregar observaciones sobre el caso.</em>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Sección de Archivos -->
                        <div class="mt-4">
                            <h5 class="mb-3">Archivos del Caso</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <p class="text-muted mb-0">
                                        <em>Esta sección estará disponible próximamente para cargar y gestionar archivos relacionados con el caso.</em>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Botones de acción -->
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('casos.index') }}" class="btn btn-secondary">Volver a la lista</a>
                            <div>
                                <a href="{{ route('casos.edit', $caso->id) }}" class="btn btn-success">Editar Caso</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

