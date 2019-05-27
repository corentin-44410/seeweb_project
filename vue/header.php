<html>
  <head>
    <!-- Balises Meta -->
    <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">

    <!-- Script CSS -->
    <link rel="stylesheet"	href="../vendor/bootstrap-4.3.1-dist/css/bootstrap.css"	/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css" />
    <!-- Script JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.3.1-dist/js/bootstrap.js"></script>

  </head>
  <body>
      <div class="container">
        <?php if(isset($_SESSION['flash'])): ?>
          <?php foreach ($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?= $type;?> alert-dismissible fade show">
              <i class="fas fa-info-circle" style="margin-right : 5px;"></i><?= $message; ?>
            </div>
          <?php endforeach; ?>
          <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
      </div>
