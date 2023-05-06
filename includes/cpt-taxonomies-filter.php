<?php
//Add taxonomies filters column in admin dashboard
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');

function tsm_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'books';
	$taxonomies  = array( 'genre' , 'author' );
	if ($typenow == $post_type) {
        foreach($taxonomies as $taxonomy){
            $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
            $info_taxonomy = get_taxonomy($taxonomy);
            wp_dropdown_categories(array(
                'show_option_all' => sprintf( __( 'Show all %s', 'textdomain' ), $info_taxonomy->label ),
                'taxonomy'        => $taxonomy,
                'name'            => $taxonomy,
                'orderby'         => 'name',
                'selected'        => $selected,
                'show_count'      => true,
                'hide_empty'      => true,
            ));
        }
	};
}


add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'books'; // change to your post type
	$taxonomies  = array( 'genre' , 'author' ); // change to your taxonomy
	$q_vars    = &$query->query_vars;
    foreach($taxonomies as $taxonomy){
        if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
            $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
            $q_vars[$taxonomy] = $term->slug;
        }
    }
}