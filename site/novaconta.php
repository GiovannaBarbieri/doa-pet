<?php 
    require_once '../Controller/PessoaController.php';
    require_once '../Controller/PrecadastroController.php';
 
    include './_msg.php';
    
    $cod_cidade = '';
    $nome_usuario = '';
    $email_usuario = '';
    $telefone_usuario = '';
    $ret = '';
    
    if(isset($_POST['btn_finalizar'])){
        $nome_usuario = $_POST['nome_usuario'];
        $email_usuario = $_POST['email_usuario'];
        $telefone_usuario = $_POST['telefone_usuario'];
        $senha_usuario = $_POST['senha_usuario'];
        $repetir_senha = $_POST['repetir_senha'];
        $cod_cidade = $_POST['cod_cidade'];
        $termos = $_POST['aceita_termos'];
        
        $objcontroller = new PessoaController();
        $ret = $objcontroller->criarConta($nome_usuario, $email_usuario, $senha_usuario, $repetir_senha, $telefone_usuario, $cod_cidade, $termos, 1);
//         echo '<pre>';
//        var_dump($objcontroller);
//        echo '</pre>';
        
    }
    
    $objControler = new PrecadastroController();
    $lista_cidade = $objControler->FiltrarCidade(1);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include '_head.php'; ?>
<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
               
                <h2> DoaPet</h2>
               
                
                 <br />
            </div>
        </div>
         <div class="row">
               
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>  Preencha todos os campos para criar a conta.</strong>  
                            </div>
                            <div class="panel-body">
                                 <?php echo RetornaMsg($ret); ?>
                                <form method="post" action="novaconta.php">
<br/>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Seu nome" maxlength="45" id="nome_usuario" name="nome_usuario" value="<?= $nome_usuario ?>" />
                                        </div>
                                   
                                         <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" placeholder="Seu e-mail" maxlength="45" id="email_usuario" name="email_usuario" value="<?= $email_usuario ?>"/>
                                        </div>

                                    <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control num tel telpree" placeholder="Seu telefone" maxlength="11" id="telefone_usuario" name="telefone_usuario" value="<?= $telefone_usuario ?>"/>
                                        </div>
                                <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                    <select class="form-control" id="cod_cidade" name="cod_cidade">

                                        <option value="">Selecione</option>
                                        <?php 
                                          for($i =0; $i < count($lista_cidade); $i++){
                                            ?>
                                        <option value="<?= $lista_cidade[$i]['cod_cidade']?>" <?php if($lista_cidade[$i]['cod_cidade'] == $cod_cidade) echo 'selected';?>><?= $lista_cidade[$i]['nome_cidade'] ?></option>  
                                        <?php  }?>  
                                    </select>    
                                </div>
                                      <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="Crie uma senha (min 6 caracteres)" maxlength="12" id="senha_usuario" name="senha_usuario"/>
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="Repita sua senha" maxlength="12" id="repetir_senha" name="repetir_senha"/>
                                        </div>
                                     <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="aceita_termos" id="aceita_termos"> Aceito os <a href="#" data-toggle="modal" data-target="#modal_termos">termos</a>
                                        </label>
                                      </div>
                                <button class="btn btn-success" id="btn_finalizar" name="btn_finalizar">Finalizar</button>
                                    <hr />
                                    Já é cadastrado ?  <a href="acesso.php">Clique aqui</a>
                                  
                                    </form>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>
    
    
<!-- Modal -->
<div class="modal fade" id="modal_termos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Termos de Uso DoaPet</h4>
      </div>
      <div class="modal-body">
        <?php include './termos.php'; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
   
      </div>
    </div>
  </div>
</div>
    
    
    
    
    <script>
       $("#btn_finalizar").click(function(){
           
           var verificar = 1;
           var msg = "Preencher o(s) campo(s): \n";
           
           
           if($("#nome_usuario").val().trim() == ""){
               verificar = 0;
               msg += '\n - Favor preencher o campo Nome'; 
              // alert("Favor preencher o campo Nome");
               //return false;
           }
           if($("#email_usuario").val().trim() == ""){
               verificar = 0;
               msg += '\n - Favor preencher o campo Email'; 
                //alert("Favor preencher o campo Email");
               //return false;
           }
           if($("#telefone_usuario").val().trim() == ""){
               verificar = 0;
               msg += '\n - Favor preencher o campo Telefone'; 
               //alert("Favor preencher o campo Telefone");
               //return false;
           }
           if($("#cod_cidade").val().trim() == ""){
               verificar = 0;
               msg += '\n - Favor preencher o campo Cidade'; 
               //alert("Favor preencher o campo Telefone");
               //return false;
           }
           if($("#senha_usuario").val().trim() == ""){
               verificar = 0;
               msg += '\n - Favor preencher o campo senha'; 
               //alert("Preencha a senha");
              // return false;
           }
           if($("#repetir_senha").val().trim() == ""){
               verificar = 0;
               msg += '\n - Favor preencher o campo Repetir senha'; 
               //alert("Preencher repetir senha");
               //return false;
           }
            if(!$("#aceita_termos").is(':checked')){
               verificar = 0;
               msg += '\n - Por favor aceite os termos'; 
               //alert("Preencher repetir senha");
               //return false;
           }
           if(verificar == 0){
               alert(msg);
               return false;
           }
           
           if($('#nome_usuario').val().trim().length < 8){
               alert('Favor preecher o nome completo ');
               return false;
           }
           if($('#senha_usuario').val().trim().length < 6){
               alert('Favor preecher o campo senha com mais de 6 caracteres');
               return false;
           }
           if($("#senha_usuario").val().trim() != $("#repetir_senha").val().trim()){
               alert("Senha e repetir senha não estão iguais");
               return false;
           }
           
       })
    </script>
</body>
</html>
