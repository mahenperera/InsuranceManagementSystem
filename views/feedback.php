<!DOCTYPE html>
<html>

<head>
    <title>Feedback</title>
    <link rel="stylesheet" href="../asserts/css/feedback-styles.css">
    <link rel="stylesheet" type="text/css" href="../asserts/css/style-nav-h.css">
        <link rel="stylesheet" type="text/css" href="../asserts/css/footer-new.css">

</head>

<?php
include ('../partials/nav-bar-h.php');
include("../services/feedback-services.php");

if (isset($_POST['fb-submit'])) {

    $rate = $_POST['rating'];
    $des = $_POST['fb_note'];
    // $nic = $_POST['']; TODO: get the element 

    addFeedback($rate, $des);

    // echo $rate;
    // var_dump($_POST['fb_note']);

    // TODO: Debug this logic
    // if (
    //     !empty($vehicleNo) ||
    //     !empty($vehiclePhotos) ||
    //     !empty($date) ||
    //     !empty($grade)
    // ) {
    //     addClams($vehicleNo, $vehiclePhotos, $date, $grade);
    // }
}


?>

<body>
    <div class="maincontainer">
    
    <div class="container">
        <div class="headings">
            <h3 class="heading2">Dear Customer</h3>
            <h1 class="heading2">We Are Like To Hear</h1>
            <h1 class="heading2">From You!</h1>
            <h4 class="heading2">Rate Us.</h4>
        </div>
        <div class="formSection">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <div class="stars" onclick="selectStars(1)"></div>
                <div class="stars" onclick="selectStars(2)"></div>
                <div class="stars" onclick="selectStars(3)"></div>
                <div class="stars" onclick="selectStars(4)"></div>
                <div class="stars" onclick="selectStars(5)"></div>
                <input type="hidden" name="rating" id="ratingInput">
                <div class="fbText">
                    <textarea name="fb_note" id="fb_note" rows="6" cols="50"></textarea>
                </div>
                <button type="submit" name="fb-submit">Submit</button>
            </form>
        </div>
    </div>
    </div>
    <script src="../asserts/js/feedback.js"></script>
    

    <?php include '../partials/footer-new.php' ?>
</body>

</html>