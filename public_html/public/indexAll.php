<?php
ini_set('default_charset','UTF-8');
session_start();

require("../app/pdo.php");

$_pdo = new connectDB();
$_pdo->conectar();

$nome = $_SESSION['nome'];
$idLocalizacao = $_GET['idLocalizacao'];

if((!isset ($_SESSION['siape']) == true) and (!isset ($_SESSION['senha']) == true))
{
	unset($_SESSION['siape']);
	unset($_SESSION['senha']);
	
	echo("<script language='javascript' type='text/javascript'>alert('Gentileza realizar login no Sistema!');window.location.href='login.php';</script>");
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
     <?php 
          $loc = $_pdo->getLocalizacao($idLocalizacao);

          $local = $loc->fetch(PDO::FETCH_ASSOC);
    ?>
        Relatório - <?=$local['Localizacao'];?>            
    </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
           

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="images/logo.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bem Vindo,</span>
                <h2><?=$nome;?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              
			  <?php
				require('sidebar.php');
			  ?>
			  
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons 
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
			<?php
				require('top_menu.php');
			?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
			  <?php 
                                $loc = $_pdo->getLocalizacao($idLocalizacao);

                                $local = $loc->fetch(PDO::FETCH_ASSOC);
				  
			  ?>
                <h3>Relatório - <?=$local['Localizacao'];?> <small> </small></h3>
               </div>
                
              
              
                        
                    </div>
				<form method="POST">
					<div class="form-group">
						<button type="submit" class="btn btn-success" style="float: right; margin-left: 10px">Filtrar</button>
					<select id="sublocalizacao" name="sublocalizacao" class="form-control" name="sublocalizacao" style="width: 200px; float: right">
			 
					<?php     
						    
							$consultasublocal = $_pdo->getSubLocalizacao($idLocalizacao);
							  WHILE($sublocal = $consultasublocal->fetch(PDO::FETCH_ASSOC)):

					?>
							 <option value="<?=$sublocal['idSubLocalizacao']?>" <?= ($sublocal['idSubLocalizacao'] == $_POST['sublocalizacao'] ? 'selected' : '') ?> <td><?=$sublocal['subLocalizacao']?></td> </option>

					<?php
					ENDWHILE;
					?>    
								<option value=""><td>LIMPAR SELEÇÃO</td></option>
					</select>
					  
					  
					</div>
               </form>

            </div>			

            <div class="clearfix"></div>

            <div class="row">
			
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <!--<div class="x_title">
                    <h2>Depósito</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>-->
                  <div class="x_content">
                    <!--<p class="text-muted font-13 m-b-30">
                      The Buttons extension for DataTables provides a common set of options, API methods and styling to display buttons on a page that will interact with a DataTable. The core library provides the based framework upon which plug-ins can built.
                    </p>-->
                    <table id="datatable-buttons" class="table table-striped table-bordered bulk_action">
                      <thead>
                        <tr>
                          <th>Qtde.</th>
                          <th>Descrição</th>
                          <th>Patr.</th>
                          <th>Categoria</th>
                          <th>Local.</th>
                          <th>Sub Local.</th>
                          <th>Sit.</th>
                        </tr>
                      </thead>


                      <tbody>
					  
                      <?php
			$sublocalizacao = $_POST['sublocalizacao'];
                        
                        if(!empty($sublocalizacao)){
                            $consulta = $_pdo->getMaterialSubLocal($idLocalizacao,$sublocalizacao);
                        }else{
                            $consulta = $_pdo->getMaterialAll($idLocalizacao);
                        }
			
                        WHILE($material = $consulta->fetch(PDO::FETCH_ASSOC)):                                                   
			?>
					  
                        <tr>
                          <td><?=$material['Quantidade']?></td>
                          <td><?=$material['DescricaoMat']?></td>
                          <td><?=$material['NumPatrimonio']?></td>
                          <td><?=$material['Categoria']?></td>
                          <td><?=$material['Localizacao']?></td>
                          <td><?=$material['subLocalizacao']?></td>
                          <td><?=$material['SituacaoMat']?></td>
                        </tr>
						
                        <?php
                        ENDWHILE;
                        ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

			</div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right" style="line-height: 10px; text-align: right;">
            <?php require("sobre.php"); ?>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="js/custom.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            table = $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true,
			  paginate: true,
			  pageLength: 50,
			  language: {
                "url": "../vendors/datatables.net/dataTables.ptBr.lang"
			  }
            });
			table
				.column( '5:visible' )
				.order( 'asc' )
				.draw();
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();
		/*
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        var table = $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        }); **/
        
        //$("tr.odd,tr.even").click(function(){
        $("tbody > tr").click(function(){
            var elem = $(this);
            elem.toggleClass("bg-green");
            //elem.fadeOut("slow");
        });
        
        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
  </body>
</html>