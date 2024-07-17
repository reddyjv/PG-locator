<?php

include 'config.php';

session_start();

?>

<?php include 'admin_header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>PG Finder</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
      /* Additional CSS Styles */
      body {
         font-family: Arial, sans-serif;
         background-color: #f8f9fa;
         margin: 0;
         padding: 0;
      }

      .container {
         max-width: 800px;
         margin: 50px auto;
         padding: 20px;
         background-color: #fff;
         border-radius: 8px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      h1 {
         text-align: center;
         margin-bottom: 20px;
         color: #333;
      }

      form {
         margin-bottom: 20px;
         text-align: center;
      }

      label {
         display: block;
         margin-bottom: 10px;
         font-weight: bold;
         color: #555;
      }

      input[type="text"] {
         width: 100%;
         padding: 10px;
         font-size: 16px;
         border: 1px solid #ccc;
         border-radius: 5px;
         margin-bottom: 20px;
      }

      button {
         padding: 10px 20px;
         font-size: 16px;
         cursor: pointer;
         background-color: #007bff;
         color: #fff;
         border: none;
         border-radius: 5px;
      }

      button:hover {
         background-color: #0056b3;
      }

      #pgInfo {
         text-align: center;
         margin-top: 20px;
      }

      #pgInfo h2 {
         margin-bottom: 10px;
         color: #333;
      }

      #pgInfo p {
         margin-bottom: 5px;
         color: #555;
      }
   </style>
</head>
<body>
    <div class="container">
        <h1>PG Finder</h1>
        <form id="searchForm" method="post">
            <label for="userId">Enter User ID:</label>
            <input type="text" id="userId" name="userId" required>
            <button type="submit">Find PG</button>
        </form>
        <div id="pgInfo">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userId'])) {
                $userId = $_POST['userId'];
                
              

            

                // Prepare and execute stored procedure
                $stmt = $conn->prepare("CALL FindPGByUserID(?)");
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<h2>PG Information:</h2>";
                        echo "<p><strong>ID:</strong> " . $row["total_products"]. "</p>";
                       
                    }
                } else {
                    echo "No PG information found for the provided user ID.";
                }

                // Close connection
                $conn->close();
            }
            ?>
        </div>
    </div>