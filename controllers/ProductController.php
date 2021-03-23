<?php


namespace app\controllers;

use app\base\Application;
use app\models\records\Product;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{
        public function actionIndex()
        {
                $products = (new ProductRepository())->getAll();
                echo $this->render('catalog', ['products' => $products]);
        }

        public function actionCard()
        {
                $id = $this->request->get('id');


                $product = (new ProductRepository())->getById($id);
                echo $this->render('card', ['product' => $product]);
        }
}
