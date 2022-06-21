#Proyecto

El proyecto consta de un aplicativo para registrar tareas con el cual 
dependiendo del rol se obtienen diferentes permisos para administrar las mismas.

## Para inicializar el proyecto

Para inicializar el proyecto debe tener instalado en su entorno PHP 8 o superior,
composer, node js y laravel.

Basta con ejecturar los comandos:

    composer install

    npm run dev

    php artisan migrate --seed

Posteriormente podra usar el comando:
    
    php artisan serve 

para arrancar el proyecto. 

### Recomendaciones

No olvide en el archivo .env tener bien registradas las credenciales para
conectarse a una base de datos mysql.

No olvide generar una nueva key que quedara registrada en el .env con el comando: 
    
    php artisan key:generate

Ante cualquier duda puede escribirme directamente a mi whatsapp o correo electronico
