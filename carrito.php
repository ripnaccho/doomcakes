<?php
session_start();
include 'conexion.php';

// Mostrar errores para depurar
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar producto al carrito
if (isset($_POST['agregar'])) {
    $producto = [
        'id' => $_POST['id'],
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio'],
        'cantidad' => $_POST['cantidad']
    ];
    $_SESSION['carrito'][] = $producto;
}

// Guardar carrito y datos del cliente en la base de datos
if (isset($_POST['guardar'])) {
    if (!empty($_SESSION['carrito'])) {
        $nombre = $conn->real_escape_string($_POST['nombre'] ?? '');
        $apellido = $conn->real_escape_string($_POST['apellido'] ?? '');
        $email = $conn->real_escape_string($_POST['email'] ?? '');
        $dni = $conn->real_escape_string($_POST['dni'] ?? '');
        $fecha = date('Y-m-d H:i:s');

        $sql = "INSERT INTO pedidos (fecha, nombre, apellido, email, dni)
                VALUES ('$fecha', '$nombre', '$apellido', '$email', '$dni')";
        if ($conn->query($sql)) {
            $pedido_id = $conn->insert_id;

            foreach ($_SESSION['carrito'] as $item) {
                $id = intval($item['id']);
                $cant = intval($item['cantidad']);

                $conn->query("INSERT INTO detalle_pedido (pedido_id, producto_id, cantidad)
                              VALUES ($pedido_id, $id, $cant)");
            }

            echo "<p style='color: green;'>✅ Pedido Nº $pedido_id guardado con los datos del cliente.</p>";
            $_SESSION['carrito'] = [];
        } else {
            echo "<p style='color: red;'>❌ Error al guardar el pedido: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>⚠️ No hay productos en el carrito.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
</head>
<body>
    <h2>Productos</h2>

    <!-- Producto 1 -->
    <form method="POST">
        <input type="hidden" name="id" value="1">
        <input type="hidden" name="nombre" value="Producto 1">
        <input type="hidden" name="precio" value="100">
        Cantidad: <input type="number" name="cantidad" value="1" min="1">
        <input type="submit" name="agregar" value="Agregar al carrito">
    </form>

    <!-- Producto 2 -->
    <form method="POST">
        <input type="hidden" name="id" value="2">
        <input type="hidden" name="nombre" value="Producto 2">
        <input type="hidden" name="precio" value="50">
        Cantidad: <input type="number" name="cantidad" value="1" min="1">
        <input type="submit" name="agregar" value="Agregar al carrito">
    </form>

    <h2>Carrito</h2>

    <?php if (!empty($_SESSION['carrito'])): ?>
        <table border="1" cellpadding="5">
            <tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th></tr>
            <?php
            $total = 0;
            foreach ($_SESSION['carrito'] as $item) {
                $subtotal = $item['precio'] * $item['cantidad'];
                $total += $subtotal;
                echo "<tr>
                        <td>{$item['nombre']}</td>
                        <td>\${$item['precio']}</td>
                        <td>{$item['cantidad']}</td>
                        <td>\${$subtotal}</td>
                    </tr>";
            }
            ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>$<?= $total ?></strong></td>
            </tr>
        </table>
    <?php else: ?>
        <p>🛒 El carrito está vacío.</p>
    <?php endif; ?>

    <h2>Datos del cliente</h2>
    <form method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label>Apellido:</label>
        <input type="text" name="apellido" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>DNI:</label>
        <input type="text" name="dni" required><br><br>

        <input type="submit" name="guardar" value="GUARDAR CARRITO EN BASE DE DATOS">
    </form>
</body>
</html>
