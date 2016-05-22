<?php 
    if($this->session->userdata('session_menu_sidebar'))
    {
        $menu_planta = $this->session->userdata('session_menu_sidebar');
    }
 ?>

<!-- Sidebar -->
<nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
    <ul class="nav sidebar-nav">
        <li class="sidebar-brand">
            <a href=<?php echo base_url('working-time-flexibility') ?>>
               <img id="logo-login" src=<?php echo base_url('img/sistema/logotipo/logo.png') ?> alt="Working Time Flexibility - CNH Industrial"/>
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('working-time-flexibility') ?>">Home</a>
        </li>
        <li>
            <a href="<?php  echo base_url('comparacoes') ?>">Comparações</a>
        </li>

        <?php foreach ($menu_planta as $menu): ?>
            <li >
                <a href= <?php echo base_url('ocorrencia/retrieve_by_planta/'. $menu->id_planta) ?>><?php echo ucwords($menu->dsc_planta) ?></a>
            </li>
        <?php endforeach; ?>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Works <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class="dropdown-header">Acordos por Planta</li>
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
    </ul>
</nav>
<!-- /#sidebar-wrapper -->