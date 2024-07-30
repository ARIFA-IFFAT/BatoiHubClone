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

<?php
include 'config.php';

//get book title from the query parameter (from href/url)
$bookTitle = isset($_GET['e_book']) ? $_GET['e_book']: '';

//prepare query
$stmt = $conn->prepare("SELECT Id, Title, Byline, Publisher, Author, Pub_Date, Image  FROM e_book WHERE Title = ?");
$stmt->bind_param("s",$bookTitle); //bind the query parameter
$stmt->execute();//execute the query statement
$result = $stmt->get_result();

if($result->num_rows > 0){
    $bookDetails = $result->fetch_assoc();// store data in associative array
}else{
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

<section class="mt-5 mb-5 pt-5 pb-5 border-bottom border-top">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-4 col-lg-3 ">
                <img class="border border-2 border-body-tertiary shadow" src="data:image/jpeg;base64,<?php echo base64_encode($bookDetails['Image']); ?>" alt="Book_cover" />
            </div>
            <div class="col-6 col-md-8 col-lg-9 ps-5">
                <h1 class="text-secondary fs-1"><?php echo $bookDetails['Title'] ;?></h1>
                <p class="text-secondary fs-5 my-3"><?php echo $bookDetails['Byline'] ?></p>
                <div class="d-flex gap-5 align-items-center py-3 mb-3 border-bottom">
                    <p class="fs-6 text-black fw-bold">Publisher: <span class="text-primary ms-2"><?php echo $bookDetails['Publisher']; ?></span></p>
                    <p class="fs-6 text-black fw-bold">Author: <span class="text-primary ms-2"> <?php echo $bookDetails['Author'] ; ?></span></p>
                </div>
                <a class="btn btn-primary btn-md px-5" href="https://www.amazon.com/"><i class="fa fa-external-link" aria-hidden="true"></i> Storefront</a>
            </div>
        </div>
    </div>
</section>

<!-- include footer  -->
<?php 
    include './footer.php';
?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>