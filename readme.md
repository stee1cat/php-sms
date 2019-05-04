# A PHP library to send messages via SMS gates

**Examle**

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
**Available agents**

* [Sms Aero](http://smsaero.ru/)
* [SMS.ru](http://sms.ru/)