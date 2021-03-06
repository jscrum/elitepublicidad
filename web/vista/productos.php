<?php
	include_once ("imports.php");
	include_once ("header.php");
	include_once ("menu.php");
	include_once ("footer.php");
	include_once ("../controlador/funciones.php");
	getImports();

	
?>
	<body>
		<div id="main"  class="wrapper">
			<?php 
				getHeader();
				getMenu("inicio");
				$productos = getProductos();

				
			?>
	<!-- --------------------CÓDIGO HTML------------------------------------------------ -->		
			<section id="productos">
				<?php
					for ($i=0; $i < sizeof($productos); $i++) { 
								
				?>
				<article>
					<hgroup>
						<h1> <?php echo $productos[$i]['nombre'] ?></h1>
					</hgroup>
					<section>
						<div id="informacion">
							<div id="imagenInformacion">
								<script>
								$(document).ready(function(){
								//Examples of how to assign the Colorbox event to elements
									$(".imagen<?php echo $i; ?>").colorbox({
										rel:'imagen<?php echo $i;  ?>',
										width: "600px"
										});							
									//Example of preserving a JavaScript event for inline calls.
									$("#click").click(function(){ 
										$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
										return false;
									});						
								});
								</script>
								
								<a class="imagen<?php echo $i; ?>" href="<?php echo $productos[$i]['ruta'] ?>" title="Imágen principal del producto: <?php echo $productos[$i]['nombre'] ?>">
									<img style="width: 100%; height: 100%;" src="<?php echo $productos[$i]['ruta'] ?>"/>
								</a>
							</div>
							<div id="textoInformacion">
									<?php echo $productos[$i]['descripcion']; ?>
							</div>
						</div>

						<div id="imagenes">

							<script>
								$(document).ready(function(){
								//Examples of how to assign the Colorbox event to elements
									$(".visor<?php echo $i; ?>").colorbox({
										rel:'visor<?php echo $i;  ?>',
										width: "600px"
										});							
									//Example of preserving a JavaScript event for inline calls.
									$("#click").click(function(){ 
										$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
										return false;
									});						
								});
							</script>
							
							<?php
								$idProducto= $productos[$i]['idproducto'];							
								$imagenes = getImagenesProducto($idProducto);		  		
								for ($j=0; $j < sizeof($imagenes) ; $j++) 
								{

							?>
								
								<a class="visor<?php echo $i; ?>" href="<?php echo $imagenes[$j]['ruta'] ?>" title="<?php echo $imagenes[$j]['descripcion'] ?>">
									<div class="itemImagenes">
										<img style="width: 100%; height: 100%;" src="<?php echo $imagenes[$j]['ruta'] ?>" />
									</div>
								</a>
							<?php 
								}
							?>
							
						</div>
						
						
					</section>
					<footer>
						<div id="verMas">
							<a href="<?php echo "infoProducto?idproducto=".$productos[$i]['idproducto'] ?>">
								<span>Ver más...</span>
							</a>
						</div>
					</footer>
				</article>
				<?php
				}
				?>
				
			</section>
	<!-- --------------------CÓDIGO HTML------------------------------------------------ -->
			<?php
				getFooter();
			?>
		</div>
	</body>
	</html>
