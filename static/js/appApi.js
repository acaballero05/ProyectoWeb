var app = angular.module('myApp', ['ngTable','ngRoute']);

app.config(['$routeProvider', function($routeProvider) {
	 $routeProvider.when('/inicio', {
    templateUrl: "views/inicio.view.php"
  });

  $routeProvider.when('/inicio2', {
    templateUrl: "views/inicio2.view.php",
    controller: ""
  });	 
  
  $routeProvider.when('/login', {
    templateUrl: "views/login.view.php",
    controller: "loginController"
  });

  $routeProvider.when('/reservas', {
    templateUrl: "views/reservas.view.php",
    controller: "reservaController"
  });

  $routeProvider.when('/reservaEspectaculo', {
    templateUrl: "views/reservaEspectaculo.view.php",
    controller: "espectaculoController"
  });

  $routeProvider.when('/reservaMesa', {
    templateUrl: "views/reservaMesa.view.php",
    controller: "reservaMesaController"
  });


  $routeProvider.when('/registro', {
    templateUrl: "views/registrar.view.php",
    controller: "registroController"
  });

  $routeProvider.when('/espectaculo', {
    templateUrl: "views/espectaculos.view.php",
    controller: "espectaculoController"
  });

  $routeProvider.when('/reservaespectaculo', {
    templateUrl: "views/reservaEspectaculo.view.php",
    controller: "espectaculoController"
  });

  $routeProvider.when('/mesa', {
    templateUrl: "views/mesas.view.php",
    controller: "mesaController"
  });
  $routeProvider.when('/nuevoUsuario', {
    templateUrl: "views/creandoUser.view.php",
    controller: "usuarioController"
  });

  $routeProvider.otherwise({
        redirectTo: '/inicio'
  });   
}]);

