
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace de Hardware (PC) - Loja Virtual</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>


</body>

<body>
<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="index.php">Marketplace <span>de Hardware</span></a>

    <nav class="nav">
      <a href="produtos.php?categoria=all">Produtos</a>
      <?php foreach ($categorias as $catKey => $catLabel): if ($catKey === 'all') continue; ?>
        <a href="produtos.php?categoria=<?php echo urlencode($catKey); ?>"><?php echo htmlspecialchars($catLabel, ENT_QUOTES, 'UTF-8'); ?></a>
      <?php endforeach; ?>
    </nav>

    <div class="header-actions">
      <?php if (is_logged_in()): ?>
        <div class="user">Olá, <?php echo htmlspecialchars($_SESSION['user_nome'] ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
        <a class="btn btn-ghost" href="logout.php">Sair</a>
      <?php else: ?>
        <a class="btn btn-ghost" href="login.php">Login</a>
        <a class="btn" href="cadastro.php">Cadastrar</a>
      <?php endif; ?>

      <a class="cart-link" href="carrinho.php" aria-label="Carrinho">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="cart-badge" id="cart-badge"><?php echo (int)$badge; ?></span>
      </a>
    </div>
  </div>
</header>

<main class="container">
  <section class="hero">
    <div class="hero-content">
      <h1>Peças para PC, do jeito mais fácil</h1>
      <p>GPU, CPU, RAM, SSD e placa-mãe para montar ou atualizar seu setup.</p>
      <div class="hero-cta">
        <a class="btn" href="produtos.php?categoria=all">Ver catálogo</a>
        <a class="btn btn-ghost" href="produtos.php">Buscar por categoria</a>
      </div>
    </div>
  </section>

  <section class="filters">
    <form class="search-form" method="get" action="produtos.php">
      <input type="text" name="q" placeholder="Buscar (ex: RTX, Ryzen, NVMe)" />
      <select name="categoria">
        <option value="all">Todas</option>
        <?php foreach (['GPU','CPU','RAM','SSD','Placa-mãe'] as $c): ?>
          <option value="<?php echo htmlspecialchars($c, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($c, ENT_QUOTES, 'UTF-8'); ?></option>
        <?php endforeach; ?>
      </select>
      <button class="btn" type="submit">Buscar</button>
    </form>
  </section>

  <section class="section-title">
    <h2>Produtos em destaque</h2>
    <a class="link" href="produtos.php?categoria=all">Ver todos <i class="fa-solid fa-arrow-right"></i></a>
  </section>

  <section class="grid">
    <?php foreach ($produtos as $p): ?>
      <?php
        $nome = (string)$p['nome'];
        $categoria = (string)$p['categoria'];
        $preco = (float)$p['preco'];
      ?>
      <a class="card" href="produto.php?id=<?php echo (int)$p['id']; ?>">
        <div class="card-thumb">
          <div class="cat-pill"><?php echo htmlspecialchars($categoria, ENT_QUOTES, 'UTF-8'); ?></div>
          <div class="thumb-icon"><i class="fa-solid fa-microchip"></i></div>
        </div>
        <div class="card-body">
          <h3 class="card-title"><?php echo htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?></h3>
          <div class="card-price">R$ <?php echo number_format($preco, 2, ',', '.'); ?></div>
          <div class="card-stock">
            <?php if ((int)$p['estoque'] > 0): ?>
              <span class="ok">Em estoque: <?php echo (int)$p['estoque']; ?></span>
            <?php else: ?>
              <span class="bad">Indisponível</span>
            <?php endif; ?>
          </div>
        </div>
      </a>
    <?php endforeach; ?>
  </section>
</main>

<footer class="site-footer">
  <div class="container">© <?php echo date('Y'); ?> Marketplace de Hardware (PC)</div>
</footer>

<script src="script.js"></script>
</body>
</html>

