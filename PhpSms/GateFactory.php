<?php

/**
 * @package php-sms
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/php-sms
 */

namespace stee1cat\PhpSms;

use stee1cat\PhpSms\Gate\GateAbstract;
use stee1cat\PhpSms\Gate\GateInterface;

/**
 * Класс фабрики
 */
class GateFactory
{
    /**
     * Метод получения объекта для работы с API SMS-гейта
     *
     * @param string $gate Имя SMS-гейта
     * @throws \Exception
     * @return GateAbstract|GateInterface
     */
    public static function create($gate = '')
    {
        $result = false;
        $gateClass = 'stee1cat\\PhpSms\\Gate\\'.$gate;
        if ($gate && $gateClass) {
            $result = new $gateClass();
        }

        return $result;
    }

    /**
     * Возвращает список доступных SMS-гейтов
     *
     * @return array
     */
    public static function getGates()
    {
        $result = array();
        $list = scandir(self::getBasePath().'Gate');
        foreach ($list as $file) {
            $match = array();
            $ignore = array('GateAbstract', 'GateInterface');
            if (preg_match('/^(.+)\.php$/iu', $file, $match) && !in_array($match[1], $ignore)) {
                $result[] = $match[1];
            }
        }
        return $result;
    }

    /**
     * Возвращает путь к директории в которой размещены классы для работы с API
     *
     * @return string
     */
    private static function getBasePath()
    {
        return dirname(__FILE__).DIRECTORY_SEPARATOR;
    }
}
