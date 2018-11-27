<!DOCTYPE html>
<html>
    <head>
        <title>GuestBook</title>
        <<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
        <link href="business-casual.css" rel="stylesheet">
        <link href="bootstrap.min.css" rel="stylesheet">

    </head>
<body>
    <h1>
        GuestBook
    </h1>
    
    <hr>
    <?php 
    
$servername = "127.0.0.1";
$username = "root";
$password = "ITC134a6";
$dbname = "a6";
 
// create connect
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("connect fail: " . $conn->connect_error);
} 
 
$sql = "SELECT _id, name, tel, email FROM guestbook";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    // output
    while($row = $result->fetch_assoc()) {
    }
} else {
    echo "0 result";
}
    
        //Track fields with errors
        $errors = [];
    //Only process on submit
    
    $guest_name = $guest_email = $guest_tel = $message = '';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!empty($_POST['guest_name'])){
           $guest_name = $_POST['guest_name'];   
        }
        else{
            
            $errors[] = 'guest_name';
        }
        
        if(isset($_POST['guest_email'])){
            $guest_email = $_POST['guest_email'];
            if(!filter_var($guest_email, FILTER_VALIDATE_EMAIL)){
                $errors[] = 'guest_email';
            }
        }else{
            $errors[] = 'guest_email';
        }
        
         if(isset($_POST['guest_tel'])){
            $guest_tel = $_POST['guest_tel'];
            if( !is_numeric($guest_tel)||$guest_tel<1000000000){
                $errors[] = 'guest_tel';
            }
        }else{
            $errors[] = 'guest_tel';
        }
        
        if(isset($_POST['message'])){
            $message = $_POST['message'];
        }
        
        if(count($errors) > 0){
            echo"<strong style='color:red'>Fix the errors.</strong>";
            echo "<ul>";
            foreach($errors as $error){
                echo"<li>Required field: $error</li>";
            }
            echo"</ul>";
        }else{
        
        $sql = "INSERT INTO guestbook (name, tel, email)
VALUES ('$guest_name','$guest_tel','$guest_email')";
 
if ($conn->query($sql) === TRUE) {
    echo "  New record added";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
        
        echo"<strong>  Thank you, $guest_name.</strong>";
        $guest_name = $guest_email = $guest_tel = $message = '';
        
        }
        
    }
       
    $conn->close();
    ?>
    <hr>
    
    <div class="container">
        <div class="bg-faded p-4 my-4">

    <h3>
        Sign the Guestbook
    </h3>
    <em>
        * fields are required
    </em>
    <form method="post" action="guestbook.php">
        <div class="control-group">
              <div class="form-group floating-label-form-group controls">
            <label for="quest_name">
                Enter your name:*
            </label>
            <input type="text" name="guest_name" value="<?php echo $guest_name ?>" />
            <?php if(in_array('guest_name', $errors)): ?>
            <br>
               <span style="color:red">Field is required.</span>
            <?php endif ?>
        </div>
            </div>
        
        <div class="control-group">
              <div class="form-group floating-label-form-group controls">
            <label for="quest_tel">
                Enter your tel-number:*
            </label>
            <input type="text" name="guest_tel" value="<?php echo $guest_tel ?>" />
            <?php if(in_array('guest_tel', $errors)): ?>
            <br>
               <span style="color:red">Valid number is required.</span>
            <?php endif ?>
        </div>
            </div>
        
        <div class="control-group">
              <div class="form-group floating-label-form-group controls">
            <label for="guest_email">
                Enter a valid email:*
            </label>
            <input type="text" name="guest_email" value="<?php echo $guest_email ?>">
            <?php if(in_array('guest_email',$errors)): ?>
            <br>
               <span style="color:red">Valid email is required.</span>
            <?php endif ?>
        </div>
            </div>
        
        <div class="control-group">
              <div class="form-group floating-label-form-group controls">
            <label for="message">
                Please enter a message:
            </label>
            <br>
            <textarea name="message"><?php echo $message ?></textarea>
        </div>
            </div>
        
        <br>
            <div id="success"></div>
            <div class="form-group">
            <button type="submit">
                Sign Guestbook
            </button>
        </div>
        <a href="https://itc134-assignment6-michaelrodgers.c9users.io/datareturn.php">View database return</a>
                
    </form>
    
    </div>
    </div>
</body>
</html>