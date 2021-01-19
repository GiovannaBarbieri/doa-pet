<?php

require_once 'Conexao.class.php';

class AnuncioDAO extends Conexao {

    /** @var PDO */
    private $conexao;

    /** @var PDOStatement */
    private $sql;

    public function PublicarAnuncio($tipo_porte, $titulo_anuncio, $descricao_animal, $caminho_foto, $data_anuncio, $situacao_anuncio, $cod_tipo, $cod_pessoa, $cod_cidade) {

        $this->conexao = parent::getConexao();



        $comando_sql = 'INSERT INTO tb_anuncio(tipo_porte, descricao_animal, caminho_foto, data_anuncio, situacao_anuncio, cod_tipo, cod_pessoa, titulo_anuncio, cod_cidade) '
                . 'VALUES (?,?,?,?,?,?,?,?,?)';



        $this->sql = $this->conexao->prepare($comando_sql);



        $this->sql->bindValue(1, $tipo_porte);

        $this->sql->bindValue(2, $descricao_animal);

        $this->sql->bindValue(3, $caminho_foto);

        $this->sql->bindValue(4, $data_anuncio);

        $this->sql->bindValue(5, $situacao_anuncio);

        $this->sql->bindValue(6, $cod_tipo);

        $this->sql->bindValue(7, $cod_pessoa);

        $this->sql->bindValue(8, $titulo_anuncio);

        $this->sql->bindValue(9, $cod_cidade);



        $this->sql->execute();
    }

    public function MeusAnuncios($cod_pessoa) {

        $this->conexao = parent::getConexao();



        $comando_sql = 'SELECT an.cod_anuncio,

			 an.titulo_anuncio,

			 an.descricao_animal,

			 an.caminho_foto,

                         an.situacao_anuncio,

                         DATE_FORMAT(an.data_anuncio, "%d/%m/%Y") as data_anuncio,

			 (SELECT COUNT(*) FROM tb_interessado AS inte WHERE inte.cod_anuncio = an.cod_anuncio) AS qtd_interessados

FROM tb_anuncio AS an

WHERE cod_pessoa = ? ORDER BY an.cod_anuncio DESC';



        $this->sql = $this->conexao->prepare($comando_sql);



        $this->sql->bindValue(1, $cod_pessoa);



        $this->sql->setFetchMode(PDO::FETCH_ASSOC);



        $this->sql->execute();



        return $this->sql->fetchAll();
    }

    public function CarregarDetalhes($cod_anuncio, $cod_logado) {

        $this->conexao = parent::getConexao();



        $comando_sql = 'SELECT pes.cod_pessoa, an.cod_anuncio, an.titulo_anuncio, an.descricao_animal,an.caminho_foto, pes.email_pessoa, pes.nome_pessoa, pes.telefone_pessoa, '
                . ' tp.nome_tipo, an.tipo_porte, cid.nome_cidade, est.sigla_estado, DATE_FORMAT(an.data_anuncio, "%d/%m/%Y") as data_anuncio '
                . ' FROM tb_anuncio an '
                . ' INNER JOIN tb_cidade cid ON cid.cod_cidade = an.cod_cidade '
                . ' INNER JOIN tb_estado est ON cid.cod_estado = est.cod_estado '
                . ' INNER JOIN tb_tipo_animal tp ON tp.cod_tipo = an.cod_tipo '
                . ' INNER JOIN tb_pessoa pes ON pes.cod_pessoa = an.cod_pessoa '
                . ' WHERE an.cod_anuncio = ? AND an.situacao_anuncio = 1 AND an.cod_pessoa <> ? ';



        $this->sql = $this->conexao->prepare($comando_sql);



        $this->sql->bindValue(1, $cod_anuncio);

        $this->sql->bindValue(2, $cod_logado);



        $this->sql->setFetchMode(PDO::FETCH_ASSOC);



        $this->sql->execute();



        return $this->sql->fetchAll();
    }

