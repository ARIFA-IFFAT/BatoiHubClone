<?php

include 'config.php';

$publisherName = isset($_GET['Publisher'])? $_GET['Publisher'] : '' ;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

$cards = '';

//sql query
$sql = " SELECT Id, Title, Byline, Publisher, Author, Pub_date, Image FROM e_book WHERE Language = 'Odia' AND Publisher = ? LIMIT 8 OFFSET ? ";
$stmt= $conn->prepare($sql);
$stmt->bind_param('si', $publisherName, $offset);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cards .= '
            <div class="col-6 col-md-6 col-lg-4 col-xl-3 mb-3">
                <div class="card h-100 p-2">
                    <a href="bookPublications.php?e_book=' . $row['Title'] . '"><img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" class="card-img-top" alt="BookCoverPage"></a>
                    <div class="card-body text-center">
                        <a href=" bookPublications.php?e_book=' . $row['Title'] . '" class="text-decoration-none" ><h5 class="card-title fs-6">' . $row['Title'] . '</h5></a>
                        <p class="card-text">' . $row['Author'] . '</p>
                    </div>
                </div>
            </div>
        ';
    }
} else {
    $cards = "No data found";
}

$conn->close();

?>

<!-- Adding JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="container">
    <div class="row" id="book-cards">
        <?php echo $cards; ?>
    </div>
    <div class="row mt-5">
        <div class="text-center">
            <button class="btn btn-primary " id="loadMoreBtnOd"><i class="fa fa-arrow-down me-2" aria-hidden="true"></i>Load more</button>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
    var offset = 8; // initial offset
    var publisher = encodeURIComponent('<?php echo $publisherName; ?>');
    $('#loadMoreBtnOd').on('click', function(){
        $.ajax({
            url: 'load_more_od_books.php',
            type: 'GET',
            data: {
                offset: offset,
                publisher: publisher
            },
            success: function(data){
                $('#book-cards').append(data);
                offset += 8; // increase offset by the number of items loaded
            },
            error: function(){
                alert('Failed to load more books');
            }
        });
    });
});

</script>