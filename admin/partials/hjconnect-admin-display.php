<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       iamleigh.com
 * @since      1.0.0
 *
 * @package    Hjconnect
 * @subpackage Hjconnect/admin/partials
 */
?>

<div class="wrap">

    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

    <form method="post" name="hotjar_options" action="options.php">

        <?php
        $options = get_option( $this->plugin_name );

        $hotjar_on = $options['hotjar_on'];
        $hotjar_id = $options['hotjar_id'];
        ?>

        <?php
        settings_fields( $this->plugin_name );
        do_settings_sections( $this->plugin_name );
        ?>

        <fieldset>
            
            <legend class="screen-reader-text"><span><?php _e( 'Enable Hotjar Connection', $this->plugin_name ); ?></span></legend>

            <label for="<?php echo $this->plugin_name; ?>-hotjar_on">
                
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-hotjar_on" name="<?php echo $this->plugin_name; ?>[hotjar_on]" value="1" <?php checked( $hotjar_on, 1 ); ?>/>
                
                <span><?php esc_attr_e( 'Enable Hotjar Connection', $this->plugin_name ); ?></span>

            </label>
            
            <fieldset>
                
                <legend class="screen-reader-text"><span><?php _e( 'Add your Hotjar ID', $this->plugin_name ); ?></span></legend>
                
                <input type="number" id="<?php echo $this->plugin_name; ?>-hotjar_id" name="<?php echo $this->plugin_name; ?>[hotjar_id]" value="<?php if ( ! empty( $hotjar_id ) ) echo $hotjar_id; ?>" placeholder="203040"/>
                
            </fieldset>

        </fieldset>

        <?php submit_button( __( 'Update', $this->plugin_name ), 'primary','submit', TRUE ); ?>

    </form>

</div>