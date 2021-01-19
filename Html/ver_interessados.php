<?php require_once '../Controller/AnuncioController.php'; 

require_once '../Controller/PrecadastroController.php';

require_once './_msg.php';



UtilController::VerificarLogado();

 

$cod_anuncio = '';

$ret = '';



if(isset($_POST['btn_resp'])){

    

    $cod_anuncio = $_POST['cod_anuncio'];

    $cod_mensagem = $_POST['cod_mensagem_pop'];

    $cod_interessado = $_POST['cod_interessado_pop'];

    $texto_msg = $_POST['texto_msg'];

    

    $objControler = new AnuncioController();

    

    $ret = $objControler->ResponderPergunta($texto_msg, $cod_mensagem);

    $interessados = $objControler->VerInteressadoAnuncio($cod_anuncio);

    

        if(count($interessados) == 0){

        header("location:meu_anuncio.php");

    }

    $data = $interessados[0]['data_anuncio'];

    $cidade = $interessados[0]['nome_cidade'];

    $titulo = $interessados[0]['titulo_anuncio'];

    $descricao = $interessados[0]['descricao_animal'];

    $nome_foto = $interessados[0]['caminho_foto'];

}



elseif(isset($_GET['cod']) && is_numeric($_GET['cod'])){

    $cod_anuncio = $_GET['cod'];

    $objControler = new AnuncioController();

    $interessados = $objControler->VerInteressadoAnuncio($cod_anuncio);

    

    if(count($interessados) == 0){

        header("location:meu_anuncio.php");

    }

    

    $data = $interessados[0]['data_anuncio'];

    $cidade = $interessados[0]['nome_cidade'];

    $titulo = $interessados[0]['titulo_anuncio'];

    $descricao = $interessados[0]['descricao_animal'];

    $nome_foto = $interessados[0]['caminho_foto'];



}else{

        header("location:meu_anuncio.php");

    }



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

                            <?php echo RetornaMsg($ret); ?>

                            <h2>Ver interessados</h2>   

                            <h5>Abaixo estão listados todos os interessados pelo seu anúncio.</h5>



                        </div>

                    </div>

                    <!-- /. ROW  -->

                    <hr /><div class="row">
                    <div class="col-md-4">
                    <?php if($nome_foto != ''){ ?>

                        <div class="form-group">

                           <img src="Fotos/<?= $nome_foto ?>" class="thumbnail img-responsive" />

                        </div>

                    <?php } else{ ?>

                           <img class="img-responsive thumbnail "  src="assets/img/anuncio-sem-foto.png" >

                    <?php } ?>

                    
</div><div class="col-md-7"><br/>
                    <div class="form-group">

                        <label><?= $titulo ?></label>

                    </div>

                    <div class="form-group">

                        <label><?= $descricao ?></label>

                    </div>

                    <div class="form-group">

                        <label>Publicado no dia <?= $data ?>, na cidade de <?= $cidade ?></label>

                    </div>
