<?php
require_once '../Controller/UtilController.php';

require_once '../Controller/AnuncioController.php';

require '../Controller/PrecadastroController.php';

include '_msg.php';



UtilController::VerificarLogado();



$ret = '';

$nome_foto = '';

$tipo_animal = '';

$tipo_porte = '';

$titulo_anuncio = '';

$descricao_animal = '';

$encerrar_anuncio = '';



if(isset($_GET['cod']) && is_numeric($_GET['cod'])){

    

    $cod = $_GET['cod'];

    $objcontroller = new AnuncioController();

    $anuncio = $objcontroller->CarregarMeuAnuncio($cod);

    

    if(count($anuncio) > 0){

        $cod_anuncio = $anuncio[0]['cod_anuncio'];

        $nome_foto = $anuncio[0]['caminho_foto'];

        $tipo_animal = $anuncio[0]['cod_tipo'];

        $tipo_porte = $anuncio[0]['tipo_porte'];

        $titulo_anuncio = $anuncio[0]['titulo_anuncio'];

        $descricao_animal = $anuncio[0]['descricao_animal'];

        $encerrar_anuncio = $anuncio[0]['situacao_anuncio'];

        $cod_cidade = $anuncio[0]['cod_cidade'];

    }else{

        header('location: meu_anuncio.php');

    }

}

