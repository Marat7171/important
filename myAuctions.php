<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Пример на bootstrap 4: Простой одностраничный шаблон для фотогалереи, портфолио и многого другого.">

  <title>Альбом | Album example for Bootstrap</title>

  <!-- Bootstrap core CSS -->
  <link href="/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Favicons -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
  <link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
  <meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#563d7c">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="album.css" rel="stylesheet">
</head>

<body>

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-4481610-59', 'auto');
    ga('send', 'pageview');

  </script>

  <!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter39705265 = new Ya.Metrika({ id:39705265, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/39705265" style="position:absolute; left:-9999px;" alt="Yandex.Metrika" /></div></noscript> <!-- /Yandex.Metrika counter -->

  <header>

    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container d-flex justify-content-between">
        <a href="#" class="navbar-brand d-flex align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2" focusable="false" aria-hidden="true"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
          <strong><a href="#">Название сайта</a></strong>
        </a>
        <?php if(isset($_SESSION['users']['username'])): ?>
          <a href="index.php"><strong style="color: #FFF;">Перейти на главную</strong></a>
          
          <a href="phpCode/exit.php"><strong style="color: #FFF;">Выйти из профиля</strong></a>
        <?php endif; ?> 
      </div>
    </div>
  </header>

  <main role="main">

    <section class="jumbotron text-center">
      <div class="container"><?php if(!isset($_SESSION['users']['username'])): ?>
      <h1 class="jumbotron-heading">Пожaлуйсте, авторизируйтесь!</h1>
      <p class="lead text-muted">Если вы ищете выгодные предложения, есть большая вероятность, что вы найдете их на нашем онлайн-аукционе. Будь то украшения, одежда, книги или даже машина, дом или участок земли - все они доступны по выгодным ценам у нас.</p>
      <p>
        <a href="authorization.php" class="btn btn-primary my-2">Авторизироваться!</a>
        <a href="registration.php" class="btn btn-secondary my-2">Я здесь впервые</a>
      </p>
      <?php else: ?>
        <h1 class="jumbotron-heading">Мои аукционы</h1>
      <?php endif; ?> 
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        <?php require_once 'phpCode/connectdb.php';
        $useremail1 = $_SESSION['lot']['useremail'];
        $query = $pdo->query("SELECT * FROM `lot` WHERE (`useremail` = '$useremail1') ORDER BY `id` DESC");
        while($row = $query->fetch(PDO::FETCH_OBJ)): ?>

          <?php $queryf = $pdo->query("SELECT * FROM `photo` WHERE `id_lot` = {$row->id} ");
          $wrow = $queryf->fetch(PDO::FETCH_OBJ);?>

          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
             <img src="<?php echo DIRECTORY_SEPARATOR .'photo'.DIRECTORY_SEPARATOR.$wrow->tmp;?>" width="auto" height="330">
             <div class="card-body">
              <p class="card-text"><?php echo $row->lotname . "</br>" . $row->description . "</br>" . "Начальная цена: " . $row->price . " рублей." . "</br>" . "Лот активен до: " . date("Y-m-d H:i:s", $row->timeLeft) ?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <form action="phpCode/lotediting.php" method="post">
                    <button type="submit" name="editing" value="<?php echo $row->id; ?>" class="btn btn-sm btn-outline-secondary">Подробнее(редактировать)</button>
                  </form>
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>

      <?php endwhile; ?>
    </div>
  </div>
</div>

</main>

<footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="#">Back to top</a>
    </p>
    <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
    <p>New to Bootstrap? <a href="https://getbootstrap.com">Visit the homepage</a> or read our <a href="/docs/4.4/getting-started/introduction/">getting started guide</a>.</p>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>

</body>
</html>