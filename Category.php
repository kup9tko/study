<?php
class Category extends Object
{
    protected $id;
    protected $name;

    public $tableName = "Category";
    function __construct(){
        $this->connect();
    }

    function findById($idc){
        $this->id = $idc;
        $sql = "SELECT * FROM " . $this->tableName . " " . "WHERE id=" . $idc;
        $rs = $this->link->query($sql);
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    function getProducts(){
        $sql = "SELECT DISTINCT name FROM " . "Product" . " " . "WHERE category_id=" . $this->id;
        $rs = $this->link->query($sql);
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
}