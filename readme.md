# Библиотека для отправки коротких сообщений через SMS-гейты


**Пример работы**

```php
require_once './php-sms/SmsFactory.php';

$sms = SmsFactory::create('SmsAero');
$sms->setUser('<login>');
$sms->setPassword('<password>');
$sms->setTo('75551234567');
$sms->setFrom('php-sms');
$sms->setText('Test message');
$sms->send();

```
**Доступные гейты**

* [Sms Aero](http://smsaero.ru/)