<?php

namespace TotalVoice\Channels\Composto;

use TotalVoice\TotalVoice;
use GuzzleHttp\Client;

class Sender extends TotalVoice {
	
	protected $uri = '/composto';

	protected $data;

	protected $receiverPhone;

	protected $callerPhone;

	protected $recordAudio;

	protected $tags;

	/**
	 *  __construct
	 */
	public function __construct() 
	{
		parent::__construct();
	}

	/**
	 * Phone
	 * @param  string $phone
	 * @param  string $type  Receive 2 params, receiver or caller
	 * @return Sender
	 */
	public function phone(string $phone, string $type = 'receiver') : Sender 
	{
		if (strtolower($type) == 'receiver') {
			$this->receiverPhone = preg_replace('([^\d]+)', '', $phone);
		} else if (strtolower($type) == 'caller') {
			$this->callerPhone = preg_replace('([^\d]+)', '', $phone);
		} else {
			throw new Exception('Tipo de telefone inválido.');
		}

		return $this;
	}

	/**
	 * Record audio
	 * @param  bool|boolean $recordAudio
	 */
	public function recordAudio(bool $recordAudio = true) : Sender
	{
		$this->recordAudio = $recordAudio;
		return $this;
	}

	/**
	 * Tags
	 * @param  string $tags
	 * @return Sender
	 */
	public function tags(string $tags) : Sender
	{
		$this->tags = $tags;
		return $this;
	}

	/**
	 * Audio
	 * @param  string $audioUrl
	 * @return Sender
	 */
	public function audio(string $audioUrl) : Sender
	{
		$data = [];

		$data['acao'] = 'audio';
		$data['acao_dados'] = [
			'url_audio' => $url
		];

		$this->data = $data;

		return $this;
	}

	public function tts(string $message, $userResponse = 'true', $speed = '-4', $voiceType = 'br-Ricardo') : Sender
	{
		$data = [];

		$data['acao'] = 'tts';
		$data['acao_dados'] = [
			'mensagem' => $message,
			'velocidade' => $speed,
			'resposta_usuario' => $userResponse,
			'tipo_voz' => $voiceType
		];

		$this->data = $data;

		return $this;
	}

	public function transfer($receiverPhone, $callerPhone, $option = 1) : Sender
	{
		$data = [];

		$data['acao'] = 'transferir';
		$data['acao_dados'] = [
			'numero_telefone' => $receiverPhone,
			'bina' => $callerPhone
		];

		$this->data = $data;

		return $this;
	}

	/**
	 * Send
	 * @return bool|boolean
	 */
	public function send()
	{
		$client = new Client();

		try {
			$response = $client->post(parent::$endpoint . $this->uri, [
				'headers' => [
					'access-token' => parent::$token
				],
				'json' => [
					'numero_destino' => $this->receiverPhone,
					'dados' => $this->data,
					'bina' => $this->callerPhone,
					'gravar_audio' => $this->recordAudio ?? false,
					'tags' => $this->tags ?? ''
				],
			]);

			return true;
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}
}