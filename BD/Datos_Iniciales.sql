create table Usuarios (Cedula int primary key, Nombre varchar(50) not null, Correo varchar(50) not null, Telefono varchar(20) not null, Usuario varchar(50) not null, 
	Contrasena varchar(50) not null, Tipo varchar(13));
create table Mesas (Codigo int primary key auto_increment, Capacidad int not null, Estado varchar(10));
create table Espectaculos (Codigo int primary key auto_increment, Nombre varchar(50) not null, Fecha date not null, Hora time not null, 
	Capacidad int not null, Ocupacion int not null);
create table Reservas (Cliente int not null, Espectaculo int, Mesa int, Fecha date not null, Hora time not null, 
	constraint RESERVAS_F1 foreign key(Cliente) references Usuarios(Cedula), 
	constraint RESERVAS_F2 foreign key(Espectaculo) references Espectaculos(Codigo), 
	constraint RESERVAS_F3 foreign key(Mesa) references Mesas(Codigo));