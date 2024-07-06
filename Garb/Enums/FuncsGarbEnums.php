<?php
namespace Garb\Enums;

class FuncsGarbEnums
{
  public static function defineContent($flag):string
  {
    require_once 'Garb/Enums/'.$flag.'.php';
    return $content;
  }
}