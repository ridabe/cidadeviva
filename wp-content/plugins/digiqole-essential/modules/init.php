<?php 

class Digiqole_Modules{

    static function module_url(){
        return plugin_dir_url( __FILE__ );
    }

    public function run(){
        // die('foo');

        add_action('elementskit/loaded', function(){
            if(\ElementsKit::PACKAGE_TYPE != 'pro'){
                $this->include_files();
                $this->load_classes();
                add_action( 'wp_enqueue_scripts', [$this, 'scripts'] );
            }
        });
    }

    public function scripts(){
        
    }

    public function load_classes(){
        
    }

    public function include_files(){
        
        include 'elements/instagram-feed/instagram-feed.php';
    }

    public static $instance = null;

    public static function instance() {
        if ( is_null( self::$instance ) ) {

            // Fire the class instance
            self::$instance = new self();
            self::$instance;
        }

        return self::$instance;
    }
    
}

Digiqole_Modules::instance()->run();
