<?php
    $memberModel = MemberModel::model()->findByPk(Yii::app()->user->id);
    $baseUrl = Yii::app()->baseUrl;
    $fullname = $memberModel->fullname;
    $controller = Yii::app()->controller->id;
    $action = Yii::app()->controller->action->id;
    $active_Pages = '';
    $menuOpen_Pages = '';
    if($controller == 'adminPanel' && (
        $action == 'edithome' || $action == 'edittypes' || $action == 'editdestination'
        || $action == 'editoffers' || $action == 'editinspireme' || $action == 'editaboutus'
    )){
        $active_Pages = 'active';
        $menuOpen_Pages = 'menu-open';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminPanel 2 | CURZONTRVEL</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel='shortcut icon' href='<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico' />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">

                <!-- Logo -->
                <a href="index" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>A</b>PN</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Admin</b>Panel</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">0</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 0 messages</li>
                                <li>
                                    <!-- inner menu: contains the messages -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                        <a href="#">
                                            <div class="pull-left">
                                                <!-- User Image -->
                                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/photo.jpg" class="img-circle" alt="User Image">
                                            </div>
                                            <!-- Message title and timestamp -->
                                            <h4>
                                            Support Team
                                            <small><i class="fa fa-clock-o"></i> 0 mins</small>
                                            </h4>
                                            <!-- The message -->
                                            <p>Why not buy a new awesome theme?</p>
                                        </a>
                                        </li><!-- end message -->
                                    </ul><!-- /.menu -->
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li><!-- /.messages-menu -->

                        <!-- Notifications Menu -->
                        <li class="dropdown notifications-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">0</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 0 notifications</li>
                                <li>
                                    <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu">
                                        <li><!-- start notification -->
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 0 new members joined today
                                        </a>
                                        </li><!-- end notification -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks Menu -->
                        <li class="dropdown tasks-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">0</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 0 tasks</li>
                                <li>
                                    <!-- Inner menu: contains the tasks -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <!-- Task title and progress text -->
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <!-- The progress bar -->
                                                <div class="progress xs">
                                                    <!-- Change the css width attribute to simulate progress -->
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="<?php echo Yii::app()->baseUrl; ?>/images/photo.jpg" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?=$fullname?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/photo.jpg" class="img-circle" alt="User Image">
                                    <p>
                                        <?=$fullname?> - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                    </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/photo.jpg" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?=$fullname?></p>
                            <!-- Status -->
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    <!-- search form (Optional) -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu">
                        <li class="header">HEADER</li>
                        <!-- Optionally, you can add icons to the links -->
                        <li><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
                        <li <?=($action == 'addslider')?'class="active"':''?>>
                            <a href="<?=$baseUrl?>/adminPanel/addsliderform"><i class="fa fa-picture-o"></i>
                                <span>Add slider</span>
                            </a>
                        </li>
                        <li class="treeview <?=$active_Pages?>">
                            <a href="#"><i class="fa fa-edit"></i> <span>Pages</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu <?=$menuOpen_Pages?>">
                                <li <?=($action == 'edithome')?'class="active"':''?>>
                                    <a id='edit-home' href="<?=$baseUrl?>/adminPanel/edithome">
                                        <i class="fa fa-circle-o"></i>Home
                                    </a>
                                </li>
                                <li <?=($action == 'editdestination')?'class="active"':''?>>
                                    <a id='edit-destination' href="<?=$baseUrl?>/adminPanel/editdestination">
                                        <i class="fa fa-circle-o"></i>Destination
                                    </a>
                                </li>
                                <li <?=($action == 'edittypes')?'class="active"':''?>>
                                    <a id='edit-types' href="<?=$baseUrl?>/adminPanel/edittypes">
                                        <i class="fa fa-circle-o"></i>Types
                                    </a>
                                </li>
                                <li <?=($action == 'editoffers')?'class="active"':''?>>
                                    <a id='edit-offers' href="<?=$baseUrl?>/adminPanel/editoffers">
                                        <i class="fa fa-circle-o"></i>Offers
                                    </a>
                                </li>
                                <li <?=($action == 'editinspireme')?'class="active"':''?>>
                                    <a id='edit-inspire-me' href="<?=$baseUrl?>/adminPanel/editinspireme">
                                        <i class="fa fa-circle-o"></i>Inspire me
                                    </a>
                                </li>
                                <li <?=($action == 'editaboutus')?'class="active"':''?>>
                                    <a id='edit-about-us' href="<?=$baseUrl?>/adminPanel/editaboutus">
                                        <i class="fa fa-circle-o"></i>About us
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul><!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <?php echo $content; ?>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    Anything you want
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2016 <a href="<?php echo Yii::app()->baseUrl; ?>">Curzon St James Travel</a></strong> All rights reserved.
            </footer>
        </div><!-- ./wrapper -->
    </body>
</html>
