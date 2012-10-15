
Wordpress-portfolio
=

Wordpress simple portfolio - Es un plugin que permite la gestión y muestra de un pequeño portfolio de actividades lleva
das a cabo por el usuario.

##Elementos

Los elementos que se encuentran en este plugin **de cara al usuario** son:

* Menú **Trabajos** Donde se pueden añadir los distintos trabajos y ser clasificados en 'Areas' que se mostrarán como una
 serie de carpetas a través de las que navegar

* Shortcode para **enlazar a determinadas áreas**

* Shortcode para **mostrar los últimos trabajos añadidos y/o editados**

##Uso

###Instalación: 

1. Copiar la carpeta _gf\_portfolio_ que está dentro de la carpeta plugin al directorio _/wp-content/plugins/_ en la instalación de Wordpress

2. Copiar el contenido de la carpeta _theme_ en la carpeta del theme que se utilice con wordpress

###Uso:
Tras la instalación y activación del plugin, en el menú de administración, bajo _Entradas_ aparecerá un nuevo elemento denominado '_Trabajos_'.

El primer paso antes de añadir trabajos es editar las Areas (bajo el mismo menú _Trabajos_). Personalmente aconsejo crear un area denominada _Todos_ o _Principal_ o en esa linea bajo la cual agrupar todas las demás. Un enlace a esta area será el punto inicial para presentar todo el entramado de areas y trabajos en la web. _Slug_ y _Nombre_ se pueden rellenar como plazca al usuario, teniendo en cuenta que el nombre se presentará al usuario que este viendo la página y el slug formará parte de la ruta de la web, aconsejable que sea clara y entendible para mantener un buen SEO de la misma página. La descripción es opcional, peor aconsejable rellenar, si existe se mostrará cuando se esté visualizando la página correspondiente del area, y es mejor que tenga contenido para poder orientar al visitante y, a la vez, que sea bien indexada por los buscadores. Las nuevas áreas deben agruparse jerarquicamente .

Una vez con las areas principales creadas (después se podrán añadir más) Se pueden crear los trabajos. En la página para añadir un nuevo trabajo el título será el título de la página y el trabajo, la descripción el texto principal y el formulario que aparece abajo serán los metadatos que se presentarán bajo el título en la página en la que se observe el trabajo.

Es aconsejable que cada trabajo sólo se corresponda con un Area, aunque cabe la posibilidad de que esté en varias.

####Imágenes
Se pueden añadir todas las imágenes que se quieran, pudiendo estar éstas en el texto o o simplemente asociadas al post (una vez añadidas, si no se insertan pero salen representadas en la galería, son parte de ese post) Estas se mostrarán en una galería en la parte inferior del post del trabajo (esten o no insertadas en la descripción) Si se establece una imagen como destacada, esta será utilizada en el listado de las áreas como icono junto al nombre y descripción de la aplicación.

##TODO (Actualizaciones pendientes)

* Creación de una caja para la Sidebar que muestre los últimos trabajos añadidos/editados

* Sanitizar bien la entrada de datos por si acaso

* Añadir la capacidad de la etiqueta meta para la descripción en el mismo plugin. Necesario puesto que la descripción se usa para la etiqueta meta y para el menú de navegación

* Revisar sin parar metadatos que se puedan añadir

* Añadir automáticamente galerías de imágenes

* Preparar al usuario para editar el tema de la Sidebar

* Detalles del CSS, integrar en el plugin, no en el theme.
