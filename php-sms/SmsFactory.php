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
            $basePath = self::getBasePath();
            $gatePath = $basePath.'gates'.DIRECTORY_SEPARATOR.$gate.'.php';
            if ($gate && file_exists($gatePath)) {
                require_once $basePath.'SmsGateAbstract.php';
                require_once $basePath.'SmsGateInterface.php';
                require_once $gatePath;
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
        private static function getBasePath() {
            return dirname(__FILE__).DIRECTORY_SEPARATOR;
        }

    }