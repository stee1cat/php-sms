<?php

    /**
     * @package php-sms
     * @author Gennadiy Hatuntsev <e.steelcat@gmail.com>
     * @link https://github.com/stee1cat/php-sms
     */

    /**
     * Класс фабрики
     */
    class SmsFactory {

        /**
         * Метод получения объекта для работы с API SMS-гейта
         *
         * @param string $gate Имя SMS-гейта
         * @return object
         */
        public static function create($gate = '') {
            $result = false;
            $path = self::getPath().$gate.'.php';
            if ($gate && file_exists($path)) {
                require_once 'SmsGateInterface.php';
                require_once $path;
                $result = new $gate();
            }
            else {
                throw new Exception("SMS gate '".$gate."' not found!", 1);
            }
            return $result;
        }

        /**
         * Возвращает список доступных SMS-гейтов
         *
         * @return array
         */
        public static function getGates() {
            $result = array();
            $list = scandir(self::getPath());
            foreach ($list as $key => $file) {
                $match = array();
                if (preg_match('/^(.+)\.php$/iu', $file, $match)) {
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
        private static function getPath() {
            return dirname(__FILE__).DIRECTORY_SEPARATOR.'gates'.DIRECTORY_SEPARATOR;
        }

    }