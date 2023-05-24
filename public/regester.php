
<?php
    $errorMsg = "";

    try{
        $host = "localhost";
        $dbname = "shop_app";
        $username = "root";
        $password = "root";
        $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['conf_password'])) 
        {
            $fname = $_POST['first_name'];
            $lname = ($_POST['last_name']) ;
            $email = ($_POST['email']);
            $password = ($_POST['password']) ;
            $conf_password = ($_POST['conf_password']);
            // var_dump($fname, $lname, $email);


            $query = "SELECT COUNT(*) FROM customers where email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":email",$email);
            $stmt->execute();
            $emailExists = $stmt->fetchColumn();

            if($emailExists){
                $errorMsg ="The email address is already registered. Please choose a different email.";
                
            }
            else{
                if($password != $conf_password){
                    $errorMsg = "The password and the confirm password do not match.";
        
                }
                elseif (empty($password)) {
                    $errorMsg = "Password cannot be empty.";
                }
                else{
                    $password_hashed =password_hash($password,PASSWORD_DEFAULT);
                    $sql = "INSERT INTO customers (first_name,last_name,email,password) values (:fname, :lname, :email, :password)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":fname",$fname);
                    $stmt->bindParam(":lname",$lname);
                    $stmt->bindParam(":email",$email);
                    $stmt->bindParam(":password",$password_hashed);
                    $stmt->execute();
                    
                    header("Location: login.php ");
                }
            }
        }
        
      

    }catch(PDOException $e){
        echo $e->getMessage();
    }

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <link rel="icon" href="data:,">
    <title>Table Products for Editing and deleting</title>
</head>

<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-md-6 col-lg-4">
                <form class="card" action="regester.php" method="POST">
                    <h5 class="card-title fw-400">Sign Up</h5>

                    <div class="card-body">
                        <div class="form-group">
                            <input class="form-control" name="first_name" type="text" placeholder="First name" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="last_name" type="text" placeholder="Last name" required>
                        </div>

                        <div class="form-group">
                            <input class="form-control" name = "email" type="email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <input class="form-control" name = "password" type="password" placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <input class="form-control" name = "conf_password" type="password" placeholder="Confirm Password" required>
                        </div>
                        <?php if (!empty($errorMsg)) : ?>
                            <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
                        <?php endif; ?>
                        <div class="text-center">
                            <button class="btn btn-block btn-bold btn-primary">Sign Up</button>
                        </div>
                    </div>
                </form>
          </div>
        </div>
    </div>
</div>

<style>
    .card {
    border: 0;
    border-radius: 0px;
    margin-bottom: 30px;
    -webkit-box-shadow: 0 2px 3px rgba(0,0,0,0.03);
    box-shadow: 0 2px 3px rgba(0,0,0,0.03);
    -webkit-transition: .5s;
    transition: .5s;
}

.padding {
    padding: 3rem !important
}

body {
    background-color: #f9f9fa
}

h5.card-title {
    font-size: 15px;
}

.fw-400 {
    font-weight: 400 !important;
}

.card-title {
    font-family: Roboto,sans-serif;
    font-weight: 300;
    line-height: 1.5;
    margin-bottom: 0;
    padding: 15px 20px;
    border-bottom: 1px solid rgba(77,82,89,0.07);
}

.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-control {
    border-color: #ebebeb;
    border-radius: 2px;
    color: #8b95a5;
    padding: 5px 12px;
    font-size: 14px;
    line-height: inherit;
    -webkit-transition: 0.2s linear;
    transition: 0.2s linear;
}

.card-body>*:last-child {
    margin-bottom: 0;
}

.btn-primary {
    background-color: #33cabb;
    border-color: #33cabb;
    color: #fff;
}
.btn-bold {
    font-family: Roboto,sans-serif;
    text-transform: uppercase;
    font-weight: 500;
    font-size: 12px;
}

.btn-primary:hover {
    background-color: #52d3c7;
    border-color: #52d3c7;
    color: #fff;
}

.btn:hover {
    cursor: pointer;
}

.form-control:focus {
    border-color: #83e0d7;
    color: #4d5259;
    -webkit-box-shadow: 0 0 0 0.1rem rgba(51,202,187,0.15);
    box-shadow: 0 0 0 0.1rem rgba(51,202,187,0.15);
}

.custom-radio {
    cursor: pointer;
}

.custom-control {
    display: -webkit-box;
    display: flex;
    min-width: 18px;
}

</style>