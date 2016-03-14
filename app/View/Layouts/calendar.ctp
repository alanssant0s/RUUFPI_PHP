<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo $this->webroot; ?>img/favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <?php
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('dashboard');
	?>
    

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
			<img src="<?php echo $this->webroot; ?>img/logo.png"></img>      
 		</div>
        <div class="navbar-collapse collapse">
          <ul style="width: 500px; padding-top: 35px;" class="nav navbar-nav navbar-right">

            <div class="row placeholders">
            <div style="text-align: right;" class="col-xs-6 col-sm-7 placeholder">
              Logado como <bold><?php echo current(explode(' ',$user['name']));?></bold>
              </div>
            <div  style="text-align: left;" class="col-xs-6 col-sm-2 placeholder">
              <?php echo $this->Html->link('(Sair)', array('controller' => 'users', 'action' => 'logout'));?>
              </div>
            </div>
        
         
          </ul>
          
        </div>
      </div>
    </div>

    <div class="container-fluid" style="margin-top: 25px;">
      <div class="row">
        <?php 

        if($user['role'] == 'presidente')
          echo '
          <div class="col-sm-3 col-md-2 sidebar" style="margin-top: 9px;">
            <ul class="nav nav-sidebar">
              <li class="">'.
              $this->Html->link('<i class = "glyphicon glyphicon-list"></i> Resultados', array('controller' => 'units','action' => 'see'), array('class' => 'list-group-item','escape'=>false)).'</li>
               <li>'.
              $this->Html->link('<i class = "glyphicon glyphicon-calendar"></i> Criar Relatórios', array('controller' => 'reports','action' => 'psee_report'), array('class' => 'list-group-item','escape'=>false)).'</li>
              <div class="list-group panel">
                  <a href="#demo4" class="list-group-item list-group-item" data-toggle="collapse" data-parent="#MainMenu"><i class="glyphicon glyphicon-map-marker" ></i>Relatórios</a>
                  <div class="collapse" id="demo4">
                    '.$this->Html->link('NPS', array('controller' => 'units','action' => 'nps'), array('class' => 'list-group-item')).'
                    '.$this->Html->link('Gerenciais', array('controller' => 'units','action' => 'gerenciais'), array('class' => 'list-group-item')).'
                    '.$this->Html->link('Unidades', array('controller' => 'units','action' => 'unidades'), array('class' => 'list-group-item')).'
                  </div>
               </div>
            </ul>
          </div>';
        else
          echo '
          <div class="col-sm-3 col-md-2 sidebar" style="margin-top: 9px;">
            <ul class="nav nav-sidebar">
              <li class="">'.
              $this->Html->link('<i class = "glyphicon glyphicon-list"></i> Resultados', array('controller' => 'units','action' => 'results'), array('class' => 'list-group-item','escape'=>false)).'</li>
              <li>'.
              $this->Html->link('<i class = "glyphicon glyphicon-map-marker"></i> Ver Relatórios', array('controller' => 'reports','action' => 'see_reports'), array('class' => 'list-group-item','escape'=>false)).'</li>
              <li>'.
              $this->Html->link('<i class = "glyphicon glyphicon-calendar"></i> Criar Relatórios', array('controller' => 'reports','action' => 'add'), array('class' => 'list-group-item','escape'=>false)).'</li>
              

            </ul>
          </div>';
        
          ?>
        	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

			<?php
       echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
      <?php echo $this->element('sql_dump'); ?>
			</div>
        
      </div>
    </div>

    <!-- 
          <h1 class="page-header">Unidades (Ver Todas)</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <h4 style="position: absolute;border-left-width: 40px;left: 40%;margin-top: 35%;">Sede</h4>
              <img src="<?php echo $this->webroot; ?>img/background.png" class="img-responsive" alt="Generic placeholder thumbnail">
              </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <h4 style="position: absolute;border-left-width: 40px;left: 40%;margin-top: 35%;">Sede</h4>
              <img src="<?php echo $this->webroot; ?>img/background.png" class="img-responsive" alt="Generic placeholder thumbnail">
              </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <h4 style="position: absolute;border-left-width: 40px;left: 40%;margin-top: 35%;">Sede</h4>
              <img src="<?php echo $this->webroot; ?>img/background.png" class="img-responsive" alt="Generic placeholder thumbnail">
              </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <h4 style="position: absolute;border-left-width: 40px;left: 40%;margin-top: 35%;">Sede</h4>
              <img src="<?php echo $this->webroot; ?>img/background.png" class="img-responsive" alt="Generic placeholder thumbnail">
              </div>
          </div>

         
          </div>-->
		<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

  </body>
</html>