    public function CarregarMeuAnuncio($cod_anuncio) {

        $this->conexao = parent::getConexao();



        $comando_sql = 'SELECT cod_anuncio, titulo_anuncio, descricao_animal,caminho_foto, cod_tipo, tipo_porte, situacao_anuncio, cod_cidade FROM tb_anuncio WHERE cod_anuncio = ?';



        $this->sql = $this->conexao->prepare($comando_sql);



        $this->sql->bindValue(1, $cod_anuncio);



        $this->sql->setFetchMode(PDO::FETCH_ASSOC);



        $this->sql->execute();



        return $this->sql->fetchAll();
    }

    public function AlterarAnuncio($tipo_porte, $titulo_anuncio, $descricao_animal, $nome_foto, $cod_tipo, $situacao_anuncio, $cod_anuncio, $cod_cidade) {



        $this->conexao = parent::getConexao();



        $comando_sql = 'UPDATE tb_anuncio SET tipo_porte = ?, titulo_anuncio = ?, descricao_animal = ?, caminho_foto = ?, cod_tipo = ?, situacao_anuncio = ?, cod_cidade = ? WHERE cod_anuncio = ?';



        $this->sql = $this->conexao->prepare($comando_sql);



        $this->sql->bindValue(1, $tipo_porte);

        $this->sql->bindValue(2, $titulo_anuncio);

        $this->sql->bindValue(3, $descricao_animal);

        $this->sql->bindValue(4, $nome_foto);

        $this->sql->bindValue(5, $cod_tipo);

        $this->sql->bindValue(6, $situacao_anuncio);

        $this->sql->bindValue(7, $cod_cidade);

        $this->sql->bindValue(8, $cod_anuncio);



        $this->sql->execute();
    }

    public function ExcluirFotoAnuncio($cod_anuncio) {

        $this->conexao = parent::getConexao();

        $comando_sql = 'UPDATE tb_anuncio set caminho_foto = null WHERE cod_anuncio = ?';



        $this->sql = $this->conexao->prepare($comando_sql);



        $this->sql->bindValue(1, $cod_anuncio);



        $this->sql->execute();
    }

    public function VerInteressadosAnuncio($cod_anuncio, $cod_pessoa) {

        $this->conexao = parent::getConexao();



        $comando_sql = 'SELECT  
                                nome_pessoa, 

                                telefone_pessoa, 

                                email_pessoa, 

                                msg.texto_mensagem, 

                                msg.data_mensagem, 

                                msg.hora_mensagem,

                                msg.texto_resposta,

                                DATE_FORMAT(msg.data_resposta, "%d/%m/%Y") AS data_resposta,

                                msg.hora_resposta,

                                

                                inte.cod_interessado, 

                                msg.cod_mensagem,

                                inte.cod_anuncio,

                                an.caminho_foto,

                                an.titulo_anuncio,

                                DATE_FORMAT(an.data_anuncio, "%d/%m/%Y") AS data_anuncio,

                                an.descricao_animal,

                                cit.nome_cidade

                        FROM tb_interessado AS inte 

                        INNER JOIN tb_pessoa as pess

                        ON inte.cod_pessoa = pess.cod_pessoa

                        INNER JOIN tb_anuncio AS an

                        ON inte.cod_anuncio = an.cod_anuncio

                        LEFT JOIN tb_mensagem as msg

                        ON inte.cod_interessado = msg.cod_interessado

                        INNER JOIN tb_cidade cit

                        ON cit.cod_cidade = an.cod_cidade

                        where inte.cod_anuncio = ? and an.cod_pessoa = ?';



        $this->sql = $this->conexao->prepare($comando_sql);



        $this->sql->bindValue(1, $cod_anuncio);

        $this->sql->bindValue(2, $cod_pessoa);



        $this->sql->setFetchMode(PDO::FETCH_ASSOC);



        $this->sql->execute();



        return $this->sql->fetchAll();
    }

