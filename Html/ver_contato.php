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
                            <h2>Meus Anúncios</h2>   
                            <h5>Abaixo estão listados todos os seus anúncios.</h5>

                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                    <div class="form-group">
                        <img src="">
                    </div>
                    <div class="form-group">
                        <label>Nome do Interessado</label>
                    </div>
                   <div class="form-group">
                        <label>E-mail / Telefone</label>
                    </div>
                    <div class="form-group">
                        <label>Escreva uma mensagem</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                      
                        <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>Enviar mensagem</button>
                    </div>
                    <hr />
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Histórico de Mensagens
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th class="center text-center">Mensagem</th>
                                            <th class="center text-center">Enviado</th>
                                            


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td class="center text-center">Adriano</td>
                                            <td class="center text-center">12/12/2017</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

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


    </body>
</html>

