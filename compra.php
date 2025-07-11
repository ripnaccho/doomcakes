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

    // Precios según torta (claves deben coincidir con los valores del select)
    $precios = [
        'torta5' => 8000,
        'torta6' => 10000,
        'torta7' => 9000,
        'torta8' => 8000
    ];

    $total = 0;
    if ($cantidad > 0 && isset($precios[$torta])) {
        $total = $cantidad * $precios[$torta];
    }

    // Guardamos en sesión para mostrar el comprobante
    $_SESSION['compra'] = compact(
        'nombre', 'apellido', 'email', 'dni',
        'torta', 'cantidad', 'metodo', 'tipoTarjeta',
        'titularNombre', 'titularApellido', 'tarjetaNumero', 'total'
    );

    // Guardar en base de datos si clickeó "guardar"
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

    // Redirigir a MercadoPago si método seleccionado y clickeó comprar
    if ($metodo === 'mercadoPago' && isset($_POST['comprar'])) {
        header("Location: https://www.mercadopago.com.ar/");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Delicias DoomCakes</title>
  <style>
    /* Tu CSS aquí (el que ya compartiste) */
  </style>
</head>
<body>

<!-- Aquí va tu formulario (como lo pasaste), con botones para comprar y guardar -->
<form method="POST" id="formCompra">
  <!-- Campos de nombre, apellido, email, dni, torta, cantidad, método de pago... -->
  <!-- Igual que tu código -->
  <!-- ... -->

  <button type="submit" name="comprar">Comprar</button>
  <button type="submit" name="guardar">Guardar en base de datos</button>
</form>

<?php if (isset($_SESSION['compra'])): 
  $nombresTortas = [
  'torta5' => 'Frutillas con Crema',
  'torta6' => 'Frutillas con Ganache Blanco',
  'torta7' => 'Frutas Mixtas',
  'torta8' => 'Frutal con Capas'
];
?>
<div id="comprobante">
  <h2>Comprobante de Compra</h2>
  <p><strong>Cliente:</strong> <?= htmlspecialchars($_SESSION['compra']['nombre'] . ' ' . $_SESSION['compra']['apellido']) ?></p>
  <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['compra']['email']) ?></p>
  <p><strong>DNI:</strong> <?= htmlspecialchars($_SESSION['compra']['dni']) ?></p>
  <p><strong>Torta:</strong> <?= htmlspecialchars($nombresTortas[$_SESSION['compra']['torta']] ?? 'Desconocida') ?></p>
  <p><strong>Cantidad:</strong> <?= (int)$_SESSION['compra']['cantidad'] ?></p>
  <p><strong>Total a pagar:</strong> $<?= number_format($_SESSION['compra']['total'], 0, ',', '.') ?></p>
  <p><strong>Método:</strong> <?= htmlspecialchars(ucfirst($_SESSION['compra']['metodo'])) ?></p>
  <?php if ($_SESSION['compra']['metodo'] === 'tarjeta'): ?>
    <p><strong>Tipo de tarjeta:</strong> <?= htmlspecialchars(ucfirst($_SESSION['compra']['tipoTarjeta'])) ?></p>
    <p><strong>Nombre del titular:</strong> <?= htmlspecialchars($_SESSION['compra']['titularNombre']) ?> <?= htmlspecialchars($_SESSION['compra']['titularApellido']) ?></p>
    <p><strong>Tarjeta terminada en:</strong> ****<?= substr($_SESSION['compra']['tarjetaNumero'], -4) ?></p>
  <?php endif; ?>
</div>
<?php endif; ?>

<script>
// Aquí tu JS para mostrar/ocultar campos y calcular total (igual que ya lo tenés)
</script>

</body>
</html>
