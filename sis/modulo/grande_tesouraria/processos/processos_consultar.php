<?php
require_once ('../../../../config/dtsSis.php');
function_exists(myAutSis) ? myAutSis('4') : header('Location: ' . BASE . '/sis/403.php');
?>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="home.php" class="ajaxify">Início</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="modulo/grande_tesouraria/processos/processos_consultar.php" class="ajaxify">Consultar Processos</a>
        </li>
    </ul>
</div>
<h3 class="page-title"> Consultar Processos
</h3>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class="icon-wrench font-green"></i>
                    <span class="caption-subject bold uppercase"> Consultar Processos</span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tabela_consultar_processos">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Loja </th>
                            <th> Nome </th>
                            <th> Status </th>
                            <th>  </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="modulo/grande_tesouraria/processos/processos.js"></script>