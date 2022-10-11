
<?php
class Loco_Sosmed_Setting_page{
	 /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
    private $option_name = 'sosmed_option';
    private $option_group = 'sosmed_group_option';
    private $slug = 'social-media-admin';

    /**
     * Start up
     */
    public function __construct(){
        add_action( 'admin_menu', array( $this, 'add_loco_sosmed_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    public function add_loco_sosmed_plugin_page(){
    	add_options_page('Social Media Admin', 'Social Media', 'manage_options', $this->slug, array( $this, 'create_admin_page' ));
    }

     /**
     * Options page callback
     */
    public function create_admin_page(){
        // Set class property
        $this->options = get_option($this->option_name);
        ?>
        <div class="wrap">
            <h1>Social Media</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields($this->option_group);
                do_settings_sections($this->slug);
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init(){        
        register_setting(
            $this->option_group, // Option group
            $this->option_name, // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            $this->slug // Page
        );  

        //$arr_this_number = $this;
       	//array_push($arr_this_number,array('id'=>'id_number'));
        add_settings_field(
            'id_number', // ID
            'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback
            $this->slug, // Page
            'setting_section_id' // Section           
        );      

        add_settings_field('title', 'Title', array( $this, 'title_callback' ), $this->slug, 'setting_section_id');      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ){
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info(){
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function id_number_callback(){
    	print_r($this);
        printf(
            '<input type="text" id="id_number" name="my_option_name[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback(){
        printf(
            '<input type="text" id="title" name="my_option_name[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }


}
if( is_admin() )
    $my_settings_page = new Loco_Sosmed_Setting_page();
?>