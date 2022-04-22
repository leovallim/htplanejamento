<?php
/**
 * Adicionando favicon diretamente no cabeçalho
 */
add_action( 'wp_head', 'ht_add_favicon' );
function ht_add_favicon(){
    $facivon = get_field('ht_branding_favicon', 'options');
    
    if(!$favicon) return;

    echo "<link rel='shortcut icon' type='image/png' href='{$favicon[url]}'>";
}
/**
 * Formatando as redes sociais
 */
function ht_get_social($media = null){
    $social = null;

    if(get_field( 'ht_social_instagram' , 'options') ){
        $social['instagram'] = array(
            'url' => get_field('ht_social_instagram', 'options'),
            'icon' => '<i class="fa-brands fa-instagram"></i>',
        );
    }
    if(get_field( 'ht_social_facebook' , 'options') ){
        $social['facebook'] = array(
            'url' => get_field('ht_social_facebook', 'options'),
            'icon' => '<i class="fa-brands fa-facebook-f"></i>',
        );
    }
    if(get_field( 'ht_social_youtube' , 'options') ){
        $social['youtube'] = array(
            'url' => get_field('ht_social_youtube', 'options'),
            'icon' => '<i class="fa-brands fa-youtube"></i>',
        );
    }
    if(get_field( 'ht_social_google' , 'options') ){
        $social['google'] = array(
            'url' => get_field('ht_social_google', 'options'),
            'icon' => '<i class="fa-brands fa-google"></i>',
        );
    }
    if(get_field( 'ht_social_twitter' , 'options') ){
        $social['twitter'] = array(
            'url' => get_field('ht_social_twitter', 'options'),
            'icon' => '<i class="fa-brands fa-twitter"></i>',
        );
    }
    if(get_field( 'ht_social_linkedin' , 'options') ){
        $social['linkedin'] = array(
            'url' => get_field('ht_social_linkedin', 'options'),
            'icon' => '<i class="fa-brands fa-linkedin-in"></i>',
        );
    }

    return $media ? $social[$media] : $social;
}
/**
 * Pegando informações de contato
 */
function ht_get_contact(){
    if(!empty(get_field('ht_phone', 'options'))){
        
        $contact['phone']['icon'] = '<i class="fa-solid fa-phone"></i>';

        foreach(get_field('ht_phone', 'options') as $phone){
            $contact['phone']['number'][] = $phone['ht_phone_number'];
        }
    }
    if(!empty( get_field('ht_whatsapp_number', 'options') ) || !empty( get_field('ht_whatsapp_link', 'options') ) ){
        $contact['whatsapp']['icon'] = '<i class="fa-brands fa-whatsapp"></i>';

        $contact['whatsapp']['number'] = get_field('ht_phone_number', 'options') ?? 'WhatsApp';
        $contact['whatsapp']['url'] = get_field('ht_whatsapp_link', 'options') ?? 'https://wa.me/55'. str_ireplace(array(' ', '-', '.', '+', '(', ')'), '', get_field('ht_phone_number', 'options'));
        
    }
    if( !empty( get_field( 'ht_email', 'options' ) )  ){
        $contact['mail']['icon'] = '<i class="fa-solid fa-envelope"></i>';
        $contact['mail']['address'] = get_field( 'ht_email', 'options' );
    }

    if(!empty(get_field('ht_address', 'options'))){
        $contact['address'] = get_field('ht_address', 'options');
    }

    if(!empty(get_field('ht_map', 'options'))){
        $contact['map'] = get_field('ht_map', 'options');
    }

    return $contact;
}
/**
 * Pegando as informações usadas no cabeçalho
 */
function ht_header_info(){
    return array(
        'logo'          => get_field('ht_branding_logo', 'options') ?? null,
        'nav'           => get_field('ht_header_nav', 'options') ?? null,
        'cta'           => get_field('ht_header_cta', 'options') ?? null,
        'nav'           => get_field('ht_header_nav', 'options') ?? null,
        'social'        => ht_get_social(),
    );
}
/**
 * Pegando as informações usadas no rodapé
 */
