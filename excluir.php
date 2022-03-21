<?php 
require __DIR__ .'/vendor/autoload.php';



use \App\Entity\Vaga;

//VALIDAÇÃO ID

if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA A VAGA

$obVaga = Vaga::getVaga($_GET['id']);

//VALIDAÇÃO DA VAGA 

if(!$obVaga instanceof Vaga){
    header('location: index.php?status=error');
    exit;
}

// echo "<prev>"; print_r($obVaga); echo "</prev>"; exit;


// //validação

if (isset($_POST['excluir'])){

    $obVaga ->excluir();


    header('location:index.php?status=success');
    exit;

}


include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/confirma-exclusao.php';
include __DIR__ .'/includes/footer.php';