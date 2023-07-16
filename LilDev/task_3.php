<?php

/*
* Accepts 2 parameters
* @return int
*/

class Product{

    public $sku = null;
    public $stock = null;

    public function __construct(int $sku, int $stock){
        $this->sku = $sku;
        $this->stock = $stock;
    }

    public function getSku(){
        return $this->sku;
    }

    public function getStock(){
        return $this->stock;
    }

}


/*
* Create list of instances of the "Product" class
* @method setProductStockValue Output by the product sku
* @return int
*/

class ProductsDataset{

    public $arr = [];

    public function addProduct(int $sku, int $stock){

        $count = 0;
        $value = 0;

        foreach($this->arr as $key => $val){

            if($this->arr[$key]->getSku() === $sku){
                $value = $this->arr[$key]->getSku();
                $count++;

            }

        }

        if ($count !== 0){
            echo "Error: variable is already in use SKU({$value}) </br>";
        }else{
            $this->arr [] = new Product($sku, $stock);
        }


    }

    function setProductStockValue(int $id): ?int{

        foreach($this->arr as $key => $val){

            if($this->arr[$key]->getSku() === $id){

                return $this->arr[$key]->getStock();

            }

        }
        return null;
    }

}

$test = new ProductsDataset();
$test->addProduct(6626, 897);
$test->addProduct(666, 8197);
$test->addProduct(435, 75);
$test->addProduct(22, 897);
$test->addProduct(11, 57);
$test->addProduct(4411, 57);
$test->addProduct(119, 57777);

print $test->setProductStockValue(22);
