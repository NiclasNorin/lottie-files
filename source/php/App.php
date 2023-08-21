<?php

namespace ModularityLottieFiles;

class App
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueueFrontend'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
        add_action('plugins_loaded', array($this, 'registerModule'));

        $this->cacheBust = new \ModularityLottieFiles\Helper\CacheBust();
    }

     /**
     * Enqueue required style
     * @return void
     */
    public function enqueueFrontend()
    {
        wp_register_style(
            'modularity-lottie-files-css',
            MODULARITYOPENSTREETMAP_URL . '/dist/' .
            $this->cacheBust->name('css/modularity-lottie-files.css')
        );

        wp_enqueue_style('modularity-lottie-files-css');

        wp_register_script(
            'modularity-lottie-files-js',
            MODULARITYOPENSTREETMAP_URL . '/dist/' .
            $this->cacheBust->name('js/modularity-lottie-files.js')
        );

        wp_enqueue_script('modularity-lottie-files-js');
    }

        /**
     * Register the module
     * @return void
     */
    public function registerModule()
    {
        if (function_exists('modularity_register_module')) {

            modularity_register_module(
                MODULARITYLOTTIEFILES_PATH . 'source/php/Module/',
                'LottieFiles'
            );
        }
    }
}
