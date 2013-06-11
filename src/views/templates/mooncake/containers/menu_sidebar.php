<aside id="sidebar">
    <nav id="navigation" class="collapse">
        <ul>
            <li <?php echo Param::getMenu() == 'catalogos'?'class="active"':''; ?>>
                <span title="Catalogos">
                    <i class="icon-database"></i>
                    <span class="nav-title">Catalogos</span>
                </span>
                <ul class="inner-nav">
                    <li <?php echo Param::getSubmenu() == 'dashboard'?'class="active"':''; ?>><a href="<?php echo HOME; ?>"><i class="icol-application-home"></i> Dashboard</a></li>
                    <li <?php echo Param::getSubmenu() == 'pakales'?'class="active"':''; ?>><a href="<?php echo go('pakales'); ?>"><i class="icol-application-edit"></i> Pakales</a></li>
                    <li <?php echo Param::getSubmenu() == 'banners'?'class="active"':''; ?>><a href="<?php echo go('banners'); ?>"><i class="icol-picture"></i> Banners</a></li>
                    <li <?php echo Param::getSubmenu() == 'patrocinadores'?'class="active"':''; ?>><a href="<?php echo go('patrocinadores'); ?>"><i class="icol-application-edit"></i> Patrocinadores</a></li>
                    <li <?php echo Param::getSubmenu() == 'noticias'?'class="active"':''; ?>><a href="<?php echo go('noticias'); ?>"><i class="icol-layout-header-footer-3"></i> Noticias</a></li>
                    <li <?php echo Param::getSubmenu() == 'eventos'?'class="active"':''; ?>><a href="<?php echo go('eventos'); ?>"><i class="icol-calendar-2"></i> Eventos</a></li>
                </ul>
            </li>

            <li <?php echo Param::getMenu() == 'sistema'?'class="active"':''; ?>>
                <span title="Elements">
                    <i class="icon-cogs"></i>
                    <span class="nav-title">Sistema</span>
                </span>
                <ul class="inner-nav">
                    <li <?php echo Param::getSubmenu() == 'administradores'?'class="active"':''; ?>><a href="<?php echo go('administradores'); ?>"><i class="icol-user-business"></i>Administradores</a></li>
                    
                    <li><a href="<?php echo go('login','out'); ?>"><i class=" icol-disconnect"></i> Salir</a></li>
                </ul>
            </li>
            
            <li <?php echo Param::getMenu() == 'lenguaje'?'class="active"':''; ?>>
                <span title="Elements">
                    <i class="icon-globe"></i>
                    <span class="nav-title">Etiquetas</span>
                </span>
                <ul class="inner-nav">
                    <li <?php echo Param::getSubmenu() == 'categorias'?'class="active"':''; ?>><a href="<?php echo go('categorias'); ?>"><i class="icol-cog"></i>categorias</a></li>
                    
                    <li <?php echo Param::getSubmenu() == 'etiquetas'?'class="active"':''; ?> ><a href="<?php echo go('etiquetas'); ?>"><i class=" icol-tag"></i> Etiquetas</a></li>
                </ul>
            </li>
            
        </ul>
    </nav>
</aside>

<div id="sidebar-separator"></div>
<section id="main" class="clearfix">