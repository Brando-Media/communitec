<?php
namespace Integration\Autotask;

class Account {
  
  const DEFAULT_MODIFIED_DATE_DAYS  = 'yesterday';
  
  public function get_modified($last_modified_date=null) {
    if (empty($last_modified_date)) {
      $last_modified_date = gmdate('Y-m-d H:i:s', strtotime(self::DEFAULT_MODIFIED_DATE_DAYS));
    }
    $client = Config::client();
    $query = new \ATWS\AutotaskObjects\Query('Account');
    $package = new \ATWS\AutotaskObjects\QueryField('LastActivityDate');
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
}
