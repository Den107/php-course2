<!doctype html>
<html lang="en">
<?php include VIEWS_DIR . "blocks/head.php"; ?>
<body>
<div class="row justify-content-center">
    <div class="col-md-6">
        <header>
            <?php include VIEWS_DIR . "blocks/menu.php"; ?>
        </header>
        <main>
            <h2><?= $product['title'] ?></h2>
            <p><?= $product['description'] ?></p>
            <hr>
            <h4>Отзывы</h4>
            <div class="list-group">
            <?php foreach ($feedbacks as $feedback): ?>
                <div class="list-group-item">
                    <?= $feedback['content']; ?>
                </div>
            <?php endforeach; ?>
            </div>
            <div>
                <form action="/add_feedback.php" method="post">
                    <div class="form-group">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    </div>
                    <div class="form-group">
                        <textarea name="content" id="" cols="84" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Отправить отзыв">
                    </div>
                </form>
            </div>
        </main>
        <footer>
        </footer>
    </div>
</div>
</body>
</html>