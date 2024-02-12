<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Search</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Your custom CSS -->
    <style>
        /* Set dark background color */
        body {
            background-color: #343a40;
            color: #fff;
        }

        /* Additional CSS styling for recipe container */
        .recipe-container {
            margin-top: 20px;
        }

        /* Additional CSS styling for recipe table */
        .recipe-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px; /* Adjust spacing between rows */
        }

        .recipe-row {
            background-color: #212529; /* Dark background for recipe row */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
            border-radius: 10px;
        }

        .recipe-row:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .recipe-image {
            max-width: 200px; /* Set maximum width */
            height: auto; /* Maintain aspect ratio */
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .recipe-details {
            padding: 20px;
        }

        .recipe-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .view-recipe-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .view-recipe-btn:hover {
            background-color: #0056b3;
            text-decoration: none;
        }
   

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col mt-2">
                <h1><button class="btn btn-warning">Recipe Search</button></h1>
            </div>
            <div class="col text-end mt-3"> <!-- Align the home button to the right and give margin top -->
                <a href="index.html" class="btn btn-primary">Home</a> <!-- Assuming index.php is your home page -->
            </div>
        </div>
        <?php
        // API integration
        $apiKey = 'add_your_api_key_here';
        if (isset($_GET['query'])) {
            $query = urlencode($_GET['query']);
            $apiUrl = "https://api.spoonacular.com/recipes/search?apiKey=$apiKey&query=$query";
            $response = file_get_contents($apiUrl);
            $recipes = json_decode($response, true);

            if (empty($recipes['results'])) {
                echo '<div class="alert alert-warning" role="alert">No recipes found for the search query.</div>';
            } else {
                echo '<div class="row recipe-container">';
                echo '<table class="recipe-table">';
                foreach ($recipes['results'] as $recipe) {
                    echo '<tr class="recipe-row">';
                    echo '<td class="col-12 col-md-3">';
                    $imageUrl = 'https://spoonacular.com/recipeImages/' . $recipe['image'];
                    echo '<img src="' . $imageUrl . '" alt="' . $recipe['title'] . '" class="recipe-image">';
                    echo '</td>';
                    echo '<td class="col-12 col-md-9 recipe-details">';
                    echo '<h3 class="recipe-title">' . $recipe['title'] . '</h3>';
                   
                    echo '<a href="recipe.php?id=' . $recipe['id'] . '" class="view-recipe-btn">View Recipe</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
            }
        }
        ?>
    
    </div>
</body>
</html>
