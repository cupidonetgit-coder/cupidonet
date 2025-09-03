<?php
// public/index.php
session_start();

// CSRF muy simple para los formularios (puedes reemplazarlo por algo más robusto luego)
if (empty($_SESSION['csrf'])) {
  $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
$csrf = htmlspecialchars($_SESSION['csrf'], ENT_QUOTES, 'UTF-8');

// Si ya hay sesión iniciada, puedes cambiar el CTA
$user = $_SESSION['user'] ?? null;
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cybercupido — Conoce gente con tus mismos gustos</title>
  <meta name="description" content="Cybercupido: conoce personas reales con tus mismos intereses. Únete gratis.">
  <style>
    :root{
      --brand:#0066cc;
      --brand-2:#004b99;
      --text:#1d1d1f; --muted:#555; --bg:#fafafa; --card:#fff; --line:#eee;
      --shadow:0 10px 30px rgba(0,0,0,.06);
      --radius:14px;
    }
    *{box-sizing:border-box}
    html,body{margin:0;padding:0;background:var(--bg);color:var(--text);font-family:system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif}
    a{color:var(--brand);text-decoration:none}
    a:hover{text-decoration:underline}
    header{position:sticky;top:0;background:rgba(255,255,255,.9);backdrop-filter:saturate(180%) blur(8px);border-bottom:1px solid var(--line);z-index:5}
    .wrap{max-width:1100px;margin:0 auto;padding:14px 18px}
    .brand{font-weight:700;letter-spacing:.2px}
    .nav{float:right}
    .nav a{margin-left:14px}
    .hero{padding:54px 18px 24px}
    .he
