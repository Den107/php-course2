<!-- <!doctype html>
<html lang="en">
<head>
    <?php include VIEWS_DIR . "blocks/head.php"; ?>
</head>
<body>
<div class="row justify-content-center">
    <div class="col-md-6">
        <header>
            <?php include VIEWS_DIR . "blocks/menu.php"; ?>
        </header>
        <main> -->
<div class="row row-cols-1 row-cols-md-3">
    <?php foreach ($products as $product) : ?>
        <div class="card mb-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><?= $product->title ?></h5>
                <p class="card-text"><?= $product->description ?></p>
            </div>
            <div class="card-footer">
                <a href="/card.php?id=<?= $product->id; ?>" class="btn btn-primary">Посмотреть</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- </main>
        <footer>
        </footer>
    </div>
</div>
</body>
</html> -->