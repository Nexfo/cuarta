insert into tipohabitacion (id, nombre, nombrePlural, numPlazas, slug) values (1, 'Habitación individual', 'Habitaciones individuales', 1, 'habitaciones-individuales');
insert into tipohabitacion (id, nombre, nombrePlural, numPlazas, slug) values (2, 'Habitación doble', 2, 'Habitaciones dobles', 'habitaciones-dobles');
insert into tipohabitacion (id, nombre, nombrePlural, numPlazas, slug) values (1, 'Habitación suite', 2, 'Habitaciones suites', 'suites');

/* ============================================================================================================ */

insert into habitacion (id, nombre, imagen, precio, tipo_id) values (1, 'Habitación primera', 'h_primera.jpg', 100, 1);
insert into habitacion (id, nombre, imagen, precio, tipo_id) values (2, 'Habitación segunda', 'h_segunda.jpg', 110, 1);
insert into habitacion (id, nombre, imagen, precio, tipo_id) values (3, 'Habitación tercera', 'h_tercera.jpg', 120, 1);

insert into habitacion (id, nombre, imagen, precio, tipo_id) values (4, 'Habitación doble primera', 'h_d_primera.jpg', 150, 2);
insert into habitacion (id, nombre, imagen, precio, tipo_id) values (5, 'Habitación doble segunda', 'h_d_segunda.jpg', 155, 2);
insert into habitacion (id, nombre, imagen, precio, tipo_id) values (6, 'Habitación doble tercera', 'h_d_tercera.jpg', 160, 2);
insert into habitacion (id, nombre, imagen, precio, tipo_id) values (7, 'Habitación doble cuarta', 'h_d_cuarta.jpg', 165, 2);
insert into habitacion (id, nombre, imagen, precio, tipo_id) values (8, 'Habitación doble quinta', 'h_d_quinta.jpg', 170, 2);

insert into habitacion (id, nombre, imagen, precio, tipo_id) values (9, 'Habitación suite junior', 'suite_junior.jpg', 250, 3);
insert into habitacion (id, nombre, imagen, precio, tipo_id) values (10, 'Habitación suite nupcial', 'suite_nupcial.jpg', 300, 3);

/* ============================================================================================================ */

insert into caracteristicahabitacion (id, nombre) values (1, 'Cama de matrimonio');
insert into caracteristicahabitacion (id, nombre) values (2, 'Cama individual');
insert into caracteristicahabitacion (id, nombre) values (3, 'Camas independientes');
insert into caracteristicahabitacion (id, nombre) values (4, 'Confortable salón');
insert into caracteristicahabitacion (id, nombre) values (5, 'Amplio hall / recibidor');
insert into caracteristicahabitacion (id, nombre) values (6, 'Jacuzzi privado');
insert into caracteristicahabitacion (id, nombre) values (7, 'Amplia terraza');
insert into caracteristicahabitacion (id, nombre) values (8, 'Vista a la piscina');
insert into caracteristicahabitacion (id, nombre) values (9, 'Vista al mar');
insert into caracteristicahabitacion (id, nombre) values (10, 'Vista a la ciudad');
insert into caracteristicahabitacion (id, nombre) values (11, 'Smart TV Super Amoled');
insert into caracteristicahabitacion (id, nombre) values (12, 'Internet de Banda Ancha');
insert into caracteristicahabitacion (id, nombre) values (13, 'TV por satélite');
insert into caracteristicahabitacion (id, nombre) values (14, 'Superficie de 40 m²');
insert into caracteristicahabitacion (id, nombre) values (15, 'Superficie de 80 m²');
insert into caracteristicahabitacion (id, nombre) values (16, 'Superficie de 120 m²');
insert into caracteristicahabitacion (id, nombre) values (17, 'Nº de cama/s a elegir');

/* ============================================================================================================ */

insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (1, 2);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (1, 7);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (1, 8);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (1, 12);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (1, 13);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (1, 14);

insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (2, 2);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (2, 7);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (2, 10);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (2, 12);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (2, 13);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (2, 14);

insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (3, 2);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (3, 7);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (3, 9);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (3, 12);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (3, 13);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (3, 14);

insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (4, 3);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (4, 7);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (4, 10);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (4, 12);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (4, 13);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (4, 15);

insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (5, 3);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (5, 7);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (5, 10);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (5, 12);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (5, 13);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (5, 15);

insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (6, 1);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (6, 7);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (6, 10);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (6, 12);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (6, 13);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (6, 15);

insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (7, 1);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (7, 7);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (7, 10);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (7, 12);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (7, 13);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (7, 15);

insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (8, 1);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (8, 7);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (8, 9);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (8, 11);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (8, 12);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (8, 13);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (8, 15);

insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (9, 17);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (9, 4);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (9, 6);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (9, 7);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (9, 9);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (9, 11);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (9, 12);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (9, 13);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (9, 16);

insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (10, 1);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (10, 4);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (10, 5);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (10, 6);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (10, 7);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (10, 9);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (10, 11);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (10, 12);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (10, 13);
insert into caracteristicas_habitaciones (habitacion_id, caracteristicahabitacion_id) values (10, 16);