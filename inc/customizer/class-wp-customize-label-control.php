<?php

if (class_exists('WP_Customize_Control')) {
    class WP_Customize_Label_Control extends WP_Customize_Control {
        public $type = '';

        // Constructor to handle arguments
        public function __construct($manager, $id, $args = null) {
            parent::__construct($manager, $id, $args);
            
            // Get the 'type' from the arguments and set it
            if (isset($args['type'])) {
                $this->type = $args['type'];
            }
        }

        public function render_content() {

            $type = $this->type;

            if (!empty($this->label)) {

                if($type == 'heading') {
                    echo '<h2>' . esc_html($this->label) . '</h2>';
                }

                if($type == 'text') {
                    echo '<p>' . esc_html($this->label) . '</p>';
                }
            }
        }
    }
}