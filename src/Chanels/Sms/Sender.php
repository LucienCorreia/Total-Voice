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

	/**
	 * __construct
	 */
	public function __construct() 
	{
		parent::__construct();
	}

	/**
	 * Message
	 * @param  string $message
	 * @return Sender
	 */
	public function message(string $message) : Sender 
	{
		$this->message = $message;

		return $this;
	}

	/**
	 * Phone
	 * @param  string $phone
	 * @return Sender
	 */
	public function phone(string $phone) : Sender 
	{
		$this->phone = preg_replace('([^\d]+)', '', $phone);

		return $this;
	}

	/**
	 * User response
	 * @param  bool   $userResponse
	 * @return Sender
	 */
	public function userResponse(bool $userResponse) : Sender 
	{
		$this->userResponse = $userResponse;

		return $this;
	}

	/**
	 * Multi SMS
	 * @param  bool   $multiSms
	 * @return Sender
	 */
	public function multiSms(bool $multiSms) : Sender 
	{
		$this->multiSms = $multiSms;

		return $this;
	}

	/**
	 * Created at
	 * @param  string $createdAt
	 * @return Sender
	 */
	public function createdAt(string $createdAt) : Sender 
	{
		$this->createdAt = $createdAt;

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