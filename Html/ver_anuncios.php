<?php 

require_once '../Controller/UtilController.php';
require_once '../Controller/AnuncioController.php';
require '../Controller/PrecadastroController.php';
require_once '../Html/_msg.php';

UtilController::VerificarLogado();

$objcontroller = new AnuncioController();

$precadastrocontroller = new PrecadastroController();





$filtro = '';

$cod_cidade = '';

$tipo_animal = '';

$tipo_porte = '';

$acionou_filtro = -1;

$ret = '';





        if(isset($_GET['acao']) && $_GET['acao'] != '' && is_numeric($_GET['acao'])){

            $ret = $_GET['acao'];

        }

if(isset($_POST['btn_pesquisar'])){

    $acionou_filtro = 1;

    $tipo_animal = $_POST['tipo_animal'];

    $tipo_porte = $_POST['tipo_porte'];

    $cod_cidade = $_POST['cod_cidade'];

    

    $objcontroller = new AnuncioController();

    //echo '<pre>';

    $lista_anuncios = $objcontroller->ConsultarAnunciosFiltro($tipo_animal, $tipo_porte, $cod_cidade);

   // echo '</pre>';

    

}

if($acionou_filtro == -1){

    $lista_anuncios = $objcontroller->CarregarUltimosAnuncios();

}



$lista_tipo = $precadastrocontroller->ListarTipoAnimal();

$lista_cidade = $precadastrocontroller->FiltrarCidade(1);

