<?php

// Configurações do site
define('HOST', 'localhost'); //IP
define('USER', 'wmbar465_petuser'); //usuario
define('PASS', 'CarrochoLouco1702'); //Senha
define('DB', 'wmbar465_petbd'); //Banco
/**
 * Conexao.class TIPO [Conexão]
 * Descricao: Estabelece conexões com o banco usando SingleTon
 * @copyright (c) year, Wladimir M. Barros
 */

class Conexao {

    /** @var PDOStatement */
    public static $Connect;

    private static function Conectar() {
        try {

            //Verifica se a conexão não existe
            if (self::$Connect == null):

                $dsn = 'mysql:host=' . HOST . ';dbname=' . DB .';charset=utf8';
                self::$Connect = new PDO($dsn, USER, PASS, null);
            endif;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
       
        //Seta os atributos para que seja retornado as excessões do banco
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       
        return self::$Connect;
    }

    public function getConexao() {
        return self::Conectar();
    }
}