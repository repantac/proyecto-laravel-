# Contexto Completo del Proyecto - Sistema de Gestión de Casos Legales

## Información General del Proyecto

**Nombre del Proyecto:** Sistema de Gestión de Casos Legales para "Te Apoyamos S.A.S."

**Framework Utilizado:** Laravel (PHP)

**Entorno de Desarrollo:** XAMPP (Apache, MySQL, PHP)

**Objetivo:** Desarrollar un sistema web que permita a una firma de abogados gestionar casos legales, con dos portales diferenciados: uno para profesionales (abogados) y otro para clientes.

---

## Estructura del Proyecto

### Framework y Tecnologías

- **Backend:** Laravel (PHP)
- **Base de Datos:** MySQL (a través de XAMPP)
- **Frontend:** HTML, CSS, JavaScript, Bootstrap 5
- **Templating:** Blade (motor de plantillas de Laravel)
- **ORM:** Eloquent (ORM de Laravel)
- **Fuentes:** Google Fonts (Libre Baskerville para títulos, Montserrat para contenido)
- **Iconos:** Bootstrap Icons

### Estructura de Carpetas Principales

```
proyecto-laravel/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php
│   │       ├── CasoController.php
│   │       ├── ClienteController.php
│   │       └── Controller.php
│   └── Models/
│       ├── Caso.php
│       └── User.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2025_10_25_205211_create_postulaciones_table.php
│   │   ├── 2025_11_15_100000_create_casos_table.php
│   │   └── 2025_11_15_100001_add_profesional_id_to_casos_table.php
│   └── seeders/
│       ├── CasoSeeder.php
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── inicio.blade.php
│       ├── portal-cliente.blade.php
│       ├── portal-profesional.blade.php
│       └── casos/
│           ├── create.blade.php
│           ├── edit.blade.php
│           └── show.blade.php
├── public/
│   └── css/
│       └── styles.css
└── routes/
    └── web.php
```

---

## Fases del Proyecto

### Fase 1: Análisis y Diseño Inicial

**Requisitos:**
- Análisis del caso de estudio
- Diseño de la estructura básica
- Definición de requerimientos funcionales y no funcionales

**Implementación:**
- Se definió el sistema para gestionar casos legales
- Se establecieron dos tipos de usuarios: clientes y profesionales
- Se diseñó la estructura inicial de la base de datos

### Fase 2: Configuración del Entorno y Estructura Base

**Requisitos:**
- Configuración del entorno de desarrollo (Laravel)
- Creación de la estructura base del proyecto
- Configuración de rutas básicas

**Implementación:**
- Instalación y configuración de Laravel
- Configuración de XAMPP para MySQL
- Creación de las vistas iniciales (inicio, portal-cliente, portal-profesional)
- Implementación del sistema de autenticación básico

### Fase 3: Implementación de Autenticación

**Requisitos:**
- Sistema de login funcional
- Diferenciación entre tipos de usuarios (cliente/profesional)
- Redirección según tipo de usuario

**Implementación:**
- Controlador `AuthController` con métodos:
  - `showLoginForm()`: Muestra el formulario de login
  - `login()`: Procesa el inicio de sesión
  - `logout()`: Cierra la sesión
- Vista `inicio.blade.php` con formulario de login
- Validación de credenciales
- Redirección a portales según tipo de usuario

### Fase 4: Implementación de Base de Datos y CRUD

**Requisitos:**
- Diseño e implementación de base de datos
- Operaciones CRUD (Create, Read, Update, Delete) para casos
- Relaciones entre tablas

**Implementación:**

#### Migraciones Creadas:

1. **create_users_table.php**
   - Tabla de usuarios (clientes y profesionales)
   - Campos: id, name, email, password, tipo_usuario, timestamps

2. **create_casos_table.php**
   - Tabla principal
   - Campos: id, codigo_caso, abogado_asignado, tipo_proceso, estado, progreso, fecha_inicio, cliente_id, timestamps

3. **add_profesional_id_to_casos_table.php**
   - Agrega el campo `profesional_id` a la tabla casos
   - Relaciona cada caso con el profesional que lo gestiona

4. **create_postulaciones_table.php**
   - Tabla para postulaciones (funcionalidad futura)

#### Modelos Creados:

1. **User.php**
   - Modelo para usuarios (clientes y profesionales)
   - Campos fillable: name, email, password
   - Campos hidden: password, remember_token

