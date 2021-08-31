<?php
include('header.php');
include('admin/connection.php');
session_start();
$customer_id = $_SESSION['cust_id'];


// for display data

$select = "SELECT * FROM customer WHERE customer_id = '{$customer_id}'";
$run = mysqli_query($conn, $select);
while ($data = mysqli_fetch_array($run)) 
{
    $first_name = $data['first_name'];
     $last_name = $data['last_name'];
     $email = $data['email'];
     $phone = $data['phone'];
}



// for change password

if (isset($_REQUEST['change_pass'])) 
{
                    $query = "SELECT password FROM customer WHERE customer_id = '{$customer_id}' ";
                    $run2 = mysqli_query($conn,$query);

                    while($result = mysqli_fetch_array($run2)){
                    $user_pass = $result['password'];
                    }

                    $c_pass = $_REQUEST['c_pass'];
                    $enc_c_pass=md5($c_pass);

                    $new_pass = $_REQUEST['new_pass'];
                    $re_pass = $_REQUEST['re_pass'];


                    if ($user_pass == $enc_c_pass) 
                    {
                            if ($new_pass == $re_pass) 
                            {
                                $new_enc_pass=md5($new_pass);
                                $update = "UPDATE customer SET password='$new_enc_pass' WHERE customer_id ='{$customer_id}' ";
                                $data = mysqli_query($conn,$update); 

                                if($data) 
                                {
                                    $_SESSION['status']= "Your Password Changed..!!";
                                    $_SESSION['code']= "success";
                                }
                            }
                            else 
                            {
                                    $_SESSION['status']= "password Does not Match..!!";
                                    $_SESSION['code']= "warning";
                                    }

                            } 
                    else
                    {
                        $_SESSION['status']= "invalid password..!!";
                        $_SESSION['code']= "error";

                    }

}




// for update address
if (isset($_REQUEST['submit_address'])) 
{
        $address1 = $_REQUEST['address1'];
        $address2 = $_REQUEST['address2'];
        $area = $_REQUEST['area'];
        $city = $_REQUEST['city'];
        $state = $_REQUEST['state'];
        $country = $_REQUEST['country'];
        $pincode = $_REQUEST['pincode'];



        
        $address_update = "UPDATE customer SET  address1='{$address1}', address2='{$address2}', area='{$area}', city='{$city}', state='{$state}', country='{$country}', pincode= '{$pincode}' WHERE customer_id = '{$customer_id}' ";
        $address_run = mysqli_query($conn,$address_update);

        if ($address_run) 
        {

            $_SESSION['status']= "Address Update..!!";
            $_SESSION['code']= "success";
           
        }
        else
        {

            $_SESSION['status']= "Some this went Wrong..!!";
            $_SESSION['code']= "warning";
        }
}


