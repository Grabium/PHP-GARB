<?php
namespace Garb\Views;

use Garb\App\Alias;

class FinishingSave
{
  public function __construct(Alias $aliasObj)
  {
    $this->view($aliasObj);
  }

  private function view(Alias $aliasObj)
  {
    print '______Was been writed:_______'.PHP_EOL;
    foreach($aliasObj->savedFiles as $item){
      print $item.PHP_EOL;
    }
    print '------------------------------'.PHP_EOL;
    print 'On alias: \''.$aliasObj->aliasName.'\''.PHP_EOL;
    print 'To reference: \''.$aliasObj->realReference.'\''.PHP_EOL;
  }
}