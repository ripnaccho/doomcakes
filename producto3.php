<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comprar'])) {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $email = $_POST['email'] ?? '';
    $dni = $_POST['dni'] ?? '';
    $torta = $_POST['torta'] ?? '';
    $cantidad = (int)($_POST['cantidad'] ?? 0);
    $metodo = $_POST['metodoPago'] ?? '';
    $tipoTarjeta = $_POST['tipoTarjeta'] ?? '';

    // Datos tarjeta
    $titularNombre = $_POST['titularNombre'] ?? '';
    $titularApellido = $_POST['titularApellido'] ?? '';
    $tarjetaNumero = $_POST['tarjetaNumero'] ?? '';

    $precios = [
        'chocolate' => 10000,
        'vainilla' => 8000,
        'frutilla' => 9000
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

    if ($metodo === 'mercadoPago') {
        header("Location: https://www.mercadopago.com.ar/");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>delicias doomcakes</title>
  <style>
/* ESTILOS GENERALES */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin: 0;
  padding: 20px;
  background: #ffe4ec;
  color: #3c2f2f;
}

h1 {
  text-align: center;
  margin-bottom: 30px;
  font-weight: 700;
  letter-spacing: 1.5px;
}

/* GALERÍA */
.galeria {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  gap: 25px;
  flex-wrap: wrap;
  margin-bottom: 50px;
}

.galeria-item {
  position: relative;
  width: 220px;
  text-align: center;
  background: #fff0f5;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  padding: 20px;
  animation: fadeInUp 0.8s ease forwards;
  opacity: 0;
  overflow: hidden;
}

.galeria-item:nth-child(1) { animation-delay: 0.1s; }
.galeria-item:nth-child(2) { animation-delay: 0.3s; }
.galeria-item:nth-child(3) { animation-delay: 0.5s; }
.galeria-item:nth-child(4) { animation-delay: 0.7s; }

.galeria-item:hover {
  transform: translateY(-10px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* Imagen circular con animación por encima */
.galeria-item .imagen-circular {
  position: relative;
  width: 200px;
  height: 200px;
  margin: 0 auto;
}

.galeria-item .imagen-circular img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  object-fit: cover;
  border: 4px solid white;
  z-index: 1;
  position: relative;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

/* Círculo giratorio decorativo SOLO sobre la imagen */
.galeria-item .imagen-circular::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  border: 3px dashed #ff91a4;
  animation: girarCirculo 6s linear infinite;
  z-index: 2;
  pointer-events: none;
}

/* Texto */
.galeria-item p {
  margin: 15px 10px 0;
  font-size: 1.05rem;
  font-weight: 600;
  color: #6b4c3b;
  z-index: 1;
}

/* Animaciones */
@keyframes girarCirculo {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* MAPA */
.mapa-container {
  max-width: 900px;
  margin: 0 auto 40px auto;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
  background: #fff0f5;
}

iframe {
  width: 100%;
  height: 350px;
  border: none;
}

/* FORMULARIO */
form {
  max-width: 600px;
  margin: 0 auto;
  background: #fff7f9;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-top: 10px;
  font-weight: bold;
  color: #5a3a3a;
}

input, select {
  width: 100%;
  padding: 8px;
  margin-top: 5px;
  box-sizing: border-box;
  border-radius: 6px;
  border: 1px solid #e3c1cb;
  background: #fff;
}

button {
  margin-top: 20px;
  padding: 10px 20px;
  cursor: pointer;
  background: #ff7b9c;
  color: white;
  border: none;
  border-radius: 8px;
  font-weight: bold;
  transition: background 0.3s ease;
}

button:hover {
  background: #ff5a84;
}

#tarjetaInfo {
  margin-top: 10px;
  background: #fff0f5;
  padding: 10px;
  display: none;
  border-radius: 8px;
  border: 1px solid #e9b7c4;
}

#camposTarjeta {
  margin-top: 10px;
  display: none;
}

#totalPagar {
  font-weight: bold;
  margin-top: 10px;
  display: none;
  color: #b03259;
  font-size: 1.2rem;
}

/* COMPROBANTE */
h2 {
  margin-top: 50px;
  color: #8b3d5a;
  text-align: center;
}

#comprobante {
  background: #ffeef3;
  border: 1px solid #e5cba6;
  padding: 20px;
  border-radius: 10px;
  max-width: 600px;
  margin: 20px auto;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
}
</style>
</head>
<body>
<?php
$tortasChoco = [
  'torta9' => [
    'nombre' => 'Chocolate con Rallado',
    'imagen' => 'img/img9.jpg',
    'descripcion' => 'Bizcochuelo húmedo de chocolate, relleno de mousse de chocolate y decorado con chocolate rallado. Medida: 14 cm – 6 a 8 porciones.'
  ],
  'torta10' => [
    'nombre' => 'Chocolate Espejada',
    'imagen' => 'img/img10.jpg',
    'descripcion' => 'Capas de bizcochuelo rellenas de ganache y mousse de chocolate, con baño espejo brillante. Medida: 16 cm – 8 a 10 porciones.'
  ],
  'torta11' => [
    'nombre' => 'Capas Triple Choco',
    'imagen' => 'img/img11.jpg',
    'descripcion' => 'Torta de 5 capas con diferentes tipos de chocolate (negro, con leche y blanco). Decorada con crema y ganache. Medida: 18 cm – 10 a 12 porciones.'
  ],
  'torta12' => [
    'nombre' => 'Choco-Nuez',
    'imagen' => 'img/img12.jpg',
    'descripcion' => 'Bizcochuelo de chocolate con dulce de leche, crema de cacao y nueces acarameladas. Medida: 14 cm – 6 a 8 porciones.'
  ]
];

$tortaMostrar = $_GET['torta'] ?? null;
?>

