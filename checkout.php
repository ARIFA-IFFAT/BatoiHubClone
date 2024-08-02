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
$productName = isset($_GET['Product_Name']) ? htmlspecialchars($_GET['Product_Name']) : '';
$author = isset($_GET['Author']) ? htmlspecialchars($_GET['Author']) : '';
$publisher = isset($_GET['Publisher']) ? htmlspecialchars($_GET['Publisher']) : '';
$price = isset($_GET['Price']) ? htmlspecialchars($_GET['Price']) : '';

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
        $thankyouMsg = "<h1 >Order Placed</h1>";
        $thankyouMsg .= "<p>Thank you, $name. Your order has been placed and a confirmation email will be sent to $email.</p>";
        $thankyouMsg .= "<p>We will contact you at $phone.</p>";
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
        <a href="/" class="text-decoration-none fs-6 text-primary">Back</a>
        <h1 class="my-5 fs-1 text-secondary text-center">Checkout</h1>

        <div class="row">
            <div class="col-6">
                <h3 class="my-5 fs-3">Product details</h3>
                <p class="text-secondary fw-semibold fs-6">Product name: <?php echo $productName; ?></p>
                <p class="text-secondary fw-semibold fs-6">Author: <?php echo $author; ?></p>
                <p class="text-secondary fw-semibold fs-6">Publisher: <?php echo $publisher; ?></p>
                <p class="text-secondary fw-semibold fs-6">Price: <?php echo $price; ?></p>
            </div>
            <div class="col-6 border border-1 shadow border-secondary-subtle rounded">

                <h3 class="text-center mt-5 fs-3">Fill your details and place your order.</h3>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="checkoutForm" class="my-3 p-3">
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
                            <input type="submit" value="Place order" name="placeOrder" class="px-3 py-2 rounded btn btn-primary">
                        </div>
                    </div>
                </form>
                <div>
                    <?php if(!empty($thankyouMsg)){ ?>
                        <div class="my-3">
                           <?php echo $thankyouMsg ;  ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>