function ht_footer_info(){
    return array(
        'logo'          => get_field('ht_footer_logo', 'options') ?? null,
        'info'          => get_field('ht_footer_logo_info', 'options') ?? null,
        'nav'           => get_field('ht_footer_nav', 'options') ?? null,
        'social'        => ht_get_social(),
    );
}
/**
 * Formatando links
 */
function ht_acf_link($link, $args = null){
    if($args['class']){
        $class = $args['class'];
        if(is_array($class)) $class = implode(' ', $class);
    }
    if($args['id']){
        $id = $args['id'];
        if(is_array($class)) $class = implode(' ', $id);
    }
    $target = $link['target'] ?? '_self';

    $return = "<a href=\"{$link['url']}\" target=\"{$target}\"";
    if($class){
        $return .= " class=\"{$class}\"";
    }
    if($id){
        $return .= " id=\"{$id}\"";
    }
    $return .= ">{$link['title']}</a>";

    return $return;
}
/**
 * Criando cabeçalho
 */
function ht_section($class = null, $id = null){
    if(is_array($class)){
        $class = implode(' ', $class);
    } 
    if(is_array($id)){
        $id = implode(' ', $id);
    }

    $section = '<section';
    if($class !== null){
        $section .= " class=\"{$class}\"";
    }
    if($id !== null){
        $section .= " id=\"{$id}\"";
    }

    $section .= ">";

    return $section;
}
/**
 * Formata classes da section
 */
function ht_section_class($main, $aux = null){
    if($aux === null) return $main;

    if(is_array($aux)){
        $aux = implode(' ', $aux);
    }
    return "{$main} {$aux}";
}
/**
 * Renderizando o Hero Slide
 */
function ht_format_hero($args, $index){
    echo ht_section(array('swiper', ht_section_class('hero', $args['block_class']) , "block-{$index}"), $args['block_id']);
        echo '<div class= "swiper-wrapper">';
            foreach($args['block_hero'] as $hero){
                echo '<div class="swiper-slide">';
                    $target = $hero['block_hero_link']['target'] ?? '_self';
                    echo "<a href=\"{$hero['block_hero_link']['url']}\" target=\"{$target}\">";
                        echo "<div class=\"hero__slide--large\"><img src=\"{$hero['block_hero_image_desktop']['url']}\" alt=\"{$hero['block_hero_image_desktop']['alt']}\"></div>";
                        echo "<div class=\"hero__slide--small\"><img src=\"{$hero['block_hero_image_mobile']['url']}\" alt=\"{$hero['block_hero_image_mobile']['alt']}\"></div>";
                    echo '</a>';
                echo '</div>';
            }
        echo '</div>';
        echo '<div class="swiper-button-prev hero__button"></div><div class="swiper-button-next hero__button"></div>';
    echo '</section>';
    
}
/**
 * Renderizando a Galeria
 */
function ht_format_gallery($args, $index){
    $content = $args["block_gallery"];
    
    echo ht_section(array('wrapper', ht_section_class('gallery', $args['block_class']), "block-{$index}"), $args['block_id']);

        echo '<div class="container">';
            if($content['block_gallery_title']){
                echo "<h2 class=\"title title--center\">{$content['block_gallery_title']}</h2>";
            }

            if($content['block_gallery_images']){
                echo '<ul class="gallery__list">';

                    foreach($content['block_gallery_images'] as $image){
                        echo '<li class="gallery__item">';
                            echo "<a href=\"{$image['url']}\" class=\"gallery__item__link\">";
                                echo "<img src=\"{$image['url']}\" alt=\"{$image['alt']}\" class=\"gallery__item__image\">";
                            echo '</a>';
                        echo '</li>';
                    }
    
                echo '</ul>';
            }
        
        echo '</div>';

    echo '</section>';
}
/**
 * Renderizando o Conteúdo
 */
