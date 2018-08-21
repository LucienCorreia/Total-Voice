<?php

namespace TotalVoice;

class TotalVoice {
	protected static $endpoint = 'https://api.totalvoice.com.br';
	protected static $token;

	public function __construct() {
		self::$token = config('totalvoice.token');
	}
}