<?php

require_once '../Controller/AnuncioController.php';
require_once '../Controller/UtilController.php';
require_once '_msg.php';
if ($_POST['cod_pessoa'] && isset($_POST['cod_anuncio'])) {

    $cod_pessoa = $_POST['cod_pessoa'];
    $cod_anuncio = $_POST['cod_anuncio'];
    
    $ctrl = new AnuncioController();
    $linha = '';
    
    $detalhes = $ctrl->ContarAvaliacoes($cod_pessoa, $cod_anuncio);
    
    if($detalhes[0]['ja_avaliou'] == 0){
         $linha .= '<div class="form-group">';
         $linha .= '<label>Sua avaliação</label>';
         $linha .= ' <select class="form-control" id="avaliacao" name="avaliacao">
                               <option value="">Escolha sua resposta</option>';
                               $linha .= '<option value="1">';
                                    $linha .= 'Aprovo';
                               $linha .= '</option>';
                               $linha .= '<option value="0">';
                                    $linha .= 'Reprovo';
                               $linha .= '</option>';

                                                                                   
       $linha .=  '</select>';
       $linha .= '</div>';
       $linha .= '<div class="form-group">';
            $linha .= '<label>Escreva o motivo da sua avaliação</label>';
            $linha .= '<input type="text" name="texto_aval" id="texto_aval" maxlenght="100" class="form-control">';
       $linha .= '</div>'; 
       $linha .= '<center><button class="btn btn-success" name="btnAvaliar" onclick="return ValidarAvaliacao()">Confirmar avaliação</button></center>'; 
       $linha .= '<hr>';
    }
    
    if(isset($detalhes) && count($detalhes) > 0){
        $linha .= '<div class="table-responsive">';
            $linha .= '<table class="table table-striped table-bordered table-hover">
                        <thead>
                             <tr>
                                 <th>TOTAL RECOMENDO <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></th>
                                 <th>TOTAL NÃO RECOMENDO <i class="fa fa-thumbs-o-down" aria-hidden="true"></i></th> 
                              </tr>
                         </thead>
                         <tbody>
                               <tr class = "odd gradeX">
                                      <td>' . $detalhes[0]['positivo'].'</td>
                                      <td>' . $detalhes[0]['negativo'].'</td>
                               </tr>                                                       
                         </tbody>
                     </table>
             </div>';
    } else {
        $linha .= RetornaMsg(-15);
    }
   
    echo $linha;
     
    
}

