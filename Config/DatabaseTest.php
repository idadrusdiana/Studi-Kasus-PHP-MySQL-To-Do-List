<?php

require_once __DIR__ . '/Database.php';

$db = \Config\Database::getConnection();
echo "Suksess membuat koneksi ke database";