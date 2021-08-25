# KUDOBOARD

Este kudoboard fue hecho para una entrevista técnica, la cual demuestra mis habilidades en el desarrollo de Laravel (Backend) y VueJs (Frontend).

## Inicializar el proyecto

1. Para iniciarlizar el proyecto lo primero que debe hacer es clonar el repositorio a su máquina local.

    - Puede hacer uso de HTTPS o SSH.

        `      
                git clone  'repositorio' 
        `      

2. En la carpeta del proyecto descargado debe instalar las dependencias.

    - Para la parte del backend: 

        `
                composer install
        `

    - Para la parte del frontend: 

        `
                npm install
        `

3.  Luego debe configurar su archivo .env, copie el contenido del .env.example.

4.  Configurar las variables de su BD.

5.  Si es necesario, ejectuar:

    `
            php artisan key:generate
    `

6. Ejecutar las migraciones:
    
    `
            php artisan migrate
    `

7. Ejectuar passport:
    
    `
            php artisan passport:install
    `