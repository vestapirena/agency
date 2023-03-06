Programador Analista Yair Noguerón
PHP 60%
Javascript 40%
Java 8 60%
JQuery 30%
Ajax 10%
PlSql 40%
C++ 20%
C 20%
Visual Basic 6.0 20%
Y más...
INTERMEDIO - AVANZADO (Incompleto por tiempo limite de 5 días)
vestapirena@gmail.com

Funciona bajo XAMPP 7.4

Descargar el proyecto del repositorio git.
Colocar la carpeta agency dentro de XAMPP en la carpeta htdocs.
Ingresar a la carpeta agency\public_html\install
Abrir el archivo agency.sql hacer copia de su contenido y pegar en el programa phpmyadmin en la parte de ejecución SQL. Ejecutar. Este va a generar las tablas e ingresar valores de categoría y subcategoría.
La base de datos que se creara es agency, misma que está configurada en el archivo agency\php\properties\prop.ini
Abrir el archivo de propiedades agency\php\properties\prop.ini para configurar el usuario y contraseña.
En el mismo archivo de propiedades los atributos outstandinglimit y productslimit son para configurar la cantidad que se mostrarán en la vista.
Ejecutar el archivo agency\public_html\install\products.php -> http://localhost/agency/public_html/install/products.php
  Este archivo va a leer las categorias y sub categorias registradas en la base de datos
  En el archivo data.txt va a tomar los valores random de la categoría laptops del valor 0 al 9 y la siguiente categoría será del 10 al 19.
  Los comentarios serán tomados del archivo comments.txt contiene frases genéricas que son tomadas al azar así como la calificación o estrellas.
  Se puede refrescar el archivo para ingresar más datos.
En el navegador ingresar a http://localhost/agency/public_html/ se mostrará el inicio.
En la parte de arriba se muestran productos de forma aleatoria, solo funcionan los botones de refrescar, previo y siguiente.
En la parte central se muestra el menú el cuál contiene las categorías con subcategorías.
Los productos se muestran haciendo clic en el submenú.
Al ingresar internamente se actualiza la tabla de productos en el contador de visitas.
En la parte central al hacer clic en Detalle, serás redireccionado al detalle del producto.
Se muestra información del producto con los comentarios creados de manera aleatoria y su calificación de estrellas también generadas de manera aleatoria.
Se puede hacer clic en el botón Like para aumentar el contador de likes internamente.

Actividades realizadas:

Básico
  Creación de tablas.
  Conexión a base de datos con PDO.
  Log de la aplicación.
  Listado de categorías en menú.
  Productos aleatorios (encabezado) con botón de refrescar.
  Se muestra detalle del producto.

Intermedio
  Vista detalle de producto con sus comentarios ordenados por mejor calificación
  Índices, llaves foráneas y constraints.
  Código genera productos de manera aleatoria.

Avanzado
  Columnas de metainformación.
  Especificaciones de manera aleatoria.
  Comentario de texto coherente.
  Carpeta PHP controlador modelo.

Adicional
  Al ingresar al detalle de un producto se actualiza el contador en la tabla.
  Botón like funciona actualizando el contador en la tabla.
  En el archivo de propiedades de configurar la cantidad de productos a mostrar en el home.
  