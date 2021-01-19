<?php 
require_once '../Controller/UtilController.php'; UtilController::VerificarLogado();
    
    include '_msg.php';
    require_once '../Controller/PessoaController.php';
    require_once '../Controller/PrecadastroController.php';
    
    $ret = '';    
    if(isset($_POST['btn_salvar'])){
        
        $nome = $_POST['nome_usuario'];
        $email = $_POST['email_usuario'];
        $telefone = $_POST['telefone_usuario'];
        $cod_cidade = $_POST['cod_cidade'];
        
        $objcontroller = new PessoaController();
        $ret = $objcontroller->AlterarConta($nome, $email, $telefone, $cod_cidade); 
    }
    
    $objcontroller = new PessoaController();
    $dados_conta = $objcontroller->CarregarDados();

    $objcontroller = new PrecadastroController();
    $lista_cidade = $objcontroller->FiltrarCidade(1);
    
    $cod_cidade = $dados_conta[0]['cod_cidade'];
    $nome = $dados_conta[0]['nome_pessoa'];
    $email = $dados_conta[0]['email_pessoa'];
    $telefone = $dados_conta[0]['telefone_pessoa'];
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
                                           <?php
                         echo RetornaMsg($ret);
                        ?>
                            <h2>Meus dados</h2>   
                            <h5>Altere suas informações de cadastro</h5>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                                        <div class="row">
                        <div class="col-md-12">
                        
                            
                        </div>
                    </div>
                    <form method="post" action="meus_dados.php" >
                        <div id="erro_nome" class="form-group ">
                        <label>Nome</label>
                        <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" value="<?= $nome ?>"/>
                    </div>
                    <div id="erro_email" class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" id="email_usuario" name="email_usuario" value="<?= $email ?>"/>
                    </div>                    
                    <div id="erro_telefone" class="form-group">
                        <label>Telefone</label>
                        <input type="text" class="form-control num tel telpree" id="telefone_usuario" name="telefone_usuario" value="<?= $telefone ?>"/>
                    </div>
                        <div class="form-group">
                                    <label>Cidade</label> 
                                    <select class="form-control" id="cod_cidade" name="cod_cidade">

                                        <option value="">Selecione</option>
                                        <?php 
                                          for($i =0; $i < count($lista_cidade); $i++){
                                            ?>
                                        <option value="<?= $lista_cidade[$i]['cod_cidade']?>" <?php if($lista_cidade[$i]['cod_cidade'] == $cod_cidade) echo 'selected';?>><?= $lista_cidade[$i]['nome_cidade'] ?></option>  
                                        <?php  }?>  
                                    </select>    
                                </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success" id="btn_entrar" name="btn_salvar"><i class="fa fa-check" aria-hidden="true"></i> Salvar</button>
                    </div>
                </form>

                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <script>
            $("#btn_entrar").click(function(){
                if($("#nome_usuario").val().trim() == ""){
                // Deixa o input vermelho
                $("#erro_nome").addClass("has-error");
                
                alert("Favor preencher o campo Usuário");
                
                // Caso o usuário clique ele remove o vermelho
                    $( "#nome_usuario" ).focus(function(){
                        $("#erro_nome").removeClass("has-error");
                    });
                // Caso o usuário não clique depois de 2 seg ele define o focus    
                   setTimeout(function(){
                        $("#nome_usuario").focus();
                    }, 2000); 

                    return false;
                }
                if($("#email_usuario").val().trim() == ""){
                    // Deixa o input vermelho
                    $("#erro_email").addClass("has-error");
                    
                    alert("Favor preencher o campo Email");
                    
                    // Caso o usuário clique ele remove o vermelho
                    $( "#email_usuario" ).focus(function(){
                        $("#erro_email").removeClass("has-error");
                    });
                // Caso o usuário não clique depois de 2 seg ele define o focus    
                   setTimeout(function(){
                        $("#email_usuario").focus();
                    }, 2000); 
                    return false;
                }
                if($("#telefone_usuario").val().trim() == ""){
                    // Deixa o input vermelho
                    $("#erro_telefone").addClass("has-error");
                    
                    alert("Favor preencher o campo Telefone");
                    
                    // Caso o usuário clique ele remove o vermelho
                    $( "#telefone_usuario" ).focus(function(){
                        $("#erro_telefone").removeClass("has-error");
                    });
                // Caso o usuário não clique depois de 2 seg ele define o focus    
                   setTimeout(function(){
                        $("#telefone_usuario").focus();
                    }, 2000); 
                    return false;
                }
                if($("#nome_usuario").val().trim().length < 8){
                // Deixa o input vermelho
                $("#erro_nome").addClass("has-error");
                    alert("Favor colocar um nome maior que 8 caracteres");
                     // Caso o usuário clique ele remove o vermelho
                    $( "#nome_usuario" ).focus(function(){
                        $("#erro_nome").removeClass("has-error");
                    });
                // Caso o usuário não clique depois de 2 seg ele define o focus    
                   setTimeout(function(){
                        $("#nome_usuario").focus();
                    }, 2000); 
                    return false;
                }
                
            })
        </script>
    </body>
</html>

