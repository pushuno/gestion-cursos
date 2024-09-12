# Sistema de gestión de cursos

La aplicación permite agendar diferentes cursos, cursantes y profesores permitiendo inscribir a los cursantes a diferentes cursos, a su vez se pueden manejar diferentes ejes y conocimientos requeridos para cada curso, diferentes cátedras y registrar el presentismo de los cursantes para poder emitir el certificado.


# Arquitectura

El proyecto está desarrollado en Laravel bajo un modelo MVC, utiliza una base de datos relacional MySQL, incorpora test unitarios y lo necesario para su correcto funcionamiento. El frontend está realizado en Blade. Para correr necesita PHP ^7.2.5

## Instalación del proyecto
Desde la carpeta del proyecto se debe correr los siguientes comandos.

Para instalar las dependencias requeridas:

    composer install

Crear archivo .env con los datos de conexión a la base de datos:
  

    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=db
    DB_USERNAME=root
    DB_PASSWORD=
    
Crear la estructura de la base de datos:

    php artisan migrate

   
  Iniciar el proyecto

    php artisan serve


# Créditos

Desarrollo Ing.Lucas Febbroni
