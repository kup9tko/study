<?php
$pdo = new PDO("mysql:dbname=study;host=localhost", "root", "");
function printAll($rs){
    while ($row = $rs->fetch(PDO::FETCH_ASSOC)){
        //echo "{$row['name']} - {$row['age']}<br/>";
        foreach ($row as $value)
            echo "$value"." ";
        echo '<br/>';
    }
    echo '<br/><br/>';
}

$sql = "SELECT * FROM aaa";
printAll($pdo->query($sql));

//$sql = "SELECT * FROM aaa ORDER BY id DESC LIMIT 1";
//printAll($pdo->query($sql));
//
//$sql = "SELECT name FROM aaa";
//printAll($pdo->query($sql));

//if ( $pdo->exec("INSERT INTO aaa (name, age) VALUES ('kirill', '24')")) {
//    echo "<br/>";
//    echo "Success insert!";
//    echo "<br/>";
//    echo "<br/>";
//}

//$sql = "SELECT * FROM aaa";
//printAll($pdo->query($sql));
//
//$pdo->exec("UPDATE aaa SET age = 15 WHERE name = 'aaa'");
//$sql = "SELECT * FROM aaa";
//printAll($pdo->query($sql));

$sql = "select max(id) from aaa";
$rs = $pdo->query($sql);
$maxID;
while ($row = $rs->fetch(PDO::FETCH_ASSOC)){
    foreach ($row as $value){
        $maxID = $value;
    }
    echo '<br/>';
}

$sql = "select min(id) from aaa";
$rs = $pdo->query($sql);
$minID;
while ($row = $rs->fetch(PDO::FETCH_ASSOC)){
    foreach ($row as $value){
        $minID = $value;
    }
    echo '<br/>';
}

$pdo->exec("DELETE FROM aaa WHERE id = $maxID OR id = $minID");
$sql = "SELECT * FROM aaa";
printAll($pdo->query($sql));