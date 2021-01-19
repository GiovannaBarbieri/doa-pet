<?php

require_once '/home/wmbar465/public_html/doapet.com.br/DAO/PessoaDAO.php';
//require_once '/home/wmbar465/public_html/doapet.com.br/Class/class.phpmailer.php';
require_once '/home/wmbar465/public_html/doapet.com.br/Controller/UtilController.php';

class PessoaController {

    public function criarConta($nome_pessoa, $email_pessoa, $senha_pessoa, $repetir_senha, $telefone_pessoa, $cod_cidade, $termos, $tipo_acesso) {



        $nome_pessoa = UtilController::TratarString($nome_pessoa);

        //$email_pessoa = UtilController::TratarString($email_pessoa);

        //$senha_pessoa = UtilController::TratarString($senha_pessoa);

        //$repetir_senha = UtilController::TratarString($repetir_senha);

        $telefone_pessoa = UtilController::TirarCaracteresEspeciais($telefone_pessoa);



        if (trim($nome_pessoa) == "" || trim($email_pessoa) == "" || trim($senha_pessoa) == "" || trim($repetir_senha) == "" || trim($telefone_pessoa) == "" || trim($cod_cidade) == "" || trim($termos) == "") {

            return 0;
        }

        if (trim(strlen($nome_pessoa)) < 8) {

            return -1;
        }

        if (trim(strlen($senha_pessoa)) < 6) {

            return -2;
        }

        if (trim($senha_pessoa) != trim($repetir_senha)) {

            return -3;
        }

//        if (!UtilController::ValidaEmailValido($email_pessoa)) {
//
//            return -5;
//        }
        try {

            $objdao = new PessoaDAO();
            if ($objdao->VerificarEmailDuplicado($email_pessoa, '')) {

                return -6;
            }

            $status_pessoa = 1;

            $data_cadastro = UtilController::DevolverDataHoraAtual();

            $senha_pessoa = UtilController::DevolverCriptografia($senha_pessoa);

            $id = $objdao->criarConta($nome_pessoa, $email_pessoa, $senha_pessoa, $telefone_pessoa, $status_pessoa, $data_cadastro, $cod_cidade);

            //Acesso é pelo SITE
            if ($tipo_acesso == 1) {
                UtilController::GuardarInformacao($id);
                echo '<script>window.location = "http://doapet.com.br/site/ver_anuncios.php"; </script>';
            } else { //Senão Aplicativo
                return $id;
            }
        } catch (Exception $ex) {

            echo $ex->getMessage();

            return -100;
        }
    }

    public function AlterarConta($nome_pessoa, $email_pessoa, $telefone_pessoa, $cod_cidade) {



        $nome_pessoa = UtilController::TratarString($nome_pessoa);

        $email_pessoa = UtilController::TratarString($email_pessoa);

        $telefone_pessoa = UtilController::TirarCaracteresEspeciais($telefone_pessoa);



        if (trim($nome_pessoa) == '' || trim($email_pessoa) == '' || trim($telefone_pessoa) == '' || trim($cod_cidade) == '') {

            return 0;
        }
        if(!UtilController::ValidaEmailValido($email_pessoa)){
            return -5;
        }

        try {
             $objdao = new PessoaDAO();
             
            if ($objdao->VerificarEmailDuplicado($email_pessoa, UtilController::RetornarCodigoLogado())) {

                return -6;
            }
 
            $cod_pessoa = UtilController::RetornarCodigoLogado();
            
          
            $objdao->alterarConta($cod_pessoa, $nome_pessoa, $email_pessoa, $telefone_pessoa, $cod_cidade);

            return 1;
        } catch (Exception $ex) {

            echo $ex->getMessage();

            return -100;
        }
    }

    public function CarregarDados() {

        $objController = new PessoaDAO();

        $cod_pessoa = UtilController::RetornarCodigoLogado();

        return $objController->carregarDados($cod_pessoa);
    }

    public function ValidarLogin($email, $senha) {



        if (trim($email) == '' || trim($senha) == '') {

            return 0;
        }

        $dao = new PessoaDAO();



        $usuario = $dao->ValidarLogin($email);



        if (count($usuario) == 0) {

            return -7;
        } else {

            // Criptografa a senha digitada para ser comparada com a criptografia do banco
            //$senha = password_hash($senha, PASSWORD_DEFAULT);



            if (password_verify(trim($senha), $usuario[0]['senha_pessoa'])) {



                UtilController::GuardarInformacao($usuario[0]['cod_pessoa']);

                //header('location: ver_anuncios.php');
                echo '<script>window.location = "http://doapet.com.br/site/ver_anuncios.php";</script>';
            } else {

                return -8;
            }
        }
    }

    public function SalvaSugestao($tipo, $texto) {
        if ($tipo == '' || trim($texto) == '') {
            return 0;
        }
        if (trim(strlen($texto)) > 500) {
            return -10;
        }
        try {
            $objDao = new PessoaDAO();
            $cod = UtilController::RetornarCodigoLogado();
            $objDao->SalvaSugestao($tipo, $texto, $cod);

            return 7;
        } catch (Exception $ex) {
            return -100;
        }
    }

    public function ValidaEmail($email) {
        if (trim($email) == '') {
            return 0;
        }try {
            $objDao = new PessoaDAO();
            return $objDao->ValidaEmail($email);
        } catch (Exception $ex) {
            return -100;
        }
    }

    public function ValidaHash($hash) {
        if ($hash == '') {
            return 0;
        }
        try {
            $objDao = new PessoaDAO();
            $ret = $objDao->ValidaHash($hash);
            return $ret;

            if (count($ret) == 0) {
                header('location: index.php');
            }
        } catch (Exception $ex) {
            return -100;
            
        }
    }
    public function NovaSenha($senha,$rsenha,$cod){
        if($cod == ""){
            return 0;
        }
        if (trim(strlen($senha)) < 6) {

            return -12;
        }

        if (trim($senha) != trim($rsenha)) {

            return -11;
        }
        $hash = UtilController::DevolverCriptografia($senha);
        try{
            $objDao = new PessoaDAO();
            $ret = $objDao->NovaSenha($hash, $cod);
            return 10; 
        } catch (Exception $ex) {
            return -100;
        }
    }
    


}
