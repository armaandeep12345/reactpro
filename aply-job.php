<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Apply for job opportunities through our online application form. Submit your details, upload your resume, and take the first step toward your new career.">
    <title>Job Application Form</title>
     <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Root Variables */
        :root {
            --background-color: #333333;
            --heading-color: #ffffff;
            --default-color: #000000;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #ff6600;
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .header {
            color: var(--default-color);
            background-color: var(--background-color);
            padding: 20px 0;
            z-index: 997;
        }
        .logo {
    display: flex;
    align-items: center;
    text-decoration: none;
}

.sitename {
    font-size: 24px;
    font-weight: bold;
    color: #333; /* Change this to your desired color */
    margin: 0; /* Remove default margin from the h1 */
}


        .header .logo h1 {
            font-size: 30px;
            margin: 0;
            font-weight: 700;
            color: var(--heading-color);
        }

        .navmenu ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 20px;
            margin-right:100px;
           
        }

        .navmenu ul li a {
            color: #ffffff;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: 700;
            transition: background-color 0.3s ease;

        }

        .navmenu ul li a:hover,
        .navmenu ul li a.active {
            background-color: #ff6600;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff; /* White background for the form */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            padding: 20px;
        }

        h2 {
            color: #ff6600; /* Orange color for heading */
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            margin-bottom: 0;
        }

        .table th, .table td {
            padding: 10px;
            vertical-align: middle;
            text-align: left;
        }

        .form-label {
            font-weight: bold;
            color: #555555; /* Dark grey text for labels */
        }

        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #cccccc; /* Light grey border */
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #ff6600; /* Orange border on focus */
        }

        .input-group-text {
            background-color: #ff6600; /* Orange background */
            color: #ffffff; /* White text */
            border: none;
        }

        .btn-warning {
            background-color: #ff6600; /* Orange button */
            border: none;
            color: #ffffff; /* White text */
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-warning:hover {
            background-color: #e65c00; /* Darker orange on hover */
        }

        .form-text {
            color: #888888; /* Light grey for helper text */
            font-size: 0.9em;
        }

        .table tr:hover {
            background-color: #f9f9f9; /* Light grey hover effect for rows */
        }

    </style>
</head>
<body>
<header id="header" class="header">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo">
            <h1 class="sitename">Alegal Announcement</h1>
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="live.html">Live Chat</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>
    <!-- Include header -->
    <?php include('header.php'); ?> 

    <br> <br> <br> <br> <br> <br>

    <?php
    if (isset($_POST['apply'])) {
        $connection = mysqli_connect("localhost", "root", "", "react-first");

        // Check database connection
        if (!$connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable error reporting for MySQLi

        // File upload handling
        $picName = $_FILES["pic"]["name"];
        $target_dir = "uploads/"; // Directory to store uploaded files
        $target_file = $target_dir . basename($picName);
        $uploadSuccess = false;

        // Check if a file is uploaded
        if (!empty($picName)) {
            if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
                $uploadSuccess = true;
            } else {
                echo "<script>alert('Error in uploading file');</script>";
                exit;
            }
        }

        // Sanitize and validate input
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $phone = mysqli_real_escape_string($connection, $_POST['phone']);
        $position = mysqli_real_escape_string($connection, $_POST['position']);
        $message = mysqli_real_escape_string($connection, $_POST['message']);

        // Insert data into the database
        $query = "INSERT INTO `aply-for-job` (name, email, phone, position, pic, message) 
                  VALUES ('$name', '$email', '$phone', '$position', '$picName', '$message')";

        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<script>alert('Application submitted successfully');</script>";
        } else {
            echo "<script>alert('Error in submitting the application');</script>";
        }

        // Close the database connection
        mysqli_close($connection);
    }
    ?>

    <div class="container mt-6">
        <form method="post" enctype="multipart/form-data">
            <h2 class="text-center mb-4">Job Application Form</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Field</th>
                        <th scope="col">Input</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Applicant Name -->
                    <tr>
                        <td><label for="applicantName" class="form-label">Name</label></td>
                        <td><input type="text" class="form-control" name="name" id="applicantName" placeholder="Enter your name" required></td>
                    </tr>
                    <!-- Email -->
                    <tr>
                        <td><label for="email" class="form-label">Email</label></td>
                        <td><input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required></td>
                    </tr>
                    <!-- Phone -->
                    <tr>
                        <td><label for="phone" class="form-label">Phone</label></td>
                        <td><input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" required></td>
                    </tr>
                    <!-- Position -->
                    <tr>
                        <td><label for="position" class="form-label">Position</label></td>
                        <td><input type="text" class="form-control" name="position" id="position" placeholder="Enter the position you are applying for" required></td>
                    </tr>
                    <!-- File Input for Picture -->
                    <tr>
                        <td><label for="pic" class="form-label">Picture</label></td>
                        <td>
                            <input type="file" class="form-control" name="pic" id="pic" required>
                            <div class="form-text">Upload your picture</div>
                        </td>
                    </tr>
                    <!-- Message -->
                    <tr>
                        <td><label for="message" class="form-label">Message</label></td>
                        <td>
                            <textarea class="form-control" name="message" id="message" rows="4" placeholder="Write a brief message or cover letter"></textarea>
                        </td>
                    </tr>
                    <!-- Submit Button -->
                    <tr>
                        <td colspan="2" class="text-center">
                            <button type="submit" name="apply" class="btn btn-warning w-100">Apply</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

   
</body>
</html>
