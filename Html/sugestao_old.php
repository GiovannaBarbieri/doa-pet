<?php 
require_once '../Controller/PessoaController.php';
require_once '../Controller/UtilController.php';
require_once '../Html/_msg.php';
$ret = '';
UtilController::VerificarLogado();

       if(isset($_GET['acao']) && $_GET['acao'] != '' && is_numeric($_GET['acao'])){
           $ret = $_GET['acao'];
        }
if(isset($_POST['btn_enviar']) != ''){
    $tipo = $_POST['tp_sugestao'];
    $texto = $_POST['txt_sugestao'];
    
    $objController = new PessoaController();
    $ret = $objController->SalvaSugestao($tipo, $texto);
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
                                <select class="form-control" id="tp_sugestao" name="tp_sugestao">
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
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});
        </script>
    </body>
</html>

