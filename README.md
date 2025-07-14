<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



# 📚 API RESTful - Biblioteca de Libros

Este proyecto es una API RESTful desarrollada en **Laravel** y conectada a **MySQL**, diseñada para gestionar una biblioteca de libros. Permite listar, ver, crear, actualizar y eliminar libros.

---

## 🚀 Requisitos

- PHP 8.1 o superior
- Composer
- MySQL
- Laravel 10+
- Opcional: Docker y Docker Compose (ver Ejercicio 3)

---

## ⚙️ Instalación (Modo local)

1. Clona el repositorio:

```bash
git clone https://github.com/tu_usuario/biblioteca-api.git
cd biblioteca-api

2.Instala dependencias con Composer:

composer install

3. Copia el archivo .env y genera la clave:

cp .env.example .env
php artisan key:generate

4. Configura tu base de datos en .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biblioteca
DB_USERNAME=root
DB_PASSWORD=tu_contraseña

5. Crea la base de datos biblioteca en tu gestor MySQL (phpMyAdmin, Workbench, etc.)

6. Ejecuta migraciones y seeders:

php artisan migrate --seed

7. Inicia el servidor:

php artisan serve

##enpoint disponibles 
Método	   Ruta        	Descripción
GET	    /api/libros 	Listar todos los libros (paginado)
GET	  /api/libros/{id}	Mostrar detalles de un libro
POST   /api/libros	     Crear un nuevo libro
PUT	/api/libros/{id}	 Actualizar un libro existente
DELETE	/api/libros/{id}	 Eliminar un libro

##Integración con Open Library
Cuando se crea o actualiza un libro, se consulta automáticamente la API de Open Library utilizando el título. Si encuentra resultados, se agregan los siguientes campos:

Descripción del libro

Número estimado de páginas

Año de publicación original

Esto enriquece automáticamente los datos incluso si no se proporcionan manualmente.


##Ejemplo de creación

POST /api/libros
Content-Type: application/json

{
  "titulo": "Pride and Prejudice",
  "autor": "Jane Austen"
}

##Optimización de consultas

El endpoint de listado /api/libros usa paginación para evitar sobrecarga de memoria o tiempos largos de respuesta.

Parámetros disponibles:

page: número de página (por defecto 1)

per_page: cantidad de libros por página (máximo 50)

##Validación y manejo de errores

Se valida la entrada de datos con reglas definidas en el controlador:

titulo: requerido, texto

autor: requerido, texto

anio_publicacion: opcional, numérico

Errores comunes retornan códigos HTTP claros como:

422 Unprocessable Entity (validaciones fallidas)

404 Not Found (libro no encontrado)

########################################Uso con Docker (opcional)#############################

Este proyecto incluye archivos para contenerizar el entorno con Docker y Docker Compose.

Archivos:

Dockerfile

docker-compose.yml

.env.docker


 ##pasos##
  cp .env.docker .env
docker compose up -d --build
docker compose exec app php artisan migrate --seed
      
#########################Pruebas con Postman o Insomnia################################

        Para probar la API puedes usar cualquier cliente HTTP.

Recuerde establecer Content-Type: application/json y probar los siguientes endpoints:

GET /api/libros

POST /api/libros

PUT /api/libros/{id}

DELETE /api/libros/{id}

---

✅ Este `README.md` incluye:

- El encabezado visual de Laravel
- Descripción del proyecto
- Instalación completa
- Endpoints
- Integración con Open Library
- Optimización (paginación)
- Docker (opcional)
- Validaciones
- Pruebas
-

