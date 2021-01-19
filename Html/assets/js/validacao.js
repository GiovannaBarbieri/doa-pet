/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function valida(campo) {
    if ($(campo).val().trim() == "") {
        if (campo == "#nome_usuario") {
            var texto = "Nome de usuário";
        } 
        alert("Favor preencher o campo " + texto);
        return false;
    }
}