    public function ResponderPergunta($texto_mensagem, $data_mensagem, $hora_mensagem, $cod_mensagem) {

        $this->conexao = parent::getConexao();



        $comando_sql = 'UPDATE tb_mensagem SET texto_resposta = ?, data_resposta = ?, hora_resposta = ? '
                . ' WHERE cod_mensagem = ? ';



        $this->sql = $this->conexao->prepare($comando_sql);



        $this->sql->bindValue(1, $texto_mensagem);

        $this->sql->bindValue(2, $data_mensagem);

        $this->sql->bindValue(3, $hora_mensagem);

        $this->sql->bindValue(4, $cod_mensagem);



        $this->sql->execute();
    }

    public function CarregarAnuncios() {

        $this->conexao = parent::getConexao();



        $comando_sql = 'SELECT an.cod_anuncio,

			 an.titulo_anuncio,

			 an.descricao_animal,

			 an.caminho_foto,

                         an.tipo_porte,

                         DATE_FORMAT(an.data_anuncio, "%d/%m/%Y") AS data_anuncio,

			 (SELECT COUNT(*) FROM tb_interessado AS inte WHERE inte.cod_anuncio = an.cod_anuncio) AS qtd_interessados

FROM tb_anuncio AS an ';



        $this->sql = $this->conexao->prepare($comando_sql);



        $this->sql->setFetchMode(PDO::FETCH_ASSOC);



        $this->sql->execute();



        return $this->sql->fetchAll();
    }

    public function CarregarUltimosAnuncios($limite) {
        $this->conexao = parent::getConexao();

        //echo $limite;

        $comando_sql = 'SELECT an.cod_anuncio, an.cod_pessoa,

                            an.titulo_anuncio,

                            an.descricao_animal,

                            an.caminho_foto,

                            an.tipo_porte,

                            tp.nome_tipo,

                            cid.nome_cidade,

                            DATE_FORMAT(an.data_anuncio, "%d/%m/%Y") AS data_anuncio,

                           (SELECT COUNT(*) FROM tb_interessado AS inte WHERE inte.cod_anuncio = an.cod_anuncio) AS qtd_interessados

                        FROM tb_anuncio AS an INNER JOIN tb_tipo_animal AS tp ON an.cod_tipo  = tp.cod_tipo 

                        INNER JOIN tb_cidade AS cid ON an.cod_cidade = cid.cod_cidade

                    WHERE situacao_anuncio = 1 order by an.cod_anuncio DESC LIMIT ' . $limite;



        $this->sql = $this->conexao->prepare($comando_sql);

        // $this->sql->bindValue(1, $situacao);



        $this->sql->setFetchMode(PDO::FETCH_ASSOC);



        $this->sql->execute();



        return $this->sql->fetchAll();
    }

