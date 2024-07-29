<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .cust_foot_link::before {
            content: "";
            width: 0;
            height: 2px;
            background: lightgray;
            position: absolute;
            display: block;
            margin-top: 22px;
            transition: all 0.3s ease-in-out;
            opacity: 0;
        }

        .cust_foot_link:hover::before {
            width: 2%;
            opacity: 1;
        }
    </style>

</head>

<body>
    <section id="footerSection">
        <div class="container d-block mt-2 mb-2">
            <div class="d-md-flex align-items-center ">
                <div class="text-black">Copyright &copy; <?php echo date("Y"); ?> Batoi | <a href="#" class="text-decoration-none text-black">Legal</a></div>
                <div class="d-md-flex justify-content-center ms-auto">
                    <div><a href="/" class="text-black text-decoration-none me-2 cust_foot_link ">Publishers</a></div>
                    <a href="/" class="text-black text-decoration-none me-2 cust_foot_link ">Help</a>
                    <a href="/" class="text-black text-decoration-none me-2 cust_foot_link ">About Batoi</a>
                    <a href="/" class="text-black text-decoration-none me-2 cust_foot_link ">Report an error</a>
                </div>
            </div>

        </div>

    </section>

</body>

</html>