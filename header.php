<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- FA cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    

</head>

<body>
    <section id="navbarSection">
        <nav class="navbar navbar-expand bg-white ">
            <div class="container d-block px-3">
                <div class="d-flex align-items-center flex-wrap-reverse">
                    <div class="d-flex align-items-center pt-0 dropdown position-relative nav-item">
                        <div class="d-flex align-item-center nav-item mt-1">
                            <a class="d-flex align-item-center text-decoration-none" href="/"><img class="me-3" src="./img/batoi-logo-og.png" alt="logo" height="30"><span class="logo_bar me-3 fs-4 fw-light text-body-secondary">|</span><span class="fs-5 text-success me-3">Hub</span> </a>
                        </div>
                        <div class="dropdown focus-ring focus-ring-light">
                            <a class="btn dropdown-toggle border-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                English
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">English</a></li>
                                <li><a class="dropdown-item" href="#">Odia</a></li>
                                <li><a class="dropdown-item" href="#">Hindi</a></li>
                            </ul>
                            
                        </div>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ms-auto d-flex align-items-center">
                            <li class="list-style-none nav-item">
                            <li class="nav-item">
                                <form action="search.php">
                                    <input type="text" name="search" class="d-none p-2 w-10 form-control" placeholder="Type search text and press enter..." />
                                </form>
                            </li>
                            <li class="nav-item">
                                <i class="fa fa-times d-none text-secondary ms-2" aria-hidden="true"></i>
                                <i class="fa fa-search d-block text-secondary ms-2" aria-hidden="true"></i>
                            </li>

                            </li>
                            <li class="list-style-none nav-item">
                                <a href="/login.php" class="text-decoration-none text-Success mx-3">Login</a>
                            </li>
                            <li class="list-style-none nav-item">
                                <a class="d-none d-md-block btn btn-sm btn-outline-primary ms-2 ms-md-2" href="/signup.php"><i class="fa fa-arrow-circle-right text-primary-subtle me-2" aria-hidden="true"></i>Get started</a>
                            </li>
                            <li class="nav-item"><a class="d-block d-md-none btn btn-sm btn-outline-primary ms-2 ms-md-2" href="./signup.php"><i class="fa fa-sign-in " aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>