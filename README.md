<p align="center" style="display: flex; justify-content: center; align-items: center; font-size: 100px;">
  <a href="https://laravel.com" target="_blank">
    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" width="150" alt="Laravel Logo" />
  </a>
  <span style="margin: 0 20px;">+</span>
  <a href="https://react.dev" target="_blank">
    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/react/react-original.svg" width="150" alt="React Logo" />
  </a>
</p>

# API de Gestión de Tareas
  
Esta API permite a los usuarios gestionar sus tareas personales a través de una plataforma en la que pueden crear, leer, actualizar y eliminar tareas. La API está construida utilizando el framework Laravel y sigue un diseño RESTFULl para facilitar la integración con aplicaciones frontend.

## Características

- **Gestión de Usuarios**: Registro y autenticación de usuarios para asegurar que cada usuario solo pueda acceder a sus propias tareas.
- **CRUD de Tareas**: Los usuarios pueden crear, ver, actualizar y eliminar tareas, facilitando el control y seguimiento de sus pendientes.
- **Campos de Tarea**:
  - **Título**: Nombre descriptivo de la tarea.
  - **Descripción**: Detalle completo de lo que implica la tarea.
  - **Fecha Límite**: Fecha límite para completar la tarea.
  - **Estado**: Puede ser "pendiente", "en progreso" o "completada".
  - **Prioridad**: Nivel de importancia de la tarea.

## Requisitos

- **PHP**: >= 8.0
- **Laravel**: >= 9.x
- **MySQL** o cualquier otra base de datos compatible

## Instalación

1. Clonar el repositorio:
   ```bash
   git clone <repositorio-url>
2. Entra en el directorio del proyecto:
   ```bash
   cd task-management-app
3.  Instalar dependencias de Composer:
    ```bash
    composer install
4.  Instalar dependencias de Node.js:
    ```bash
    npm install
5.  Configurar el archivo de entorno:
    ```bash
    cp .env.example .env
6.  Configurar la base de datos:
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=name
    DB_USERNAME=user
    DB_PASSWORD=password
7.  Generar la clave de la aplicación:
    ```bash
    php artisan key:generate  
8.  Configurar el archivo de entorno:
    ```bash
    php artisan migrate