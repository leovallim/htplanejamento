<?php 
/**
 * Garantindo que as sessões serão iniciadas
 */
add_action('init',function() { if (!session_id()){ session_start(); } });

/**
 * Setup
 * 
 * TODO: 1. Adicionar função para criação das páginas HOME e BLOG
 *       2. Personalizar página de login
 */
add_action("after_setup_theme", "ht_after_setup_theme");
function ht_after_setup_theme(){
    add_theme_support("responsive-embeds");
    add_theme_support("title-tag");
    
    add_theme_support("disable-custom-colors", true );
    add_theme_support("editor-gradient-presets", []);
    add_theme_support("disable-custom-gradients", true);
    add_theme_support("wp-block-styles");
    add_theme_support("align-wide");
    // Adicionanado scripts ao rodapé
    if(function_exists("ht_get_script_footer")){
        add_action("wp_footer", "ht_get_script_footer");
    }
    // Adicionanado scripts ao cabeçalho
    if(function_exists("ht_get_script_head")){
        add_action("wp_footer", "ht_get_script_head");
    }
}
/**
 * Adicionando DEFER ao javascript
 * 
 * Peguei em https://www.minddevelopmentanddesign.com/blog/how-to-defer-parsing-enqueued-javascript-files-wordpress/
 */
function mind_defer_scripts( $tag, $handle, $src ) {
    $defer = array( 
      'plugins_js',
      'script_js',
    );
    if ( in_array( $handle, $defer ) ) {
       return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
    }
      
      return $tag;
  } 
  add_filter( 'script_loader_tag', 'mind_defer_scripts', 10, 3 );

  /**
   * 
   * Escondendo a barra de admin
   * 
   */
  add_filter( 'show_admin_bar', '__return_false' );

  /**
   * 
   * Garantindo que somente usuários logados acessaram as informações
   * 
   */

add_action('template_redirect', function(){
    if(!is_user_logged_in()){
        exit(wp_redirect( wp_login_url( ) ));
    }
});