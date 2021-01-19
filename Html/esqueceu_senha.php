<?php
require_once '/home/wmbar465/public_html/doapet.com.br/PHPMailer/src/PHPMailer.php';
require_once '/home/wmbar465/public_html/doapet.com.br/PHPMailer/src/SMTP.php';
require_once '/home/wmbar465/public_html/doapet.com.br/PHPMailer/src/Exception.php';
require_once '../Controller/PessoaController.php';
require_once '../Html/_msg.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$email = '';
$nome = '';

if (isset($_POST['btn_sol'])) {
    
    $email = $_POST['email_usuario'];
    
    $objController = new PessoaController();
    $dados = $objController->ValidaEmail($email);
    echo $dados;
    
    
    if (count($dados) > 0) {
         
        $mail = new PHPMailer(true);
        $nome = $dados[0]['nome_pessoa'];
        $senha = $dados[0]['senha_pessoa'];
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
            $mail->msgHTML("<html>Validamos o seu e-mail e vimos que se trata de um e-mail existente!</br>"
                    . " Por gentileza clique no link abaixo para ser direcionado para a tela onde poderá inserir sua nova senha.</br>"
                    . "Link para nova senha: <a href='http://doapet.com.br/Html/ns.php?ns=".$senha."'>Clique aqui.</a></html>");
            $mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$mensagem}";

            if ($mail->send()) {
                $_SESSION["success"] = "Mensagem enviada com sucesso, verifique sua caixa de entrada do e-mail informado";
                //echo $_SESSION["success"];
                // header("Location: http://doapet.com.br/Html/sugestao2.php");
            } else {
                $_SESSION["danger"] = "Erro ao enviar mensagem " . $mail->ErrorInfo;
                echo $_SESSION["danger"];
                //header("Location: http://doapet.com.br/Html/sugestao2.php");
            }
        } catch (Exception $e) {
            echo 'O E-mail Não pode ser enviado.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        $ret = 0;
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

    <?php include '_head.php'; ?>

    <body>

        <div class="container">

            <div class="row text-center ">

                <div class="col-md-12">

                    <br /><br />

                    <h2> DoaPet</h2>



                    <h5></h5>

                    <br />

                </div>

            </div>

            <div class="row ">



                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            <strong> Recuperação de senha:</strong>  

                        </div>

                        <div class="panel-body">

                            <?php // echo RetornaMsg($ret); ?>

                            <form role="form" method="POST" action="esqueceu_senha.php">

                                <br />

                                <div class="form-group input-group">
                                    <span class="input-group-addon">@</span>                                            
                                    <input type="text" class="form-control" placeholder="Informe seu e-mail cadastrado." name="email_usuario" id="email_usuario" value="<?= $email ?>"/>                                        
                                </div>
                                <div class="form-group">                                    
                                    <button class="btn btn-sucess" name="btn_sol" id="btn_sol">Solicitar</button>
                                </div>

                            </form>

                        </div>



                    </div>

                </div>





            </div>

        </div>

        <script>

            $("#btn_sol").click(function () {

                if ($("#email_usuario").val().trim() == "") {

                    alert("Favor preencher o campo e-mail");

                    return false;

                }

                if ($("#email_usuario").val().trim() == "") {

                    alert("Preencher o campo senha");

                    return false;

                }

            })

        </script>

    </body>

</html>

