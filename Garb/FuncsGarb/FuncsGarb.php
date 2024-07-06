<?php
namespace Garb\FuncsGarb;

use Garb\App\Json;

class FuncsGarb
{
  public string      $directory = '';
  public string          $alias = '';
  public string $aliasFileLocal = '';
  
  public static function getFunctionGarbObjectFactory(array $funcArgsValidateds): FuncsGarb
  {
    $function = array_shift($funcArgsValidateds);
    $arguments = array_shift($funcArgsValidateds);
    $functionsClass = get_class_methods(new FuncsGarb());//nativo do php.


    $f = self::_setFCall($function);
    $arguments = ($f == 'clearf') ? [$function] : $arguments ;
     
    if(!in_array($f, $functionsClass)){
      //Quando há uma função mas está errada:
      $arguments = ['Function "'.$function.'" not found.'];
      $f = 'helpf';
    }
    
    return self::$f($arguments);
  }

  private static function _setFCall(string $function)
  {
    foreach(Json::getListAliases() as $aliasName => $aliasItem){
      if($function == $aliasName){
        return 'clearf';
      }
    }

    return $function.'f';
  }

  private static function helpf($arguments)
  {
    return new Help($arguments);
  }

  private static function savef($arguments)
  {
    return new Save($arguments);
  }

  private static function listf($arguments)
  {
    return new Listf($arguments);
  }

  private static function updatef($arguments)
  {
    return new Update($arguments);
  }

  private static function clearf($arguments)
  {
    return new Clear($arguments);
  }
}