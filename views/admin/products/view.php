<!doctype html>
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
        <main>
            <h2>Создание нового товара</h2>
            <div class="row col-md-12">
                <form action="/admin/products/save.php" method="post">
                    <?php if(isset($product)):?>
                    <input type="hidden" name="product[id]" value="<?=$product['id']?>">
                    <?php endif;?>
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" name="product[title]" value="<?= $product['title'] ?? '' ?>"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea name="product[description]" class="form-control" id="" cols="84"
                                  rows="4"><?= $product['description'] ?? '' ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Цена</label>
                        <input type="text" name="product[price]" value="<?= $product['price'] ?? '' ?>"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="<?=isset($product)? 'Обновить': 'Создать'?>">
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