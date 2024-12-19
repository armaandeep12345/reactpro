<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Main CSS File -->
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
    form {
      max-width: 600px;
      margin: 0 auto;
      padding: 30px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #333;
    }

    input, textarea {
      width: 95%;
      padding: 12px;
      border: 2px solid #ddd;
      border-radius: 6px;
      font-size: 16px;
      transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    input:focus, textarea:focus {
      border-color: #007BFF;
      box-shadow: 0 0 12px rgba(0, 123, 255, 0.4);
      outline: none;
    }

    button {
      width: 100%;
      padding: 14px;
      background-color:  #ff6600;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }

    button:hover {
      background-color:  #ff6600;
    }

    textarea {
      height: 100px;
      resize: none;
    }

    ::placeholder {
      color: #aaa;
    }

    .icon-input {
      position: relative;
    }

    .icon-input::before {
      content: url('path-to-icon.svg');
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      color: #007BFF;
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
</header> <br> <br>
  <?php
    if (isset($_POST['sub'])) {
      $connection = new mysqli("localhost", "root", "", "react-first");

      if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
      }

      $name = trim($_POST['name']);
      $email = trim($_POST['email']);
      $subject = trim($_POST['subject']);
      $message = trim($_POST['message']);

      if (empty($name) || empty($email) || empty($subject) || empty($message)) {
          echo "<script>alert('All fields are required');</script>";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo "<script>alert('Invalid email format');</script>";
      } else {
          $stmt = $connection->prepare("INSERT INTO `contact` (name, email, subject, message) VALUES (?, ?, ?, ?)");
          $stmt->bind_param("ssss", $name, $email, $subject, $message);

          if ($stmt->execute()) {
              echo "<script>alert('Application submitted successfully');</script>";
          } else {
              echo "<script>alert('Error in submitting the application');</script>";
          }

          $stmt->close();
      }

      $connection->close();
    }
  ?>

  <form action="#" method="POST">
    <div class="form-group">
      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your full name" required>
    </div>

    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>
    </div>

    <div class="form-group">
      <label for="subject">Subject</label>
      <input type="text" id="subject" name="subject" placeholder="Enter the subject" required>
    </div>

    <div class="form-group">
      <label for="message">Message</label>
      <textarea id="message" name="message" placeholder="Type your message here..." required></textarea>
    </div>

    <button type="submit" name="sub">Send Message</button>
  </form>

</body>
</html>
