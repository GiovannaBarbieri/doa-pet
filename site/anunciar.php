<?php require_once '../Controller/UtilController.php'; UtilController::VerificarLogado();

require_once '../Controller/AnuncioController.php';
require '../Controller/PrecadastroController.php';
include '_msg.php';



UtilController::VerificarLogado();



//    if(UtilController::RetornarCodigoLogado() == NULL){

//     header('location: acesso.php');

//}

$ret = '';

if(isset($_POST['btn_finalizar'])){

    $foto = $_FILES['foto_animal'];

    $tipo_animal = $_POST['tipo_animal'];

    $tipo_porte = $_POST['tipo_porte'];

    $descricao = $_POST['descricao_animal'];

    $titulo = $_POST['titulo_anuncio'];

    $cod_cidade = $_POST['cod_cidade'];

    

    $objcontroller = new AnuncioController();

    $ret = $objcontroller->PublicarAnuncio($tipo_porte, $descricao, $foto, $tipo_animal, $titulo, $cod_cidade);

    

   



    

    if($ret == 1){  

        header('location:meu_anuncio.php?acao=' . $ret);

    }

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

                         echo RetornaMsg($ret);

                        ?>

                            <h2>Anunciar</h2>   

                        </div>

                    </div>

                    <!-- /. ROW  -->

                    <hr />

 

                    <form method="POST" action="anunciar.php" enctype="multipart/form-data">

                        <div class="form-group">

                            <label>Foto do Animal</label> (Apenas imagens com extensão ".jpg")

                            <input type="file" id="foto_animal" name="foto_animal"/>

                        </div>



                        <div class="form-group">

                            <label>Tipo do animal</label>

                            

                            <select class="form-control" id="tipo_animal" name="tipo_animal">

                                <option value="">Selecione</option>

                                <?php 

                                  for($i =0; $i < count($lista_tipo); $i++){

                                    ?>

                                    <option value="<?= $lista_tipo[$i]['cod_tipo']?>"><?= $lista_tipo[$i]['nome_tipo'] ?></option>                             <?php

                                  }

                                    ?>  

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Porte Animal</label>

                            <select class="form-control" id="tipo_porte" name="tipo_porte">



                                <option value="">Selecione</option>

                                <option value="1">Pequeno</option>

                                <option value="2">Médio</option>

                                <option value="3">Grande</option>

                            </select>

                        </div>

                        <div class="form-group">

                                    <label>Cidade</label>

                                    <select class="form-control" id="cod_cidade" name="cod_cidade">



                                        <option value="">Selecione</option>

                                        <?php 

                                          for($i =0; $i < count($lista_cidade); $i++){

                                            ?>

                                        <option value="<?= $lista_cidade[$i]['cod_cidade']?>" ><?= $lista_cidade[$i]['nome_cidade'] ?></option>  

                                        <?php  }?>  

                                    </select>    

                                </div>

                        <div class="form-group ">

                            <label>Título</label>

                            <input type="text" class="form-control" id="titulo_anuncio" name="titulo_anuncio" placeholder="Digite um título para o anúncio" />

                        </div>

                        <div class="form-group">

                            <label>Descreva sobre o animal</label>

                            <textarea class="form-control" rows="3" id="descricao_animal" name="descricao_animal" placeholder="Descreva o máximo que puder sobre seu animal"></textarea>

                        </div>

                        <hr />

                        <div class="form-group">            

                            <button type="submit" class="btn btn-success" id="btn_finalizar" name="btn_finalizar"><i class="fa fa-check" aria-hidden="true"></i> Finalizar Anúncio</button>

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

            $("#btn_finalizar").click(function () {

                if ($("#foto_animal").val() == "") {

                    alert("Favor selecione uma foto");

                    return false;

                }

                if ($("#tipo_animal").val() == "") {

                    alert("Favor selecione um tipo animal");

                    return false;

                }

                if ($("#tipo_porte").val() == "") {

                    alert("Favor escolher o porte do animal");

                    return false;

                }

                if ($("#titulo_anuncio").val() == "") {

                    alert("Favor preencher o título");

                    return false;

                }

                if ($("#cod_cidade").val() == "") {

                    alert("Favor escolher a cidade");

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



