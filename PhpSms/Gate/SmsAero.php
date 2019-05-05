<?php

/**
 * @package php-sms
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/php-sms
 */

namespace PhpSms\Gate;

use PhpSms;

/**
 * Класс для работы с API SMS Aero (@link http://smsaero.ru/)
 */
class SmsAero extends GateAbstract implements GateInterface
{
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
     * Сообщение
     *
     * @var PhpSms\Message
     */
    private $message;

    /**
     * Сеттер для имени пользователя
     *
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Устанавливает пароль для доступа к API
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    public function setMessage(PhpSms\Message $message)
    {
        $this->message = $message;
    }

    /**
     * Выполняет отправку сообщения
     *
     * @param boolean $json Возвращать ответ в JSON
     * @throws \Exception
     * @return mixed|string
     */
    public function send($json = true)
    {
        if ($this->message instanceof PhpSms\Message) {
            $params = array(
                'user' => $this->user,
                'password' => $this->password,
                'to' => $this->message->getTo(),
                'text' => $this->message->getText(),
                'from' => $this->message->getFrom()
            );
            if ($json) {
                $params['answer'] = 'json';
            }
            $result = $this->api('send', $params);
            return ($json)? json_decode($result, true): $result;
        } else {
            throw new \Exception('Message is required');
        }
    }
}
