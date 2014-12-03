# Библиотека для отправки коротких сообщений через SMS-гейты


**Пример работы**

```php
require_once './PhpSms/Autoloader.php';

PhpSms\Autoloader::register();

$sender = PhpSms\GateFactory::create('SmsAero');

$sender->setUser('<login>');
$sender->setPassword('<password>');

$message = new PhpSms\Message();
$message->setTo('75551234567');
$message->setFrom('php-sms');
$message->setText('Message');

$sender->setMessage($message);
$sender->send();
```
**Доступные гейты**

* [Sms Aero](http://smsaero.ru/)