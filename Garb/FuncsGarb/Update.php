<?php
namespace Garb\FuncsGarb;

use Garb\App\Json;
use Garb\App\Validate;
use Garb\Enums\FuncsGarbEnums;

class Update extends FuncsGarb
{
  public array $arguments = [];

  public function __construct(array $arguments)
  {
    $this->arguments = $arguments;
    unset($arguments);
  }

  public function ifBrokenArgs()
  {
    Validate::BrokenArgs($this);
  }

  public function setInputs()
  {
    $this->alias             = end($this->arguments);
    $this->aliasFileLocal    = __DIR__.'/../../Garb/Lists/'.$this->alias.'.json';
    unset($this->arguments);
  }

  public function preChecks()
  {
    if(!Json::aliasExists($this->alias)){
      exit('Alias: \''.$this->alias.'\' NOT exists. Try to list:'.PHP_EOL.'"php pgarb list"'.PHP_EOL);
    }
  }

  public function run()
  {
    $executableLocalName = $this->setExecutableName();

    $savedFileContent = $this->prepareContentsAlias();
    
    $this->createScript($executableLocalName);

    //roda o shell
    require_once $executableLocalName;
    //shell_exec($code);
    unlink($executableLocalName);
  }

  private function setExecutableName():string
  {
    $this->directory = Json::getRefer($this->alias);
    return $this->directory.'/update.php';
  }

  private function createScript(string $executableLocalName)
  {
    $content = FuncsGarbEnums::defineContent('updateRun');
    $content = str_replace('<<update.json>>', $this->aliasFileLocal, $content);
    file_put_contents($executableLocalName, $content);//cria o arquivo
  }
  
  private function prepareContentsAlias():array
  {
    $aliasObj = Json::getAliasContent($this->alias);
    return $aliasObj->savedFiles;
  }

  public function finishing()
  {/*
    $aliasObj = Json::getAliasContent($this->alias);
    new FinishingSave($aliasObj);*/
  }
}