<?php
	// Modified version to control GLOBAL media playing

	require_once("CCBaseSender.php");

	class CCGlobalMediaPlayer extends CCBaseSender
	{
		public function pause() {
			// Pause
			$this->reconnect(); // Auto-reconnects
			$this->linkMedia(); // Relink mediastream
			$this->chromecast->sendMessage("urn:x-cast:com.google.cast.media",'{"type":"PAUSE", "mediaSessionId":' . $this->mediaid . ', "requestId":1}');
			$this->chromecast->getCastMessage();
		}

		public function restart() {
			// Restart (after pause)
			$this->reconnect(); // Auto-reconnects
			$this->linkMedia(); // Relink mediastream
			$this->chromecast->sendMessage("urn:x-cast:com.google.cast.media",'{"type":"PLAY", "mediaSessionId":' . $this->mediaid . ', "requestId":1}');
			$this->chromecast->getCastMessage();
		}
		
		public function seek($secs) {
			// Seek
			$this->reconnect(); // Auto-reconnects
			$this->linkMedia(); // Relink mediastream
			$this->chromecast->sendMessage("urn:x-cast:com.google.cast.media",'{"type":"SEEK", "mediaSessionId":' . $this->mediaid . ', "currentTime":' . $secs . ',"requestId":1}');
			$this->chromecast->getCastMessage();
		}
		
		public function stop() {
			// Stop
			$this->reconnect(); // Auto-reconnects
			$this->linkMedia(); // Relink mediastream
			$this->chromecast->sendMessage("urn:x-cast:com.google.cast.media",'{"type":"STOP", "mediaSessionId":' . $this->mediaid . ', "requestId":1}');
			$this->chromecast->getCastMessage();
		}
		
		public function getStatus() {
			// Get current media streaming status
			$this->reconnect(); // Auto-reconnects
			$this->chromecast->sendMessage("urn:x-cast:com.google.cast.media",'{"type":"GET_STATUS", "requestId":1}');
			$r = $this->chromecast->getCastMessage();
			$r = explode("{", $r);
			array_shift($r);
			$r = "{" . implode("{", $r);
			return $r;
		}
		
		public function Mute() {
			// Mute a video
			$this->reconnect(); // Auto-reconnects
			$this->chromecast->sendMessage("urn:x-cast:com.google.cast.receiver", '{"type":"SET_VOLUME", "volume": { "muted": true }, "requestId":1 }');
			$this->chromecast->getCastMessage();
		}
		
		public function UnMute() {
			// Mute a video
			$this->reconnect(); // Auto-reconnects
			$this->chromecast->sendMessage("urn:x-cast:com.google.cast.receiver", '{"type":"SET_VOLUME", "volume": { "muted": false }, "requestId":1 }');
			$this->chromecast->getCastMessage();
		}
		
		public function SetVolume($volume) {
			// Mute a video
			$this->reconnect(); // Auto-reconnects
			$this->chromecast->sendMessage("urn:x-cast:com.google.cast.receiver", '{"type":"SET_VOLUME", "volume": { "level": ' . $volume . ' }, "requestId":1 }');
			$this->chromecast->getCastMessage();
		}
	}

?>