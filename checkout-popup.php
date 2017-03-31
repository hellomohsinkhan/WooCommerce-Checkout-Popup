<?php
/**
* Plugin Name: Checkout Popup plugin
* Plugin URI: https://github.com/hellomohsinkhan/
* Description: This plugin create a awesome checkout model with all woocommerce checkout funtionality...
* Version: 1.0 
* Author: Mohsin khan
* Author URI: https://github.com/hellomohsinkhan/
* License: GPL12
*/

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    global $woocommerce;

    function enque_script_fun() {
        wp_enqueue_script('main_js_my', plugin_dir_url(__FILE__) . 'js/main.js', array('jquery'), '1.0.0', false);
    }

    add_action('wp_enqueue_scripts', 'enque_script_fun');

    add_filter('woocommerce_locate_template', 'woo_checkout_model', 1, 3);

    function woo_checkout_model($template, $template_name, $template_path) {
        global $woocommerce;
        $_template = $template;
        if (!$template_path)
            $template_path = $woocommerce->template_url;

        $plugin_path = untrailingslashit(plugin_dir_path(__FILE__)) . '/woocommerce/';

        // Look within passed path within the theme - this is priority
        $template = locate_template(
                array(
                    $template_path . $template_name,
                    $template_name
                )
        );

        if (!$template && file_exists($plugin_path . $template_name))
            $template = $plugin_path . $template_name;

        if (!$template)
            $template = $_template;

        return $template;
    }

    /// Checkout popup functionality by ajax 
    function load_modalpopup_checkout() {

        if (!defined('WOOCOMMERCE_CHECKOUT')) {
            define('WOOCOMMERCE_CHECKOUT', true);
        }
        echo do_shortcode('[woocommerce_checkout]');

        wp_die();
    }

    add_action('wp_ajax_load_modalpopup_checkout', 'load_modalpopup_checkout');
    add_action('wp_ajax_nopriv_load_modalpopup_checkout', 'load_modalpopup_checkout');

    include('checkout-form.php');
}

