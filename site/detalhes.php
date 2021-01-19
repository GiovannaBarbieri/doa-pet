<?php
require_once '/home/wmbar465/public_html/doapet.com.br/PHPMailer/src/PHPMailer.php';
require_once '/home/wmbar465/public_html/doapet.com.br/PHPMailer/src/SMTP.php';
require_once '/home/wmbar465/public_html/doapet.com.br/PHPMailer/src/Exception.php';
require_once '../Controller/PessoaController.php';
require_once '../Controller/AnuncioController.php';
require_once '../Controller/UtilController.php';
require_once '../site/_msg.php';
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
UtilController::VerificarLogado();

$titulo_anuncio = '';
$interesse = '';
$anuncio = '';
$ret = '';

if (isset($_GET['cod']) && $_GET['cod'] != '' && is_numeric($_GET['cod'])) {



    $cod = $_GET['cod'];


    $objcontroller = new AnuncioController();
    $anuncio = $objcontroller->CarregarDetalhes($cod);
    $interesse = $objcontroller->VerificaInteressado($cod_anuncio, '');
    
    $ret = isset($_GET['ret']) ? $_GET['ret'] : '';

    if (count($anuncio) == 0) {

        header("location: ver_anuncios.php");

    } else {



        $cod_pessoa = $anuncio[0]['cod_pessoa'];



        $nome = $anuncio[0]['nome_pessoa'];



        $data_anuncio = $anuncio[0]['data_anuncio'];



        $nome_cidade = $anuncio[0]['nome_cidade'];



        $sigla_estado = $anuncio[0]['sigla_estado'];



        $tipo = $anuncio[0]['nome_tipo'];



        $porte = $anuncio[0]['tipo_porte'] == 1 ? 'Pequeno' : ($anuncio[0]['tipo_porte'] == 2 ? 'Médio' : 'Grande' );



        $titulo_anuncio = $anuncio[0]['titulo_anuncio'];



        $descricao_animal = $anuncio[0]['descricao_animal'];



        $foto = $anuncio[0]['caminho_foto'];



        $cod_anuncio = $anuncio[0]['cod_anuncio'];



        $nome_pessoa = $anuncio[0]['nome_pessoa'];



        $email_pessoa = $anuncio[0]['email_pessoa'];



        $telefone_pessoa = $anuncio[0]['telefone_pessoa'];



        $interesse = $objcontroller->VerificaInteressado($cod_anuncio,'');



        $mensagens = $objcontroller->CarregarAnuncios($cod_anuncio);







        //Guarda o cod_interessado



        $cod_interessado = count($interesse[0]['cod_interessado']) > 0 ? $interesse['0']['cod_interessado']: '';



    }



} elseif (isset($_POST['btn_finalizar'])) {



    $cod = $_POST['cod_anuncio'];



    $pergunta = $_POST['pergunta'];



    $cod_pessoa = $_POST['cod_pessoa'];







    


    try {
        
        $objcontroller = new AnuncioController();
        $mail = new PHPMailer(true);
        $dados_email= $objcontroller->PegaEmail($cod);
        $nome = $dados_email[0]['nome_pessoa'];
        $email = $dados_email[0]['email_pessoa'];
        $titulo_anuncio = $dados_email[0]['titulo_anuncio'];
        
            //Server settings
            $mail->SMTPDebug = 2;
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

            $mail->Subject = "Email de contato DoaPet - Novo interessado!";
            $mail->msgHTML("<html>Olá ".$nome.". <br/>você possui um novo interessado em seu anúncio: <strong>".$titulo_anuncio."</strong>! Por gentileza, assim que possível <a href='http://doapet.com.br/site/acesso.php'>acesse o site</a> e verifique o novo interessado em seu anúncio. </html>");
            $mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$mensagem}";

            if ($mail->send()) {
                //$_SESSION["success"] = "Mensagem enviada com sucesso, verifique sua caixa de entrada do e-mail informado";
                $ret = $objcontroller->ConfirmarInteresse($cod, $pergunta, $cod_pessoa);
                header("location: ver_anuncios.php?acao=$ret");
                //echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$_SESSION["success"].'</div>';
                //header("Location: http://doapet.com.br/Html/acesso.php?ret=9");
                //return 1;
            } else {
               // $_SESSION["danger"] = "Erro ao enviar mensagem " . $mail->ErrorInfo;
                //echo $_SESSION["danger"];
                //header("Location: http://doapet.com.br/Html/sugestao2.php");
            }
        } catch (Exception $e) {
//            echo 'O E-mail Não pode ser enviado.';
//            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }




   



} else if (isset($_POST['btn_mensagem'])) {







    $cod = $_POST['cod_anuncio'];



    $cod_pessoa = $_POST['cod_pessoa'];



    $pergunta = $_POST['pergunta'];



    $cod_interessado = $_POST['cod_interessado'];
    

    try {
        
        $objcontroller = new AnuncioController();
        $mail = new PHPMailer(true);
        $dados_email= $objcontroller->PegaEmail($cod);
        $nome = $dados_email[0]['nome_pessoa'];
        $email = $dados_email[0]['email_pessoa'];
        $titulo_anuncio = $dados_email[0]['titulo_anuncio'];
        
            //Server settings
            $mail->SMTPDebug = 2;
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

            $mail->Subject = "Email de contato DoaPet - Nova pergunta";
            $mail->msgHTML("<html><img   src='../Fotos/dp.png'/>Olá ".$nome.", você acabou de receber uma pergunta no anuncio: <strong>".$titulo_anuncio."</strong>! Por gentileza, assim que possivel acesse o site e responda a esta pergunta. </html>");
            $mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$mensagem}";

            if ($mail->send()) {
                //$_SESSION["success"] = "Mensagem enviada com sucesso, verifique sua caixa de entrada do e-mail informado";
                $ret = $objcontroller->NovaMensagem($cod, $pergunta, $cod_interessado, $cod_pessoa);
                header('location: detalhes.php?ret=' . $ret . '&cod=' . $cod);
                //echo '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$_SESSION["success"].'</div>';
                //header("Location: http://doapet.com.br/Html/acesso.php?ret=9");
                //return 1;
            } else {
               // $_SESSION["danger"] = "Erro ao enviar mensagem " . $mail->ErrorInfo;
               // echo $_SESSION["danger"];
                //header("Location: http://doapet.com.br/Html/sugestao2.php");
            }
        } catch (Exception $e) {
            //echo 'O E-mail Não pode ser enviado.';
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

    



} else {



    header("location: ver_anuncios.php");



}

