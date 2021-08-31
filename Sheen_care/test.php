<?php
include('header.php');
include('admin/connection.php');
session_start();
$cust_id = $_SESSION['cust_id'];

$customer_id = $_SESSION['cust_id'];
$pro_id_array = $_SESSION['final_pro_id_array'];
$stock_quantity = $_SESSION['final_single_quantity'];
$single_total_product = count($pro_id_array);
$shipping_mode = $_SESSION['final_shipping_charge'];
$grand_total = $_SESSION['final_sub_total'];
$standard_charge = $_SESSION['final_standard_charge'];
$express_charge = $_SESSION['final_express_charge'];


if ($shipping_mode == "Express") {
    $shipping_charge = $express_charge;
} else {
    $shipping_charge = $standard_charge;
}


$total_product = $_SESSION['final_total_product'];
$final_total_product = count($pro_id_array);

$select1 = "SELECT * FROM customer WHERE customer_id = '{$customer_id}' ";
$run1 = mysqli_query($conn, $select1);

while ($data1 = mysqli_fetch_array($run1)) {
    $first_name = $data1['first_name'];
    $last_name = $data1['last_name'];
    $phone = $data1['phone'];
    $email = $data1['email'];
    $address1 = $data1['address1'];
    $address2 = $data1['address2'];
    $area = $data1['area'];
    $city = $data1['city'];
    $state = $data1['state'];
    $country = $data1['country'];
    $pincode = $data1['pincode'];


}


