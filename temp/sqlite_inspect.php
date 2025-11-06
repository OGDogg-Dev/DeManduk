<?php

$db = new SQLite3(__DIR__ . '/../database/database.sqlite');

$res = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%' ORDER BY name;");

while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
    echo $row['name'], PHP_EOL;
}
