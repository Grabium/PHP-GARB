<?php


spl_autoload_register(function ($nomeCompletoDaClasse){


  $caminhoCompleto  = str_replace('Garb', 'Garb', $nomeCompletoDaClasse);//Buscaria a pasta raiz caso fosse um nome diferente.
  $caminhoDoArquivo = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoCompleto);//vaza o \ e o substitue por um separador do S.O.
  $caminhoDoArquivo = $caminhoDoArquivo.'.php';


  if(file_exists($caminhoDoArquivo)) {
    require_once $caminhoDoArquivo;
  }else{
    echo PHP_EOL.'Autoload Error: O arquivo "'.$caminhoDoArquivo.'" NÃO foi encontrado.'.PHP_EOL;
  }

});
