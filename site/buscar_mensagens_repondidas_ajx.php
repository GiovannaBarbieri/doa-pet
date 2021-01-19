<?php

require_once '../Controller/AnuncioController.php';
require_once '../Controller/UtilController.php';
require_once '_msg.php';
if ($_POST['cod_anuncio'] && isset($_POST['cod_interessado'])) {

    $cod_anuncio = $_POST['cod_anuncio'];
    $cod_interessado = $_POST['cod_interessado'];
    
    $ctrl = new AnuncioController();
    $linha = '';
    
    $detalhes = $ctrl->VerMensagensRespondidas($cod_anuncio, $cod_interessado);
    
    if(count($detalhes) == 0){
        echo RetornaMsg(-14);
    }else{
        
         $linha = '<table class="table table-striped table-bordered table-hover">
                 <thead>
                      <tr>
                          <th>Pergunta</th>
                          <th>Resposta</th> 
                       </tr>
                  </thead>';
                $linha .=  '<tbody>';
                  for ($i = 0; $i < count($detalhes); $i++) {
                        $linha .= '<tr class = "odd gradeX">';
                                       
                                       $linha .= '<td>' . $detalhes[$i]['texto_mensagem'].' <h6> -' .$detalhes[$i]['data_mensagem'] .' às '.$detalhes[$i]['hora_mensagem'] .'</h6></td>';
                                       $linha .= '<td>' . $detalhes[$i]['texto_resposta'].' <h6> -' .$detalhes[$i]['data_resposta'] .' às '.$detalhes[$i]['hora_resposta'] .'</h6></td>';
                                 
                        $linha .= '</tr>';
       
                    }                                      
                                                            
                     $linha .=  '</tbody>
                </table>';
   
    
    echo $linha;
        
        
        
        
    }
    
}

