<?php

namespace stee1cat\PhpSms\Gate;

use stee1cat\PhpSms\Message;

/**
 * Класс для работы с API SMS.RU (@link http://sms.ru/)
 */
class SmsRu extends GateAbstract implements GateInterface
{
    /**
     * URL к API
     *
     * @var string
     */
    protected $url = 'http://sms.ru/';

    /**
     * API ID
     *
     * @var string
     */
    private $apiId;

    /**
     * Сообщение
     *
     * @var Message
     */
    private $message;

    /**
     * Устанавливает токен доступа к API
     *
     * @param string $apiId
     */
    public function setUser($apiId)
    {
        $this->apiId = $apiId;
    }

    public function setPassword($password)
    {
    }

    /**
     * @param Message $message
     */
    public function setMessage(Message $message)
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
        if ($this->message instanceof Message) {
            $params = array(
                'api_id' => $this->apiId,
                'from' => $this->message->getFrom(),
                'to' => $this->message->getTo(),
                'text' => $this->message->getText()
            );
            return $this->api('sms/send', $params);
        } else {
            throw new \Exception('Message is required');
        }
    }
}
