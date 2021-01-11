create table atributos(
    id int not null auto_increment,
    nombre varchar(30) not null,
    noserie varchar(10),
    costo float(10) not null,
    descripcion varchar(50),
    rutaimagen varchar(20),
    CONSTRAINT pk_producto
    PRIMARY KEY(id)
)Engine="InnoDB";

INSERT INTO  atributos (nombre,noserie,costo,descripcion,rutaimagen) VALUES('Iphone 12',2002,30000,'El iPhone 12 de 6.1 pulgadas es un sucesor del iPhone 11','assets/img/telefonos/iphone12.jpg');

INSERT INTO  atributos (nombre,noserie,costo,descripcion,rutaimagen) VALUES('Redmi Note 8 Pro',2005,3500,'El primer smartphone en España con cuádruple cámara de 64 MP','assets/img/telefonos/redminote8pro.jpg');
