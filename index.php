<?php

$apiUrl = 'http://localhost:1234/v1/chat/completions';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);

    if ($inputData && isset($_POST['inputValue'])) {
        echo "form submitted";

        $inputValue = $_POST['inputValue'];

        $data = [
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Youre a expert in making recipes, And the user needs your help. The user wants to make a recipe with the following ingredients that the user gives you in the prompt of the user."
                ],
                [
                    "role" => "user",
                    "content" => $inputValue
                ],
            ],
        ];

        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);

        var_dump($result);
    }
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Recipe</title>
</head>
<body>
    <h1>Generate Recipe</h1>

    <form method="POST">
        <input id="inputValue" name="inputValue" type="text">
        <button>Generate a recipe</button>
    </form>

    <script src="script.js"></script>
</body>
</html>