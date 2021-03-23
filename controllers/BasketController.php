<?php


namespace app\controllers;


use app\interfaces\RendererInterface;
use app\models\Basket;

class BasketController extends Controller
{
    /** @var Basket */
    protected $basket;

    public function __construct()
    {
        parent::__construct();
        $this->basket = new Basket();
    }

    public function actionIndex()
    {
        echo $this->render('basket', ['basket' => $this->basket->getAll()]);
    }

    public function actionAdd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->basket->add($_POST['product_id'], $_POST['qty']);
        }
        echo json_encode(['status' => 'success', 'message' => 'товар успешно добавлен в корзину']);
    }

    public function actionRemove()
    {
        if (isset($_GET['id'])) {
            $this->basket->remove($_GET['id']);
        }
        $this->redirectToReferer();
    }
}
