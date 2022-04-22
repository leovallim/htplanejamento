<?php 

get_header();
get_template_part( 'template-parts/calendar', 'single', get_sazonal_info( get_queried_object(  ) ) );
get_footer();