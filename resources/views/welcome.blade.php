<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ferretería Moderna</title>
  <style>
    /* Reset básico */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-color: #fafafa;
      color: #333;
      line-height: 1.6;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    /* Header y Navbar */
    header {
      background-color: #2980b9;
      padding: 20px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    header .logo h1 {
      color: #ecf0f1;
      font-size: 28px;
    }

    header .logo span {
      color: #e74c3c;
    }

    nav ul {
      list-style-type: none;
      display: flex;
      justify-content: flex-end;
    }

    nav ul li {
      margin-left: 20px;
    }

    nav ul li a {
      color: #ecf0f1;
      font-size: 18px;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    nav ul li a:hover {
      color: #e74c3c;
    }

    /* Hero Section */
    .hero {
      background: url('https://images.unsplash.com/photo-1587413095564-bc4c7be173b9') center center no-repeat;
      background-size: cover;
      padding: 100px 20px;
      text-align: center;
      color: white;
      position: relative;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.4);
      z-index: 1;
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero-content h2 {
      font-size: 48px;
      margin-bottom: 15px;
      text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
    }

    .hero-content p {
      font-size: 22px;
      margin-bottom: 30px;
    }

    .cta-btn {
      background-color: #e74c3c;
      color: white;
      padding: 15px 40px;
      font-size: 20px;
      border-radius: 8px;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .cta-btn:hover {
      background-color: #c0392b;
      transform: scale(1.1);
    }

    /* Productos */
    .productos {
      text-align: center;
      padding: 80px 20px;
      background-color: #fff;
    }

    .productos h2 {
      font-size: 40px;
      margin-bottom: 40px;
      color: #2980b9;
    }

    .product-list {
      display: flex;
      justify-content: space-around;
      gap: 30px;
      flex-wrap: wrap;
      animation: fadeIn 1s ease-in;
    }

    .product-item {
      background-color: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
      width: 30%;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-item:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .product-item img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 10px;
    }

    .product-item h3 {
      font-size: 24px;
      margin-top: 20px;
      color: #333;
    }

    .product-item p {
      font-size: 16px;
      margin: 10px 0;
      color: #777;
    }

    .buy-btn {
      background-color: #27ae60;
      color: white;
      padding: 12px 35px;
      font-size: 18px;
      border-radius: 5px;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .buy-btn:hover {
      background-color: #2ecc71;
      transform: scale(1.05);
    }

    /* Servicios */
    .servicios {
      background-color: #ecf0f1;
      padding: 80px 20px;
    }

    .servicios h2 {
      font-size: 36px;
      text-align: center;
      margin-bottom: 40px;
      color: #2980b9;
    }

    .service-list {
      display: flex;
      justify-content: space-around;
      gap: 30px;
    }

    .service-item {
      background-color: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 30%;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .service-item:hover {
      transform: translateY(-10px);
    }

    .service-item h3 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #2980b9;
    }

    .service-item p {
      font-size: 16px;
      color: #777;
    }

    /* Contacto */
    .contacto {
      padding: 80px 20px;
      background-color: #fff;
      text-align: center;
    }

    #contact-form {
      max-width: 600px;
      margin: 0 auto;
    }

    #contact-form input,
    #contact-form textarea {
      width: 100%;
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    #contact-form button {
      background-color: #e74c3c;
      color: white;
      padding: 15px 30px;
      border-radius: 8px;
      font-size: 18px;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    #contact-form button:hover {
      background-color: #c0392b;
    }

    /* Footer */
    footer {
      text-align: center;
      padding: 20px;
      background-color: #2980b9;
      color: white;
    }

    footer p {
      font-size: 14px;
    }

    /* Animaciones */
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

  </style>
</head>
<body>
  <!-- Navbar -->
  <header>
    <nav>
      <div class="logo">
        <h1>Ferretería <span>Moderna</span></h1>
      </div>
      <ul class="nav-links">
        <li><a href="#">Inicio</a></li>
        <li><a href="#productos">Productos</a></li>
        <li><a href="#servicios">Servicios</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <h2>Bienvenido a la Ferretería Moderna</h2>
      <p>Encuentra las mejores herramientas y productos para tus proyectos. ¡Todo lo que necesitas para trabajar como un profesional!</p>
      <a href="#productos" class="cta-btn">Ver Productos</a>
    </div>
  </section>

  <!-- Productos -->
  <section id="productos" class="productos">
    <h2>Nuestros Productos</h2>
    <p>Descubre una amplia gama de productos diseñados para facilitar tus proyectos. ¡Haz que tu trabajo sea más fácil y profesional con nuestra selección!</p>
    <div class="product-list">
      <div class="product-item">
        <img src="https://via.placeholder.com/300" alt="Producto 1">
        <h3>Taladro Eléctrico</h3>
        <p>Potente taladro para tus necesidades de perforación.</p>
        <a href="#" class="buy-btn">Comprar</a>
      </div>
      <div class="product-item">
        <img src="https://via.placeholder.com/300" alt="Producto 2">
        <h3>Martillo Profesional</h3>
        <p>Martillo ergonómico con mango de fibra de carbono.</p>
        <a href="#" class="buy-btn">Comprar</a>
      </div>
      <div class="product-item">
        <img src="https://via.placeholder.com/300" alt="Producto 3">
        <h3>Destornillador Eléctrico</h3>
        <p>Ideal para tareas de atornillado rápido y eficaz.</p>
        <a href="#" class="buy-btn">Comprar</a>
      </div>
    </div>
  </section>

  <!-- Servicios -->
  <section id="servicios" class="servicios">
    <h2>Servicios Especializados</h2>
    <p>Además de productos de alta calidad, ofrecemos una variedad de servicios para ayudarte en tu trabajo.</p>
    <div class="service-list">
      <div class="service-item">
        <h3>Asesoría Técnica</h3>
        <p>Te ayudamos a elegir las herramientas adecuadas para tu proyecto.</p>
      </div>
      <div class="service-item">
        <h3>Reparaciones</h3>
        <p>Reparamos tus herramientas con garantía de calidad.</p>
      </div>
      <div class="service-item">
        <h3>Envíos a Domicilio</h3>
        <p>Recibe tus compras en la puerta de tu casa de manera rápida y segura.</p>
      </div>
    </div>
  </section>

  <!-- Contacto -->
  <section id="contacto" class="contacto">
    <h2>Contacto</h2>
    <p>¿Tienes alguna duda o consulta? Contáctanos y te responderemos lo antes posible.</p>
    <form id="contact-form">
      <input type="text" name="name" placeholder="Tu Nombre" required>
      <input type="email" name="email" placeholder="Tu Correo" required>
      <textarea name="message" placeholder="Tu Mensaje" rows="4" required></textarea>
      <button type="submit">Enviar</button>
    </form>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2024 Ferretería Moderna. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
