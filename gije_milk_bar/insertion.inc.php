<?php 

date_default_timezone_set('Africa/Nairobi');


//Register Customer
if (isset($_POST['regc'])) {
 $fname = $_POST['name'];
 $email = $_POST['email'];
 $phone = $_POST['phone'];
 $address = $_POST['address'];
 $password = $_POST['password'];
 $passwordconfirm = $_POST['cpassword'];

 require_once 'dbconnection.inc.php';

 if ($password == $passwordconfirm) {
   $sql = "INSERT INTO `customer`(`Name`, `Contact_No`, `Address`, `Email_Address`, `Password`) VALUES ('$fname','$phone','$address','$email',md5('$password'))";
     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index.html?customerregistration=success");
 }else{
  echo "Passwords do not match.";
 }
}

//MANAGER Section
//Delete Service Representative OR Product 
if (isset($_POST['delete'])) {
  $id = $_POST['id'];
  $module = $_POST['mod'];    
  $s = "Service Representative";
  $p = "Products";

require_once 'dbconnection.inc.php';

if ($module == $s){

  $sql = "DELETE FROM `staff` WHERE `Staff_ID` = '$id'";

  mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index.php?deleteservicerepresentative=success");
}else if ($module == $p){

  $sql = "DELETE FROM `product` WHERE `Product_ID` = '$id'";

  mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index.php?deleteproduct=success");
} else{
  echo "An error occured. Kindly chose a valid item.";
}
}

//Add a Service Representative
if (isset($_POST['addsr'])) {
 $fname = $_POST['name'];
 $email = $_POST['email'];
 $mid = $_POST['mid'];
 $password = $_POST['password'];
 $passwordconfirm = $_POST['cpassword'];

 require_once 'dbconnection.inc.php';

 if ($password == $passwordconfirm) {
   $sql = "INSERT INTO `staff`(`Name`, `Job_Title`, `Supervisor`, `Email_Address`, `Password`) VALUES ('$fname','Service Supervisor','$mid','$email',md5('$password'))";
     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index.php?servicerepresentativeregistration=success");
 }else{
  echo "Passwords do not match.";
 }
}

//Add a Product 
if (isset($_POST['addp'])) {
 $desc = $_POST['desc'];
 $quan = $_POST['quan'];
 $price = $_POST['price'];
 $exp = $_POST['exp'];

 require_once 'dbconnection.inc.php';

$sql = "INSERT INTO `product`(`Description`, `Stock_Quantity`, `Price`, `Expiry_Date`) VALUES ('$desc','$quan','$price','$exp')";
     mysqli_query($conn, $sql);
   // var_dump($sql);
   // die();
  header("Location: index.php?addproduct=success");
 }

//SERVICE REPRESENTATIVE Section
//Process A Payment
if (isset($_POST['addpay'])) {
 $oid = $_POST['oid'];
 $sid = $_POST['sid'];
 $status = $_POST['status'];
 $today = date("Y-m-d H:i:s");

 require_once 'dbconnection.inc.php';

  $sql = "SELECT * FROM `orders` WHERE `Order_ID`='$oid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            $cid = $row['Customer_ID'];
            $amo = $row['Total_Price'];

   $sql1 = "INSERT INTO `payment`(`Customer_ID`, `Order_ID`, `Payment_Time`, `Amount`, `Status`) VALUES ('$cid','$oid','$today','$amo','$status')";
   $sql2 = "UPDATE `orders` SET `Staff_ID`='$sid',`Status`='$status' WHERE `Order_ID`='$oid'";
     mysqli_query($conn, $sql1);
     mysqli_query($conn, $sql2);
   // var_dump($sql);
   // die();
  header("Location: index1.php?addppayment=success");
 }else{
  echo "Order not found, kindly try again with an existing Order ID.";
 }
}

//Update A Payment
if (isset($_POST['uppay'])) {
 $tid = $_POST['tid'];
 $stat = $_POST['stat'];

 require_once 'dbconnection.inc.php';

 $sql = "SELECT * FROM `payment` WHERE `Transaction_ID`='$tid'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){

   $sql1 = "UPDATE `payment` SET `Transaction_ID`='$tid' WHERE `Status`='$stat'";
     mysqli_query($conn, $sql1);
   // var_dump($sql);
   // die();
  header("Location: index.php?updatepayment=success");
 }else{
  echo "Payment not found, kindly try again with an existing Transaction ID.";
 }
}

 //USER Section
 //Place An Order
 if (isset($_POST['order'])) {
 $cid = $_POST['cid'];
 $pid = $_POST['pid'];
 $price = $_POST['price'];
 $rem = $_POST['rem'];
 $quan = $_POST['quan'];

 $today = date("Y-m-d H:i:s");
 //$total = array_sum($price);
 $total = $price * $quan;

 require_once 'dbconnection.inc.php';

 $sql4 = "SELECT * FROM `product` WHERE `Product_ID`='$pid'";
$query4 = mysqli_query($conn,$sql4);
if(mysqli_num_rows($query4) > 0){
           $row4 = mysqli_fetch_assoc($query4);
           $amo = $row4['Stock_Quantity'];

           $newamo = $amo - $quan;

           if ($newamo != 0) {
$sql2 = "UPDATE `product` SET `Stock_Quantity`='$newamo' WHERE `Product_ID`='$pid'";

mysqli_query($conn, $sql2);

 // Insert order data into the database 
            $sqlQ = "INSERT INTO orders(Customer_ID, Staff_ID, Order_Time, Status, Total_Price, Remarks) VALUES (?,?,NOW(),'Pending...',?,?)"; 
            $stmt = $conn->prepare($sqlQ); 
            $stmt->bind_param("iids", $db_cid, $db_cid1, $db_total, $db_status); 
            $db_cid = $cid; 
            $db_cid1 = $cid; 
            $db_status = $rem; 
            $db_total = $total;
            $insertOrd = $stmt->execute();

            if($insertOrd){ 
                $ordID = $stmt->insert_id; 

                // Insert order product details in the database 
        //         foreach ($pid as $key => $value) 
        // { 
        //     $temppid = $pid[$key];
        //     $tempquan = $quan[$key];
        //     $tempprice = $price[$key];

                $temppid = $pid;
            $tempquan = $quan;
            $tempprice = $price;

            $sql = "INSERT INTO order_product(Order_ID, Product_Code, Quantity, Price) VALUES ('$ordID','$temppid','$tempquan','$tempprice')";
             //echo $sql."\n";
            if($conn->query($sql) === TRUE) 
            {
                $valid[1] = "Added Successfully";   
            } 
            else 
            {
                $valid[2] = "Error while Inserting";
            }
//}
echo "Thank you for ordering from us!!! You will be contacted by a Service Representative soon enough to process your payment and deliver your orders, take care.
<br>
<br>
<p>Click <a href='index2.php?order=success'>HERE</a> to go HOME.";

   // var_dump($sql);
   // die();
  //header("Location: index2.php?setappointment=success");
}else{
  echo "Order Products were not added, kindly try again.";
}
}else{
            echo "The amount you have inputted exceeds that in stock, kindly try again later.";
           }
}
}

 //Cancel Order
 if (isset($_POST['cancel'])) {
   $oid = $_POST['oid'];
   require_once 'dbconnection.inc.php';
   $sql = "UPDATE `orders` SET `Status` = 'Cancelled' WHERE `Order_ID` = '$oid'";
  mysqli_query($conn, $sql); 
    //var_dump($sql);
   // die();
  header("Location: index2.php?cancelorder=success");
 }
 ?>