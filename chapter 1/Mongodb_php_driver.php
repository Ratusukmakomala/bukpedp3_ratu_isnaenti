<?php
require 'vendor/autoload.php';

use MongoDB\Client;

// Koneksi ke server MongoDB
$client = new Client('mongodb://localhost:27017');

// Pilih database dan koleksi
$database = $client->nama_database;
$koleksi = $database->nama_koleksi;

// Query dan operasi lainnya
