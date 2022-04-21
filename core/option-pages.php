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
        $info = acf_add_options_page([
            "page_title"        => "Institucional",
            "menu_title"        => "Institucional",
            "menu_slug"         => "ht_branding_conf",
            "parent_slug"       => $general["menu_slug"],
        ]);
        $contact = acf_add_options_page([
            "page_title"        => "Contato e Social",
            "menu_title"        => "Contato e Social",
            "menu_slug"         => "ht_contact_conf",
            "parent_slug"       => $general["menu_slug"],
        ]);
        $header = acf_add_options_page([
            "page_title"        => "Cabeçalho",
            "menu_title"        => "Cabeçalho",
            "menu_slug"         => "ht_header_conf",
            "parent_slug"       => $general["menu_slug"],
        ]);
        $footer = acf_add_options_page([
            "page_title"        => "Rodapé",
            "menu_title"        => "Rodapé",
            "menu_slug"         => "ht_footer_conf",
            "parent_slug"       => $general["menu_slug"],
        ]);
        $nav = acf_add_options_page([
            "page_title"        => "Depoimentos",
            "menu_title"        => "Depoimentos",
            "menu_slug"         => "ht_testimonial_conf",
            "parent_slug"       => $general["menu_slug"],
        ]);
        $scripts = acf_add_options_page([
            "page_title"        => "Scripts",
            "menu_title"        => "Scripts",
            "menu_slug"         => "ht_script_conf",
            "parent_slug"       => $general["menu_slug"],
        ]);
    }
}