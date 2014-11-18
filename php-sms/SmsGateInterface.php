<?php

    /**
     * @package php-sms
     * @author Gennadiy Hatuntsev <e.steelcat@gmail.com>
     * @link https://github.com/stee1cat/php-sms
     */

    interface SmsGateInterface {

        public function setUser($user);
        public function setPassword($password);
        public function setFrom($from);
        public function setTo($to);
        public function setText($text);
        public function send();

    }