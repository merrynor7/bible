
<?php
// Get the book ID from the URL
$book = $_GET['book'] ?? 'GEN';

// API URL
$url = "https://bible-api.com/data/KJV/" . urlencode($book);

// Fetch data using cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);

if ($response === false) {
    die("cURL Error: " . curl_error($ch));
}

curl_close($ch);

// Decode JSON response
$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON Error: " . json_last_error_msg());
}

// Display book information and chapters
echo "<h2>Bible Book Chapters</h2>";

if (isset($data['chapters']) && is_array($data['chapters'])) {
    echo "<h3>Book: " . htmlspecialchars($book) . "</h3>";

    foreach ($data['chapters'] as $chapter) {
        $number = $chapter['chapter'] ?? $chapter['number'] ?? '';
        echo "Chapter: " . htmlspecialchars((string)$number) . "<br>";
    }
} else {
    echo "No chapter list found. API response:";
    echo "<pre>" . htmlspecialchars(
        json_encode($data, JSON_PRETTY_PRINT)
    ) . "</pre>";
}
?>
