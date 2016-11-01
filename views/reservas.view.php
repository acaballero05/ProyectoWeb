    <nav class="navbar navbar-default" role="navigation">

        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">Business Casual</a>
            </div>


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#espectaculo">Espectaculos</a>
                    </li>
                    <li>
                        <a href="#mesa">Mesas</a>
                    </li>
                    <li>
                        <a href="#nuevoUsuario">Usuarios</a>
                    </li>
                    <li>
                        <a href="#reservas">Reservas</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="box">
        <button class="btn btn-default pull-right" ng-click="logout()">Cerrar Sesión</button>
    <h1 class="intro-text text-center">listado de <strong>Reservas</strong></h1>
    <hr><center>
        <p><input class="btn btn-default" type="button" ng-click="Seleccionar()" ng-model="checkbox" value="Seleccionar todo"> <button class="btn btn-danger" ng-click="eliminar()">Borrar</button> </p>
        </center>
        <div class="form-group">
            <table class="table" ng-table="tableParams" ng-form="tableForm" >
                <tr class="table-list" ng-repeat="reserva in $data" ng-form="reservaForm">
                    <td title="'Espectaculo'" filter="{espectaculo: 'text'}" sortable="'espectaculo'" ng-switch="reserva.isEditing" ng-form="espectaculo" >
                        <span ng-switch-default class="editable-text">{{reserva.Nombre}}</span>
                    </td>
                    <td title="'Fecha'" filter="{fecha: 'text'}" sortable="'fecha'" ng-switch="reserva.isEditing" ng-form="fecha" >
                        <span ng-switch-default class="editable-text">{{reserva.fecha}}</span>
                    </td>
                    <td title="'Hora'" filter="{hora: 'text'}" sortable="'hora'" ng-switch="reserva.isEditing" ng-form="hora" >
                        <span ng-switch-default class="editable-text">{{reserva.hora}}</span>
                    </td>
                    <td title="'Mesa'" filter="{mesa: 'number'}" sortable="'mesa'" ng-switch="reserva.isEditing" ng-form="mesa" >
                        <span ng-switch-default class="editable-number">Mesa número {{reserva.mesa}}</span>
                    </td>
                    <td title="'Usuario'" filter="{usuario: 'number'}" sortable="'usuario'" ng-switch="reserva.isEditing" ng-form="usuario" >
                        <span ng-switch-default class="editable-number">{{reserva.Name}}</span> 
                    </td>
                    <td><input type="checkbox" ng-model="reserva.checkbox" ></td>
                </tr>
            </table>
        </div>
    </div>
</div>