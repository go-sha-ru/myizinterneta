<?php
include('common\auth.php');

$islogged = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && $_POST['password']) {
  $islogged = $user->login($_POST['username'], $_POST['password']);
  if ($islogged) {
    header("Location: admin.php", true, 301);
  }
}

?>

<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Вход</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/login.css" rel="stylesheet">
</head>

<body class="text-center">

  <main class="form-signin w-100 m-auto">
    <form action="login.php" method="post">
      <h1 class="h3 mb-3 fw-normal">Вход</h1>
      <?php
      if ($islogged === false) { ?>
        <div class="form-floating">
          <span class="error">Не верный логин или пароль</span>
        </div>
      <?php } ?>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" name="username" placeholder="username">
        <label for="floatingInput">Имя пользователя</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
        <label for="floatingPassword">Пароль</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
    </form>
  </main>



</body>

</html>