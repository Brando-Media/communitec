<?php
error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING);
require_once __DIR__ . '/config.php';

$autotask_account = new \Integration\Autotask\Account();
$autotask_contact = new \Integration\Autotask\Contact();
//$date = date('Y-m-d H:i:s', strtotime('-1 HOUR'));
$date = new DateTime('now', new DateTimeZone('America/New_York'));
$date->modify('-1 HOUR');
$at_accounts  = $autotask_account->get_modified($date->format('Y-m-d H:i:s'));
if ( ! is_array($at_accounts) || count($at_accounts) == 0) {
  exit;
}
$at_contacts  = $autotask_contact->get_modified($date->format('Y-m-d H:i:s'));
// Get an array of form - account id  => contact email address
$at_contact_account_emails = $autotask_contact->get_email_by_account_id($at_contacts);

$XeroContact = new \Integration\Xero\Contact();
foreach ($at_accounts as $at_account) {
  $data[] = \Integration\Helper::map_account_autotask_xero($at_account, $at_contact_account_emails);
}
try {
  $x_contacts = $XeroContact->add_multiple($data);
} catch (\Integration\Xero\Exception $e) {
  echo($e->getMessage());
}
