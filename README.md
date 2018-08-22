# Total Voice

![LGTM Grade](https://img.shields.io/badge/tag-v1.0-5a5.svg)

---

instale o pacote pelo composer

`composer require lucien-correia/total-voice`

rode vendor:publish e selecione o número corespondente

`php artisan vendor:publish`

insira seu token de acesso em config.totalvoice.token

```php
<?php
  
  return [
    'token' => env('TOTAL_VOICE_TOKEN', 'TOKEN')
  ];
  
````

---

#### Enviando SMS

```php

use TotalVoice\Chanels\Sms\Sender;

$sender = new Sender();

$sender->phone('(99) 99999-9999')->message('mensagem de texto')->send();

````
