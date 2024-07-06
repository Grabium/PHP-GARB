<?php
$content = 
'<?php

  /********
   *   
   *   Save the names files of this directory on Garb/List/alias.json
   *
   *******/


$listFiles = [ __DIR__ ];
$ignore    = ["." , ".." , "save.php"];
foreach(scandir(__DIR__) as $n => $item){
  if(in_array($item, $ignore)){continue;}
  $listFiles[] = $item;
  print $n.\' - Adicionando \'.$item.\' ........para proteção.\'.PHP_EOL;
}

$jsonList = json_encode($listFiles);
file_put_contents(\'<<save.json>>\', $jsonList);

?>';
