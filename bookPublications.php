<?php
include 'config.php';

//Working with e_user table
//get book title from the query parameter (from href/url)
$bookTitle = isset($_GET['e_book']) ? $_GET['e_book'] : '';

//prepare query
$stmt = $conn->prepare("SELECT Id, Title, Byline, Publisher, Author, Pub_Date, Image  FROM e_book WHERE Title = ?");
$stmt->bind_param("s", $bookTitle); //bind the query parameter
$stmt->execute(); //execute the query statement
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $bookDetails = $result->fetch_assoc(); // store data in associative array
} else {
    echo "No data found";
    exit;
}
$stmt->close();
$conn->close();
?>

<!-- include header file -->
<?php
include './header.php';
?>

<script>
    function rediractToCheckout() {
        var Product_Name = encodeURIComponent('<?php echo $bookDetails['Title']; ?>');
        var Author = encodeURIComponent('<?php echo $bookDetails['Author']; ?> ');
        var Publisher = encodeURIComponent('<?php echo $bookDetails['Publisher']; ?>');
        var price = encodeURIComponent('100.00');

        window.location.href = `checkout.php?Product_Name=${Product_Name}&Author=${Author}&Publisher=${Publisher}&price=${price}`;

        // window.location.href = "checkout.php?Product_Name=${Product_Name}&Publisher=${Publisher}&price= ${price}&Author=${Author}";
    }
</script>

<section class="border-top mt-3 pt-3">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h5><?php echo $bookDetails['Publisher']; ?></h5>
            <button class="btn btn-md btn-primary"><i class="fa fa-user-plus me-2" aria-hidden="true"></i>Subscribe</button>
        </div>
    </div>
</section>
<section class="mt-3 mb-3 pb-5 border-bottom border-top">
    <div class="container">

        <div class="row pt-5">
            <div class="col-md-4 col-lg-3 ">
                <img class="border border-2 border-body-tertiary shadow" src="data:image/jpeg;base64,<?php echo base64_encode($bookDetails['Image']); ?>" alt="Book_cover" />
            </div>
            <div class="col-md-8 col-lg-9 ps-5">
                <div class="d-flex align-items-centers">
                    <h1 class="text-black fs-1 fw-normal"><?php echo $bookDetails['Title']; ?></h1>
                    <div class="dropdown">
                        <button class="btn btn-md border-0 d-flex align-items-center text-primary" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-share-alt text-primary me-2" aria-hidden="true"></i>Share</button>
                        <ul class="dropdown-menu px-4 border-0 shadow">
                            <li class="text-primary py-3 border-bottom"><a href="/" class="text-decoration-none"><i class="fa fa-facebook me-2" aria-hidden="true"></i>Facebook</a></li>
                            <li class="text-primary py-3 border-bottom"><a href="/" class="text-decoration-none"><i class="fa fa-twitter me-2" aria-hidden="true"></i>Twitter</a></li>
                            <li class="text-primary py-3 border-bottom"><a href="/" class="text-decoration-none"><i class="fa fa-linkedin me-2" aria-hidden="true"></i>Linkedin</a></li>
                            <li class="text-primary py-3"><a href="/" class="text-decoration-none"><i class="fa fa-pinterest me-2" aria-hidden="true"></i>Pinterest</a></li>
                        </ul>
                    </div>
                </div>
                <p class="text-secondary fs-5 my-3"><?php echo $bookDetails['Byline'] ?></p>
                <div class="d-flex gap-5 align-items-center py-3 mb-3 border-bottom">
                    <p class="fs-6 text-black fw-bold">Publisher: <span class="text-primary ms-2"><?php echo $bookDetails['Publisher']; ?></span></p>
                    <p class="fs-6 text-black fw-bold">Author: <span class="text-primary ms-2"> <?php echo $bookDetails['Author']; ?></span></p>
                </div>
                <div class="card col-6 col-md-3 my-3 bg-secondary-subtle shadow border-1 border-secondary-subtle my-5">
                    <div class="card-body text-primary p-3">
                        <div class="pt-2">
                            <input class="me-3" type="radio" name="bookPDF" id="bookPDF" checked><i class="fa fa-file-text me-1" aria-hidden="true"></i><strong> Digital(PDF) </strong>
                        </div>
                        <div class="text-green py-2 text-center">
                            <strong>INR 100.00</strong>
                        </div>
                    </div>
                </div>
                <div class="border-bottom pb-3">
                    <!-- <a class="btn btn-primary btn-md px-5" href="/checkout.php"><i class="fa fa-external-link" aria-hidden="true"></i> Buy now</a> -->

                    <button class="btn btn-primary" onclick="rediractToCheckout()"><i class="fa fa-shopping-cart me-3" aria-hidden="true"></i>Buy now</button>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- include footer  -->
<?php
include './footer.php';
?>

</body>

</html>