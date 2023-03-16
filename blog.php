<?php
$title = 'Blog sahifa';
require 'includes/header.php';
$post = 'Post yaratildi';
$postt = 'Post o\'chirildi';
$posttt = 'Post o\'zgartirildi';
require 'database.php';
$statement = $pdo->prepare("SELECT * FROM posts");
$statement->execute();

$posts = $statement->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['DELETE'])){

    $post_id = $_POST['post_id'];
    $statement = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $statement->execute([$post_id]);

    $_SESSION['post-ochirildi'] = 'Post o\'chirildi';

    header("Location: blog.php");
    exit();

}
?>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Album example</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
                <p>
                    <a href="post-creat.php" class="btn btn-primary my-2">Post yaratish</a>
                    <a href="#" class="btn btn-secondary my-2">Bosh sahifa</a>
                </p>
            </div>
        </div>
    </section>
<?php if (isset($_SESSION['post-yaratildi'])): ?>

<div class="alert  alert-success" role="alert">
    <p class="text-center h3">
        <?php echo $post ?></p>
        <?php unset($_SESSION['post-yaratildi']) ?>
</div>
<?php endif; ?>

<?php if (isset($_SESSION['post-ochirildi'])): ?>
    <div class="alert alert-danger" role="alert">
        <p class="text-center h3">
            <?php echo $postt ?></p>
        <?php unset($_SESSION['post-ochirildi']) ?>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['post-o\'zgartirildi'])): ?>
    <div class="alert alert-info" role="alert">
        <p class="text-center h3">
            <?php echo $posttt ?></p>
        <?php unset($_SESSION['post-o\'zgartirildi']) ?>
    </div>
<?php endif; ?>
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
               <?php foreach ($posts as $pst): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                        <div class="card-body">
                            <h5><?= $pst['title'] ?></h5>
                            <p class="card-text"><?= $pst['body'] ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="post.php?id=<?= $pst['id']?>">View</a></button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a href="post-edit.php?id=<?=$pst['id']?>">Edit</a></button>
                                    <form action="" method="POST" onsubmit="return confirm('Postni o\'chimoqchimisiz')">
                                        <input type="hidden" name="post_id" value="<?= $pst['id']?>">
                                        <input type="hidden" name="DELETE">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                                    </form>
                                </div>
                                <small><?= $pst['create'] ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <?php require 'includes/footer.php' ?>
        </div>
    </div>
