<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración básica del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Caso - Te Apoyamos S.A.S.</title>
    
    <!-- Bootstrap CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS desde CDN (necesario para el modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
            <div class="col-md-8">
                <!-- Tarjeta del formulario -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Editar Caso: {{ $caso->codigo_caso }}</h4>
                    </div>
                    <div class="card-body">
                        <!-- Mostrar errores de validación si existen (con letra más grande) -->
                        @if($errors->any())
                            <div class="alert alert-danger alert-large">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Formulario para actualizar un caso -->
                        <form action="{{ route('casos.update', $caso->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Campo: Código del caso (solo lectura, no se puede modificar) -->
                            <div class="mb-3">
                                <label for="codigo_caso" class="form-label">Código del Caso</label>
                                <input type="text" class="form-control" id="codigo_caso" 
                                       value="{{ $caso->codigo_caso }}" 
                                       readonly disabled class="input-readonly">
                                <small class="form-text text-muted">El código del caso no se puede modificar</small>
                            </div>

                            <!-- Campo: Abogado asignado (lista desplegable) -->
                            <div class="mb-3">
                                <label for="abogado_asignado" class="form-label">Abogado Asignado</label>
                                <select class="form-select" id="abogado_asignado" name="abogado_asignado" required>
                                    <option value="">Seleccione un abogado</option>
                                    <option value="Dr. María González" {{ old('abogado_asignado', $caso->abogado_asignado) == 'Dr. María González' ? 'selected' : '' }}>Dr. María González</option>
                                    <option value="Dr. Carlos Ruiz" {{ old('abogado_asignado', $caso->abogado_asignado) == 'Dr. Carlos Ruiz' ? 'selected' : '' }}>Dr. Carlos Ruiz</option>
                                    <option value="Dr. Laura Torres" {{ old('abogado_asignado', $caso->abogado_asignado) == 'Dr. Laura Torres' ? 'selected' : '' }}>Dr. Laura Torres</option>
                                    <option value="Dr. Ana Martínez" {{ old('abogado_asignado', $caso->abogado_asignado) == 'Dr. Ana Martínez' ? 'selected' : '' }}>Dr. Ana Martínez</option>
                                    <option value="Dr. Pedro Sánchez" {{ old('abogado_asignado', $caso->abogado_asignado) == 'Dr. Pedro Sánchez' ? 'selected' : '' }}>Dr. Pedro Sánchez</option>
                                </select>
                            </div>

                            <!-- Campo: Tipo de proceso (lista desplegable) -->
                            <div class="mb-3">
                                <label for="tipo_proceso" class="form-label">Tipo de Proceso</label>
                                <select class="form-select" id="tipo_proceso" name="tipo_proceso" required>
                                    <option value="">Seleccione un tipo de proceso</option>
                                    <option value="Divorcio" {{ old('tipo_proceso', $caso->tipo_proceso) == 'Divorcio' ? 'selected' : '' }}>Divorcio</option>
                                    <option value="Contrato de Compraventa" {{ old('tipo_proceso', $caso->tipo_proceso) == 'Contrato de Compraventa' ? 'selected' : '' }}>Contrato de Compraventa</option>
                                    <option value="Herencia" {{ old('tipo_proceso', $caso->tipo_proceso) == 'Herencia' ? 'selected' : '' }}>Herencia</option>
                                    <option value="Testamento" {{ old('tipo_proceso', $caso->tipo_proceso) == 'Testamento' ? 'selected' : '' }}>Testamento</option>
                                    <option value="Pensión Alimenticia" {{ old('tipo_proceso', $caso->tipo_proceso) == 'Pensión Alimenticia' ? 'selected' : '' }}>Pensión Alimenticia</option>
                                    <option value="Sucesión" {{ old('tipo_proceso', $caso->tipo_proceso) == 'Sucesión' ? 'selected' : '' }}>Sucesión</option>
                                    <option value="Contrato de Arrendamiento" {{ old('tipo_proceso', $caso->tipo_proceso) == 'Contrato de Arrendamiento' ? 'selected' : '' }}>Contrato de Arrendamiento</option>
                                </select>
                            </div>

                            <!-- Campo: Estado -->
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="En proceso" {{ old('estado', $caso->estado) == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                                    <option value="Completado" {{ old('estado', $caso->estado) == 'Completado' ? 'selected' : '' }}>Completado</option>
                                    <option value="En revisión" {{ old('estado', $caso->estado) == 'En revisión' ? 'selected' : '' }}>En revisión</option>
                                    <option value="Pendiente" {{ old('estado', $caso->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                </select>
                            </div>

                            <!-- Campo: Progreso -->
                            <div class="mb-3">
                                <label for="progreso" class="form-label">Progreso (%)</label>
                                <input type="number" class="form-control" id="progreso" name="progreso" 
                                       value="{{ old('progreso', $caso->progreso) }}" 
                                       min="0" max="100" required>
                                <small class="form-text text-muted">Valor entre 0 y 100</small>
                            </div>

                            <!-- Campo: Fecha de inicio -->
                            <div class="mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" 
                                       value="{{ old('fecha_inicio', $caso->fecha_inicio) }}" required>
                            </div>

                            <!-- Campo: Cliente (obligatorio) -->
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="cliente_id" class="form-label mb-0">Cliente</label>
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCrearCliente">
                                        + Crear nuevo cliente
                                    </button>
                                </div>
                                <select class="form-select" id="cliente_id" name="cliente_id" required>
                                    <option value="">Seleccione un cliente</option>
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{ $user->id }}" {{ old('cliente_id', $caso->cliente_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Botones de acción -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('casos.index') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Actualizar Caso</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para crear nuevo cliente -->
    <div class="modal fade" id="modalCrearCliente" tabindex="-1" aria-labelledby="modalCrearClienteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearClienteLabel">Crear Nuevo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCrearCliente">
                    <div class="modal-body">
                        <!-- Mensaje de error si existe -->
                        <div id="errorCliente" class="alert alert-danger d-none alert-dismissible fade show alert-large">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        
                        <!-- Mensaje de éxito si existe -->
                        <div id="successCliente" class="alert alert-success d-none alert-dismissible fade show alert-large">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>

                        <!-- Campo: Nombre del cliente -->
                        <div class="mb-3">
                            <label for="cliente_name" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="cliente_name" name="name" required>
                        </div>

                        <!-- Campo: Email del cliente -->
                        <div class="mb-3">
                            <label for="cliente_email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="cliente_email" name="email" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript para manejar la creación de clientes -->
    <script>
        document.getElementById('formCrearCliente').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Oculta mensajes anteriores
            document.getElementById('errorCliente').classList.add('d-none');
            document.getElementById('successCliente').classList.add('d-none');
            
            // Obtiene los datos del formulario
            const formData = new FormData(this);
            
            // Envía la petición al servidor
            fetch('{{ route("clientes.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Muestra mensaje de éxito
                    const successDiv = document.getElementById('successCliente');
                    successDiv.textContent = data.message;
                    successDiv.classList.remove('d-none');
                    
                    // Agrega el nuevo cliente al select
                    const select = document.getElementById('cliente_id');
                    const option = document.createElement('option');
                    option.value = data.cliente.id;
                    option.textContent = data.cliente.name + ' (' + data.cliente.email + ')';
                    option.selected = true;
                    select.appendChild(option);
                    
                    // Limpia el formulario
                    this.reset();
                    
                    // Auto-dismiss del mensaje de éxito después de 4 segundos
                    setTimeout(() => {
                        successDiv.classList.add('d-none');
                    }, 4000);
                    
                    // Cierra el modal después de 1 segundo
                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('modalCrearCliente'));
                        modal.hide();
                    }, 1000);
                } else {
                    // Muestra errores si los hay
                    let errorMsg = 'Error al crear el cliente.';
                    if (data.errors) {
                        errorMsg = Object.values(data.errors).flat().join(', ');
                    }
                    const errorDiv = document.getElementById('errorCliente');
                    errorDiv.textContent = errorMsg;
                    errorDiv.classList.remove('d-none');
                    
                    // Auto-dismiss del mensaje de error después de 4 segundos
                    setTimeout(() => {
                        errorDiv.classList.add('d-none');
                    }, 4000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const errorDiv = document.getElementById('errorCliente');
                errorDiv.textContent = 'Error al crear el cliente. Por favor intente nuevamente.';
                errorDiv.classList.remove('d-none');
                
                // Auto-dismiss del mensaje de error después de 4 segundos
                setTimeout(() => {
                    errorDiv.classList.add('d-none');
                }, 4000);
            });
        });

        // Limpia los mensajes cuando se cierra el modal
        document.getElementById('modalCrearCliente').addEventListener('hidden.bs.modal', function() {
            document.getElementById('errorCliente').classList.add('d-none');
            document.getElementById('successCliente').classList.add('d-none');
            document.getElementById('formCrearCliente').reset();
        });
    </script>
</body>
</html>

