<?php
$title = 'Post o\'zgartirish';
require 'includes/header.php';
require 'database.php';
$post_id = $_GET['id'];

$statement = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$statement->execute([$post_id]);
$pst = $statement->fetch();

if($_SERVER['REQUEST_METHOD'] == 'POST' && 'PUT') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $id = $_POST['post_id'];

    $statement = $pdo->prepare("UPDATE posts SET title = :title, body = :body WHERE id = :id");
    $statement->execute([
        'title'=>$title,
        'body'=>$body,
        'id'=>$id,
    ]);
    $_SESSION['post-o\'zgartirildi'] = 'Post o\'zgartirildi';
    header('location: blog.php');
    exit();
}


?>
<div class="container py-4">

    <div class="p-5 mb-4 bg-light rounded-3">
        <form method="POST" action="" class="container-fluid py-5">
            <input type="hidden" name="PUT">
            <input type="hidden" name="post_id" value="<?= $pst['id']?>">
            <h1 class="display-5 fw-bold">Post o'zgartirish</h1>
            <div class="mb-3">
                <label class="form-label">Sarlavha</label>
                <input type="text" value="<?= $pst['title']?>" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label class="form-label">Matn</label>
                <textarea class="form-control" rows="3" name="body"><?= $pst['body']?></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Saqlash</button>
        </form>
    </div>


    <?php require 'includes/footer.php' ?>
</div>