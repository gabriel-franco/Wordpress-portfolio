<?php get_header(); ?>
	<div id="content_box">
                <div id="content" class="pages">
		<div class="page type-page">
		<?php
		if (!isset($term)) {
	                print_r($taxonomy);
	        } else {
			//print_r($term);
        	        $termino = get_term_by('slug', $term, 'area');
                	//print_r($termino);
	                $terminos_hijo = get_terms('area', array('hide_empty'=>0, 'parent' => $termino->term_id, 'child_of' =>$termino->term_id));

        	        echo '<center><h2>Trabajos: ' . $termino->name .'</h2></center>';
			echo '<div class="page_entry marginado">';
			echo '<p><center><i>' . $termino->description . '</i></center></p>';

                	foreach ($terminos_hijo as $termino_hijo) {
	                        //print_r($termino_hijo);
        	                //$term = get_term_by('id', $termino_hijo->term_id, 'area');
                	        $link = get_term_link($termino_hijo->slug, 'area' );
                        	$elementos = count(get_objects_in_term($termino_hijo->term_id, 'area'));
	                        echo '<div style="padding:5px;border:1px solid #DDD"><h5 style="font-size:1.5em"><a href="'.$link.'">'.$termino_hijo->name.'</a></h5><p>'.$termino_hijo->description . '</p></div><br/>';
               		};

			$trabajos_de_item = get_objects_in_term( $termino->term_id,'area' );

			if ( isset( $trabajos_de_item ) && count( $trabajos_de_item ) >= 1 ) {
				//echo '<h2>Elementos de ' . $term . '</h2>';
		                $args_array = array('post_type' => 'trabajo', 'area' => $term);
                		$array_posts = get_posts($args_array);

				foreach($array_posts as $item) {
					$th = get_the_post_thumbnail($item->ID, array(84,84));
 					echo '<div style="background-color:#EEE;padding:5px;border:1px solid black;">';
					if ( $th != '') 
						echo '<div style="float:left;margin:5px 10px 5px 5px">' . $th . '</div>';
					echo '<h3 id="trabajo-list-element"><a href="'.get_permalink($item->ID).'">' . $item->post_title . '</a></h3> <p id="descripcion-trabajo">'.get_post_meta($item->ID,'_gf_meta_descripcion',true) .'</p>';
					if ( $th != '') 
						echo '<div style="clear:both;"></div>';
					echo '</div>';
					echo '<br/>';
				}


			}
		}

		if ( $termino->parent != 0 ) {
			$parente = get_term_by('id', $termino->parent, 'area');
			//print_r($parente);
			echo '<p><a href="' . get_term_link($parente->slug, 'area' ) . '">Subir un nivel</a></p>';	
		}

		?>
		</div></div></div>
		<?php get_sidebar(); ?>
	</div>
<?php get_footer(); ?>
