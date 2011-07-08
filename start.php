<?php
/**
 * Mail override plugin
 */

register_elgg_event_handler('init', 'system', 'mail_override_init');

function mail_override_init() {
	register_notification_handler('email', 'mail_override_notify_handler');
}

/**
 * Mail override handler
 *
 * @param ElggEntity $from    Entity sending the email
 * @param ElggUser   $to      User receiving the email
 * @param string     $subject Subject of email
 * @param string     $message Body of the email
 * @param array      $params  Additional parameters
 * @return bool
 */
function mail_override_notify_handler(ElggEntity $from, ElggUser $to, $subject, $message, array $params = NULL) {
	global $CONFIG;

	$output_type = get_plugin_setting('output', 'mail_override');
	if ($output_type == 'email') {
		$email = get_plugin_setting('email_address', 'mail_override');
		if ($email) {
			$recipient = new ElggUser();
			$recipient->email = $email;

			$subject = "To: " . $to->name . " - " . $subject;
			return email_notify_handler($from, $recipient, $subject, $message, $params);
		}
	} else {
		$location = get_plugin_setting('location', 'mail_override');

		$site = get_entity($CONFIG->site_guid);
		$from = $site->email;

		$email = "To: $to->name\n";
		$email .= "From: $from\n";
		$email .= "Subject: $subject\n";
		$email .= "$message\n\n";

		return file_put_contents($location, $email, FILE_APPEND | LOCK_EX);
	}
}