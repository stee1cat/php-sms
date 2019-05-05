# Библиотека для отправки коротких сообщений через SMS-гейты


## Пример работы

```php
use stee1cat\PhpSms\GateFactory;
use stee1cat\PhpSms\Message;

$sender = GateFactory::create('SmsAero');

$sender->setUser('<login>');
$sender->setPassword('<password>');

$message = new Message();
$message->setTo('75551234567');
$message->setFrom('php-sms');
$message->setText('Message');

$sender->setMessage($message);
$sender->send();
```

## Доступные гейты

* [Sms Aero](http://smsaero.ru/)
* [SMS.ru](http://sms.ru/)
