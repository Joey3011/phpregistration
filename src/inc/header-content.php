<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/../myPage/css/portfolio.css">
  <link rel="stylesheet" href="/../myPage/css/bootstrap.min.css">
  <link rel="stylesheet" href="/../myPage/css/bootstrap.css">
  <script type="text/javascript" src="/../myPage/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/../myPage/js/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title><?= $title ?? 'Dashboard' ?></title>
</head>
<body>
  <nav>
      <div class="navbar">
        <i class="fa fa-bars" aria-hidden="true"></i>
        <div class="logo">
          <a href="portfolio">Portfolio</a>
        </div>
        <div class="nav-links">
          <div class="sidebar-logo">
              <span class="logo-name">
                <a href="portfolio">Portfolio</a>
                <i class="fa fa-close" aria-hidden="true"></i>
              </span>
          </div>
          <ul class="links"> 
              <li><a href="logout">Logout</a></li>         
              <li><a href="#">Hi! <?= current_user() ?> </a></li>
          </ul>
        </div>
      </div>
    </nav>
<div class="main-container">



