<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SIED | Index </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- data Range -->
        <link href="plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
        <!-- Select2 -->
        <link href="plugins/select/select.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <!-- wizard -->
        <link href="plugins/wizard/angular-wizard.min.css" rel="stylesheet" type="text/css"/>
        <!-- tabla-->
        <link href="plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/angular-datatables.min.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/datatables/datatables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- iCheck --> 
        <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/iCheck/flat/green.css" rel="stylesheet" type="text/css"/>
        <link href="plugins/iCheck/flat/red.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    </head>

    <body class="hold-transition skin-blue fixed sidebar-mini" ng-app="app">
        <!-- Site wrapper -->
        <div class="wrapper" ng-controller="controlUser" ng-init="init()">
            <!-- header -->
            <header class="main-header">
                <!-- Logo -->
                <a href="#/index.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>SIED</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>SIED</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->

                    <a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">            
                            <!-- Notifications: style can be found in dropdown.less -->
                            <li class="dropdown notifications-menu">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span ng-show="filtered.length != 0" class="label label-danger">{{filtered.length}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">Tienes {{filtered.length}} notificaciones nuevas</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li ng-repeat="notificacion in notificaciones| orderBy: 'visto' | filter: visto as filtered"  sglclick="notificacionVista({{notificacion}})" dblclick="">
                                                <a href ="{{notificacion.url}}">
                                                    <i class="fa fa-plus-circle text-red"></i> 
                                                    {{notificacion.titulo}}
                                                </a>
                                            </li>
                                            <li ng-repeat="notificacion in notificaciones| filter: vistoN ">
                                                <a href ="{{notificacion.url}}">
                                                    <i class="fa fa-plus-circle text-blue"></i> 
                                                    {{notificacion.titulo}}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#/notificaciones">Ver todas</a></li>
                                </ul>
                            </li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu" >
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <p>
                                            {{usuario.nombre}}
                                            <small></small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">    
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#/perfil" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right" >
                                            <a ng-click="logout()" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- /.header -->

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar" >
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel" style="height: 45px;">
                        <div class="pull-left info">
                            <p>{{usuario.nombre}}</p>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="treeview" ng-if="usuario.perfil.colaborador == 1 || usuario.perfil.jefe == 1" ng-hide="!hayPeriodo">
                            <a href="">
                                <i class="fa fa-flag"></i> <span>Metas</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li ng-if="usuario.perfil.colaborador == 1" ng-hide="!hayPeriodo"><a href="#/admin_metas"><i class="fa fa-flag-o"></i>Administrar Metas</a></li>
                                <li ng-if="usuario.perfil.RH == 1" ng-hide="!hayPeriodo"><a href="#/admin_colab_metas_RH"><i class="fa fa-flag-o"></i>Administrar Metas RH</a></li>
                                <li ng-if="usuario.perfil.jefe == 1" ng-hide="!hayPeriodo"><a href="#/admin_colaboradores_metas"><i class="fa fa-users"></i>Colaboradores</a></li>
                            </ul>
                        </li>
                        <li class="treeview"  ng-if="usuario.perfil.colaborador == 1 || usuario.perfil.jefe == 1" ng-hide="!hayPeriodo">
                            <a href="">
                                <i class="fa fa-line-chart"></i> <span>Competencias</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li ng-if="usuario.perfil.colaborador == 1" ng-hide="!hayPeriodo"><a href="#/admin_competencias"><i class="fa  fa-bar-chart-o"></i>Administrar Competencias</a></li>
                                <li ng-if="usuario.perfil.jefe == 1" ng-hide="!hayPeriodo"><a href="#/admin_colaboradores_competencias"><i class="fa fa-users"></i>Colaboradores</a></li>
                            </ul>
                        </li>
                        <li class="treeview" ng-if="usuario.perfil.RH == 1">
                            <a href="">
                                <i class="fa fa-gears"></i> <span>Administración</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#/admin_usuarios"><i class="fa fa-users"></i>Administrar Usuarios</a></li>
                                <li><a href="#/admin_empresa"><i class="fa fa-building-o"></i>Empresas y Departamentos</a></li>
                                <li><a href="#/admin_perfil-competencia"><i class="fa fa-bar-chart-o"></i>Competencias</a></li>
                                <li><a href="#/admin_periodo"><i class="fa fa-calendar-plus-o"></i>Periodos</a></li>
                            </ul>
                        </li>
                        <li class="treeview" ng-if="usuario.perfil.RH == 1">
                            <a href="">
                                <i class="fa fa-clipboard"></i> <span>Reportes</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#/reporteIndividual"><i class="fa fa-circle-o"></i>Reporte Individual</a></li>
                                <li><a href="#/reporteDepatamento"><i class="fa fa-circle-o"></i>Reporte por Departamento</a></li>
                                <!--<li><a href="#/reporteIndividual"><i class="fa fa-circle-o"></i>Reporte por Evaluador</a></li> -->
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" ng-view="">



            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <!--  <b>Version</b> beta-->
                    <?php echo 'Derechos reservados.  ' . date("Y") . '.'; ?>
                </div>
                <strong></strong> Sistema Evaluación del Desempeño.
            </footer>

        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.2.3 -->
        <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <!-- SlimScroll -->
        <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- angular -->
        <script src="angular/angular.min.js" type="text/javascript"></script>
        <script src="angular/angular-route.min.js" type="text/javascript"></script>
        <script src="angular/angular-sanitize.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/ui-bootstrap-tpls-2.1.4.min.js" type="text/javascript"></script>
        <script src="angular/app.js" type="text/javascript"></script>
        <script src="angular/ngStorage.min.js" type="text/javascript"></script>
        <script src="angular/ng-caps-lock.min.js" type="text/javascript"></script>
        <!-- rutas -->
        <script src="angular/rutas.js" type="text/javascript"></script>
        <!-- icheck -->
        <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- DataTables -->
        <script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="plugins/datatables/angular-datatables.min.js" type="text/javascript"></script>
        <script src="plugins/datatables/angular-datatables.bootstrap.min.js" type="text/javascript"></script>
        <!-- Select2 -->
        <script src="plugins/select/select.min.js" type="text/javascript"></script>
        <script src="plugins/select2/select2.min.js" type="text/javascript"></script>
        <!-- CryptoJS -->
<!--        <script type="text/javascript" src="http://cryptojs.altervista.org/api/functions_cryptography.js"></script>-->
        <script src="plugins/cryptojs/aes.js" type="text/javascript"></script>
        <script src="plugins/cryptojs/mdo-angular-cryptography.js" type="text/javascript"></script>
        <!-- Data RAnge-->
        <script src="plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
        <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="plugins/daterangepicker/angular-daterangepicker.js" type="text/javascript"></script>
        <!-- wizard -->
        <script src="plugins/wizard/angular-wizard.min.js" type="text/javascript"></script>
        <!-- controles -->
        <script src="angular/apiconnector.js" type="text/javascript"></script>
        <script src="angular/modal/modalService.js" type="text/javascript"></script>
        <script src="angular/usuario/autentificacionService.js" type="text/javascript"></script>
        <script src="angular/usuario/sessionService.js" type="text/javascript"></script>
        <script src="angular/usuario/userService.js" type="text/javascript"></script>
        <script src="angular/usuario/usersColaboradoresMetas.js" type="text/javascript"></script>
        <script src="angular/usuario/usersColaboradoresCompetencias.js" type="text/javascript"></script>

        <script src="angular/registro/controlLogin.js" type="text/javascript"></script>
        <script src="angular/index/controlDepartamento.js" type="text/javascript"></script>
        <script src="angular/index/controlEmpresa.js" type="text/javascript"></script>
        <script src="angular/index/controlPerfilComptencia.js" type="text/javascript"></script>
        <script src="angular/index/controlMeta.js" type="text/javascript"></script>
        <script src="angular/index/controlEditPerfil.js" type="text/javascript"></script>
        <script src="angular/index/controlPesos.js" type="text/javascript"></script>
        <script src="angular/index/controlAutoEvMetas.js" type="text/javascript"></script> 
        <script src="angular/index/cntrlCompetenciasColaborador.js" type="text/javascript"></script>
        <script src="angular/index/controlAutoEvCompetencias.js" type="text/javascript"></script>
        <script src="angular/index/controlEvaluarMetas.js" type="text/javascript"></script>
        <script src="angular/index/controlAprobarMetas.js" type="text/javascript"></script>
        <script src="angular/index/controlDetalleMetasJefe.js" type="text/javascript"></script>
        <script src="angular/index/controlUsuario.js" type="text/javascript"></script>
        <script src="angular/index/controlDetalleCompetJefe.js" type="text/javascript"></script>
        <script src="angular/index/controlEvaluarCompet.js" type="text/javascript"></script>
        <script src="angular/empresas/EmpresaService.js" type="text/javascript"></script>
        <script src="angular/index/controlPerfil.js" type="text/javascript"></script>
        <script src="angular/usuario/controlUser.js" type="text/javascript"></script>
        <script src="angular/index/controlPeriodo.js" type="text/javascript"></script>
        <script src="angular/index/controlPesosMetas.js" type="text/javascript"></script>
        <script src="angular/index/controlMetaColabRH.js" type="text/javascript"></script>
        <script src="angular/index/controlDetalleMetasRH.js" type="text/javascript"></script>
        <script src="angular/index/controlAprobarMetasRH.js" type="text/javascript"></script>
        <script src="angular/index/controlCambiarPassword.js" type="text/javascript"></script>

        <script type="text/ng-template" id="myModalContent.html">
            <div class="modal-header">
            <button type="button" class="close" ng-click="$close()" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title">{{ vm.titulo }} </h3>
            </div>
            <form name="form" class="form-horizontal" novalidate>
            <div class="modal-body">
            <div compile-data template="{{vm.contenido}}">

            </div>
            </div>
            <div class="modal-footer">
            <div compile-data template="{{vm.footer}}">

            </div>
            </div>
            </form>

        </script> 

</html>
