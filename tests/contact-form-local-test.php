<?php
if (PHP_SAPI !== 'cli' || !defined('ABSPATH')) { http_response_code(404); exit; }
/** npm run local:wp -- eval-file "$PWD/tests/contact-form-local-test.php" */
if (wp_get_environment_type() !== 'local') throw new RuntimeException('Local only.');
$GLOBALS['ccafe_contact_checks'] = 0;
function ccafe_contact_assert($condition, $message) {
    if (!$condition) throw new RuntimeException('FAIL: ' . $message);
    $GLOBALS['ccafe_contact_checks']++;
}
$original = [
    'form' => '[text* text-1101 placeholder "imię"] [text* text-1101 placeholder "temat wiadomości"]',
    'mail' => ['subject'=>'KONTAKT Od: [text-1101]', 'body'=>"Od: [text-1101]\nTreść wiadomości:\n[text-1107]", 'recipient'=>'local-test@example.test', 'sender'=>'local-test@example.test'],
    'mail_2' => ['active'=>false, 'body'=>'Unchanged'],
];
$fixed=ccafe_contact_form_properties($original);
ccafe_contact_assert(substr_count($fixed['form'],'[text* text-1101 ') === 1, 'unique name field');
ccafe_contact_assert(substr_count($fixed['form'],'[text* ccafe-contact-subject ') === 1, 'unique required subject');
ccafe_contact_assert(strpos($fixed['mail']['body'],'Od: [text-1101]')!==false,'name remains mapped to sender');
ccafe_contact_assert(strpos($fixed['mail']['body'],'Temat: [ccafe-contact-subject]')!==false,'subject delivered separately');
foreach (['recipient','sender','subject'] as $key) ccafe_contact_assert($fixed['mail'][$key] === $original['mail'][$key], 'existing mail envelope preserved');
ccafe_contact_assert($fixed['mail_2'] === $original['mail_2'],'inactive second mail untouched');
ccafe_contact_assert(ccafe_contact_form_properties($fixed) === $fixed,'idempotent normalization');
$modern=$original; $modern['form']='[text* customer-name] [text* customer-subject]';
ccafe_contact_assert(ccafe_contact_form_properties($modern) === $modern,'edited configurations left intact');
$active=$original; $active['mail_2']['active']=true;
ccafe_contact_assert(strpos(ccafe_contact_form_properties($active)['mail_2']['body'],'[ccafe-contact-subject]')!==false,'active second template includes subject');
$form=WPCF7_ContactForm::get_instance(503);
$props=$form->get_properties();
ccafe_contact_assert(strpos($props['form'],'ccafe-contact-subject')!==false,'actual CF7 properties hook applied');
echo 'PASS: ' . $GLOBALS['ccafe_contact_checks'] . " contact-form checks (no emails sent)\n";
