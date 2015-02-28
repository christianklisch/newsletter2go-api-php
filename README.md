# Newsletter2Go API wrapper for PHP

This is a php plugin to send whitelisted e-mails via newsletter2go server. 

Features:
* Send whitelisted e-mails and newsletters
* E-Mail or SMS
* Usermanagement on server
* Groupmanagement on server
* Newslettermanagement on server

## More

* Detailed information at http://www.christian-klisch.de/e-mail-newsletter-whitelist-send.html
* API dokumentation at https://www.newsletter2go.de/pr/api/Newsletter2Go_API_Doku_latest.pdf?c0fc87

## Installation and usage

You can install this newsletter2go wrapper by using composer:

```
    "require": {
        "christianklisch/newsletter2go-api-php": "v3.2"
    }
```

Setup and sending simple e-mail:

```php
		// init with api-key
    $api = new \Newsletter2Go\Newsletter2GoService('1234567890abcdef');
    $api->setDebug(0);
    $api->setDefaultopentracking(0);
    $api->setDefaultlinktracking(0);

    $email = new \Newsletter2Go\Email();
    $email->setTo('you@myaddress.com');
    $email->setFrom('me@myaddress.com');
    $email->setSubject('Hello-Subject');
    $email->setText('Hello my friend');
    $email->setReply('me@myaddress.com');
        
    $res = $api->sendSingleMail($email);
```

## Contributors

* Christian Klisch http://www.christian-klisch.de


## Copyright and license

Copyright 2015 Christian Klisch, released under [the MIT](LICENSE) license.