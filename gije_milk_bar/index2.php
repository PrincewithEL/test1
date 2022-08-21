<?php
require_once 'dbconnection.inc.php';
session_start();

if (!isset($_SESSION['Email2']) && !isset($_SESSION['custname'])) {
    header("Location: index.html");
}else{
  $email = $_SESSION['Email2'];
  $query=mysqli_query($conn,"SELECT * FROM `customer` WHERE `Email_Address`='$email'")or die(mysqli_error());
  $row=mysqli_fetch_array($query);
}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Gije Milk Bar ~ Customer Homepage</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <!-- style -->
   <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<!-- end style -->
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- banner -->
      <section class="banner_main">
         <div class="container-fluid">
            <div class="row d_flex ">
               <div class="col-xl-4 col-lg-4 col-md-12">
                  <div class="banner_main_text">
                     <img class="logo" src="images/gije_logo.png" alt="#"/>
                     <div class="titlepage">
                        <h2>GIJE<br> Milk Bar for <br>Farmers <br>Everywhere.</h2>
                        <p>Welcome Customer, <?php echo $row['Name']; ?>!
                        <br>
                        Customer ID : <?php echo $row['Customer_ID']; ?>  </p>
                        <a class="read_more" href="logout.php">Logout</a>
                     </div>
                  </div>
               </div>
               <div class="col-xl-8 col-lg-8 col-md-12 padding_right">
                  <div class="banner_main_img">
                     <figure><img src="images/2.jpg" alt="#"/>
                        <h3 style="margin-bottom: 250px;">GIJE Milk Bar</h3>
                     </figure>

                  </div>
               </div>
            </div>
         </div>
      </section>
      <br>
      <br>
      <!-- end banner -->
      <!-- database -->
            <div id="about"  class="about">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-xl-7 col-lg-7 col-md-12 padding_lert">
                  <div class="about_img">
                     <figure><img src="images/product.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-xl-5 col-lg-5 col-md-12">
                  <div class="about_text">
                     <div class="titlepage">
                        <h2>Products</h2>
                        <p>The following are the products under our system:</p>
  <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Product ID</th>
<th style="text-align: left;
  padding: 8px;">Description</th>
  <th style="text-align: left;
  padding: 8px;">Stock Quantity</th>
  <th style="text-align: left;
  padding: 8px;">Price (.kshs)</th>
  <th style="text-align: left;
  padding: 8px;">Expiry Date</th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "gije_milk_bar");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `Product_ID`, `Description`, `Stock_Quantity`, `Price`, `Expiry_Date` FROM `product`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["Product_ID"] . "</td><td>" . $row["Description"] . "</td><td>" . $row["Stock_Quantity"] . "</td><td>" . $row["Price"] . "</td><td>" . $row["Expiry_Date"] . "</td></tr>";
}
echo "</table>";
} else { echo "No results"; }
$conn->close();
?>

</table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
      <br>
      <div id="about"  class="about">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-xl-7 col-lg-7 col-md-12 padding_lert">
                  <div class="about_img">
                     <figure><img src="images/order.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-xl-5 col-lg-5 col-md-12">
                  <div class="about_text">
                     <div class="titlepage">
                        <h2>Orders</h2>
                        <p>The following are the order made under our system:</p>
 <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Order ID</th>
<th style="text-align: left;
  padding: 8px;">Customer ID</th>
  <th style="text-align: left;
  padding: 8px;">Staff ID</th>
  <th style="text-align: left;
  padding: 8px;">Order Time</th>
  <th style="text-align: left;
  padding: 8px;">Status
  <th style="text-align: left;
  padding: 8px;">Total Price (.kshs)</th>
  <th style="text-align: left;
  padding: 8px;">Remarks</th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "gije_milk_bar");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `Order_ID`, `Customer_ID`, `Staff_ID`, `Order_Time`, `Status`, `Total_Price`, `Remarks` FROM `orders`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["Order_ID"] . "</td><td>" . $row["Customer_ID"] . "</td><td>" . $row["Staff_ID"] . "</td><td>" . $row["Order_Time"] . "</td><td>" . $row["Status"] . "</td><td>" . $row["Total_Price"] . "</td><td>" . $row["Remarks"] . "</td></tr>";
}
echo "</table>";
} else { echo "No results"; }
$conn->close();
?>

