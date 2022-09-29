<?php

include_once get_template_directory().'/inc/package_meta/Field.php';
include_once get_template_directory().'/inc/package_meta/BundleTest.php';

function add_custom_box_page_home(){

                add_meta_box(
				'page_home_metabox',
				'Informations',
				'page_home_metabox_callback',
				'page',
				'normal',
				'default'
				);
}
add_action('add_meta_boxes','add_custom_box_page_home');

function page_home_metabox_callback($post){
	$title = new Field('text','Titre','title',$post->ID);
	$test = new BundleTest('Chiffre','chiffres',$post->ID,1);
	wp_nonce_field('somerandomstr','_sandboxpagehome');
	?>
	<table class='form-table'>
		<tbody>
		<?php
		echo $title->buildField();
		echo $test->buildField();
		?>
		</tbody>
	</table>
	<?php
}

function save_meta_page_home($post_id){

	if( ! isset( $_POST["_sandboxpagehome"] ) || ! wp_verify_nonce( $_POST["_sandboxpagehome"],'somerandomstr')){
	return $post_id;
	}

	Field::saveTextField('title',$post_id);
	Field::saveEditorField('chiffres',$post_id);
	return $post_id;
}

add_action('save_post','save_meta_page_home',10,2);