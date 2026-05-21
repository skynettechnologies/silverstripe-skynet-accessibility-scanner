<?php

namespace Skynettechnologies\SilverstripeSkynetAccessibilityScanner;

use SilverStripe\Core\Config\Config;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\ORM\DataExtension;

class SilverstripeSkynetAccessibilityScannerController extends Controller
{
    private static $current_site_config = null;

    private static $allowed_actions = [
        'index',
    ];

    private static $url_handlers = [
        'fetchallinoneaccessibility' => 'index',
    ];

    public function index(HTTPRequest $request)
    {
        
        $this->getResponse()->setBody(json_encode([
            'AioaWidgetLicenseKey' => $this->owner->getAioaWidgetLicenseKey(),
            'AioaWidgetColor' => $this->owner->getAioaWidgetColor(),
            'AioaWidgetPosition' => $this->owner->getAioaWidgetPosition(),
            'AioaWidgetIconType' => $this->owner->getAioaWidgetIconType(),
            'AioaWidgetIconSize' => $this->owner->getAioaWidgetIconSize(),
            'AioaKeyValid' => $this->owner->getAioaKeyValid(),
        ]));

        $this->getResponse()->addHeader("Content-type", "application/json");
       
        return $this->getResponse();
    }

    public function doInit()
    {
        $siteConfig = SiteConfig::current_site_config();
        self::set_current_site_config($siteConfig);
    }

    public function getAioaWidgetLicenseKey()
    {
        return self::$current_site_config->AioaWidgetLicenseKey;
    }

    public function getAioaWidgetColor()
    {
        return self::$current_site_config->AioaWidgetColor;
    }

    public function getAioaWidgetPosition()
    {
        return self::$current_site_config->AioaWidgetPosition;
    }

    public function getAioaWidgetIconType()
    {
        return self::$current_site_config->AioaWidgetIconType;
    }

    public function getAioaWidgetIconSize()
    {
        return self::$current_site_config->AioaWidgetIconSize;
    }

    public function getAioaKeyValid()
    {
        return self::$current_site_config->AioaKeyValid;
    } 
    public static function set_current_site_config($input)
    {
        self::$current_site_config = $input;
    }
}
