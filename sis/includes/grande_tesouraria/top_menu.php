<?php
if (function_exists(myAutSis)) {
    myAutSis('4');
    $id = $_SESSION['autGlepa']['id'];
    $readUser = read('glepaweb_usuarios', "WHERE id = '$id'");
    if ($readUser) {
        foreach ($readUser as $user);
        $foto = $user['foto'];
        $nome = ucfirst(strtolower(current(explode(" ", $user['nome'])))).' '. ucfirst(strtolower(end(explode(" ", $user['nome']))));
    }
} else {
    header('Location: ../../index.php');
}
?>
<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        
        <!-- END TODO DROPDOWN -->
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-user">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img alt="" class="img-circle" src="<?php echo (($foto != '' && file_exists('../uploads/avatars/' . $foto)) ? BASE.'/uploads/avatars/' . $foto : 'assets/global/img/user.png'); ?>" />
                <span class="username username-hide-on-mobile"> <?php echo $nome ;?> </span>
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-default">
                <li>
                    <a href="publico/conta/minha_conta.php" class="ajaxify">
                        <i class="icon-wrench"></i> Configurações </a>
                </li>
                <li>
                    <a href="logoff.php" class="ajaxify">
                        <i class="icon-key"></i> Sair </a>
                </li>
            </ul>
        </li>
    </ul>
</div>