<?php
	//echo 'Aqui vai ser o arquivo que vai montar as informações (criar regras de negócios) chamando o arquivo dentro da pasta VIEW com smarty';
    require '../lib/smarty/libs/Smarty.class.php';

    $smarty = new Smarty;

    //$smarty->force_compile = true;
    $smarty->debugging = true;
    $smarty->caching = true;
    $smarty->cache_lifetime = 120;

    $smarty->assign("nome", "Teste Jéssica", true);
    $smarty->display('../view/index.tpl');