</table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
      <br>
      <div id="about"  class="about">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-xl-7 col-lg-7 col-md-12 padding_lert">
                  <div class="about_img">
                     <figure><img src="images/product1.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-xl-5 col-lg-5 col-md-12">
                  <div class="about_text">
                     <div class="titlepage">
                        <h2>Ordered Product</h2>
                        <p>The following are the products that have been ordered under our system:</p>
 <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Order Code</th>
<th style="text-align: left;
  padding: 8px;">Order ID</th>
  <th style="text-align: left;
  padding: 8px;">Product ID</th>
  <th style="text-align: left;
  padding: 8px;">Quantity</th>
  <th style="text-align: left;
  padding: 8px;">Price (.kshs)</th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "gije_milk_bar");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `Code`, `Order_ID`, `Product_Code`, `Quantity`, `Price` FROM `order_product`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["Code"] . "</td><td>" . $row["Order_ID"] . "</td><td>" . $row["Product_Code"] . "</td><td>" . $row["Quantity"] . "</td><td>" . $row["Price"] . "</td></tr>";
}
echo "</table>";
} else { echo "No results"; }
$conn->close();
?>

</table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
      <br>
      <div id="about"  class="about">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-xl-7 col-lg-7 col-md-12 padding_lert">
                  <div class="about_img">
                     <figure><img src="images/pay.jpg" alt="#"/></figure>
                  </div>
               </div>
               <div class="col-xl-5 col-lg-5 col-md-12">
                  <div class="about_text">
                     <div class="titlepage">
                        <h2>Payments</h2>
                        <p>The following are the payments made under our system:</p>
 <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Transaction ID</th>
<th style="text-align: left;
  padding: 8px;">Customer ID</th>
  <th style="text-align: left;
  padding: 8px;">Order ID</th>
<th style="text-align: left;
  padding: 8px;">Payment Time & Date</th>
  <th style="text-align: left;
  padding: 8px;">Price (.kshs)</th>
    <th style="text-align: left;
  padding: 8px;">Status</th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "gije_milk_bar");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `Transaction_ID`, `Customer_ID`, `Order_ID`, `Payment_Time`, `Amount`, `Status` FROM `payment`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["Transaction_ID"] . "</td><td>" . $row["Customer_ID"] . "</td><td>" . $row["Order_ID"] . "</td><td>" . $row["Payment_Time"] . "</td><td>" . $row["Amount"] . "</td><td>" . $row["Status"] . "</td></tr>";
}
echo "</table>";
} else { echo "No results"; }
$conn->close();
?>

</table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
      <br>
      <!-- end database -->
      <!-- our -->
      <div id="start"  class="our">
         <div class="container-fluid">
            <div class="row d_flex">
               <div class="col-xl-5 col-lg-5 col-md-12 order_2">
                  <div class="our_text">
                     <div class="titlepage">
                        <h2>Customer Actions</h2>
                        <form method="POST" action="insertion.inc.php">
  <fieldset>
    <legend>Cancel An Order:</legend>
    Order ID:<br>
    <input type="text" required="" name="oid" placeholder="Input ID...">
    <br><br>
    <input type="submit" name="cancel" value="Cancel">
  </fieldset>
</form>
<br>
<form method="POST" action="insertion.inc.php">
  <fieldset>
    <legend>Place An Order:</legend>
    Product ID:<br>
    <input type="text" required="" name="pid" placeholder="Product ID...">
    <br>
    Price:<br>
    <input type="text" required="" name="price" placeholder="Enter Price...">
    <br>
    Quantity:<br>
    <input type="text" required="" name="quan" placeholder="Quantity...">
    <br>
    Customer ID:<br>
    <input type="text" required="" name="cid" placeholder="Enter Your Customer ID...">
    <br>
    Remarks (if none input NULL):<br>
    <input type="text" required="" name="rem" placeholder="Remarks if any...">
    <br><br>
    <input type="submit" name="order" value="Place Order">
  </fieldset>
</form>
<br>
                     </div>
                  </div>
               </div>
               <div class="col-xl-7 col-lg-7 col-md-12 padding_right order_1">
                  <div class="our_img">
                     <figure><img src="images/start.jpg" alt="#"/></figure>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <br>
      <br>
      <!-- end our -->
      <!--  footer -->
      <footer>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="cont">
                        <h3>Let’s Talk</h3>
                        <p>Email Address : <a href="mailto:gije.business@gmail.com">gije.business@gmail.com</a> <br>
                           Phone Number : 0732866685  
                        </p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>Copyright 2022.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
   </body>
</html>