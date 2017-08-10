<?php
class Product extends Object
{
    protected $id;
    protected $name;
    protected $description;
    protected $user_id;
    protected $category_id;

    protected $products = array();
    public $tableName="Product";
    function __construct(){
        $this->connect();
    }

    public function findBy($params)
    {
        $inObj = array();
        $inPro = array();
        $sb = 'id';
        $s = '';

        foreach ($params as $key => $value) {
            if ($key == 'id' || $key == 'name' || $key == 'description' || $key == 'user_id' || $key == 'category_id') {
                $inObj[] = $key . "='" . $value ."'";
            }
            else if($key == 'sortBy'){
                $sb = $value;
            }
            else if($key == 'sort'){
                $s = $value;
            }
            else $inPro[$key] = $value;
        }
        $sql = "SELECT " . (!empty($inPro) ? implode(', ', $inPro) : '*') . " FROM " . $this->tableName . (!empty($inObj) ? " WHERE " . implode(' AND ', $inObj) : '') . " ORDER BY " . $sb . " " . $s;
        $rs = $this->link->query($sql);
        $arr = $rs->fetchAll(PDO::FETCH_ASSOC);

        foreach ($arr as $row) {
            $product = new Product();
            foreach ($row as $property => $value) {
                $product->$property = $value;
            }
            $this->products[] = $product;
        }
        return $arr;
    }

    function getCategory(){
        $sql = "SELECT DISTINCT name FROM " . "Category" . " " . "WHERE id=" . $this->category_id;
        $rs = $this->link->query($sql);
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    function findAll(){
        $sql = "SELECT name FROM " . $this->tableName;
        $rs = $this->link->query($sql);
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUser(){
        $sql = "SELECT DISTINCT name FROM " . "User" . " " . "WHERE id=" . $this->user_id;
        $rs = $this->link->query($sql);

        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setProducts($value)
    {
        $this->products = $value;
    }
}

