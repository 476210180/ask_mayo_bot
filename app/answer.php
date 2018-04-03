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
		$ask_message = Di::get('update')['message']['reply_to_message']['text'];
		$parts = explode("\n", $ask_message);
		$i = 0;
		$text = '';
		foreach ($parts as $line) {
			$i == 0 ? '' : $text .= $line;
			($i + 1) !== count($parts) ? $text .= "\n" : ''; 
			$i++;
		}
		$data = [
			'chat_id' => CHANNAL_ID,
			'text' => strtolower(substr(base64_encode(date('H:i')), 0, 4)) . "\n" . $text . "\n\n" . trim(Di::get('message_text'))
		];
		return Di::get('telegram')->sendMessage($data);
	}

}