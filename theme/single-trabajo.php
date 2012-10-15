<?php get_header(); ?>
	<div id="content_box">	
		<div id="content" class="pages">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2><?php the_title(); ?></h2>
				<div class="page_entry marginado">
					<?php 
					$th = get_the_post_thumbnail($post->ID, 'medium');
					// Obtiene los metadatos
					$trabajo_cliente   = get_post_meta( $post->ID, '_gf_trabajo_cliente', true );
					$trabajo_cli_web   = get_post_meta( $post->ID, '_gf_trabajo_cliente_web', true );
					$trabajo_web       = get_post_meta( $post->ID, '_gf_trabajo_web', true );
					$trabajo_licencia  = get_post_meta( $post->ID, '_gf_trabajo_licencia', true );
					$trabajo_descarga  = get_post_meta( $post->ID, '_gf_trabajo_descarga', true );
					$trabajo_version   = get_post_meta( $post->ID, '_gf_trabajo_version', true );
					$trabajo_precio    = get_post_meta( $post->ID, '_gf_trabajo_precio', true );

					$datos = "";
					if ($trabajo_cliente && !$trabajo_cli_web)
						$datos = $datos . '<li><b>Cliente:</b> ' . $trabajo_cliente . '</li>';
					else if ($trabajo_cliente && $trabajo_cli_web)
						$datos = $datos . '<li><b>Cliente: </b><a href="'.$trabajo_cli_web.'">'.$trabajo_cliente.'</a></li>';
					if ($trabajo_web)
						$datos = $datos . '<li><b>Trabajo funcionando:</b><a href="'.$trabajo_web.'"> '.$trabajo_web.'</a></li>';
					if ($trabajo_licencia)
						$datos = $datos . '<li><b>Licencia: </b>' . $trabajo_licencia . '</li>';
					if ($trabajo_descarga)
						$datos = $datos . '<li><a href="'.$trabajo_descarga.'">Descarga del trabajo</a></li>';
					if ($trabajo_version)
						$datos = $datos . '<li><b>Versión: </b>'.$trabajo_version.'</li>';
					if ($trabajo_precio >= 0 && $trabajo_precio != '')
						$datos = $datos . '<li><b>Precio: </b>'.$trabajo_precio.' € </li>';

					// Si hay datos se envuelven en un div (con o sin imagen thumb)
					if ($datos != '') 
						echo '<div id="cosas_cabeza">';
					
					// Si hay thumbnail se pone
					if ( $th != '' ) 
						echo '<div style="float:left;margin:0px 15px 15px 0px;">' . $th . '</div>';
					// Si hay datos se ponen los datos
					if ( $datos != '' ) {
						echo '<ul>' . $datos . '</ul>';
						echo '</div>';
					}					
					?>
					<?php the_content('<p>Leer el resto de esta página &rarr;</p>'); ?>
					<?php link_pages('<p><strong>Paginas:</strong> ', '</p>', 'numero'); ?>
					<br/>
					<hr/>
					<p>Ver todos los trabajos relacionados con el area de  
					<?php	
						$terminos = get_the_terms($post->ID, 'area');
						foreach( $terminos as $t ) {
							echo '<a href="'.get_term_link($t, 'area').'">'.$t->name.'</a>';
						}
					?>
					</p>
				</div>
			</div>			
			<?php endwhile; endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
