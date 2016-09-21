<?php

//Dependencias
require ('../lib/smarty/libs/Smarty.class.php');
require('../controller/index.php');

//Smarty configs
$smarty = new Smarty;
$smarty->caching = true;
$smarty->cache_lifetime = 120;

//Criando objeto
$jessica = new Index();
$jessica->setNome('Jéssica Teste');

//Setando objeto no template
$smarty->assign("nome", $jessica->getNome(), true);
$smarty->display('../view/index.tpl');