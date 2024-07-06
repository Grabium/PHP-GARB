<?php
namespace Garb\App;

use Garb\FuncsGarb\FuncsGarb;

class App
{
  private FuncsGarb $functionGarb;

  public function __construct(int $argc, array $argv)
  {
    //print_r($argv);
    $funcArgsValidateds = Validate::initialValidation($argc, $argv);//array(função, argumentos)
    $this->functionGarb = FuncsGarb::getFunctionGarbObjectFactory($funcArgsValidateds);//retorna o objeto/função
    unset($argc, $argv, $funcArgsValidateds);
  }

  public function start()
  {
    $this->functionGarb->ifBrokenArgs();//pode chamar um exit().
    $this->functionGarb->setInputs();
    $this->functionGarb->preChecks();
    $this->functionGarb->run();
    $this->functionGarb->finishing();
  }
}