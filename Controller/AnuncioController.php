<?php

require_once '/home/wmbar465/public_html/doapet.com.br/Controller/UtilController.php';

require_once '/home/wmbar465/public_html/doapet.com.br/DAO/AnuncioDAO.php';

class AnuncioController {

    public function PublicarAnuncio($tipo_porte, $descricao_animal, $caminho_foto, $cod_tipo, $titulo_anuncio, $cod_cidade) {



        $descricao_animal = UtilController::TratarString($descricao_animal);

        $titulo_anuncio = UtilController::TratarString($titulo_anuncio);





        if ($tipo_porte == '' || trim($descricao_animal) == '' || trim($caminho_foto['tmp_name']) == '' || $cod_tipo == '' || trim($titulo_anuncio) == '' || trim($cod_cidade) == '') {

            return 0;
        }

        if (trim(strlen($titulo_anuncio)) < 3) {

            return -3;
        }

        if (trim(strlen($descricao_animal)) < 10) {

            return -1;
        }

        if (UtilController::validarExtensao($caminho_foto) == 0) {

            return -2;
        }

        $data_anuncio = UtilController::DevolverDataHoraAtual();

        $situacao_anuncio = 1;

        $cod_pessoa = UtilController::RetornarCodigoLogado();

        $nome_foto = UtilController::DevolverNomeFoto();



        try {

            $objdao = new AnuncioDAO();

            $objdao->PublicarAnuncio($tipo_porte, $titulo_anuncio, $descricao_animal, $nome_foto, $data_anuncio, $situacao_anuncio, $cod_tipo, $cod_pessoa, $cod_cidade);



            // Copiar a foto para seu destino final

            $caminho_final = UtilController::DevolverCaminhoFoto($nome_foto);

            // Verifica se a foto foi copiada

            if (move_uploaded_file($caminho_foto['tmp_name'], $caminho_final)) {

                return 1;
            } else {

                return -3;
            }
        } catch (Exception $ex) {

            echo $ex->getMessage();

            return -100;
        }
    }

    public function AlterarAnuncio($cod_tipo, $tipo_porte, $titulo_anuncio, $descricao_anuncio, $situacao_anuncio, $foto, $nome_foto, $cod_anuncio, $cod_cidade) {



        $descricao_anuncio = UtilController::TratarString($descricao_anuncio);

        $titulo_anuncio = UtilController::TratarString($titulo_anuncio);





        if ($tipo_porte == '' || trim($descricao_anuncio) == '' || $cod_tipo == '' || trim($titulo_anuncio) == '' || trim($cod_cidade) == '') {

            return 0;
        }

        if (trim(strlen($titulo_anuncio)) < 3) {

            return -3;
        }

        if (trim(strlen($descricao_anuncio)) < 10) {

            return -1;
        }

        if ($foto != null && UtilController::validarExtensao($foto) == 0) {

            return -2;
        }

        if ($nome_foto == '') {

            $nome_foto = UtilController::DevolverNomeFoto();
        }



        $objdao = new AnuncioDAO();

        try {

            // $situacao_anuncio = ($situacao_anuncio == null ? 1 : 2);

            $objdao->AlterarAnuncio($tipo_porte, $titulo_anuncio, $descricao_anuncio, $nome_foto, $cod_tipo, $situacao_anuncio, $cod_anuncio, $cod_cidade);

            if ($foto != null) {

                if (move_uploaded_file($foto['tmp_name'], UtilController::DevolverCaminhoFoto($nome_foto))) {

                    return 3;
                } else {

                    return -4;
                }
            }

            return 3;
        } catch (Exception $ex) {

            echo $ex->getMessage();

            return -100;
        }
    }

    public function MeusAnuncios() {



        $objdao = new AnuncioDAO();

        $cod_pessoa = UtilController::RetornarCodigoLogado();

        return $objdao->MeusAnuncios($cod_pessoa);
    }

    public function CarregarMeuAnuncio($cod_anuncio) {



        $objdao = new AnuncioDAO();

        return $objdao->CarregarMeuAnuncio($cod_anuncio);
    }

    public function ExcluirFotoAnuncio($cod_anuncio, $nome_foto) {



        $objdao = new AnuncioDAO();



        try {

            $objdao->ExcluirFotoAnuncio($cod_anuncio);

            unlink(UtilController::DevolverCaminhoFoto($nome_foto));

            return 2;
        } catch (Exception $ex) {

            return -100;
        }
    }

    public function VerInteressadoAnuncio($cod_anuncio) {

        $objdao = new AnuncioDAO();

        return $objdao->VerInteressadosAnuncio($cod_anuncio, UtilController::RetornarCodigoLogado());
    }