?>


            <!-- Breadcrumb Area start -->
            <section class="breadcrumb-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="breadcrumb-content">
                                <h1 class="breadcrumb-hrading">My Account</h1>
                                <ul class="breadcrumb-links">
                                    <li><a href="index.php">Home</a></li>
                                    <li>My Account</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Breadcrumb Area End -->
            <!-- account area start -->
            <div class="checkout-area mtb-60px">
                <div class="container">
                    <div class="row">
                        <div class="ml-auto mr-auto col-lg-9">
                            <div class="checkout-wrapper">
                                <div id="faq" class="panel-group">
                                    <div class="panel panel-default single-my-account">
                                        <div class="panel-heading my-account-title">
                                            <h3 class="panel-title"><span>1 .</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h3>
                                        </div>
                                        <div id="my-account-1" class="panel-collapse collapse show">
                                            <div class="panel-body">
                                                <div class="myaccount-info-wrapper">
                                                    <div class="account-info-wrapper">
                                                        <h4>My Account Information</h4>
                                                        <h5>Your Personal Details</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label>First Name</label>
                                                                <input type="text" value="<?php echo $first_name; ?>" readonly="" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="billing-info">
                                                                <label>Last Name</label>
                                                                <input type="text" value="<?php echo $last_name; ?>" readonly="" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label>Email Address</label>
                                                                <input type="email" value="<?php echo $email; ?>" readonly=""/>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label>Contact Number</label>
                                                                <input type="text" value="<?php echo $phone; ?>" readonly=""/>
                                                            </div>
                                                        </div>
                                                
                                                    </div>
                                              
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default single-my-account">
                                        <div class="panel-heading my-account-title">
                                            <h3 class="panel-title"><span>2 .</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h3>
                                        </div>
                                        <div id="my-account-2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="myaccount-info-wrapper">
                                                    <div class="account-info-wrapper">
                                                        <h4>Change Password</h4>
                                                        <h5>Your Password</h5>
                                                    </div>
                                                    <div class="row">

                                                        <form action="" method="POST"> 

                                                             <div class="col-lg-12 col-md-12">
                                                                <div class="billing-info">
                                                                    <input type="password" name="c_pass" placeholder="Current Password" />
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="billing-info">
                                                                    <input type="password" name="new_pass" placeholder="New Password" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="billing-info">
                                                                    <input type="password" name="re_pass" placeholder="Re - Password" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="billing-back-btn">
                                                          
                                                            <div class="billing-btn">
                                                                <input type="submit" name="change_pass" value="Change Password" class="btn btn-success btn-rounded">
                                                            </div>
                                                        </div>

                                                 </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default single-my-account">
                                        <div class="panel-heading my-account-title">
                                            <h3 class="panel-title"><span>3 .</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your address book entries </a></h3>
                                        </div>
                                        <div id="my-account-3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="myaccount-info-wrapper">
                                                    <div class="account-info-wrapper">
                                                        <h4>Address Book Entries</h4>
                                                    </div>
                                                    
                                                    <div class="entries-wrapper">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 d-flex align-items-center justify-content-center">
                                                                <div class="entries-info" id="editaddress">
                                                                    

                                                                    <?php
                                                                        // for display data

                                                                        $select_address = "SELECT * FROM customer WHERE customer_id = '{$customer_id}'";
                                                                        $select_run = mysqli_query($conn, $select_address);
                                                                        while ($select_data = mysqli_fetch_array($select_run)) 
                                                                        {
                                                                            
                                                                                $select_address1 = $select_data['address1'];
                                                                                $select_address2 = $select_data['address2'];
                                                                                $select_area = $select_data['area'];
                                                                                $select_city = $select_data['city'];
                                                                                $select_state = $select_data['state'];
                                                                                $select_country = $select_data['country'];
                                                                                $select_pincode = $select_data['pincode'];
                                                                        }
                                                                    ?>

                                                <form action="" method="POST">
                                                   <div align="right" style="color:white"><a class="btn btn-success" class="add_new">Add New</a></div>
                                                        <table class="table table-striped" id="#maintable">
                                                            
                                                            <tr>
                                                                <th>Sr No.</th>
                                                                <th>Flate No</th>
                                                                <th>Sub Area Name</th>
                                                                <th>Area</th>
                                                                <th>City</th>
                                                                <th>State</th>
                                                                <th>Country</th>
                                                                <th>Pincode</th>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                        <div class="billing-info">
                                                                            <input type="text" name="address1" placeholder="Home no | Flate No" value="<?php echo $select_address1; ?>" />
                                                                        </div>
                                                                </td>
                                                                <td>
                                                                        <div class="billing-info">
                                                                            <input type="text" name="address2" placeholder="Sub Area Name" value="<?php echo $select_address2; ?>"/>
                                                                        </div>
                                                                </td>
                                                                <td>
                                                                        <div class="billing-info">
                                                                            <input type="text" name="area" placeholder="Area" value="<?php echo $select_area; ?>"/>
                                                                        </div>
                                                                </td>
                                                                <td>
                                                                        <div class="billing-info">
                                                                            <input type="text" name="city" placeholder="City" value="<?php echo $select_city; ?>"/>
                                                                        </div>
                                                                </td>
                                                                <td>
                                                                        <div class="billing-info">
                                                                            <input type="text" name="state" placeholder="State" value="<?php echo $select_state; ?>"/>
                                                                        </div>
                                                                </td>
                                                                <td>
                                                                        <div class="billing-info">
                                                                            <input type="text" name="country" placeholder="Country" value="<?php echo $select_country; ?>"/>
                                                                        </div>
                                                                </td>
                                                                <td>
                                                                        <div class="billing-info">
                                                                            <input type="text" name="pincode" placeholder="Pincode" value="<?php echo $select_pincode; ?>"/>
                                                                        </div>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </div>
                                                 </div>
                                                            <div class="col-lg-12 col-md-12 d-flex align-items-center justify-content-center">
                                                                <div class="text-center">
                                                                    <input type="submit" value="Update Address" name="submit_address" class="btn btn-success">
                                                                </div>
                                                            </div>
                                                        </div>

                                                      </form>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- account area end -->
             <?php include('includes/footer.php');?>       

 <?php include('includes/footerscript.php');?>      

<?php
$status_alert = $_SESSION['status'];

if(isset($_SESSION['status']))
{
if ($status_alert == "Your Password Changed..!!") 
{
  ?>
          <script>
          swal({
            title: "<?php echo $_SESSION['status']; ?>",
            text: "You clicked the button!",
            icon: "<?php echo $_SESSION['code']; ?>",
            button: "Ok",
          
          }).then(function() {
          window.location = "my_account.php";
          });
         </script>
<?php
}
elseif ($status_alert == "password Does not Match..!!") 
{    
?>
       <script>
          swal({
            title: "<?php echo $_SESSION['status']; ?>",
            text: "You clicked the button!",
            icon: "<?php echo $_SESSION['code']; ?>",
            button: "Ok",
          
          });
         </script>
<?php
}
elseif ($status_alert == "invalid password..!!") 
{    
?>
       <script>
          swal({
            title: "<?php echo $_SESSION['status']; ?>",
            text: "You clicked the button!",
            icon: "<?php echo $_SESSION['code']; ?>",
            button: "Ok",
          
          });
         </script>
<?php
}
elseif ($status_alert == "Address Update..!!") 
{    
?>
       <script>
          swal({
            title: "<?php echo $_SESSION['status']; ?>",
            text: "You clicked the button!",
            icon: "<?php echo $_SESSION['code']; ?>",
            button: "Ok",
          
          }).then(function() {
          window.location = "my_account.php";
          });
         </script>
<?php
}
elseif ($status_alert == "Some this went Wrong..!!") 
{    
?>
       <script>
          swal({
            title: "<?php echo $_SESSION['status']; ?>",
            text: "You clicked the button!",
            icon: "<?php echo $_SESSION['code']; ?>",
            button: "Ok",
          
          });
         </script>
<?php
}
unset($_SESSION['status']);
unset($_SESSION['code']);
}
?>
    </body>
<script>
     $('.add_new').on("click",function() {
      $.ajax({
        url: "ajax.php",
        type: "POST",
        cache: false,
        data: {
          addreess : addreess
        },
        success: function(dataResult){
          $("#maintable").append(dataResult);
        }
      });
      r= r+1;
  });
</script>
    
<!-- Mirrored from demo.hasthemes.com/ecolife-preview/ecolife/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 Jul 2020 05:47:21 GMT -->
</html>