app.controller("espectaculoController", [ '$scope', '$http', "NgTableParams",'$window','$location',
//http es un servicio de angular que facilita la comunicación con HTTP remoto
function($scope, $http, NgTableParams,$window,$location) {

	$scope.espectaculos = [];
	$scope.mesas=[];
	$scope.especrango = [];
	$scope.tableParams=new NgTableParams();
	$scope.tableRango=new NgTableParams();
	$scope.tableMesas=new NgTableParams();
	$scope.checkbox=true;
	$scope.espect=0;
	
	$scope.today = new Date();
	$scope.dd = $scope.today.getDate();
	$scope.mm = $scope.today.getMonth()+1; //January is 0!
	$scope.yyyy = $scope.today.getFullYear();
	$scope.today=$scope.yyyy+'-'+$scope.mm+'-'+$scope.dd;

	$scope.cancel = function(row) {
		$scope.getEspect();
    }  

    $scope.save = function(row) {
    	$http.post('api.php?x=edit_espect', {
			Nombre : row.Nombre,
			Fecha : row.Fecha,
			Hora : row.Hora,
			Capacidad : row.Capacidad,
			Ocupacion : row.Ocupacion,
			Codigo : row.Codigo,
		}).success(function(data) {
			$scope.espectaculos = data;
			console.log(data);
			$scope.getEspect();
		}).error(function(data) {
			console.log('Error: ' + data);
		});
    }

    $scope.save_mesa = function(codigo, fecha, hora, mesa) {
    	$http.post('api.php?x=reserve_espect', {
			Espectaculo : codigo,
			Fecha : fecha,
			Hora : hora,	
			Mesa : mesa
			//Capacidad : capacidad
		}).success(function(data) {
			$scope.espectaculos = data;
			console.log(data);
			$scope.getEspect();
			alert('Reserva hecha satisfactoriamente');
		}).error(function(data) {
			console.log('Error: ' + data);
		});
    }

    $scope.save_mesa2 = function(row) {
    	$http.post('api.php?x=reserve_espect2', {
			Codigo : row.Codigo,
			Fecha : row.Fecha,
			Hora : row.Hora
		}).success(function(data) {
			$scope.espectaculos = data;
			console.log(data);
			$scope.getEspect();
		}).error(function(data) {
			console.log('Error: ' + data);
		});
    }
	
	$scope.eliminar2 = function (value) {
		if(value.checkbox){
			$scope.delEspect(value.Codigo);
		}
	};
	
	$scope.eliminar = function () {
		if (confirm("Seguro?")) {
			angular.forEach($scope.espectaculos, $scope.eliminar2);
		}
	};

	$scope.Seleccionar2 = function(value,fun){
		if (fun===1){
			value.checkbox=true;
		}
		else{
			value.checkbox=false;
		}
	}

	$scope.Seleccionar = function () {
		if (!$scope.checkbox) {
			angular.forEach($scope.espectaculos,function(value,fun){
				$scope.Seleccionar2(value,0);
				$scope.checkbox=true;
			});
		}
		else{
			angular.forEach($scope.espectaculos,function(value,fun){
				$scope.Seleccionar2(value,1);
				$scope.checkbox=false;
			});
		}
	};

	$scope.getEspect = function(){
		$http.get('api.php?x=allEspect').success(function(data) {
			$scope.espectaculos = data;
			$scope.tableParams.settings({ dataset: $scope.espectaculos});
			console.log(data);
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	};

	$scope.getRango = function(inicio,fin){
		$http.post('api.php?x=allRango', {
			inicio : inicio,
			fin : fin
		}).success(function(data) {
			$scope.espectaculos = data;
			$scope.tableRango.settings({ dataset: $scope.espectaculos});
			console.log(data);
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	};

	$scope.getMesa = function(espectaculo, fecha, hora){
		$scope.espect=espectaculo;
		$http.post('api.php?x=disponibleMesa',{
			Fecha : fecha,
			Hora : hora
		}).success(function(data) {
			$scope.mesas = data;
			$scope.tableMesas.settings({ dataset: $scope.mesas });
			console.log(data);
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	};

	$scope.addEspect = function() {
		$http.post('api.php?x=addEspectaculo', {
			Nombre : $scope.nombre,
			Fecha : $scope.fecha,
			Hora : $scope.hora,
			Capacidad : $scope.capacidad
		}).success(function(data) {
			$scope.nombre='';
			$scope.fecha='';
			$scope.hora='';
			$scope.capacidad='';
			$scope.getEspect();
			console.log(data);
			console.log('Login');
		}).error(function(data) {
			console.log('Error: ');
		});
	};

	$scope.delEspect = function(Codigo) {
		$http.post('api.php?x=deleteEspectaculo', {
			Codigo: Codigo
		}).success(function(data) {
			$scope.espectaculos = data;
			console.log(data);
			$scope.getEspect();
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	}

	$scope.logout = function () {
		$http.get('api.php?x=logout').success(function(data) {
			// Reload page
			$location.path("/inicio");
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	};
	$scope.getEspect();
}
]);




app.controller("reservaController", [ '$scope', '$http', "NgTableParams",'$window','$location',
//http es un servicio de angular que facilita la comunicación con HTTP remoto
function($scope, $http, NgTableParams,$window,$location) {

	$scope.reservas = [];
	$scope.mesas=[];
	$scope.tableParams=new NgTableParams();
	$scope.checkbox=true;

	$scope.cancel = function(row) {
		$scope.getReserva();
    }  
	
	$scope.eliminar2 = function (value) {
		if(value.checkbox){
			$scope.delReserva(value.Codigo);
		}
	};
	
	$scope.eliminar = function () {
		if (confirm("Seguro?")) {
			angular.forEach($scope.reservas, $scope.eliminar2);
		}
	};

	$scope.Seleccionar2 = function(value,fun){
		if (fun===1){
			value.checkbox=true;
		}
		else{
			value.checkbox=false;
		}
	}

	$scope.Seleccionar = function () {
		if (!$scope.checkbox) {
			angular.forEach($scope.reservas,function(value,fun){
				$scope.Seleccionar2(value,0);
				$scope.checkbox=true;
			});
		}
		else{
			angular.forEach($scope.reservas,function(value,fun){
				$scope.Seleccionar2(value,1);
				$scope.checkbox=false;
			});
		}
	};

	$scope.getReserva = function(){
		$http.get('api.php?x=allReserva').success(function(data) {
			$scope.reservas = data;
			$scope.tableParams.settings({ dataset: $scope.reservas});
			console.log(data);
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	};

	$scope.delReserva = function(Codigo) {
		$http.post('api.php?x=deleteReserva', {
			Codigo: Codigo
		}).success(function(data) {
			$scope.reservas = data;
			console.log(data);
			$scope.getReserva();
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	}


	$scope.logout = function () {
		$http.get('api.php?x=logout').success(function(data) {
			// Reload page
			$location.path("/inicio");
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	};
	$scope.getReserva();	
}
]);





app.controller("mesaController", [ '$scope', '$http', "NgTableParams",'$window','$location',
//http es un servicio de angular que facilita la comunicación con HTTP remoto
function($scope, $http, NgTableParams,$window,$location) {

	$scope.mesas = [];
	$scope.tableParams=new NgTableParams();
	$scope.checkbox=true;

	$scope.cancel = function(row) {
		$scope.getMesa();
    }  

    $scope.save = function(row) {
    	$http.post('api.php?x=edit_mesa', {
			Capacidad: row.Capacidad,
			Codigo : row.Codigo
		}).success(function(data) {
			$scope.mesas = data;
			console.log(data);
			$scope.getMesa();
		}).error(function(data) {
			console.log('Error: ' + data);
		});
    }
	
	$scope.eliminar2 = function (value) {
		if(value.checkbox){
			$scope.delMesa(value.Codigo);
		}
	};
	
	$scope.eliminar = function () {
		if (confirm("Seguro?")) {
			angular.forEach($scope.mesas, $scope.eliminar2);
		}
	};

	$scope.Seleccionar2 = function(value,fun){
		if (fun===1){
			value.checkbox=true;
		}
		else{
			value.checkbox=false;
		}
	}

	$scope.Seleccionar = function () {
		if (!$scope.checkbox) {
			angular.forEach($scope.mesas,function(value,fun){
				$scope.Seleccionar2(value,0);
				$scope.checkbox=true;
			});
		}
		else{
			angular.forEach($scope.mesas,function(value,fun){
				$scope.Seleccionar2(value,1);
				$scope.checkbox=false;
			});
		}
	};

	$scope.getMesa = function(){
		$http.get('api.php?x=allMesa').success(function(data) {
			$scope.mesas = data;
			$scope.tableParams.settings({ dataset: $scope.mesas});
			console.log(data);
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	};

	$scope.addMesa = function() {
		$http.post('api.php?x=addMesa', {
			Capacidad : $scope.capacidad
		}).success(function(data) {
			$scope.Capacidad='';
			$scope.getMesa();
			console.log(data);
			console.log('Login');
		}).error(function(data) {
			console.log('Error: ');
		});
	};

	$scope.delMesa = function(Codigo) {
		$http.post('api.php?x=deleteMesa', {
			Codigo: Codigo
		}).success(function(data) {
			$scope.mesas = data;
			console.log(data);
			$scope.getMesa();
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	}

	$scope.logout = function () {
		$http.get('api.php?x=logout').success(function(data) {
			// Reload page
			$location.path("/inicio");
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	};
	$scope.getMesa();
}
]);

app.controller("usuarioController", [ '$scope', '$http', "NgTableParams",'$window','$location',
function($scope, $http, NgTableParams,$window,$location) {

	$scope.usuarios = [];
	$scope.tableParams=new NgTableParams();
	$scope.checkbox=true;

	$scope.cancel = function(row) {
		$scope.getUsuario();
    }

    $scope.save = function(row) {
    	$http.post('api.php?x=edit_usuario', {
			Cedula: row.Cedula,
			Nombre: row.Nombre,
			Correo : row.Correo,
			Telefono : row.Telefono,
			Tipo : row.Tipo
		}).success(function(data) {
			$scope.usuarios = data;
			console.log(data);
			$scope.getUsuario();
		}).error(function(data) {
			console.log('Error: ' + data);
		});
    }

    $scope.eliminar2 = function (value) {
		if(value.checkbox){
			$scope.delUsuario(value.Cedula);
		}
	};
	
	$scope.eliminar = function () {
		if (confirm("Seguro?")) {
			angular.forEach($scope.usuarios, $scope.eliminar2);
		}
	};

	$scope.Seleccionar2 = function(value,fun){
		if (fun===1){
			value.checkbox=true;
		}
		else{
			value.checkbox=false;
		}
	}

	$scope.Seleccionar = function () {
		if (!$scope.checkbox) {
			angular.forEach($scope.usuarios,function(value,fun){
				$scope.Seleccionar2(value,0);
				$scope.checkbox=true;
			});
		}
		else{
			angular.forEach($scope.usuarios,function(value,fun){
				$scope.Seleccionar2(value,1);
				$scope.checkbox=false;
			});
		}
	};

	$scope.getUsuario = function(){
		$http.get('api.php?x=allUsuario').success(function(data) {
			$scope.usuarios = data;
			$scope.tableParams.settings({ dataset: $scope.usuarios});
			console.log(data);
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	};

	$scope.addUsuario = function() {
		$http.post('api.php?x=addUser', {
			Cedula: $scope.cedula,
			Nombre: $scope.nombre,
			Correo : $scope.correo,
			Telefono : $scope.telefono,
			Usuario : $scope.usuario,
			Contrasena : $scope.contrasena,
			Tipo : $scope.tipo
		}).success(function(data) {
			$scope.cedula='';
			$scope.nombre='';
			$scope.correo='';
			$scope.telefono='';
			$scope.usuario='';
			$scope.contrasena='';
			$scope.tipo='';
			$scope.getUsuario();
			console.log(data);
		}).error(function(data) {
			console.log('Error: ');
		});
	};

	$scope.delUsuario = function(Codigo) {
		$http.post('api.php?x=deleteUsuario', {
			Cedula : Codigo
		}).success(function(data) {
			$scope.usuarios = data;
			console.log(data);
			$scope.getUsuario();
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	}

	$scope.logout = function () {
		$http.get('api.php?x=logout').success(function(data) {
			// Reload page
			$location.path("/inicio");
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	};

	$scope.getUsuario();

}
]);

app.controller("reservaMesaController", [ '$scope', '$http', "NgTableParams",'$window','$location',
//http es un servicio de angular que facilita la comunicación con HTTP remoto
function($scope, $http, NgTableParams,$window,$location) {

	$scope.mesas = [];
	$scope.tableParams=new NgTableParams();
	$scope.fecha='';
	$scope.hora='';
	$scope.ocupacion=0;

	$scope.getocupacion = function(fecha){
    	$http.post('api.php?x=getocupacion', {
			Fecha : $scope.fecha
		}).success(function(data) {
			console.log(data);
			$scope.ocupacion=data;
		}).error(function(data) {
			console.log('Error: ' + data);
		});
    }

    $scope.save = function(row) {
    	$http.post('api.php?x=reserva_mesa', {
			Mesa : row.Codigo,
			Fecha : $scope.fecha,
			Hora : $scope.hora
		}).success(function(data) {
			console.log(data);
			$scope.getMesa($scope.fecha, $scope.hora);
			alert("Reserva realizada con éxito");
		}).error(function(data) {
			console.log('Error: ' + data);
			alert("No se pudo hacer la reserva");
		});
    }
	
	$scope.getMesa = function(fecha, hora){
		$http.post('api.php?x=disponibleMesa',{
			Fecha : fecha,
			Hora : hora
		}).success(function(data) {
			$scope.fecha=fecha;
			$scope.hora=hora;
			$scope.mesas = data;
			$scope.tableMesas.settings({ dataset: $scope.mesas });
			console.log(data);
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	};


	$scope.logout = function () {
		$http.get('api.php?x=logout').success(function(data) {
			// Reload page
			$location.path("/inicio");
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	};
}
]);



app.controller("loginController", [ '$scope', '$http','$window','$location',
//http es un servicio de angular que facilita la comunicación con HTTP remoto
function($scope, $http, $window,$location) {

	$scope.regis=function(){
		$location.path("/registro");
	}

	$scope.valUser = function() {
		$http.post('api.php?x=valLogin', {
			Usuario : $scope.usuario,
			Contrasena : $scope.contrasena
		}).success(function(data) {
			if (data.Tipo=="Administrador"){
				$location.path("/espectaculo");
			}
			else{
				$location.path("/reservaespectaculo");
			}
			
			console.log(data);
			console.log('Login');
		}).error(function(data) {
			console.log('Error: ');
		});
	};
}
]);

app.controller("registroController", [ '$scope', '$http','$window','$location',
//http es un servicio de angular que facilita la comunicación con HTTP remoto
function($scope, $http, $window, $location) {

	$scope.log=function(){
		$location.path("/login");
	}

	$scope.addUser = function() {
		$http.post('api.php?x=addUsuario', {
			Nombre : $scope.nombre,
			Cedula: $scope.cedula,
			Correo: $scope.correo,
			Telefono: $scope.telefono,
			Usuario: $scope.usuario,
			Contrasena: $scope.contrasena
		}).success(function(data) {
			$scope.nombre='';
			$scope.cedula='';
			$scope.correo='';
			$scope.telefono='';
			$scope.usuario='';
			$scope.contrasena='';
			console.log(data);
			console.log('Inserto bien');
		}).error(function(data) {
			console.log('Error: ');
		});
	};
}
]);