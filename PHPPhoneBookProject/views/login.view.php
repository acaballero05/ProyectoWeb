<div class="col-sm-4 col-sm-offset-4 text-center" ng-controller="loginController">

    <form ng-submit="valLog()" class="form-signin">
      <h2 class="form-signin-heading">Iniciar Sesion</h2>
      <label  class="sr-only">Usuario</label>
      <input type="text" ng-model="user" class="form-control" placeholder="Usuario" required autofocus>
      <label class="sr-only">Contraseña</label>
      <input type="password" ng-model="pass" class="form-control" placeholder="Contraseña" required><br>
      <label ng-show="error">Error en el usuario o contraseña</label>
      <button class="btn btn-lg btn-primary btn-block">Ingesar</button>
    </form>

  </div> <!-- /container -->