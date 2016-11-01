/* Angular interaction modified from http://www.albertcoronado.com/2014/06/17/ejemplo-de-uso-de-angularjs-php/comment-page-1/
 */
var app = angular.module('phoneBookApp', []);

app.controller("phoneBookController", [ '$scope', '$http',
//http es un servicio de angular que facilita la comunicación con HTTP remoto
   function($scope, $http) {
	
	$scope.contacts = [];

	$http.get('controllers/ContactsApi.php').success(function(data) {
		$scope.contacts = data;
		console.log(data);
	}).error(function(data) {
		console.log('Error: ' + data);
	});

	$scope.addNom = function() {
		//Se completará en clase. 
		$http.post('controllers/ContactsApi.php', {
			op : 'append',
			nom : $scope.nom,
			phone : $scope.phone
		}).success(function(data) {
			$scope.contacts = data;
			console.log(data);
		}).error(function(data) {
			console.log('Error: ' + data);
		});
		//Incluya el codigo para limpiar los campos 

	}

	$scope.delNom = function(nom) {
		if (confirm("Seguro?")) {
			$http.post('controllers/ContactsApi.php', {
				op : 'delete',
				nom : nom
			}).success(function(data) {
				$scope.contacts = data;
				console.log(data);
			}).error(function(data) {
				console.log('Error: ' + data);
			});
			//Completelo tomando de referencia el de adicionar
			// dentro de los parametros solo debe enviar op y nom
		}
	}
	
	
}

]);
