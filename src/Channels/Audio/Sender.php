<?php

namespace TotalVoice\Channels\Audio;

use TotalVoice\TotalVoice;
use GuzzleHttp\Client;

class Sender extends TotalVoice {
	
	protected $uri = '/audio';

	protected $audioUrl;

	protected $receiverPhone;

	protected $callerPhone;

	protected $recordAudio;

	protected $userResponse;

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
	 * Audio url
	 * @param  string $audioUrl
	 * @return Sender
	 */
	public function audio(string $audioUrl) : Sender
	{
		$this->audioUrl = $audioUrl;
		return $this;
	}

	/**
	 * User response
	 * @param  bool|boolean $userResponse
	 * @return Sender
	 */
	public function userResponse(bool $userResponse) : Sender
	{
		$this->userResponse = $userResponse;
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
			$response = $client->post(parent::$endpoint . $this->uri,
				[
					'headers' => [
						'access-token' => parent::$token
					],
					'json' => [
						'numero_destino' => $this->receiverPhone,
						'url_audio' => $this->audioUrl,
						'resposta_usuario' => $this->userResponse,
						'gravar_audio' => $this->recordAudio,
						'bina' => $this->callerPhone
					],
				]);

			return true;
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}
}