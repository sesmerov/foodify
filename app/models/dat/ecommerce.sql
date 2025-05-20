DROP TYPE IF EXISTS role_enum;
DROP TYPE IF EXISTS status_enum;

-- Crear el tipo ENUM para 'role' en la tabla 'user'
CREATE TYPE role_enum AS ENUM ('CLIENTE', 'ADMIN', 'COCINERO');

-- Crear el tipo ENUM para 'status' en la tabla 'order'
CREATE TYPE status_enum AS ENUM ('PENDIENTE', 'EN PROCESO', 'FINALIZADO');

-- Crear el tipo ENUM para 'type' en la tabla 'dish'
CREATE TYPE dish_type_enum AS ENUM ('CARNE', 'PESCADO', 'VEGETARIANO', 'VEGANO', 'OTROS');

-- Table 'user'
CREATE TABLE "user" (
    id_user SERIAL PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL, -- Store the hashed password
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    address VARCHAR(255) NOT NULL,
    role role_enum DEFAULT 'CLIENTE' NOT NULL  -- Usando el tipo ENUM definido anteriormente
);

-- Table 'allergen'
CREATE TABLE allergen (
    id_allergen SERIAL PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL
);

-- Table 'dish'
CREATE TABLE dish (
    id_dish SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(6,2) NOT NULL,
    type dish_type_enum NOT NULL, 
    details VARCHAR(255)
);

-- Table 'order'
CREATE TABLE "order" (
    id_order SERIAL PRIMARY KEY,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(7,2) NOT NULL,
    delivery_address VARCHAR(255) NOT NULL,
    status status_enum DEFAULT 'PENDIENTE' NOT NULL,  -- Usando el tipo ENUM definido anteriormente
    id_user INT,
    FOREIGN KEY (id_user) REFERENCES "user"(id_user)
);

-- Table 'order_detail'
CREATE TABLE order_detail (
    id_detail SERIAL PRIMARY KEY,
    id_order INT,
    id_dish INT,
    unit_price DECIMAL(6,2) NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (id_order) REFERENCES "order"(id_order),
    FOREIGN KEY (id_dish) REFERENCES dish(id_dish)
);

-- Table 'dish_allergen'
CREATE TABLE dish_allergen (
    id_allergen INT,
    id_dish INT,
    PRIMARY KEY (id_allergen, id_dish),
    FOREIGN KEY (id_allergen) REFERENCES allergen(id_allergen),
    FOREIGN KEY (id_dish) REFERENCES dish(id_dish)
);

