<?php
namespace Garb\FuncsGarb;

use Garb\App\Validate;
use Garb\App\Json;
use Garb\Enums\FuncsGarbEnums;
use Garb\Views\FinishingSave;


class Clear extends FuncsGarb
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
    //
  }

  public function run()
  {
    $executableLocalName = $this->setExecutableName();
    $savedFileContent = $this->prepareContentsAlias();
    $this->createScript($executableLocalName);

    //roda o shell
    require_once $executableLocalName;//executa o script neste contexto.
    unlink($executableLocalName);
  }

  private function setExecutableName():string
  {
    $this->directory = Json::getRefer($this->alias);
    return $this->directory.'/clear.php';
  }

  private function prepareContentsAlias():array
  {
    $aliasObj = Json::getAliasContent($this->alias);
    return $aliasObj->savedFiles;
  }

  private function createScript(string $executableLocalName)
  {
    $content = FuncsGarbEnums::defineContent('clearRun');
    $content = str_replace('<<alias>>', $this->alias, $content);
    file_put_contents($executableLocalName, $content);//cria o arquivo
  }

  public function finishing()
  {
    //
  }
}
