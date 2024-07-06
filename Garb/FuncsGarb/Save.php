<?php
namespace Garb\FuncsGarb;

use Garb\App\Validate;
use Garb\App\Json;
use Garb\Enums\FuncsGarbEnums;
use Garb\Views\FinishingSave;


class Save extends FuncsGarb
{
  public array $arguments = [];

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

  public function setInputs()
  {
    $this->directory         = array_shift($this->arguments);
    $this->directoryComplete = __DIR__.'/../../'.$this->directory;
    $this->alias             = end($this->arguments);
    $this->aliasFileLocal    = __DIR__.'/../../Garb/Lists/'.$this->alias.'.json';
    unset($this->arguments);
  }

  public function preChecks()
  {
    if(Json::aliasExists($this->alias)){
      exit('\''.$this->alias.'\' has already been used. Use help function for more details. Try:'.PHP_EOL.'"php pgarb help"'.PHP_EOL);
    }

    if($name = Json::scanDuplicityRefer($this->directory)){
      exit('"'.$this->directory.'" has already been saved as alias "'.$name.'".'.PHP_EOL.'Use help function for more details. Try:'.PHP_EOL.'"php pgarb help"'.PHP_EOL);
    }
  }

  public function run()
  {
    $executable = $this->directory.'/save.php';
    $content = FuncsGarbEnums::defineContent('saveRun');
    $content = str_replace('<<save.json>>', $this->aliasFileLocal, $content);
    file_put_contents($executable, $content);
    shell_exec('php '.$executable);
    unlink($executable);
  }

  public function finishing()
  {
    $aliasObj = Json::getAliasContent($this->alias);
    new FinishingSave($aliasObj);
  }
}