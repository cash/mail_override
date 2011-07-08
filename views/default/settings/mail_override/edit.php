<?php
/**
 * Plugin settings for mail override
 */

$output = $vars['entity']->output;
if (!$output) {
	$output = 'email';
}
$email_address = $vars['entity']->email_address;
$location = $vars['entity']->location;

echo "<p>";
echo elgg_echo('mailover:output') . ': ';
echo elgg_view('input/radio', array(
	'internalname' => 'params[output]',
	'value' => $output,
	'options' => array(elgg_echo('mailover:email') => 'email', elgg_echo('mailover:file') => 'file'),
));
echo '</p>';

echo "<p>";
echo elgg_echo('mailover:email_address') . ': ';
echo elgg_view('input/text', array(
	'internalname' => 'params[email_address]',
	'value' => $email_address,
));
echo '</p>';

echo "<p>";
echo elgg_echo('mailover:location') . ': ';
echo elgg_view('input/text', array(
	'internalname' => 'params[location]',
	'value' => $location,
));
echo '</p>';
