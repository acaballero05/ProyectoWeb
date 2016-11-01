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

<div class="container">

    <div class="box">
        <button class="btn btn-default pull-right" ng-click="logout()">Cerrar Sesión</button>
        <div class="col-lg-12">
            <div class="nuevousuario">
                <h1 class="intro-text text-center">Bienvenido
                    <strong>Seleccione Fecha</strong>
                </h1>
                <hr>
                <div class="col-md-4 col-md-offset-4">
                    <form>
                        <input type="text" ng-model="fecha" class="form-control" placeholder="Fecha" required autofocus>
                        <br>
                        <select class="form-control" ng-model="Hora" required>
                            <option value="5">5 PM</option>
                            <option value="6">6 PM</option>
                            <option value="7">7 PM</option>
                            <option value="8">8 PM</option>
                            <option value="9">9 PM</option>
                            <option value="10">10 PM</option>
                            <option value="11">11 PM</option>
                        </select>
                        <br>
                        <button class="btn btn-info"  ng-click="getMesa(fecha,Hora)">Consultar</button>
                    </form>
                </div>
            </div>
        </div>  
    </div>


<div class="box">
    
    <h1 class="intro-text text-center">listado de <strong>Mesas</strong></h1>
    <hr>
    <div class="form-group">
            <table class="table" ng-table="tableParams" ng-form="tableForm" >
                <tr class="table-list" ng-repeat="mesa in mesas" ng-form="mesaForm">
                    <td title="'Mesa'" filter="{Codigo: 'number'}" sortable="'Codigo'"  ng-form="Codigo" >
                        <span  class="editable-text">Mesa número {{mesa.Codigo}}</span>
                    </td>
                    <td title="'Capacidad'" filter="{Capacidad: 'number'}" sortable="'Capacidad'" ng-form="Capacidad" >
                        <span class="editable-number">{{mesa.Capacidad}}</span>
                    </td>                    
                    <td>
                        <button class="btn btn-success" ng-click="save(mesa)" value="Reservar">Reservar</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="box">
    
    <h1 class="intro-text text-center">listado de <strong>Mesas</strong></h1>
    <hr>
    <div class="col-md-4 col-md-offset-4">
    <div class="form-group">
        <input type="text" ng-model="fecha" class="form-control" placeholder="Fecha" required autofocus>
        <span  class="editable-text">Ocupacion del restaurante {{ocupacion}}</span><br>                  
        <button class="btn btn-success" ng-click="getocupacion(fecha)" value="Reservar">Reservar</button>
    </div>
    </div>
</div>