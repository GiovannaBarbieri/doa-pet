<?php
require_once 'Conexao.class.php';

class PessoaDAO extends Conexao{
    /** @var PDO */
    private $conexao;
    
    /** @var PDOStatment */
    private $sql;
    
    public function criarConta($nome_pessoa, $email_pessoa, $senha_pessoa, $telefone_pessoa, $status_pessoa, $data_cadastro, $cod_cidade) {
        // 1 Passo: Resgatar a conexão
        $this->conexao = parent::getConexao();
        
        //2 passo: montar a instrução SQL
        $comando_sql = "INSERT INTO tb_pessoa "
        . "(nome_pessoa, email_pessoa, senha_pessoa, telefone_pessoa, status_pessoa, data_cadastro, cod_cidade)"
        . "VALUES (?,?,?,?,?,?,?)";
        
        // 3 passo: vincular a conexão com a instrução SQL
        $this->sql = $this->conexao->prepare($comando_sql);
        
        // 4 passo: Vincular os parametros com os links da instrução
        $this->sql->bindValue(1,$nome_pessoa);
        $this->sql->bindValue(2, $email_pessoa);
        $this->sql->bindValue(3, $senha_pessoa);
        $this->sql->bindValue(4, $telefone_pessoa);
        $this->sql->bindValue(5, $status_pessoa);
        $this->sql->bindValue(6, $data_cadastro);
        $this->sql->bindValue(7, $cod_cidade);
        
        // 5 passo: Executar
        $this->sql->execute();
        
        $recupera_id = $this->conexao->lastInsertId();
        
        return $recupera_id;
    }
    
    public function alterarConta($cod_pessoa, $nome_pessoa, $email_pessoa, $telefone_pessoa, $cod_cidade) {
        // 1 Passo: Resgatar a conexão
        $this->conexao = parent::getConexao();
        
        //2 passo: montar a instrução SQL
        $comando_sql = "UPDATE tb_pessoa "
        . " SET nome_pessoa = ?, email_pessoa = ?, telefone_pessoa = ?, cod_cidade = ? "
        . " WHERE cod_pessoa = ?";
        
        // 3 passo: vincular a conexão com a instrução SQL
        $this->sql = $this->conexao->prepare($comando_sql);
        
          // 4 passo: Vincular os parametros com os links da instrução
          $this->sql->bindValue(1, $nome_pessoa);
          $this->sql->bindValue(2, $email_pessoa);
          $this->sql->bindValue(3, $telefone_pessoa);
          $this->sql->bindValue(4, $cod_cidade);
          $this->sql->bindValue(5, $cod_pessoa);
          $this->sql->execute();
    }
    
    public function carregarDados($cod_pessoa) {
       
        $this->conexao = parent::getConexao();
        
        $comando_sql = "SELECT nome_pessoa, email_pessoa, telefone_pessoa, cod_cidade FROM tb_pessoa "
                . "WHERE cod_pessoa = ?";
        
        $this->sql = $this->conexao->prepare($comando_sql);
        
        $this->sql->bindValue(1, $cod_pessoa);
        // organiza o resultado para não trazer info duplicada
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $this->sql->execute();
        // retorna toda a consulta feita
        return $this->sql->fetchAll();
        
    }
    
    public function ValidarLogin($email) {
       
        $this->conexao = parent::getConexao();
        
        $comando_sql = "SELECT cod_pessoa, senha_pessoa FROM tb_pessoa "
                . " WHERE email_pessoa = ?";
        
        $this->sql = $this->conexao->prepare($comando_sql);
        
        $this->sql->bindValue(1, $email);
        // organiza o resultado para não trazer info duplicada
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $this->sql->execute();
        // retorna toda a consulta feita
        return $this->sql->fetchAll();
        
    }
    
        public function VerificarEmailDuplicado($email, $cod_pessoa) { 
       
        $this->conexao = parent::getConexao();
        
        $comando_sql = "SELECT email_pessoa FROM tb_pessoa WHERE email_pessoa = ?";
        
        if($cod_pessoa != ''){
            $comando_sql = $comando_sql . ' and cod_pessoa <> ?';
        }
                
        
        $this->sql = $this->conexao->prepare($comando_sql);
        
        $this->sql->bindValue(1, $email);
        if($cod_pessoa != ''){
            $this->sql->bindValue(2, $cod_pessoa);
        }
        
        // organiza o resultado para não trazer info duplicada
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        
        $this->sql->execute();
        // retorna toda a consulta feita
        $verificar = $this->sql->fetchAll();
     
        
        if(count($verificar) == 0 ){
            return false;
        }else{
            return true;
        }
        
    }
    public function SalvaSugestao($tipo, $texto, $cod) {
        $this->conexao = parent::getConexao();
        $comando_sql = 'INSERT INTO tb_sugestao(descricao, tipo_sugestao, cod_pessoa) Values (?,?,?)';
        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->bindValue(1, $texto);
        $this->sql->bindValue(2, $tipo);
        $this->sql->bindValue(3, $cod);
        
        $this->sql->execute();
    }
    public function ValidaEmail($email){
        $this->conexao = parent::getConexao();
        $comando_sql = 'SELECT senha_pessoa,nome_pessoa FROM tb_pessoa WHERE email_pessoa = ?';
        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->bindValue(1, $email);
        
        $this->sql->execute();
        return $this->sql->fetchAll();
    }
    public function ValidaHash($hash) {
        $this->conexao = parent::getConexao();
        $comando_sql = 'SELECT cod_pessoa,senha_pessoa,nome_pessoa,email_pessoa FROM tb_pessoa where senha_pessoa = ?';
        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->bindValue(1, $hash);
        
        $this->sql->execute();
        return $this->sql->fetchAll();
    }
    public function NovaSenha($hash,$cod){
        $this->conexao = parent::getConexao();
        $comando_sql = 'Update tb_pessoa SET senha_pessoa = ? where cod_pessoa = ?';
        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->bindValue(1, $hash);
        $this->sql->bindvalue(2, $cod);
        
        $this->sql->execute();
        return 1;
    }
    public function ProcuraEmail($email){
        $this->conexao = parent::getConexao();
        $comando_sql = 'SELECT COUNT(*) FROM tb_pessoa WHERE email_pessoa = ?';
        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->bindValue(1, $email);
        
        $this->sql->execute();
        return $this->sql->fetchAll();
    }
    
}
