<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Fonts - Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <!-- Your custom CSS -->
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #343a40; /* Dark background color */
            color: #f8f9fa; /* Text color */
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 40px 0;
        }

        .recipe-details {
            max-width: 800px;
            margin: 0 auto;
        }

        .recipe-details h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        .recipe-image {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            color: #f8f9fa; /* Table text color */
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: #212529; /* Table header background color */
            font-weight: 700;
        }

        .table td {
            font-weight: 400;
        }

        .recipe-details p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .home-button {
            display: block;
            width: 120px;
            margin: 20px auto;
            padding: 10px 20px;
            text-align: center;
            background-color: #007bff; /* Blue color */
            color: #fff; /* Text color */
            text-decoration: none; /* Remove underline */
            border-radius: 5px;
        }

        .home-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body style="background-color: #343a40;">
    <div class="container">
        <?php
        // recipe.php

        // Replace 'YOUR_SPOONACULAR_API_KEY' with your actual API key
        $apiKey = 'add_your_api_key_here';

        if (isset($_GET['id'])) {
            // Retrieve the recipe ID from the URL parameters
            $recipeId = $_GET['id'];
            $apiUrl = "https://api.spoonacular.com/recipes/$recipeId/information?apiKey=$apiKey";
            // Construct the API URL with the recipe ID and API key
            $apiUrl = "https://api.spoonacular.com/recipes/$recipeId/information?apiKey=$apiKey";

            // Make a GET request to the Spoonacular API
            $response = file_get_contents($apiUrl);

            // Decode the JSON response
            $recipe = json_decode($response, true);

            // Display the recipe details in a table
            echo '<div class="recipe-details">';
            echo '<h1>' . $recipe['title'] . '</h1>';
            // Display the image (if available)
            if (!empty($recipe['image'])) {
                echo '<img src="' . $recipe['image'] . '" alt="' . $recipe['title'] . '" class="recipe-image">';
            }
            echo '<h2>Ingredients:</h2>';
            // Display ingredients in a table
            echo '<table class="table">';
            echo '<thead><tr><th>Ingredient</th></tr></thead>';
            echo '<tbody>';
            foreach ($recipe['extendedIngredients'] as $ingredient) {
                echo '<tr><td>' . $ingredient['original'] . '</td></tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '<h2>Instructions:</h2>';
            // Display instructions
            echo '<p>' . $recipe['instructions'] . '</p>';
            echo '</div>';
        }
        ?>
            <a href="index.html" class="home-button">Home</a>
    </div>
</body>
</html>
