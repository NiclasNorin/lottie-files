<?php

namespace ModularityLottieFiles\Module;

class LottieFiles extends \Modularity\Module
{
    public $slug = 'lottie-files';
    public $supports = array();
    public $blockSupports = array(
        'align' => ['full'],
        'mode' => false
    );

    public function init()
    {
        //Define module
        $this->nameSingular = __("LottieFiles", 'modularity-lottie-files');
        $this->namePlural = __("LottieFiles", 'modularity-lottie-files');
        $this->description = __("Lottie Files Description.", 'modularity-lottie-files');

        add_filter('Modularity/Block/Settings', function ($blockSettings, $slug) {
            if ($slug == $this->slug) {
                $blockSettings['mode'] = 'edit';
            }
            return $blockSettings;
        }, 10, 2);
    }

    public function data(): array
    {
        $fields = get_fields($this->ID);
        

        return $data ?? [];
    }

    public function template(): string
    {
        return 'lottie-files.blade.php';
    }

    /**
     * Available "magic" methods for modules:
     * init()            What to do on initialization
     * data()            Use to send data to view (return array)
     * style()           Enqueue style only when module is used on page
     * script            Enqueue script only when module is used on page
     * adminEnqueue()    Enqueue scripts for the module edit/add page in admin
     * template()        Return the view template (blade) the module should use when displayed
     */
}
