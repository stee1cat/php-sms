<?php

    /**
     * @package php-sms
     * @author Gennadiy Hatuntsev <e.steelcat@gmail.com>
     * @link https://github.com/stee1cat/php-sms
     */

    /**
     * Файловый логгер
     */
    class SmsFileLog {

        /**
         * Путь к файлу лога
         *
         * @var string
         */
        private $file;

        /**
         * Файловый дескриптор
         *
         * @var resource
         */
        private $resource;

        /**
         * Формат записываемой даты
         *
         * @var string
         */
        private $dateFormat = 'd.m.Y H:i:s';

        /**
         * Используемая кодировка
         *
         * @var string
         */
        private $encoding = 'UTF-8';

        public function __destruct() {
            if ($this->resource) {
                fclose($this->resource);
            }
        }

        /**
         * Устанавливает путь к лог-файлу
         *
         * @param string $file
         */
        public function setFile($file) {
            $this->file = $file;
            $this->resource = fopen($file, 'a');
            if (!$this->resource) {
                throw new Exception("Log file '".$file."' not open!", 1);
            }
        }

        /**
         * Устанавливает формат записи даты в лог-файле
         *
         * @param string $format
         */
        public function setDateFormat($format) {
            $this->dateFormat = $format;
        }

        /**
         * Запись в файл
         *
         * @param string $message Сообщение
         * @param string $tag Тег
         * @return integer|boolean
         */
        public function write($message, $tag = '') {
            $result = false;
            if (is_string($message)) {
                $string = $this->prepare($message, $tag);
                $result = fwrite($this->resource, $string);
            }
            return $result;
        }

        /**
         * Форматирует строку перед записью
         *
         * @param string $message
         * @param string $tag
         * @return string
         */
        private function prepare($message, $tag) {
            $message = trim($message);
            $tag = trim(mb_strtoupper($tag, $this->encoding));
            $message = ($tag)? $tag.': '.$message: $message;
            $message = date($this->dateFormat).' '.$message.PHP_EOL;
            return $message;
        }

    }