<?php

/**
 * @package php-sms
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/php-sms
 */

namespace stee1cat\PhpSms\Gate;

use stee1cat\PhpSms\Log\FileWriter;

/**
 * Абстрактный класс для SMS-гейта реализующий общие методы
 */
abstract class GateAbstract
{
    /**
     * Объект лога
     *
     * @var FileWriter
     */
    protected $log = null;

    /**
     * Сеттер для установки лог врайтера
     *
     * @param FileWriter $writer
     */
    public function setLogWriter(FileWriter $writer)
    {
        $this->log = $writer;
    }

    /**
     * Выполняте запрос к API сервиса
     *
     * @param string $action Метод API
     * @param array $params Дополнительные параметры
     * @return mixed|string
     */
    protected function api($action, $params = array())
    {
        $response = '';
        if ($action) {
            $url = $this->buildQuery($action, $params);
            $resource = curl_init($url);
            curl_setopt_array($resource, array(
                CURLOPT_RETURNTRANSFER => true
            ));
            $response = curl_exec($resource);
            if (false === $resource) {
                $this->write(curl_error($resource), 'ERROR');
            }
            curl_close($resource);
        }
        return $response;
    }

    /**
     * Формирует URL-запроса
     *
     * @param string $action Метод API
     * @param array $params Дополнительные параметры
     * @return string
     */
    protected function buildQuery($action, $params = array())
    {
        $url = $this->url.trim($action, '/').'/';
        if (count($params)) {
            $url .= '?'.http_build_query($params);
        }
        return $url;
    }

    /**
     * Производит запись в лог-файл
     *
     * @param string $message Сообщение
     * @param string $tag Тег
     */
    private function write($message, $tag)
    {
        if ($this->log) {
            $this->log->write($message, $tag);
        }
    }
}
