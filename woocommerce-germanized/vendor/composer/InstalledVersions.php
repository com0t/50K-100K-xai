<?php

namespace Composer;

use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-master',
    'version' => 'dev-master',
    'aliases' => 
    array (
    ),
    'reference' => 'ab5c0d0d0d189d41f54866a208052d17eca1ef25',
    'name' => 'vendidero/woocommerce-germanized',
  ),
  'versions' => 
  array (
    'automattic/jetpack-autoloader' => 
    array (
      'pretty_version' => 'v2.7.1',
      'version' => '2.7.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '5437697a56aefbdf707849b9833e1b36093d7a73',
    ),
    'baltpeter/internetmarke-php' => 
    array (
      'pretty_version' => 'v0.5.0',
      'version' => '0.5.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7657ee5a55eb80c77a35e35ce71c465364d73ab4',
    ),
    'composer/installers' => 
    array (
      'pretty_version' => 'v1.11.0',
      'version' => '1.11.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ae03311f45dfe194412081526be2e003960df74b',
    ),
    'dvdoug/boxpacker' => 
    array (
      'pretty_version' => '3.9.1',
      'version' => '3.9.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '539084bd7b55056fa8b8b789e8ad5d3ebf5e5c3e',
    ),
    'myclabs/deep-copy' => 
    array (
      'pretty_version' => '1.10.2',
      'version' => '1.10.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '776f831124e9c62e1a2c601ecc52e776d8bb7220',
      'replaced' => 
      array (
        0 => '1.10.2',
      ),
    ),
    'psr/log' => 
    array (
      'pretty_version' => '1.1.4',
      'version' => '1.1.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd49695b909c3b7628b6289db5479a1c204601f11',
    ),
    'roundcube/plugin-installer' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'setasign/fpdf' => 
    array (
      'pretty_version' => '1.8.3',
      'version' => '1.8.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '6a83253ece0df1c5b6c05fe7a900c660ae38afc3',
    ),
    'setasign/fpdi' => 
    array (
      'pretty_version' => 'v2.3.6',
      'version' => '2.3.6.0',
      'aliases' => 
      array (
      ),
      'reference' => '6231e315f73e4f62d72b73f3d6d78ff0eed93c31',
    ),
    'shama/baton' => 
    array (
      'replaced' => 
      array (
        0 => '*',
      ),
    ),
    'vendidero/one-stop-shop-woocommerce' => 
    array (
      'pretty_version' => 'v1.0.4',
      'version' => '1.0.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'dac5b9b0d3592fa23622e17e86e1ad2919c9f49c',
    ),
    'vendidero/woocommerce-germanized' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
      ),
      'reference' => 'ab5c0d0d0d189d41f54866a208052d17eca1ef25',
    ),
    'vendidero/woocommerce-germanized-dhl' => 
    array (
      'pretty_version' => 'v1.5.8',
      'version' => '1.5.8.0',
      'aliases' => 
      array (
      ),
      'reference' => '5a6601ad98ca5abcefac84c8dab2b7dbb7374d20',
    ),
    'vendidero/woocommerce-germanized-shipments' => 
    array (
      'pretty_version' => 'v1.5.6',
      'version' => '1.5.6.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd690e823fbbfdc7ab63122b47240dd62a21c95b0',
    ),
    'vendidero/woocommerce-trusted-shops' => 
    array (
      'pretty_version' => 'v4.0.11',
      'version' => '4.0.11.0',
      'aliases' => 
      array (
      ),
      'reference' => '3b8ee60cd8dd1d54e1964085e29f8b63e4968c54',
    ),
    'wsdltophp/wssecurity' => 
    array (
      'pretty_version' => '1.2.2',
      'version' => '1.2.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '6a450af3cd462cbf73fdb3a09e80322da893af4f',
    ),
  ),
);







public static function getInstalledPackages()
{
return array_keys(self::$installed['versions']);
}









public static function isInstalled($packageName)
{
return isset(self::$installed['versions'][$packageName]);
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

$ranges = array();
if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}





public static function getVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['version'])) {
return null;
}

return self::$installed['versions'][$packageName]['version'];
}





public static function getPrettyVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return self::$installed['versions'][$packageName]['pretty_version'];
}





public static function getReference($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['reference'])) {
return null;
}

return self::$installed['versions'][$packageName]['reference'];
}





public static function getRootPackage()
{
return self::$installed['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
}
}
