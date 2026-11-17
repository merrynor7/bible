<?php
$url = 'https://bible-api.com/data/KJV';


$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; PHP script)');

$response = curl_exec($ch);

if ($response === false) {
    die('cURL Error: ' . curl_error($ch));
}

curl_close($ch);


$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('JSON Error: ' . json_last_error_msg());
}


if (isset($data['books']) && is_array($data['books'])) {
    $number = 1;

    foreach ($data['books'] as $book) {
        echo $number . ".)<br>";
        echo "ID: " . htmlspecialchars($book['id'] ?? '') . "<br>";
        echo "Book Name: " . htmlspecialchars($book['name'] ?? '') . "<br><br>";

        $number++;
    }
} else {
    echo "No books found.";
}
?>