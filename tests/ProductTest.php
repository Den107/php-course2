<?php



class ProductTest extends \PHPUnit\Framework\TestCase
{
  public function testPrice()
  {
    $product = new \app\models\records\Product();
    $product->id = 1;
    $product->title = 'Title';
    $product->price = 1000;

    $this->assertEquals('products', $product->getTableName());
  }
}
