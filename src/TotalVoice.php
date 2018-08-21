<?php

namespace TotalVoice;

class TotalVoice {
	protected static $endpoint = 'https://api.totalvoice.com.br';
	protected $token;

	public function __construct() {
		$this->token = config('totalvoice.token');
	}
}