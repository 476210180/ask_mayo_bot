<?php

namespace Bot;

use \Bot\Di;

class Commands {

	public function __construct() {
		$this->init();
	}

	private function init() {
		//preg_match_all('#(/[a-zA-Z0-9_]+)([\s\S]+)#', Di::get('message_text'), $matchs);
		$command = Di::get('message_text');
		//if (($command == '/start') || ($command == '/help')) {
		if ($command == '/help') {
			return $this->help();
		}
		if ($command == '/chat_id') {
			return $this->chat_id();
		}
	}

	private function help() {
		$data = [
			'chat_id' => Di::get('chat_id'),
			'text' => "向 真夜 说/问点什么：\n(匿名发送)\n\n在窗口发送想说的话~\n\n收到回复后会自动转发到频道 @ask_mayo\n加上 #private 关闭转发到频道。"
		];
		return Di::get('telegram')->sendMessage($data);
	}

	private function user_id() {
		$data = [
			'chat_id' => Di::get('chat_id'),
			'text' => Di::get('user_id')
		];
		return Di::get('telegram')->sendMessage($data);
	}


}