<?php
require_once 'Conexao.class.php';
class PrecadastroDAO extends Conexao{
    /** @var PDO */
    private $conexao;
    
    /** @var PDOStatement */
    private $sql;
    
    public function ListarTipoAnimal(){
       
        $this->conexao = parent::getConexao();
        $this->sql = 'SELECT cod_tipo, nome_tipo FROM tb_tipo_animal';
        $this->sql = $this->conexao->prepare($this->sql); 
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        return $this->sql->fetchAll();
        
    }
    public function ListarPorteAnimal(){
       
        $this->conexao = parent::getConexao();
        $this->sql = 'SELECT cod_tipo, nome_tipo FROM tb_tipo_animal';
        $this->sql = $this->conexao->prepare($this->sql); 
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        return $this->sql->fetchAll();
        
    }
    
    public function FiltrarCidade($cod_estado){
       
        $this->conexao = parent::getConexao();
        $this->sql = 'SELECT cod_cidade, nome_cidade FROM tb_cidade WHERE cod_estado = ?';
        $this->sql = $this->conexao->prepare($this->sql);
        
        $this->sql->bindValue(1, $cod_estado);
        
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        return $this->sql->fetchAll();
        
    }
}
