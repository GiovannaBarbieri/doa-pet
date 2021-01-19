<?php 

    require_once '../Controller/PessoaController.php';

    require_once '_msg.php';

    $msg = '';

    $ret = isset($_GET['ret']) ? $_GET['ret'] : '';
    
    if(isset($_POST['btn_entrar'])){

        $email = $_POST['email_usuario'];

       $senha = $_POST['senha_usuario'];

        

        $objcontroller = new PessoaController();

        $ret = $objcontroller->ValidarLogin($email, $senha);

        

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

               

                <h5>Caso você seja cadastrado entre com seus dados.</h5>

                 <br />

            </div>

        </div>

         <div class="row ">

               

                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

                        <div class="panel panel-default">

                            <div class="panel-heading">

                        <strong>   Digite o E-mail e Senha </strong>  

                            </div>

                            <div class="panel-body">

                                <?php echo RetornaMsg($ret); ?>

                                <form role="form" method="POST" action="acesso.php">

                                       <br />

                                     <div class="form-group input-group">

                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>

                                            <input type="text" class="form-control" placeholder="Seu e-mail" name="email_usuario" id="email_usuario" value="<?=$email ?>"/>

                                        </div>

                                                                              <div class="form-group input-group">

                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>

                                            <input type="password" class="form-control"  placeholder="Sua senha" name="senha_usuario" maxlength="12" id="senha_usuario"/>

                                        </div>

                                    <div class="form-group">

                                           

                                            <span class="pull-right">

                                                <a href="esqueceu_senha.php" >Esqueceu sua senha ? </a> 

                                            </span>

                                        </div>

                                     

                                       <button class="btn btn-primary" name="btn_entrar" id="btn_entrar">Entrar</button>

                                    <hr />

                                    Não tem cadastro ? <a href="novaconta.php" >Clique aqui </a> 

                                    </form>

                            </div>

                           

                        </div>

                    </div>

                

                

        </div>

    </div>

    <script>

        $("#btn_entrar").click(function(){

            if($("#email_usuario").val().trim() == ""){

                alert("Favor preencher o campo e-mail");

                return false;

            }

            if($("#senha_usuario").val().trim() == ""){

                alert("Preencher o campo senha");

                return false;

            }

        })

    </script>
    <script>
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function () {
                $("#success-alert").slideUp(500);
            });
        </script>

</body>

</html>

