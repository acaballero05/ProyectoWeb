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
                        <a href="#inicio">Inicio</a>
                    </li>
                    <li>
                        <a href="#login">Ingresar</a>
                    </li>
                    <li>
                        <a href="#contact">Contactenos</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="box">
        <div class="col-lg-12">
            <hr>
            <div class="nuevousuario">
                
                <h1 class="intro-text text-center">Bienvenido
                    <strong>Nuevo usuario</strong>
                </h1>
                <hr>
                <div class="col-md-4 col-md-offset-4">
                    <form ng-submit="addUser()">
                        <input type="text" ng-model="nombre" class="form-control" placeholder="Nombre" required autofocus>
                        <br>
                        <input type="email" ng-model="correo" class="form-control" placeholder="Correo" required>
                        <br>
                        <input type="number" ng-model="cedula" class="form-control" placeholder="Cedula" required >
                        <br>
                        <input type="number" ng-model="telefono" class="form-control" placeholder="Teléfono" required>
                        <br>
                        <input type="text" ng-model="usuario" class="form-control" placeholder="Usuario" required>
                        <br>
                        <input type="password" ng-model="contrasena" class="form-control" placeholder="Contraseña" required>
                        <br>
                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Registrar">
                    </form>
                    <br>
                    <button class="btn btn-lg btn-warning btn-block botonregistrado" ng-click="log()">Usuario registrado</button>
                </div>
            </div>
        </div>  
    </div>