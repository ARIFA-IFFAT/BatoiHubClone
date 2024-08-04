<?php
include 'header.php';
include 'config.php';
//get publisher from url

$publishername = isset($_GET['Publisher']) ? $_GET['Publisher'] : '';

//Pepare query statement
$stmt = $conn->prepare("SELECT Id, Title, Byline, Publisher, Author, Pub_date, image FROM e_book WHERE Publisher = ?");
//Bind the query parameter
$stmt->bind_param('s', $publishername);
//execute statement
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {

    $publisherDetails = $result->fetch_assoc();
} else {
    echo "No data found";
    exit;
}

$stmt->close();
$conn->close();

?>

<section id="publisherDetails " class="border-top border-bottom">
    <div class="container m-auto my-5 text-center ">
        <h1 class="mb-5 fs-1"><?php echo $publisherDetails['Publisher']; ?></h1>
        <div class="d-flex align-items-center justify-content-center gap-4">
            <button class="btn btn-md btn-primary"><i class="fa fa-user-plus me-2" aria-hidden="true"></i>Subscribe</button>
            <button class="btn btn-md btn-primary"><i class="fa fa-envelope me-2" aria-hidden="true"></i>contact</button>
        </div>
    </div>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4 col-lg-3 ">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active border-left border-right border-top" id="v-pills-english-tab" data-bs-toggle="pill" data-bs-target="#v-pills-english" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-book me-2" aria-hidden="true"></i>Book(English)</a>
                    <a class="nav-link border-left border-right border-top" id="v-pills-odia-tab" data-bs-toggle="pill" data-bs-target="#v-pills-odia" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa fa-book me-2" aria-hidden="true"></i>Book(Odia)</a>
                </div>
            </div>
            <div class="col-md-8 col-lg-9">

                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-english" role="tabpanel" aria-labelledby="v-pills-english-tab" tabindex="0"><?php include 'englishPublications.php' ; ?></div>
                    <div class="tab-pane fade" id="v-pills-odia" role="tabpanel" aria-labelledby="v-pills-odia-tab" tabindex="0">...profile</div>
                </div>
            </div>
        </div>
        
    </div>

</section>


<?php
include 'footer.php';

?>