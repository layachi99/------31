<?php
// Check if the form is submitted using the GET method
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve the color from the GET request (if it's set, otherwise default to white)
    $color = isset($_GET['color']) ? $_GET['color'] : '#ffffff'; // Default to white if no color is selected

    // Output the HTML content with dynamic background color
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Selected Color</title>
    </head>
    <body style='background-color: $color;'>"; // Set the background color dynamically
    echo "<h1>The selected color is: $color</h1>"; // Display the selected color on the page
    echo "</body></html>"; // End the body and html tags
}
?>
