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
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="box">
        <div class="col-lg-12">
            <hr>
            
            <div class="registrado">
                 <h1 class="intro-text text-center">Bienvenido
                    <strong>Iniciar Sesión</strong>
                </h1>
                <hr>
                <div class="col-md-4 col-md-offset-4">
                    <form ng-submit="valUser()">        
                        <input type="text" class="form-control" placeholder="Usuario" ng-model="usuario" required>
                        <br>
                        <input type="password" class="form-control" placeholder="Contraseña" ng-model="contrasena" required>
                        <br>
                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Ingresar">
                    </form>
                    <br>
                    <button class="btn btn-lg btn-warning btn-block botonnuevo" ng-click="regis()">Nuevo usuario</button>
                </div>
            </div>
        </div>  
    </div>
    
