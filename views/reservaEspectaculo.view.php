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
                        <a href="#inicio2">Inicio</a>
                    </li>
                    <li>
                        <a href="#reservaEspectaculo">Espectáculos</a>
                    </li>
                    <li>
                        <a href="#reservaMesa">Mesas</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="box">
        <button class="btn btn-default pull-right" ng-click="logout()">Cerrar Sesión</button>
        <h1 class="intro-text text-center">Buscar espectáculo <strong>por fecha</strong></h1>
    <hr>
    <div class="col-md-4 col-md-offset-4">
        <input type="text" class="form-control" ng-model="Inicio" placeholder="Fecha Inicio"><br>
        <input type="text" class="form-control" ng-model="Fin" placeholder="Fecha Fin"><br>
        <button class="btn btn-success" ng-click="getRango(Inicio,Fin)" value="Buscar">Buscar</button>
    </div>
    <div class="form-group">
        <table class="table" ng-table="tableRango" ng-form="tableForm" >
            <tr class="table-list" ng-repeat="espectaculo in $data" ng-form="espectaculoForm">
                <td title="'Nombre'" filter="{Nombre: 'text'}" sortable="'Nombre'" ng-form="Nombre" >
                    <span class="editable-text">{{espectaculo.Nombre}}</span>
                </td>
                <td title="'Fecha'" filter="{Fecha: 'text'}" sortable="'Fecha'" ng-form="Fecha" >
                    <span class="editable-text">{{espectaculo.Fecha}}</span>
                </td>
                <td title="'Hora'" filter="{Hora: 'text'}" sortable="'Hora'" ng-form="Hora" >
                    <span class="editable-text">{{espectaculo.Hora}}</span>
                </td>
                <td title="'Disponibilidad'" filter="{Capacidad: 'number'}" sortable="'Capacidad'" ng-form="Capacidad" >
                    <span  class="editable-number">{{espectaculo.Capacidad-espectaculo.Ocupacion}}</span>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="box">
    
    <h1 class="intro-text text-center">listado de <strong>Espectaculos</strong></h1>
    <hr>
    <div class="form-group">
        <table class="table" ng-table="tableParams" ng-form="tableForm" >
            <tr class="table-list" ng-repeat="espectaculo in $data" ng-form="espectaculoForm">
                <td title="'Nombre'" filter="{Nombre: 'text'}" sortable="'Nombre'" ng-form="Nombre" >
                    <span class="editable-text">{{espectaculo.Nombre}}</span>
                </td>
                <td title="'Fecha'" filter="{Fecha: 'text'}" sortable="'Fecha'" ng-form="Fecha" >
                    <span class="editable-text">{{espectaculo.Fecha}}</span>
                </td>
                <td title="'Hora'" filter="{Hora: 'text'}" sortable="'Hora'" ng-form="Hora" >
                    <span class="editable-text">{{espectaculo.Hora}} PM</span>
                </td>
                <td title="'Disponibilidad'" filter="{Capacidad: 'number'}" sortable="'Capacidad'" ng-form="Capacidad" >
                    <span  class="editable-number">{{espectaculo.Capacidad-espectaculo.Ocupacion}}</span>
                </td>
                <td>
                    <button class="btn btn-danger" disabled ng-if="(espectaculo.Capacidad-espectaculo.Ocupacion)==0">Consultar</button>
                    <button class="btn btn-info" ng-if="(espectaculo.Capacidad-espectaculo.Ocupacion)>0" ng-click="getMesa(espectaculo, espectaculo.Fecha,espectaculo.Hora)">Consultar</button>
                </td> 
                <td>
                    <button class="btn btn-danger" disabled ng-if="(espectaculo.Capacidad-espectaculo.Ocupacion)==0">Reservar sin mesa</button>
                    <button class="btn btn-warning" ng-if="(espectaculo.Capacidad-espectaculo.Ocupacion)>0" ng-click="save_mesa2(espectaculo)">Reservar sin mesa</button>
                </td>                    
            </tr>
        </table>
    </div>
    <br>
    <br>
    <h1 class="intro-text text-center">listado de <strong>mesas</strong></h1>
    <hr>
        <div class="form-group">
            <table class="table" ng-table="tableMesas" ng-form="tableForm" >
            <tr class="table-list" ng-repeat="mesa in mesas" ng-form="espectaculoForm">
                    <td title="'Número'" filter="{Numero: 'number'}" sortable="'Numero'" ng-form="Numero" >
                        <span class="editable-text">{{mesa.Codigo}}</span>
                    </td>
                    <td title="'Capacidad'" filter="{Capacidad: 'number'}" sortable="'Capacidad'" ng-form="Capacidad" >
                        <span class="editable-text">{{mesa.Capacidad}}</span>
                    </td>
                    <td>
                        <button class="btn btn-success" ng-click="save_mesa(espect.Codigo,espect.Fecha,espect.Hora,mesa.Codigo)">Reservar</button>
                    </td>                    
                </tr>
            </table>
        </div>
</div>

