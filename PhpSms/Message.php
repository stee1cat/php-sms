<?php

/**
 * @package php-sms
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/php-sms
 */

namespace PhpSms;

class Message
{
    /**
     * Использовать транслитерацию
     *
     * @var bool
     */
    private $translit = false;

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
     * Использовать транслитерацию сообщения
     *
     * @param bool $translit
     */
    public function isTranslit($translit = true)
    {
        $this->translit = $translit;
    }

    /**
     * Устанавливает текст сообщения
     *
     * @param string $text Текст
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Возвращает текст сообщения
     *
     * @return string
     */
    public function getText()
    {
        return ($this->translit)? $this->toTranslit($this->text): $this->text;
    }

    /**
     * Устнавливает имя отправителя
     *
     * Максимальная длина до 11 символов. Имя должно быть зарегистрировано в панели управления.
     *
     * @param string $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * Возвращает отправителя сообщения
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Устанавливает получателя
     *
     * @param string $to
     */
    public function setTo($to)
    {
        $this->to = preg_replace('/\D/iu', '', $to);
    }

    /**
     * Возвращает получателя сообщения
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    public function toTranslit($string)
    {
        $abc = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v',
            'г' => 'g', 'д' => 'd', 'е' => 'e',
            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
            'и' => 'i', 'й' => 'y', 'к' => 'k',
            'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r',
            'с' => 's', 'т' => 't', 'у' => 'u',
            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
            'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',
            'А' => 'A', 'Б' => 'B', 'В' => 'V',
            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
            'И' => 'I', 'Й' => 'Y', 'К' => 'K',
            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R',
            'С' => 'S', 'Т' => 'T', 'У' => 'U',
            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
            'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya'
        );
        return iconv('UTF-8', 'UTF-8//IGNORE', strtr($string, $abc));
    }
}
