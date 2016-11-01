<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Business Casual</a>
        </div>
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
    </div>
</nav>

<div class="box">
    <button class="btn btn-default pull-right" ng-click="logout()">Cerrar Sesión</button>
    <div class="container">
        <h1 class="intro-text text-center"><strong>Nuevo Usuario</strong></h1>
        <hr>
        <div class="col-md-4 col-md-offset-4">
            <form ng-submit="addUsuario()">
                <input type="text" ng-model="nombre" class="form-control" placeholder="Nombre" required autofocus>
                <br>
                <input type="email" ng-model="correo" class="form-control" placeholder="Correo" required>
                <br>
                <input type="number" ng-model="cedula" class="form-control" placeholder="Cedula" required >
                <br>
                <input type="text" ng-model="telefono" class="form-control" placeholder="Teléfono" required>
                <br>
                <input type="text" ng-model="usuario" class="form-control" placeholder="Usuario" required>
                <br>
                <input type="password" ng-model="contrasena" class="form-control" placeholder="Contraseña" required>
                <br>
                <select class="form-control">
                    <option value="Administrador">Administrador</option>
                    <option value="Usuario">Usuario</option>
                </select>
                <br>
                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Registrar">
            </form>
            <br>
        </div>
    </div>
</div>

<div class="box">
    <h1 class="intro-text text-center">listado de <strong>usuarios</strong></h1>
    <hr>
    <center>
        <input class="btn btn-default" type="button" ng-click="Seleccionar()" ng-model="checkbox" value="Seleccionar todo"> <button class="btn btn-danger" ng-click="eliminar()">Borrar</button>
    </center>
    <div class="form-group">
        <table class="table" ng-table="tableParams" ng-form="tableForm" >
            <tr class="table-list" ng-repeat="usuario in $data" ng-form="usuarioForm">
                <td title="'Cedula'" filter="{Cedula: 'text'}" sortable="'Cedula'" ng-switch="usuario.isEditing" ng-form="Cedula" >
                    <span ng-switch-default class="editable-text">{{usuario.Cedula}}</span>
                    <div class="controls" ng-switch-when="true">
                        <input type="text" disabled ng-model="usuario.Cedula" class="editable-input form-control input-sm" required/>
                    </div>
                </td>
                <td title="'Nombre'" filter="{Nombre: 'text'}" sortable="'Nombre'" ng-switch="usuario.isEditing" ng-form="Nombre" >
                    <span ng-switch-default class="editable-text">{{usuario.Nombre}}</span>
                    <div class="controls" ng-switch-when="true">
                        <input type="text" ng-model="usuario.Nombre" class="editable-input form-control input-sm" required/>
                    </div>
                </td>
                <td title="'Correo'" filter="{Correo: 'text'}" sortable="'Correo'" ng-switch="usuario.isEditing" ng-form="Correo" >
                    <span ng-switch-default class="editable-text">{{usuario.Correo}}</span>
                    <div class="controls" ng-switch-when="true">
                        <input type="email" ng-model="usuario.Correo" class="editable-input form-control input-sm" required/>
                    </div>
                </td>
                <td title="'Teléfono'" filter="{Telefono: 'text'}" sortable="'Telefono'" ng-switch="usuario.isEditing" ng-form="Telefono" >
                    <span ng-switch-default class="editable-text">{{usuario.Telefono}}</span>
                    <div class="controls" ng-switch-when="true">
                        <input type="text" ng-model="usuario.Telefono" class="editable-input form-control input-sm" required/>
                    </div>
                </td>
                <td title="'Tipo'" filter="{Tipo: 'text'}" sortable="'Tipo'" ng-switch="usuario.isEditing" ng-form="Tipo" >
                    <span ng-switch-default class="editable-text">{{usuario.Tipo}}</span>
                    <div class="controls" ng-switch-when="true">
                        <input type="text" ng-model="usuario.Tipo" class="editable-input form-control input-sm" required/>
                    </div>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" ng-click="save(usuario)" ng-if="usuario.isEditing" ng-disabled="mesaForm.$pristine || mesaForm.$invalid"><span class="glyphicon glyphicon-ok"></span></button>
                    <button class="btn btn-default btn-sm" ng-click="cancel(usuario)" ng-if="usuario.isEditing"><span class="glyphicon glyphicon-remove"></span></button>
                    <button class="btn btn-default btn-sm" ng-click="usuario.isEditing = true" ng-if="!usuario.isEditing"><span class="glyphicon glyphicon-pencil"></span></button>
                </td>
                <td>
                    <input type="checkbox" ng-model="usuario.checkbox">
                </td>
            </tr>
        </table>
    </div>
</div>