?>
﻿<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">



    <?php include '_head.php'; ?>



    <body>



      <div id="wrapper">



            <?php include '_topo.php'; ?>
            <?php include '_menu.php'; ?>







            <div id="page-wrapper" >



                <div id="page-inner">



                    <div class="row">



                        <div class="col-md-12">



                            <?php echo RetornaMsg($ret); ?>



                            <h2>Detalhes do anúncio</h2>   



                            <!--<h5>Abaixo estão listados todos os seus anúncios.</h5>







                        </div>



                    </div>



                            <!-- /. ROW  -->



                            <hr />







                            <!-- Advanced Tables -->



                            <div class="panel panel-default">



                                <div class="panel-heading">



                                    <h3><?= $titulo_anuncio ?></h3>



                                </div>

                                    <div class="meu-anuncio col-md-9 ">



                                        <div class="meu-anuncio col-md-12 col-sm-12">



                                            <br />



                                            <div class="row">



                                                <div class="col-md-12">



                                                    <?php if ($foto != '') { ?> 



                                                        <img class="img-responsive thumbnail"  src="<?= UtilController::DevolverCaminhoFoto($foto); ?>" style="max-height: 300px;"/>



                                                    <?php } else { ?>



                                                        <img class="img-responsive thumbnail"  src="assets/img/anuncio-sem-foto.png">



                                                        <?php } ?>



                                                







                                                <p class="text-left margin-texto"><i class="fa fa-check" aria-hidden="true" style="color: #6C594A;"></i> Porte: <?= $porte ?></p>



                                                <p class="text-left margin-texto"><i class="fa fa-paw" aria-hidden="true" style="color: #6C594A;"></i> Tipo: <?= $tipo ?></p>







                                                <p class="text-left margin-texto"><i class="fa fa-calendar" aria-hidden="true" style="color: #6C594A;"></i> Postado dia: <?= $data_anuncio ?>, <i class="fa fa-map-marker" aria-hidden="true" style="color: #6C594A;"></i> para a cidade de <?= $nome_cidade ?>/<?= $sigla_estado ?>



                                                </p>