    public function CarregarAnunciosFiltro($tipo_animal, $tipo_porte, $cidade) {

        $this->conexao = parent::getConexao();



        $comando_sql = 'SELECT an.cod_anuncio, an.cod_pessoa,

                            an.titulo_anuncio,

                            an.descricao_animal,

                            an.caminho_foto,

                            an.tipo_porte,

                            tp.nome_tipo,

                            cid.nome_cidade,

                            DATE_FORMAT(an.data_anuncio, "%d/%m/%Y") AS data_anuncio,

                           (SELECT COUNT(*) FROM tb_interessado AS inte WHERE inte.cod_anuncio = an.cod_anuncio) AS qtd_interessados

                        FROM tb_anuncio AS an INNER JOIN tb_tipo_animal AS tp ON an.cod_tipo  = tp.cod_tipo 

                        INNER JOIN tb_cidade AS cid ON an.cod_cidade = cid.cod_cidade

                    WHERE situacao_anuncio = 1';



        if ($tipo_animal != '') {

            $comando_sql .= ' AND an.cod_tipo = ?';
        }

        if ($tipo_porte != '') {

            $comando_sql .= ' AND tipo_porte = ?';
        }

        if ($cidade != '') {

            $comando_sql .= ' AND an.cod_cidade = ?';
        }

        $comando_sql .= ' order by an.cod_anuncio DESC';





        $this->sql = $this->conexao->prepare($comando_sql);



        // TIPO ANIMAL SOZINHO

        if ($tipo_animal != '' && $tipo_porte == '' && $cidade == '') {

            $this->sql->bindValue(1, $tipo_animal);
        }

        // TIPO ANIMAL COM TIPO PORTE

        if ($tipo_animal != '' && $tipo_porte != '' && $cidade == '') {

            $this->sql->bindValue(1, $tipo_animal);

            $this->sql->bindValue(2, $tipo_porte);
        }

        // TIPO ANIMAL COM CIDADE

        if ($tipo_animal != '' && $tipo_porte == '' && $cidade != '') {

            $this->sql->bindValue(1, $tipo_animal);

            $this->sql->bindValue(2, $cidade);
        }

        //-------------------------------------------
        // TIPO PORTE SOZINHO

        if ($tipo_animal == '' && $tipo_porte != '' && $cidade == '') {

            $this->sql->bindValue(1, $tipo_porte);
        }

//    // TIPO PORTE COM TIPO ANIMAL
//    if($tipo_animal != ''&& $tipo_porte != '' && $cidade == ''){
//        $this->sql->bindValue(1, $tipo_animal);
//        $this->sql->bindValue(2, $tipo_porte);
//    }
        // TIPO PORTE COM CIDADE

        if ($tipo_animal == '' && $tipo_porte != '' && $cidade != '') {

            $this->sql->bindValue(1, $tipo_porte);

            $this->sql->bindValue(2, $cidade);
        }

        //-------------------------------------------
        // CIDADE SOZINHA

        if ($tipo_animal == '' && $tipo_porte == '' && $cidade != '') {

            $this->sql->bindValue(1, $cidade);
        }

//    // CIDADE COM TIPO ANIMAL
//    if($tipo_animal != ''&& $tipo_porte == '' && $cidade != ''){
//        $this->sql->bindValue(1, $tipo_animal);
//        $this->sql->bindValue(2, $cidade);
//    }
//    // CIDADE COM TIPO PORTE
//    if($tipo_animal == ''&& $tipo_porte != '' && $cidade != ''){
//        $this->sql->bindValue(1, $tipo_porte);
//        $this->sql->bindValue(2, $cidade);
//    }
        //-------------------------------------------
        // TODOS

        if ($tipo_animal != '' && $tipo_porte != '' && $cidade != '') {

            $this->sql->bindValue(1, $tipo_animal);

            $this->sql->bindValue(2, $tipo_porte);

            $this->sql->bindValue(3, $cidade);
        }



        $this->sql->setFetchMode(PDO::FETCH_ASSOC);



        $this->sql->execute();



        return $this->sql->fetchAll();
    }

