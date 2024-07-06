<?php
$content = 
'<?php

/********
 *   
 *   Update the names files of this directory on Garb/List/<alias>.json
 *
 *******/

//var_dump($savedFileContent);//die();


function cancel(string $question)
{
  print $question;
  $yn = trim(fgets(fopen(\'php://stdin\', \'r\')));
  $yn = strtolower($yn);
  if(($yn == \'cancel\')||($yn == \'c\')){
    return true;
  }else{
    return false;
  }
}

$listFiles = [__DIR__];
$ignore    = ["." , ".." , "update.php"];

print PHP_EOL.\'Files and directories found:\'.PHP_EOL;
foreach(scandir(__DIR__) as $n => $item){
  if(in_array($item, $ignore)){continue;}
  
  $listFiles[] = $item;
  print ($n-1).\' - \'.$item.PHP_EOL;
}

$c = 1;
print PHP_EOL.\'Changes that will be made: \'.PHP_EOL;

print PHP_EOL.\'New input on list: \'.PHP_EOL;//modular para testar se deve aparecer esses texto. caso não seja necessario.
foreach($listFiles as $k => $item){
  if($k == 0){continue;}
  if(in_array($item, $savedFileContent)){continue;}
  print ($c).\' - \'.$item.PHP_EOL;
  $c ++;
}
if($c == 1){
  print \'NULL\'.PHP_EOL;
}


$cc = 1;
print PHP_EOL.\'Not found. Will be deleted: \'.PHP_EOL;
foreach($savedFileContent as $item){
  if($item == __DIR__){continue;}
  if(in_array($item, $listFiles)){continue;}
  print ($cc).\' - \'.$item.PHP_EOL;
  $cc ++;
}
if($cc == 1){
  print \'NULL\'.PHP_EOL;
}

if(($c == 1)&&($cc == 1)){
  print PHP_EOL.\'There are not item to update.\'.PHP_EOL;
}elseif(cancel(PHP_EOL.\'[ENTER] To continue or [ c | cancel ] To CANCEL update:\'.PHP_EOL)){
  print \'CANCELED CHANGES!\'.PHP_EOL;
}else{
  $jsonList = json_encode($listFiles);
  file_put_contents(\'<<update.json>>\', $jsonList);
  print \'Update succesfull!\'.PHP_EOL;
}
?>';

