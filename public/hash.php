<?php

echo "<h3>Generated Password Hashes</h3>";

$passwords = [
    "krys123",
    "krys12345",
    "francine123",
];

foreach ($passwords as $password) {
    echo "<strong>Password:</strong> $password<br>";
    echo "<strong>Hash:</strong> " . password_hash($password, PASSWORD_DEFAULT);
    echo "<hr>";
}