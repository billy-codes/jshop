<?php

session_start();

if (!isset($_SESSION['logged_in'])) {
    $nav ='includes/nav.php';
}

elseif($_SESSION['logged_in'] == 'True') {
  header('Location: index');
}

else{
  $nav ='includes/navconnected.php';
  $idsess = $_SESSION['id'];
}
error_reporting(0);

 require 'includes/header.php';
 require $nav; ?>



<div class="container-fluid center-align sign">
  <div class="container">

  <div class="row">
    <div class="col s12">
       <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#test1">Log In</a></li>
        <li class="tab col s3"><a  href="#test2">Sign Up</a></li>
       </ul>
   </div>

<div class="container forms">
  <div class="row">

      <!-- SIGN UP START -->
      <div id="test2" class="col s12 left-align">
        <div class="card">
          <div class="row">
            <form class="col s12" method="POST" enctype="multipart/form-data">
              <div class="input-field col s6">
                <i class="material-icons prefix">email</i>
                <input id="iemail" type="text" name="email" class="validate" required>
                <label for="iemail">Email</label>
              </div>

              <div class="input-field col s6">
                <select class="icons" name="country">
                  <option value=""  disabled selected>Choose your country</option>
                  <option value="Morocco">Morocco</option>
                  <option value="Egypt">Egypt</option>
                  <option value="Algeria">Algeria</option>
                </select>
                <label>Country</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <input id="ifirstname" type="text" name="firstname" class="validate" required>
                <label for="ifirstname">First Name</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">perm_identity</i>
                <input id="ilastname" type="text" name="lastname" class="validate" required>
                <label for="ilastname">Last Name</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">lock</i>
                <input id="ipassword" type="password" name="password" class="validate value1" required>
                <label for="ipassword">Password</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">lock</i>
                <input id="iconfirmation" type="password" name="confirmation" class="validate value2" required>
                <label for="iconfirmation">Confirm Password</label>
              </div>

              <div class="input-field col s6">
                <i class="material-icons prefix">business</i>
                <input id="icity" type="text" name="city" class="validate" required>
                <label for="icity">City</label>
              </div>

              <div class="input-field col s6 meh">
                <i class="material-icons prefix">location_on</i>
                <input id="iaddress" type="text" name="address" class="validate" required>
                <label for="iaddress">Address</label>
              </div>


              <?php require 'includes/signupconfirmation.php'; ?>
              <div class="center-align">
                  <button type="submit" id="confirmed" name="signup" class="btn meh button-rounded waves-effect waves-light ">Sign up</button>
              </div>

                <p>By Registering, you agree that you've read and accepted our <a href="">User Agreement</a>,
                  you're at least 18 years old, and you consent to our <a href="">Privacy Notice and receiving</a>
                  marketing communications from us.</p>
            </form>
          </div>
        </div>
      </div>
      <!-- SIGN UP END -->

      <!-- LOGIN START -->
      <div id="test1" class="col s12 left-align">
        <div class="card">  
          <div class="row">
            <form class="col s12" method="POST">
              <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <input id="email" type="text" name="emaillog" class="validate">
                <label for="email">Email</label>
              </div>
              <div class="input-field col s12 meh">
                <i class="material-icons prefix">lock</i>
                <input id="password" type="password" name="passworddb" class="validate">
                <label for="password">Password</label>
              </div>
           <?php require 'includes/loginconfirmation.php';?>
               <div class="center-align">
                   <button type="submit" name="login" class="btn button-rounded waves-effect waves-light ">Login</button>
               </div>

            </form>
          </div>
        </div>
      </div>
      <!-- LOGIN END -->

  </div>
</div>


   </div>
  </div>
</div>

  <?php require 'includes/footer.php'; ?>
