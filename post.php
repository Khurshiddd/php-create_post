<?php
$title = 'Post sahifa';
require 'includes/header.php';
require 'database.php';

$id = $_GET['id'];

$statement = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$statement->execute([$id]);
$pst = $statement->fetch();
?>
<main class="container">
    <div class="mt-5">
    <h1><?= $pst['title']?></h1>
    <p class="fs-5 col-md-8"><?= $pst['body']?></p>
    <p class="fs-5 col-md-8"><?= $pst['create']?></p>


    <div class="mb-5">
        <a href="#" class="btn btn-primary btn-lg px-4">Download examples</a>
    </div>
    </div>

    </div>
</main>

<?php require 'includes/footer.php' ?>
