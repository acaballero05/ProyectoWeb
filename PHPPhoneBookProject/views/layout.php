<!doctype html>
<html ng-app="phoneBookApp">
<head>
<title>Contacts phonebook by</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://rawgit.com/esvit/ng-table/master/dist/ng-table.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
<script src="https://rawgit.com/esvit/ng-table/master/dist/ng-table.min.js"></script>

	<script src="<?php echo URL; ?>/static/js/appApi.js"></script></script>
<!-- Incorporar el llamado a la app que controla el angular -->

</head>
<body>
<!-- Barra de navegacion -->
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">PhoneBook</a>
			</div>

		</div>

	</nav>

	<div class="container">
	<?php include_once $path;?>
	<!-- Incorporar aqui el llamado a la vista que corresponde -->
	</div>
	<footer>
		<h5 class="text-center">@ Desarrollo y servicios web 2015</h5>
	</footer>

</body>
</html>
