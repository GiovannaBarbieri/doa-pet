<?php 
require_once '../Controller/UtilController.php'; 
require_once '../Controller/AnuncioController.php';
require_once '_msg.php';

UtilController::VerificarLogado();

        if(isset($_GET['acao']) && $_GET['acao'] != '' && is_numeric($_GET['acao'])){

            $ret = $_GET['acao'];

        }

    

$objcontroller = new AnuncioController();

$lista_anuncios = $objcontroller->MeusAnuncios("");



$ret = '';

?>
﻿<!DOCTYPE html>
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

                            <?php echo RetornaMsg($ret); ?>

                            <h2>Meus Anúncios</h2>   

                            <h5>Abaixo estão listados todos os seus anúncios.</h5>



                        </div>

                    </div>

                    <!-- /. ROW  -->

                    <hr />



                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            Listagem dos Anúncios

                        </div>

                      <div class="panel-body">
                          <?php
                                if(count($lista_anuncios) == 0){
                          ?>
                          <h5>Você ainda não registrou nenhum anúncio, caso queira anunciar clique</h5> <a href="anunciar.php"  class="btn btn-success"><i class="fa fa-users" aria-hidden="true"></i>Aqui</a> .
                          <?php }else{?>

                            <?php for($i =0; $i < count($lista_anuncios); $i++){?>

                          <div class="meu-anuncio <?php if($lista_anuncios[$i]['situacao_anuncio'] == 2) echo 'anuncio-inativo'; ?> col-md-6 borda col-sm-12">

                                <h3><?= $lista_anuncios[$i]['titulo_anuncio'] ?></h3><hr/>

                                <div class="row">

                                <div class="col-md-4">

                                    <?php if($lista_anuncios[$i]['caminho_foto'] != ''){?> 

                                    <img class="img-responsive thumbnail"  src="<?= UtilController::DevolverCaminhoFoto($lista_anuncios[$i]['caminho_foto']); ?>" style="max-height: 300px;"/>

                                    <?php }else{ ?>

                                    <img class="img-responsive thumbnail"  src="assets/img/anuncio-sem-foto.png">

                                    <?php } ?>

                                </div>

                                    <div class="col-md-8"><p class="text-left text-muted lead margin-texto"><?= substr($lista_anuncios[$i]['descricao_animal'], 0, 80)."..."; ?></p></div>

                                 <p class="text-left margin-texto">- 

                                       Postado dia: <?= $lista_anuncios[$i]['data_anuncio'] ?>

                                    </p>

                                <div class="col-md-12"><?php if($lista_anuncios[$i]['situacao_anuncio'] == 2) echo '<i class="fa fa-info-circle" aria-hidden="true"></i> Este Anúncio foi encerrado'; ?></div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12"> 

                                    <p class="pull-right hidden-xs"><a href="alterar_anuncio.php?cod=<?=$lista_anuncios[$i]['cod_anuncio'] ?>" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Alterar</a>

                                    <?php if($lista_anuncios[$i]['qtd_interessados'] > 0){?>

                                                <a href="ver_interessados.php?cod=<?= $lista_anuncios[$i]['cod_anuncio'] ?>"  class="btn btn-success"><i class="fa fa-users" aria-hidden="true"></i> Ver interessados (<?= $lista_anuncios[$i]['qtd_interessados'] ?>)</a></td>

                                         <?php } ?>

                                </p>

                                <p class="pull-right visible-xs"><a href="alterar_anuncio.php?cod=<?=$lista_anuncios[$i]['cod_anuncio'] ?>" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                    <?php if($lista_anuncios[$i]['qtd_interessados'] > 0){?>

                                                <a href="ver_interessados.php?cod=<?= $lista_anuncios[$i]['cod_anuncio'] ?>"  class="btn btn-success"><i class="fa fa-users" aria-hidden="true"></i> (<?= $lista_anuncios[$i]['qtd_interessados'] ?>)</a></td>

                                         <?php } ?>

                                </p>

                                    </div>

                                </div>

                            </div>

                            <?php } ?>
                          <?php }?>

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



        <script>

        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){

    $("#success-alert").slideUp(500);

});

        </script>

    </body>

</html>



