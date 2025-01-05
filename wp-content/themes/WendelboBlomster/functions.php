<?php
function wendelbo_files(){
    wp_enqueue_style('main_styles', get_theme_file_uri('assets/css/mainstyle.css'));
}
add_action('wp_enqueue_scripts', 'wendelbo_files');