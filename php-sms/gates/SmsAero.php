<?php

    /**
     * @package php-sms
     * @author Gennadiy Hatuntsev <e.steelcat@gmail.com>
     * @link https://github.com/stee1cat/php-sms
     */

    /**
     * Класс для работы с API SMS Aero (@link http://smsaero.ru/)
     */
    class SmsAero extends SmsGateAbstract implements SmsGateInterface {

        /**
         * URL запроса
         *
         * @var string
         */
        protected $url = 'http://gate.smsaero.ru/';

        /**
         * Логин в системе SMS Aero
         *
         * @var string
         */
        private $user = '';

        /**
         * Пароль в md5
         *
         * @var string
         */
        private $password = '';

        /**
         * Номер получателя
         *
         * @var string
         */
        private $to = '';

        /**
         * Текст сообщения
         *
         * @var string
         */
        private $text = '';

        /**
         * Подпись отправителя
         *
         * @var string
         */
        private $from = '';

        /**
         * Сеттер для имени пользователя
         *
         * @param string $user
         */
        public function setUser($user) {
            $this->user = $user;
        }

        /**
         * Устанавливает пароль для доступа к API
         *
         * @param string $password
         */
        public function setPassword($password) {
            $this->password = md5($password);
        }

        /**
         * Устанавливает текст сообщения
         *
         * @param string $text Текст
         */
        public function setText($text) {
            $this->text = $text;
        }

        /**
         * Устнавливает имя отправителя
         *
         * Максимальная длина до 11 символов. Имя должно быть зарегистрировано в панели управления.
         *
         * @param string $from
         */
        public function setFrom($from) {
            $this->from = $from;
        }

        /**
         * Устанавливает получателя
         *
         * @param string $to
         */
        public function setTo($to) {
            $this->to = preg_replace('/\D/iu', '', $to);
        }

        /**
         * Выполняет отправку сообщения
         *
         * @param boolean $json Возвращать ответ в JSON
         */
        public function send($json = true) {
            $params = array(
                'user' => $this->user,
                'password' => $this->password,
                'to' => $this->to,
                'text' => $this->text,
                'from' => $this->from
            );
            if ($json) {
                $params['answer'] = 'json';
            }
            $result = $this->api('send', $params);
            return ($json)? json_decode($result, true): $result;
        }

    }