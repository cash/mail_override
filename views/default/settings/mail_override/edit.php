<?php
/**
 * Plugin settings for mail override
 */

$email_address = $vars['entity']->email_address;

echo "<p>";
echo elgg_echo('mailover:email') . ': ';
echo elgg_view('input/text', array(
	'internalname' => 'params[email_address]',
	'value' => $email_address,
));
echo '</p>';
