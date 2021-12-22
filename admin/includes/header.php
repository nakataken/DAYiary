<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo $title; ?></title>
    <link rel="stylesheet" href="../public/css/index.css">
    <link rel="stylesheet" href="../public/css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>



    <nav class="navbar navbar-expand-md   px-5 pt-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="/DAYiary/users/"><img src="../public/img/logo.png" alt="logo" class="logo"></a>
                <button  class="navbar-toggler p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon col-12 my-auto"><img src="./../public/img/menu_btn.png" class="mx-auto col-12 my-auto"></span>
                </button>

                <div class="collapse navbar-collapse collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto my-auto d-flex flex-md-row flex-column align-items-end ">
                    
                        <li class="nav-item">
                            <a class="nav-link " href="./index.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="./usersTable.php">Users table</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="./logout.php">Logout</a>
                        </li>
                        
                    </ul>
                
                </div>
            </div>
            
        </nav>