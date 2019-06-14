<?php
namespace Integration\Xero;

class Contact {
  
  const DEFAULT_MODIFIED_DATE_DAYS  = 'yesterday';
  
  public function get($ContactNumber) {
    $XeroOAuth = Config::client();
    $response = $XeroOAuth->request('GET', $XeroOAuth->url('Contacts/'.$ContactNumber, 'core'), array(), '', 'json');
    if ($XeroOAuth->response['code'] == 200) {
      $contacts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
      if (is_object($contacts) && property_exists($contacts, 'Status') && $contacts->Status == 'OK') {
        return $contacts;
      }
    }    
    throw new Exception(print_r($response, 1));
  }
  
  public function add_multiple($data) {
    $xml  = '<Contacts>';
    foreach ($data as $x_contact) {
      $xml  .= $this->build_xml($x_contact);
    }
    $xml  .= '</Contacts>';
    //new \dBug(json_decode(json_encode(simplexml_load_string($xml))), '', 1);
    
    $XeroOAuth = Config::client();
    $response = $XeroOAuth->request('POST', $XeroOAuth->url('Contacts', 'core'), array(), $xml, 'json');
    if ($XeroOAuth->response['code'] == 200) {
      $contacts = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
      //new \dBug($contacts, '', 1);
      if (is_object($contacts) && property_exists($contacts, 'Status') && $contacts->Status == 'OK') {
        return $contacts->Contacts;
      }
    }
    new \dBug($response, '', 1);
    throw new Exception(print_r($response, 1));
  }
  
  public function add($data) {
    $xml  = $this->build_xml($data);
    $XeroOAuth = Config::client();
    $response = $XeroOAuth->request('POST', $XeroOAuth->url('Contacts', 'core'), array(), $xml, 'json');
    if ($XeroOAuth->response['code'] == 200) {
      $contact = $XeroOAuth->parseResponse($XeroOAuth->response['response'], $XeroOAuth->response['format']);
    }
    throw new Exception(print_r($response, 1));
  }
  
  public function build_xml($data) {
    $xml  = '';
    $XMLWriter  = new \XMLWriter();
    $XMLWriter->openMemory();
    $XMLWriter->startElement('Contact');
    if (isset($data['ContactNumber'])) {
      $XMLWriter->writeElement('ContactNumber', $data['ContactNumber']);
    }
    if (isset($data['ContactStatus'])) {
      $XMLWriter->writeElement('ContactStatus', $data['ContactStatus']);
    }
    if (isset($data['Name'])) {
      $XMLWriter->writeElement('Name', $data['Name']);
    }
    if (isset($data['FirstName'])) {
      $XMLWriter->writeElement('FirstName', $data['FirstName']);
    }
    if (isset($data['LastName'])) {
      $XMLWriter->writeElement('LastName', $data['LastName']);
    }
    if (isset($data['EmailAddress'])) {
      $XMLWriter->writeElement('EmailAddress', $data['EmailAddress']);
    }
    if (isset($data['Addresses'])) {
      $XMLWriter->startElement('Addresses');
      foreach ($data['Addresses'] as $add) {
        $XMLWriter->startElement('Address');
        $XMLWriter->writeElement('AddressType', isset($add['AddressType']) ? $add['AddressType'] : 'POBOX');
        $XMLWriter->writeElement('AddressLine1', isset($add['AddressLine1']) ? $add['AddressLine1'] : '');
        $XMLWriter->writeElement('AddressLine2', isset($add['AddressLine2']) ? $add['AddressLine2'] : '');
        $XMLWriter->writeElement('AddressLine3', isset($add['AddressLine3']) ? $add['AddressLine3'] : '');
        $XMLWriter->writeElement('City', isset($add['City']) ? $add['City'] : '');
        $XMLWriter->writeElement('Region', isset($add['Region']) ? $add['Region'] : '');
        $XMLWriter->writeElement('PostalCode', isset($add['PostalCode']) ? $add['PostalCode'] : '');
        $XMLWriter->writeElement('Country', isset($add['Country']) ? $add['Country'] : '');
        $XMLWriter->endElement();
      }
      $XMLWriter->endElement();
    }
    if (isset($data['Phones'])) {
      $XMLWriter->startElement('Phones');
      foreach ($data['Phones'] as $phone) {
        $XMLWriter->startElement('Phone');
        $XMLWriter->writeElement('PhoneType', isset($phone['PhoneType']) ? $phone['PhoneType'] : 'DEFAULT');
        $XMLWriter->writeElement('PhoneNumber', isset($phone['PhoneNumber']) ? $phone['PhoneNumber'] : '');
        $XMLWriter->endElement();
      }
      $XMLWriter->endElement();
    }
    $XMLWriter->endElement();
    
    return $XMLWriter->outputMemory();
  }
  
}
