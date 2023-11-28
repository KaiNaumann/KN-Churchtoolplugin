<?php

/**
 * @package  NewChurchtoolPlugin
 */
namespace inc\knct;


class KNctSetup
{
  public static function activate()
  {flush_rewrite_rules();}

  public function register_CPT_CTEvent()
  {
  register_post_type( 'ctevent', ['public' => true, 'label' => 'Churchtool Events'] );
  }


  /**
   * Summary of register
   * @return void
   */
  public function register()
  {
    add_action( 'init', array ($this,'register_CPT_CTEvent') ) ;
    $this->activate();

  }
  
}