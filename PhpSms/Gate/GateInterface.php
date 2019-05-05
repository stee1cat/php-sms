<?php

/**
 * @package php-sms
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/php-sms
 */

namespace stee1cat\PhpSms\Gate;

use stee1cat\PhpSms\Message;

interface GateInterface
{
    public function setUser($user);
    public function setPassword($password);
    public function setMessage(Message $message);
    public function send();
}
