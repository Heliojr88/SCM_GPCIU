<div class="menu_section">
	<h3>&nbsp;</h3>
	<ul class="nav side-menu">
	  
	  <li><a><i class="fa fa-list"></i> Lista <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
		<li><a href="index.php">Lista Completa</a></li>
		  <li><a href="index6.php">Alterações</a></li>
		  <li><a href="index7.php">Tramitações</a></li>
		  <li><a href="index8.php">Baixados / Ativados</a></li>
		  
          <?php
					  
		   $consulta = $_pdo->getLocalizacaoAtiva();
			  WHILE($localizacao = $consulta->fetch(PDO::FETCH_ASSOC)):
					  
		  ?>
		 <li><a href="indexAll.php?idLocalizacao=<?=$localizacao['idLocalizacao']?>"><?=$localizacao['Localizacao']?></a></li>
                               
		  <?php
		   ENDWHILE
		  ?>
         
		  
		
		  
		</ul>
	  </li>
          <!--Delvan: a ser descomentado somente quando se decidir pela implantação do QR CODE
	  <li><a><i class="fa fa-list-alt"></i>QR CODE<span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
		  <li><a href="gerarCodigo.php">Gerar QR Code</a></li>
		  <li><a href="lerCodeMaterial.php">Consulta QR Code</a></li>
		</ul>
	  </li>
          -->
	  <li><a><i class="fa fa-edit"></i> Cadastro <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
		  <li><a href="alteracao.php">Alterações</a></li>
		  <li><a href="material.php">Material</a></li>
		  <li><a href="indicemat.php">Itens a um material</a></li>
		  <li><a href="ManterMaterial.php">Editar Material</a></li>
		  <li><a href="localizacao.php">Localização</a></li>
		  <li><a href="sublocalizacao.php">Sub Localização</a></li>
		  <li><a href="ManterLocalizacao.php">Editar Localização</a></li>
		  <li><a href="baixamaterial.php">Baixar Material</a></li>
		  <li><a href="ativamaterial.php">Ativar Material</a></li>
		  <li><a href="ativausuario.php">Ativar/Desativar Usuários</a></li>
		  
		  
		 
		  
		  
		  
		</ul>
	  </li>
	  <li><a><i class="fa fa-edit"></i> Tramitar Material <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
		  <li><a href="tramitacao.php">Tramitação Individual</a></li>
                  <li><a href="tramitacaoColetiva.php">Tramitação Coletiva</a></li>
		  
		</ul>
	  </li>
	  <!--
	  <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
		  <li><a href="general_elements.html">General Elements</a></li>
		  <li><a href="media_gallery.html">Media Gallery</a></li>
		  <li><a href="typography.html">Typography</a></li>
		  <li><a href="icons.html">Icons</a></li>
		  <li><a href="glyphicons.html">Glyphicons</a></li>
		  <li><a href="widgets.html">Widgets</a></li>
		  <li><a href="invoice.html">Invoice</a></li>
		  <li><a href="inbox.html">Inbox</a></li>
		  <li><a href="calendar.html">Calendar</a></li>
		</ul>
	  </li>
	  <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
		  <li><a href="tables.html">Tables</a></li>
		  <li><a href="tables_dynamic.html">Table Dynamic</a></li>
		</ul>
	  </li>
	  <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
		  <li><a href="chartjs.html">Chart JS</a></li>
		  <li><a href="chartjs2.html">Chart JS2</a></li>
		  <li><a href="morisjs.html">Moris JS</a></li>
		  <li><a href="echarts.html">ECharts</a></li>
		  <li><a href="other_charts.html">Other Charts</a></li>
		</ul>
	  </li>
	  <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
		  <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
		  <li><a href="fixed_footer.html">Fixed Footer</a></li>
		</ul>
	  </li>-->
	</ul>
  </div>
 <!--
  <div class="menu_section">
	<h3>Live On</h3>
	<ul class="nav side-menu">
	  <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
		  <li><a href="e_commerce.html">E-commerce</a></li>
		  <li><a href="projects.html">Projects</a></li>
		  <li><a href="project_detail.html">Project Detail</a></li>
		  <li><a href="contacts.html">Contacts</a></li>
		  <li><a href="profile.html">Profile</a></li>
		</ul>
	  </li>
	  <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
		  <li><a href="page_403.html">403 Error</a></li>
		  <li><a href="page_404.html">404 Error</a></li>
		  <li><a href="page_500.html">500 Error</a></li>
		  <li><a href="plain_page.html">Plain Page</a></li>
		  <li><a href="login.html">Login Page</a></li>
		  <li><a href="pricing_tables.html">Pricing Tables</a></li>
		</ul>
	  </li>
	  <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
			<li><a href="#level1_1">Level One</a>
			<li><a>Level One<span class="fa fa-chevron-down"></span></a>
			  <ul class="nav child_menu">
				<li class="sub_menu"><a href="level2.html">Level Two</a>
				</li>
				<li><a href="#level2_1">Level Two</a>
				</li>
				<li><a href="#level2_2">Level Two</a>
				</li>
			  </ul>
			</li>
			<li><a href="#level1_2">Level One</a>
			</li>
		</ul>
	  </li>                  
	  <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
	</ul>
  </div>-->
  
