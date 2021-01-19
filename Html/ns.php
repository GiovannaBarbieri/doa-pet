<?php
    require_once '../Controller/PessoaController.php';
    require_once '../Html/_msg.php';
    $bdsenha = '';
    $bdcod = '';
    $ret = '';
    $ns = '';
    //echo $_GET['ns'];
    if(isset($_GET['ns'])){
        $hash = $_GET['ns'];
        
        $objController = new PessoaController();
        $dados = $objController->ValidaHash($hash);
        //print_r($dados);
        if(count($dados) > 0){
            $bdsenha = $dados[0]['senha_pessoa'];
            if($bdsenha == $hash){
                $bdcod = $dados[0]['cod_pessoa'];
            }else{
                
               header("Location: http://doapet.com.br/Html/esqueceu_senha.php");
            }
            
        }
    }
    else if(isset($_POST['btn_salvar'])){
            $cod = $_POST['cod_usuario'];
            $senha = $_POST['senha'];
            $rsenha = $_POST['rsenha'];
            $objcontroller = new PessoaController();
            $ns = $objcontroller->NovaSenha($senha, $rsenha, $cod);
            
    }else{
        header("Location: http://doapet.com.br/Html/acesso.php");
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

                        <strong> Por favor insira sua nova senha</strong>  

                            </div>

                            <div class="panel-body">

                                <?php echo RetornaMsg($ns); ?>

                                <form role="form" method="POST" action="ns.php">
                                    <input type="hidden" value="<?= $bdcod?>" name="cod_usuario" />
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

        $("#btn_entrar").click(function(){

            if($("#senha").val().trim() == ""){

                alert("Favor preencher o campo Senha.");

                return false;

            }

            if($("#rsenha").val().trim() == ""){

                alert("Preencher repita sua senha.");

                return false;

            }

        })

    </script>

</body>

</html>
