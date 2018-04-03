<?php

namespace Bot;

use Di;

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
		$ask_message = trim(Di::get('update')['message']['reply_to_message']['text']);
		$data = [
			'chat_id' => base64_decode(explode('  ', $ask_message)[0]),
			'text' => Di::get('message_text')
		];
		return Di::get('telegram')->sendMessage($data);
	}

	private function forward() {
		$ask_message = trim(Di::get('update')['message']['reply_to_message']['text']);
		$data = [
			'chat_id' => CHANNAL_ID,
			'text' => substr(explode('  ', $ask_message)[0], 0, 4)
		];
		return Di::get('telegram')->sendMessage($data);
	}

}