<?php
/*
Plugin Name: Portfolio sencillo para trabajos
Plugin URI: http://gfranco.webfactional.com
Description: Gestión de trabajos terminados para su muestra como portfolio.
Version: 0.1
Author: Gabriel Franco
Author URI: http://gfranco.webfactional.com
*/

/*
 * TODO
 * - Internacionalizar
 * - DIVs configurables a través de menú
 * - Sanizar bien las entradas
 * - Prepar algunas imágenes por defecto para carpetas y elementos sin imágenes
 */

	/*
	 * Shortcode para mostrar un enlace a la sección de trabajos indicada por 
	 * el parametro 'area'
	 */
	function gf_portfolio_shortcode($atributo) {
		$termino_buscado = get_term_by('slug', $atributo['area'], 'area');
		//print_r($termino_buscado);
		//print_r(get_term_link($termino_buscado, 'area'));
		return '<a href="'.get_term_link($termino_buscado, 'area').'">Puede encontrar trabajos relacionados con '.$termino_buscado->name.' en la sección Trabajos</a>';
	}

	
	/*
	 * Añade el formulario con los datos extras para el trabajo (cliente, web del elemento...)
	 * También añade, si existe el plugin indicado (otro de mis plugins) el elemento para la 
	 * etiqueta meta de descripción
	 */
	function gf_portfolio_crear_metabox() {
		add_meta_box('mb_propia', 'Datos del trabajo', 'gf_portfolio_mostrar_meta_trabajo', 'trabajo', 'normal', 'high');
		if (is_plugin_active('gf-meta-descriptor/gf-meta-descriptor.php' ) ) {
			add_meta_box('meta_descriptor', 'Etiqueta &lt;Meta&gt; de descripcion', 'gf_show_metabox_descriptor', 'trabajo', 'normal', 'high');
		}
	}
	
	
	/*
	 * Función que muestra el formulario de los datos extras (cliente, web...) para los trabajos
	 */
	function gf_portfolio_mostrar_meta_trabajo( $post ) {
	
	$trabajo_cliente   = get_post_meta( $post->ID, '_gf_trabajo_cliente', true );
	$trabajo_cli_web   = get_post_meta( $post->ID, '_gf_trabajo_cliente_web', true );
	$trabajo_web       = get_post_meta( $post->ID, '_gf_trabajo_web', true );
	$trabajo_licencia  = get_post_meta( $post->ID, '_gf_trabajo_licencia', true );
	$trabajo_descarga  = get_post_meta( $post->ID, '_gf_trabajo_descarga', true );
	$trabajo_version   = get_post_meta( $post->ID, '_gf_trabajo_version', true );
	$trabajo_precio    = get_post_meta( $post->ID, '_gf_trabajo_precio', true );
	
	?>
		<table>
			<tr><td>
				<label for="p_cliente">Cliente:</label></td><td><input id="p_cliente" name="p_cliente" value="<?php echo $trabajo_cliente; ?>"/>
			</td></tr>
			<tr><td>
				<label for="p_cliente_web">Web del cliente:</label></td><td><input id="p_cliente_web" name="p_cliente_web" value="<?php echo $trabajo_cli_web; ?>"/>
			</td></tr>
			<tr><td>
				<label for="p_trabajo_web">Web del producto:</label></td><td><input id="p_trabajo_web" name="p_trabajo_web" value="<?php echo $trabajo_web; ?>"/>
			</td></tr>
			<tr><td>
				<label for="p_trabajo_licencia">Licencia:</label></td><td><input id="p_trabajo_licencia" name="p_trabajo_licencia" value="<?php echo $trabajo_licencia; ?>"/>
			</td></tr>
			<tr><td>
				<label for="p_trabajo_descarga">Dirección descarga:</label></td><td><input id="p_trabajo_descarga" name="p_trabajo_descarga" value="<?php echo $trabajo_descarga; ?>"/>
			</td></tr>
			<tr><td>
				<label for="p_trabajo_version">Versión:</label></td><td><input id="p_trabajo_version" name="p_trabajo_version" value="<?php echo $trabajo_version; ?>"/>
			</td></tr>
			<tr><td>
				<label for="p_trabajo_precio">Precio:</label></td><td><input id=p_trabajo_precio" name="p_trabajo_precio" value="<?php echo $trabajo_precio; ?>"/>
			</td></tr>
		</table>
	<?php
	}
	
	
	/*
	 * Función para almacenamiento de los metadatos de los trabajos
	 */
	function gf_portfolio_guardar_metabox( $post_id ) {
		if ( get_post_type($post_id) == 'trabajo') {
			update_post_meta( $post_id, '_gf_trabajo_cliente', $_REQUEST['p_cliente']);
		}
		
		if (isset($_REQUEST['p_cliente_web'])) {
			update_post_meta( $post_id, '_gf_trabajo_cliente_web', $_REQUEST['p_cliente_web']);
		}
		
		if (isset($_REQUEST['p_trabajo_web'])) {
			update_post_meta( $post_id, '_gf_trabajo_web', $_REQUEST['p_trabajo_web']);
		}
		
		if (isset($_REQUEST['p_trabajo_licencia'])) {
			update_post_meta( $post_id, '_gf_trabajo_licencia', $_REQUEST['p_trabajo_licencia']);
		}
		
		if (isset($_REQUEST['p_trabajo_descarga'])) {
			update_post_meta( $post_id, '_gf_trabajo_descarga', $_REQUEST['p_trabajo_descarga']);
		}
		
		if (isset($_REQUEST['p_trabajo_version'])) {
			update_post_meta( $post_id, '_gf_trabajo_version', $_REQUEST['p_trabajo_version']);
		}
		
		if (isset($_REQUEST['p_trabajo_precio'])) {
			update_post_meta( $post_id, '_gf_trabajo_precio', $_REQUEST['p_trabajo_precio']);
		}

		if (is_plugin_active('gf-meta-descriptor/gf-meta-descriptor.php' ) ) {
			 $valor_viejo = get_post_meta($post_id, '_gf_meta_descripcion', true);
	                $valor_nuevo =  $_POST['valdesc'];
			
			if ($valor_nuevo) {
	        	        update_post_meta($post_id, '_gf_meta_descripcion',$valor_nuevo);
			}

		}
	}
	
	/*
	 * Función para definir el nuevo tipo de post, denominado trabajo
	 * También crea y registra la taxonomía 'area' que clasifica los trabajos
	 */
	function gf_portfolio_custom_elementos() {
	
		$args_trabajo = array(
			'public' => true,
			'show_ui' => true,
			'publicy_queryable' => true,
			'exclude_from_search' => false,
			'supports' => array( 'title', 'editor','thumbnail', 
					'comments', 'page-attributes' ),
			'labels' => array(		
					'name' => 'Trabajos',
					'singular_name' => 'Trabajo',
					'add_new' => 'Añadir Trabajo',
					'add_new_item' => 'Añadir Nuevo Trabajo',
					'edit_item' => 'Editar Trabajo',
					'new_item' => 'Nuevo Trabajo',
					'view_item' => 'Ver Trabajo',
					'search_items' => 'Buscar Trabajo',
					'not_found' => 'No se encontraron trabajos',
					'not_found_in_trash' => 'No se encontraron trabajos en la papelera'
					),
			'capability_type' => 'post',
			'hierarchical' => true,
			'has_archive' => true, // TODO mirar esto	
			'query_var' => 'trabajo',
			'rewrite' => array(
					'with_front' => true,
					'slug' => 'trabajo',
					'feeds' => false,
					'pages' => true
					),
			'taxonomies' => array('area'),
			'menu_position' => 6,
			//'menu_icon' => 'ruta',
			'show_in_nav_menus' => false,
			'can_export' => true,		
		);
	
		register_post_type( 'trabajo', $args_trabajo );

		
		
		$args_taxo = array(
			'public' => true,
			'show_ui' => true,
			'hierarchical' => true,
			'query_var' => 'area',
			'rewrite' => array(
					'with_front' => true,
					'slug' => 'trabajos',
					'hierarchical' => true
					),
			'show_tagcloud' => true,
			'labels' => array(
					'name' => 'Areas',
					'singular_name' => 'Area',
					'search_items' => 'Buscar area',
					'pupular_items' => 'Áreas más populares',
					'all_items' => 'Todas las áreas',
					'parent_item' => 'Area',
					'parent_item_colon' => 'Area superior seguido de punto',
					'edit_item' => 'Editar un area',
					'update_item' => 'Actualizar area',
					'add_new_item' => 'Añadir nueva area',
					'new_item_name' => 'Nombre de la nueva area',
					'separate_items_with_commas' => 'Separar los elementos con comas',
					'add_or_remove_items' => 'Añadir o eliminar áreas',
					'choose_from_the_most_used' => 'Elegir entre las más usadas'
					),
			);

		// Registra la taxonomia
		register_taxonomy('area', 'trabajo', $args_taxo); 		// Argumentos antes explicados

	}

	
	
	/*
	 * Función que asegura el funcionamiento de los thumbnails
	 */ 
	function gf_portfolio_thumb() {
		add_theme_support('post-thumbnails');
	}

	
	
	/*
	 * Función para la creación de los elementos que muestran los últimos trabajos dentro
	 * de un div
	 */
	function gf_portfolio_ultimos_short( $attr, $content ) {
	
		$max_posts = $attr['max'];
		$args = array(
			'numberposts'     => $max_posts,
			//'orderby'         => 'post_date',
			//'orderby'         => 'modified',
			'order'           => 'DESC',
			'post_type'       => 'trabajo',
			'post_status'     => 'publish' );
		if ( $attr['orden'] == "mod" ) 
			$args['orderby'] = 'modified';
		else
			$args['orderby'] = 'post_date';

		$los_posts = get_posts( $args );

		$cadena = '<div';
		if ( $attr['divstyle'] != '' ) 
			$cadena = $cadena . ' style="' . $attr['divstyle'] . '"';
		$cadena = $cadena . '>';
		if ($content != '' && isset($content) ) {
			$cadena = $cadena . '<center><h3';
			if ( $attr['titlestyle'] ) 
				$cadena = $cadena . ' style="' . $attr['titlestyle'] . '"';
			$cadena = $cadena . '>' . $content . '</h3></center>';
		}
		$cadena = $cadena . '<ul';
		if ( $attr['ulstyle'] != '' ) 
			$cadena = $cadena . ' style="' . $attr['ulstyle'] . '"';
		$cadena = $cadena . '>';

		foreach ( $los_posts as $one ) {
			$cadena = $cadena . '<li';
			if ( $attr['listyle'] ) 
				$cadena = $cadena . ' style="' . $attr['listyle'] . '"';
			$cadena = $cadena . '><a href="' . get_permalink($one->ID) . '">' . $one->post_title . '</a></li>';
		}
		$cadena = $cadena . '</ul></div>';
		if ( $attr['post'] == true ) 
			$cadena = $cadena . '<div style="clear:both;"></div>';
		return $cadena;
		
	}

	// Añade los tipos customizados
	add_action('init', 'gf_portfolio_custom_elementos',0);
	
	// Prepara la presentación y almacenaje de metadatos para los trabajos
	add_action('add_meta_boxes', 'gf_portfolio_crear_metabox');
	add_action('save_post', 'gf_portfolio_guardar_metabox');

	// Añade el shortcode para los enlaces a las areas de los trabajos
	add_shortcode( 'portfolio', 'gf_portfolio_shortcode');

	// Se asegura de que los thumbnails estén preparados
	add_action('after_setup_theme', 'gf_portfolio_thumb');
	
	// Añade el shortcode que mostrará un div configurable con los últimos trabajos realizados/editados
	add_shortcode( 'ultimostrabajos', 'gf_portfolio_ultimos_short');

	

?>
