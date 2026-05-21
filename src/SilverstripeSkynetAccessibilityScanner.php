<?php

namespace Skynettechnologies\SilverstripeSkynetAccessibilityScanner;

use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;

class SilverstripeSkynetAccessibilityScanner extends Extension
{
    private static $include_accessibilityscanner_policy_notification = true;
    private static $current_site_config = null;

    public function onBeforeInit()
    {
        $siteConfig = SiteConfig::current_site_config();
        self::set_current_site_config($siteConfig);
        self::set_allinoneaccessibility_policy_notification_enabled(true);
    }

    public function onAfterInit()
    {
        $siteConfig = SiteConfig::current_site_config();
        
        if (self::allinoneaccessibility_policy_notification_enabled()) {
            if (Config::inst()->get(static::class, 'load_jquery')) {
                Requirements::javascript('silverstripe/admin:thirdparty/jquery/jquery.js');
            }
            if (Config::inst()->get(static::class, 'load_jquery_defer')) {
                Requirements::javascript('silverstripe/admin:thirdparty/jquery/jquery.js', ['defer' => true]);
            }
        }
    }

    public static function set_current_site_config($input)
    {
        self::$current_site_config = $input;
    }

    public static function set_allinoneaccessibility_policy_notification_enabled($bool)
    {
        self::$include_accessibilityscanner_policy_notification = (bool) $bool;
    }
    public static function allinoneaccessibility_policy_notification_enabled()
    {
        return self::$include_accessibilityscanner_policy_notification;
    }
}
