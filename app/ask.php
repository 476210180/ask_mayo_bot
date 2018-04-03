<?php 

namespace Bot;

use \Bot\Di;

class Ask {

	public function __construct() {
		$this->ask();
	}

	private function ask() {
		$message = trim(Di::get('message_text'));
		$chat_id = base64_encode(Di::get('update')['message']['from']['id']));
		$data = [
			'chat_id' => 546902537,
			'text' => "{$chat_id}  " . date('H:i') . "\n" . $message
		];
		return Di::get('telegram')->sendMessage($data);
	}
}