    public function CarregarAnunciosFiltroApp($tipo_animal, $tipo_porte, $cidade, $cod_pessoa) {
        $this->conexao = parent::getConexao();

        $comando_sql = 'SELECT an.cod_anuncio, an.cod_pessoa,
                            an.titulo_anuncio,
                            an.descricao_animal,
                            an.caminho_foto,
                            an.tipo_porte,
                            tp.nome_tipo,
                            cid.nome_cidade,
                            DATE_FORMAT(an.data_anuncio, "%d/%m/%Y") AS data_anuncio,
                           (SELECT COUNT(*) FROM tb_interessado AS inte WHERE inte.cod_anuncio = an.cod_anuncio) AS qtd_interessados
                        FROM tb_anuncio AS an INNER JOIN tb_tipo_animal AS tp ON an.cod_tipo  = tp.cod_tipo 
                        INNER JOIN tb_cidade AS cid ON an.cod_cidade = cid.cod_cidade
                    WHERE situacao_anuncio = 1 ';

        if ($tipo_animal != '') {
            $comando_sql .= ' AND an.cod_tipo = ?';
        }
        if ($tipo_porte != '') {
            $comando_sql .= ' AND tipo_porte = ?';
        }
        if ($cidade != '') {
            $comando_sql .= ' AND an.cod_cidade = ?';
        }
        $comando_sql .= ' AND an.cod_pessoa <> ? order by an.cod_anuncio DESC';


        $this->sql = $this->conexao->prepare($comando_sql);

        // TIPO ANIMAL SOZINHO
        if ($tipo_animal != '' && $tipo_porte == '' && $cidade == '') {
            $this->sql->bindValue(1, $tipo_animal);
            $this->sql->bindValue(2, $cod_pessoa);
        }
        // TIPO ANIMAL COM TIPO PORTE
        if ($tipo_animal != '' && $tipo_porte != '' && $cidade == '') {
            $this->sql->bindValue(1, $tipo_animal);
            $this->sql->bindValue(2, $tipo_porte);
            $this->sql->bindValue(3, $cod_pessoa);
        }
        // TIPO ANIMAL COM CIDADE
        if ($tipo_animal != '' && $tipo_porte == '' && $cidade != '') {
            $this->sql->bindValue(1, $tipo_animal);
            $this->sql->bindValue(2, $cidade);
            $this->sql->bindValue(3, $cod_pessoa);
        }
        //-------------------------------------------
        // TIPO PORTE SOZINHO
        if ($tipo_animal == '' && $tipo_porte != '' && $cidade == '') {
            $this->sql->bindValue(1, $tipo_porte);
            $this->sql->bindValue(2, $cod_pessoa);
        }
//    // TIPO PORTE COM TIPO ANIMAL
//    if($tipo_animal != ''&& $tipo_porte != '' && $cidade == ''){
//        $this->sql->bindValue(1, $tipo_animal);
//        $this->sql->bindValue(2, $tipo_porte);
//    }
        // TIPO PORTE COM CIDADE
        if ($tipo_animal == '' && $tipo_porte != '' && $cidade != '') {
            $this->sql->bindValue(1, $tipo_porte);
            $this->sql->bindValue(2, $cidade);
            $this->sql->bindValue(3, $cod_pessoa);
        }
        //-------------------------------------------
        // CIDADE SOZINHA
        if ($tipo_animal == '' && $tipo_porte == '' && $cidade != '') {
            $this->sql->bindValue(1, $cidade);
            $this->sql->bindValue(2, $cod_pessoa);
        }
//    // CIDADE COM TIPO ANIMAL
//    if($tipo_animal != ''&& $tipo_porte == '' && $cidade != ''){
//        $this->sql->bindValue(1, $tipo_animal);
//        $this->sql->bindValue(2, $cidade);
//    }
//    // CIDADE COM TIPO PORTE
//    if($tipo_animal == ''&& $tipo_porte != '' && $cidade != ''){
//        $this->sql->bindValue(1, $tipo_porte);
//        $this->sql->bindValue(2, $cidade);
//    }
        //-------------------------------------------
        // TODOS
        if ($tipo_animal != '' && $tipo_porte != '' && $cidade != '') {
            $this->sql->bindValue(1, $tipo_animal);
            $this->sql->bindValue(2, $tipo_porte);
            $this->sql->bindValue(3, $cidade);
            $this->sql->bindValue(4, $cod_pessoa);
        }

        $this->sql->setFetchMode(PDO::FETCH_ASSOC);

        $this->sql->execute();

        return $this->sql->fetchAll();
    }

