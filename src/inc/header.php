<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title><?= $title ?? 'Home' ?></title>
      <link rel="stylesheet" href="/../myPage/public/css/main.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <main>
        <div class="bg-wrapper light">
            <img src="/../myPage/public/image/shape.png" alt="" class="shape" />
            <header>
                <div class="containers">
                    <nav>
                        <div class="navbar">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                            <div class="logo">
                                <a href="portfolio"><img src="/../myPage/public/image/logos.png" alt="Logo" />Portfolio</a>
                            </div>
                            <div class="nav-links">
                                <div class="sidebar-logo">
                                    <span class="logo-name">
                                        <img src="/../myPage/public/image/logos.png" alt="Logo" /><a href="portfolio">Portfolio</a>
                                    </span>
                                <i class="fa fa-close" aria-hidden="true"></i>
                                </div>
                                <ul class="links">
                                    <li>
                                        <a href="portfolio">Home</a>
                                    </li>
                                    <li>
                                        <a href="register">Sign Up</a>
                                    </li>
                                    <li>
                                        <a href="sample_login">Login</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>