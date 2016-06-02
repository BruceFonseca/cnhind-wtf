<?php 
//variaveis da session
if($this->session->userdata('logged_in')){
    $session_data = $this->session->userdata('logged_in');
    $dsc_name = $session_data['dsc_name'];
    $username= $session_data['username'];
}

?>

<div class="navbar navbar-fixed-top">
 <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
                <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="#"><?php echo $dsc_name; ?>, seja bem vindo ao <strong>Working Time Flexibility</strong>!</a></li>
                </ul>

            <ul class="nav navbar-nav navbar-right">

                <div class="dropdown">

                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-placement="bottom" data-original-title="Administrar">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                  </button>

                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php foreach ($submenu_list as $submenu): ?>
                                <li>
                                    <a href='<?php echo base_url($submenu->controller)  ?>'><?php echo ucwords($submenu->submenu) ?></a>
                                </li>
                                <li role="separator" class="divider"></li>
                    <?php endforeach; ?>
                  </ul>

                </div>
                <a href=<?php  echo base_url('home/logout') ?>>
                <button class="btn btn-default dropdown-toggle" data-toggle="tooltip" data-placement="bottom" data-original-title="Sair">
                  <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                </button>
                </a>
            </ul>

            <!-- </div> --><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</div>
