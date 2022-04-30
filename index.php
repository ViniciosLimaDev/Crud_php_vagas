<?php 
require __DIR__.'/vendor/autoload.php';

use \App\Entity\Vaga;

//buscar

$busca = filter_input(INPUT_GET,'buscar');

//CONDIÇÕES SQL

$condicoes =[
    strlen($busca) ? 'titulo LIKE "%'.$busca.'%"' : null
];
 
//CLÁUSULA WHERE

$where = implode(' AND ',$condicoes);

// echo "<pre>";
// print_r($condicoes);
// echo "</pre>";

//OBTENDO AS VAGAS
$vagas = Vaga::getVagas($where);

// echo "<pre>";
// print_r($vagas);
// exit();
// echo "</pre>";
 

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/listagem.php';
include __DIR__ .'/includes/footer.php';
?>
