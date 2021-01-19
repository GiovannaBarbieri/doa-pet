<?php
require_once '../Controller/UtilController.php';
UtilController::VerificarLogado();
require_once '/home/wmbar465/public_html/doapet.com.br/PHPMailer/src/PHPMailer.php';
require_once '/home/wmbar465/public_html/doapet.com.br/PHPMailer/src/SMTP.php';
require_once '/home/wmbar465/public_html/doapet.com.br/PHPMailer/src/Exception.php';
require_once '../Controller/PessoaController.php';
require_once '../Html/_msg.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$ret = '';

if (isset($_POST['btn_enviar']) != '') {

    $objcontroller = new PessoaController();
    $dados_conta = $objcontroller->CarregarDados();

    $nome = $dados_conta[0]['nome_pessoa'];
    $email = $dados_conta[0]['email_pessoa'];


    $tp_msg = UtilController::TratarString($_POST['tp_msg']);
    $mensagem = UtilController::TratarString($_POST['txt_sugestao']);

    if ($tp_msg != '' && $mensagem != '') {

          
        $objController = new PessoaController();
        $ret = $objController->SalvaSugestao($tp_msg, $mensagem);

        $tp_msg = $tp_msg == 1 ? 'Sugestão' : ($tp_msg == 2 ? 'Dúvida' : 'Crítica');
        
        $mail = new PHPMailer(true);
        try {


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

            $mail->Subject = "Email de contato DoaPet - Doacao de animais";
            $mail->msgHTML("<html>de: {$nome}<br/>email: {$email}<br/>Do que se trata:{$tp_msg}<br/>mensagem: {$mensagem}</html>");
            $mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$mensagem}";

            if ($mail->send()) {
                $_SESSION["success"] = "Mensagem enviada com sucesso";
                // header("Location: http://doapet.com.br/Html/sugestao2.php");
            } else {
                $_SESSION["danger"] = "Erro ao enviar mensagem " . $mail->ErrorInfo;
                //header("Location: http://doapet.com.br/Html/sugestao2.php");
            }
        } catch (Exception $e) {
            echo 'O E-mail Não pode ser enviado.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        $ret = 0;
    }
//die();
}
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
                            <h2>Críticas/Sugestões/Dúvidas</h2>   
                            <h5>Informe aqui suas dúvidas, sugestões e críticas.</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />

                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <form method="post" action="sugestao.php">   
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Informe do que se trata:  </label>
                                    <select class="form-control" id="tp_sugestao" name="tp_msg">
                                        <option value="">Selecione</option>
                                        <option value="1">Sugestão</option>
                                        <option value="2">Dúvida</option>
                                        <option value="3">Crítica</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Escreva o texto aqui:</label>
                                    <textarea name="txt_sugestao" id="txt_sugestao" class="form-control" value="<?= $_POST['txt_sugestao'] ?>" placeholder="Diga-nos o que poderia ser melhorado, informe problemas nos site ou então faça-nos uma pergunta."></textarea>

                                </div>
                                <button class="btn btn-success" name="btn_enviar"><i class="fa fa-users" aria-hidden="true"></i>Enviar</button></td>
                            </div>
                        </form>
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
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function () {
                $("#success-alert").slideUp(500);
            });
        </script>
    </body>
</html>

