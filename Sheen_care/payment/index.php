<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Instamojo Payment Gateway Integrate in PHP - Tutsmake.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        .mt40{
            margin-top: 40px;
        }
    </style>
</head>
<body>
   
<div class="container">
 
<div class="row">
    <div class="col-lg-12 mt40">
        <div class="card-header" style="background: #0275D8;">
            <h2>Register for Event</h2>
        </div>
    </div>
</div>
    
<form action="payment-proccess.php" method="POST" name="instamojo_payment">
   
     <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <strong>Name</strong>
                <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Mobile Number</strong>
                <input type="text" name="mobile_number" class="form-control" placeholder="Enter Mobile Number" maxlength="10" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Email Id</strong>
                <input type="text" name="email" class="form-control" placeholder="Enter Email id" maxlength="50" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>Event Fees</strong>
                <input type="text" name="amount" class="form-control" placeholder="" value="100" readonly="">
            </div>
        </div>
        <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    
</form>
</div>
    
</body>
</html>