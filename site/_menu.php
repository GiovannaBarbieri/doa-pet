<?php 



require_once  '../Controller/UtilController.php';



if(isset($_GET['action'])&& $_GET['action'] == '1'){

    UtilController::Deslogar();

} 



?>

<!-- /. NAV TOP  -->

<nav class="navbar-default navbar-side" role="navigation">

    <div class="sidebar-collapse">

        <ul class="nav" id="main-menu">

        <!--    <li class="text-center">

                <img src="assets/img/find_user.png" class="user-image img-responsive"/>

            </li> -->

            <li>

                <a  href="meus_dados.php"><i class="fa fa-user fa-1x"></i> Meus dados</a>

            </li>

            <li>

                <a  href="anunciar.php"><i class="fa fa-newspaper-o fa-1x"></i> Anunciar Doação</a>

            </li>

            <li>

                <a  href="meu_anuncio.php"><i class="fa fa-pencil-square fa-1x"></i> Meus Anúncios</a>

            </li> 

            <li>

                <a  href="ver_anuncios.php"><i class="fa fa-list fa-1x"></i> Ver Anúncios</a>

            </li> 

            <li>

                <a  href="favoritos.php"><i class="fa fa-star fa-1x"></i> Meus Interesses</a>

            </li>

            <li>

                <a  href="sugestao.php"><i class="fa fa-fax fa-1x"></i> Fale Conosco</a>

            </li>

            <li>

                <a  href="_menu.php?action=1"><i class="fa fa-power-off fa-1x"></i> Sair</a>

            </li> 

        </ul>



    </div>



</nav> 