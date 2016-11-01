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
        <h1 class="intro-text text-center"><strong>Nuevo Espectáculo</strong></h1>
        <hr>
        <div class="col-md-4 col-md-offset-4">
            <form ng-submit="addEspect()">
                <input type="text" ng-model="nombre" class="form-control" placeholder="Nombre" required autofocus>
                <br>
                <input type="date" ng-model="fecha" class="form-control" placeholder="Fecha" required>
                <br>
                <select class="form-control" ng-model="hora" required>
                    <option value="5">5 PM</option>
                    <option value="6">6 PM</option>
                    <option value="7">7 PM</option>
                    <option value="8">8 PM</option>
                    <option value="9">9 PM</option>
                    <option value="10">10 PM</option>
                    <option value="11">11 PM</option>
                </select>
                <br>
                <input type="number" ng-model="capacidad" class="form-control" placeholder="Capacidad" required>
                <br>
                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Crear">
            </form>
        </div>
    </div>
    </div>
    <div class="box">
    <h1 class="intro-text text-center">listado de <strong>Espectaculos</strong></h1>
    <hr><center>
        <p><input class="btn btn-default" type="button" ng-click="Seleccionar()" ng-model="checkbox" value="Seleccionar todo"> <button class="btn btn-danger" ng-click="eliminar()">Borrar</button> </p>
        </center>
        <div class="form-group">
            <table class="table" ng-table="tableParams" ng-form="tableForm" >
                <tr class="table-list" ng-repeat="espectaculo in $data" ng-form="espectaculoForm">
                    <td title="'Nombre'" filter="{Nombre: 'text'}" sortable="'Nombre'" ng-switch="espectaculo.isEditing" ng-form="Nombre" >
                        <span ng-switch-default class="editable-text">{{espectaculo.Nombre}}</span>
                        <div class="controls" ng-switch-when="true">
                            <input type="text" name="Nombre" ng-model="espectaculo.Nombre" class="editable-input form-control input-sm" required />
                        </div>
                    </td>
                    <td title="'Fecha'" filter="{Fecha: 'text'}" sortable="'Fecha'" ng-switch="espectaculo.isEditing" ng-form="Fecha" >
                        <span ng-switch-default class="editable-text">{{espectaculo.Fecha}}</span>
                        <div class="controls" ng-switch-when="true">
                            <input type="text" name="Fecha" ng-model="espectaculo.Fecha" class="editable-input form-control input-sm" required />
                        </div>
                    </td>
                    <td title="'Hora'" filter="{Hora: 'text'}" sortable="'Hora'" ng-switch="espectaculo.isEditing" ng-form="Hora" >
                        <span ng-switch-default class="editable-text">{{espectaculo.Hora}} PM</span>
                        <div class="controls" ng-switch-when="true">
                            <select class="editable-input form-control input-sm" ng-model="espectaculo.Hora" required>
                                <option value="5">5 PM</option>
                                <option value="6">6 PM</option>
                                <option value="7">7 PM</option>
                                <option value="8">8 PM</option>
                                <option value="9">9 PM</option>
                                <option value="10">10 PM</option>
                                <option value="11">11 PM</option>
                            </select>
                        </div>
                    </td>
                    <td title="'Capacidad'" filter="{Capacidad: 'number'}" sortable="'Capacidad'" ng-switch="espectaculo.isEditing" ng-form="Capacidad" >
                        <span ng-switch-default class="editable-number">{{espectaculo.Capacidad}}</span>
                        <div class="controls" ng-switch-when="true">
                            <input type="number" name="Capacidad" ng-model="espectaculo.Capacidad" class="editable-input form-control input-sm" required />
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" ng-click="save(espectaculo)" disabled ng-if=" espectaculo.isEditing" ng-if="espectaculo.isEditing" ng-disabled="espectaculoForm.$pristine || espectaculoForm.$invalid"><span class="glyphicon glyphicon-ok"></span></button>
                        <button class="btn btn-default btn-sm" ng-click="cancel(espectaculo)" ng-if="espectaculo.isEditing"><span class="glyphicon glyphicon-remove"></span></button>
                        <button class="btn btn-default btn-sm" ng-click="espectaculo.isEditing = true" ng-if="today<espectaculo.Fecha &&!espectaculo.isEditing"><span class="glyphicon glyphicon-pencil"></span></button>
                    </td>
                    <td><input type="checkbox" ng-model="espectaculo.checkbox" ></td>
                </tr>
            </table>
        </div>
    </div>
</div>