// for place order
if (isset($_REQUEST['place_order'])) {

    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $full_name_email = $first_name . " " . $last_name;
    $company_name = $_REQUEST['company_name'];
    $address1 = $_REQUEST['address1'];
    $address2 = $_REQUEST['address2'];
    $city = $_REQUEST['city'];
    $area = $_REQUEST['area'];

    $state = $_REQUEST['state'];
    $country = $_REQUEST['country'];
    $pincode = $_REQUEST['pincode'];
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];
    $order_notes = $_REQUEST['order_notes'];
    $payment_mode = $_REQUEST['payment_mode'];
    $current_date = date('d-m-Y');
    $uniq_order_id = uniqid("SHEEN");
    $address = $address1 . ", " . $address2 . ", " . $area . ", " . $city . ", " . $state . ", " . $country . ", " . $pincode;


    $_SESSION['insta_name'] = $last_name . " " . $first_name;
    $_SESSION['insta_total'] = $grand_total;
    $_SESSION['insta_email'] = $email;
    $_SESSION['insta_first_name'] = $first_name;
    $_SESSION['insta_last_name'] = $last_name;
    $_SESSION['insta_company_name'] = $company_name;
    $_SESSION['insta_address1'] = $address1;
    $_SESSION['insta_address2'] = $address2;
    $_SESSION['insta_city'] = $city;
    $_SESSION['insta_area'] = $area;
    $_SESSION['insta_state'] = $state;
    $_SESSION['insta_country'] = $country;
    $_SESSION['insta_pincode'] = $pincode;
    $_SESSION['insta_phone'] = $phone;
    $_SESSION['insta_email'] = $email;
    $_SESSION['insta_order_notes'] = $order_notes;
    $_SESSION['insta_payment_mode'] = $payment_mode;
    $_SESSION['insta_current_date'] = $current_date;
    $_SESSION['insta_uniq_order_id'] = $uniq_order_id;
    $_SESSION['insta_address'] = $address;


    if ($payment_mode == "COD")  // for cash on delivery
    {

        // for order master table
        $insert1 = "INSERT INTO order_master(uniq_order_id,order_date,customer_id,total_quantity,shipping_charge,total_amount,order_status) VALUES('$uniq_order_id','$current_date',$customer_id,$total_product,$shipping_charge,$grand_total,'Pending')";

        $run1 = mysqli_query($conn, $insert1);

        // start run1
        if ($run1) {
            $select2 = "SELECT MAX(order_id) FROM order_master";
            $run2 = mysqli_query($conn, $select2);

            while ($data2 = mysqli_fetch_array($run2)) {
                $max_order_id = $data2['MAX(order_id)'];
                $_SESSION['max_order_id'] = $max_order_id;

            }

            // start run2
            if ($run2)  // foe order details table
            {

                $i = 0;
                $j = 1;
                while ($j <= $single_total_product) {

                    $tmp_pro_id = $pro_id_array[$i];
                    $tmp_quantity = $stock_quantity[$i];

                    $insert3 = "INSERT INTO order_detail(order_id,pro_id,quantity,o_first_name,o_last_name,o_phone,o_address,o_company_name,o_pincode,o_city,o_email,order_notes) VALUES('{$max_order_id}','{$tmp_pro_id}','{$tmp_quantity}','{$first_name}','{$last_name}','{$phone}','{$address}','{$company_name}','{$pincode}','{$city}','{$email}','{$order_notes}')";

                    $run3 = mysqli_query($conn, $insert3);


                    $i++;
                    $j++;
                } //end while


                if ($run3)  // for payment table
                {
                    $insert4 = "INSERT INTO payment(customer_id,order_id,payment_date,payment_status,payment_mode) VALUES('{$customer_id}','{$max_order_id}','{$current_date}',0,'{$payment_mode}')";

                    $run4 = mysqli_query($conn, $insert4);


                    if ($run4) // for manage stock
                    {
                        $i = 0;
                        $j = 1;


                        while ($j <= $single_total_product) {

                            $f_pro_id = $pro_id_array[$i];

                            $select5 = "SELECT * FROM stock WHERE pro_id = '{$f_pro_id}'";
                            $run5 = mysqli_query($conn, $select5);
                            while ($data5 = mysqli_fetch_array($run5)) {
                                $num_product = $data5['stock'];

                                $final_qyantity = $stock_quantity[$i];
                                $stock = $num_product - $final_qyantity;

                                $update3 = "UPDATE `stock` SET `stock`='$stock' WHERE pro_id = '{$f_pro_id}'";
                                $run6 = mysqli_query($conn, $update3);
                            }


                            $j++;
                            $i++;
                        }


                        if ($run6)    //   Invoice data
                        {
                            $insert6 = "INSERT INTO invoice(order_id,invoice_date,invoice_address,invoice_city,pincode,invoice_sub_total) VALUES('{$max_order_id}','{$current_date}','{$address}','{$city}','{$pincode}','{$grand_total}')";

                            $run7 = mysqli_query($conn, $insert6);


                            if ($run7) {


                                $i = 1;
                                $j = 0;
                                while ($i <= $single_total_product) {
                                    $f_pro_id = $pro_id_array[$j];

                                    $delete = "DELETE FROM cart  WHERE pro_id = '{$f_pro_id}'";
                                    $delete_run = mysqli_query($conn, $delete);

                                    $j++;
                                    $i++;


                                    if ($delete) {


                                        $toid = $email;
                                        $subject = "Thank You For Shopping On SHEENCARE";

                                        $message = "";
                                        $message .= "<br>Your Order is Confirm by SHEENCARE";
                                        $message .= " <br> <br> <br>Your Order ID is : " . $uniq_order_id;
                                        $message .= "<br><br>Customer Name : " . $full_name_email;
                                        $message .= "<br><br>Address : " . $address;
//                   if (isset($_SESSION['login_quantity1'])) 
//                   {

//                       $pro_id1 = $_SESSION['login_pro_id1'];      
//                        $quantity = $_SESSION['login_quantity1'];   
//                   // for fetch data in cart

//                   $i = 0;
//                   $total = 0;

//                   $select="SELECT * FROM  product WHERE pro_id = '{$pro_id1}'";
//                   $run =  mysqli_query($conn, $select);

//                   if (mysqli_num_rows($run) > 0) 
//                   {    
//                     while ($data = mysqli_fetch_array($run)) 
//                     {

//                       $price= $data['price'];         
//                       $offer_price= $data['offer_price'];
//                       $offer_status= $data['offer_status'];


//                       $total_quantity= $total_quantity + $quantity;

//                       if ($offer_status > 0) 
//                       {
//                         $total =$offer_price * $quantity;
//                       }
//                       else
//                       {
//                         $total =$price * $quantity;
//                       }

//                       $tmp_total[$i] =$total;

//                       //echo "<script> alert('$tmp_total'); </script>";
//                       $sub_total = array_sum($tmp_total) + $shipping_charge;

//                       $pro_id_array[$i] = $data['pro_id'];


//                       $message.="<br><br>Product Name : ".$data['pro_name'];
//                       if($offer_status > 0) {
//                         $_SESSION['price1'] = $data['offer_price'];
//                       $message.="<br><br>Price: ₹".$data['offer_price'];
//                       }else {
//                       $_SESSION['price1'] = $data['price']; 
//                        $message.="<br><br>Price: ₹".$data['price'];
//                      }
//                      $message.="<br><br>Quantity : ".$quantity;
//                                          $i++;
//                                          }
//                                    }
//                                  }


//                 if (isset($_SESSION['login_quantity2']))
//                   {


//                       $pro_id2 = $_SESSION['login_pro_id2'];      
//                        $quantity = $_SESSION['login_quantity2']; 


//                   if ($pro_id1 == $pro_id2) 
//                   {
//                       unset($_SESSION['count_array2']);
//                       unset($_SESSION['login_pro_id2']);
//                       unset($_SESSION['login_quantity2']);


//                   }
//                   else
//                   {
//                           $i = 0;
//                   $total = 0;

//                   $select="SELECT * FROM  product WHERE pro_id = '{$pro_id2}'";
//                   $run =  mysqli_query($conn, $select);
//                   }
//                   if (mysqli_num_rows($run) > 0) 
//                   {    
//                     while ($data = mysqli_fetch_array($run)) 
//                     {

//                       $price= $data['price'];         
//                       $offer_price= $data['offer_price'];
//                       $offer_status= $data['offer_status'];


//                       $total_quantity= $total_quantity + $quantity;

//                       if ($offer_status > 0) 
//                       {
//                         $total =$offer_price * $quantity;
//                       }
//                       else
//                       {
//                         $total =$price * $quantity;
//                       }

//                       $tmp_total[$i] =$total;

//                       //echo "<script> alert('$tmp_total'); </script>";
//                       $sub_total = array_sum($tmp_total) + $shipping_charge;

//                       $pro_id_array[$i] = $data['pro_id'];


//                       $message.="<br><br>Product Name : ".$data['pro_name'];
//                       if($offer_status > 0) {
//                         $_SESSION['price1'] = $data['offer_price'];
//                       $message.="<br><br>Price: ₹".$data['offer_price'];
//                       }else {
//                       $_SESSION['price1'] = $data['price']; 
//                        $message.="<br><br>Price: ₹".$data['price'];
//                      }
//                      $message.="<br><br>Quantity : ".$quantity;
//                                           $i++;
//                                          }
//                                    }


//                                  }


// if (isset($_SESSION['login_quantity3']))
//                 {

//                     $pro_id3 = $_SESSION['login_pro_id3'];      
//                      $quantity = $_SESSION['login_quantity3'];  


//                      if ($pro_id1 == $pro_id3) 
//                      {
//                         unset($_SESSION['count_array3']);
//                          unset($_SESSION['login_pro_id3']);
//                          unset($_SESSION['login_quantity3']);
//                      }
//                      elseif ($pro_id2 == $pro_id3) 
//                      {
//                          unset($_SESSION['count_array3']);
//                          unset($_SESSION['login_pro_id3']);
//                          unset($_SESSION['login_quantity3']);
//                      }
//                      else
//                      {
//                       $i = 0;
//                       $total = 0;
//                       $select="SELECT * FROM  product  WHERE pro_id = '{$pro_id3}'";
//                       $run =  mysqli_query($conn, $select);
//                      } 

//                 // for fetch data in cart


//                 if (mysqli_num_rows($run) > 0) 
//                 {    
//                   while ($data = mysqli_fetch_array($run)) 
//                   {

//                     $price= $data['price'];         
//                     $offer_price= $data['offer_price'];
//                     $offer_status= $data['offer_status'];


//                     $total_quantity= $total_quantity + $quantity;

//                     if ($offer_status > 0) 
//                     {
//                       $total =$offer_price * $quantity;
//                     }
//                     else
//                     {
//                       $total =$price * $quantity;
//                     }

//                     $tmp_total[$i] =$total;

//                     //echo "<script> alert('$tmp_total'); </script>";
//                     $sub_total = array_sum($tmp_total) + $shipping_charge;

//                     $pro_id_array[$i] = $data['pro_id'];


//                        $message.="<br><br>Product Name : ".$data['pro_name'];
//                       if($offer_status > 0) {
//                         $_SESSION['price1'] = $data['offer_price'];
//                       $message.="<br><br>Price: ₹".$data['offer_price'];
//                       }else {
//                       $_SESSION['price1'] = $data['price']; 
//                        $message.="<br><br>Price: ₹".$data['price'];
//                      }
//                      $message.="<br><br>Quantity : ".$quantity;

//                       $i++;
//                                          }
//                                    }
//                                  }


// if (isset($_SESSION['login_quantity4'])) 
//                 {

//                     $pro_id4 = $_SESSION['login_pro_id4'];      
//                      $quantity = $_SESSION['login_quantity4'];   


//                      if ($pro_id1 == $pro_id4) 
//                      {

//                           unset($_SESSION['count_array4']);
//                          unset($_SESSION['login_pro_id4']);
//                          unset($_SESSION['login_quantity4']);
//                      }
//                      elseif ($pro_id2 == $pro_id4) 
//                      {
//                         unset($_SESSION['count_array4']);
//                          unset($_SESSION['login_pro_id4']);
//                          unset($_SESSION['login_quantity4']);
//                      }
//                      elseif ($pro_id3 == $pro_id4) 
//                      {
//                         unset($_SESSION['count_array4']);
//                          unset($_SESSION['login_pro_id4']);
//                          unset($_SESSION['login_quantity4']);
//                      }
//                      else
//                      {
//                              $i = 0;
//                           $total = 0;
//                           $select="SELECT * FROM  product  WHERE pro_id = '{$pro_id4}'";
//                           $run =  mysqli_query($conn, $select
//                           );
//                      }


//                 // for fetch data in cart


//                 if (mysqli_num_rows($run) > 0) 
//                 {    
//                   while ($data = mysqli_fetch_array($run)) 
//                   {

//                     $price= $data['price'];         
//                     $offer_price= $data['offer_price'];
//                     $offer_status= $data['offer_status'];


//                     $total_quantity= $total_quantity + $quantity;

//                     if ($offer_status > 0) 
//                     {
//                       $total =$offer_price * $quantity;
//                     }
//                     else
//                     {
//                       $total =$price * $quantity;
//                     }

//                     $tmp_total[$i] =$total;

//                     //echo "<script> alert('$tmp_total'); </script>";
//                     $sub_total = array_sum($tmp_total) + $shipping_charge;

//                     $pro_id_array[$i] = $data['pro_id'];
//                     $message.="<br><br>Product Name : ".$data['pro_name'];
//                       if($offer_status > 0) {
//                         $_SESSION['price1'] = $data['offer_price'];
//                       $message.="<br><br>Price: ₹".$data['offer_price'];
//                       }else {
//                       $_SESSION['price1'] = $data['price']; 
//                        $message.="<br><br>Price: ₹".$data['price'];
//                      }
//                      $message.="<br><br>Quantity : ".$quantity;

//                     $i++;
//                                          }
//                                    }
//                                  }


// if (isset($_SESSION['login_quantity5']))
//                 {

//                     $pro_id5 = $_SESSION['login_pro_id5'];      
//                      $quantity = $_SESSION['login_quantity5'];   


//                     if ($pro_id1 == $pro_id5) 
//                      {

//                          unset($_SESSION['count_array5']);
//                          unset($_SESSION['login_pro_id5']);
//                          unset($_SESSION['login_quantity5']);
//                      }
//                      elseif ($pro_id2 == $pro_id5) 
//                      {
//                          unset($_SESSION['count_array5']);
//                          unset($_SESSION['login_pro_id5']);
//                          unset($_SESSION['login_quantity5']);
//                      }
//                      elseif ($pro_id3 == $pro_id5) 
//                      {
//                           unset($_SESSION['count_array5']);
//                          unset($_SESSION['login_pro_id5']);
//                          unset($_SESSION['login_quantity5']);
//                      }
//                      elseif ($pro_id4 == $pro_id5) 
//                      {
//                           unset($_SESSION['count_array5']);
//                          unset($_SESSION['login_pro_id5']);
//                          unset($_SESSION['login_quantity5']);
//                      }
//                      else
//                      {
//                            $i = 0;
//                         $total = 0;
//                         $select="SELECT * FROM  product  WHERE pro_id = '{$pro_id5}'";
//                         $run =  mysqli_query($conn, $select
//                         );
//                      }
//                 // for fetch data in cart


//                 if (mysqli_num_rows($run) > 0) 
//                 {    
//                   while ($data = mysqli_fetch_array($run)) 
//                   {

//                     $price= $data['price'];         
//                     $offer_price= $data['offer_price'];
//                     $offer_status= $data['offer_status'];


//                     $total_quantity= $total_quantity + $quantity;

//                     if ($offer_status > 0) 
//                     {
//                       $total =$offer_price * $quantity;
//                     }
//                     else
//                     {
//                       $total =$price * $quantity;
//                     }

//                     $tmp_total[$i] =$total;

//                     //echo "<script> alert('$tmp_total'); </script>";
//                     $sub_total = array_sum($tmp_total) + $shipping_charge;

//                     $pro_id_array[$i] = $data['pro_id'];
//                      $message.="<br><br>Product Name : ".$data['pro_name'];
//                       if($offer_status > 0) {
//                         $_SESSION['price1'] = $data['offer_price'];
//                       $message.="<br><br>Price: ₹".$data['offer_price'];
//                       }else {
//                       $_SESSION['price1'] = $data['price']; 
//                        $message.="<br><br>Price: ₹".$data['price'];
//                      }
//                      $message.="<br><br>Quantity : ".$quantity;

//                      $i++;
//                                          }
//                                    }
//                                  }

//                    $i = 0;
//                   $total = 0;
//                   $total_quantity = 0;
//                   $select="SELECT * FROM cart JOIN product ON cart.pro_id = product.pro_id JOIN product ON cart.pro_id = product.pro_id   WHERE cart.customer_id = '{$cust_id}'";
//                   $run =  mysqli_query($conn, $select);
//                   if (mysqli_num_rows($run) > 0) 
//                   {    
//                     while ($data = mysqli_fetch_array($run)) 
//                     {

//                       $price= $data['price'];         
//                       $offer_price= $data['offer_price'];
//                       $offer_status= $data['offer_status'];


//                       $quantity= $data['quantity'];
//                       $stock_quantity[] = $quantity;

//                       $total_quantity= $total_quantity + $data['quantity'];

//                       if ($offer_status > 0) 
//                       {
//                         $total =$offer_price * $quantity;
//                       }
//                       else
//                       {
//                         $total =$price * $quantity;
//                       }

//                       $tmp_total[$i] =$total;

//                       //echo "<script> alert('$tmp_total'); </script>";
//                       $sub_total = array_sum($tmp_total) + $shipping_charge;

//                       $pro_id_array[$i] = $data['pro_id'];
//                        $message.="<br><br>Product Name : ".$data['pro_name'];
//                       if($offer_status > 0) {
//                         $_SESSION['price1'] = $data['offer_price'];
//                       $message.="<br><br>Price: ₹".$data['offer_price'];
//                       }else {
//                       $_SESSION['price1'] = $data['price']; 
//                        $message.="<br><br>Price: ₹".$data['price'];
//                      }
//                      $message.="<br><br>Quantity : ".$data["quantity"];
//                      $message.="<br><br>Subtotal : ".$total;
//                      $i++;
//                            }
//                      }
                                        $message .= "<br><br>Total Quantity : " . $final_total_product;
                                        $message .= "<br><br>Shipping Charge : " . $shipping_charge;
                                        $message .= "<br><br>Sub Total : ₹" . $grand_total;

                                        include('admin/phpmailer/PHPMailerAutoload.php');


                                        $mail = new PHPMailer;


                                        $mail->isSMTP();


                                        $mail->Host = 'mail.sheencare.com';

                                        $mail->Port = 465;


                                        $mail->SMTPSecure = 'ssl';

                                        $mail->SMTPAuth = true;

                                        $mail->Username = 'info@sheencare.com';// enter your mail

                                        $mail->Password = '.J;%w5NA56I-';// enter pass


                                        $mail->setFrom('info@sheencare.com', 'SHEENCARE PVT.LTD');  // Enter display email & name

                                        $mail->addReplyTo('info@sheencare.com', 'SHEENCARE PVT.LTD');  // enter reply to mail & name


                                        $mail->addAddress($toid);

                                        $mail->Subject = $subject;

                                        $mail->msgHTML($message);

                                        if (!$mail->send()) {
                                            $error = "Mailer Error: " . $mail->ErrorInfo;
                                            ?>
                                            <script>//alert('<?php //echo $error ?>');</script><?php
                                        }


                                        //   $toid="query@octopuscare.in";
                                        //   $subject="You received new order";

                                        //   $message = "";
                                        //   $message.="<br>Customer Order is Confirm by SHEENCARE";
                                        //   $message.=" <br> <br> <br>Customer Order ID is : ".$uniq_order_id;
                                        //   $message.="<br><br>Customer Name : ".$full_name_email;
                                        //   $message.="<br><br>Address : ".$address;
                                        //   $message.="<br><br>Total Quantity : ".$final_total_product;
                                        //   $message.="<br><br>Shipping Charge : ".$shipping_charge;
                                        //   $message.="<br><br>Sub Total : ".$grand_total;
                                        //   include('admin/phpmailer/PHPMailerAutoload.php');


                                        //       $mail = new PHPMailer;


                                        //       $mail->isSMTP();


                                        //       $mail->Host = 'mail.sheencare.com';

                                        //       $mail->Port = 465;


                                        //       $mail->SMTPSecure = 'ssl';

                                        //       $mail->SMTPAuth = true;

                                        //       $mail->Username = 'info@sheencare.com';// enter your mail

                                        //       $mail->Password = '.J;%w5NA56I-';// enter pass


                                        //       $mail->setFrom('info@sheencare.com', 'SHEENCARE PVT.LTD');  // Enter display email & name

                                        //       $mail->addReplyTo('info@sheencare.com', 'SHEENCARE PVT.LTD');  // enter reply to mail & name


                                        //       $mail->addAddress($toid);

                                        //       $mail->Subject = $subject;

                                        //       $mail->msgHTML($message);

                                        //       if (!$mail->send()) {
                                        //           $error = "Mailer Error: " . $mail->ErrorInfo;
                                        //
                                        ?>
                                        <script>//alert('<?php //echo $error ?>');</script><?php
                                        //       }


                                        $_SESSION['status'] = "Thank You...!!";
                                        $_SESSION['code'] = "success";

                                    } // end delete


                                }  // end runn 7

                            }// END RUNN 6

                        } // end run 5

                    } // end run 4


                } // end $run 3


            }// end run2

        } // end run1

    } // end if
    elseif ($payment_mode == "instamojo") {

        echo "<script> window.location='payment/payment-proccess.php'; </script> ";
        //   echo "<script> alert('hello im instamojo'); </script>";


    }//end else if
    elseif ($payment_mode == "razor") {

        echo "<script> window.location='razor/index.php'; </script> ";
        //   echo "<script> alert('hello im instamojo'); </script>";


    }//end else if
    else {
        $_SESSION['status'] = "Please Select Payment Method.!";
        $_SESSION['code'] = "warning";
    }// end else


} // end isset


