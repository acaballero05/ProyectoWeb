<?php

//URl de la app, modificarlo de acuerdo a la ruta de navegación real de la app
define('URL','http://localhost:8080/proyectoweb/');
class LayoutController {
	/**
	 *
	 * @var array
	 */
	public $data;
	
	/* Metodo que carga la vista correcta de acuerdo a los datos recibidos */
	/* path: url de la vista, $ data arreglo con informacion para la pagina */
	/* Ejm index llama a este metodo */
	public function view($path, $data = NULL) {
		
		/* isset revisa que hallan valores definidos en la variable $data */
		if (isset ( $data )) {
			/*
			 * extract importa las variables recibidas por parametros en la tabla de ejecucion
			 * de php que es donde se guarda para cada variable global su valor asociado
			 */
			extract ( $data );
		}
		
		/* Concatena al path que se recibe la palabra view.php */
		$path .= '.view.php';
		
		/*
		 * Incluye el layout.php. Esta pagina define un template general
		 * y dentro de el incluye el html que se hubiera definido en la ruta $path
		 */
/*<<<<<<< HEAD
		include "/views/layout.php";
=======
		*/include "views/layout.php";/*
>>>>>>> 5087e13f61df33b098bc8368f4b7411c80734881*/
	}
}