function ht_format_text($args, $index){
    $content = $args['block_content'];
    $layout = (int) $content['block_content_layout'];

    if($layout == 2){
        $order = array('column--first', 'column--secound');
    }else{
        $order = array('column--secound','column--first');
    }
    echo ht_section(array('wrapper', ht_section_class('content', $args['block_class']), "block-{$index}"), $args['block_id']);
        echo '<div class="container">';
            
            /**
             * Coluna com o texto
             */
            echo "<div class=\"column content__text {$order[0]}\">";
                /**
                 * Título
                 */
                if($content['block_content_title']){
                    echo "<h2 class=\"title\">{$content['block_content_title']}</h2>";
                }
                /**
                 * Texto
                 */
                if($content['block_content_text']){
                    echo "<div class=\"content__text\">{$content['block_content_text']}</div>";
                }
                /**
                 * CTA
                 */
                if($content['block_content_link']){
                    echo '<div class="content__cta">';
                        echo ht_acf_link($content['block_content_link'], [
                            'class' => [
                                'button',
                                'content__cta__button',
                                'content__cta--'. $index,
                            ],
                        ]);
                    echo '</div>';
                }
            echo '</div>';

            /**
             * Coluna com as imagens
             */
            if($content['block_content_image']){
                
                echo "<div class=\"column content__image {$order[1]}\">";
                    echo '<div class="swiper content__image__box">';
                        echo '<div class="swiper-wrapper">';
                            foreach($content['block_content_image'] as $image){
                                echo '<div class="swiper-slide content__image__slide">';
                                    echo "<a href=\"{$image['url']}\" class=\"content__image__item\">";
                                        echo "<img src=\"{$image['url']}\" alt=\"{$image['alt']}\">";
                                    echo '</a>';
                                echo '</div>';
                            }
                        echo '</div>';

                    echo '</div>';
                    echo '<div class="swiper-pagination"></div>';
                echo '</div>';
            }
                
             
        echo '</div>';

    echo '</section>';
}
/**
 * Renderizando Lista de serviços
 */
function ht_format_services($args, $index){
    $content = $args['block_services'];
    if(!$content) return;
    // print '<pre>'; var_dump($content); print '</pre>';

    echo ht_section(array('wrapper', ht_section_class('services', $args['block_class']), "block-{$index}"), $args['block_id']);

        echo '<div class="container container--box">';
            foreach($content['block_services_list'] as $service){
                echo "<h2 class=\"title title--center services__title\">{$service['block_services_list_title']}</h2>";

                if(!empty($service['block_service_list_content'])){
                    echo '<div class="services__content">';
                        echo wpautop($service['block_service_list_content']);
                    echo '</div>';
                }

                if($service['block_services_list_items'] != null){
                    echo '<dic class="services__list">';
                    foreach($service['block_services_list_items'] as $item){
                        echo '<div class="services__item">';
                            if($item['block_services_list_item_icon']){
                                echo '<div class="services__item__icon">';
                                    echo "<img src=\"{$item['block_services_list_item_icon']['url']}\" alt=\"{$item['block_services_list_item_icon']['alt']}\" class=\"services__item__icon__image\">";
                                echo '</div>';
                            }
                            if($item['block_services_list_item_title']){
                                echo "<h3 class=\"title services__item__title\">{$item['block_services_list_item_title']}</h3>";
                            }
                            if($item['block_services_list_item_content']){
                                echo "<div class=\"content__text services__item__content\">{$item['block_services_list_item_content']}</div>";
                            }
                            if($item['block_services_list_item_cta']){
                                echo '<div class="services__item__cta">';
                                    echo ht_acf_link($item['block_services_list_item_cta'], [
                                        'class' => [
                                            'button',
                                            'services__item__cta__button',
                                        ],
                                    ]);
                                echo '</div>';
                            }
                        echo '</div>';
                    }
                    echo '</div>';
                }
            }
        echo '</div>';

    echo '</section>';
}
/**
 * Renderizando Vídeos
 */
function ht_format_video($args, $index){

    $content = $args['block_video'];
    echo ht_section(array('wrapper', ht_section_class('video', $args['block_class']), "block-{$index}"), $args['block_id']);
    echo '<div class="container">';

            if($args['block_video_title'] || $content['block_video_content']){

                if($content['block_video_title']){
                    echo "<h2 class=\"title title--center video__title\">{$content['block_video_title']}</h2>";
                }

                if($content['block_video_content']){
                    echo '<div class="column video__content">'. wpautop($content['block_video_content']) .'</div>';
                }

            }

            echo "<div class=\"video__embed\">{$content['block_video_embed']}</div>";

        echo '</div>';

    echo '</section>';
}
/**
 * Renderizando o mapa e o contato
 */
