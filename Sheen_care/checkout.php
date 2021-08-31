<style type="text/css">
   .btn-group, .btn-group-vertical {
   position: relative;
   display: -ms-inline-flexbox;
   display: contents !important;
   vertical-align: middle;
   }

    .paymentWrap {
   /*padding: 50px;*/
   }
   .paymentWrap .paymentBtnGroup {
   max-width: 800px;
   margin: auto;
   }
   .paymentWrap .paymentBtnGroup .paymentMethod {
   padding: 10px;
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
   /*.paymentWrap .paymentBtnGroup .paymentMethod .method.cod {*/
   /*    background-image: url("logo/cod.jpg");*/
   /*}*/
   /*.paymentWrap .paymentBtnGroup .paymentMethod .method.paytm {*/
   /*    background-image: url("logo/paytm.png");*/
   /*}*/
   .paymentWrap .paymentBtnGroup .paymentMethod .method:hover {
   border-color: #4cd264;
   outline: none !important;
   }
   .hide {
   display: none;
   }
   .mandatory {
   color: red;
   }
</style>

<?php
   include('header.php');
   
   include('admin/connection.php');
   
   session_start();
   
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
   
   
   
   $pincode = $_SESSION['final_delivery_pincode'];
   
   
   
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
   
       $grand_totalx = $_REQUEST['grandcash'];
   
       $order_notes = $_REQUEST['order_notes'];
   
       $payment_mode = $_REQUEST['payment_mode'];
   
       $current_date = date('d-m-Y');
   
       $uniq_order_id = uniqid("SHEEN");
   
       $address = $address1 . ", " . $address2 . ", " . $area . ", " . $city . ", " . $state . ", " . $country . ", " . $pincode;
   
   
   
       $_SESSION['insta_name'] =$first_name. " " .$last_name  ;
   
       $_SESSION['insta_total'] = $grand_totalx;
   
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
   
           $insert1 = "INSERT INTO order_master(uniq_order_id,order_date,customer_id,total_quantity,shipping_charge,total_amount,order_status) VALUES('$uniq_order_id','$current_date',$customer_id,$total_product,$shipping_charge,$grand_totalx,'Pending')";
   
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
   
                               $insert6 = "INSERT INTO invoice(order_id,invoice_date,invoice_address,invoice_city,pincode,invoice_sub_total) VALUES('{$max_order_id}','{$current_date}','{$address}','{$city}','{$pincode}','{$grand_totalx}')";
   
                               $run7 = mysqli_query($conn, $insert6);
   
   
   
                               if ($run7) {
   
   
   
   
   
                                   $delete = "DELETE FROM cart  WHERE pro_id = '{$f_pro_id}'";
   
                                   $delete_run = mysqli_query($conn, $delete);
   
   
   
                                  if ($delete) {
   
      
   
                                          $toid = $email;
   
                                          $subject = "Thank You For Shopping on SHEEN CARE";
   
                                          $message = "";
   
                                           $message .= "<center><img  src='https://www.sheencare.com/assets/images/logo/sheen_logo.png' style='width: auto; height: 65px;'><br><br><p><b>YOUR ORDER IS BEING PROCESSED AND GETTING READY FOR DISPATCH.</b></p><br></center><p>Dear ".$full_name_email.", </p><br><p>Thanks for your order.<br> We will share the tracking details once the order is shipped.<br>Your total order amount is Rs.". $grand_totalx."/-</p><br><p><b>Order Date :</b>".$current_date."</p><br><table><tr style='background: #eaeaea;'><th>Product</th><th  style='text-align:center'>Price</th></tr>";
   
                                          $i = 1;
   
                                          $j = 0;
   
                                          while ($i <= $single_total_product) {
   
                                              $f_pro_id = $pro_id_array[$j];
   
                                              
   
                                                 $delete1 = "DELETE FROM cart  WHERE pro_id = '{$f_pro_id}'";
   
                                                 $delete_run1 = mysqli_query($conn, $delete1);
   
      
   
                                              $select_demo_pro_name = "SELECT * FROM product WHERE pro_id = $f_pro_id";
   
                                              $select_demo_pro_run = mysqli_query($conn, $select_demo_pro_name);
   
                                              while ($datax = mysqli_fetch_array($select_demo_pro_run)) {
   
                                                  $message .= "<tr><td>" . $datax['pro_name']."</td>";
   
                                                  if(isset($datax['offer_price']) && !empty($datax['offer_price'])){
   
                                                  $message .= "<td style='text-align:center'>" . $datax['offer_price']."</td>";
   
                                                  }else{
   
                                                   $message .= "<td style='text-align:center'>" . $datax['price']."</td></tr>";   
   
                                                  }
   
                                              }
   
                                              $j++;
   
                                              $i++;
   
                                          }
   
                                          $message .= "<tr><td>Total Quantity :</td> <td style='text-align:center'>" . $final_total_product."</td></tr>";
   
                                          $message .= "<tr><td>Shipping Charge :</td> <td style='text-align:center'> " . $shipping_charge."</td></tr><tr><td>COD Charge :</td> <td style='text-align:center'>75</td></tr>";
   
                                          $message .= "<tr><td>Sub Total : </td> <td style='text-align:center'>" . ($grand_totalx)."</td></tr><tr><td colspan='2'><b><br>Shipping Address</b><br>".$full_name_email."<br>".$address1.$address2.", ".$area.$city.", ".$state.", ".$country."-".$pincode."<br><b>Email</b><br>".$email."<br><b>Mobile</b><br>".$phone."</td></tr></table><br><br><p>With Love,<br>Team SHEEN<br><br><br><i>When you buy our products, you are not only contributing towards Make in India initiative but also helping in promoting Rural Employment</i></p>";
   
                                          include('admin/phpmailer/PHPMailerAutoload.php');
   
      
   
      
   
                                          $mail = new PHPMailer;
   
      
   
                                          $mail->isSMTP();
   
      
   
                                          $mail->Host = 'mail.sheencare.com';
   
                                          $mail->Port = 465;
   
      
   
                                          $mail->SMTPSecure = 'ssl';
   
                                          $mail->SMTPAuth = true;
   
                                          $mail->Username = 'info@sheencare.com';// enter your mail
   
                                          $mail->Password = '.J;%w5NA56I-';// enter pass
   
      
   
                                          $mail->setFrom('info@sheencare.com', 'SHEEN CARE');  // Enter display email & name
   
                                          $mail->addReplyTo('info@sheencare.com', 'SHEEN CARE');  // enter reply to mail & name
   
      
   
                                          $mail->addAddress($toid);
   
                                          $mail->AddCC('query@octopuscare.in', 'SHEEN CARE');
   
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
   
                                    //   $message.="<br><br>Sub Total : ".$grand_totalx;
   
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
   
   }// end runn 7
   
   }// END RUNN 6
   
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
                     <!--<div class="col-lg-12">-->
                     <!--   <div class="billing-info mb-20px">-->
                     <!--      <label>Company Name</label>-->
                     <!--      <input type="text" name="company_name" placeholder="Optional"/>-->
                     <!--   </div>-->
                     <!--</div>-->
                     <div class="col-lg-12">
                        <div class="billing-info mb-20px">
                           <label>Address<span class="mandatory">*</span></label>
                           <input class="billing-address" name="address1"
                              placeholder="House number and street name" type="text"
                              value="<?php echo $address1; ?>" required=""/>
                           <input placeholder="Apartment, suite, unit etc." name="address2" type="text"
                              value="<?php echo $address2; ?>"/>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="billing-info mb-20px">
                           <label>Landmark</label>
                           <input type="text" name="area" value="<?php echo $area; ?>"/>
                        </div>
                     </div>
                     <div class="col-lg-12">
                        <div class="billing-info mb-20px">
                           <label>Town / City<span class="mandatory">*</span></label>
                           <input type="text" name="city" value="<?php echo $city; ?>" required=""/>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6">
                        <div class="billing-info mb-20px">
                           <label>State / Country<span class="mandatory">*</span></label>
                           <select name="root_category_id" class="form-control" style="max-height:350px;overflow:hidden">
                              <option hidden=""  value="<?php echo $state; ?>">------- Select State -------</option>
                              <?php 
                                 $select_root_category = "SELECT DISTINCT state FROM location";
                                 
                                 
                                 
                                 $run_root_category = mysqli_query($conn,$select_root_category);
                                 
                                 
                                 
                                 while ($root_category_data = mysqli_fetch_array($run_root_category)) 
                                 
                                 
                                 
                                 {
                                 
                                 
                                 
                                 ?>
                              <option value="<?php echo $root_category_data['state']; ?>"><?php echo $root_category_data['state']; ?></option>
                              <?php
                                 }
                                 
                                 
                                 
                                 ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6">
                        <div class="billing-info mb-20px">
                           <label>Postcode / ZIP<span class="mandatory">*</span></label>
                           <input type="text" name="pincode" value="<?php echo $pincode; ?>" readonly
                              required=""/>
                        </div>
                     </div>
                     <div class="col-lg-12 col-md-12">
                        <div class="billing-info mb-20px">
                           <label>Country<span class="mandatory">*</span></label>
                           <input type="text" name="country" value="<?php echo $country; ?>" required=""/>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6">
                        <div class="billing-info mb-20px">
                           <label>Phone<span class="mandatory">*</span></label>
                           <input type="text" name="phone" value="<?php echo $phone; ?>" required=""/>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-6">
                        <div class="billing-info mb-20px">
                           <label>Email Address<span class="mandatory">*</span></label>
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
                                    
                                    
                                    
                                    ?> </span>
                              </li>
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
                        <div class="your-order-bottom" id="cashcharge">
                           <ul>
                              <li class="your-order-shipping">Cash On Delevery Charges</li>
                              <li>₹ 75</li>
                           </ul>
                        </div>
                        <div class="your-order-total">
                           <ul>
                              <li class="order-total">Total</li>
                              <li id="totalhide"><?= '₹ ' . $grand_total ?></li>
                              <li id="totalshow"><?= '₹ ' . ($grand_total + 75) ?></li>
                              <input type="hidden" value="<?= $grand_total ?>" name="grandcashfix"
                                 id="grandcashfix">
                              <input type="hidden" value="<?= $grand_total ?>" name="grandcash"
                                 id="grandcash">
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
                                             Method
                                          </h3>
                                       </div>
                                       <div class="paymentWrap">
                                          <div class="btn-group paymentBtnGroup btn-group-justified text-center"
                                             data-toggle="buttons">
                                             <label class="btn paymentMethod">
                                                <div class="method paytm"></div>
                                                <input type="radio" name="payment_mode"
                                                   class="cashkarclass" value="razor"
                                                   checked><img
                                                   src="assets/images/payment_method.svg"
                                                   style="height:52px;">
                                             </label>
                                             <br>
                                             <label class="btn paymentMethod active <?php if (intval($_SESSION['has_cod']) == 0) { ?> hide <?php } ?>">
                                                <div class="method cod"></div>
                                                <input type="radio" id="cashkar" class="cashkarclass"
                                                   name="payment_mode" value="COD">
                                                <b> COD</b>
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
               </div>
            </div>
         </div>
      </div>
   </div>
</form>
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
   
       text: "We are processing your order",
   
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

<script>
   $(document).ready(function () {
   
       $("#cashcharge").hide();
   
       $("#totalshow").hide();
   
       $('.cashkarclass').click(function () {
   
           if ($('#cashkar').is(':checked')) {
   
               var x = $("#grandcashfix").val();
   
               var y = parseInt(x) + 75;
   
               $("#grandcash").val(y);
   
               $("#totalhide").hide();
   
               $("#totalshow").show();
   
               $("#cashcharge").show();
   
           } else {
   
               var x = $("#grandcashfix").val();
   
               $("#grandcash").val(x);
   
               $("#totalhide").show();
   
               $("#totalshow").hide();
   
               $("#cashcharge").hide();
   
           }
   
       })
   
   });
   
</script>

</body>
</html>