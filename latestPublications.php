<style>
    <?php 
        include './css/latestPublications.css';
    
    ?>
</style>
<?php
include 'config.php';


// SQL query
$sql = "SELECT Id, Title, Author, Image FROM e_book";
$result = $conn->query($sql);

$cards = "";

// Check the number of rows in $result
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cards .= '<div class="col-6 col-md-6 col-lg-4 col-xl-3 mb-3">
                    <div class="card p-2 h-100">
                        <img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" class="card-img-top" alt="BookCoverPage">
                        <div class="card-body text-center">
                            <h5 class="card-title fs-6">' . $row['Title'] . '</h5>
                            <p class="card-text">' . $row['Author'] . '</p>
                        </div>
                    </div>
                   </div>';
    }
} else {
    $cards = "No result found.";
}

$conn->close();
?>

<div class="container">
    <div class="row">
        <?php echo $cards; ?>
    </div>
</div>