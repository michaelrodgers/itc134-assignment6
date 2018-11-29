<!DOCTYPE html>
<html>
    <head>
        <title>Administrator Page</title>
        <<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
        <link href="business-casual.css" rel="stylesheet">
        <link href="bootstrap.min.css" rel="stylesheet">

    </head>
    </head>
<body>
    <a id="navA" href="./guestbook.php">GuestBook Page</a>
    <h1 id="pagehead">
        Guestbook Administrator Page
    </h1>
    
    
    <hr>
     <div class="container">
        <div class="bg-faded p-4 my-4">  
    <?php 
    
    $errors = [];
    $admin_user = $admin_pwd = '';
    
    
    $username = password_hash("admin", PASSWORD_DEFAULT,['salt'=>'assignment4part2guestbook']);
    $password = password_hash("123456", PASSWORD_DEFAULT,['salt'=>'assignment4part2guestbook']);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        if(!empty($_POST['admin_user'])){
            $admin_user = $_POST['admin_user'];
            $user_hash = password_hash($admin_user, PASSWORD_DEFAULT,['salt'=>'assignment4part2guestbook']);
        }else{
            $errors[] = 'admin_user';
        }
        
        if(!empty($_POST['admin_pwd'])){
            $admin_pwd = $_POST['admin_pwd'];
            $pwd_hash = password_hash($admin_pwd, PASSWORD_DEFAULT,['salt'=>'assignment4part2guestbook']);
        }else{
            $errors[] = 'admin_pwd';
        }
        
        if ($user_hash == $username && $password == $pwd_hash) { 
               
$servername = "127.0.0.1";
$username = "root";
$password = "ITC134a6";
$dbname = "a6";
 
// create connect
$sql = "SELECT DISTINCT * FROM guestbook";
$conn = new mysqli($servername, $username, $password, $dbname);

$result = $conn->query($sql);

// Check connection
if ($conn->connect_error) {
    die("connect fail: " . $conn->connect_error);
} 

if($result->num_rows > 0)
{//show records

    while($row = $result->fetch_assoc())
    {
        echo "<p>";
	   echo "Name: <b>" . $row['name'] . "</b><br />";
       echo "Telephone Number: <b>" . $row['tel'] . "</b><br />";
	   echo "Email: <b>" . $row['email'] . "</b><br />";
        echo '</p>';
        
    }    
 
 
}else{//inform there are no records
    echo '<p>There are currently no contacts</p>';
}

//release web server resources
$result->free_result();

//close connection to mysql
$conn->close();
    $admin_user = $admin_pwd = '';
             } else if(!empty($user_hash)&&!empty($pwd_hash)){  
              echo "Username or password incorrect"."<br>";
              }
        else{
            echo "Username and password can't be empty";
        }
    }
    ?>
    <hr>
 

<form method="post" action="admin.php">
    <div class="control-group">
        <div class="form-group floating-label-form-group controls">
        <p>
            <label for="admin_user">
                User: 
            </label>
            <input type="text" name="admin_user" value="<?php echo $admin_user ?>" />
            <?php if(in_array('admin_user', $errors)): ?>
            <br>
               <span style="color:red">Field is required.</span>
            <?php endif ?>
        </p>
        
        <p>
            <label for="admin_pwd">
                Password:
            </label>
            <input type="text" name="admin_pwd" value="<?php echo $admin_pwd ?>" />
            <?php if(in_array('admin_pwd', $errors)): ?>
            <br>
               <span style="color:red">Field is required.</span>
            <?php endif ?>
        </p>
            <button type="submit">
               Login
            </button>
        </p>
        </div>
  </div> 
    </div> 
      </div> 
</form>
</body>
</html>