</div>
                    </div>
                    <!-- Advanced Tables -->

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            Abaixo estão listados os interessados do seu anúncio.

                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            

                                            <th class="center text-center">Nome</th>

                                            <th class="center text-center">Telefone</th>

                                            <th class="center text-center">E-mail</th>

                                            <th class="center text-center">Mensagem</th>

                                            <th class=""></th>

                                           



                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php for($i =0; $i < count($interessados); $i++){ ?>

                                        <tr class="odd gradeX">

                                            

                                            <td class="center text-center"><?=$interessados[$i]['nome_pessoa']?></td>

                                            <td  class="center text-center"><?=$interessados[$i]['telefone_pessoa']?></td >

                                            <td  class="center text-center"><?=$interessados[$i]['email_pessoa']?></td >

                                            <td  class="center text-center"><?=$interessados[$i]['texto_mensagem'] == '' ? 'Sem Mensagem' : $interessados[$i]['texto_mensagem'] ?></td >

                                            <td  class="center text-center">

                                                

                                                <input type="hidden" id="<?= 'texto'.$i ?>" value="<?= $interessados[$i]['texto_mensagem'] ?>">

                                                <input type="hidden" id="<?= 'cod_mensagem'.$i ?>" value="<?= $interessados[$i]['cod_mensagem'] ?>">

                                                <input type="hidden" id="<?= 'cod_interessado'.$i ?>" value="<?= $interessados[$i]['cod_interessado'] ?>">

                                                    

                                                <?php if($interessados[$i]['cod_mensagem'] != '' && $interessados[$i]['texto_resposta'] == '')  { ?>

                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_resposta" id="btn_responder" onclick="MontarModal(<?= $i ?>)">

                                                        <i class="fa fa-comment-o" aria-hidden="true"></i> Responder

                                                    </button>

                                                <?php }elseif($interessados[$i]['cod_mensagem'] != '' && $interessados[$i]['texto_resposta'] != '')  { ?>

                                                    <input type="hidden" id="msg_pergunta<?= $i ?>" value="<?= $interessados[$i]['texto_mensagem'] ?>">

                                                        <input type="hidden" id="msg_resposta<?= $i ?>" value="<?= $interessados[$i]['texto_resposta'] ?>">

                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_ver_resposta" onclick="VerResposta(<?= $i ?>)">

                                                        <i class="fa fa-comment-o" aria-hidden="true"></i> Ver resposta

                                                    </button>

                                                <?php } ?>

                                                

                                            </td>

                                            

                                        </tr>

                                        <?php } ?>

                                    </tbody>

                                </table>

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



        <!-- Button trigger modal -->



        <form method="POST" action="ver_interessados.php"> 

        <input type="hidden" name="cod_anuncio" value="<?= $cod_anuncio ?>">

        <!-- Modal -->

        <div class="modal fade" id="modal_resposta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Responder Pergunta: <div id="pergunta_popup"></div> </h4>

              </div>

              <div class="modal-body">

                  <input type="hidden" id="cod_mensagem_pop" name="cod_mensagem_pop">

                      <input type="hidden" id="cod_interessado_pop" name="cod_interessado_pop">

                  <label>Digite a Resposta:</label>

                  <textarea class="form-control" id="texto_msg" name="texto_msg"></textarea>

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

                <button  class="btn btn-primary" id="btn_resp" name="btn_resp" onclick="return ValidarCampo()">Enviar</button>

              </div>

            </div>

          </div>

        </div>

        </form>

        

                <!-- Modal -->

        <div class="modal fade" id="modal_ver_resposta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title" id="myModalLabel">Pergunta: <div id="ver_pergunta_popup"></div> </h4>

              </div>

              <div class="modal-body">

                

                  <label>Sua Resposta:</label>

                  <textarea class="form-control" id="ver_texto_msg" disabled></textarea>

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

              </div>

            </div>

          </div>

        </div>

        

        <script>

        

        function MontarModal(linha){

            var msg = $("#texto"+linha).val();

            var cod_msg = $("#cod_mensagem"+linha).val();

            var cod_interessado = $("#cod_interessado"+linha).val();

            //alert(cod_interessado);

            $("#pergunta_popup").html(msg);

            $("#cod_mensagem_pop").val(cod_msg);

            $("#cod_interessado_pop").val(cod_interessado);

      

        }

        function VerResposta(linha){



            var msg_perg = $("#msg_pergunta"+linha).val();

            var msg_resp = $("#msg_resposta"+linha).val();

            $("#ver_pergunta_popup").html(msg_perg);

            $("#ver_texto_msg").html(msg_resp);

        }

        

        function ValidarCampo(){

            if($("#texto_msg").val().trim() == ''){

                alert('É necessário escrever uma resposta');

                return false;

            }

        }



        </script>

        

    </body>

</html>