</div>

                                                <div class="col-md-12"><p class="text-left text-muted lead margin-texto"><?= $descricao_animal; ?></p></div>



                                                <div class="col-md-12"><?php if ($lista_anuncios[$i]['situacao_anuncio'] == 2) echo '<i class="fa fa-info-circle" aria-hidden="true"></i> Este Anúncio foi encerrado'; ?></div>



                                            </div>







                                        </div>



                                        <div class="meu-anuncio col-md-12 borda col-sm-12">



                                            <h3>Dados do Anunciante</h3><hr/>



                                            <div class="row">              
                                                <div class="col-md-12">


                                                <p class="text-left margin-texto"><i class="fa fa-user" aria-hidden="true" style="color: #6C594A;"></i> Nome: <?= $nome_pessoa ?></p>



                                                <p class="text-left margin-texto"><i class="fa fa-envelope-o" aria-hidden="true" style="color: #6C594A;"></i> E-mail: <?= $email_pessoa ?></p>



                                                <p class="text-left margin-texto"><i class="fa fa-phone" aria-hidden="true" style="color: #6C594A;"></i>  Telefone: <?= $telefone_pessoa ?></p>


                                                </div>
                                            </div>







                                        </div>



                                        <?php if($cod_pessoa != UtilController::RetornarCodigoLogado()){ ?>



                                        <?php if (count($interesse) == 0) { ?>



                                            <div class="meu-anuncio col-md-12 borda col-sm-12">



                                                <h3>Confirmação do Interesse</h3><hr/>



                                                <form method="post" action="detalhes.php">



                                                    <input type="hidden" name="cod_pessoa" value="<?= $cod_pessoa ?>">   



                                                        <input type="hidden" name="cod_anuncio" value="<?= $cod ?>">



                                                            <div class="form-group"> 



                                                                <label>Enviar Mensagem (opcional):</label>



                                                                <textarea class="form-control" rows="3" name="pergunta" placeholder="Caso queira fazer uma pergunta, escreva aqui."></textarea>



                                                            </div>



                                                            <center><button class="btn btn-success" name="btn_finalizar">Concluir Interesse</button></center>



                                                            <br/>



                                                            </form>



                                                            </div>



                                                        <?php } else { ?>



                                                            <div class="meu-anuncio col-md-12 borda col-sm-12">



                                                                <h3>Você ja registrou seu interesse neste anúncio.</h3><hr/>



                                                                <h5>  > <i>Mas ainda pode fazer peguntas para o anunciante.</i></h5>



                                                                <form method="post" action="detalhes.php">



                                                                    <input type="hidden" name="cod_pessoa" value="<?= $cod_pessoa ?>">   



                                                                        <input type="hidden" name="cod_anuncio" value="<?= $cod ?>">



                                                                            <input type="hidden" name="cod_interessado" value="<?= $cod_interessado ?>">



                                                                                <div class="form-group"> 



                                                                                    <label>Enviar Mensagem:</label>



                                                                                    <textarea class="form-control" rows="3" id="pergunta" name="pergunta" placeholder="Caso queira fazer uma pergunta, escreva aqui."></textarea>



                                                                                </div>



                                                                                <center><button class="btn btn-success" id="btn_mensagem" name="btn_mensagem">Enviar Pergunta</button></center>
                                                                                <br/>


                                                                                </form>



                                                                                </div>



                                        <?php } } ?>
                                                                           <h2>Mensagens do Anúncio</h2>
<?php if (count($mensagens) > 0) { ?>

        <div class="panel panel-white post ">
         <?php for ($i = 0; $i < count($mensagens); $i++) { ?>


            <div class="post-footer">
    
                <ul class="comments-list">
                    <li class="comment">
                        <a class="pull-left" href="#">
                            <img class="avatar" src="assets/img/mensagens-pergunta.jpg" alt="Pergunta">
                        </a>
         
                        <div class="comment-body">
                            <div class="comment-heading">
                                <h4 class="user"><?= $mensagens[$i]['nome_pessoa'] ?></h4>
                                <h6 class=""><?= $mensagens[$i]['data_mensagem'] ?> às <?= $mensagens[$i]['hora_mensagem'] ?></h6>
                            </div>
                            <p><?= $mensagens[$i]['texto_mensagem'] ?></p>
                        </div>
                        <?php if ($mensagens[$i]['texto_resposta'] != '') { ?>
 
                        <ul class="comments-list">
                            <li class="comment">
                                <a class="pull-left" href="#">
                                     <?php if ($foto != '') { ?> 
                                    <img class="avatar" src="<?= UtilController::DevolverCaminhoFoto($foto); ?>" alt="avatar">
                                        <?php } else { ?>
                                        <img class="avatar" src="assets/img/anuncio-sem-foto.png"><?php } ?>
                                </a>
                                <div class="comment-body">
                                    <div class="comment-heading">
                                        <h4 class="user">Anúnciante</h4>            
                                        <h6 class="">Data: <?= $mensagens[$i]['data_resposta'] ?> às <?= $mensagens[$i]['hora_resposta'] ?></h6>
                                    </div>
                                    <p><?= $mensagens[$i]['texto_resposta'] ?></p>
                                </div>
                            </li> 

                        </ul>
                        <?php } ?>
                    </li>
                </ul>
            </div>
            <?php } ?>
        </div>
  


<?php }else { ?>



                                                                                <p> <i>Não existe nenhuma pergunta. Seja o primeiro a fazer uma</i></p> 



                                                                            <?php } ?>



                                                                        </div> <div class="col-md-3" style="position: sticky;top: 20px;margin-top: 20px;">
                                                                            <a href="sugestao.php" title="Fale Conosco"><img class="img-responsive center-block" src="assets/img/banner-anuncie.gif"></a>                     </div>



                                                



                    </div>



                    <!--End Advanced Tables -->















                </div>



                <!-- /. PAGE INNER  -->



            </div>



            <!-- /. PAGE WRAPPER  -->



        </div>



        <!-- /. WRAPPER  -->



                             </div>        </div>        

            <script>

                $("#btn_mensagem").click(

                    function(){

                        if($("#pergunta").val().trim() == ''){

                            alert ('É necessario escrever uma pergunta');

                            return false;

                        }

                }); 

            </script>



</body>



</html>







