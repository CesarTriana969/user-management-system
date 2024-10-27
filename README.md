## User Management System

Instrucciones para levantar el
proyecto

### Clonar el repositorio

```bash
git clone https://github.com/CesarTriana969/user-management-system.git
cd user-management-system
```

### Instalar dependencias de PHP

```bash
composer install
```

### Configurar archivo .env

Copia el archivo de ejemplo y ajusta los valores de la base de datos

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### Generar la clave de la aplicación

```bash
php artisan key:generate
```

### Ejecutar migraciones y seeders

Este comando creará la estructura de la base de datos y dos usuarios:

```bash
php artisan migrate --seed
```

#### Usuarios de prueba

- **Admin**:
  - **Email**: `admin@test.com`
  - **Contraseña**: `12345678`
  
- **User**:
  - **Email**: `user@test.com`
  - **Contraseña**: `12345678`

### Instalar dependencias de Node.js y compilar

```bash
npm install && npm run dev
```

### Iniciar el servidor
```bash
php artisan serve
```
La aplicación estará disponible en http://localhost:8000
