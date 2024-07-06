<?php
namespace Garb\App;

define('LIST_LOCAL', 'Garb/Lists');
define('IGNORE', array("." , ".." ));

class Json
{
  public static function scanDuplicityRefer(string $clientReference):bool|string
  {
    $clientRealReference = realpath($clientReference);
    unset($clientReference);
    
    foreach(scandir(LIST_LOCAL) as $k => $item){
      if(in_array($item, IGNORE)){continue;}
  
      $aliasName = substr($item, 0, -5);
      $jsonRealReference = self::getRefer($aliasName);
                          
      if($jsonRealReference == $clientRealReference){
        return $aliasName;//retorna o nome do alias onde foi encontrada a referência.
      }
    }

    return false;
  }

  public static function getRefer(string $aliasClientName):string
  {
    $aliasObj = self::getAliasContent($aliasClientName);
    return $aliasObj->realReference;//real diretório.;
  }
  
  public static function getListAliases():array
  {
    $ListAliases = [];
    
    foreach(scandir(LIST_LOCAL) as $k => $item){
      if(in_array($item, IGNORE)){continue;}
      
      $aliasName               = substr($item, 0, -5);//não altera $item.
      $realReference           = self::getRefer($aliasName);
      $ListAliases[$aliasName] = $realReference;
    }

    return $ListAliases;
  }

  public static function aliasExists(string $aliasClientName):bool
  {
    foreach(scandir(LIST_LOCAL) as $k => $item){
      if(in_array($item, IGNORE)){
        continue;
      }
                          
      $aliasItemName = substr($item, 0, -5);
      
      if($aliasClientName == $aliasItemName){
        return true;
      }
    }

    return false;
  }

  public static function getAliasContent(string $aliasClientName):Alias
  {
    $arrayFileContent = [];
    
    if(!$jsonFile = file_get_contents(LIST_LOCAL.'/'.$aliasClientName.'.json')){
      exit($aliasClientName.' not find. Try list aliases.'.PHP_EOL);
    }
    
    $arrayFileContent = json_decode($jsonFile, true);
    $aliasObj  = new Alias($aliasClientName, $arrayFileContent);
    return $aliasObj;
  }
}