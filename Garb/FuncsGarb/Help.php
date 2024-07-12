<?php
namespace Garb\FuncsGarb;

class Help extends FuncsGarb
{
  private string $content = '';

  public function __construct(array $arguments)
  {
    $this->setContent();
    $this->printContent();
    $msg = ($arguments) ? $arguments[0] : '' ;
    exit($msg.PHP_EOL.'Choose one of these options above!'.PHP_EOL);
  }

  private function printContent()
  {
    print $this->content;
  }
  
  private function setContent()
  {
    $this->content ='
                      WELLCOME TO THE:

██████╗░██╗░░██╗██████╗░░░░░░░░██████╗░░█████╗░██████╗░██████╗░
██╔══██╗██║░░██║██╔══██╗░░░░░░██╔════╝░██╔══██╗██╔══██╗██╔══██╗
██████╔╝███████║██████╔╝█████╗██║░░██╗░███████║██████╔╝██████╦╝
██╔═══╝░██╔══██║██╔═══╝░╚════╝██║░░╚██╗██╔══██║██╔══██╗██╔══██╗
██║░░░░░██║░░██║██║░░░░░░░░░░░╚██████╔╝██║░░██║██║░░██║██████╦╝
╚═╝░░░░░╚═╝░░╚═╝╚═╝░░░░░░░░░░░░╚═════╝░╚═╝░░╚═╝╚═╝░░╚═╝╚═════╝░
Use one of the syntaxes below:
----------------------------------------------------------------
||
||  php garb update  <alias> 
||  php garb <alias> 
||  php garb list 
||  php garb list    <alias>
||  php garb save    <directory/subdir> as <alias>
||  php garb delete  <alias>
||
----------------------------------------------------------------

______________________Functions Details:_________________________

help.......................................print this text help.
update <alias>..................................update the save.
save <d> as <a>......save alias and update the save overwithing.
<alias>.....................................clear the directory.
list..............list all alias and the referenced directories.
list <alias>................list all files saveds on this alias.
delete <alias>.....................................delete alias.

'.PHP_EOL;
  }
}
