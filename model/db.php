<?php

function getPDO()
{
    require '.const.php';
    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass);
    return $pdo;
}

function getTable($table, $role)
{
    try {

        $pdo = getPDO();

        $query = "SELECT idPerson, personLastName, personFirstName, personInitials FROM ".$table." WHERE role =:role";
        $stmt = $pdo->prepare("$query");
        $stmt->execute(['role' => $role]);
        $queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!:" . $e->getMessage() . "<br/>";
        die();
    }

}
function getTestTable()
{
    $table = 'person';
    $role = 1;
    $items = getTable($table, $role);
}
getTestTable();
var_dump($items);

