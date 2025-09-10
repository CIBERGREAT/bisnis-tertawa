<?php
// Ganti dengan API Key dari Paydisini
$API_KEY = "b3326bb4bdd27c1a8b67361891f72867";

// Ambil data dari request frontend
$data = json_decode(file_get_contents("php://input"), true);

$orderId = $data["order_id"];
$amount  = $data["amount"];

// Endpoint API Paydisini (cek dokumentasi resmi Paydisini)
$url = "https://api.paydisini.co.id/v1/transaction/create";

$payload = [
    "order_id"   => $orderId,
    "amount"     => $amount,
    "method"     => "qris", // contoh pakai QRIS
    "callback_url" => "https://domainmu.com/payment-callback.php"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $API_KEY
]);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
