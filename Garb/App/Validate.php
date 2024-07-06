<?php
namespace Garb\App;

use Garb\FuncsGarb\Save;
use Garb\FuncsGarb\Listf;
use Garb\FuncsGarb\Update;
use Garb\FuncsGarb\Clear;

class Validate
{
  public static function initialValidation(int $argc, array $argv): array
  {
    $arguments = [];
    if(count($argv) <= 1 ){//garb
      $function = 'help';
      return [$function, ['']];
    }
    
    foreach($argv as $key => $item){
      if($key == 0){continue;}//0=garb.php 1=função.
      if($key == 1){$function = $item;continue;}
      $arguments[] = $item;
    }

    return [$function, $arguments];
  }

  public static function BrokenArgs($object)
  {
    $r = explode('\\', get_class($object));
    $f = lcfirst(end($r));
    self::$f($object);
  }

  //faz toda a validação para save mas não altera objeto.
  private static function save(Save $save)
  {
    if(count($save->arguments) != 3){
      exit('Inadequate number of arguments. Please try: php garb.php help'.PHP_EOL);
    }
    
    if(!is_dir($save->arguments[0])){
      exit($save->arguments[0].' Is not a valid directory.'.PHP_EOL.'WARNING: "\" is not valid! Use "/"'.PHP_EOL);
    }

    if($save->arguments[1] != 'as'){
      exit('Try this comand: '.PHP_EOL.'php garb save <directory/subdir> as <alias>'.PHP_EOL);
    }
  }

  private static function listf(Listf $listf)
  {
    if(count($listf->arguments) >= 2){
      exit('Inadequate number of arguments. Please try: php garb.php help'.PHP_EOL);
    }
  }

  private static function update(Update $update)
  {
    if(count($update->arguments) != 1){
      exit('Inadequate number of arguments. Please try: php garb.php help'.PHP_EOL);
    }
  }

  private static function clear(Clear $clear)
  {
    if(count($clear->arguments) != 1){
      exit('Inadequate number of arguments. Please try: php garb.php help'.PHP_EOL);
    }
  }
  
}