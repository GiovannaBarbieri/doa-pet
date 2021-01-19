<?php
require_once '../Controller/PessoaController.php';
require_once '../site/_msg.php';
$hash = '';
$nome = '';
$email= '';
$cod = '';
$bdsenha = '';
$bdcod = '';
$ret = '';
$ns = '';
if (isset($_GET['ns'])) {
    $hash = $_GET['ns'];
    $objController = new PessoaController();
    $dados = $objController->ValidaHash($hash);
    //print_r($dados);
    if ($dados[0]['cod_pessoa'] != '') {
        $nome = $dados[0]['nome_pessoa'];
        $email = $dados[0]['email_pessoa'];
        $bdsenha = $dados[0]['senha_pessoa'];
        if ($bdsenha == $hash) {
            $bdcod = $dados[0]['cod_pessoa'];
        } else {

            header("Location: http://doapet.com.br/site/esqueceu_senha.php?ret=-13");
        }
    } else {
        header("Location: http://doapet.com.br/site/acesso.php?ret=-13");
    }
} else if (isset($_POST['btn_salvar'])) {
    $cod = $_POST['cod_usuario'];
    $senha = $_POST['senha'];
    $rsenha = $_POST['rsenha'];
    $objcontroller = new PessoaController();
    $ret = $objcontroller->NovaSenha($senha, $rsenha, $cod);
    if ($ret < 0) {
        
    } else {
        header("Location: http://doapet.com.br/site/acesso.php?ret=10");
    }
} else if (isset($_POST['hash'])) {
    $objController = new PessoaController();
    $dados = $objController->ValidaHash($_POST['hash']);
    //print_r($dados);
    if (count($dados) > 0) {
        $bdsenha = $dados[0]['senha_pessoa'];
        if ($bdsenha == $_POST['hash']) {
            $bdcod = $dados[0]['cod_pessoa'];
        } else {

            header("Location: http://doapet.com.br/site/esqueceu_senha.php?ret=-13");
        }
    }
} else {
    header("Location: http://doapet.com.br/site/esqueceu_senha.php?ret=-13");
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



                    <h5>Atenção. Esta é a tela para redefinir sua senha, informe abaixo a nova senha a ser utilizada.</h5>

                    <br />

                </div>

            </div>

            <div class="row ">



                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            <strong>   Digite a senha e a repita novamente: </strong>  

                        </div>

                        <div class="panel-body">

                            <?php echo RetornaMsg($ret); ?>

                            <form role="form" method="POST" action="ns.php">
                                <input type="hidden" value="<?= isset($_POST['cod_usuario']) ? $_POST['cod_usuario'] : $bdcod; ?>" name="cod_usuario" />
                                <input type="hidden" value="<?= isset($_POST['hash']) ? $_POST['hash'] : $hash; ?>" name="hash" />
                                <input type="hidden" value="<?= isset($_POST['nome']) ? $_POST['nome'] : $nome; ?>" name="nome" />
                                <input type="hidden" value="<?= isset($_POST['email']) ? $_POST['email'] : $email; ?>" name="email" />
                                
                                <h5>Dados da conta:</h5>
                                <b>Nome:</b> <?= isset($_POST['nome']) ? $_POST['nome'] : $nome;?> <br/>
                                <b>E-mail:</b> <?= isset($_POST['email']) ? $_POST['email'] : $email;?>
                                <br/>
                                
                                <br />

                                <div class="form-group input-group">

                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>

                                    <input type="password" class="form-control" placeholder="Sua nova senha" name="senha" id="senha" />

                                </div>

                                <div class="form-group input-group">

                                    <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>

                                    <input type="password" class="form-control"  placeholder="Repita sua senha" name="rsenha" id="rsenha"/>

                                </div>

                                <div class="form-group">

                                </div>



                                <button class="btn btn-primary" name="btn_salvar" id="btn_salvar">Salvar</button>

                                <hr />



                            </form>

                        </div>



                    </div>

                </div>





            </div>

        </div>

        <script>

            $("#btn_entrar").click(function () {

                if ($("#senha").val().trim() == "") {

                    alert("Favor preencher o campo Senha.");

                    return false;

                }

                if ($("#rsenha").val().trim() == "") {

                    alert("Preencher repita sua senha.");

                    return false;

                }

            })

        </script>

    </body>

</html>
