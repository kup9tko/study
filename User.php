<?php
class User extends Object
{
    protected $id;
    protected $name;

    public $tableName = "User";
    function __construct(){
        $this->connect();
    }

    function findById($idu){
        $this->id = $idu;
        $sql = "SELECT * FROM " . $this->tableName . " " . "WHERE id=" . $idu;
        $rs = $this->link->query($sql);
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    function getProducts(){

        $sql = "SELECT name FROM " . "Product" . " " . "WHERE user_id=" . $this->id;
        $rs = $this->link->query($sql);
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCategories(){
        $sql = "SELECT DISTINCT category_id FROM " . "Product" . " " . "WHERE user_id=" . $this->id;
        $rs = $this->link->query($sql);
        $id_category = array();
        while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
            foreach ($row as $value) {
                $id_category[] = $value;
            }
        }
        $sql = "SELECT name FROM Category " . "WHERE id=" . implode(' OR id=',$id_category);
        $rs = $this->link->query($sql);
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCountProducts(){

        $sql = "SELECT name FROM " . "Product" . " " . "WHERE user_id=" . $this->id;
        $rs = $this->link->query($sql);
        $count = 0;
        while ($row = $rs->fetch(PDO::FETCH_ASSOC)){
            $count++;
        }
        return $count;
    }
}