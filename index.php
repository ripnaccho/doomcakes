<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PASTELES - Inicio</title>
  <style>
    /* Fuente base */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #fff;
      color: #333;
    }

    /* Header principal */
    .header {
      background-color:rgba(135, 33, 103, 1);
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
    }

    .header .logo {
      font-weight: bold;
      font-size: 1.5rem;
    }

    .header .search-bar {
      flex-grow: 1;
      margin: 0 20px;
    }

    .header input {
      width: 100%;
      padding: 7px 10px;
      border-radius: 4px;
      border: none;
      font-size: 1rem;
    }

    .header .nav-links a {
      color: white;
      text-decoration: none;
      margin-left: 20px;
      font-weight: 600;
      font-size: 0.9rem;
    }

    .header .nav-links a:hover {
      text-decoration: background-color: #5a5d60ff;
    }

    /* Barra secundaria */
    /* Header principal */
.header {
  background-color: #e91e63; /* rosa fuerte */
  color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
}

.header .logo {
  font-weight: bold;
  font-size: 1.7rem;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.header .search-bar input {
  width: 100%;
  padding: 7px 10px;
  border-radius: 4px;
  border: none;
  font-size: 1rem;
}

/* Links del header */
.header .nav-links a {
  color: white;
  text-decoration: none;
  margin-left: 20px;
  font-weight: 600;
  font-size: 0.95rem;
  transition: color 0.3s ease;
}

.header .nav-links a:hover {
  color: #ffdce4; /* rosa claro al pasar el mouse */
}

/* Subheader */
.sub-header {
  background-color: #f8bbd0; /* rosa pastel */
  color: #5a3a3a;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 8px 20px;
  font-size: 14px;
}

.sub-header .menu li a {
  color: #5a3a3a;
}


    .sub-header .menu-icon {
      margin-right: 5px;
      font-weight: bold;
    }

    .sub-header .promo-link a {
      color: white;
      font-weight: bold;
      text-decoration: none;
    }

    .sub-header .promo-link a:hover {
      text-decoration: underline;
    }

    /* Carrusel */
    .carousel {
      width: 100%;
      overflow: hidden;
      position: relative;
      margin-top: 20px;
    }

    .carousel-images {
      display: flex;
      width: 300%;
      animation: slide 9s infinite;
    }

    .carousel-images img {
      width: 200%;
      height: 500px;
      object-fit: cover;
    }

    @keyframes slide {
      0% { margin-left: 0; }
      33% { margin-left: -100%; }
      66% { margin-left: -200%; }
      100% { margin-left: 0; }
    }

    /* Banner */
    .banner {
      background-color: #ff9900;
      color: white;
      text-align: center;
      padding: 25px 20px;
      font-size: 1.5rem;
      font-weight: bold;
    }

    /* Destinos (equivale a productos) */
    .destinos {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 20px;
      max-width: 1200px;
      margin: 0 auto 60px;
    }

    .destino {
      border: 1px solid #ddd;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
      transition: box-shadow 0.3s ease;
      background-color: #f9f9f9;
      display: flex;
      flex-direction: column;
    }

    .destino:hover {
      box-shadow: 0 6px 15px rgb(0 0 0 / 0.2);
    }

    .destino img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .destino p {
      margin: 15px 10px 10px;
      font-weight: 700;
      font-size: 1.2rem;
      color: #222;
      flex-grow: 1;
    }

    .destino button {
      margin: 10px;
      padding: 10px 20px;
      background-color:rgba(123, 128, 135, 1);
      border: none;
      color: white;
      font-weight: 600;
      font-size: 1rem;
      border-radius: 20px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      align-self: center;
      width: calc(100% - 20px);
    }

    .destino button:hover {
      background-color: #ff9900;
      color:rgb(137, 118, 139);
    }

   footer.footer {
  background-color: #d81b60; /* tono rosa fuerte y elegante */
  color:  #e91e63 /* rosa claro */
  padding: 40px 20px 20px;
  font-size: 0.9rem;
}

    .footer-contenedor {
      max-width: 1200px;
      margin: 0 auto 20px;
      display: flex;
      justify-content: space-between;
      gap: 15px;
      flex-wrap: wrap;
    }

    .footer-columna {
      flex: 1 1 180px;
      min-width: 180px;
    }

    .footer-columna h3 {
      font-weight: 700;
      margin-bottom: 12px;
      color: #262731ff;
    }

    .footer-columna a {
      color: #ccc;
      text-decoration: none;
      display: block;
      margin-bottom: 8px;
    }

    .footer-columna a:hover {
      color: #ff9900;
    }

    .footer-copy {
      text-align: center;
      border-top: 1px solid #444;
      padding-top: 12px;
      font-size: 0.85rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .destinos {
        grid-template-columns: 1fr;
        padding: 0 10px 40px;
      }

      .header {
        flex-direction: column;
        gap: 10px;
      }

      .header .search-bar {
        margin: 0;
        width: 100%;
      }

      .sub-header {
        flex-direction: column;
        gap: 10px;
      }
    }


    destinos {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 25px;
  margin-bottom: 50px;
}

.destino {
  width: 250px;
  text-align: center;
  background: #fff0f6;
  border-radius: 12px;
  border: 2px solid #ffb6c1;
  box-shadow: 0 5px 15px rgba(255, 105, 180, 0.15);
  padding: 15px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.destino:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 25px rgba(255, 105, 180, 0.25);
}

.destino img {
  width: 100%;
  border-radius: 10px;
  margin-bottom: 10px;
  object-fit: cover;
  height: 160px;
}

.destino p {
  color: #5e3b4e;
  margin-bottom: 8px;
}

.boton-detalle {
  display: inline-block;
  background-color: #ff69b4;
  color: white;
  padding: 8px 14px;
  border-radius: 20px;
  text-decoration: none;
  font-weight: bold;
  margin-top: 8px;
  transition: background 0.3s ease, transform 0.3s ease;
}

.boton-detalle:hover {
  background-color: #ff1493;
  transform: scale(1.05);
}
  </style>
</head>
<body>

  <!-- Header principal -->
  <header class="header">
    <div class="logo">doomcakes</div>

    <div class="search-bar">
      <input type="text" placeholder="Buscar destino..." />
    </div>

    <nav class="nav-links">
      <a href="#">tortas</a>
      <a href="#">POSTRES </a>
      <a href="#">helados</a>
       <a href="#">cotizacion </a>
   
    
    </nav>
  </header>


  <!-- Carrusel -->
  <div class="carousel">
    <div class="carousel-images">
      <img src="img/img17.jpg">
      <img src="img/img18.jpg">
      <img src="img/img19.jpg">
    </div>
  </div>
<!-- Destinos destacados estilo tortas -->
<section class="destinos">
  <div class="destino">
    <img src="img/img20.jpg" alt=" Corazones Blancos" />
    <p><strong>Corazones Blancos</strong></p>
    <p>Mini torta de vainilla con buttercream blanco y detalles en forma de corazón.</p>
    <a href="producto1.php" class="boton-detalle">Ver detalles</a>
  </div>

  <div class="destino">
    <img src="img/img21.jpg" alt="Frutillas Deluxe" />
    <p><strong> Frutillas Deluxe</strong></p>
    <p>Torta decorada con crema, frutillas frescas y ganache de chocolate negro.</p>
    <a href="producto2.php" class="boton-detalle">Ver detalles</a>
  </div>

  <div class="destino">
    <img src="img/img22.jpg" alt="KitKat Choco" />
    <p><strong>KitKat Choco</strong></p>
    <p>Torta de chocolate con mousse y bordes de KitKat, decorada con virutas.</p>
    <a href="producto3.php" class="boton-detalle">Ver detalles</a>
  </div>

  <div class="destino">
    <img src="img/img23.jpg" alt="Sídney - Red Velvet" />
    <p><strong>red Velvet</strong></p>
    <p>Torta Red Velvet estilo naked, con crema de queso y frutas frescas.</p>
    <a href="producto4.php" class="boton-detalle">Ver detalles</a>
  </div>
</section>
  <!-- Footer -->
  <footer class="footer">
    <div class="footer-contenedor">
      <div class="footer-columna">
        <h3>Acerca de</h3>
        <a href="#">Compañía</a>
        <a href="#">Carreras</a>
        <a href="#">Prensa</a>
      </div>
      <div class="footer-columna">
        <h3>Servicio al Cliente</h3>
        <a href="#">Contacta con nosotros</a>
        <a href="#">Devoluciones</a>
        <a href="#">Ayuda</a>
      </div>
      <div class="footer-columna">
        <h3>Más Información</h3>
        <a href="#">Política de Privacidad</a>
        <a href="#">Términos de Uso</a>
        <a href="#">Mapa del sitio</a>
      </div>
      <div class="footer-columna">
        <h3>Síguenos</h3>
        <a href="#">Facebook</a>
        <a href="#">Twitter</a>A
        <a href="#">Instagram</a>
      </div>
    </div>
    <div class="footer-copy">
      © 2025 PASTELES - Todos los derechos reservados.
    </div>
  </footer>

</body>
</html>
