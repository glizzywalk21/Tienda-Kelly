# Guía de instalación
* Tener composer instalado y node js
 En VS Code, abrir terminal (Ctrl+ñ)
* Instalar composer dentro del proyecto
Una vez hecho esto, procedemos a generar la llave

Usaremos estos siguientes comandos para correr backend

* composer i
* php artisan key:generate
* php artisan migrate
* php artisan serve

Y para correr producción (frontend)
* npm i
* npm run dev

# Tienda Kelly
Tienda Kelly es un software en planificación por estudiantes de la Universidad Don Bosco.

<<<<<<< HEAD

## Autores ✒️
* **Guevara Campos Victor Alexander** - **Programación, lógica y manuales**
* **Jacinto Ventura Geovanni Francisco** - **Programación, diseño y lógica**

=======
>>>>>>> d532086673d394b0a9fd4a87905e8bfc8c24793d
## Herramientas 
* Tailwind CSS
* HTML5
* PHP Laravel
* Laragon
* MySQL

  ## Licencia 📄

La Licencia Pública General GNU Affero v3.0 (AGPL-3.0) permite la distribución del código fuente completo y exige que las obras derivadas se compartan bajo la misma licencia. Los contribuyentes conceden derechos de patente, y al proporcionar servicios en red con versiones modificadas, se requiere la disponibilidad pública del código fuente.


## Guía para correr el proyecto

* Abrir dos terminales
* Entrar a la carpeta en ambas terminales cd tienda_kelly
* Instalar dependencias en terminales diferentes
* En la primera terminal ejecutamos lo siguiente 
* composer i, php artisan key:generate, php artisan serve
* En caso de no poder generar la llave, hagan lo siguiente, copy .env.example .env

* Ahora en la siguiente terminal haremos lo siguiente para correr frontend
* npm i y npn run dev
