<?php
namespace Integration\Autotask;

class Config {
  
  const USERNAME  = 'rory@communitec.co';
  const PASSWORD  = 'll08elo';
  const WSDL      = 'https://webservices4.autotask.net/ATServices/1.5/atws.wsdl';
  
  static $client;
  
  public static function client() {
    if (self::$client !== null) return self::$client;
    
    require_once ROOT_DIR . '/vendor/autotask-php-master/src/autoload.php';
    $authOpts = array(
      'login' => self::USERNAME,
      'password' => self::PASSWORD,
      'trace' => 1,   // Allows us to debug by getting the XML requests sent
    );
    self::$client = new \ATWS\Client(self::WSDL, $authOpts);
    return self::$client;
  }

}