2. **Caso.php**
   - Modelo para casos legales
   - Campos fillable: codigo_caso, abogado_asignado, tipo_proceso, estado, progreso, fecha_inicio, cliente_id, profesional_id
   - Relaciones:
     - `cliente()`: Relación BelongsTo con User (cliente)
     - `profesional()`: Relación BelongsTo con User (profesional)
   - Métodos estáticos:
     - `generarCodigoCaso()`: Genera códigos automáticos (C-001, C-002, etc.)
     - `estadosValidos()`: Retorna array con estados válidos

#### Controladores Creados:

1. **CasoController.php** (CRUD completo)
   - `index()`: Lista todos los casos del profesional autenticado
   - `create()`: Muestra formulario para crear caso
   - `store()`: Guarda un nuevo caso en la base de datos
   - `show($id)`: Muestra detalles de un caso específico
   - `edit($id)`: Muestra formulario para editar caso
   - `update($id)`: Actualiza un caso existente
   - `destroy($id)`: Elimina un caso

2. **ClienteController.php**
   - `store()`: Crea un nuevo cliente desde un modal AJAX

#### Vistas Creadas:

1. **portal-profesional.blade.php**
   - Lista de casos asignados al profesional
   - Tabla con: Código, Cliente, Tipo de proceso, Fecha de inicio, Estado, Progreso, Acciones
   - Botón "Nuevo Caso"
   - Sidebar con menú de navegación

2. **casos/create.blade.php**
   - Formulario para crear nuevo caso
   - Campos: Código (auto-generado), Abogado asignado, Tipo de proceso, Estado, Progreso, Fecha de inicio, Cliente
   - Modal para crear cliente nuevo (AJAX)

3. **casos/edit.blade.php**
   - Formulario para editar caso existente
   - Mismos campos que create, pero pre-llenados
   - Modal para crear cliente nuevo (AJAX)

4. **casos/show.blade.php**
   - Vista de detalles del caso
   - Muestra toda la información del caso en formato tabla
   - Secciones para observaciones y archivos (preparadas para futuro)

#### Seeders Creados:

1. **CasoSeeder.php**
   - Crea casos de prueba para desarrollo
   - Crea usuarios de prueba (cliente y profesional)
   - Genera 3 casos de ejemplo con diferentes estados

2. **DatabaseSeeder.php**
   - Ejecuta todos los seeders
   - Crea usuario de prueba base

### Fase 5: Reflexión y Sustentación

**Requisitos:**
- Video de sustentación (máximo 9-10 minutos)
- Documento PDF con enlace al video
- Exposición de:
  - Configuración del entorno de desarrollo
  - Implementación de código fuente (línea de proceso desde Laravel)
  - Manipulación de información a través de bases de datos
  - Funcionalidad del proyecto y cumplimiento de requerimientos

---

## Funcionalidades Implementadas

### Sistema de Autenticación

- Login con validación de credenciales
- Diferenciación entre cliente y profesional
- Redirección automática según tipo de usuario
- Cierre de sesión
- Mensajes de error y éxito

### Portal de Profesionales

- **Listado de casos:** Tabla con todos los casos asignados al profesional autenticado
- **Crear caso:** Formulario completo con validación
  - Generación automática de código de caso (C-001, C-002, etc.)
  - Selección de cliente (con opción de crear nuevo cliente via modal AJAX)
  - Campos: Abogado asignado, Tipo de proceso, Estado, Progreso, Fecha de inicio
- **Editar caso:** Modificación de casos existentes
- **Ver detalles:** Vista detallada de cada caso
- **Eliminar caso:** Eliminación con confirmación
- **Filtrado:** Solo muestra casos del profesional autenticado

### Portal de Clientes

- Vista básica preparada para futuras funcionalidades
- Actualmente solo visualización

### Gestión de Clientes

- Creación de clientes desde modal AJAX
- Validación de datos (nombre, email único)
- Integración automática en select de casos
- Contraseña temporal por defecto

---

## Base de Datos

### Tabla: users

**Campos:**
- `id` (bigint, primary key, auto increment)
- `name` (string, 255)
- `email` (string, 255, unique)
- `password` (string, 255, hashed)
- `tipo_usuario` (string: 'cliente' o 'profesional')
- `email_verified_at` (timestamp, nullable)
- `remember_token` (string, nullable)
- `created_at` (timestamp)
- `updated_at` (timestamp)

### Tabla: casos

