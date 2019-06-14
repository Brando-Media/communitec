<?php
namespace Integration\Autotask;

class Contact {
  
  const DEFAULT_MODIFIED_DATE_DAYS  = 'yesterday';
  
  public function get_modified($last_modified_date=null) {
    if (empty($last_modified_date)) {
      $last_modified_date = gmdate('Y-m-d H:i:s', strtotime(self::DEFAULT_MODIFIED_DATE_DAYS));
    }
    $client = Config::client();
    $query = new \ATWS\AutotaskObjects\Query('Contact');
    $package = new \ATWS\AutotaskObjects\QueryField('LastModifiedDate');
    $package->addExpression('greaterthan', $last_modified_date);
    $query->addField($package);
    $res  = $client->query($query);
    // Response should be an object
    if ( ! is_object($res)) {
      throw new Exception($res, Exception::CODE_INVALID_RESPONSE);
    }
    // Return code should be 1
    if ($res->queryResult->ReturnCode == -1) {
      throw new Exception($res->queryResult->Errors->ATWSError->Message);
    }
    
    $data = $res->queryResult->EntityResults->Entity;
    if (is_object($data)) {
      $data = array($data);
    }
    return $data;
  }
  
  public function get_email_by_account_id($contacts) {
    $contacts_data  = array();
    foreach ($contacts as $contact) {
      // If no account id, ignore contact
      if (empty($contact->AccountID)) continue;
      // If contact not active, ignore contact
      if ( ! $contact->Active) continue;
      // If a contact is already set for this account
      if ( ! empty($contacts_data[$contact->AccountID])) {
        // Only overwrite if the second contact is primary and has email address
        if ( ! ($contact->PrimaryContact && ! empty($contact->EMailAddress))) {
          continue;
        }
      }
      $contacts_data[$contact->AccountID] = $contact->EMailAddress;
    }
    
    return $contacts_data;
  }
  
}
