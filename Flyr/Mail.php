<?php namespace Flyr;

class Mail {
	public function send($template, $data, $from, $to, $subject = '', $attach = null) {
		$opts = require 'Config/email_config.php';
		$mail = new Components\Mail($opts);
		$mail->setEmailHeaders($from, $to);
		if($attach !== null) {
			$mail->emailAttachFiles($attach);
		}
		
		$mail->setEmailMessage($template, $data, $subject);
		return $mail->send();
	}
}