function ht_format_contact($args, $index){
    $content = $args['block_contact'];
    echo ht_section(array('map', ht_section_class('mapa', $args['block_class']), "block-{$index}"), $args['block_id']);

    $contact = ht_get_contact();
    // var_dump($contact);

    if($content['block_contact_show_map'] == 1 && $contact['map']){
        echo '<div class="map__item map__item--map">';
            echo $contact['map'];
        echo '</div>';

    }
    if($content['block_contact_show_map'] == 2){
        echo '<div class="map__item map__item--map">';
            echo "<img src=\"{$content['block_contact_image']['url']}\" alt=\"{$content['block_contact_image']['alt']}\" class=\"map__image\">";
        echo '</div>';

    }
    

    echo '<div class="map__item map__item--info">';
        echo '<div class="map_column">';
        if($content['block_contact_title']){
            echo "<h2 class=\"title title--dark map__title\">{$content['block_contact_title']}</h2>";
        }

        if(!empty( $contact['phone'] )){
            echo '<div class="contact__item contact__item--phone">';
                
                    echo '<h3 class="title title--dark contact__title--phone">';
                        if( count($contact['phone']['number']) == 1 ){
                            echo 'Telefone';
                        }else{
                            echo 'Telefones';
                        }
                    echo '</h3>';
                    echo '<ul class="contact__list">';
                        foreach($contact['phone']['number'] as $phone){
                            echo "<li class=\"contact__item\">{$contact['phone']['icon']}{$phone}</li>";
                        }
                    echo '</ul>';
            echo '</div>';
        }

        if(!empty( $contact['whatsapp']['number'] ) ){
            echo '<div class="contact__item contact__item--phone">';
            echo "<p class=\"contact__list__item\"><a href=\"{$contact['whatsapp']['url']}\" target=\"_blank\" class=\"button button--dark contact__button\">{$contact['whatsapp']['icon']} {$contact['whatsapp']['number']}</a></p>";
            echo '</div>';
        }
        if(!empty( $contact['mail'] )){
            echo '<div class="contact__item contact__item--phone">';
            echo "<p class=\"contact__list__item\"><a href=\"mailto:{$contact['mail']['address']}\" target=\"_blank\" class=\"button button--dark contact__button\">{$contact['mail']['icon']} {$contact['mail']['address']}</a></p>";
            echo '</div>';
        }
        echo '</div>';
    echo '</div>';
    

    echo '</section>';
}
/**
 * Renderizando Depoimentos
 */
