# Total Voice

![LGTM Grade](https://img.shields.io/badge/tag-v1.3-5a5.svg)

---

Instale o pacote pelo composer

`composer require lucien-correia/total-voice`

Rode vendor:publish e selecione o número corespondente

`php artisan vendor:publish`

Insira seu token de acesso em config.totalvoice.token

```php
<?php
  
  return [
    'token' => env('TOTAL_VOICE_TOKEN', 'TOKEN')
  ];
  
```

Ou no arquivo .env

```
TOTAL_VOICE_TOKEN=TOKEN
```

---

#### SMS : Envio de mensagens de texto via SMS

```php

use TotalVoice\Channels\Sms\Sender;

$sender = new Sender();

$sender->phone('(99) 99999-9999')
  ->message('mensagem de texto')
  ->send();

```

#### Audio : Envio de mensagens de voz (audio) / Torpedos de voz

Enviando um audio


```php

use TotalVoice\Channels\Audio\Sender;

$sender = new Sender();

$sender->phone('(99) 99999-9999', 'caller')
  ->phone('(99) 99999-9999', 'receiver')
  ->audio('http://minhaurlcomaudio.com')
  ->tags('clientX') // Opcional
  ->recordAudio(false) // Opcional
  ->send();

```

#### Composto : Envio de chamada de voz (torpedo de voz) composta com TTS e Audio

Enviando um audio 

```php

use TotalVoice\Channels\Composto\Sender;

$sender = new Sender();

$sender->phone('(99) 99999-9999', 'caller')
  ->phone('(99) 99999-9999', 'receiver')
  ->audio('http://minhaurlcomaudio.com')
  ->recordAudio(false) // Opcional
  ->send();

```

Enviando um TTS

```php

use TotalVoice\Channels\Composto\Sender;

$sender = new Sender();

$sender->phone('(99) 99999-9999', 'caller')
  ->phone('(99) 99999-9999', 'receiver')
  ->tts('meu texto a ser lido', 'false', '-4', 'br-Ricardo') 
  ->tags('clientX') // Opcional
  ->recordAudio(false) // Opcional
  ->send();

```

Enviando uma transferêcia

```php

use TotalVoice\Channels\Composto\Sender;

$sender = new Sender();

$sender->phone('(99) 99999-9999', 'caller')
  ->phone('(99) 99999-9999', 'receiver')
  ->transfer('(99) 99999-9999', '(99) 99999-9999', 1) 
  ->tags('clientX') // Opcional
  ->recordAudio(false) // Opcional
  ->send();

```

## Contato

Lucien Correia <lucienrc@outlook.com.br>

Marcus Campos <campos.v.marcus@gmail.com>
