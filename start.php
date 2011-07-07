<?php

register_elgg_event_handler('init', 'system', 'mail_override_init');

function mail_override_init() {
	register_notification_handler('email', 'mail_override_notify_handler');
}

function mail_override_notify_handler(ElggEntity $from, ElggUser $to, $subject, $message, array $params = NULL) {
	$email = get_plugin_setting('email_address', 'mail_override');
	if ($email) {
		$recipient = new ElggUser();
		$recipient->email = $email;

		$subject = "To: " . $to->name . " - " . $subject;
		email_notify_handler($from, $recipient, $subject, $message, $params);
	}
}