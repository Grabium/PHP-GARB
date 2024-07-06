<?php

namespace Garb\Views;

use Garb\App\Alias;

class AliasList
{
  public static function listOne(Alias $aliasObj)
  {
    print PHP_EOL.'File names writed on alias "'.$aliasObj->aliasName.'" :'.PHP_EOL.PHP_EOL;
    foreach($aliasObj->savedFiles as $item){
      print $item.PHP_EOL;
    }
    print PHP_EOL.'_____________________End list______________________'.PHP_EOL.PHP_EOL;
  }

  public static function listAll(array $aliasesArray)
  {
    print PHP_EOL.'Listing all aliases and their directory references:'.PHP_EOL.PHP_EOL;
    foreach($aliasesArray as $name => $realReference){
      $s = (20 - strlen($name));
      $points = ($s >= 1) ? str_repeat('.', $s) : '......';
      print 'Alias: '.$name.''.$points.'Directory: '.$realReference.''.PHP_EOL;
    }
    print PHP_EOL.'_____________________End list______________________'.PHP_EOL.PHP_EOL;
  }
}