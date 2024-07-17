<?php

include 'config.php';

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>recents</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
      /* CSS for centering the table */
      .table-container {
         display: flex;
         justify-content: center;
         margin-top: 20px;
      }
      table {
         border-collapse: collapse;
         width: 80%;
         margin-left: 300px;
         margin-top: 100px;
      }
      th, td {
         border: 1px solid #ddd;
         padding: 12px;
         text-align: left;
         font-size: 16px;
      }
      th {
         background-color: #f2f2f2;
         font-weight: bold;
      }
      tr:nth-child(even) {
         background-color: #f2f2f2;
      }
      tr:hover {
         background-color: #ddd;
      }
   </style>

</head>
<?php include 'admin_header.php'; ?>

<?php

// SQL query to fetch data from the 'logs' table
$sql = "SELECT id, hostel_id,action,cdate FROM logs";
$result = $conn->query($sql);

// Displaying the attributes
echo "<table border='1'>
    <tr>
        <th>ID</th>
        <th>Hostel ID</th>
        <th>Action</th>
        <th>Date</th>
    </tr>";

// Loop through the fetched data and display it in a table
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['hostel_id']}</td>
            <td>{$row['action']}</td>
            <td>{$row['cdate']}</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data found</td></tr>";
}

echo "</table>";

// Close database connection
$conn->close();
?>