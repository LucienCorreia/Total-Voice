<?php

namespace TotalVoice\Chanels\Sms;

use TotalVoice\TotalVoice;
use GuzzleHttp\Client;

class Sender extends TotalVoice {
	
	protected $uri = '/sms';

	protected $message;
	protected $phone;
	protected $userResponse;
	protected $multiSms;
	protected $createdAt;

	public function __construct() {
		parent::__construct();
	}

	public function message(string $message) : Sender {
		$this->message = $message;

		return $this;
	}

	public function phone(string $phone) : Sender {
		$this->phone = preg_replace('([^\d]+)', '', $phone);

		return $this;
	}

	public function userResponse(bool $userResponse) : Sender {
		$this->userResponse = $userResponse;

		return $this;
	}

	public function multiSms(bool $multiSms) : Sender {
		$this->multiSms = $multiSms;

		return $this;
	}

	public function createdAt(string $createdAt) : Sender {
		$this->createdAt = $createdAt;

		return $this;
	}

	public function send() {
		$client = new Client();

		try {
			$response = $client->post(parent::$endpoint . $this->uri,
				[
					'headers' => [
						'access-token' => parent::$token
					],
					'json' => [
						'numero_destino' => $this->phone,
						'mensagem' => $this->message,
						'resposta_usuario' => $this->userResponse,
						'multi_sms' => $this->multiSms,
						'data_criacao' => $this->createdAt
					],
				]);

			return true;
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}
}