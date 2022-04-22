<?php 
/**
 * Inserindo as páginas de opção ao tema
 */
add_action("acf/init", "ht_register_option_pages");
function ht_register_option_pages(){
    if(function_exists("acf_add_options_page")){
        $general = acf_add_options_page([
            "page_title"        => "Configurações gerais",
            "menu_title"        => "Configurações gerias",
            "menu_slug"         => "ht_general_conf",
            "capability"        => "edit_posts",
            "icon_url"          => "dashicons-screenoptions",
            "position"          => 2,
        ]);
    }
}