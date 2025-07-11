<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['comprar']) || isset($_POST['guardar']))) {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $email = $_POST['email'] ?? '';
    $dni = $_POST['dni'] ?? '';
    $torta = $_POST['torta'] ?? '';
    $cantidad = (int)($_POST['cantidad'] ?? 0);
    $metodo = $_POST['metodoPago'] ?? '';
    $tipoTarjeta = $_POST['tipoTarjeta'] ?? '';
    $titularNombre = $_POST['titularNombre'] ?? '';
    $titularApellido = $_POST['titularApellido'] ?? '';
    $tarjetaNumero = $_POST['tarjetaNumero'] ?? '';

    $precios = [
        'chocolate' => 10000,
        'vainilla' => 8000,
        'frutilla' => 9000,
        'corazones' => 8000,
        'fucsia' => 10000,
        'lila' => 9000,
        'pink' => 8000
    ];

    $total = 0;
    if ($cantidad > 0 && isset($precios[$torta])) {
        $total = $cantidad * $precios[$torta];
    }

    $_SESSION['compra'] = compact(
        'nombre', 'apellido', 'email', 'dni',
        'torta', 'cantidad', 'metodo', 'tipoTarjeta',
        'titularNombre', 'titularApellido', 'tarjetaNumero', 'total'
    );

    if (isset($_POST['guardar'])) {
        $stmt = $conn->prepare("INSERT INTO pedidos 
            (nombre, apellido, email, dni, torta, cantidad, metodo_pago, tipo_tarjeta, titular_nombre, titular_apellido, tarjeta_numero, total)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssssisssssi",
            $nombre, $apellido, $email, $dni, $torta, $cantidad,
            $metodo, $tipoTarjeta, $titularNombre, $titularApellido,
            $tarjetaNumero, $total
        );

        if ($stmt->execute()) {
            echo "<p style='color: green; text-align:center;'>✅ Compra guardada correctamente en la base de datos.</p>";
        } else {
            echo "<p style='color: red; text-align:center;'>❌ Error al guardar: " . $conn->error . "</p>";
        }
        $stmt->close();
    }

    if ($metodo === 'mercadoPago' && isset($_POST['comprar'])) {
        header("Location: https://www.mercadopago.com.ar/");
        exit;
    }
}
?>

<!-- A partir de acá va tu HTML como lo tenías -->
<!-- Solo reemplazá el botón de compra por esto dentro del <form>: -->

<div style="text-align: center; display: flex; flex-direction: column; gap: 10px;">
  <button type="submit" name="comprar">Comprar</button>
  <button type="submit" name="guardar">Guardar en base de datos</button>
</div>

<!-- El resto del HTML (galería, mapa, formulario, comprobante, estilos) se mantiene igual -->
