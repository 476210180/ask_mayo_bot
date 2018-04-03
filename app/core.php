<?php 

namespace Bot;

use \Bot\Di;

class Core {

	private $update;

	public function __construct() {
		$telegram = new \Telegram(BOT_API_TOKEN);
		$update = $telegram->getData();
		$this->update = $update;
		Di::set('telegram', $telegram);
		Di::set('update', $update);
		Di::set('chat_id', $update['message']['chat']['id']);
		Di::set('message_id', $update['message']['message_id']);
		Di::set('message_text', $update['message']['text']);
	}

	private function isPrivate() {
		return $this->update['message']['chat']['type'] == 'private' ? true : false;
	}

	private function isCommand() {
		return substr(Di::get('message_text'), 0, 1) == '/' ? true : false;
	}

	private function isVaildMessage() {
		if (preg_match('/\S+/', Di::get('message_text')) && !empty(Di::get('message_id'))) {
			return true;
		}
		return false;
	}

	private function isMaster() {
		return $this->update['message']['chat']['id'] == MASTER_CHAT_ID ? true : false;
	}

	private function isAnswer() {
		if ($this->isMaster() && !is_null($this->update['message']['reply_to_message']['text'])) {
			return true;
		}
		return false;
	}

	public function run() {
		// Force Private Chat
		if (!$this->isPrivate() || !$this->isVaildMessage()) {
			echo 'Not Telegram Private Chat';
			exit;
		} 
		// Ask & Answer
		if ($this->isCommand()) {
			return new \Bot\Commands;
		}
		if ($this->isAnswer()) {
			return new \Bot\Answer;
		}
		return new \Bot\Ask();
	}

}
