CREATE DATABASE IF NOT EXISTS pasteles;
USE pasteles;

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion TEXT,
    precio DECIMAL(10,2),
    imagen VARCHAR(255)
);

INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES
('Corazones Blancos', 'Bizcochuelo de vainilla con dulce de leche y crema.', 8000.00, 'img/img1.jpg'),
('Fucsia Bold', 'Bizcochuelo de chocolate y ganache fucsia.', 10000.00, 'img/img2.jpg'),
('Lila', 'Mousse de frutos rojos con cobertura blanca.', 9000.00, 'img/img3.jpg'),
('Pink Brush', 'Pastel con crema pastelera y detalles rosados.', 8000.00, 'img/img4.jpg');
