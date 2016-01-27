<?php
require('db.php');
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Top up</title>

    
    <link href="css/bootstrap.min.css" rel="stylesheet">



</head>

<body>
    
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="margin-bottom:50px;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="insert.php">Top Up</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="history.php">ประวัติการเติมเงิน</a></li>
                    <li><a><?php if(!empty($_SESSION['cus_id'])){echo $_SESSION['wallet'];}  ?> Point </a></li>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span>   <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];} else{echo "No user";}  ?> <b class="caret"></b></a>
                        <?php if(!empty($_SESSION['cus_id'])) { ?>
                        <ul class="dropdown-menu">
                            
                            <li>
                                <a href="#">Edit Profile</a>
                            </li>
                            <li>
                                <a href="insert.php?mode=logout">Log out</a>
                            </li>
                        </ul>
                        <?php } ?>
                    </li>
                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>