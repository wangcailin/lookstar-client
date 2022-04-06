<?php

namespace Lookstar\Traits;

use Lookstar\Exceptions\ClientException;

trait InteractWithCheckEnv
{
    private static function checkEnv()
    {
        if (function_exists('get_loaded_extensions')) {
            //Test curl extension
            $enabled_extension = array("curl");
            $extensions = get_loaded_extensions();
            if ($extensions) {
                foreach ($enabled_extension as $item) {
                    if (!in_array($item, $extensions)) {
                        throw new ClientException("Extension {" . $item . "} is not installed or not enabled, please check your php env.");
                    }
                }
            } else {
                throw new ClientException("function get_loaded_extensions not found.");
            }
        } else {
            throw new ClientException('Function get_loaded_extensions has been disabled, please check php config.');
        }
    }
}
