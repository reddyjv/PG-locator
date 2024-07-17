<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
  

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `checkout` WHERE name = '$product_name' AND c_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already MARKED!';
   }else{
      mysqli_query($conn, "INSERT INTO `checkout`(c_id, name, price, image) VALUES('$user_id', '$product_name', '$product_price',  '$product_image')") or die('query failed');
      $message[] = 'PG IS MARKED';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Search best PG/Hostel near you. </h3>
      <p>Discover the perfect accommodation that meets your needs and preferences effortlessly. </p>
      <a href="about.php" class="white-btn">discover more</a>
   </div>

</section>

<section class="products">

   <h1 class="title">Latest PGs</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `hostels` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="imageo" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
      <?php  $_SESSION['details'] = $fetch_products['id']; ?>
    
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      
      <a class="buttons" href="pgdetails.php?id=<?php echo $fetch_products['id']; ?>">more details</a>

      <input type="submit" value="BOOK NOW" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/hostel.jpeg" alt="">
      </div>

      <div class="content">
         <h3>About us</h3>
         <p>Discover your perfect hostel accommodation with us! Our platform connects travelers with a diverse range of hostels worldwide. Whether you're seeking a budget-friendly stay, a social atmosphere, or unique experiences, we've got you covered. With user-friendly search features and verified reviews, finding your ideal hostel has never been easier. Join our community of adventurers and start planning your next unforgettable journey today!</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p> Our dedicated team is here to assist you in any way possible. Contact Us to experience our commitment to exceptional service firsthand.</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>





<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>