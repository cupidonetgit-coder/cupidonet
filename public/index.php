<?php
// public/index.php
session_start();
$user = $_SESSION['user'] ?? null;
$cartTotal = 0.00;
$categories = ["All Category","Electronics","Fashion","Shoes","Sports","Home","Books"];
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tienda • Página genérica</title>
  <meta name="description" content="Landing genérica para tienda: menú, hero, banners y buscador.">
  <style>
    :root{
      --bg:#f7f7f8; --card:#fff; --text:#1f2328; --muted:#6b7280; --line:#e5e7eb;
      --brand:#ff8a00; --brand-2:#ff6a00; --dark:#0f172a;
      --radius:14px; --shadow:0 10px 30px rgba(15,23,42,.08);
    }
    *{box-sizing:border-box}
    html,body{margin:0;padding:0;background:var(--bg);color:var(--text);font-family:system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif}
    a{color:inherit;text-decoration:none}
    .wrap{max-width:1180px;margin:0 auto;padding:0 16px}

    /* Topbar */
    .topbar{background:#111827;color:#e5e7eb;font-size:13px}
    .topbar .row{display:flex;align-items:center;justify-content:space-between;padding:6px 0}
    .topbar a{color:#e5e7eb;opacity:.9;margin-right:14px}
    .topbar a:hover{opacity:1}
    .social a{margin:0 6px}

    /* Header middle (contacto + buscador) */
    header{background:var(--card);border-bottom:1px solid var(--line)}
    .head{display:grid;grid-template-columns:1fr 2fr 1fr;gap:16px;align-items:center;padding:14px 0}
    .contact{display:flex;gap:18px;align-items:center;color:var(--muted);font-size:14px}
    .contact .item{display:flex;gap:8px;align-items:center}
    .logo{font-weight:800;font-size:24px;letter-spacing:1px}
    .search{display:flex;gap:0}
    .search input,.search select{border:1px solid var(--line);padding:12px 12px;font-size:14px}
    .search select{border-right:none;border-radius:10px 0 0 10px;background:#fff;min-width:140px}
    .search input{flex:1;border-left:none}
    .search button{background:var(--brand);border:1px solid var(--brand);color:#fff;padding:0 16px;border-radius:0 10px 10px 0;cursor:pointer;font-weight:600}
    .cart{justify-self:end;display:flex;gap:10px;align-items:center}
    .cart .pill{background:#111827;color:#fff;border-radius:999px;padding:6px 10px;font-size:12px}

    /* Navbar */
    nav{background:var(--card)}
    .menu{display:flex;align-items:center;gap:22px;padding:10px 0;border-top:1px solid var(--line)}
    .menu a{font-weight:600;color:#374151}
    .menu a.active{color:var(--brand-2)}
    .menu .spacer{flex:1}

    /* Hero */
    .hero{position:relative;border-radius:16px;overflow:hidden;margin:18px 0;box-shadow:var(--shadow)}
    .hero .img{aspect-ratio: 16/6; background:#ddd url('https://picsum.photos/1600/600?random=13') center/cover no-repeat;}
    .hero .txt{position:absolute;inset:0;display:grid;place-items:center;text-align:center;color:#fff;
      background:linear-gradient(90deg, rgba(15,23,42,.55), rgba(15,23,42,.25));}
    .hero h1{font-size:clamp(24px,4.8vw,56px);margin:4px 0 8px;text-shadow:0 6px 18px rgba(0,0,0,.35)}
    .hero p{margin:0 0 10px;font-size:clamp(12px,1.6vw,16px);letter-spacing:.4px;opacity:.95}
    .btn{display:inline-flex;align-items:center;gap:8px;background:#fff;color:#111827;border:1px solid #fff;padding:12px 16px;border-radius:12px;font-weight:700;cursor:pointer}
    .btn.primary{background:var(--brand);border-color:var(--brand);color:#fff}
    .btn:hover{filter:brightness(.96)}

    /* Banners de categorías */
    .grid3{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin:18px 0}
    .tile{position:relative;border-radius:14px;overflow:hidden;box-shadow:var(--shadow);background:#ddd}
    .tile .img{aspect-ratio: 16/10; background-size:cover;background-position:center}
    .tile .badge{position:absolute;left:12px;top:12px;background:rgba(17,24,39,.9);color:#fff;padding:8px 12px;border-radius:999px;font-size:12px}
    .tile .cap{position:absolute;inset:auto 0 0 0;background:linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,.55) 100%);color:#fff;padding:16px}
    .tile h3{margin:0 0 6px}
    .tile small{opacity:.9}

    /* Footer */
    footer{margin:26px 0 18px;text-align:center;color:var(--muted);font-size:14px}

    /* Responsive */
    @media (max-width: 980px){
      .head{grid-template-columns:1fr;gap:12px}
      .search select{min-width:120px}
      .grid3{grid-template-columns:1fr}
      .menu{flex-wrap:wrap;gap:14px}
    }
  </style>
</head>
<body>

  <!-- TOPBAR -->
  <div class="topbar">
    <div class="wrap">
      <div class="row">
        <div>
          <a href="#">Account</a>
          <a href="#">Checkout</a>
          <a href="#">Dashboard</a>
        </div>
        <div class="social">
          <a href="#" aria-label="Facebook">Fb</a>
          <a href="#" aria-label="Twitter">Tw</a>
          <a href="#" aria-label="LinkedIn">In</a>
          <a href="#" aria-label="RSS">Rss</a>
        </div>
        <div>
          <?php if ($user): ?>
            Hola, <strong><?=htmlspecialchars($user['display_name']??$user['email'])?></strong> · <a href="/logout.php">Logout</a>
          <?php else: ?>
            <a href="/login.php">Login</a> · <a href="/register.php">Register</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- HEADER -->
  <header>
    <div class="wrap head">
      <div class="contact">
        <div class="item">📞 <span>+57 300 000 0000</span></div>
        <div class="item">✉️ <span>contacto@tutienda.com</span></div>
      </div>

      <div class="search" role="search">
        <form action="#" method="get" style="display:flex;flex:1">
          <select name="cat" aria-label="Categoría">
            <?php foreach($categories as $i=>$c): ?>
              <option value="<?= $i ?>"><?= htmlspecialchars($c) ?></option>
            <?php endforeach; ?>
          </select>
          <input type="text" name="q" placeholder="Search for product" aria-label="Buscar">
          <button type="submit" aria-label="Buscar">🔍</button>
        </form>
      </div>

      <div class="cart">
        <div>🛒</div>
        <div>
          <div><strong>$ <?= number_format($cartTotal,2) ?></strong></div>
          <div class="pill">0 items</div>
        </div>
      </div>
    </div>

    <div class="wrap">
      <div class="menu">
        <div class="logo">LOGO</div>
        <a class="active" href="#">HOME</a>
        <a href="#">SHOP</a>
        <a href="#">BLOG</a>
        <a href="#">SHORTCODE</a>
        <a href="#">FEATURE</a>
        <a href="#">PAGES</a>
        <div class="spacer"></div>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <main class="wrap">
    <section class="hero">
      <div class="img" role="img" aria-label="Banner principal"></div>
      <div class="txt">
        <div>
          <p>FREE SHIPPING ON ORDERS OVER $100!</p>
          <h1>HOT NEW RANGE<br>IN STOCK!</h1>
          <button class="btn primary">Shop Now</button>
        </div>
      </div>
    </section>

    <!-- BANNERS -->
    <section class="grid3" aria-label="Categorías destacadas">
      <article class="tile">
        <div class="img" style="background-image:url('https://picsum.photos/800/500?random=1')"></div>
        <span class="badge">Of season sale</span>
        <div class="cap">
          <h3>WINTER JACKETS</h3>
          <small>Descubre abrigos a precios especiales</small>
        </div>
      </article>

      <article class="tile">
        <div class="img" style="background-image:url('https://picsum.photos/800/500?random=2')"></div>
        <span class="badge">New arrivals</span>
        <div class="cap">
          <h3>RUNNING SHOES</h3>
          <small>Ligereza y rendimiento para tus carreras</small>
        </div>
      </article>

      <article class="tile">
        <div class="img" style="background-image:url('https://picsum.photos/800/500?random=3')"></div>
        <span class="badge">Essentials</span>
        <div class="cap">
          <h3>MEN'S SHIRTS</h3>
          <small>Básicos con estilo para cada día</small>
        </div>
      </article>
    </section>
  </main>

  <footer>
    <div class="wrap">
      <small>© <?=date('Y')?> TuTienda. Todos los derechos reservados.</small>
    </div>
  </footer>
</body>
</html>