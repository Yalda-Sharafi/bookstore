<?php

function add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Further information", "custom_meta_box_markup", "books", "advanced", "default", null);
}
add_action("add_meta_boxes", "add_custom_meta_box");

function custom_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");
    ?>
    <div class="bookstore_metabox">
        <div class="bookstore_fieldgroup">
            <label for="meta-box-price"> <?php _e( 'Price' ); ?> </label>
            <input name="meta-box-price" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-price", true); ?>">
        </div>
        <div class="bookstore_fieldgroup">
            <label for="meta-box-isbn"> <?php _e( 'ISBN' ); ?> </label>
            <input name="meta-box-isbn" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-isbn", true); ?>">
        </div>
    </div>
    <?php  
}
//Save meta data
function save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "books";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_text_value = "";
    $meta_box_dropdown_value = "";
    $meta_box_checkbox_value = "";

    if(isset($_POST["meta-box-price"]))
    {
        $meta_box_text_value = $_POST["meta-box-price"];
    }   
    update_post_meta($post_id, "meta-box-price", $meta_box_text_value);

    if(isset($_POST["meta-box-isbn"]))
    {
        $meta_box_text_value = $_POST["meta-box-isbn"];
    }   
    update_post_meta($post_id, "meta-box-isbn", $meta_box_text_value);
}
add_action("save_post", "save_custom_meta_box", 10, 3);