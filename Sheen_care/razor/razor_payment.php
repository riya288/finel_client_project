<?php

include('../admin/connection.php');

session_start();

$customer_id = $_SESSION['cust_id'];

$pro_id_array = $_SESSION['final_pro_id_array'];

$stock_quantity = $_SESSION['final_single_quantity'];

$single_total_product = count($pro_id_array); 

$shipping_mode = $_SESSION['final_shipping_charge'];

$grand_total = $_SESSION['final_sub_total'];

$standard_charge = $_SESSION['final_standard_charge'];

$express_charge = $_SESSION['final_express_charge'];

$total_product = $_SESSION['final_total_product'];

$final_total_product = count($pro_id_array);



if ($shipping_mode == "Express") 

{

 $shipping_charge =  $express_charge;

}

else

{

$shipping_charge = $standard_charge;

}





$invoice_name=$_SESSION['insta_name'];

$grand_total=$_SESSION['insta_total'];

$email=$_SESSION['insta_email'];

$first_name=$_SESSION['insta_first_name'];

$last_name=$_SESSION['insta_last_name'];

$company_name=$_SESSION['insta_company_name'];

$address1=$_SESSION['insta_address1'];

$address2=$_SESSION['insta_address2'];

$city=$_SESSION['insta_city'];

$area=$_SESSION['insta_area'];

$state=$_SESSION['insta_state'];

$country=$_SESSION['insta_country'];

$pincode=$_SESSION['insta_pincode'];

$phone=$_SESSION['insta_phone'];

$email=$_SESSION['insta_email'];

$order_notes=$_SESSION['insta_order_notes'];

$payment_mode=$_SESSION['insta_payment_mode'];

$current_date=$_SESSION['insta_current_date'];

$uniq_order_id=$_SESSION['insta_uniq_order_id'];

$address=$_SESSION['insta_address'];

$razor_tran_id=$_SESSION['razor_tran_id'];









if (isset($_SESSION['razor_tran_id'])) 

