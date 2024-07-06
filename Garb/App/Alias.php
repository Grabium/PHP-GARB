<?php
namespace Garb\App;

class Alias
{
  public string $aliasName      = '';
  public string $realReference  = '';
  public array  $savedFiles     = [];
  
  public function __construct(string $aliasNameClient, array $arrayFileContent)
  {
    $this->aliasName = $aliasNameClient;
    $this->realReference = realpath(array_shift($arrayFileContent));
    $this->savedFiles = (count($arrayFileContent)) ? $arrayFileContent : null ;
  }

}