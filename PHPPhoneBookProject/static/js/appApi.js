/* Angular interaction modified from http://www.albertcoronado.com/2014/06/17/ejemplo-de-uso-de-angularjs-php/comment-page-1/
 */
var app = angular.module('phoneBookApp', ['ngTable']);

app.controller("phoneBookController", [ '$scope', '$http',"NgTableParams",
//http es un servicio de angular que facilita la comunicación con HTTP remoto
function($scope, $http, NgTableParams) {

	$scope.contacts = [];
	$scope.tableParams=new NgTableParams();
	$scope.checkbox=false;

	$scope.cancel = function (row) {

		$scope.getContacts();
    }  

    $scope.save = function (row) {
    	$http.post('api.php?x=edit_contact', {
			name : row.name,
			phone : row.phone,
			cellphone : row.cellphone,
			email : row.email,
			id : row.id
		}).success(function(data) {
			$scope.contacts = data;
			console.log(data);
			$scope.getContacts();
		}).error(function(data) {
			console.log('Error: ' + data);
		});
    }
	
	$scope.eliminar2= function (value) {
		if(value.checkbox){
			$scope.delNom(value.id);
		}
	};
	
	$scope.eliminar = function () {
		angular.forEach($scope.contacts, $scope.eliminar2);
	};
	
	
	$scope.getContacts = function(){
		$http.get('api.php?x=allContacts').success(function(data) {
			$scope.contacts = data;
			$scope.tableParams.settings({ dataset: $scope.contacts});
			console.log(data);
		}).error(function(data) {
			console.log('Error: ' + data);
		});
	}

	$scope.addNom = function() {
		//Se completará en clase. 
		$http.post('api.php?x=addContact', {
			name : $scope.name,
			phone : $scope.phone,
			cellphone : $scope.cellphone,
			email : $scope.email
		}).success(function(data) {
			$scope.name='';
			$scope.phone='';
			$scope.cellphone='';
			$scope.email='';
			$scope.contacts = data;
			console.log(data);
			$scope.getContacts();
		}).error(function(data) {
			console.log('Error: ' + data);
		});
		//Incluya el codigo para limpiar los campos 

	}

	$scope.delNom = function(id) {
		//if (confirm("Seguro?")) {
			$http.post('api.php?x=delContact', {
				id: id
			}).success(function(data) {
				$scope.contacts = data;
				console.log(data);
				$scope.getContacts();
			}).error(function(data) {
				console.log('Error: ' + data);
			});
			//Completelo tomando de referencia el de adicionar
			// dentro de los parametros solo debe enviar op y nom
		//}
	}

	$scope.Seleccionar2= function(value,fun){
		if (fun===1){
			value.checkbox=true;
		}
		else{
			value.checkbox=false;
		}
		
	};

$scope.Seleccionar = function () {
		if (!$scope.checkbox) {
			angular.forEach($scope.contacts,function(value,fun){
				$scope.Seleccionar2(value,0);
			});
		}
		else{
			angular.forEach($scope.contacts,function(value,fun){
				$scope.Seleccionar2(value,1);
			});

		}
	};

	$scope.logOut = function() {
		window.location.replace("http://localhost/PHPPhoneBookProject/index.php");
	};

	$scope.getContacts();
		
	
}



]);

app.controller("loginController", [ '$scope', '$http','$location',
//http es un servicio de angular que facilita la comunicación con HTTP remoto
   function($scope, $http) {
   	$scope.error=false;
	

	$scope.valLog = function() {
		$http.post('api.php?x=valLogin', {
			user: $scope.user,
			pass: $scope.pass 
		}).success(function(data) {
			$scope.contacts = data;
			console.log(data);
			console.log('bien');
			window.location.replace("http://localhost/PHPPhoneBookProject/index2.php");
		}).error(function(data) {
			$scope.error=true;
			console.log('mal');
			console.log('Error: ' + data);
		});		
	};

	
}
]);