function ht_format_testimonial($args, $index){
    $content = $args['block_testimonial'];
    $testimonials = get_field('ht_testimonials', 'options');

    if(!$testimonials) return;

    echo ht_section(array('wrapper', ht_section_class('testimonial', $args['block_class']), "block-{$index}"), $args['block_id']);
        echo '<div class="container container--box">';
            if($content['block_testimonial_title']){
                echo "<h2 class=\"title title--center testimonial__title\">{$content['block_testimonial_title']}</h2>";
            }

            echo '<div class="swiper testimonial__list">';
                echo '<div class="swiper-wrapper">';
                    foreach($testimonials as $t){
                        echo '<div class="swiper-slide">';
                            echo "<div class=\"testimonial__content\">{$t['ht_testimonials_content']}</div>";
                            echo "<div class=\"testimonial__info\">{$t['ht_testimonials_name']}</div>";
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';
            echo '<div class="testimonial__nav">';
                echo '<div class="testimonial__nav__item testimonial__nav__item--prev"><i class="fa-solid fa-circle-chevron-left"></i></div>';
                echo '<div class="testimonial__nav__item testimonial__nav__item--next"><i class="fa-solid fa-circle-chevron-right"></i></div>';
            echo '</div>';
        echo '</div>';
    echo '</section>';
}
/**
 * Definindo cada tipo de conteúdo
 */
function ht_format_content($args, $index){
    switch($args['block_type']){
        case 1: 
            ht_format_hero($args, $index);
            break;
        case 2: 
            ht_format_gallery($args, $index);
            break;
        case 3: 
            ht_format_text($args, $index);
            break;
        case 4: 
            ht_format_services($args, $index);
            break;
        case 5: 
            ht_format_video($args, $index);
            break;
        case 6: 
            ht_format_contact($args, $index);
            break;
        case 7: 
            ht_format_testimonial($args, $index);
            break;
        case 8: 
            echo '<div class="separator">&nbsp;</div>';
            break;
    }
}
/**
 * Renderizando a página
 */
function ht_content(){
    $page = get_queried_object();
    $content = get_field('block_elements', $page);

    if(!$content) return;

    foreach($content as $i => $block){
        ht_format_content($block, $i);
    }
}

/**
 * 
 * Planejamento
 * 
 * Pegando informações gerais
 * 
 */

function get_sazonal_info($p)
{
    $mounths = get_field('mounths', $p);

    if(empty($mounths)){
        return null;
    }

    foreach($mounths as $i => $m)
    {
        $return['calendar'][$i]['mounth'] = $m['mounth'];
        $return['calendar'][$i]['details'] = $m['details'];
        $return['calendar'][$i]['last_day'] = $m['last_day'];

        if(!empty($m['days']))
        {
            foreach($m['days'] as $j => $day){
                $return['calendar'][$i]['days'][$j]['date'] = $day['date'];
                $return['calendar'][$i]['days'][$j]['highlight'] = $day['highlight'];
                $return['calendar'][$i]['dates'][(int)$last_day = explode("-", $day['date'])[2]] = true;

                if(!empty($day['events']))
                {
                    foreach($day['events'] as $event){
                        $return['calendar'][$i]['days'][$j]['events'][] = $event;
                    }
                }
            }
            
        }
    }

    return $return;
}

/**
 * 
 * Formatando badges dos eventos
 * 
 */
function format_event($e){
    switch ($e) {
        case 1:
            return 'Normal';
            break;
        
        case 2:
            return array('text' => 'Feriado', 'class' => 'badge__warning');
            break;
        
        case 3:
            return array('text' => 'Potencial', 'class' => 'badge__danger');
            break;
        
        case 4:
            return array('text' => 'Comercial', 'class' => 'badge__success');
            break;
        
        default:
            return 'Normal';
            break;
    }
}

/**
 * 
 * Imprimindo as badges
 * 
 */
function get_event_badges($event){
    if(is_array($event)){
        foreach($event as $e){
            $badge = format_event($e);

            if($badge != 'Normal'){
                $return .= "<span class=\"badge {$badge['class']}\">{$badge['text']}</span>";
            }
        }
    }

    return $return;
}

/**
 * 
 * Retornando os planos de ação
 * 
 */
function get_event_plans($plans){
    if(!empty($plans)){
        $return .= '<ul class="calendar__item__dates__day__plans__list">';
        foreach($plans as $plan){
            // var_Dump($plan);
            $return .= '<li class="calendar__item__dates__day__plans__item">';
                $return .= '<a href="'. get_permalink( $plan ) .'" class="calendar__item__dates__day__plans__link">Ações</a>';
            $return .= '</li>';
        }
        $return .= '</ul>';

        return $return;
    }
}

/**
 * 
 * Formatando calendário
 * 
 */
function get_inline_calendar($last_day, $days = array()){

    $return = '<ul class="calendar__item__inline__list">';
    $last_day = explode("-", $last_day);

    $week = [
        "Dom",
        "Seg",
        "Ter",
        "Qua",
        "Qui",
        "Sex",
        "Sab",
    ];
    
    for ($i=1; $i <= (int)$last_day[2] ; $i++) { 
        $current_day = new DateTime($last_day[0] ."-". $last_day[1] ."-". $i);

        if(!empty($days[$i])){
            $class = "calendar__item__inline__item__day--content";
        }else{
            $class = "calendar__item__inline__item__day--no-content";
        }

        $return .= "<li class=\"calendar__item__inline__item {$class}\">";
            $return .= "<span class=\"calendar__item__inline__item__week\">". $week[$current_day->format('w')] ."</span>";
            $return .= "<span class=\"calendar__item__inline__item__day\">{$i}</span>";
        $return .="</li>";
    }

    $return .= '</ul>';

    return $return;
}