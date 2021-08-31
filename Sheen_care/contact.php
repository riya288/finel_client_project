<?php

include('header.php');

include('admin/connection.php');

session_start();





if (isset($_REQUEST['submit'])) 

{

    $name = $_REQUEST['name'];

    $email = $_REQUEST['email'];

    $subject = $_REQUEST['subject'];

    $message = $_REQUEST['message'];
    
    $contact_for = $_REQUEST['contact_for'];

       





    $insert = "INSERT INTO inquiry(name,email,subject,message,contact_for) VALUES('{$name}','{$email}','{$subject}','{$message}','{$contact_for}')";

    $run = mysqli_query($conn, $insert); 



    if ($run) 

    {



       $_SESSION['status']= "Thank You..!!";

       $_SESSION['code']= "success";

    }

    else

    {

       $_SESSION['status']= "Something went wrong..!!";

       $_SESSION['code']= "error";

    }



  

}





?>



            <!-- Breadcrumb Area start -->

            <section class="breadcrumb-area">

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <div class="breadcrumb-content">

                                <h1 class="breadcrumb-hrading">Contact Us</h1>

                                <ul class="breadcrumb-links">

                                    <li><a href="index.php">Home</a></li>

                                    <li>Contact Us</li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <!-- Breadcrumb Area End -->



            <!-- contact area start -->

            <div class="contact-area mtb-60px">

                <div class="container">

                    

                    <div class="custom-row-2">

                        <div class="col-lg-5 col-md-5">

                            <div class="contact-info-wrap">

                                <div class="single-contact-info">

                                    <div class="contact-icon">

                                        <i class="fa fa-phone"></i>

                                    </div>

                                    <div class="contact-info-dec">

                                        <p><a href="tel: +919428172734 ">+91 9428172734</a></p>

                                    </div>

                                </div>

                                <div class="single-contact-info">

                                    <div class="contact-icon">

                                        <i class="fa fa-globe"></i>

                                    </div>

                                    <div class="contact-info-dec">

                                        <p><a href="mailto: Query@octopuscare.in ">Query@octopuscare.in</a></p>

                                    </div>

                                </div>

                                <div class="single-contact-info">

                                    <div class="contact-icon">

                                        <i class="fa fa-map-marker"></i>

                                    </div>

                                    <div class="contact-info-dec">

                                        <a href="https://goo.gl/maps/RJr3CUjQJmrMbi857"><p>GF-101 to 108 Tower-E,</p>

                                        <p>Shrey Avenue-2, Near Segva Chowkadi,</p>

                                        <p>Shinor Road, Segva.ta. Shinor, Vadodara, Gujarat 391105</p></a>

                                        

                                    </div>

                                </div>

                                <div class="contact-social">

                                    <h3>Follow Us</h3>

                                    <div class="social-info">

                                        <ul>

                                            <!--<li>-->

                                            <!--    <a href="https://www.facebook.com/SheenOctopus" target="_blank"><i class="ion-social-facebook"></i></a>-->

                                            <!--</li>-->
                                             <li>

                                                <a href="https://www.youtube.com/channel/UCO8GZZ4YhoQgBnzrz1s3CEw" target="_blank"><i class="ion-social-youtube"></i></a>

                                            </li>

                            <!--                 <li>

                                                <a href="#"><i class="ion-social-twitter"></i></a>

                                            </li>

                                           

                                            <li>

                                                <a href="#"><i class="ion-social-google"></i></a>

                                            </li>-->

                                            <li>

                                                <a href="https://www.instagram.com/sheencare__/" target="_blank"><i class="ion-social-instagram"></i></a>

                                            </li> 

                                        </ul>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-lg-7 col-md-7">

                            <div class="contact-form">

                                <div class="contact-title mb-30">

                                    <h2>Get In Touch</h2>

                                </div>



                                <form class="contact-form-style" id="contact-form"  method="post">

                                    <div class="row">

                                      	  
                                      
                                        <div class="col-lg-6">

                                            <input name="name" placeholder="Name*" type="text" required="" />

                                        </div>

                                        <div class="col-lg-6">

                                            <input name="email" placeholder="Email*" type="email" required="" />

                                        </div>

                                        <div class="col-lg-12 text-center" >
                                          <select name="contact_for" required="" style="width:100% !important;">
                                            <option hidden="">Contact Reason</option>
                                            <option value="Query regarding products">Query regarding products </option>
                                            <option value="Query related to Distributorship & Franchise">Query related to Distributorship & Franchise </option>
                                          </select>                                         

                                        </div>
                                        <br>

                                        <div class="col-lg-12 " style="margin-top:15px;">

                                            <input name="subject" placeholder="Subject*" type="text" required="" />

                                        </div>

                                        <div class="col-lg-12">

                                            <textarea name="message" placeholder="Your Message*" required=""></textarea>

                                            <input type="submit" name="submit" value="SEND" style="background-color: green; color: white;" >

                                        </div>

                                    </div>

                                </form>



                                <p class="form-messege"></p>

                            </div>

                        </div>

                    </div>



                    <div class="contact-map mb-10 mt-5">

                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3699.090701566938!2d73.36835631494954!3d22.007835385476277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395fe50ff396ce69%3A0x7b5409ee11448f11!2sOctopus%20Care!5e0!3m2!1sen!2sin!4v1618990817087!5m2!1sen!2sin" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>  



                    </div>



                </div>

            </div>

            <!-- contact area end -->

                

         <?php include('includes/footer.php');?>       



 <?php include('includes/footerscript.php');?> 



    <!--     <script>

            function init() {

                var mapOptions = {

                    zoom: 11,

                    scrollwheel: false,

                    center: new google.maps.LatLng(40.709896, -73.995481),

                    styles: [

                        {

                            featureType: "water",

                            elementType: "geometry",

                            stylers: [

                                {

                                    color: "#e9e9e9",

                                },

                                {

                                    lightness: 17,

                                },

                            ],

                        },

                        {

                            featureType: "landscape",

                            elementType: "geometry",

                            stylers: [

                                {

                                    color: "#f5f5f5",

                                },

                                {

                                    lightness: 20,

                                },

                            ],

                        },

                        {

                            featureType: "road.highway",

                            elementType: "geometry.fill",

                            stylers: [

                                {

                                    color: "#ffffff",

                                },

                                {

                                    lightness: 17,

                                },

                            ],

                        },

                        {

                            featureType: "road.highway",

                            elementType: "geometry.stroke",

                            stylers: [

                                {

                                    color: "#ffffff",

                                },

                                {

                                    lightness: 29,

                                },

                                {

                                    weight: 0.2,

                                },

                            ],

                        },

                        {

                            featureType: "road.arterial",

                            elementType: "geometry",

                            stylers: [

                                {

                                    color: "#ffffff",

                                },

                                {

                                    lightness: 18,

                                },

                            ],

                        },

                        {

                            featureType: "road.local",

                            elementType: "geometry",

                            stylers: [

                                {

                                    color: "#ffffff",

                                },

                                {

                                    lightness: 16,

                                },

                            ],

                        },

                        {

                            featureType: "poi",

                            elementType: "geometry",

                            stylers: [

                                {

                                    color: "#f5f5f5",

                                },

                                {

                                    lightness: 21,

                                },

                            ],

                        },

                        {

                            featureType: "poi.park",

                            elementType: "geometry",

                            stylers: [

                                {

                                    color: "#dedede",

                                },

                                {

                                    lightness: 21,

                                },

                            ],

                        },

                        {

                            elementType: "labels.text.stroke",

                            stylers: [

                                {

                                    visibility: "on",

                                },

                                {

                                    color: "#ffffff",

                                },

                                {

                                    lightness: 16,

                                },

                            ],

                        },

                        {

                            elementType: "labels.text.fill",

                            stylers: [

                                {

                                    saturation: 36,

                                },

                                {

                                    color: "#333333",

                                },

                                {

                                    lightness: 40,

                                },

                            ],

                        },

                        {

                            elementType: "labels.icon",

                            stylers: [

                                {

                                    visibility: "off",

                                },

                            ],

                        },

                        {

                            featureType: "transit",

                            elementType: "geometry",

                            stylers: [

                                {

                                    color: "#f2f2f2",

                                },

                                {

                                    lightness: 19,

                                },

                            ],

                        },

                        {

                            featureType: "administrative",

                            elementType: "geometry.fill",

                            stylers: [

                                {

                                    color: "#fefefe",

                                },

                                {

                                    lightness: 20,

                                },

                            ],

                        },

                        {

                            featureType: "administrative",

                            elementType: "geometry.stroke",

                            stylers: [

                                {

                                    color: "#fefefe",

                                },

                                {

                                    lightness: 17,

                                },

                                {

                                    weight: 1.2,

                                },

                            ],

                        },

                    ],

                };

                var mapElement = document.getElementById("map");

                var map = new google.maps.Map(mapElement, mapOptions);

                var marker = new google.maps.Marker({

                    position: new google.maps.LatLng(40.709896, -73.995481),

                    map: map,

                    icon: "assets/images/icons/2.png",

                    animation: google.maps.Animation.BOUNCE,

                    title: "Snazzy!",

                });

            }

            google.maps.event.addDomListener(window, "load", init);

        </script> -->

        <!-- Main Activation JS -->

        <script src="assets/js/main.js"></script>



<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<?php

$status_alert = $_SESSION['status'];



if(isset($_SESSION['status']))

{

    if ($status_alert == "Thank You..!!") 

    {

      ?>

              <script>

              swal({

                title: "<?php echo $_SESSION['status']; ?>",

                text: "Please Check Your Email..!",

                icon: "<?php echo $_SESSION['code']; ?>",

                button: "Ok",

              

              }).then(function() {

              window.location = "contact.php";

              });

             </script>

    <?php

    }

    else

    {

    ?>

           <script>

              swal({

                title: "<?php echo $_SESSION['status']; ?>",

                text: "You clicked the button!",

                icon: "<?php echo $_SESSION['code']; ?>",

                button: "Ok",

              

              }).then(function() {

              window.location = "contact.php";

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

