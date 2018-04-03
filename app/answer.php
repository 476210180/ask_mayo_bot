<?php

namespace Bot;

use \Bot\Di;

class Answer {

	public function __construct()
	{
		$this->answer();
	}

	private function answer() {
		$ask_message = Di::get('update')['message']['reply_to_message']['text'];
		$this->reply();
		if (!preg_match('/#private/', $ask_message)) {
			$this->forward();
		}
	}

	private function reply() {
		$ask_message = Di::get('update')['message']['reply_to_message']['text'];
		$hash = explode('+', base64_decode(explode("\n", $ask_message)[0]));
		$user_id = $hash[0];
		$message_id = $hash[1];
		$data = [
			'chat_id' => $user_id,
			'text' => '真夜：' . trim(Di::get('message_text')),
			'reply_to_message_id' => $message_id
		];
		return Di::get('telegram')->sendMessage($data);
	}

	private function forward() {
		$ask_message = trim(Di::get('update')['message']['reply_to_message']['text']);
		$data = [
			'chat_id' => CHANNAL_ID,
			'text' => strtolower(substr(explode('  ', $ask_message)[0], 0, 4)) . "\n" . $ask_message . "\n" . trim(Di::get('message_text'))
		];
		return Di::get('telegram')->sendMessage($data);
	}

}