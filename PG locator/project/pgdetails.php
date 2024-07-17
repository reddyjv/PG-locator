<?php
session_start();
include 'config.php';

// Check if the ID is provided in the URL
if(isset($_GET['id'])) {
    // Get the product ID from the URL
    $product_id = $_GET['id'];

    // Retrieve product details from the database based on the product ID
    // This is just a placeholder. You need to write the code to fetch product details from the database.
    // For example:
    $query = "SELECT * FROM hostels WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
?>
<?php
if(isset($_POST['add'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $ratings = $_POST['rate'];
   $id=$_POST['pg-id'];
   $uid=$_POST['uid'];
    $usr=mysqli_real_escape_string($conn,$_POST['user-review']);
    $add_product_query = mysqli_query($conn, "INSERT INTO `reviews`(uid,username, pgid, rating,description) VALUES('$uid','$name', '$id', '$ratings','$usr')") or die('query failed');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Information</title>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
    <div class="container">
        <section class="hostel-info">
            <div class="hostel-image">
            <img class="imageo" src="uploaded_img/<?php echo $product['image']; ?>" alt="">
            </div>
            <div class="hostel-details">
                <h1><?php echo $product['name']; ?></h1><br><br>
                <p><strong>Location:</strong> <?php echo $product['location']; ?></p><br>
                <p><strong>Price:</strong> ₹<?php echo $product['price']; ?> per month</p><br>
                <p><strong>sharing:</strong> <?php echo $product['sharing']; ?></p><br>
                <p><strong>facilities:</strong> <?php echo $product['facilities']; ?></p><br>
            </div>
        </section>

        <section class="reviews">

            <h2>Reviews</h2>
            <br>
            <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `reviews` where pgid=$product_id") or die('query failed');
        
      
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_products)){
                
      ?>
            <div class="review">
                <div class="user-info">
                   
                    <p><?php echo $fetch_product['username'] ?></p> 
                    
                </div>
                <br>
                <div>
                    <p>Ratings:<?php echo $fetch_product['rating'] ?>/5</p>
                </div>
                
                <p class="user-review"><?php echo $fetch_product['description'] ?></p>
            </div>
            </section>
     <?php
            }   
        }else{
            echo '<p class="empty">No reviews written</p>';
        }
    
        ?>
          
            <!-- More reviews can be added dynamically -->
       

        <section class="write-review">
            <h2>Write a Review</h2>
            <form action="#" method="post">
            <input type="hidden" id="user-name" name="uid" value="<?php echo    $_SESSION['user_id']   ?>"required> 
                <input type="hidden" id="user-name" name="name" value="<?php echo  $_SESSION['user_name']  ?>"required> 
                <input type="hidden" id="user-name" name="pg-id" value="<?php echo  $product_id ?>" required><br>
                
                <label>Rating:</label>
                <select name="rate">
                    <option value="1">1</option>
                    <option value="1.5">1.5</option>
                    <option value="2">2</option>
                    <option value="2.5">2.5</option>
                    <option value="3">3</option>
                    <option value="3.5">3.5</option>
                    <option value="4">4</option>
                    <option value="4.5">4.5</option>
                    <option value="5">5</option>
                </select>
                <br>
                <br>
                <label for="user-review">Your Review:</label><br>
                <textarea id="user-review" name="user-review" rows="4" cols="50" required></textarea><br><br>
                <input type="submit" name="add" value="Submit Review" class="end">
            </form>
        </section>
    </div>
</body>
</html>



<?php
}else{
    // Handle the case when product ID is not provided in the URL
    echo "Product ID not provided!";
}
?>
