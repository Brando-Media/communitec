<?php
namespace Integration\Xero;

class Config {
  
  const XERO_LIB_BASE_PATH  = 'vendor/XeroOAuth-PHP-master';
  
  //const CONSUMER_KEY      = 'LNLVY2JMWMRTNWLODW2CFDUUJBYUOO';
  //const CONSUMER_SECRET   = 'MHOYAVKITJ91KVXDDCFXJZTUIC0YHK';
  const CONSUMER_KEY      = 'N37ZSLZEKDXGF0YRSJE0TIP95MCV93';
  const CONSUMER_SECRET   = 'DKYWETCXLMUCXHXNJBLVSU7Y1OXLUC';
  const API_ENDPOINT_URL  = 'https://api.xero.com/api.xro/2.0/';
  
  const XRO_APP_TYPE      = 'Private';
  const OAUTH_CALLBACK    = 'oob';
  const USERAGENT         = 'Autotask-Xero sync';
  const RSA_PRIVATE_KEY   = 'Integration/Xero/cer/privatekey.pem';
  const RSA_PUBLIC_KEY    = 'Integration/Xero/cer/publickey.cer';
  
  static $client;
  static $signatures = array (
    'consumer_key'      => self::CONSUMER_KEY,
    'shared_secret'     => self::CONSUMER_SECRET,
    // API versions
    'core_version'      => '2.0',
    //'payroll_version' => '1.0',
    'file_version'      => '1.0', 
    'rsa_private_key'   => self::RSA_PRIVATE_KEY, 
    'rsa_public_key'    => self::RSA_PUBLIC_KEY, 
  );

  
  public static function client() {
    if (self::$client !== null) return self::$client;
    
    require_once ROOT_DIR . '/' . self::XERO_LIB_BASE_PATH . '/lib/XeroOAuth.php';
    $XeroOAuth = new \XeroOAuth ( array_merge ( array (
      'application_type' => self::XRO_APP_TYPE,
      'oauth_callback' => self::OAUTH_CALLBACK,
      'user_agent' => self::USERAGENT 
    ), self::$signatures ) );
    
    $initialCheck = $XeroOAuth->diagnostics ();
    $checkErrors = count ( $initialCheck );
    if ($checkErrors > 0) {
      // you could handle any config errors here, or keep on truckin if you like to live dangerously
      foreach ( $initialCheck as $check ) {
        echo 'Error: ' . $check . PHP_EOL;
      }
      die;
    } else {
      $XeroOAuth->config ['access_token'] = $XeroOAuth->config ['consumer_key'];
      $XeroOAuth->config ['access_token_secret'] = $XeroOAuth->config ['shared_secret'];
    }
    //echo 'success';
    self::$client = $XeroOAuth;
    return self::$client;
  }

}
