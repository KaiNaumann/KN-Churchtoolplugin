<?php

/**
 * @package  NewChurchtoolPlugin
 */
namespace inc\knct;


class KNctSetup
{
  public static function activate()
  {flush_rewrite_rules();}

  
  function create_ctevent_post_type() {
    $labels = array(
        'name'                  => _x( 'CT Events', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'CT Event', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'CT Events', 'text_domain' ),
        'all_items'             => __( 'All Events', 'text_domain' ),
        'add_new_item'          => __( 'Add New Event', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'edit_item'             => __( 'Edit Event', 'text_domain' ),
        'update_item'           => __( 'Update Event', 'text_domain' ),
        'view_item'             => __( 'View Event', 'text_domain' ),
        'search_items'          => __( 'Search Event', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'CT Event', 'text_domain' ),
        'description'           => __( 'Custom post type for events', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'taxonomies'            => array( 'kalender' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar',
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type( 'ctevent', $args );
}

// Register Custom Taxonomy
function create_kalender_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Kalender', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Kalender', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Kalender', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'kalender', array( 'ctevent' ), $args );
}

// Funktion zum Auslesen der Taxonomie
function get_events_by_kalender($kalender_term_id) {
    $args = array(
        'post_type' => 'ctevent',
        'tax_query' => array(
            array(
                'taxonomy' => 'kalender',
                'field'    => 'id',
                'terms'    => $kalender_term_id,
            ),
        ),
    );

    $events = new WP_Query($args);

    return $events->posts;
}



  /**
   * Summary of register
   * @return void
   */

  public function register()
  {
    add_action( 'init', array ($this,'create_ctevent_post_type') ) ;
    add_action( 'init', array ($this,'create_kalender_taxonomy'));
    // add_action( 'add_meta_boxes', array ($this,'add_ctevent_meta_box') );
    // add_action( 'save_post', array ($this,'save_ctevent_meta') );

    $this->activate();

  }
  
}