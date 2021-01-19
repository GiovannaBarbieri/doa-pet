<?php 
require_once '../Controller/AnuncioController.php';
require_once '../Controller/UtilController.php';
require '../Controller/PrecadastroController.php';

UtilController::VerificarLogado();

$ret = '';
require_once '../Html/_msg.php';
 if(isset($_GET['acao']) && $_GET['acao'] != '' && is_numeric($_GET['acao'])){
            $ret = $_GET['acao'];
        }
$objcontroller = new AnuncioController();
$precadastrocontroller = new PrecadastroController();

$cod_cidade = '';
$tipo_animal = '';
$tipo_porte = '';

$lista_anuncios = $objcontroller->CarregarFavoritos();
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
                            <?php echo RetornaMsg($ret); ?>
                            <h2>Meus Interesses</h2>   
                            <h5>Abaixo estão os anúncios que mais lhe agradaram.</h5>
                              <h5> > Não perca tempo, entre em contato com o anunciante e adote já o seu pet.</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php if(count($lista_anuncios) == 0){?>
                            <h4>Não Existe nenhuma publicação</h4>
                            <?php }else{
                            for($i =0; $i < count($lista_anuncios); $i++){?>
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
                                    
                                    <?php
                                        if($lista_anuncios[$i]['tipo_porte'] == 1){
                                            echo '- Porte: Pequeno'; }
                                            else if($lista_anuncios[$i]['tipo_porte'] == 2){
                                            echo '- Porte: Médio';
                                            }else if($lista_anuncios[$i]['tipo_porte'] == 3){
                                            echo '- Porte: Grande';
                                            }else{
                                                echo '- Sem porte definido -';
                                            }
                                ?>
                                    <br>
                                       - Tipo animal: <?= $lista_anuncios[$i]['nome_tipo'] ?>
                                    <br>
                                       - Cidade: <?= $lista_anuncios[$i]['nome_cidade'] ?>
                                    <br>
                                       - Quantidade de interessados: <?= $lista_anuncios[$i]['qtd_interessados'] ?>
                                    <br>
                                    <br>
                                       <i>Postado no dia: <?= $lista_anuncios[$i]['data_anuncio'] ?></i>                                 
                                    </div>
                                </div>
                                <?php if($lista_anuncios[$i]['cod_pessoa'] != UtilController::RetornarCodigoLogado()){?>
                                <div class="row">
                                    <div class="col-md-12"> 
                                        <p class="pull-right hidden-xs"><a href="detalhes.php?cod=<?=$lista_anuncios[$i]['cod_anuncio'] ?>" class="btn btn-info"><i class="fa fa-hand-o-up" aria-hidden="true"></i> Visualizar</a>
                                        </p>
                                        <p class="pull-right visible-xs"><a href="detalhes.php?cod=<?=$lista_anuncios[$i]['cod_anuncio'] ?>" class="btn btn-info"><i class="fa fa-hand-o-up" aria-hidden="true"></i></a>
                                        </p>
                                    </div>
                                </div>
                                <?php }else{?>
                                <div class="row">
                                    <div class="col-md-12"> 
                                    <p class="pull-right hidden-xs"><a href="alterar_anuncio.php?cod=<?=$lista_anuncios[$i]['cod_anuncio'] ?>" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Alterar</a>
                                    
                                </p>
                                <p class="pull-right visible-xs"><a href="alterar_anuncio.php?cod=<?=$lista_anuncios[$i]['cod_anuncio'] ?>" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    
                                </p>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                                <?php }} ?>
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

