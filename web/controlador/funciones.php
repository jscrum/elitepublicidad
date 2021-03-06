<?php
    include_once'mysql.php';
	
	/*
	 * Funcion que permite manejar la logica respecto a la cantidad de visitas de la pag.
	 */
	function contadorVisitas()
	{

		 // fichero donde se guardaran las visitas
		 $fichero = "../../visitas.txt";
		 
		 $fptr = fopen($fichero,"r");
		 
		 // sumamos una visita
		 $num = fread($fptr,filesize($fichero));
		 $num++;
		 
		 $fptr = fopen($fichero,"w");
		 fwrite($fptr,$num);
		 
		 return $num;

		//asigno el archivo a la variable $maestro
		$maestro = fopen("../../contador.txt","r+");

		//leo la primera linea y se la asigno a $leer
		$leer = fgets($maestro,10);

		//incremento la variable $leer en uno
		++$leer;

		//rebobino el archivo para poder sobre escribir su contenido
		rewind($maestro);

		//sobreescribo el contenido
		fputs($maestro,$leer);

		//cierro el archivo de texto
		fclose($maestro);

		//muestro en pantalla el valor acutal del archivo
		//echo "Sos el visitante N°: $leer";
		return $leer;

	}
	
	/*
	 * Funcion que permite decodificar informacion en atributo URL
	 */
	function getDecodificar($cadena)
	{
		$decodificada=substr($cadena,9,(strlen($cadena)-1));
		return $decodificada;
	}	
	
	/*
	 * Funcion que permite encriptar una cadena con una llave dada.
	 */
	function encrypt($string, $key) {
		   $result = '';
		   
		   for($i=0; $i<strlen($string); $i++) {
		      $char = substr($string, $i, 1);
		      $keychar = substr($key, ($i % strlen($key))-1, 1);
		      $char = chr(ord($char)+ord($keychar));
		      $result.=$char;
		   }
  	 	return base64_encode($result);
	}
	
	/*
	 * Funcion que permite desencriptar una cadena con una llave dada.
	 */  
	function decrypt($string, $key) {
		   $result = '';
		   $string = base64_decode($string);
		   for($i=0; $i<strlen($string); $i++) {
		      $char = substr($string, $i, 1);
		      $keychar = substr($key, ($i % strlen($key))-1, 1);
		      $char = chr(ord($char)-ord($keychar));
		      $result.=$char;
		   }
   		return $result;
	}
	
    /*
	 * -------------------------------------------------------------------------------------------------------------------------------
	 * -------------------------------------------------TRABAJOS REALIZADOS-----------------------------------------------------------
	 * -------------------------------------------------------------------------------------------------------------------------------
	 */
	 
	 /*
	 * Funcion que permite obtener una lista de trabajos realizados
	 */
	function getTrabajosRealizados()
	{
		$trabajosrealizados=array();
		$conexion= conectar();
		
		$i=0;
		$resultado=mysql_query("SELECT idtrabajorealizado,descripcion,ruta,fechacreacion FROM trabajorealizado", $conexion);
		while ($fila=mysql_fetch_array($resultado))
		{
			$trabajosrealizados[$i]['idtrabajorealizado']=$fila['idtrabajorealizado'];
			$trabajosrealizados[$i]['descripcion']=$fila['descripcion'];
			$trabajosrealizados[$i]['ruta']=$fila['ruta'];
			$trabajosrealizados[$i]['fechacreacion']=$fila['fechacreacion'];
			$i++;
		}		
		return $trabajosrealizados;
	}
	
	/*
	 * Funcion que permite obtener informacion de un trabajo realizado
	 */
	function getInformacionTrabajo($idtrabajorealizado)
	{
		$trabajo=array();
		$conexion= conectar();
		
		
		$resultado=mysql_query("SELECT idtrabajorealizado,descripcion,fechacreacion FROM trabajorealizado WHERE idtrabajorealizado='".mysql_real_escape_string($idtrabajorealizado)."'",$conexion);
		$fila=mysql_fetch_array($resultado);
		
			$trabajo['idtrabajorealizado']=$fila['idtrabajorealizado'];
			$trabajo['descripcion']=$fila['descripcion'];
			$trabajo['fechacreacion']=$fila['fechacreacion'];
			
		return $trabajo;
	}
	
	/*
	 * -------------------------------------------------------------------------------------------------------------------------------
	 * ----------------------------------------------------------PRODUCTOS------------------------------------------------------------
	 * -------------------------------------------------------------------------------------------------------------------------------
	 */
	
	/*
	 * Funcion que permite obtener una lista de productos
	 */
	function getProductos()
	{
		$productos=array();
		$conexion= conectar();
		
		$i=0;
		$resultado=mysql_query("SELECT idproducto,nombre,descripcion,ruta,fechacreacion FROM producto", $conexion);
		while ($fila=mysql_fetch_array($resultado))
		{
			$productos[$i]['idproducto']=$fila['idproducto'];
			$productos[$i]['nombre']=$fila['nombre'];
			$productos[$i]['descripcion']=$fila['descripcion'];
			$productos[$i]['ruta']=$fila['ruta'];
			$productos[$i]['fechacreacion']=$fila['fechacreacion'];
			$i++;
		}		
		return $productos;
	}

	/*
	 * Funcion que permite obtener informacion de un producto
	 */
	function getInformacionProducto($idproducto)
	{
		$producto=array();
		$conexion= conectar();
		
		$resultado=mysql_query("SELECT idproducto,nombre,ruta,descripcion,fechacreacion FROM producto WHERE idproducto='".mysql_real_escape_string($idproducto)."'",$conexion);
		$fila=mysql_fetch_array($resultado);
		
			$producto['idproducto']=$fila['idproducto'];
			$producto['nombre']=$fila['nombre'];
			$producto['ruta']=$fila['ruta'];
			$producto['descripcion']=$fila['descripcion'];
			$producto['fechacreacion']=$fila['fechacreacion'];
		return $producto;
	}
	
	/*
	 * Funcion que permite obtener las imagenes asociadas a un producto.
	 */ 
	function getImagenesProducto($idproducto)
	{
		$imagenesproducto=array();
		$conexion= conectar();
		
		$resultado=mysql_query("SELECT idimagenproducto, ruta, descripcion FROM  imagenproducto 
		WHERE producto_idproducto='".mysql_real_escape_string($idproducto)."'",$conexion);
		
		$i=0;
		while ($fila=mysql_fetch_array($resultado))
		{
		
			$imagenesproducto[$i]['idimagenproducto']=$fila['idimagenproducto'];
			$imagenesproducto[$i]['ruta']=$fila['ruta'];
			$imagenesproducto[$i]['descripcion']=$fila['descripcion'];
			$i++;
		}	
		return $imagenesproducto;
	}

	/*
	 * -------------------------------------------------------------------------------------------------------------------------------
	 * ------------------------------------------------------IMAGENES PRODUCTOS-------------------------------------------------------
	 * -------------------------------------------------------------------------------------------------------------------------------
	 */
	 
	 /*
	  * Funcion que permite obtener la información asociada una imagen de un producto.
	  */ 
	 function getInformacionImagenProducto($idimagenproducto)
	 {
		$imagenproducto=array();
		$conexion= conectar();
		
		$resultado=mysql_query("SELECT idimagenproducto,producto_idproducto,ruta,descripcion FROM imagenproducto WHERE idimagenproducto='".mysql_real_escape_string($idimagenproducto)."'",$conexion);
		$fila=mysql_fetch_array($resultado);
		
			$imagenproducto['idimagenproducto']=$fila['idimagenproducto'];
			$imagenproducto['producto_idproducto']=$fila['producto_idproducto'];
			$imagenproducto['ruta']=$fila['ruta'];
			$imagenproducto['descripcion']=$fila['descripcion'];
		return $imagenproducto;
	 }
	
	/*
	 * -------------------------------------------------------------------------------------------------------------------------------
	 * --------------------------------------------------------SERVICIOS--------------------------------------------------------------
	 * -------------------------------------------------------------------------------------------------------------------------------
	 */
	 
	/*
	 * Funcion que permite obtener una lista de servicios
	 */
	function getServicios()
	{
		$servicios=array();
		$conexion= conectar();
		
		$i=0;
		$resultado=mysql_query("SELECT idservicio,nombre,ruta,descripcion,fechacreacion FROM servicio",$conexion);
		while ($fila=mysql_fetch_array($resultado))
		{
			$servicios[$i]['idservicio']=$fila['idservicio'];
			$servicios[$i]['nombre']=$fila['nombre'];
			$servicios[$i]['ruta']=$fila['ruta'];
			$servicios[$i]['descripcion']=$fila['descripcion'];
			$servicios[$i]['fechacreacion']=$fila['fechacreacion'];
			$i++;
		}
				
		return $servicios;
	}
	
	/*
	 * Funcion que permite obtener informacion de un servicio
	 */
	function getInformacionServicio($idservicio)
	{
		$servicio=array();
		$conexion= conectar();
		
		$resultado=mysql_query("SELECT idservicio,nombre,ruta,descripcion,fechacreacion FROM servicio WHERE idservicio='".mysql_real_escape_string($idservicio)."'",$conexion);
		$fila=mysql_fetch_array($resultado);
		
			$servicio['idservicio']=$fila['idservicio'];
			$servicio['nombre']=$fila['nombre'];
			$servicio['ruta']=$fila['ruta'];
			$servicio['descripcion']=$fila['descripcion'];
			$servicio['fechacreacion']=$fila['fechacreacion'];
			
		return $servicio;
	}
	
	/*
	 * Funcion que permite obtener las imagenes asociadas a un servicio.
	 */ 
	function getImagenesServicio($idservicio)
	{
		$imagenesservicio=array();
		$conexion= conectar();
		
		$resultado=mysql_query("SELECT idimagenservicio, ruta, descripcion FROM  imagenservicio 
		WHERE servicio_idservicio='".mysql_real_escape_string($idservicio)."'",$conexion);
		
		$i=0;
		while ($fila=mysql_fetch_array($resultado))
		{
		
			$imagenesservicio[$i]['idimagenservicio']=$fila['idimagenservicio'];
			$imagenesservicio[$i]['ruta']=$fila['ruta'];
			$imagenesservicio[$i]['descripcion']=$fila['descripcion'];
			$i++;
		}	
		return $imagenesservicio;
	}
	
	/*
	 * -------------------------------------------------------------------------------------------------------------------------------
	 * ------------------------------------------------------IMAGENES SERVICIOS-------------------------------------------------------
	 * -------------------------------------------------------------------------------------------------------------------------------
	 */
	 
	 /*
	  * Funcion que permite obtener la información asociada una imagen de un servicio.
	  */ 
	 function getInformacionImagenServicio($idimagenservicio)
	 {
		$imagenservicio=array();
		$conexion= conectar();
		
		$resultado=mysql_query("SELECT idimagenservicio,servicio_idservicio,ruta,descripcion FROM imagenservicio WHERE idimagenservicio='".mysql_real_escape_string($idimagenservicio)."'",$conexion);
		$fila=mysql_fetch_array($resultado);
		
			$imagenservicio['idimagenservicio']=$fila['idimagenservicio'];
			$imagenservicio['servicio_idservicio']=$fila['servicio_idservicio'];
			$imagenservicio['ruta']=$fila['ruta'];
			$imagenservicio['descripcion']=$fila['descripcion'];
		return $imagenservicio;
	 }
	
	/*
	 * -------------------------------------------------------------------------------------------------------------------------------
	 * ------------------------------------------------------------USUARIOS-----------------------------------------------------------
	 * -------------------------------------------------------------------------------------------------------------------------------
	 */
	 
	/*
	 * Funcion que permite obtener una lista de usuarios
	 */
	function getUsuarios()
	{
		$usuarios=array();
		$conexion= conectar();
		
		$i=0;
		$resultado=mysql_query("SELECT idusuario,nombre,apellido FROM usuario",$conexion);
		while ($fila=mysql_fetch_array($resultado))
		{
			$usuarios[$i]['idusuario']=$fila['idusuario'];
			$usuarios[$i]['nombre']=$fila['nombre'];
			$usuarios[$i]['apellido']=$fila['apellido'];
			$i++;
		}
				
		return $usuarios;
	}
	
	/*
	 * Funcion que permite obtener informacion de un usuario
	 */
	function getInformacionUsuario($idusuario)
	{
		$usuario=array();
		$conexion= conectar();
		
		$resultado=mysql_query("SELECT idusuario,tipo_idtipo,nombre,apellido,fechacreacion FROM usuario WHERE idusuario='".mysql_real_escape_string($idusuario)."'",$conexion);
		$fila=mysql_fetch_array($resultado);
		
			$usuario['idusuario']=$fila['idusuario'];
			$usuario['tipo_idtipo']=$fila['tipo_idtipo'];
			$usuario['nombre']=$fila['nombre'];
			$usuario['apellido']=$fila['apellido'];
			$usuario['fechacreacion']=$fila['fechacreacion'];
			
		return $usuario;
	}
	
	/*
	 * -------------------------------------------------------------------------------------------------------------------------------
	 * --------------------------------------------------------CLIENTES---------------------------------------------------------------
	 * -------------------------------------------------------------------------------------------------------------------------------
	 */
	 
	 /*
	 * Funcion que permite obtener todos los clientes.
	 */
	 function getClientes(){
	 	$clientes=array();
		$conexion=conectar();
		
		$resultado=mysql_query("SELECT * FROM cliente");
		$i=0;
		while($fila=mysql_fetch_array($resultado)){
			$clientes[$i]['idcliente']=$fila['idcliente'];
			$clientes[$i]['nombre']=$fila['nombre'];
			$clientes[$i]['ruta']=$fila['ruta'];
			$i++;
		}
		return $clientes;		
	 }
?>