?>
<style type="text/css">
    .paymentWrap {
        padding: 50px;
    }

    .paymentWrap .paymentBtnGroup {
        max-width: 800px;
        margin: auto;
    }

    .paymentWrap .paymentBtnGroup .paymentMethod {
        padding: 40px;
        box-shadow: none;
        position: relative;
    }

    .paymentWrap .paymentBtnGroup .paymentMethod.active {
        outline: none !important;
    }

    .paymentWrap .paymentBtnGroup .paymentMethod.active .method {
        border-color: #4cd264;
        outline: none !important;
        box-shadow: 0px 3px 22px 0px #7b7b7b;
    }

    .paymentWrap .paymentBtnGroup .paymentMethod .method {
        position: absolute;
        right: 3px;
        top: 3px;
        bottom: 3px;
        left: 3px;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        border: 2px solid transparent;
        transition: all 0.5s;
    }

    .paymentWrap .paymentBtnGroup .paymentMethod .method.cod {
        background-image: url("logo/cod.jpg");

    }

    .paymentWrap .paymentBtnGroup .paymentMethod .method.paytm {
        background-image: url("logo/paytm.png");
    }


    .paymentWrap .paymentBtnGroup .paymentMethod .method:hover {
        border-color: #4cd264;
        outline: none !important;
    }
