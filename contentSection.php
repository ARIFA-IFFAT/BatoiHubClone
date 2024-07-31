<style>
    <?php
    include './css/contentSection.css';
    ?>
</style>

<section class="py-5 border-bottom" id="contentSection">
    <div class="container">
        <div class="row">
            <!-- Latest Book -->
            <div class="col-md-7 col-lg-8">
                <div class="d-flex align-items-center">
                    <h1 class="text-secondary fs-1 cust_head_aft">Latest Publications</h1>
                    <a href="/allPublications.php" class="text-decoration-none fs-6 ms-auto">View all <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
                <div class="row mt-5">
                    <?php
                    include 'latestPublications.php';
                    ?>
                </div>
                <div class="text-center p-5">
                    <a href="/allPublications.php" class="btn btn-lg btn-outline-primary">View all <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <!-- Latest Posts -->
            <div class="col-md-5 col-lg-4 ps-md-3 ps-lg-4">
                <div class="d-flex align-items-center">
                    <h1 class="text-secondary fs-1 cust_head_aft">Latest Posts</h1>
                    <a class="text-decoration-none fs-6 ms-auto">View all <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>

    </div>
</section>