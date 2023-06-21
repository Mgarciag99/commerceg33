<?php
    function head( $level = '' ){
    
        $output = '';
        $output.= '<head>';
        $output.= '    <meta charset="utf-8">';
        $output.= '    <meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $output.= '    <meta name="viewport" content="width=device-width, initial-scale=1">';
        $output.= '    <meta name="description" content="">';
        $output.= '    <meta name="author" content="">';
        $output.= '    <title>Startmin - Bootstrap Admin Theme</title>';
        $output.= '    <!-- Bootstrap Core CSS -->';
        $output.= '    <link href="' . $level . 'ASSETS.V_01/css/bootstrap.min.css" rel="stylesheet">';
        $output.= '    <!-- MetisMenu CSS -->';
        $output.= '    <link href="' . $level . 'ASSETS.V_01/css/metisMenu.min.css" rel="stylesheet">';
        $output.= '    <!-- Timeline CSS -->';
        $output.= '    <link href="' . $level . 'ASSETS.V_01/css/timeline.css" rel="stylesheet">';
        $output.= '    <!-- Custom CSS -->';
        $output.= '    <link href="' . $level . 'ASSETS.V_01/css/startmin.css" rel="stylesheet">';
        $output.= '    <!-- Morris Charts CSS -->';
        $output.= '    <link href="' . $level . 'ASSETS.V_01/css/morris.css" rel="stylesheet">';
        $output.= '    <!-- Custom Fonts -->';
        $output.= '    <link href="' . $level . 'ASSETS.V_01/css/font-awesome.min.css" rel="stylesheet" type="text/css">';
        $output.= '    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>';
        $output.= '    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>';
        $output.= '    <!-- Sweet Alert -->';
        $output.= '    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        $output.= '   <!-- DataTables CSS -->';
        $output.= '   <link href="' . $level . 'ASSETS.V_01/css/dataTables/dataTables.bootstrap.css" rel="stylesheet">';
        $output.= '   <!-- DataTables Responsive CSS -->';
        $output.= '   <link href="' . $level . 'ASSETS.V_01/css/dataTables/dataTables.responsive.css" rel="stylesheet">';
        $output.= '   <!-- validations -->';
        $output.= '   <link href="' . $level . 'ASSETS.V_01/css/validations/validations.css" rel="stylesheet">';

        $output.= '</head>';   

        return $output;
    
    }

    function navbar( $level = '' ){
        $domain = $_SERVER['HTTP_HOST'];

        $output = '';
        $output.= '<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">';
        $output.= '    <div class="navbar-header">';
        $output.= '        <a class="navbar-brand" href="index.html">Gestion Tienda en Linea</a>';
        $output.= '    </div>';
        $output.= '    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">';
        $output.= '        <span class="sr-only">Toggle navigation</span>';
        $output.= '        <span class="icon-bar"></span>';
        $output.= '        <span class="icon-bar"></span>';
        $output.= '        <span class="icon-bar"></span>';
        $output.= '    </button>';
        $output.= '    <ul class="nav navbar-nav navbar-left navbar-top-links">';
        $output.= '        <li><a target="_blank" href="http://' . $domain . '/commerce/PAGE/PAGES/"><i class="fa fa-home fa-fw"></i>Ver Website</a></li>';
        $output.= '    </ul>';
        $output.= '    <ul class="nav navbar-right navbar-top-links">';
        $output.= '        <li class="dropdown">';
        $output.= '            <a class="dropdown-toggle" data-toggle="dropdown" href="#">';
        $output.= '                <i class="fa fa-user fa-fw"></i> Cuenta <b class="caret"></b>';
        $output.= '            </a>';
        $output.= '            <ul class="dropdown-menu dropdown-user">';
        $output.= '                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>';
        $output.= '                </li>';
        $output.= '                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>';
        $output.= '                </li>';
        $output.= '                <li class="divider"></li>';
        $output.= '                <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>';
        $output.= '                </li>';
        $output.= '            </ul>';
        $output.= '        </li>';
        $output.= '    </ul>';
        $output.= '</nav>';
    
        return $output;

    }

    function sidebar( $level = '' ){
        $domain = $_SERVER['HTTP_HOST'];
        $output = '';
        $output.= '    <div class="navbar-default sidebar" role="navigation">';
        $output.= '        <div class="sidebar-nav navbar-collapse">';
        $output.= '            <ul class="nav" id="side-menu">';
        $output.= '                <li class="sidebar-search">';
        $output.= '                    <div class="input-group custom-search-form">';
        $output.= '                        <input type="text" class="form-control" placeholder="Search...">';
        $output.= '                        <span class="input-group-btn">';
        $output.= '                            <button class="btn btn-primary" type="button">';
        $output.= '                                <i class="fa fa-search"></i>';
        $output.= '                            </button>';
        $output.= '                    </span>';
        $output.= '                    </div>';
        $output.= '                </li>';
        $output.= '                <li>';
        $output.= '                    <a href="http://' . $domain . '/commerce/SYSTEM/FLCATEGORY/FRM/management_category.php" class=""><i class="fa fa-dashboard fa-fw"></i> Gestion Categorias</a>';
        $output.= '                </li>';
        $output.= '                <li>';
        $output.= '                    <a href="http://' . $domain . '/commerce/SYSTEM/FLPRODUCT/FRM/management_product.php" class=""><i class="fa fa-dashboard fa-fw"></i> Gestion Productos</a>';
        $output.= '                </li>';
        $output.= '            </ul>';
        $output.= '        </div>';
        $output.= '    </div>';
        
        return $output;

    }

    function script_js( $level = '' ){
        
        $output = '';
        $output.= '<!-- jQuery -->';
        $output.= '<script src="' . $level . 'ASSETS.V_01/js/jquery.min.js"></script>';
        $output.= '<!-- Bootstrap Core JavaScript -->';
        $output.= '<script src="' . $level . 'ASSETS.V_01/js/bootstrap.min.js"></script>';
        $output.= '<!-- Metis Menu Plugin JavaScript -->';
        $output.= '<script src="' . $level . 'ASSETS.V_01/js/metisMenu.min.js"></script>';
        $output.= '<!-- Morris Charts JavaScript -->';
        $output.= '<script src="' . $level . 'ASSETS.V_01/js/raphael.min.js"></script>';
        // $output.= '<script src="' . $level . 'ASSETS.V_01/js/morris.min.js"></script>';
        // $output.= '<script src="' . $level . 'ASSETS.V_01/js/morris-data.js"></script>';
        $output.= '<!-- Custom Theme JavaScript -->';
        $output.= '<script src="' . $level . 'ASSETS.V_01/js/startmin.js"></script>';
        $output.= '<!-- DataTables JavaScript -->';
        $output.= '<script src="' . $level . 'ASSETS.V_01/js/dataTables/jquery.dataTables.min.js"></script>';
        $output.= '<script src="' . $level . 'ASSETS.V_01/js/dataTables/dataTables.bootstrap.min.js"></script>';
        $output.= '<script src="' . $level . 'ASSETS.V_01/scripts_modules/utils.js"></script>';

        return $output;

    }

?>