    public function ConfirmarInteresse($cod_logado, $cod_anuncio, $pergunta, $data, $hora, $cod_pessoa) {



        $this->conexao = parent::getConexao();



        $comando = 'INSERT INTO tb_interessado(data_interesse, cod_pessoa, cod_anuncio) VALUES (?,?,?)';



        $this->sql = $this->conexao->prepare($comando);



        $this->sql->bindValue(1, $data);

        $this->sql->bindValue(2, $cod_logado);

        $this->sql->bindValue(3, $cod_anuncio);



        if (trim($pergunta) == '') {

            try {

                $this->sql->execute();

                return 5;
            } catch (Exception $ex) {

                echo $ex->getMessage();

                return -1;
            }
        } else {

            $this->conexao->beginTransaction();



            try {

                $this->sql->execute();

                $cod_interessado = $this->conexao->lastInsertId();



                $comando = 'INSERT INTO tb_mensagem(texto_mensagem, data_mensagem, hora_mensagem, cod_interessado, cod_pessoa_anuncio,cod_anuncio)'
                        . ' VALUES(?,?,?,?,?,?)';

                $this->sql = $this->conexao->prepare($comando);



                $this->sql->bindValue(1, $pergunta);

                $this->sql->bindValue(2, $data);

                $this->sql->bindValue(3, $hora);

                $this->sql->bindValue(4, $cod_interessado);

                $this->sql->bindValue(5, $cod_pessoa);

                $this->sql->bindValue(6, $cod_anuncio);



                $this->sql->execute();

                $this->conexao->commit();

                return 5;
            } catch (Exception $ex) {

                echo $ex->getMessage();

                $this->conexao->rollBack();

                return -100;
            }
        }
    }

    Public function VerificaInteressado($cod_logado, $cod_anuncio) {

        $this->conexao = parent::getConexao();

        $comando = 'SELECT cod_interessado FROM tb_interessado WHERE cod_pessoa = ? and cod_anuncio = ?';

        $this->sql = $this->conexao->prepare($comando);



        $this->sql->bindValue(1, $cod_logado);

        $this->sql->bindValue(2, $cod_anuncio);



        $this->sql->execute();



        return $this->sql->fetchAll();
    }

    public function CarregarMensagensAnuncio($cod_anuncio) {

        $this->conexao = parent::getConexao();



        $comando = 'SELECT texto_mensagem, DATE_FORMAT(data_mensagem, "%d/%m/%Y")as data_mensagem, hora_mensagem, texto_resposta, DATE_FORMAT(data_resposta, "%d/%m/%Y") as data_resposta, hora_resposta, pess.nome_pessoa '
                . ' FROM tb_mensagem AS men '
                . ' INNER JOIN tb_interessado AS inte '
                . ' ON men.cod_interessado = inte.cod_interessado '
                . ' INNER JOIN tb_pessoa AS pess '
                . ' ON pess.cod_pessoa = inte.cod_pessoa '
                . ' WHERE men.cod_anuncio = ? ';



        $this->sql = $this->conexao->prepare($comando);



        $this->sql->bindValue(1, $cod_anuncio);



        $this->sql->setFetchMode(PDO::FETCH_ASSOC);



        $this->sql->execute();



        return $this->sql->fetchAll();
    }

    Public function NovaMensagem($data, $hora, $cod_anuncio, $cod_pessoa_anuncio, $cod_interessado, $pergunta) {



        $this->conexao = parent::getConexao();

        $comando = 'insert into tb_mensagem(texto_mensagem, data_mensagem, hora_mensagem, cod_interessado, cod_pessoa_anuncio,cod_anuncio)'
                . ' Values (?,?,?,?,?,?)';



        $this->sql = $this->conexao->prepare($comando);



        $this->sql->bindValue(1, $pergunta);

        $this->sql->bindvalue(2, $data);

        $this->sql->bindValue(3, $hora);

        $this->sql->bindvalue(4, $cod_interessado);

        $this->sql->bindValue(5, $cod_pessoa_anuncio);

        $this->sql->bindValue(6, $cod_anuncio);



        $this->sql->execute();
    }

