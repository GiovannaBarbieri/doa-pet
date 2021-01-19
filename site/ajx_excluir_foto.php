<?php

require_once '../Controller/AnuncioController.php';

require_once './_msg.php';



if(isset($_POST['cod']) && isset($_POST['nome'])){

 

    $cod = $_POST['cod'];

    $nome = $_POST['nome'];

    

    $objcontroller = new AnuncioController();

    

    $ret = $objcontroller->ExcluirFotoAnuncio($cod, $nome);

    

    echo RetornaMsg($ret);

}