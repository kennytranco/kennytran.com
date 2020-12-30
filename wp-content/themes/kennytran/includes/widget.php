<?php

/*******************************************************************************
//
//
//
//  #WIDGETS
//  -> Functions for widgets
//
//
//
*******************************************************************************/

// Remove default widgets
function kennytranco_remove_default_widgets() {
    unregister_widget('WP_Nav_Menu_Widget');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Media_Audio');
    unregister_widget('WP_Widget_Media_Gallery');
    unregister_widget('WP_Widget_Media_Image');
    unregister_widget('WP_Widget_Media_Video');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Widget_Text');
}
add_action('widgets_init', 'kennytranco_remove_default_widgets', 11);

// Register sidebar and initiate widgets
function kennytranco_widgets_init() {
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar',
        'before_widget' => '<div class="%2$s">',
        'after_widget' => '</div>'
    ));

    //register_widget('kennytranco_widget');
}
add_action('widgets_init', 'kennytranco_widgets_init');


// Custom widget
class kennytranco_widget extends WP_Widget {

    // Register widget
    function __construct() {
        parent::__construct(
            // Widget ID
            'custom-widget',

            // Widget name
            'Custom Widget',

            // Widget description
            array('description' => 'Custom widget',)
        );
    }

    // Widget front-end
    public function widget($args, $instance) {
        if(!empty($instance['title']))
            $title = apply_filters('widget_title', $instance['title']);

        echo '<div class="sidebar__item">';

        if(!empty($title))
            echo $args['before_title'] .$title. $args['after_title'];

        echo '</div>';
    }

    // Widget back-end
    public function form($instance) {
        if(isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = 'Title';
        }
?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
<?php
    }

    // Sanitize widget form values
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }
}

?>