    public function ResponderPergunta($texto_mensagem, $cod_mensagem) {



        if (trim($texto_mensagem == '')) {

            return 0;
        }



        $data_mensagem = UtilController::DevolverDataAtual();

        $hora_mensagem = UtilController::DevolverHoraAtual();



        try {

            $objdao = new AnuncioDAO();

            $objdao->ResponderPergunta($texto_mensagem, $data_mensagem, $hora_mensagem, $cod_mensagem);

            return 4;
        } catch (Exception $ex) {

            echo $ex->getMessage();

            return -100;
        }
    }

    public function CarregarAnuncios($cod_anuncio) {

        $objdao = new AnuncioDAO();

        return $objdao->CarregarMensagensAnuncio($cod_anuncio);
    }

    public function CarregarUltimosAnuncios() {

        $objdao = new AnuncioDAO();

        return $objdao->CarregarUltimosAnuncios(10);
    }

    //////JOVEM/////

    public function CarregarUltimosAnunciosPortal() {

        $objdao = new AnuncioDAO();

        return $objdao->CarregarUltimosAnunciosPortal();
    }

    public function ConsultarAnunciosFiltro($tipo_animal, $tipo_porte, $cidade) {





        $objdao = new AnuncioDAO();

        // $cod_pessoa = UtilController::RetornarCodigoLogado();



        return $objdao->CarregarAnunciosFiltro($tipo_animal, $tipo_porte, $cidade);
    }

    public function CarregarAnunciosFiltroApp($tipo_animal, $tipo_porte, $cidade, $cod_pessoa) {
        $objdao = new AnuncioDAO();
        return $objdao->CarregarAnunciosFiltroApp($tipo_animal, $tipo_porte, $cidade, $cod_pessoa);
    }

    public function CarregarDetalhes($cod_anuncio) {

        $objdao = new AnuncioDAO();



        return $objdao->CarregarDetalhes($cod_anuncio, UtilController::RetornarCodigoLogado());
    }

    public function ConfirmarInteresse($cod_anuncio, $pergunta, $cod_pessoa) {

        $cod_logado = UtilController::RetornarCodigoLogado();

        $data = UtilController::DevolverDataAtual();

        $hora = UtilController::DevolverDataHoraAtual();



        $objdao = new AnuncioDAO();



        return $objdao->ConfirmarInteresse($cod_logado, $cod_anuncio, $pergunta, $data, $hora, $cod_pessoa);
    }

    Public function VerificaInteressado($cod_anuncio,$cod_logado) {
        if($cod_logado == ''){
            $cod_logado = UtilController::RetornarCodigoLogado();
        }
        $objDAO = new AnuncioDAO;

        return $objDAO->VerificaInteressado($cod_logado, $cod_anuncio);
    }

    public function CarregarMensagensAnuncio($cod_anuncio) {

        $objDAO = new AnuncioDAO;

        return $objDAO->CarregarMensagensAnuncio($cod_anuncio);
    }

    Public function NovaMensagem($cod_anuncio, $pergunta, $cod_interessado, $cod_pessoa_anuncio) {

        if (trim($pergunta) == '') {

            return -9;
        }

        $data = UtilController::DevolverDataAtual();

        $hora = UtilController::DevolverHoraAtual();



        $objdao = new AnuncioDAO();



        try {

            $objdao->NovaMensagem($data, $hora, $cod_anuncio, $cod_pessoa_anuncio, $cod_interessado, $pergunta);

            return 6;
        } catch (Exception $ex) {

            echo $ex->getMessage();

            return -100;
        }
    }

    public function CarregarFavoritos() {

        $cod_pessoa = UtilController::RetornarCodigoLogado();

        $objDAO = new AnuncioDAO();



        return $objDAO->CarregarFavoritos($cod_pessoa);
    }

    public function ContarAnuncios() {
        $objdao = new AnuncioDAO();
        return $objdao->ContarAnuncios();
    }

    public function ContarPessoasCadastradas() {
        $objdao = new AnuncioDAO();
        return $objdao->ContarPessoasCadastradas();
    }

    public function ContarPessoasInteressadas() {
        $objDAO = new AnuncioDAO();
        return $objDAO->ContarPessoasInteressadas();
    }

    public function ContarMensagens() {
        $objDAO = new AnuncioDAO();
        return $objDAO->ContarMensagens();
    }
    public function RetornaEmailInteressado($cod_interessado){
        $objDAO = new AnuncioDAO();
        return $objDAO->RetornaEmailInteressado($cod_interessado);
    }
    public function PegaEmail($cod_anuncio){
        $objdao = new AnuncioDAO();
        return $objdao->PegaEmail($cod_anuncio);
    }

}