**Campos:**
- `id` (bigint, primary key, auto increment)
- `codigo_caso` (string, 50, unique) - Formato: C-001, C-002, etc.
- `abogado_asignado` (string, 100) - Nombre del abogado
- `tipo_proceso` (string, 50) - Ej: Divorcio, Contrato de Compraventa, Herencia, etc.
- `estado` (string, 50) - Valores: 'En proceso', 'Completado', 'En revisión', 'Pendiente'
- `progreso` (integer, 0-100) - Porcentaje de avance
- `fecha_inicio` (date)
- `cliente_id` (bigint, foreign key -> users.id)
- `profesional_id` (bigint, foreign key -> users.id)
- `created_at` (timestamp)
- `updated_at` (timestamp)

**Relaciones:**
- Un caso pertenece a un cliente (belongsTo User como cliente)
- Un caso pertenece a un profesional (belongsTo User como profesional)

---

## Rutas del Sistema

### Rutas de Autenticación

- `GET /` → Muestra formulario de login (`AuthController@showLoginForm`)
- `POST /login` → Procesa login (`AuthController@login`)
- `POST /logout` → Cierra sesión (`AuthController@logout`)

### Rutas de Portales

- `GET /portal-cliente` → Portal de clientes (vista básica)

### Rutas de Casos (Resource Routes)

- `GET /casos` → Lista casos (`CasoController@index`)
- `GET /casos/create` → Formulario crear caso (`CasoController@create`)
- `POST /casos` → Guarda caso (`CasoController@store`)
- `GET /casos/{id}` → Detalles caso (`CasoController@show`)
- `GET /casos/{id}/edit` → Formulario editar caso (`CasoController@edit`)
- `PUT /casos/{id}` → Actualiza caso (`CasoController@update`)
- `DELETE /casos/{id}` → Elimina caso (`CasoController@destroy`)

### Rutas de Clientes

- `POST /clientes` → Crea cliente desde modal (`ClienteController@store`)

---

## Diseño Visual

### Sistema de Colores

- **Color principal:** #4B0082 (morado intenso corporativo)
- **Color oscuro neutro:** #2C2C2C (textos)
- **Color secundario:** #6C757D (textos suaves, borders, labels)
- **Color de realce:** #0B3C5D (elementos importantes, hover)
- **Color de fondo:** #FFFFFF (fondo principal)
- **Color de fondo secciones:** #F7F7F7 (tarjetas)
- **Color de error:** #8B0000 (alertas negativas)
- **Color de éxito:** #0B3C5D (alertas positivas)
- **Color footer/sidebar:** rgb(72, 72, 114)
- **Color hover botones:** #D9A441

### Tipografía

- **Títulos (H1-H4):** Libre Baskerville (serif, bold 700)
  - H1: 48px
  - H2: 40px
  - H3: 30px
  - H4: 22px
  - Interletra: 0.5px

- **Contenido general:** Montserrat (sans-serif)
  - Peso: 300 (light) y 400 (regular)
  - Tamaño base: 16px
  - Interletra: 0.7px

### Componentes Visuales

- **Logo:** logocuadrado.png (footer y sidebar), logoprovisionalnegro.png (header)
- **Footer:** 3 columnas (Logo/Nombre, Redes Sociales, Reconocimientos)
- **Sidebar:** Menú de navegación con logo y opciones
- **Formularios:** Sin apariencia de card, contenido directo
- **Botones:** Estilo moderno con hover effects
- **Tablas:** Responsive con Bootstrap, texto ajustado para una sola línea

---

## Validaciones Implementadas

### Validación de Casos

- Abogado asignado: requerido, string, máximo 100 caracteres
- Tipo de proceso: requerido, string, máximo 50 caracteres
- Estado: requerido, debe ser uno de: 'En proceso', 'Completado', 'En revisión', 'Pendiente'
- Progreso: requerido, integer, entre 0 y 100
- Fecha de inicio: requerida, formato date válido
- Cliente: requerido, debe existir en la tabla users

### Validación de Clientes

- Nombre: requerido, string, máximo 255 caracteres
- Email: requerido, formato email válido, único en la tabla users

### Validación de Login

- Usuario: requerido, string
- Clave: requerida, string
- Tipo de usuario: requerido, debe ser 'cliente' o 'profesional'

---

## Características Técnicas

### Seguridad

- Autenticación con hash de contraseñas (bcrypt)
- Tokens CSRF en formularios
- Validación de datos en servidor
- Filtrado de casos por profesional autenticado (solo ve sus propios casos)

### Funcionalidades AJAX

- Creación de clientes desde modal sin recargar página
- Actualización automática del select de clientes
- Mensajes de éxito/error con auto-dismiss

### Generación Automática

