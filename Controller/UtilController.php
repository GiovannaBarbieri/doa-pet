<?php

class UtilController {
    
    public static function IniciarSession(){
        if(!isset($_SESSION) ){
            session_start();
            
        }
    }
    public static function GuardarInformacao($id){
        self::IniciarSession();
        $_SESSION['id'] = $id;
        
        
    }
    
    public static function RetornarCodigoLogado(){
        self::IniciarSession();
        return isset($_SESSION['id']) ? $_SESSION['id'] : null;
    }
    
    public static function Deslogar(){
        self::IniciarSession();
        unset($_SESSION['id']);
        //header('location: acesso.php');
        echo '<script>window.location = "http://doapet.com.br/site/acesso.php";</script>';
    }
    
    public static function VerificarLogado(){
        self::IniciarSession();
        if($_SESSION['id'] == null || $_SESSION['id'] == ''){
           // header('location: acesso.php');
           echo '<script>window.location = "http://doapet.com.br/site/acesso.php";</script>';
        }
    }

    public static function DevolverCriptografia($senha){
        return password_hash($senha, PASSWORD_DEFAULT);
    }
    
    public static function DevolverNomeFoto(){
        return md5(microtime()) . '.jpg';
    }
    
    public static function validarExtensao($foto){
        if($foto['type'] != 'image/jpeg'){
            return 0;
        }else{
            return 1;
        }
    }
    
    public static function DevolverCaminhoFoto($nome) {
        return 'Fotos/' . $nome;
    }
    
    public static function DevolverDataHoraAtual(){
    date_default_timezone_set('America/Sao_Paulo');
    return date('Y-m-d H:i:s');
    }
    
    public static function DevolverHoraAtual(){
    date_default_timezone_set('America/Sao_Paulo');
    return date('H:i:s');
    }
    public static function DevolverDataAtual(){
    date_default_timezone_set('America/Sao_Paulo');
    return date('Y-m-d');
    }

    
    public static function TirarCaracteresEspeciais($str) {
        $especiais = array('_', '(', ')', '-', 'R$', ' ', '.', '%', '#', '*', '!', '?', '/');
        $str = str_replace($especiais, '', $str);

        return $str;
    }
    public static function TratarString($str) {
        # Remove palavras suspeitas de injection.
        $str = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/i", "", $str);
        $str = trim($str);        # Remove espaços vazios.
        $str = strip_tags($str);  # Remove tags HTML e PHP.
        //$str = addslashes($str);  # Adiciona barras invertidas à uma string.

        return $str;
    }
    
    public static function ValidaEmailValido($email) {
        if($email != ""){
            $objDao = new PessoaDAO();
            $ret = $objDao->ProcuraEmail($email);
            
            if($ret <= 1){
                echo 'tem repetido';
                return false;
            }else {
                if (!preg_match('/^([a-zA-Z0-9.-])*([@])([a-z0-9]).([a-z]{2,3})/', $email)) {
                    return false;
                } else {
                    //Valida o dominio
                    $dominio = explode('@', $email);
                    if (!checkdnsrr($dominio[1], 'A')) {

                        return false;
                    } else {
                        return true;
                    } // Retorno true para indicar que o e-mail é valido
                }       
                
            }
        
        
        }else{
            echo 'email ta vizio';
            return false;
        }
    }
}
