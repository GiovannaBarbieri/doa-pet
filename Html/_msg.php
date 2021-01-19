<?php



function RetornaMsg($ret) {

$msg ="";

    if ($ret === 0) {

        $msg= '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Preencher campos obrigatórios</div>';

    } elseif ($ret == 1) {

        $msg=  '<div class="alert alert-success" id="success-alert">Dados gravados com sucesso!</div>';

    }elseif ($ret == 2) {

        $msg=  '<div class="alert alert-success">Foto excluida com sucesso!</div>';

    }elseif ($ret == 3) {

        $msg=  '<div class="alert alert-success" id="success-alert">Anúncio alterado com sucesso!</div>';

    }elseif ($ret == 4) {

        $msg=  '<div class="alert alert-success" id="success-alert">Anúncio respondido com sucesso !</div>';

    }elseif ($ret == 5) {

        $msg=  '<div class="alert alert-success" id="success-alert">Interesse confirmado com sucesso!</div>';

    }elseif ($ret == 6) {

        $msg=  '<div class="alert alert-success" id="success-alert">Mensagem enviada com sucesso!</div>';
    }elseif ($ret == 7) {

        $msg=  '<div class="alert alert-success" id="success-alert">Mensagem enviada com sucesso! Aguarde nosso contato.</div>';
    }elseif ($ret == 8) {
        $msg=  '<div class="alert alert-success" id="success-alert">Para redefinir a senha, entre no seu e-mail e clique no link para ser feita a Redefinição de e-mail! </div>';
    }elseif ($ret == -4) {

        $msg=  '<div class="alert alert-danger">Não foi possível gravar a foto</div>';

    }

    elseif ($ret == -1) {

        $msg=  '<div class="alert alert-warning">Preencher uma descrição maior</div>';

    } elseif ($ret == -2) {

        $msg=  '<div class="alert alert-warning">Por favor selecione uma foto do tipo .JPG</div>';

    } elseif ($ret == -3) {

        $msg=  '<div class="alert alert-warning">Preencher um título maior que 3 caracteres</div>';

    }elseif ($ret == -5) {

        $msg=  '<div class="alert alert-warning">Digite corretamente o e-mail</div>';

    }elseif ($ret == -6) {

        $msg=  '<div class="alert alert-warning">O e-mail já possui um cadastro no sistema</div>';

    }elseif ($ret == -7) {

        $msg=  '<div class="alert alert-warning">Este e-mail não existe no sistema</div>';

    }elseif ($ret == -8) {

        $msg=  '<div class="alert alert-warning">Sua senha está incorreta</div>';

    }elseif ($ret == -9) {

        $msg=  '<div class="alert alert-warning">É necessário escrever uma pergunta </div>';

    }elseif ($ret == -10) {
        $msg=  '<div class="alert alert-warning">O texto ultrapassou a quantidade de 500 caracteres!</div>';
    }
           
    elseif ($ret == -100) {

        $msg=  '<div class="alert alert-danger">Ocorreu um erro na operação, tente mais tarde</div>';

    }

    return $msg;

}