- Códigos de caso: C-001, C-002, C-003, etc.
- Incremento automático basado en el último caso creado

### Ordenamiento

- Casos ordenados por fecha de creación (más recientes primero)
- Criterio secundario: ID descendente para consistencia

---

## Archivos Clave del Proyecto

### Controladores

1. **AuthController.php** (app/Http/Controllers/)
   - Maneja autenticación y sesiones

2. **CasoController.php** (app/Http/Controllers/)
   - CRUD completo de casos
   - Validaciones personalizadas en español
   - Filtrado por profesional autenticado

3. **ClienteController.php** (app/Http/Controllers/)
   - Creación de clientes via AJAX
   - Retorna JSON para JavaScript

### Modelos

1. **Caso.php** (app/Models/)
   - Modelo Eloquent para casos
   - Relaciones con User (cliente y profesional)
   - Métodos estáticos para generación de códigos y validación de estados

2. **User.php** (app/Models/)
   - Modelo Eloquent para usuarios
   - Usado tanto para clientes como profesionales

### Vistas

1. **inicio.blade.php** (resources/views/)
   - Página de login
   - Formulario de autenticación
   - Footer con información de la empresa

2. **portal-profesional.blade.php** (resources/views/)
   - Dashboard del profesional
   - Lista de casos asignados
   - Sidebar con navegación

3. **casos/create.blade.php** (resources/views/casos/)
   - Formulario de creación de casos
   - Modal para crear clientes

4. **casos/edit.blade.php** (resources/views/casos/)
   - Formulario de edición de casos
   - Modal para crear clientes

5. **casos/show.blade.php** (resources/views/casos/)
   - Vista detallada de un caso
   - Información completa del caso

### Estilos

1. **styles.css** (public/css/)
   - Variables CSS centralizadas
   - Sistema de colores
   - Tipografía
   - Estilos de componentes (botones, formularios, tablas, footer, sidebar)

### Migraciones

1. **create_users_table.php** (database/migrations/)
   - Crea tabla de usuarios

2. **create_casos_table.php** (database/migrations/)
   - Crea tabla de casos

3. **add_profesional_id_to_casos_table.php** (database/migrations/)
   - Agrega relación con profesional

### Seeders

1. **CasoSeeder.php** (database/seeders/)
   - Datos de prueba para desarrollo

2. **DatabaseSeeder.php** (database/seeders/)
   - Ejecuta todos los seeders

---

## Comandos Importantes

### Ejecutar el Proyecto

```bash
php artisan serve
```
Abre el servidor en `http://localhost:8000`

### Migraciones

```bash
php artisan migrate
```
Ejecuta las migraciones para crear las tablas

### Seeders

```bash
php artisan db:seed
```
Pobla la base de datos con datos de prueba

### Verificar Versión de Laravel

```bash
php artisan --version
```

---

## Datos de Prueba

### Usuario Profesional

- **Email:** profesional@test.com
- **Contraseña:** 123456
- **Tipo:** profesional

### Usuario Cliente

- **Email:** juan.perez@example.com
- **Contraseña:** password123
- **Tipo:** cliente

### Casos de Prueba

- C-001: Divorcio, En proceso, 50%
- C-002: Contrato de Compraventa, Completado, 100%
- C-003: Herencia, En revisión, 75%

---

## Notas Importantes

- Todos los comentarios en el código están en español
- Los mensajes de validación están en español
- El sistema filtra casos por profesional autenticado
- Los códigos de caso se generan automáticamente
- El portal de clientes está preparado pero con funcionalidad básica
- El sistema usa Eloquent ORM para todas las operaciones de base de datos
- Se utiliza Bootstrap 5 para el diseño responsive
- Los estilos están centralizados en `styles.css` con variables CSS
- El sistema de autenticación es básico pero funcional
- No se implementó middleware de autenticación (comentado en rutas para facilitar pruebas)

---

## Requisitos Cumplidos

✅ Configuración del entorno de desarrollo (Laravel + XAMPP)
✅ Implementación de base de datos con migraciones
✅ Modelos Eloquent con relaciones
✅ CRUD completo de casos
✅ Sistema de autenticación funcional
✅ Validaciones en español
✅ Interfaz responsive con Bootstrap
✅ Diseño profesional y moderno
✅ Generación automática de códigos
✅ Filtrado por usuario autenticado
✅ Creación de clientes desde modal AJAX
✅ Mensajes de éxito/error
✅ Seeders para datos de prueba

---

Este documento contiene todo el contexto necesario para entender el proyecto completo y poder generar un guion de video de sustentación adecuado.

