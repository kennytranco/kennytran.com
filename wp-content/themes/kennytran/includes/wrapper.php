<?php

/*******************************************************************************
//
//
//
//  #WRAPPER
//  -> Functions for wrapper
//
//
//
*******************************************************************************/

function kennytranco_base() {
    return kennytranco_wrapping::$base;
}

function kennytranco_path() {
    return kennytranco_wrapping::$main_template;
}

class kennytranco_wrapping {
    static $main_template;
    static $base;

    static function wrap($template) {
        self::$main_template = $template;

        self::$base = substr(basename(self::$main_template), 0, -4);

        if('index' == self::$base)
            self::$base = false;

        $custom_post_type = get_post_type();
        $templates = array('base.php');

        if($custom_post_type)
            array_unshift($templates, sprintf('base-%s.php', $custom_post_type));

        if(self::$base)
            array_unshift($templates, sprintf('base-%s.php', self::$base));

        return locate_template($templates);
    }
}
add_filter('template_include', array('kennytranco_wrapping', 'wrap'), 99);

?>
