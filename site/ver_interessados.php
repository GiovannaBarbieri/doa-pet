<?php 
require_once '/home/wmbar465/public_html/doapet.com.br/PHPMailer/src/PHPMailer.php';
require_once '/home/wmbar465/public_html/doapet.com.br/PHPMailer/src/SMTP.php';
require_once '/home/wmbar465/public_html/doapet.com.br/PHPMailer/src/Exception.php';
require_once '../Controller/AnuncioController.php'; 
require_once '../Controller/PrecadastroController.php';
require_once './_msg.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

UtilController::VerificarLogado();

$cod_anuncio = '';

$ret = '';

if(isset($_GET['cod']) && is_numeric($_GET['cod'])){

    $ret = isset($ret) ? $_GET['ret'] : '';
    
    $cod_anuncio = $_GET['cod'];

    $objControler = new AnuncioController();

    
    $dados_anuncio = $objControler->DadosAnuncio($cod_anuncio);
    $lista_interessados = $objControler->VerInteressadosNomes($cod_anuncio);

    if(count($dados_anuncio) == 0){

        header("location:meu_anuncio.php");

    }

    
    
    $data = $dados_anuncio[0]['data_anuncio'];

    $cidade = $dados_anuncio[0]['nome_cidade'];

    $titulo = $dados_anuncio[0]['titulo_anuncio'];

    $descricao = $dados_anuncio[0]['descricao_animal'];

    $nome_foto = $dados_anuncio[0]['caminho_foto'];



}else
if(isset($_POST['btn_gravar_msg'])){
    $cod_anuncio = $_POST['cod_anuncio'];
    $cod_mensagem = $_POST['pergunta'];
    $cod_interessado = $_POST['cod_interessado_pop'];
    $texto_msg = $_POST['texto_msg'];
    
    $objControler = new AnuncioController();
    $ret = $objControler->ResponderPergunta($texto_msg, $cod_mensagem);

    try{
        $dadosemail = $objControler->RetornaEmailInteressado($cod_interessado);
        $mail = new PHPMailer(true);
        $email = $dadosemail[0]['email_pessoa'];
        $nome = $dadosemail[0]['nome_pessoa'];
        $titulo = $dadosemail[0]['titulo_anuncio'];

            //Server settings
            //$mail->SMTPDebug = 2;
            $mail->SMTPDebug=2;
            // $mail->isSMTP();                               
            $mail->Host = 'mail.doapet.com.br';
            $mail->SMTPAuth = true;
            $mail->Username = 'contato@doapet.com.br';
            $mail->Password = 'CarrochoLouco1702';
            $mail->SMTPSecure = 'tsl';
            $mail->Port = 25;


            //Recipients
            $mail->setFrom('contato@doapet.com.br', 'DoaPet');
            $mail->addAddress($email, $nome);

            $mail->Subject = "Email de contato DoaPet - Resposta do Anunciante.";
            $mail->msgHTML("<html>Olá! <br/> O motivo de nosso contato é para avisar que sua pergunta feita no anúncio com o título: ".$titulo." já foi respondida."
                    . "<br/> Por gentileza, <a href='http://doapet.com.br/site/acesso.php'>acesse o site</a> para ver a resposta.</html>");
            $mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$mensagem}";

            if ($mail->send()) {
              //  $_SESSION["success"] = "Mensagem enviada com sucesso, verifique sua caixa de entrada do e-mail informado";
                //echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$_SESSION["success"].'</div>';
                //header("Location: http://doapet.com.br/site/acesso.php?ret=9");
                //return 1;
            } else {
//                $_SESSION["danger"] = "Erro ao enviar mensagem " . $mail->ErrorInfo;
//                echo $_SESSION["danger"];
                //header("Location: http://doapet.com.br/site/sugestao2.php");
            }
        } catch (Exception $e) {
//            echo 'O E-mail Não pode ser enviado.';
//            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

        
         header("location:ver_interessados.php?cod=$cod_anuncio&ret=$ret");
    

}else if(isset($_POST['btnAvaliar'])){
    $nota = $_POST['avaliacao'];
    $texto_motivo = $_POST['texto_aval'];
    $cod_anuncio = $_POST['cod_anuncio'];
    $cod_pessoa = $_POST['cod_pessoa_aval'];
    
    $ctrl = new AnuncioController();
    $ret = $ctrl->AvaliarInteressado($nota, $texto_motivo, $cod_anuncio, $cod_pessoa);
    
    header("location:ver_interessados.php?cod=$cod_anuncio&ret=$ret");
}
else{

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

                            <h5>Acompanhe todos os interessados do seu anúncio aqui. Antes de negociar a adoção, sempre é bom conferir as avaliações feitas por outras pessoas sobre os interessados, para isto, basta clicar no botão "Avaliações". Caso queira trocar/ler mensagens com o interessado, clique no botão "Mensagens"</h5>



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

                            Abaixo estão listados o nome e contatos dos interessados em seu anúncio. 

                        </div>

                        <div class="panel-body">

                            <?php if(isset($lista_interessados) && count($lista_interessados) > 0){ ?>
                            
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                                    <thead>

                                        <tr>

                                            <th class="center text-center" style="width: 80px;">Data de interesse</th>
                                                
                                            <th class="center text-center" style="width: 220px;">Interessado(a)</th>Interessado(a)</th>

                                            <th class="center text-center">Telefone</th>

                                            <th class="center text-center">E-mail</th>

                                            <th class="center text-center">Cidade</th>

                                            <th class="" style="width: 252px;"></th>

                                           



                                        </tr>

                                    </thead>

                                    <tbody>

                                        <?php for($i =0; $i < count($lista_interessados); $i++){ ?>

                                        <tr class="odd gradeX">

                                            <td class="center text-center"><?= $lista_interessados[$i]['data_interesse']?></td>

                                            <td  class="center text-center"><?= $lista_interessados[$i]['nome_pessoa']?></td >

                                            <td  class="center text-center"><?= $lista_interessados[$i]['telefone_pessoa']?></td >
                                            
                                            <td  class="center text-center"><?= $lista_interessados[$i]['email_pessoa']?></td >
                                            
                                            <td  class="center text-center"><?= $lista_interessados[$i]['nome_cidade']?></td >

                                            <td  class="center text-center">
                                                    <input type="hidden" name="cod_interessado" id="cod_interessado<?= $i ?>" value="<?= $lista_interessados[$i]['cod_interessado']?>">
                                                    <input type="hidden" name="nome_pessoa" id="nome_pessoa<?= $i ?>" value="<?= $lista_interessados[$i]['nome_pessoa']?>">
                                                    <input type="hidden" name="cod_pessoa" id="cod_pessoa<?= $i ?>" value="<?= $lista_interessados[$i]['cod_pessoa']?>">
                                                        
        
                                                        <div class="btn-group btn-group-sm center" role="group" aria-label="Large button group">
                                                           <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_mensagens" id="btn_responder" onclick="MontarModalPerguntas(<?= $i ?>)">
                                                        <i class="fa fa-comments" aria-hidden="true"></i> Mensagens (<?= $lista_interessados[$i]['mensagens']?>)
                                                    </button>  
                                                            <div class="visible-xs visible-sm"><br/><br/></div>
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_avaliacao" onclick="MontarModalAvaliacao(<?= $i ?>)" style="margin-left: 2px;">
                                                        <i class="fa fa-star-o" aria-hidden="true"></i> Avaliações (<?= $lista_interessados[$i]['avaliacoes']?>)
                                                    </button>   
                                                        </div>
                                                        
                                            </td>

                                            

                                        </tr>

                                        <?php } ?>

                                    </tbody>

                                </table>

                            </div>

                            <?php }else{ echo RetornaMsg(-14); } ?>

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

        <input type="hidden" name="cod_anuncio" id="cod_anuncio" value="<?= $cod_anuncio ?>">

        <!-- Modal -->

        <div class="modal fade" id="modal_mensagens" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <center><h4 class="modal-title" id="myModalLabel">Mensagens para: <div id="nome_pergunta_mensagem"></div> </h4></center>

              </div>

              <div class="modal-body">

                  
                  <input type="hidden" id="cod_interessado_pop" name="cod_interessado_pop">
               
                      <div style="display: none" id="mostrar_pergunta">
                          <div class="form-group">
                              <label>Escolha uma pergunta</label>
                              <select class="form-control" id="pergunta" name="pergunta"></select>
                          </div>
                          <div class="form-group">
                             <label>Digite uma resposta:</label>
                             <input type="text" class="form-control" id="texto_msg" name="texto_msg">
                          </div>   
                          <button class="btn btn-success" id="btn_gravar_msg" name="btn_gravar_msg" onclick="return ValidarCampoPergunta()" name="btn_gravar_msg">Enviar</button>    
                        
                      </div>  
                      <hr>
                      <div class="table-responsive">
                            <table id='tab_result' class="table table-striped table-bordered table-hover">
                            </table>
                      </div>
                          

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>

              </div>

            </div>

          </div>

        </div>

        </form>
        
    <!--modal avaliacao-->    
  <form method="POST" action="ver_interessados.php"> 

        <input type="hidden" name="cod_anuncio" id="cod_anuncio" value="<?= $cod_anuncio ?>">

        <!-- Modal -->

        <div class="modal fade" id="modal_avaliacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

          <div class="modal-dialog" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <center><h4 class="modal-title" id="myModalLabel">Avaliação de: <div id="nome_aval"></div> </h4></center>

              </div>

              <div class="modal-body">

                  
                  <input type="hidden" id="cod_pessoa_aval" name="cod_pessoa_aval">
               
                      <div id="html_conteudo"></div>
                          

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>

              </div>

            </div>

          </div>

        </div>

        </form>
          
        

        <script>

        

        function MontarModalPerguntas(linha){

            $("#cod_interessado_pop").val($("#cod_interessado"+linha).val());
            $("#nome_pergunta_mensagem").html($("#nome_pessoa"+linha).val());
            
            var cod_interessado = $("#cod_interessado"+linha).val();
            var cod_anuncio = $("#cod_anuncio").val();

  

           $.post("buscar_mensagens_repondidas_ajx.php", "cod_anuncio="+cod_anuncio+"&cod_interessado=" + cod_interessado, function (ret){
               $("#tab_result").html(ret);
           })
           $.post("buscar_mensagens_sem_respostas_ajx.php", "cod_anuncio="+cod_anuncio+"&cod_interessado=" + cod_interessado, function (ret){
               
               if(ret != 'nda'){
                    $("#pergunta").html(ret);
                    $("#mostrar_pergunta").show();
                }else{
                    $("#pergunta").html('');
                    $("#mostrar_pergunta").hide();
                }
           })
      

        }
        function MontarModalAvaliacao(linha){

            $("#cod_pessoa_aval").val($("#cod_pessoa"+linha).val());
            $("#nome_aval").html($("#nome_pessoa"+linha).val());
            
            var cod_pessoa = $("#cod_pessoa"+linha).val();
            var cod_anuncio = $("#cod_anuncio").val();

           

           $.post("buscar_avaliacoes_ajx.php", "cod_anuncio="+cod_anuncio+"&cod_pessoa=" + cod_pessoa, function (ret){
             $("#html_conteudo").html(ret);
           })
          
        }

        function ValidarCampoPergunta(){

            if($("#pergunta").val().trim() == ''){

                alert('É necessário selecionar uma pergunta');
                return false;
            }
            if($("#texto_msg").val().trim() == ''){

                alert('É necessário escrever uma resposta');
                return false;
            }
        }
        function ValidarAvaliacao(){

            if($("#avaliacao").val().trim() == ''){

                alert('É necessário selecionar uma avaliação');
                return false;
            }
            if($("#texto_aval").val().trim() == ''){

                alert('É necessário justificar sua avaliação');
                $("#texto_aval").focus();
                return false;
            }
        }


        </script>

        

    </body>

</html>



