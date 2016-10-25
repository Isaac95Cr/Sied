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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="plugins/select2/select2.min.css">
        <!-- tabla-->
        <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
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
        <div class="wrapper">
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
                                    <span class="label label-warning">10</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="header">You have 10 notifications</li>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="footer"><a href="#">View all</a></li>
                                </ul>
                            </li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu" ng-controller="controlLogin">
                                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <p>
                                            {{user.userName}}
                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">    
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right" >
                                            <a ng-click="logout()" class="btn btn-default btn-flat">Cerrar Sesion</a>
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
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <!--                    <div class="user-panel" style="height: 45px;">
                                            <div class="pull-left info">
                                                <p>Alexander Pierce</p>
                                            </div>
                                        </div>-->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="treeview">
                            <a href="">
                                <i class="fa fa-flag"></i> <span>Metas</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#/admin_metas"><i class="fa fa-flag-o"></i>Administrar Metas</a></li>
                                <li><a href="#/admin_colaboradores_metas"><i class="fa fa-users"></i>Colaboradores</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="">
                                <i class="fa fa-line-chart"></i> <span>Competencias</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#/admin_competencias"><i class="fa  fa-bar-chart-o"></i>Administrar Competencias</a></li>
                                <li><a href="#/admin_colaboradores_competencias"><i class="fa fa-users"></i>Colaboradores</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
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
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-clipboard"></i> <span>Reportes</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="index.php"><i class="fa fa-circle-o"></i></a></li>
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
                    <b>Version</b> beta
                </div>
                <strong></strong> All rights
                reserved.
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
        <script src="bootstrap/js/ui-bootstrap-tpls-2.1.4.min.js" type="text/javascript"></script>
        <script src="angular/app.js" type="text/javascript"></script>
        <script src="angular/ngStorage.min.js" type="text/javascript"></script>
        <!-- rutas -->
        <script src="angular/rutas.js" type="text/javascript"></script>
        <!-- icheck -->
        <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- DataTables -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- Select2 -->
        <script src = "plugins/select2/select2.full.min.js" ></script>
        <!-- controles -->
        <script src="angular/modal/modalService.js" type="text/javascript"></script>
        <script src="angular/usuario/autentificacionService.js" type="text/javascript"></script>
        <script src="angular/usuario/sessionService.js" type="text/javascript"></script>
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
        
    </body>
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