-- Inserting data for 'user'
INSERT INTO "user" (first_name, password, last_name, email, address, role) VALUES
('Carlos', '$2y$10$kQxdDHqdmxSp2RMnDHWqQutSgf.92upHYF7priOvlpiSYh67L7.4O', 'Pérez', 'carlos.perez@example.com', 'Calle Falsa 123, 1ºA, 28001 Madrid, Madrid', 'CLIENTE'),
('Ana', '$2y$10$kQxdDHqdmxSp2RMnDHWqQutSgf.92upHYF7priOvlpiSYh67L7.4O', 'Gómez', 'ana.gomez@example.com', 'Avenida Libertad 456, 2ºB, 08001 Barcelona, Barcelona', 'CLIENTE'),
('Luis', '$2y$10$kQxdDHqdmxSp2RMnDHWqQutSgf.92upHYF7priOvlpiSYh67L7.4O', 'Martínez', 'luis.martinez@example.com', 'Calle Gran Via 789, 1º, 46001 Valencia, Valencia', 'CLIENTE'),
('Marta', '$2y$10$kQxdDHqdmxSp2RMnDHWqQutSgf.92upHYF7priOvlpiSYh67L7.4O', 'Rodríguez', 'marta.rodriguez@example.com', 'Calle de la Paz 101, 3ºC, 29001 Málaga, Málaga', 'CLIENTE'),
('Jorge', '$2y$10$kQxdDHqdmxSp2RMnDHWqQutSgf.92upHYF7priOvlpiSYh67L7.4O', 'Sánchez', 'jorge.sanchez@example.com', 'Plaza Mayor 202, 4ºA, 41001 Sevilla, Sevilla', 'CLIENTE'),
('Pedro', '$2y$10$kQxdDHqdmxSp2RMnDHWqQutSgf.92upHYF7priOvlpiSYh67L7.4O', 'López', 'pedro.lopez@example.com', 'Calle del Sol 303, 2ºD, 28002 Madrid, Madrid', 'CLIENTE'),
('Laura', '$2y$10$kQxdDHqdmxSp2RMnDHWqQutSgf.92upHYF7priOvlpiSYh67L7.4O', 'Hernández', 'laura.hernandez@example.com', 'Callejón del Agua 404, 1ºB, 08002 Barcelona, Barcelona', 'CLIENTE'),
('Carlos', '$2y$10$kQxdDHqdmxSp2RMnDHWqQutSgf.92upHYF7priOvlpiSYh67L7.4O', 'Torres', 'carlos.torres@example.com', 'Avenida de la Constitución 505, 5ºA, 50001 Zaragoza, Zaragoza', 'CLIENTE'),
('Raúl', '$2y$10$kQxdDHqdmxSp2RMnDHWqQutSgf.92upHYF7priOvlpiSYh67L7.4O', 'Díaz', 'raul.diaz@example.com', 'Calle de las Flores 606, 3ºC, 41002 Sevilla, Sevilla', 'CLIENTE'),
('Pedro', '$2y$10$gF5.GPZHVDjLKR1LPP6PjOH0UKnzKUGttenp2teu74jVwEqW.dkaW', 'González', 'pedro.gonzalez@admin.com', 'Avenida de la Administración 123, 6ºA, 28003 Madrid, Madrid', 'ADMIN'); 
-- password admin: admin123
-- password users: usuario

-- Inserting data for 'allergen'
INSERT INTO allergen (name) VALUES
('Gluten'),
('Lactosa'),
('Frutos secos'),
('Soya'),
('Huevos'),
('Pescado'),
('Mariscos'),
('Cacahuetes'),
('Apio'),
('Mostaza');

-- Inserting data for 'dish'
INSERT INTO dish (name, price, type, details) VALUES
('Ensalada mixta', 5.99, 'VEGETARIANO', 'Ensalada fresca con lechuga, tomate y zanahoria'),
('Paella de mariscos', 12.99, 'PESCADO', 'Paella tradicional con mariscos frescos y arroz'),
('Tacos de carne', 7.49, 'CARNE', 'Tacos de carne asada con cebolla y cilantro'),
('Salmón al horno', 14.99, 'PESCADO', 'Salmón fresco al horno con hierbas aromáticas'),
('Pasta con pesto', 8.99, 'VEGETARIANO', 'Pasta con salsa pesto casera y piñones'),
('Pollo asado', 9.49, 'CARNE', 'Pollo asado a la parrilla con hierbas y especias'),
('Ceviche', 10.99, 'PESCADO', 'Ceviche fresco con pescado, cebolla morada y limón'),
('Hamburguesa clásica', 6.99, 'CARNE', 'Hamburguesa de carne de res con queso, lechuga y tomate'),
('Sopa de verduras', 4.99, 'VEGETARIANO', 'Sopa casera de verduras frescas de temporada'),
('Pizza de 4 quesos', 11.99, 'OTROS', 'Pizza con mozzarella, parmesano, gouda y queso azul'),
('Tartar de atún', 15.99, 'OTROS', 'Tartar de atún fresco con aguacate y cebollín'),
('Arroz blanco', 3.99, 'OTROS', 'Arroz blanco al vapor, ideal como acompañamiento'),
('Pollo a la plancha', 7.49, 'CARNE', 'Pollo a la plancha con limón y especias');


