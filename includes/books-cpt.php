<?php

//Add Books CPT

function cpt_books_init() {
    $labels = array(
        'name'                  => _x( 'books', 'Post type general name', 'book' ),
        'singular_name'         => _x( 'book', 'Post type singular name', 'book' ),
        'menu_name'             => _x( 'books', 'Admin Menu text', 'book' ),
        'name_admin_bar'        => _x( 'book', 'Add New on Toolbar', 'book' ),
        'add_new'               => __( 'Add New', 'book' ),
        'add_new_item'          => __( 'Add New book', 'book' ),
        'new_item'              => __( 'New book', 'book' ),
        'edit_item'             => __( 'Edit book', 'book' ),
        'view_item'             => __( 'View book', 'book' ),
        'all_items'             => __( 'All books', 'book' ),
        'search_items'          => __( 'Search books', 'book' ),
        'parent_item_colon'     => __( 'Parent books:', 'book' ),
        'not_found'             => __( 'No books found.', 'book' ),
        'not_found_in_trash'    => __( 'No books found in Trash.', 'book' ),
        'featured_image'        => _x( 'book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'book' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'book' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'book' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'book' ),
        'archives'              => _x( 'book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'book' ),
        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'book' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'book' ),
        'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'book' ),
        'items_list_navigation' => _x( 'books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'book' ),
        'items_list'            => _x( 'books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'book' ),
    );     
    $args = array(
        'labels'             => $labels,
        'description'        => 'book custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'books' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
		'can_export'         => true,
        'hierarchical'       => true,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'taxonomy' ),
        'taxonomies'         => array( 'genre', 'author' ),
        'show_in_rest'       => true
    );
     
    register_post_type( 'books', $args );
}
add_action( 'init', 'cpt_books_init' );


// Add Genre & Author taxonomies for books cpt
function wpdocs_create_book_taxonomies() {
	$labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name'),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name'),
		'search_items'      => __( 'Search Genres'),
		'all_items'         => __( 'All Genres'),
		'parent_item'       => __( 'Parent Genre'),
		'parent_item_colon' => __( 'Parent Genre:'),
		'edit_item'         => __( 'Edit Genre'),
		'update_item'       => __( 'Update Genre'),
		'add_new_item'      => __( 'Add New Genre'),
		'new_item_name'     => __( 'New Genre Name'),
		'menu_name'         => __( 'Genre'),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_in_rest' 		=> true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'genre' ),
	);

	register_taxonomy( 'genre', array( 'books' ), $args );

	unset( $args );
	unset( $labels );

	$labels = array(
		'name'                       => _x( 'Book Author', 'taxonomy general name'),
		'singular_name'              => _x( 'Book Author', 'taxonomy singular name'),
		'search_items'               => __( 'Search Book Authors'),
		'popular_items'              => __( 'Popular authors'),
		'all_items'                  => __( 'All authors'),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Book Author'),
		'update_item'                => __( 'Update Book Author'),
		'add_new_item'               => __( 'Add New Book Author'),
		'new_item_name'              => __( 'New Book Author Name'),
		'separate_items_with_commas' => __( 'Separate Book Authors with commas'),
		'add_or_remove_items'        => __( 'Add or remove Book Author'),
		'choose_from_most_used'      => __( 'Choose from the most used Book Author'),
		'not_found'                  => __( 'No Book Author found.'),
		'menu_name'                  => __( 'Book Author'),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_in_rest' 			=> true,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'author' ),
	);

	register_taxonomy( 'author', 'books', $args );
}
add_action( 'init', 'wpdocs_create_book_taxonomies', 0 );