<?php
session_start();

if(!isset($_SESSION['username'])){
    header('location:replogin.php');
}

$con = mysqli_connect('localhost', 'root', "");

mysqli_select_db($con, 'helpaid');

$ID = $_POST['ID'];

if(isset($_POST['submit'])){

    $message = '';
    $fileCount = count($_FILES['file']['name']);
    for($i=0; $i<$fileCount; $i++){
        $fileName = $_FILES['file']['name'][$i];
        $sql = "insert into documents(title, applicantID, content) values('$fileName', '$ID', '$fileName')";

        if($con->query($sql) == TRUE){
            $message = "File(s) uploaded successfully";
        }else{
            $message = "ERROR";
        }

        move_uploaded_file($_FILES['file']['tmp_name'][$i], 'documents/'.$fileName);
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" />
    <!--google font-->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@200;500&display=swap" rel="stylesheet" crossorigin="anonymous">
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <!--main css-->
     <link rel="stylesheet" href="main_gen.css" type="text/css">
     <title>Confirmation</title>
</head>
<body class="body">
<nav class="navbar navbar-expand-lg navbar-expand-md">
        <div class="container-fluid">
            <a class="navbar-brand m-0">
                <img class="img" src="helpaid_logo.jpg" alt="logo">
            </a>
            <ul class="navigation navbar-nav justify-content-end align-items-center p-0 p-lg-3">
                <h3 class="text-left text-light me-4 p-1 border">Hello, <?php echo $_SESSION['username'] ?></h3>
                <li class="item nav-item"><a class="link a nav-link" href="index.html">Home</a></li>
                <li class="item nav-item"><a class="link a nav-link" href="#">About</a></li>
                <li class="item nav-item"><a class="link a nav-link" href="#">Contacts</a></li>
                <li class="item nav-item"><a class="link a nav-link" href="#">Blog</a></li>
            </ul>
            <div class="hamburger-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav> 
    <div class="successful-box w-50 mx-auto text-center mb-5">
        <h1 class="h1 p-5"><?php echo $message ?></h1>
        <p class="p-2">Thank you for using us!</p>
        <form action="addApplicant.php" class="d-inline-block">
            <button type="submit" name="submit" class="button btn btn-success me-1">Add Applicant</button>
        </form>
        <form action="logout.php" class="d-inline-block">
            <button type="submit" name="submit" class="button btn btn-success me-1">Log out</button> 
        </form>
    </div>
    <footer class="footer w-100 text-center text-lg-start mt-5">
       <div class="row container-fluid justify-content-center align-items-center p-4">
           <div class="col-lg-3 col-md-6 mb-4"><img src="helpaid.png" alt="logo"><h3 class="h3 logo">HELP-Aid</h3>
            </div>
           <div class="col-lg-3 col-md-6 mb-4"><h3 class="h3 p-2">Contact</h3>
            <ul class="ul list-unstyled">
                <li class="li"><a class="a" href="mailto: helpaid@gmail.com"><i class="fa-solid fa-envelope me-2"></i>Mail us</a></li>
                <li class="li"><a class="a" href="tel: +88013243325"><i class="fa-solid fa-phone me-2"></i>Call us</a></li>
            </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4"><h3 class="h3 p-2">About</h3>
                <ul class="ul list-unstyled">
                    <li class="li"><a class="a" href="#">Who we are?</a></li>
                    <li class="li"><a class="a" href="#">Our history</a></li>
                </ul>
            </div>
           <div class="col-lg-3 col-md-6 mb-4">
            <ul class="list-unstyled list-inline text-lg-start text-center">
                <li class="list-inline-item">
                  <a class="btn-floating btn-fb mx-1">
                    <i class="fa-brands fa-facebook"> </i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="btn-floating btn-insta mx-1">
                    <i class="fa-brands fa-instagram"> </i>
                  </a>
                </li>
                <li class="list-inline-item">
                  <a class="btn-floating btn-tw mx-1">
                    <i class="fa-brands fa-twitter"> </i>
                  </a>
                </li>
                <li class="list-inline-item">
                    <a class="btn-floating btn-in mx-1">
                        <i class="fa-brands fa-linkedin-in"> </i>
                    </a>
                  </li>
               </ul>
           </div>
       </div>
   </footer>
   <div class="copyright p-4 font-small text-center w-100 m-0">&copy; Rights Reserved 2022</div>

   <!--script JS-->
   <script src="hamburger.js"></script>
   <!--Bootstrap JS-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>