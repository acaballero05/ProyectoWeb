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
    <div class="container">
        <h1 class="intro-text text-center"><strong>Nueva Mesa</strong></h1>
        <hr>
        <div class="col-md-4 col-md-offset-4">
            <form ng-submit="addMesa()">
                <input type="number" ng-model="capacidad" class="form-control" placeholder="Capacidad" required>
                <br>
                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Crear">
            </form>
        </div>
    </div>
</div>
<div class="box">
    <h1 class="intro-text text-center">listado de <strong>Mesas</strong></h1>
    <hr>
        <center>
        <p><input class="btn btn-default" type="button" ng-click="Seleccionar()" ng-model="checkbox" value="Seleccionar todo"> <button class="btn btn-danger" ng-click="eliminar()">Borrar</button> </p>
    </center>
        <div class="form-group">
            <table class="table" ng-table="tableParams" ng-form="tableForm" >
                <tr class="table-list" ng-repeat="mesa in $data" ng-form="mesaForm">
                    <td title="'Codigo'" filter="{Codigo: 'number'}" sortable="'Codigo'" ng-switch="mesa.isEditing" ng-form="Codigo" >
                        <span ng-switch-default class="editable-text">{{mesa.Codigo}}</span>
                        <div class="controls" ng-switch-when="true">
                            <input type="text" disabled name="Codigo" ng-model="mesa.Codigo" class="editable-input form-control input-sm" required/>
                        </div>
                    </td>
                    <td title="'Capacidad'" filter="{Capacidad: 'number'}" sortable="'Capacidad'" ng-switch="mesa.isEditing" ng-form="Capacidad" >
                        <span ng-switch-default class="editable-number">{{mesa.Capacidad}}</span>
                        <div class="controls" ng-switch-when="true">
                            <input type="number" name="Capacidad" ng-model="mesa.Capacidad" class="editable-input form-control input-sm" required />
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" ng-click="save(mesa)" ng-if="mesa.isEditing" ng-disabled="mesaForm.$pristine || mesaForm.$invalid"><span class="glyphicon glyphicon-ok"></span></button>
                        <button class="btn btn-default btn-sm" ng-click="cancel(mesa)" ng-if="mesa.isEditing"><span class="glyphicon glyphicon-remove"></span></button>
                        <button class="btn btn-default btn-sm" ng-click="mesa.isEditing = true" ng-if="!mesa.isEditing"><span class="glyphicon glyphicon-pencil"></span></button>
                    </td>
                    <td><input type="checkbox" ng-model="mesa.checkbox" ></td>
                </tr>
            </table>
        </div>
    </div>
</div>