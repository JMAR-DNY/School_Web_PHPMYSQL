<!DOCTYPE html>
<html lang="en">

<?php  require('header.php'); fetchMetaData(__FILE__);?>

<?php
// define variables and set to empty values
$contactFirstName = $contactLastName = $contactAddress = $contactCity = 
$contactState = $contactZipCode =$contactPhone = $contactEmail = $contactComments ="";    

$contactFirstNameERR = $contactLastNameERR = $contactAddressERR = $contactCityERR = 
$contactStateERR = $contactZipCodeERR =$contactPhoneERR = $contactEmailERR = $contactCommentsERR ="";

$displayMessage = "";

//FIRST NAME
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["fname"])) {
        $contactFirstNameERR = "First Name is required";
    } else {
        $contactFirstName = test_input($_POST["fname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$contactFirstName)) {
            $contactFirstNameERR = "Only letters and white space allowed";
        }
    }
//LAST NAME
    if (empty($_POST["lname"])) {
        $contactLastNameERR = "Last Name is required";
    } else {
        $contactLastName = test_input($_POST["lname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$contactLastName)) {
        $contactLastNameERR = "Only letters and white space allowed";
        }
    }
//ADDRESS
    if (empty($_POST["ca"])) {
        $contactAddressERR = "Address is required";
    } else {
        $contactAddress = test_input($_POST["ca"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/[A-Za-z0-9]+/",$contactAddress)) {
            $contactAddressERR = "Alphanumeric input only";
        }
    }    
//CITY
    if (empty($_POST["ccity"])) {
        $contactCityERR = "City is required";
    } else {
        $contactCity = test_input($_POST["ccity"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$contactCity)) {
            $contactCityERR = "Only letters and white space allowed";
        }
    }    
//STATE
    if (empty($_POST["contactState"])){
        $contactStateERR = "required selection";//this is set differently to work with insert logic
    }   else{
        $contactState = test_input($_POST["contactState"]);
    }
//ZIP CODE
    if (empty($_POST["cz"])) {
        $contactZipCodeERR = "Zip Code is required";
    } else {
        $contactZipCode = test_input($_POST["cz"]);
        $contactZipCode = substr($contactZipCode,0,9);
        $contactZipCode = preg_replace('/\s+/', '', $contactZipCode);
        // check if name only contains letters and whitespace
        if (!preg_match("/[0-9]+/",$contactZipCode)) {
            $contactZipCodeERR = "Invalid Zip Code Format";
        }
    }    
//PHONE #
    if (empty($_POST["cp"])) {
        $contactPhoneERR = "Name is required";
    } else {
        $contactPhone = test_input($_POST["cp"]);
        $contactPhone = substr($contactPhone,0,10);
        $contactPhone = preg_replace('/\s+/', '', $contactPhone);
        // check if name only contains letters and whitespace
        if (!preg_match("/[0-9]+/",$contactPhone)) {
            $contactPhoneERR = "Invalid Phone Number format";
        }
    }    
//EMAIL
if (empty($_POST["ce"])) {
    $contactEmailERR = "Email is required";
    } else {
        $contactEmail = test_input($_POST["ce"]);
    // check if e-mail address is well-formed
    if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
        $contactEmailERR = "Invalid email format";
    }
}  
//COMMENTS
  if (empty($_POST["cc"])) {
    $contactComments = "";
  } else {
    $contactComments = test_input($_POST["cc"]);
  }
//DATA PROCESSING
if($contactFirstNameERR == $contactLastNameERR && $contactAddressERR == $contactCityERR && $contactStateERR == 
$contactZipCodeERR && $contactPhoneERR == $contactEmailERR){
    $displayMessage = "Thank You, " .$contactFirstName. " " .$contactLastName;//thank you message

    session_start();

    $_SESSION["contactFirstName"] = $contactFirstName;
    $_SESSION["contactLastName"] = $contactLastName;
    $_SESSION["contactAddress"] = $contactAddress;
    $_SESSION["contactCity"] = $contactCity;
    $_SESSION["contactState"] = $contactState;
    $_SESSION["contactZipCode"] = $contactZipCode;
    $_SESSION["contactPhone"] = $contactPhone;
    $_SESSION["contactEmail"] = $contactEmail;
    $_SESSION["contactComments"] = $contactComments;
    
    include 'processform.php';//Calls Processform to handle database connection

    $contactFirstName = $contactLastName = $contactAddress = $contactCity = 
    $contactState = $contactZipCode =$contactPhone = $contactEmail = $contactComments ="";   
    //CLEARS VARIABLES
}

/*DONT TOUCH THIS*/}
?>

    <div class= "box">
        <div class="wrapper" id=lfaWrapper>
            <div id="myform">

            <br>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                <label>First Name:</label><input type="text" name="fname" value="<?php echo $contactFirstName;?>">
                <span class="error">* <?php echo $contactFirstNameERR;?></span>
                <br>
                <label>Last Name:</label><input type="text" name="lname" value="<?php echo $contactLastName;?>">
                <span class="error">* <?php echo $contactLastNameERR;?></span>
                <br>
                <label>Address:</label><input type="text" name="ca" value="<?php echo $contactAddress;?>">
                <span class="error">* <?php echo $contactAddressERR;?></span>
                <br>
                <label>City:</label><input type="text" name="ccity" value="<?php echo $contactCity;?>">
                <span class="error">* <?php echo $contactCityERR;?></span>
                <br>

                <label>State:</label><?php select_states($USSTATES, $contactState); ?>
                <span class="error">* <?php echo $contactStateERR;?></span>
                <br><br>

                <label>Zip Code:</label><input type="text" name="cz" maxlength=10 value="<?php echo $contactZipCode;?>">
                <span class="error">* <?php echo $contactZipCodeERR;?></span>
                <br>

                <label>Phone #:</label><input type="text" name="cp" maxlength=16 value="<?php echo $contactPhone;?>">
                <span class="error">* <?php echo $contactPhoneERR;?></span>
                <br>

                <label>E-mail:</label><input type="text" name="ce" value="<?php echo $contactEmail;?>">
                <span class="error">* <?php echo $contactEmailERR;?></span>
                <br>

                <label>Comments:</label><textarea name="cc" rows="5" cols="40"><?php echo $contactComments;?></textarea>
                <br><br>

                <input type="submit" name="submit" value="Submit">
                 
            <?php echo $displayMessage;?> 
            </div>


            <div>
                <div id ="downloadLinks">
                    <?php require('links.php');?>
                    <a href='download.php?file=index.php' download>index.php download</a><br>
                    <a href='download.php?file=php_mysql_form.php' download>php_mysql_form.php download</a><br>
                    <a href='download.php?file=processform.php' download>processform.php download</a>                   
                </div>                
                <?php
                echo '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. "The input validation is mostly handled here where
                the form is.  This page then posts back to itself until there are no more input errors.  The data is 
                then stored in a session which is used by processform.php.  Further data handling takes place there
                mainly to prevent database attacks.  If everything checks out then the data is inserted into the appropriate
                fields in the database.  The session is then terminated and a Thank You message is displayed.
                " .'</p>';?>                
            </div>
        </div>

    </div>
</body>

</html>