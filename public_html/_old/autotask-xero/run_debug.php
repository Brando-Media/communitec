<?php
require_once __DIR__ . '/config.php';
require_once 'dBug.php';

$autotask_account = new \Integration\Autotask\Account();
$autotask_contact = new \Integration\Autotask\Contact();
//$date = date('Y-m-d H:i:s', strtotime('-1 HOUR'));
//$date  = '2016-06-02 07:56:45';
$date = new DateTime('now', new DateTimeZone('America/New_York'));
$date->modify('-4 WEEK');
$at_accounts  = $autotask_account->get_modified($date->format('Y-m-d H:i:s'));
new dBug($at_accounts, '', 1);
$at_contacts  = $autotask_contact->get_modified($date->format('Y-m-d H:i:s'));
new dBug($at_contacts, '', 1);
$at_contact_account_emails = $autotask_contact->get_email_by_account_id($at_contacts);
new dBug($at_contacts, '', 1);
//die;
if ( ! is_array($at_accounts) || count($at_accounts) == 0) {
  exit;
}
//die;
$XeroContact = new \Integration\Xero\Contact();
foreach ($at_accounts as $at_account) {
  $data[] = \Integration\Helper::map_account_autotask_xero($at_account, $at_contact_account_emails);
}
try {
  $x_contacts = $XeroContact->add_multiple($data);
} catch (\Integration\Xero\Exception $e) {
  echo($e->getMessage());
}
new dBug($x_contacts, '', 1);

