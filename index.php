<?php
require_once('common\Data.php');
require_once('common\Helper.php');
$data = Data::getAll();
$data = Helper::createTree($data, 0);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Мы Из интернета тестовое задание</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <h1>Данные</h1>
  <div class="wrapper">
  <?php
  Helper::renderTree($data);
  ?>
  </div>
  <script src="js/script.js"></script>

</body>

</html>