{



  // for order master table

                        $insert1= "INSERT INTO order_master(uniq_order_id,order_date,customer_id,total_quantity,shipping_charge,total_amount,order_status) VALUES('{$uniq_order_id}','{$current_date}','{$customer_id}','{$total_product}','{$shipping_charge}','{$grand_total}','Pending')"; 



                        $run1= mysqli_query($conn,$insert1);



                        // start run1

                        if ($run1) 

                        {

                        $select2= "SELECT MAX(order_id) FROM order_master";

                        $run2 = mysqli_query($conn, $select2);



                            while ($data2 = mysqli_fetch_array($run2)) 

                            {

                            $max_order_id = $data2['MAX(order_id)'];

                            $_SESSION['max_order_id']= $max_order_id;



                            }



                        // start run2

                        if ($run2)  // foe order details table

                        {



                            $i=0;

                            $j=1;

                            while ( $j <= $single_total_product) 

                            {



                                $tmp_pro_id = $pro_id_array[$i];

                                $tmp_quantity = $stock_quantity[$i];



                                $insert3= "INSERT INTO order_detail(order_id,pro_id,quantity,o_first_name,o_last_name,o_phone,o_address,o_company_name,o_pincode,o_city,o_email,order_notes) VALUES('{$max_order_id}','{$tmp_pro_id}','{$tmp_quantity}','{$first_name}','{$last_name}','{$phone}','{$address}','{$company_name}','{$pincode}','{$city}','{$email}','{$order_notes}')"; 



                                $run3= mysqli_query($conn,$insert3);





                                $i++;

                                $j++;  

                            } //end while



                            

                            if ($run3)  // for payment table

                            {

                                        $insert4= "INSERT INTO payment(customer_id,order_id,payment_date,payment_status,payment_mode,insta_tran_id) VALUES('{$customer_id}','{$max_order_id}','{$current_date}',1,'{$payment_mode}','{$razor_tran_id}')"; 



                                        $run4= mysqli_query($conn,$insert4);



                                        

                                        if ($run4) // for manage stock 

                                        {

                                                    $i=0;

                                                    $j=1;





                                                    while ($j <= $single_total_product)

                                                    {



                                                          $f_pro_id = $pro_id_array[$i];   



                                                          $select5 = "SELECT * FROM stock WHERE pro_id = '{$f_pro_id}'";

                                                          $run5 = mysqli_query($conn, $select5);

                                                          while ($data5 = mysqli_fetch_array($run5)) 

                                                          {

                                                              $num_product = $data5['stock'];



                                                              $final_qyantity = $stock_quantity[$i];

                                                              $stock = $num_product - $final_qyantity;



                                                              $update3="UPDATE `stock` SET `stock`='$stock' WHERE pro_id = '{$f_pro_id}'";

                                                              $run6 = mysqli_query($conn,$update3);

                                                          }                              





                                                          $j++;

                                                          $i++;

                                                    }











                                                    if ($run6)    //   Invoice data

                                                    {

                                                       $insert6= "INSERT INTO invoice(order_id,invoice_date,invoice_address,invoice_city,pincode,invoice_sub_total) VALUES('{$max_order_id}','{$current_date}','{$address}','{$city}','{$pincode}','{$grand_total}')"; 



                                                        $run7= mysqli_query($conn,$insert6);





                                                        if ($run7) 

                                                        {

                                                            



                                                             $i=1;

                                                              $j=0;

                                                              while ($i<=$single_total_product)

                                                              {

                                                              $f_pro_id = $pro_id_array[$j];



                                                              $delete="DELETE FROM cart  WHERE pro_id = '{$f_pro_id}'";

                                                              $delete_run= mysqli_query($conn,$delete);



                                                              $j++;

                                                              $i++;







                                                              if ($delete) 

                                                              {

                                                               $toid = $email;

                                                               $subject = "Thank You For Shopping on SHEEN CARE";

                                                               $message = "";

                                                                $message .= "<center><img  src='https://www.sheencare.com/assets/images/logo/sheen_logo.png' style='width: auto; height: 65px;'><br><br><p><b>YOUR ORDER IS BEING PROCESSED AND GETTING READY FOR DISPATCH.</b></p><br></center><p>Dear ".$invoice_name.", </p><br><p>Thanks for your order.<br> We will share the tracking details once the order is shipped.<br>Your total order amount is Rs.". $grand_total."/-</p><br><p><b>Order Date :</b>".$current_date."</p><br><table><tr style='background: #eaeaea;'><th>Product</th><th  style='text-align:center'>Price</th></tr>";

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

                                                               $message .= "<tr><td>Shipping Charge :</td> <td style='text-align:center'> " . $shipping_charge."</td></tr>";

                                                               $message .= "<tr><td>Sub Total : </td> <td style='text-align:center'>" . $grand_total."</td></tr><tr><td colspan='2'><b><br>Shipping Address</b><br>".$invoice_name."<br>".$address1.$address2.",".$area.",<br>".$city.", ".$state.", ".$country."-".$pincode."<br><b>Email</b><br>".$email."<br><b>Mobile</b><br>".$phone."</td></tr></table><br><br><p>With Love,<br>Team SHEEN<br><br><br><i>When you buy our products, you are not only contributing towards Make in India initiative but also helping in promoting Rural Employment</i></p>";

                                                               include('../admin/phpmailer/PHPMailerAutoload.php');

                           

                           

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

                                

                            



                                                                   unset($_SESSION['insta_name']);

                                                                   unset($_SESSION['insta_total']);

                                                                   unset($_SESSION['insta_email']);

                                                                   unset($_SESSION['insta_first_name']);

                                                                   unset($_SESSION['insta_last_name']);

                                                                   unset($_SESSION['insta_company_name']);

                                                                   unset($_SESSION['insta_address1']);

                                                                   unset($_SESSION['insta_address2']);

                                                                   unset($_SESSION['insta_city']);

                                                                   unset($_SESSION['insta_area']);

                                                                   unset($_SESSION['insta_state']);

                                                                   unset($_SESSION['insta_country']);

                                                                   unset($_SESSION['insta_pincode']);

                                                                   unset($_SESSION['insta_phone']);

                                                                   unset($_SESSION['insta_email']);

                                                                   unset($_SESSION['insta_order_notes']);

                                                                   unset($_SESSION['insta_payment_mode']);

                                                                   unset($_SESSION['insta_current_date']);

                                                                   unset($_SESSION['insta_uniq_order_id']);

                                                                   unset($_SESSION['insta_address']);

                                                                   unset($_SESSION['razor_tran_id']);

                                



                                                                   echo "<script>  window.location.assign('../success.php'); </script>";



                                                              } // end delete

                                                              



                                                        }  // end runn 7



                                                        }// END RUNN 6



                                                    } // end run 5

                                                    

                                        } // end run 4

                                        











                            } // end $run 3

                            



                        }// end run2



                        } // end run1





}



?>





             

           





