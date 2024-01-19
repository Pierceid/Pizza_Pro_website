<?php

use App\Core\DB\Connection;

$con = Connection::connect();
$sql = "SELECT id, login, email, isAdmin FROM vaiicko_db.users WHERE ? ORDER BY id";
$stmt = $con->prepare($sql);
$stmt->execute();
$users = [];

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $users[] = $result;
}

if (count($users) > 0) {
    for ($i = 0; $i < count($users); $i++) {
        echo "<tr>
            <td>" . $users[$i]['id'] . "</td>
            <td>" . $users[$i]['login'] . "</td>
            <td>" . $users[$i]['email'] . "</td>
            <td>" . $users[$i]['isAdmin'] . "</td>
          </tr>";
    }
} else {
    echo "<tr><td>0 results found</td></tr>";
}