?>



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

                            <?php echo RetornaMsg($ret);?>

                            <h2>Ver Anúncios</h2>   

                            <h5>Abaixo estão os anúncios mais recentes.</h5>



                        </div>

                    </div>

                    <!-- /. ROW  -->

                    <hr />



                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

              

                            <form method="POST" action="ver_anuncios.php">

                            <div class="row">

                          

                            <div class="col-md-2 col-xs-12 col-md-offset-2 form-group">

                            <select class="form-control" id="tipo_porte" name="tipo_porte">



                                <option value="">Porte</option>

                                <option value="1" <?php if($tipo_porte == 1)  echo 'selected'; ?>>Pequeno</option>

                                <option value="2" <?php if($tipo_porte == 2)  echo 'selected'; ?>>Médio</option>

                                <option value="3" <?php if($tipo_porte == 3)  echo 'selected'; ?>>Grande</option>

                            </select>

                                </div>

                                <div class="col-md-2 col-xs-12  form-group">

                                    <select class="form-control" name="tipo_animal">

                                    <option value="">Tipo</option>

                                <?php 

                                  for($i =0; $i < count($lista_tipo); $i++){

                                    ?>

                                    <option value="<?= $lista_tipo[$i]['cod_tipo']?>" <?php if($lista_tipo[$i]['cod_tipo'] == $tipo_animal)  echo 'selected'; ?>><?= $lista_tipo[$i]['nome_tipo'] ?> </option>                             <?php

                                  }

                                    ?>  

                                </select>

                                </div>

                                <div class="col-md-3 col-xs-12  form-group">

                          

                                    <select class="form-control" id="cod_cidade" name="cod_cidade">



                                        <option value="">Cidade</option>

                                        <?php 

                                          for($i =0; $i < count($lista_cidade); $i++){

                                            ?>

                                        <option value="<?= $lista_cidade[$i]['cod_cidade']?>" <?php if($lista_cidade[$i]['cod_cidade'] == $cod_cidade) echo 'selected';?>><?= $lista_cidade[$i]['nome_cidade'] ?></option>  

                                        <?php  }?>  

                                    </select>    

                                </div>

                                    <div class="col-md-3 col-xs-12 pull-right">

                                <button class="btn btn-info" name="btn_pesquisar">Pesquisar</button> <a href="http://doapet.com.br/Html/ver_anuncios.php">Limpar</a>

                            </div>

                            </div>

                        </form>

                        </div>

                        <div class="panel-body">



                            <?php if($acionou_filtro == -1){ ?>

                            <h3 class="text-center">Últimos anúncios</h3>

                            <?php } ?>

                            <?php  

                            

                            if(count($lista_anuncios) == 0){?>

                            <h4 class="text-center">Não existe nenhuma publicação</h4>

                            <?php }else {?>

                            
<div class="col-md-10 ">
                            <?php

                            for($i =0; $i < count($lista_anuncios); $i++){ ?>

                            <div class="col-md-12 borda">

                                <h3 class="titulo-anuncio"><?= $lista_anuncios[$i]['titulo_anuncio'] ?></h3><hr/>

                                

                                <div class="row">

                                <div class="col-md-4">

                                    <?php if($lista_anuncios[$i]['caminho_foto'] != ''){?> 

                                    <img class="img-responsive thumbnail"  src="<?= UtilController::DevolverCaminhoFoto($lista_anuncios[$i]['caminho_foto']); ?>"/>

                                    <?php }else{ ?>

                                    <img class="img-responsive thumbnail"  src="assets/img/anuncio-sem-foto.png">

                                    <?php } ?>

                                </div>

                                    <div class="col-md-8"><p class="text-left text-muted lead margin-texto"><?= $lista_anuncios[$i]['descricao_animal'] ?></p>

                                    

                                    - <?php

                                        if($lista_anuncios[$i]['tipo_porte'] == 1){

                                            echo 'Porte Pequeno'; }

                                            else if($lista_anuncios[$i]['tipo_porte'] == 2){

                                            echo 'Porte Médio';

                                            }else if($lista_anuncios[$i]['tipo_porte'] == 3){

                                            echo 'Porte Grande';

                                            }else{

                                                echo 'Sem porte definido';

                                            }

                                ?>

                                        <br/>

                                    - Cidade: <?= $lista_anuncios[$i]['nome_cidade'] ?>

                                    <br/>

                                    - Número de pessoas Interessadas: <?= $lista_anuncios[$i]['qtd_interessados'] == 0 ? 'Nenhuma': $lista_anuncios[$i]['qtd_interessados'] ?>

                                    <br/><br/>

                                   <i> - Postado no dia: <?= $lista_anuncios[$i]['data_anuncio'] ?></i>

                                    

                                    

                                    </div>

                                </div>

                                <?php if($lista_anuncios[$i]['cod_pessoa'] != UtilController::RetornarCodigoLogado()){ ?>

                                <div class="row">

                                    <div class="col-md-12"> 

                                        <p class="pull-right hidden-xs"><a href="detalhes.php?cod=<?= $lista_anuncios[$i]['cod_anuncio'] ?>" class="btn btn-info"><i class="fa fa-hand-o-up" aria-hidden="true"></i> Veja Mais</a></p>

                                        <p class="pull-right visible-xs"><a href="detalhes.php?cod=<?= $lista_anuncios[$i]['cod_anuncio'] ?>" class="btn btn-info"><i class="fa fa-hand-o-up" aria-hidden="true"></i></a></p>

                                    </div>

                                </div>

                                <?php }else{ ?>

                                <div class="row">

                                    <div class="col-md-12">

                                 <p class="pull-right hidden-xs"><a href="alterar_anuncio.php?cod=<?=$lista_anuncios[$i]['cod_anuncio'] ?>" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Alterar</a>

                                   </p>

                                <p class="pull-right visible-xs"><a href="alterar_anuncio.php?cod=<?=$lista_anuncios[$i]['cod_anuncio'] ?>" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></p>

                                        </div>

                                    </div>

                                <?php } ?>



                            </div> <?php }} ?>

                </div>
                    <!-- Lateral Direita Anúncio -->    
                    <div class="col-md-2" style="position: sticky;top: 20px;margin-top: 20px;">
                         <img class="img-responsive center-block" src="assets/img/banner-anuncie.gif">
                     </div>
                            

                        </div>

                    </div>

                    <!--End Advanced Tables -->

                </div>

                <!-- /. PAGE INNER  -->

            </div>

            <!-- /. PAGE WRAPPER  -->

        </div>

        <!-- /. WRAPPER  -->

        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->





    </body>

</html>



