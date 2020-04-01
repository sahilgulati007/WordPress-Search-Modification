<?php
function SearchFilter($query) 
{
    if (($query->is_search)&&(!is_admin())) {
        //$query->set('post_type', 'post');
        $in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );

        // The post types you're removing (example: 'product' and 'page')
        $post_types_to_remove = array( 'product', 'page' );

        foreach( $post_types_to_remove as $post_type_to_remove ) {
          if( is_array( $in_search_post_types ) && in_array( $post_type_to_remove, $in_search_post_types ) ) {
            unset( $in_search_post_types[ $post_type_to_remove ] );
            $query->set( 'post_type', $in_search_post_types );
          }
        }
    }
    return $query;
}

add_filter('pre_get_posts','SearchFilter');
