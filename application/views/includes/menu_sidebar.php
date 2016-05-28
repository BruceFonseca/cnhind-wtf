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

        <?php 
        if(isset($menu_planta)){
        foreach ($menu_planta as $menu): ?>
            <li >
                <a href= <?php echo base_url('ocorrencia/retrieve_by_planta/'. $menu->id_planta) ?>><?php echo ucwords($menu->dsc_planta) ?></a>
            </li>
        <?php  endforeach; }?>
    </ul>
</nav>
<!-- /#sidebar-wrapper -->