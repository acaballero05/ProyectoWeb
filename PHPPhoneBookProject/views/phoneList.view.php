<div class="panel panel-primary" ng-controller="phoneBookController">

	<!-- Poner aqui un panel que tenga el titulo -->

	<div class="panel-body">
		<div class="col-sm-8 col-sm-offset-2 text-center">
			<form action="" ng-submit="addNom()">
				<div class="form-group">
					<input class="form-control" type="text" placeholder="Name" ng-model="name" required>
				</div>
				<div class="form-group">
					<input class="form-control" type="text" placeholder="Phone" ng-model="phone" required>
				</div>
				<div class="form-group">
					<input class="form-control" type="text"	placeholder="Cellphone number" ng-model="cellphone" required>
				</div>
				<div class="form-group">
					<input class="form-control" type="email" placeholder="Email" ng-model="email" required>
				</div>
				<div class="text-right">
					<div class="form-group ">
						<button class="btn btn-lg btn-info btn-block ">Add</button>
					</div>
				</div>
			</form>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h2 class="panel-title">Contacts</h2>
				</div>

				<p>Seleccionar todos <input type="checkbox" ng-click="Seleccionar()" ng-model="checkbox"></p> 
				<div class="form-group">
					<table class="table" ng-table="tableParams" ng-form="tableForm" >
						<tr class="table-list" ng-repeat="contact in $data" ng-form="contactForm" >
							<td title="'Name'" filter="{name: 'text'}" sortable="'name'" ng-switch="contact.isEditing" ng-form="name" >
								<span ng-switch-default class="editable-text">
									{{contact.name}}
								</span>
								<div class="controls"  ng-switch-when="true">
					              	<input type="text" name="name" ng-model="contact.name" class="editable-input form-control input-sm" required />
					            </div>
							</td>
							<td title="'Phone'" filter="{phone: 'text'}" sortable="'phone'" ng-switch="contact.isEditing" ng-form="name" >
								<span ng-switch-default class="editable-text">
									{{contact.phone}}
								</span>
								<div class="controls"  ng-switch-when="true">
					              	<input type="text" name="phone" ng-model="contact.phone" class="editable-input form-control input-sm" required />
					            </div>
							</td>
							<td title="'Cellphone'" filter="{cellphone: 'text'}" sortable="'cellphone'" ng-switch="contact.isEditing" ng-form="name" d>
								<span ng-switch-default class="editable-text">
									{{contact.cellphone}}
								</span>
								<div class="controls"  ng-switch-when="true">
					              	<input type="text" name="cellphone" ng-model="contact.cellphone" class="editable-input form-control input-sm" required />
					            </div>
							</td>
							<td title="'Email'" filter="{email: 'text'}" sortable="'email'" ng-switch="contact.isEditing" ng-form="name">
								<span ng-switch-default class="editable-text">
									{{contact.email}}
								</span>
								<div class="controls"  ng-switch-when="true">
					              	<input type="email" name="email" ng-model="contact.email" class="editable-input form-control input-sm" required />
					            </div>

							</td>
							<td>
					            <button class="btn btn-primary btn-sm" ng-click="save(contact)" ng-if="contact.isEditing" ng-disabled="contactForm.$pristine || contactForm.$invalid"><span class="glyphicon glyphicon-ok"></span></button>
					            <button class="btn btn-default btn-sm" ng-click="cancel(contact)" ng-if="contact.isEditing"><span class="glyphicon glyphicon-remove"></span></button>
					            <button class="btn btn-default btn-sm" ng-click="contact.isEditing = true" ng-if="!contact.isEditing"><span class="glyphicon glyphicon-pencil"></span></button>
					        </td>
							<td><input type="checkbox" ng-model="contact.checkbox" ></td>

						</tr>
					</table>
				</div>
				
				<!-- Aqui se iterara sobre la lista de contactos -->
				<!--  Adicione un div con la directiva ng-repeat en la que itere el arreglo contacts -->
				<!-- Muestre el name, y el phone de cada contacto que itere -->
			</div>
			<div class="text-right">
				<div class="form-group ">
					<button class="btn btn-lg btn-info btn-block " ng-click="eliminar() " >Delete</button>
				</div>
			</div>
			<div class="text-right">
				<div class="form-group " >
					<button class="btn btn-lg btn-info btn-block " ng-click="logOut()">Logout </button>
				</div>
			</div>
		</div>
	</div>
</div>