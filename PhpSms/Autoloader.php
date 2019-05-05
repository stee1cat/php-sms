<?php

/**
 * @package php-sms
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/php-sms
 */

namespace PhpSms;

class Autoloader
{
    const PREFIX = 'PhpSms\\';

    /**
     * Регистрация автозагрузчика
     *
     * @return void
     */
    public static function register()
    {
        spl_autoload_register(array(new self, 'autoload'));
    }

    /**
     * Автозагрузка классов
     *
     * @param string $className
     */
    public static function autoload($className)
    {
        $length = strlen(self::PREFIX);
        if (0 === strncmp(self::PREFIX, $className, $length)) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, substr($className, $length));
            $path = (empty($file)) ? '' : DIRECTORY_SEPARATOR;
            $file = realpath(__DIR__ . $path . $file . '.php');
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }
}
