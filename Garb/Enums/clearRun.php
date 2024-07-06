<?php
$content = 
'<?php
/********
 *   
 *   Exclude the files that are not listeds on alias
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

print \'DELETE this files:\'.PHP_EOL;

$listFiles = [];
$ignore    = ["." , ".." , "clear.php"];

$n = 1;

foreach(scandir(__DIR__) as $item){
  if(in_array($item, $ignore)){continue;}
  if(in_array($item, $savedFileContent)){
    $position = array_search($item, $savedFileContent);
    array_splice($savedFileContent, $position, 1);
    continue;
  }
  $listFiles[] = $item;
  print ($n).\' - \'.$item.PHP_EOL;
  $n ++;
}

if($n == 1){ 
  print \'NULL\'.PHP_EOL.\'Nothing to delete\'.PHP_EOL;
}elseif(cancel(PHP_EOL.\'Are you shure [ENTER]? Or cancel this operation ["cancel"|"c"]:\'.PHP_EOL)){
  print \'Nothing was been deleted!\'.PHP_EOL;
}else{
  //var_dump($listFiles);die();
  foreach($listFiles as $file){
    unlink(__DIR__.\'/\'.$file);
  }
  print \'Files DELETED!\'.PHP_EOL;
}

if($savedFileContent){
  print \'HINT: Some file(s) of alias arent found on directory.\'.PHP_EOL.\'Please! update the alias: <<alias>>\'.PHP_EOL;
}

?>';