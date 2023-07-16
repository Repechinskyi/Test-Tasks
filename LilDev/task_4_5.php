<?php

/*
 * Connect to DB
 */

$host = 'localhost';
$db = 'task4';
$user = 'root';
$pass = 'root';
$charset = 'utf8';

$dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];
$pdo = new PDO($dsn, $user, $pass, $opt);

echo '<pre>';

$stml = $pdo->query("SELECT ps.user_id, p.name, ps.id FROM user p LEFT JOIN message ps ON ps.user_id = p.id ORDER BY `p`.`name` ASC");

echo '<table border="1">
    <tr>
        <th>Name user</th>
        <th>ID message</th>
    </tr>';

while ($row = $stml->fetch()){
    //var_dump($row);
    echo "<tr><td>{$row['name']}</td><td>{$row['id']}</td></tr>";
}
echo '</table>';

$stml_1 = $pdo->query("SELECT ps.name, COUNT(message) FROM message p LEFT JOIN user ps ON p.user_id = ps.id WHERE message_date_time>'2020-01-01' GROUP BY user_id");

echo '<table border="1">
    <tr>
        <th>Name user</th>
        <th>Number of messages</th>
    </tr>';

while ($roow = $stml_1->fetch()){
    
    echo "<tr><td>{$roow['name']}</td><td>{$roow['COUNT(message)']}</td></tr>";
}
echo '</table>';


