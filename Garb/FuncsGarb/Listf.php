<?php
namespace Garb\FuncsGarb;

use Garb\App\Validate;
use Garb\App\Json;
//use Garb\Enums\FuncsGarbEnums;
use Garb\Views\AliasList;


class Listf extends FuncsGarb
{
  public array $arguments = [];
  private string $clientArg = 'allAliasGet';

  public function __construct(array $arguments)
  {
    //echo __CLASS__.PHP_EOL;
    
    $this->arguments = $arguments;
    unset($arguments);
  }

  public function ifBrokenArgs()
  {
    Validate::BrokenArgs($this);
  }

  public function setInputs(){
    $this->alias = (count($this->arguments) == 1) ? $this->arguments[0] : false ;
    //var_dump($this);die();
  }

  public function preChecks()
  {
    if($this->alias == false){
      return;
    }
    
    if(!Json::aliasExists($this->alias)){
      exit('Alias: \''.$this->alias.'\' NOT exists. Try to list:'.PHP_EOL.'"php pgarb list"'.PHP_EOL);
    }

    $this->clientArg = 'oneAliasGet';
  }

  public function run()
  {
    //getAliasContent ou getListAliases
    $func = $this->clientArg;
    $arrOrObjAlias = $this->$func();//Alias(Obj) ou aliasesArray
    $flagFunction = (gettype($arrOrObjAlias) == 'array') ? 'listAll' : 'listOne';
    AliasList::$flagFunction($arrOrObjAlias);
  }

  public function finishing()
  {
    //
  }

  private function oneAliasGet()
  {
    $aliasObj = Json::getAliasContent($this->alias);//new Alias()
    return $aliasObj;
  }

  private function allAliasGet()
  {
    $aliasObjArray = Json::getListAliases();//array de Alias()
    return $aliasObjArray;
  }
}