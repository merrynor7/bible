
<?php

// Get book and chapter from URL
$book = $_GET['book'] ?? 'Revelation';
$chapter = $_GET['chapter'] ?? '22';

// Build API URL
$reference = urlencode($book . ' ' . $chapter);
$url = 'https://bible-api.com/' . $reference . '?translation=kjv';

// Send GET request using cURL
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; PHP script)');

$response = curl_exec($ch);

if ($response === false) {
    die('cURL Error: ' . curl_error($ch));
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    die('API request failed. HTTP status: ' . $httpCode);
}

// Decode JSON
$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('JSON Error: ' . json_last_error_msg());
}

// Display verses
if (isset($data['verses']) && is_array($data['verses'])) {

    echo '<h2>' . htmlspecialchars($data['reference'] ?? '') . '</h2>';

    foreach ($data['verses'] as $verse) {
        echo '<p>';
        echo '<strong>' . htmlspecialchars((string)($verse['verse'] ?? '')) . '</strong> ';
        echo htmlspecialchars($verse['text'] ?? '');
        echo '</p>';
    }

} else {
    echo 'No verses found. Check the book and chapter.';
}

?>
