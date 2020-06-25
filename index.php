<?php


function getPDO()
{
    require '.const.php';
    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass);
    return $pdo;
}

function getPersons($table, $role)
{
    require '.const.php';
    try {

        $pdo = getPDO();

        $query = "SELECT idPerson, personLastName, personFirstName, personInitials FROM ".$table." WHERE role =:role234";
        $stmt = $pdo->prepare("$query");
        $stmt->execute(['role234' => $role]);
        $queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!:" . $e->getMessage() . "<br/>";
        die();
    }

}
function getTestPersons()
{
    $table = 'person';
    $role = 1;
    $items = getPersons($table, $role);
    return $items;
}

$items = getTestPersons();
?>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>LastName</th>
        <th>FirstName</th>
        <th>Initials</th>
    </tr>
    </thead>
<tbody>
<?php
foreach ($items as $item){
    ?>
    <tr>
        <td><?=$item['idPerson']?></td>
        <td><?=$item['personLastName']?></td>
        <td><?=$item['personFirstName']?></td>
        <td><?=$item['personInitials']?></td>
    </tr>
<?php
}
?>


</tbody>
</table>