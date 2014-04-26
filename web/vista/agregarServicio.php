<?php 

	session_start();

	if ($_SESSION['idusuario'])
	{
		include_once('imports.php');
		include_once('header.php');
		include_once('menu.php');
		include_once('footer.php');
		getImportsAdmin();
		?>
		<body>
			<div id="main" class="wrapper">
				<?php 
					getHeader();
					getMenu("administrador");
				?>
			<!-- --------------------CÓDIGO HTML------------------------------------------------ -->
				<section id="gestionar">
					<article >
						<header>
							<h2>Agregar Servicio</h2>
						</header>
						<section>
							<div id="formulario_agregar_servicio">
								<form action="../controlador/insertarServicio" method="post" enctype="multipart/form-data">
								
									<div class="etiqueta">
										<label> Imágen: </label>
									</div>
									<div class="componente">
										<input class="textField" type="file" name="imagenServicio" required="required" />
									</div>
								
								
									<div class="etiqueta">
										<label> Nombre: </label>
									</div>
									<div class="componente">
										<input class="textField" type="text" name="nombreServicio" required="required" />
									</div>
									
									
									<div class="etiqueta">
										<label> Descripción: </label>
									</div>
									<div class="componente">
										<textarea id="texto" name="descripcionServicio"  class="textArea" required="required">
	                						
	            						</textarea>
	            						<script>
		    								CKEDITOR.replace( 'texto',{
		                						filebrowserBrowseUrl : '../../libs/ckeditor/filemanager/index.php'
		                					} );
										</script>
									</div>
									
									
									<div class="etiqueta">
										<label> Fecha de Creación: </label>
									</div>
									<div class="componente">
										<input class="textField" type="date" placeholder="dd/mm/aaaa" name="fechaServicio" required="required" />
									</div>
									
									
									<div style="text-align: center;">
										<input type="submit" value="Agregar Servicio" />
									</div>
								</form>
							</div>		
						</section>
					</article>
				</section>
			
			<!-- --------------------CÓDIGO HTML------------------------------------------------ -->
				<?php
					getFooter();
				?>
			</div>
		</body>
	</html>
	<?php	
	}
	else
	{
		header('location:index');
	}
 
?>