<?php

include 'config.php';

// Get the offset and publisher from the request
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$publisherName = isset($_GET['publisher']) ? urldecode($_GET['publisher']) : '';

$cards = '';

// SQL query
$sql = "SELECT Id, Title, Byline, Publisher, Author, Pub_date, Image FROM e_book WHERE Language = 'Odia' AND Publisher = ? LIMIT 8 OFFSET ?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("si", $publisherName, $offset);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cards .= '
            <div class="col-6 col-md-6 col-lg-4 col-xl-3 mb-3">
                <div class="card h-100 p-2">
                    <a href="bookPublications.php?e_book=' . urlencode($row['Title']) . '"><img src="data:image/jpeg;base64,' . base64_encode($row['Image']) . '" class="card-img-top" alt="BookCoverPage"></a>
                    <div class="card-body text-center">
                        <a href="bookPublications.php?e_book=' . urlencode($row['Title']) . '" class="text-decoration-none"><h5 class="card-title fs-6">' . htmlspecialchars($row['Title']) . '</h5></a>
                        <p class="card-text">' . htmlspecialchars($row['Author']) . '</p>
                    </div>
                </div>
            </div>
        ';
    }
} else {
    $cards = '<p>No data found</p>';
}

$stmt->close();
$conn->close();

echo $cards;

?>