    public function CarregarFavoritos($cod_pessoa) {

        $this->conexao = parent::getConexao();



        $comando_sql = 'SELECT an.cod_anuncio,

                         an.cod_pessoa,

			 an.titulo_anuncio,

			 an.descricao_animal,

			 an.caminho_foto,

                         an.tipo_porte,

                         cid.nome_cidade,

                         tp.nome_tipo,

                         DATE_FORMAT(an.data_anuncio, "%d/%m/%Y") AS data_anuncio,

			 (SELECT COUNT(*) FROM tb_interessado AS inte WHERE inte.cod_anuncio = an.cod_anuncio) AS qtd_interessados

        FROM tb_anuncio AS an INNER JOIN tb_tipo_animal tp on an.cod_tipo = tp.cod_tipo 

        inner join tb_interessado as inte on inte.cod_anuncio = an.cod_anuncio

        INNER JOIN tb_cidade cid on an.cod_cidade = cid.cod_cidade 

        WHERE situacao_anuncio = 1 and inte.cod_pessoa = ? order by an.cod_anuncio desc';



        $this->sql = $this->conexao->prepare($comando_sql);



        $this->sql->bindValue(1, $cod_pessoa);



        $this->sql->setFetchMode(PDO::FETCH_ASSOC);



        $this->sql->execute();



        return $this->sql->fetchAll();
    }

    public function CarregarUltimosAnunciosPortal() {
        $this->conexao = parent::getConexao();

        $comando_sql = ' SELECT an.cod_anuncio,
                                an.titulo_anuncio,
                                an.caminho_foto,
                                an.situacao_anuncio,
                                pes.cod_pessoa,
                                pes.nome_pessoa
                        FROM tb_anuncio AS an JOIN tb_pessoa pes ON an.cod_pessoa = pes.cod_pessoa WHERE an.situacao_anuncio = 1
                        ORDER BY an.cod_anuncio DESC LIMIT 4  ';

        $this->sql = $this->conexao->prepare($comando_sql);

        $this->sql->setFetchMode(PDO::FETCH_ASSOC);

        $this->sql->execute();

        return $this->sql->fetchAll();
    }

    public function ContarAnuncios() {
        $this->conexao = parent::getConexao();

        $comando_sql = 'SELECT count(cod_anuncio) AS qtd_anuncio FROM tb_anuncio';
        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        return $this->sql->fetchAll();
    }

    public function ContarPessoasCadastradas() {
        $this->conexao = parent::getConexao();

        $comando_sql = 'SELECT count(cod_pessoa) AS qtd_pessoa FROM tb_pessoa';

        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        return $this->sql->fetchAll();
    }

    public function ContarPessoasInteressadas() {
        $this->conexao = parent::getConexao();
        $comando_sql = 'SELECT count(cod_interessado) AS qtd_interessado FROM tb_interessado';
        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        return $this->sql->fetchAll();
    }

    public function ContarMensagens() {
        $this->conexao = parent::getConexao();
        $comando_sql = 'SELECT count(cod_mensagem) AS qtd_mensagem FROM tb_mensagem';
        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->setFetchMode(PDO::FETCH_ASSOC);
        $this->sql->execute();
        return $this->sql->fetchAll();
    }
    public function RetornaEmailInteressado($cod_interessado){
        $this->conexao = parent::getConexao();
        $comando_sql = 'select pes.email_pessoa,pes.nome_pessoa,an.titulo_anuncio from tb_interessado as inte
                        inner join tb_pessoa as pes on inte.cod_pessoa = pes.cod_pessoa
                        inner join tb_anuncio as an on an.cod_anuncio = inte.cod_anuncio
                        where cod_interessado = ?';
        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->bindValue(1, $cod_interessado);
        $this->sql->execute();
        return $this->sql->fetchAll();
    }
    public function PegaEmail($cod_anuncio){
        $this->conexao = parent::getConexao();
        $comando_sql = 'SELECT pes.nome_pessoa,pes.email_pessoa,an.titulo_anuncio FROM tb_anuncio AS an'
                    . ' inner join tb_pessoa AS pes on an.cod_pessoa = pes.cod_pessoa'
                    . ' where an.cod_anuncio = ?';
        $this->sql = $this->conexao->prepare($comando_sql);
        $this->sql->bindValue(1, $cod_anuncio);
        
        $this->sql->execute();
        return $this->sql->fetchAll();
    }

}
