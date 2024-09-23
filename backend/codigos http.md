200 OK: La solicitud ha tenido éxito. Este es el código de respuesta más común para las solicitudes GET.
201 Created: La solicitud ha tenido éxito y se ha creado un nuevo recurso. Este código se utiliza comúnmente en respuestas a solicitudes POST.
204 No Content: La solicitud ha tenido éxito, pero no hay contenido que enviar en la respuesta. Se utiliza a menudo para solicitudes DELETE.
400 Bad Request: La solicitud no se pudo entender debido a una sintaxis incorrecta. Este código indica que el cliente debe modificar la solicitud.
401 Unauthorized: La solicitud requiere autenticación del usuario. Este código se utiliza cuando el usuario no está autenticado.
403 Forbidden: El servidor ha comprendido la solicitud, pero se niega a autorizarla. Esto puede ocurrir si el usuario no tiene permisos para acceder al recurso.
404 Not Found: El recurso solicitado no se pudo encontrar en el servidor. Este código se utiliza comúnmente cuando se solicita una URL que no existe.
409 Conflict: La solicitud no se pudo completar debido a un conflicto con el estado actual del recurso. Por ejemplo, esto puede ocurrir al intentar crear un recurso que ya existe.
500 Internal Server Error: Se ha producido un error en el servidor al procesar la solicitud. Este código indica que hay un problema en el servidor que no se puede resolver.
503 Service Unavailable