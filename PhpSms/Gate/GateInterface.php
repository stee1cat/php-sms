<?php

    /**
     * @package php-sms
     * @author Gennadiy Hatuntsev <e.steelcat@gmail.com>
     * @link https://github.com/stee1cat/php-sms
     */

    namespace PhpSms\Gate;

    interface GateInterface {

        public function setUser($user);
        public function setPassword($password);
        public function send();

    }