-- Inserting data for 'order'
INSERT INTO "order" (total_price, delivery_address, status, id_user) VALUES
(22.98, 'Calle Falsa 123, 1ºA, 28001 Madrid, Madrid', 'PENDIENTE', 1),
(25.98, 'Avenida Libertad 456, 2ºB, 08001 Barcelona, Barcelona', 'FINALIZADO', 2),
(18.49, 'Calle Gran Via 789, 1º, 46001 Valencia, Valencia', 'EN PROCESO', 3),
(20.99, 'Calle de la Paz 101, 3ºC, 29001 Málaga, Málaga', 'PENDIENTE', 4),
(28.98, 'Plaza Mayor 202, 4ºA, 41001 Sevilla, Sevilla', 'FINALIZADO', 5),
(18.47, 'Calle del Sol 303, 2ºD, 28002 Madrid, Madrid', 'PENDIENTE', 6),
(25.97, 'Callejón del Agua 404, 1ºB, 08002 Barcelona, Barcelona', 'EN PROCESO', 7),
(30.99, 'Avenida de la Constitución 505, 5ºA, 50001 Zaragoza, Zaragoza', 'FINALIZADO', 8),
(22.98, 'Calle de las Flores 606, 3ºC, 41002 Sevilla, Sevilla', 'PENDIENTE', 9),
(19.49, 'Calle Río 707, 1º, 28003 Madrid, Madrid', 'EN PROCESO', 10);

-- Inserting data for 'order_detail'
INSERT INTO order_detail (id_order, id_dish, unit_price, quantity) VALUES
(1, 1, 5.99, 1),  -- Ensalada mixta
(1, 3, 7.49, 2),  -- Tacos de carne
(2, 2, 12.99, 1), -- Paella de mariscos
(2, 4, 14.99, 1), -- Salmón al horno
(3, 5, 8.99, 1),  -- Pasta con pesto
(3, 6, 9.49, 1),  -- Pollo asado
(4, 7, 10.99, 1), -- Ceviche
(4, 8, 6.99, 2),  -- Hamburguesa clásica
(5, 9, 4.99, 2),  -- Sopa de verduras
(5, 10, 11.99, 1), -- Pizza de 4 quesos
(6, 1, 5.99, 1),  -- Ensalada mixta
(6, 3, 7.49, 1),  -- Tacos de carne
(7, 2, 12.99, 1), -- Paella de mariscos
(7, 6, 9.49, 2),  -- Pollo asado
(8, 4, 14.99, 1), -- Salmón al horno
(8, 5, 8.99, 1),  -- Pasta con pesto
(9, 7, 10.99, 1), -- Ceviche
(9, 8, 6.99, 2),  -- Hamburguesa clásica
(10, 9, 4.99, 1), -- Sopa de verduras
(10, 10, 11.99, 1); -- Pizza de 4 quesos

-- Inserting data for 'dish_allergen'
INSERT INTO dish_allergen (id_allergen, id_dish) VALUES
(1, 1),  -- Ensalada mixta -> Gluten
(2, 1),  -- Ensalada mixta -> Lactosa
(5, 2),  -- Paella de mariscos -> Pescado
(7, 2),  -- Paella de mariscos -> Mariscos
(1, 3),  -- Tacos de carne -> Gluten
(3, 3),  -- Tacos de carne -> Frutos secos
(5, 4),  -- Salmón al horno -> Pescado
(2, 5),  -- Pasta con pesto -> Lactosa
(1, 6),  -- Pollo asado -> Gluten
(2, 7),  -- Ceviche -> Lactosa
(1, 8),  -- Hamburguesa clásica -> Gluten 
(6, 9),  -- Sopa de verduras -> Huevos
(1, 10), -- Pizza de 4 quesos -> Gluten
(5, 11), -- Tartar de atún -> Pescado
(7, 11); -- Tartar de atún -> Mariscos
