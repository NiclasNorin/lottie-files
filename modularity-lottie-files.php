<?php

/**
 * Plugin Name:       Modularity Lottie files
 * Plugin URI:        https://github.com/https://github.com/NiclasNorin/modularity-lottie-files
 * Description:       Modularity Lottie Files integration
 * Version:           1.0.0
 * Author:            Niclas Norin @ helsingborgsstad
 * Author URI:        https://github.com/https://github.com/NiclasNorin
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       modularity-lottie-files
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('MODULARITYLOTTIEFILES_PATH', plugin_dir_path(__FILE__));
define('MODULARITYLOTTIEFILES_URL', plugins_url('', __FILE__));
define('MODULARITYLOTTIEFILES_TEMPLATE_PATH', MODULARITYLOTTIEFILES_PATH . 'templates/');
define('MODULARITYLOTTIEFILES_TEXT_DOMAIN', 'modularity-lottie-files');
define('MODULARITYLOTTIEFILES_MODULE_VIEW_PATH', MODULARITYLOTTIEFILES_PATH . 'source/php/Module/views');

require_once MODULARITYLOTTIEFILES_PATH . 'Public.php';

// Register the autoloader
require __DIR__ . '/vendor/autoload.php';

add_filter('/Modularity/externalViewPath', function ($arr) {
    $arr['mod-lottie-files'] = MODULARITYLOTTIEFILES_MODULE_VIEW_PATH;

    return $arr;
}, 10, 3);


// Acf auto import and export
add_action('acf/init', function () {
    $acfExportManager = new \AcfExportManager\AcfExportManager();
    $acfExportManager->setTextdomain('modularity-lottie-files');
    $acfExportManager->setExportFolder(MODULARITYLOTTIEFILES_PATH . 'source/php/AcfFields/');
    $acfExportManager->autoExport(array(
        'modularity-lottie-files-settings' => 'group_61ea7a87e8aaa' //Update with acf id here, settings view
    ));
    $acfExportManager->import();
});

// Start application
new ModularityLottieFiles\App();

load_plugin_textdomain(MODULARITYLOTTIEFILES_TEXT_DOMAIN, false, MODULARITYLOTTIEFILES_PATH . '/languages');

