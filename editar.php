<?php 
require __DIR__ .'/vendor/autoload.php';

define('TITLE','Editar vaga');

use \App\Entity\Vaga;

//CONSULTA A VAGA
$obVaga = Vaga::getVaga($id = filter_input(INPUT_GET, 'id'));

// //validação do post
if (isset($_POST['titulo'])){

    $obVaga ->titulo = $_POST['titulo'];
    $obVaga ->descricao = $_POST['descricao'];
    $obVaga ->ativo = $_POST['ativo'];
    $obVaga ->atualizar();


    header('location:index.php?status=success');
    exit;

}


//VALIDAÇÃO ID

if(!isset($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//VALIDAÇÃO DA VAGA 

if(!$obVaga instanceof Vaga){
    header('location: index.php?status=error');
    exit;
}


include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/formulario.php';
include __DIR__ .'/includes/footer.php';