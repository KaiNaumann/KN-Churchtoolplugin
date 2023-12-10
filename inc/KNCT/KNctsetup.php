<?php

/**
 * @package  NewChurchtoolPlugin
 */
namespace inc\knct;


class KNctSetup
{
  public static function activate()
  {flush_rewrite_rules();}

  
  // Benutzerdefinierter Beitragstyp erstellen
  function create_ctevent_post_type() 
{
    $labels = array(
        'name'               => 'CT Events',
        'singular_name'      => 'CT Event',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New CT Event',
        'edit_item'          => 'Edit CT Event',
        'new_item'           => 'New CT Event',
        'all_items'          => 'All CT Events',
        'view_item'          => 'View CT Event',
        'search_items'       => 'Search CT Events',
        'not_found'          => 'No CT Events found',
        'not_found_in_trash' => 'No CT Events found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'CT Events'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'ctevent' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    register_post_type( 'ctevent', $args );
}



// Benutzerdefinierte Taxonomie erstellen
function create_calender_taxonomy() {
    $labels = array(
        'name'              => 'Calender',
        'singular_name'     => 'Calender',
        'search_items'      => 'Calender durchsuchen',
        'all_items'         => 'Alle Calender',
        'parent_item'       => 'Übergeordneter Calender',
        'parent_item_colon' => 'Übergeordneter Calender:',
        'edit_item'         => 'Calender bearbeiten',
        'update_item'       => 'Calender aktualisieren',
        'add_new_item'      => 'Neuen Calender hinzufügen',
        'new_item_name'     => 'Neuer Calender Name',
        'menu_name'         => 'Calender',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'calender' ),
    );

    register_taxonomy( 'calender', array( 'ctevent' ), $args );
}


function create_acf()
{
}
  



  /**
   * Summary of register
   * @return void
   */

  public function register()
  {

    add_action( 'init', array($this,'create_ctevent_post_type' ));
    add_action( 'init', array($this,'create_calender_taxonomy' ));
    $this -> create_acf();

    $this->activate();

  }
  
}