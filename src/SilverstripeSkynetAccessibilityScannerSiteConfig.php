<?php

namespace Skynettechnologies\SilverstripeSkynetAccessibilityScanner;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\View\Requirements;

class SilverstripeSkynetAccessibilityScannerSiteConfig extends DataExtension
{

    public function updateCMSFields(FieldList $fields)
    {


        // Start output buffering
        ob_start();

        // Include the PHP file (it will run, but output goes into the buffer)
        include 'settings.php';

        // Get the rendered HTML
        $html = ob_get_clean();

        $fields->addFieldsToTab(
            'Root.SkynetAccessibility Scanner',
            [
                LiteralField::create(
                    'CustomHtml',
                    $html
                )
            ]

        );

        $fields->addFieldsToTab(
            'Root.SkynetAccessibility Scanner',
            [
                LiteralField::create(
                    'CustomHtml',
                    ''
                )
            ]

        );

        Requirements::customScript(
            <<<JS
        (function($) {
           console.log("Custom Js");
        })(jQuery);
        JS
        );
    }
}
