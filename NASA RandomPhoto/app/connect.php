<?php

try {
    $dbh = new PDO(DSN, USER, PASS);
    $dbh->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
} catch (PDOException $e) {
    echo "DB Error: code: " . $e->getCode() . ' | message: ' . $e->getMessage() . PHP_EOL;
    die("Виникла проблема!");
}