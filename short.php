<?php
function shortenUrl($url) {
    $apiUrl = "http://tinyurl.com/api-create.php?url=" . urlencode($url);
    $response = file_get_contents($apiUrl);
    return $response;
}

$originalUrl = '';
$shortenedUrl = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $urlToShorten = $_POST["url"];
    $shortenedUrl = shortenUrl($urlToShorten);
    $originalUrl = $urlToShorten;
}

if (isset($_POST['clear'])) {
    $originalUrl = '';
    $shortenedUrl = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .url-container {
            margin-top: 20px;
            text-align: left;
        }

        .url-container p {
            margin: 5px 0;
            color: #333;
        }
    </style>
    <title>Shorten URL</title>
</head>
<body>
    <div class="container">
        <h1>URL Shortener</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="url">Enter URL:</label>
            <input type="url" id="url" name="url" required>
            <button type="submit">Shorten URL</button>
            <button type="submit" name="clear">Clear All</button>
        </form>

        <div class="url-container">
            <?php
            if (!empty($originalUrl) && !empty($shortenedUrl)) {
                echo "<p>Original URL: <a href=\"$originalUrl\" target=\"_blank\">$originalUrl</a></p>";
                echo "<p>Shortened URL: <a href=\"$shortenedUrl\" target=\"_blank\">$shortenedUrl</a></p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
