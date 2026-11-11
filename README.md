# Eventos Culturales

Sistema web para organizar los eventos de una organización cultural y administrar los participantes inscritos en cada uno.
Desarrollado con **Laravel**, **MySQL** y **Bootstrap 5** como parte de la evaluación de Laravel (Grupo 6, Ejercicio 2).

## Funcionalidades

- **CRUD de Eventos:** nombre, tipo, descripción, lugar, fecha, hora y cupo máximo.
- **CRUD de Participantes:** documento, nombres, apellidos, correo, teléfono, evento inscrito y fecha de inscripción.
- **Relación:** cada participante pertenece a un evento (clave foránea `participantes.evento_id → eventos.id`).
- Validación de campos obligatorios y tipos de dato, con mensajes de éxito y de error.
- Control de cupos: no se puede inscribir a alguien en un evento lleno, ni reducir el cupo por debajo de los inscritos.
- Un evento con participantes no se puede eliminar.
- Eliminación con confirmación y navegación entre los dos módulos.
- Datos de prueba (seeders) para demostrar el funcionamiento.

## Requisitos

- PHP 8.3 o superior (extensiones `mbstring`, `pdo_mysql`)
- Composer
- MySQL 8 (o MariaDB 10.6+)
- Git

## Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/velosaleidy862-lab/eventos-culturales.git
cd eventos-culturales

# 2. Instalar dependencias
composer install

# 3. Crear el archivo de entorno y la llave de la aplicación
cp .env.example .env
php artisan key:generate
```

## Configuración de la base de datos

1. Crear la base de datos en MySQL:

   ```sql
   CREATE DATABASE eventos_culturales CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Revisar en el archivo `.env` los datos de conexión (el usuario y la contraseña dependen de cada equipo):

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eventos_culturales
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Crear las tablas y cargar los datos de prueba:

   ```bash
   php artisan migrate --seed
   ```

## Ejecución

```bash
php artisan serve
```

Abrir <http://127.0.0.1:8000>. La página principal lleva al módulo de Eventos; desde el menú superior se accede a Participantes.

## Pruebas automáticas

```bash
php artisan test
```

Las pruebas usan una base de datos SQLite en memoria, por lo que no tocan los datos de MySQL.
Además se ejecutan automáticamente con **GitHub Actions** (`.github/workflows/tests.yml`) en cada `push` y `pull request` hacia `main` y `develop`.

## Estructura principal

| Ruta | Descripción |
|------|-------------|
| `app/Models` | Modelos `Evento` y `Participante` |
| `app/Http/Controllers` | Controladores de los dos CRUD |
| `app/Http/Requests` | Reglas de validación y mensajes en español |
| `database/migrations` | Tablas `eventos` y `participantes` |
| `database/seeders` | Datos de prueba |
| `resources/views` | Vistas Blade con Bootstrap |
| `tests/Feature` | Pruebas de ambos módulos |

## Flujo de ramas

- `main`: versión estable.
- `develop`: integración de los avances.
- `feature/*`: ramas de funcionalidades, integradas a `develop` mediante Pull Requests.

## Autora

Leidy Diana Aguirre Velosa — Aprendiz SENA, Análisis y Desarrollo de Software (ficha 3311373).
