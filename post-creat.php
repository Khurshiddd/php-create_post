<?php
$title = 'Post yaratish';
require 'includes/header.php';
require 'database.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];

    $statement = $pdo->prepare("INSERT INTO posts (title, body) VALUES (:title, :body)");
    $statement->execute([
            'title'=>$title,
            'body'=>$body
    ]);
    $_SESSION['post-yaratildi'] = 'Post muvafaqiyatli saqlandi';
    header('location: blog.php');
    exit();
}


?>
<div class="container py-4">

    <div class="p-5 mb-4 bg-light rounded-3">
        <form method="POST" action="" class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Post yaratish</h1>
            <div class="mb-3">
                <label class="form-label">Sarlavha</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label class="form-label">Matn</label>
                <textarea class="form-control" rows="3" name="body"></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Saqlash</button>
        </form>
    </div>
<?php require 'includes/footer.php' ?>
</div>