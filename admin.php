<?php
include('common\auth.php');
require_once('common\Data.php');
require_once('common\Helper.php');
$data = Data::getAll();
$tree = Helper::createTree($data, 0);
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
  <header>
    <div class="px-3 py-2 border-bottom mb-3">
      <div class="container d-flex flex-wrap justify-content-center">
        <div class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto"></div>
        <div class="text-end">
          <form action="logout.php" method="post">
            <button type="submit" class="btn btn-primary">Выйти</button>
          </form>
        </div>
      </div>
    </div>
  </header>
  <h1>Административная страница</h1>
  <form action="create.php" method="post">
  <div class="mb-3">
    <?php
    Helper::renderParentSelect($data, "parent_id");
    ?>
    </div>
    <div class="mb-3">
      <label for="title" class="form-label">Название</label>
      <input name="title" type="text" class="form-control" id="title" placeholder="Название">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Описание</label>
      <textarea name="description" class="form-control" id="description" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
  </form>
  <hr />
  <?php     
    Helper::renderAdminTree($tree, $data);
  ?>
  <script src="js/admin.js"></script>
</body>

</html>