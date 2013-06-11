<header id="header" class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <div class="brand-wrap pull-left">
                <div class="brand-img">
                    <a class="brand" href="#">
                        <img src="<?php echo HOME; ?>images/logo_mayan.png" alt="" style="width: 117px; height: 21px;">
                    </a>
                </div>
            </div>

            <div id="header-right" class="clearfix">
                <div id="nav-toggle" data-toggle="collapse" data-target="#navigation" class="collapsed">
                    <i class="icon-caret-down"></i>
                </div>
                
               
                  

                <div id="header-functions" class="pull-right">
                    <div id="user-info" class="clearfix">
                        <span class="info">
                            Bienvenido
                            <span class="name"><?php echo $_SESSION['user']['nombre'].' '.$_SESSION['user']['apellidos']; ?></span>
                        </span>
                        <div class="avatar">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                             <!--   <img src="<?php //echo HOME; ?>assets/images/pp.jpg" alt="Avatar"> -->
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="<?php echo HOME; ?>profile.html"><i class="icol-user"></i> My Profile</a></li>
                                <li><a href="#"><i class="icol-layout"></i> My Invoices</a></li>                                        
                                <li class="divider"></li>
                                <li><a href="<?php echo HOME; ?>?section=login&action=out"><i class="icol-key"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="logout-ribbon">
                        <a href="<?php echo HOME; ?>?section=login&action=out"><i class="icon-off"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div id="content-wrap">
    <div id="content">
        <div id="content-outer">
            <div id="content-inner">
                
                
