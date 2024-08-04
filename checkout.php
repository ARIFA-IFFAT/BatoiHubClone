<style>
    <?php
    include './css/checkout.css';
    ?>
</style>

<?php

include 'header.php';
include 'config.php';
//css


// Get product details from the URL
$productName = isset($_GET['Product_Name']) ? htmlspecialchars($_GET['Product_Name']) : (isset($_POST['Product_Name']) ? htmlspecialchars($_POST['Product_Name']) : '');
$author = isset($_GET['Author']) ? htmlspecialchars($_GET['Author']) : (isset($_POST['Author']) ? htmlspecialchars($_POST['Author']) : '');
$publisher = isset($_GET['Publisher']) ? htmlspecialchars($_GET['Publisher']) : (isset($_POST['Publisher']) ? htmlspecialchars($_POST['Publisher']) : '');
$price = isset($_GET['Price']) ? htmlspecialchars($_GET['Price']) : (isset($_POST['Price']) ? htmlspecialchars($_POST['Price']) : '');

// Initialize variables
$name = $email = $phone = "";
$nameErr = $emailErr = $phoneErr = "";
$thankyouMsg = "";

// Form validation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        $nameErr = "Full name is required.";
    } else {
        $name = testInput($_POST['name']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and whitespaces allowed.";
        }
    }

    if (empty($_POST['email'])) {
        $emailErr = "Email is required.";
    } else {
        $email = testInput($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = 'Invalid email format.';
        }
    }

    if (empty($_POST['phone'])) {
        $phoneErr = "Mobile is required.";
    } else {
        $phone = testInput($_POST['phone']);
        $numPattern = '/^[0-9]{10}$/';
        if (!preg_match($numPattern, $phone)) {
            $phoneErr = "Invalid mobile number.";
        }
    }

    if (empty($nameErr) && empty($emailErr) && empty($phoneErr)) {
        $thankyouMsg = "
            <div class='alert alert-primary' role='alert'>
                <h4 class='alert-heading'>Order Placed</h4>
                <p>Thank you, <strong>$name</strong>. Your order has been placed and a confirmation email will be sent to <strong>$email</strong>.</p>
                <hr>
                <p class='mb-0'>We will contact you at <strong>$phone</strong>.</p>
            </div>
        ";
    }
}

function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<section id="checkoutSection" class="border-top border-bottom my-3 py-3">
    <div class="container mb-5 ">
        <a href="/bookPublications.php?e_book=<?php echo urlencode($productName); ?>" class="text-decoration-none fs-6"><i class="fa fa-chevron-left me-2" aria-hidden="true"></i>Back</a>
        <h1 class="my-5 fs-1 text-secondary">Checkout</h1>

        <div class="row">
            <div class="col-6">
                <h3 class="my-5 fs-3">Product details</h3>
                <p class="text-secondary fw-semibold fs-6">Product name: <?php echo $productName; ?></p>
                <p class="text-secondary fw-semibold fs-6">Author: <?php echo $author; ?></p>
                <p class="text-secondary fw-semibold fs-6">Publisher: <?php echo $publisher; ?></p>
                <p class="text-secondary fw-semibold fs-6">Price: <?php echo $price; ?></p>
                <div class="my-5 pe-5">
                    <?php if (!empty($thankyouMsg)) { ?>
                        <div>
                            <?php echo $thankyouMsg;  ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-6 border border-1 shadow border-secondary-subtle rounded">

                <h3 class="text-center mt-5 fs-3">Fill your details and place your order.</h3>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="checkoutForm" class="my-3 p-3">
                    <!-- Hidden fields to retain product details -->
                    <input type="hidden" name="Product_Name" value="<?php echo $productName ?>">
                    <input type="hidden" name="Author" value="<?php echo $author ?>">
                    <input type="hidden" name="Publisher" value="<?php echo $publisher ?>">
                    <input type="hidden" name="Price" value="<?php echo $price ?>">

                    <div class=" p-4 m-auto ">
                        <h6 class="border-bottom py-3 mb-3">Shipping details:</h6>
                        <div class="form_Grp py-2 d-flex gap-5">
                            <label for="name" class="w-25">Full name</label>
                            <input type="text" id="name" name="name" required class="checkoutInp border border-top-0 border-start-0 border-end-0 border-secondary-subtle w-100 p-1 text-secondary">
                            <span class="text-red"><?php echo $nameErr; ?></span>
                        </div>
                        <div class="form_Grp py-2 d-flex gap-5">
                            <label for="email" class="w-25">Email</label>
                            <input type="email" id="email" name="email" required class="checkoutInp border border-top-0 border-start-0 border-end-0 border-secondary-subtle w-100 p-1 text-secondary">
                            <span class="text-red"><?php echo $emailErr; ?></span>
                        </div>
                        <div class="form_Grp py-2 d-flex gap-5">
                            <label for="phone" class="w-25">Mobile</label>
                            <input type="text" id="phone" name="phone" required class="checkoutInp border border-top-0 border-start-0 border-end-0 border-secondary-subtle w-100 p-1 text-secondary">
                            <span class="text-red"><?php echo $phoneErr; ?></span>
                        </div>
                        <h6 class="border-bottom py-3 my-3">Payment options:</h6>
                        <div class="form_Grp py-2 d-flex gap-5">
                            <input type="radio" name="Onlinepay" id="Onlinepay" checked>
                            <label for="Onlinepay">Online</label>
                        </div>
                        <div class="form_Grp py-2 d-flex gap-5 mt-3">
                            <!-- <input type="submit" value="Place order" name="placeOrder" class="px-3 py-2 rounded btn btn-primary"> -->
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#paymentModal"><i class="fa fa-paper-plane me-2" aria-hidden="true"></i>Pay now</button>
                        </div>
                        <!-- Payment Modal -->
                        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Order details</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex align-items-center justify-content-evenly">
                                            <img src="./img/MasterCard_Logo.svg.png" alt="paycards" class="w-25 h-50" />
                                            <img src="./img/razorpaLogo.jpeg" alt="paycards" class="w-25 h-50" />
                                            <img src="./img/N4tFtfjN_400x400.png" alt="paycards" class="w-25 h-50" />
                                        </div>
                                        <div class="my-3">
                                            <p class="py-2">Item: <?php echo $productName ; ?></p>
                                            <p class="py-2">Price: <?php echo $price ; ?></p>
                                            <p class="py-2">Payment mode: Online</p>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Place order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>