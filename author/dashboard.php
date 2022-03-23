<!DOCTYPE html>
<html>
<?php
    include 'connect.php';
 
    // Check connection
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
     
      if(!isset($_SESSION)) 
      { 
          session_start(); 
          $email=$_SESSION['email'];
          $id=$_SESSION['admin_id'];
      
      }



    ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Stories-Singaliner Inc</title>
	<link rel="icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Barlow">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Table-with-search-1-1.css">
    <link rel="stylesheet" href="assets/css/Table-with-search-1.css">
</head>
         



<body id="page-top">
    <div id="wrapper">
    <?PHP          
         
         $result=mysqli_query($conn,"SELECT * from admin where email='$email'");
         $rows=mysqli_num_rows($result);        
         
         if ($rows>0) {
           
        while ($rows=mysqli_fetch_array($result)) {
            
            ?>
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href="dashboard.php" style="font-family: Barlow, sans-serif;"><i class="fas fa-tachometer-alt"></i><span>Singaliner Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="stories.php?edt=<?php echo $rows['admin_id']?>" style="font-family: Barlow, sans-serif;"><i class="fa fa-newspaper-o"></i><span style="font-weight: normal;">Articles</span></a><a class="nav-link" href="s-category.php?edt=<?php echo $rows['admin_id']?>" style="font-family: Barlow, sans-serif;"><i class="fa fa-newspaper-o"></i><span style="font-weight: normal;">Articles Categories&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php?edt=<?php echo $rows['admin_id']?>" style="font-family: Barlow, sans-serif;"><i class="fa fa-file-picture-o"></i><span style="font-weight: normal;">Gallery</span></a><a class="nav-link" href="g-category.php?edt=<?php echo $rows['admin_id']?>" style="font-family: Barlow, sans-serif;font-weight: normal;"><i class="fa fa-file-picture-o"></i><span>Gallery</span>&nbsp;Categories</a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#"><span class="d-none d-lg-inline mr-2 text-gray-600 small" style="font-family: Barlow, sans-serif;font-size: 16.8px;font-weight: normal;"><?php echo $rows['name'].' '.$rows['surname']?></span><img class="border rounded-circle img-profile" src="assets/img/logo.png"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in"><a class="dropdown-item" href="profile.php?edt=<?php echo $rows['admin_id']?>" style="font-family: Barlow, sans-serif;"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="logout.php" style="font-family: Barlow, sans-serif;"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <?php
                  
                }
          
              } ?>



                         <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0" style="font-family: Barlow, sans-serif;">Home</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-primary py-2">
                                <div class="card-body" style="font-family: Barlow, sans-serif;">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">


                                            <!--check total of articles-->
                                        <?php $query=mysqli_query($conn,"SELECT COUNT(article_id) AS articlecount FROM article");
                                         $data=mysqli_fetch_array($query);;
                                        ?>
       
                                            <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Articles</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $data['articlecount'] ?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="far fa-newspaper fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-success py-2" style="font-family: Barlow, sans-serif;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                                 <!--check total of gallery-->
                                     <?php
                                         $gallery=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(img_id) AS imgcount FROM gallery"));
                                        ?>
                                            <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Gallery</span></div>
                                            <div class="text-dark font-weight-bold h5 mb-0"><span><?php echo $gallery['imgcount']?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-images fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-info py-2" style="font-family: Barlow, sans-serif;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                                          <!--check total of stories-->
                                     <?php
                                         $stories=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(category_id) AS catcount FROM blog_category"));
                                        ?>
                                            <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Category (stories)</span></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span><?php  echo $stories['catcount'] ?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="far fa-list-alt fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-info py-2" style="font-family: Barlow, sans-serif;">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col mr-2">
                                             <!--check total of category-->
                                     <?php
                                         $gall=mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(category_id) AS catcount FROM gallery_category"));
                                        ?>
                                            <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Category (gallery)</span></div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span><?php echo $gall['catcount']?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="far fa-list-alt fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/Table-with-search-1.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>