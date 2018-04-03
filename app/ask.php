<?php 

namespace Bot;

use \Bot\Di;

class Ask {

	public function __construct() {
		$this->ask();
	}

	private function ask() {
		$message = trim(Di::get('message_text'));
		$hash = base64_encode(Di::get('user_id') . '+' . Di::get('message_id'));
		$data = [
			'chat_id' => MASTER_USER_ID,
			'text' => "{$hash}\n" . $message
		];
		return Di::get('telegram')->sendMessage($data);
	}
}