</style>


<!-- checkout area start -->
<form action="" method="POST">
    <div class="checkout-area mt-60px mb-40px">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
                        <h3>Billing Details</h3>
                        <div class="row">


                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" value="<?php echo $first_name; ?>"
                                           required=""/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" value="<?php echo $last_name; ?>" required=""/>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-20px">
                                    <label>Company Name</label>
                                    <input type="text" name="company_name" placeholder="Optional"/>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="billing-info mb-20px">
                                    <label>Street Address</label>
                                    <input class="billing-address" name="address1"
                                           placeholder="House number and street name" type="text"
                                           value="<?php echo $address1; ?>" required=""/>
                                    <input placeholder="Apartment, suite, unit etc." name="address2" type="text"
                                           value="<?php echo $address2; ?>" required=""/>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="billing-info mb-20px">
                                    <label>Area</label>
                                    <input type="text" name="area" value="<?php echo $area; ?>" required=""/>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="billing-info mb-20px">
                                    <label>Town / City</label>
                                    <input type="text" name="city" value="<?php echo $city; ?>" required=""/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>State / County</label>
                                    <input type="text" name="state" value="<?php echo $state; ?>" required=""/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>Postcode / ZIP</label>
                                    <input type="text" name="pincode" value="<?php echo $pincode; ?>" required=""/>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="billing-info mb-20px">
                                    <label>Country</label>
                                    <input type="text" name="country" value="<?php echo $country; ?>" required=""/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="<?php echo $phone; ?>" required=""/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-20px">
                                    <label>Email Address</label>
                                    <input type="email" name="email" value="<?php echo $email; ?>" required=""/>
                                </div>
                            </div>
                        </div>

                        <div class="additional-info-wrap">
                            <h4>Additional information</h4>
                            <div class="additional-info">
                                <label>Order notes</label>
                                <textarea placeholder="Notes about your order, e.g. special notes for delivery. "
                                          name="order_notes"></textarea>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="your-order-area">
                        <h3>Your order</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <div class="your-order-top">
                                    <ul>
                                        <li>Product</li>
                                        <li>Total</li>
                                    </ul>
                                </div>
                                <div class="your-order-middle">
                                    <ul>

                                        <?php
                                        $i = 0;
                                        $j = 1;
                                        while ($j <= $final_total_product) {

                                            $tmp_pro_id = $pro_id_array[$i];
                                            $tmp_quantity = $stock_quantity[$i];
                                            $select_product = "SELECT * FROM product WHERE pro_id = '{$tmp_pro_id}' ";
                                            $select_run = mysqli_query($conn, $select_product);

                                            while ($select_data = mysqli_fetch_array($select_run)) {
                                                $offer_status = $select_data['offer_status'];
                                                ?>

                                                <li><span class="order-middle-left"><?php echo $select_data['pro_name']; ?> X 
                                                    <?php echo $tmp_quantity; ?></span> <span class="order-price"><?php

                                                        if ($offer_status > 0) {

                                                            $offer_price = $select_data['offer_price'];

                                                            echo $offer_price * $tmp_quantity;
                                                        } else {
                                                            $price = $select_data['price'];

                                                            echo $price * $tmp_quantity;
                                                        }


                                                        ?> </span></li>
                                                <?php
                                            }


                                            $i++;
                                            $j++;
                                        }


                                        ?>

                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping"><?php echo $shipping_mode . " Delivery"; ?></li>
                                        <li><?php

                                            if ($shipping_mode == "Express") {
                                                echo "₹ " . $express_charge;
                                            } else {
                                                echo "₹ " . $standard_charge;

                                            }
                                            ?>

                                        </li>
                                    </ul>
                                </div>
                                <div class="your-order-total">
                                    <ul>
                                        <li class="order-total">Total</li>
                                        <li> <?php echo "₹ " . $grand_total; ?></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="payment-method">
                                <div class="payment-accordion element-mrg">
                                    <div class="panel-group" id="accordion">
                                        <div class="container">
                                            <div class="row">
                                                <div class="paymentCont">
                                                    <div class="headingWrap">
                                                        <h3 class="headingTop text-center">Select Your Payment
                                                            Method</h3>
                                                    </div>
                                                    <div class="paymentWrap">
                                                        <div class="btn-group paymentBtnGroup btn-group-justified text-center"
                                                             data-toggle="buttons">

                                                            <label class="btn paymentMethod">
                                                                <div class="method paytm"></div>
                                                                <input type="radio" name="payment_mode" value="razor">
                                                                paytmggjku
                                                            </label>
                                                            <label class="btn paymentMethod active">
                                                                <div class="method cod"></div>
                                                                <input type="radio" name="payment_mode" value="COD">
                                                                paytmggjku
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Place-order mt-25 text-center">
                            <input type="submit" name="place_order" value="Place Order" class="btn btn-success"
                                   style="width: 90%;">

                        </div>
</form>
</div>
</div>
</div>
</div>
</div>
<!-- checkout area end -->
<!-- Footer Area start -->


<?php include('includes/footer.php'); ?>

<?php include('includes/footerscript.php'); ?>




<?php
$status_alert = $_SESSION['status'];


if (isset($_SESSION['status'])) {
    if ($status_alert == "Thank You...!!") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                text: "We will Contact You..!",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",

            }).then(function () {
                window.location = "success.php";
            });
        </script>
        <?php


    } elseif ($status_alert == "Please Select Payment Method.!") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                text: "You clicked the button!",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",

            }).then(function () {
                window.location = "checkout.php";
            });
        </script>
        <?php
    } elseif ($status_alert == "This Item Is Out Of Stock..") {
        ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                text: "You clicked the button!",
                icon: "<?php echo $_SESSION['code']; ?>",
                button: "Ok",

            }).then(function () {
                window.location = "products.php";
            });
        </script>
        <?php

    }

    unset($_SESSION['status']);
    unset($_SESSION['code']);

}
?>


</body>
</html>
