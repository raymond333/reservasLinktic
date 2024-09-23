# ReservasLinktic Reservas Restaurant

## Descripción

Este sistema de reservas se desarrolló pensando en en manejar cualquier tipo de reservas. En este caso funciona para reservas paa restaurantes.

El sistema tiene 2 tipos de usuarios (administrador, cliente). Ambos usuarios pueden realizar una reserva, en el caso del usuario Administrador debe de elegir de una lista el cliente al cual le está relizando la reserva.

Actualmente (23-09-2024) el sistema no tiene la opción para que el Cliente pueda crear su usuario, por lo que un administrador debe crearlo.

Una vez dentro del sistema el usuario Administrador tiene un menú con opciones para administrar: usuarios, servicios, reservas. En el caso de las reservas tambien tiene la opción de "Ejecutar" la reserva en el momento en el que el cliente acude al sitio.

Por su parte el usuario Cliente podrá observar en forma de tarjetas las reservas que tiene pendientes, además podrá cancelar caulquier reserva que desee.

## Arquitectura del sistema

### Frontend:
  * Tecnologías:
    * Boostrap: Se utilizó un panel administrativo desarrollado en BS5 para facilitar la creación de la interfáz
    * JavaScript Vanilla: No se usó Framework JavaScript, todas la intercción y llamadas a la API se relizaron con FETCH (Ajax)
  * Interacciones: Envía solicitudes al backend y recibe respuestas para actualizar la interfaz
### Backend:
  * Tecnologías:
    *  PHP 8.0: Se desarrolló un API RESTful desde cero con PHP puro.
    *  MySQL (MariaDB)
  * Interacciones: Recibe solicitudes del frontend, procesa la lógica de negocio y se comunica con la base de datos para almacenar o recuperar información.

## Documentación API
  Se generó utilizando PostMan, y se puede ver desde este [enlace](https://documenter.getpostman.com/view/16048006/2sAXqv3f6Q): https://documenter.getpostman.com/view/16048006/2sAXqv3f6Q

## Instalación
 * Para correr el sistema solo se necesita tener instalado un servidor web con PHP y MySQL.
 * Es importante tener configurado el servidor para permitir redirecciones desde el archivo .htaccess
 * El acceso a l base de dato se configura en el archi pdo.php quee está dentro del backend
 * En el directorio principal del repositorio etá un archivo .sql para crear la base de datos
 


