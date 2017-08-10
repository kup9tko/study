<?php
class Object{
    private $data = array();
    public $tableName = "tableName";
    protected $dsn = "mysql:dbname=study;host=localhost", $username = "root", $password = "";
    public $link;

    public function __construct(){
        $this->connect();
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        else return null;
    }

    protected function connect()
    {
        $this->link = new PDO($this->dsn, $this->username, $this->password);
    }

    public function save($params){
        $whereK = array();
        $whereV = array();
        $where = array();
        foreach ($params as $key => $value) {
            if($key != 'id') {
                $whereK[] = $key;
                $whereV[] = $value;
                $where[] = $key . "='" . $value ."'";
            }
        }
        $id = $params['id'];

        $sqlINS = "INSERT INTO " . $this->tableName . " " . "(" . (!empty($whereK) ? implode(', ', $whereK) : '') . ") VALUES ('" .  implode('\', \'', $whereV) . "')";
        $sqlUp = "UPDATE " . $this->tableName . " " . (!empty($where) ? "SET " . implode(', ', $where) : '') . " WHERE id=" . $id;

        $flag1 = false;

        if($this->link->exec($sqlUp)) {
            echo "update";
            $flag1 = true;
        }
            else echo "notUpdate";
        if (($this->link->exec($sqlINS)) && !($flag1))
            echo "save";
        else
            echo "notSave";
    }

    public function findBy($params){
        $where = array();
        foreach ($params as $key => $value) {
                $where[] = $key . "='" . $value ."'";
        }
        $sql = "SELECT * FROM " . $this->tableName . " " . (!empty($where) ? "WHERE " . implode(' AND ', $where) : '');
        $rs = $this->link->query($sql);
        return $rs->fetchAll(PDO::FETCH_ASSOC);
    }
};

include 'Product.php';
include 'User.php';
include 'Category.php';

$a = new Product();


//foreach($a->findAll() as $v){
//    foreach ($v as $value){
//        echo $value . " ";
//    }
//    echo "<br/>";
//}

echo "<br/>";

$a->findBy(array("name" => "milk", "sort" => "DESC"));
$arr = $a->getProducts();

foreach ($a->findBy(array("name" => "milk", "sort" => "DESC", "sortBy" => "name")) as $v){
    foreach($v as $value){
        echo $value . " ";
    }
    echo "<br/>";
}

echo "<br/>";

foreach ($arr as $product){
    foreach($product->getUser() as $v){
        foreach ($v as $value){
            echo $value . " ";
        }
        echo "<br/>";
    }
}

echo "<br/>";

$user = new User();
$user->findById(2);
foreach ($user->getProducts() as $v){
    foreach($v as $value){
        echo $value . " ";
    }
    echo "<br/>";
}

echo "<br/>";

echo $user->getCountProducts();

echo "<br/><br/>";

foreach ($user->getCategories() as $v){
    foreach($v as $value){
        echo $value . " ";
    }
    echo "<br/>";
}