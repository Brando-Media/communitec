<?php
namespace Integration;

class Helper {
  
  protected static $map_account_autotask_xero  = array (
    'AccountName' => 'Name', 
    'Active' => '', 
    'AdditionalAddressInformation' => '', 
    'Address1' => '', 
    'Address2' => '', 
    'AlternatePhone1' => '', 
    'AlternatePhone2' => '', 
    'BillToAddress1' => '', 
    'BillToAddress2' => '', 
    'BillToAdditionalAddressInformation' => '', 
    'BillToCity' => '', 
    'BillToState' => '', 
    'BillToZipCode' => '', 
    'City' => '', 
    'Country' => '', 
    // Get email from contact
    //'Email' => 'EmailAddress', 
    'Fax' => '', 
    'Phone' => '', 
    'State' => '', 
    'PostalCode' => '', 
    'id' => 'ContactNumber', 
    'TaxID' => 'TaxNumber', 
    'WebAddress' => 'Website', 
  );
  
  public static function map_account_autotask_xero($at_account, $at_contact_account_emails) {
    $x_account  = array();
    //new dBug($at_account, '', 1);
    foreach (self::$map_account_autotask_xero as $at_field => $x_field) {
      if (property_exists($at_account, $at_field)) {
        $x_account[$x_field]  = $at_account->{$at_field};
      }
    }
    // Address
    //$x_account['ContactStatus']  = $at_account->Active ? 'ACTIVE' : 'ARCHIVED';
    //$x_account['IsCustomer']  = true;
    if (array_key_exists($at_account->id, $at_contact_account_emails) && ! empty($at_contact_account_emails[$at_account->id])) {
      $x_account['EmailAddress']  = $at_contact_account_emails[$at_account->id];
    }
    $x_account['Addresses'] = array (
      array (
        'AddressType'  => 'STREET',
        'AddressLine1'  => $at_account->Address1,
        'AddressLine2'  => $at_account->Address2,
        'AddressLine3'  => $at_account->AdditionalAddressInformation,
        'City'  => $at_account->City,
        'Region'  => $at_account->State,
        'PostalCode'  => $at_account->PostalCode,
        'Country'  => $at_account->Country,
      ),
      array (
        'AddressType'  => 'POBOX',
        'AddressLine1'  => $at_account->BillToAddress1,
        'AddressLine2'  => $at_account->BillToAddress2,
        'AddressLine3'  => $at_account->BillToAdditionalAddressInformation,
        'City'  => $at_account->BillToCity,
        'Region'  => $at_account->BillToState,
        'PostalCode'  => $at_account->BillToZipCode,
        'Country'  => $at_account->Country,
      ),
    );
    // Phones
    $x_account['Phones']  = array (
      array (
        'PhoneNumber' => $at_account->Phone, 
        'PhoneType'   => 'DEFAULT', 
      ),
      array (
        'PhoneNumber' => $at_account->AlternatePhone1, 
        'PhoneType'   => 'MOBILE', 
      ),
      array (
        'PhoneNumber' => $at_account->AlternatePhone2, 
        'PhoneType'   => 'DDI', 
      ),
      array (
        'PhoneNumber' => $at_account->Fax, 
        'PhoneType'   => 'FAX', 
      ),
    );
    
    return $x_account;
  }
  
}