<h1>Delicias de Maldivas</h1>
<section class="galeria" aria-label="Galería de tortas">
  <?php foreach ($tortasChoco as $clave => $torta): ?>
    <div class="galeria-item" tabindex="0">
      <a href="<?= htmlspecialchars($torta['imagen']) ?>" target="_blank">
        <div class="imagen-circular">
          <img src="<?= htmlspecialchars($torta['imagen']) ?>" alt="<?= htmlspecialchars($torta['nombre']) ?>">
        </div>
      </a>
      <p><strong><?= htmlspecialchars($torta['nombre']) ?></strong></p>
      <?php if ($tortaMostrar === $clave): ?>
        <p><?= htmlspecialchars($torta['descripcion']) ?></p>
        <a href="?" style="color: #b03259; text-decoration: underline;">Leer menos</a>
      <?php else: ?>
        <a href="?torta=<?= $clave ?>" style="color: #b03259; text-decoration: underline;">Leer más</a>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</section>


  </section>

  <!-- MAPA -->
  <section class="mapa-container" aria-label="Ubicación de la panadería Maldivas">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3282.630270116562!2d-58.43910958477545!3d-34.60005056950186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcca9d2a71e555%3A0x9a19d0dbb7aa00bb!2sAv.%20Corrientes%204600%2C%20Buenos%20Aires%2C%20Argentina!5e0!3m2!1ses!2sus!4v1688899200000!5m2!1ses!2sus"
      allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
      title="Mapa de la Panadería Maldivas">
    </iframe>
  </section>




  
<form method="POST" id="formCompra">
  <label>Nombre: <input type="text" name="nombre" required></label>
  <label>Apellido: <input type="text" name="apellido" required></label>
  <label>Correo electrónico: <input type="email" name="email" required></label>
  <label>DNI: <input type="text" name="dni" required></label>

<!-- Tipo de torta -->
<label>Tipo de torta:
  <select name="torta" id="torta" required onchange="calcularTotal()">
  <option value="">--Seleccione--</option>
  <option value="torta9">Chocolate con Rallado ($9000)</option>
  <option value="torta10">Chocolate Espejada ($11000)</option>
  <option value="torta11">Capas Triple Choco ($12000)</option>
  <option value="torta12">Choco-Nuez ($9500)</option>
</select>



  <label>Cantidad:
    <input type="number" name="cantidad" id="cantidad" min="1" required onchange="calcularTotal()" oninput="calcularTotal()">
  </label>

  <p id="totalPagar"></p>

  <label>Método de pago:
    <select name="metodoPago" id="metodoPago" required onchange="mostrarTarjetaInfo()">
      <option value="">--Seleccione--</option>
      <option value="mercadoPago">Mercado Pago</option>
      <option value="tarjeta">Tarjeta</option>
    </select>
  </label>

  <div id="tarjetaInfo">
    <label>Tipo de tarjeta:
      <select name="tipoTarjeta" id="tipoTarjeta" onchange="mostrarCamposTarjeta()">
        <option value="">--Seleccione--</option>
        <option value="credito">Crédito</option>
        <option value="debito">Débito</option>
      </select>
    </label>

    <div id="camposTarjeta">
      <label>Nombre del titular: <input type="text" name="titularNombre"></label>
      <label>Apellido del titular: <input type="text" name="titularApellido"></label>
      <label>Número de tarjeta: <input type="text" name="tarjetaNumero"></label>
    </div>
  </div>

  <button type="submit" name="comprar">Comprar</button>
</form>

<?php if (isset($_SESSION['compra'])): 
   $nombresTortas = [
    'torta9' => 'Chocolate con Rallado',
    'torta10' => 'Chocolate Espejada',
    'torta11' => 'Capas Triple Choco',
    'torta12' => 'Choco-Nuez'
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
  <div style="text-align:center; margin-top: 20px;">
    <button onclick="window.print()">Imprimir / Guardar PDF</button>
  </div>
</div>
<?php endif; ?>

<script>
const precios = {
  torta9: 9000,
  torta10: 11000,
  torta11: 12000,
  torta12: 9500
};



function calcularTotal() {
  const torta = document.getElementById('torta').value;
  const cantidad = parseInt(document.getElementById('cantidad').value);
  const totalPagar = document.getElementById('totalPagar');

  if (torta && cantidad > 0 && precios[torta]) {
    const total = precios[torta] * cantidad;
    totalPagar.style.display = 'block';
    totalPagar.textContent = `Total a pagar: $${total.toLocaleString('es-AR')}`;
  } else {
    totalPagar.style.display = 'none';
    totalPagar.textContent = '';
  }
}

function mostrarTarjetaInfo() {
  const metodo = document.getElementById('metodoPago').value;
  const tarjetaInfo = document.getElementById('tarjetaInfo');
  const tipoTarjeta = document.getElementById('tipoTarjeta');
  const camposTarjeta = document.getElementById('camposTarjeta');

  if (metodo === 'tarjeta') {
    tarjetaInfo.style.display = 'block';
  } else {
    tarjetaInfo.style.display = 'none';
    tipoTarjeta.value = '';
    camposTarjeta.style.display = 'none';
  }
}

function mostrarCamposTarjeta() {
  const tipo = document.getElementById('tipoTarjeta').value;
  const camposTarjeta = document.getElementById('camposTarjeta');
  camposTarjeta.style.display = tipo ? 'block' : 'none';
}

window.onload = function () {
  calcularTotal();
  mostrarTarjetaInfo();
  mostrarCamposTarjeta();
};
</script>
  <!-- Botón Volver al Inicio -->
<div style="text-align:center; margin: 20px 0;">
  <button onclick="window.location.href='index.php'">Volver al inicio</button>
</div>


</body>
</html>