elseif(isset($_POST['btn_salvar'])){

 

    $cod_anuncio = $_POST['cod_anuncio_alterar'];

    $tipo_animal = $_POST['cod_tipo'];

    $tipo_porte = $_POST['tipo_porte'];

    $titulo_anuncio = $_POST['titulo_anuncio'];

    $descricao_animal = $_POST['descricao_animal'];

    $encerrar_anuncio = (isset($_POST['chk_encerrar'])  ? 2 : 1);

    $nome_foto = $_POST['nome_foto_alterar'];

    $cod_cidade = $_POST['cod_cidade'];

    if($nome_foto == ''){

      $foto = $_FILES['foto_animal'];  

    }else{

        $foto = null;

    }

    

    $objcontroller = new AnuncioController();

    $ret = $objcontroller->AlterarAnuncio($tipo_animal, $tipo_porte, $titulo_anuncio, $descricao_animal, $encerrar_anuncio, $foto, $nome_foto, $cod_anuncio, $cod_cidade);



        if($ret==3){

            header('location:meu_anuncio.php?acao=' . $ret);

        }

    

        $anuncio = $objcontroller->CarregarMeuAnuncio($cod_anuncio);

   

        $cod_anuncio = $anuncio[0]['cod_anuncio'];

        $nome_foto = $anuncio[0]['caminho_foto'];

        $tipo_animal = $anuncio[0]['cod_tipo'];

        $tipo_porte = $anuncio[0]['tipo_porte'];

        $titulo_anuncio = $anuncio[0]['titulo_anuncio'];

        $descricao_animal = $anuncio[0]['descricao_animal'];

        $encerrar_anuncio = $anuncio[0]['situacao_anuncio'];

        $cod_cidade = $anuncio[0]['cod_cidade'];

    

    

}elseif(isset($_POST['btn_excluir'])) {

    $cod_anuncio = $_POST['cod_anuncio'];

    $nome_foto = $_POST['nome_foto_excluir'];

    $objControler = new AnuncioController();

    $ret = $objControler->ExcluirFotoAnuncio($cod_anuncio, $nome_foto);

    if($ret == 2){

    $anuncio = $objControler->CarregarMeuAnuncio($cod_anuncio);

        $cod_anuncio = $anuncio[0]['cod_anuncio'];

        $nome_foto = $anuncio[0]['caminho_foto'];

        $tipo_animal = $anuncio[0]['cod_tipo'];

        $tipo_porte = $anuncio[0]['tipo_porte'];

        $titulo_anuncio = $anuncio[0]['titulo_anuncio'];

        $descricao_animal = $anuncio[0]['descricao_animal'];

        $encerrar_anuncio = $anuncio[0]['situacao_anuncio'];

    



    }

}else{

    header('location: meu_anuncio.php');

}



    $objcontroller = new PrecadastroController();

    $lista_tipo = $objcontroller->ListarTipoAnimal();

    

    $lista_cidade = $objcontroller->FiltrarCidade(1);

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

    <?php include '_head.php'; ?>

    <body>

        <div id="wrapper">

            <!-- NAV TOP  -->

            <?php include '_topo.php'; ?>

            <!-- NAV SIDE  -->

            <?php include '_menu.php'; ?>

            <div id="page-wrapper" >

                <div id="page-inner">

                    <div class="row">

                        <div class="col-md-12">

                             <?php  

                                echo RetornaMsg($ret);?>

                            <h2>Alterar Anúncio</h2>   

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div id="msg_ajx"></div>

                            <div id="msg_post">

                               

                            </div>

                            </div>

                        </div>

                    <!-- /. ROW  -->

                    <div id="foto_load" style="display: <?= $nome_foto != '' ? 'block' : 'none' ?>">

                     <hr />

                    <form method="POST" action="alterar_anuncio.php">

                        <div class="form-group">

                           

                            <input type="hidden" name="cod_anuncio" value="<?= $cod_anuncio ?>" id="cod_anuncio">

                                <input type="hidden" name="nome_foto_excluir" value="<?= $nome_foto ?>" id="nome_foto_excluir">

                                <img src="Fotos/<?= $nome_foto ?>" class="thumbnail" style="max-width: 500px;"/>

                                <button type="submit" class="btn btn-danger" id="btn_excluir" name="btn_excluir" onclick="return DeletarFoto()"> Excluir Foto</button>

                        </div>

                    </form>                   

                    </div>    

                    

                    <hr>

                        <form method="POST" action="alterar_anuncio.php" enctype="multipart/form-data">

                        <input type="hidden" name="cod_anuncio_alterar" value="<?= $cod_anuncio ?>" >

                        <input type="hidden" name="nome_foto_alterar" id="nome_foto_alterar" value="<?= $nome_foto ?>" >

                            

                        <div id="foto_upload" style="display: <?= $nome_foto == '' ? 'block' : 'none' ?>">

                            <div class="form-group">

                                <label>Foto do Animal</label>

                                <input type="file" id="foto_animal" name="foto_animal"/>

                            </div>

                        </div>

        

                        

                        <div class="form-group">

                            <label>Tipo do animal</label>

                            <select class="form-control" id="tipo_animal" name="cod_tipo">

                                <option value="">Selecione</option>

                                <?php 

                                  for($i =0; $i < count($lista_tipo); $i++){

                                    ?>

                                    <option value="<?= $lista_tipo[$i]['cod_tipo']?>"  <?php if($tipo_animal == $lista_tipo[$i]['cod_tipo']) echo 'selected' ?>><?= $lista_tipo[$i]['nome_tipo'] ?></option>                             <?php

                                  }

                                    ?>  

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Porte Animal</label>

                            <select class="form-control" id="tipo_porte" name="tipo_porte">                                

                                <option value="">Selecione</option>

                                <option value="1" <?php if($tipo_porte == 1) echo 'selected' ?> >Pequeno</option>

                                <option value="2" <?php if($tipo_porte == 2) echo 'selected' ?>>Médio</option>

                                <option value="3" <?php if($tipo_porte == 3) echo 'selected' ?>>Grande</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Cidade</label>

                            <select class="form-control" id="cod_cidade" name="cod_cidade">



                                <option value="">Selecione</option>

                                <?php 

                                  for($i =0; $i < count($lista_cidade); $i++){

                                    ?>

                                <option value="<?= $lista_cidade[$i]['cod_cidade']?>" <?php if($lista_cidade[$i]['cod_cidade'] == $cod_cidade) echo 'selected';?>><?= $lista_cidade[$i]['nome_cidade'] ?></option>   

                                <?php  }?>  

                            </select>    

                        </div>

                        <div class="form-group ">

                            <label>Título</label>

                            <input type="text" class="form-control" id="titulo_anuncio" name="titulo_anuncio" placeholder="Digite um titulo para o anúncio" value="<?= $titulo_anuncio ?>"/>

                        </div>

                        <div class="form-group">

                            <label>Descreva sobre o animal</label>

                            <textarea class="form-control" rows="3" id="descricao_animal" name="descricao_animal"><?= $descricao_animal?></textarea>

                        </div>

                        <div class="form-group">

                            <label>Encerrar Anúncio</label>

                            <input type="checkbox" name="chk_encerrar" <?php if($encerrar_anuncio == 2) echo'checked' ?>>

                        </div>

                        <hr />

                        <div class="form-group">

                            

                            <button type="submit" class="btn btn-success" id="btn_salvar" name="btn_salvar"><i class="fa fa-check" aria-hidden="true"></i> Salvar Anúncio</button>

                        </div>     

                    </form>

                </div>

                <!-- /. PAGE INNER  -->

            </div>

            <!-- /. PAGE WRAPPER  -->

        </div>

        <!-- /. WRAPPER  -->

        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->



        <script>

            

            function DeletarFoto(){

                

                var cod = $("#cod_anuncio").val();

                var nome = $("#nome_foto_excluir").val();

                

                $.post("ajx_excluir_foto.php","cod="+cod+"&nome="+nome , function(retorno){

                    $("#msg_ajx").html(retorno);

                    $("#msg_post").hide();

                    $("#foto_upload").show();

                    $("#foto_load").hide();

                    $("#nome_foto_excluir").val('');

                    $("#nome_foto_alterar").val('');

                });

                

                return false;

                

            }

            

            $("#btn_finalizar").click(function () {

                if ($("#tipo_animal").val() == "") {

                    alert("Favor selecione um tipo animal");

                    return false;

                }

                if ($("#tipo_porte").val() == "") {

                    alert("Favor escolher o porte do animal");

                    return false;

                }

                if ($("#descricao_animal").val() == "") {

                    alert("Escreva uma descrição");

                    return false;

                }



            })

        </script>

    </body>

</html>



