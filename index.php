<?php include "inc/header.php"; ?>

  <?php
    $name = $email = $body = '';
    $nameErr = $emailErr = $bodyErr = '';

    // If the form is submitted
    if (isset($_POST['submit'])) {
      
      // Validate name
      if(empty($_POST['name'])) {
        $nameErr = 'Name is a required Field! <br>';
      } else {
        $name = filter_input(INPUT_POST, 'name', 
        FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
      // Validate email
      if(empty($_POST['email'])) {
        $emailErr = 'Email is a required Field! <br>';
      } else {
        $email = filter_input(INPUT_POST, 'email', 
        FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
      // Validate body
      if(empty($_POST['body'])) {
        $bodyErr = 'Body is a required Field! <br>';
      } else {
        $body = filter_input(INPUT_POST, 'body', 
        FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
    }

    // Check if there are no errors
    if (empty($nameErr) && empty($bodyErr) && empty($emailErr) && isset($_POST['submit'])) {
      // Add to the data
      $sql = 
      "
      INSERT INTO feedback (name,email,body) VALUES ('$name', '$email', '$body')
      ";
      if (mysqli_query($conn, $sql)) {
        // success
        header('Location: feedback.php');
      } else {
        echo 'Error' . mysqli_error($conn);
      }
    }
  ?>
  <img src="img/edu.jpg" class="w-25 mb-3" alt="">
  <h2>Feedback</h2>
  <p class="lead text-center">Leave feedback</p>
  <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method = "POST" class="mt-4 w-75">
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null;?>" id="name" name="name" placeholder="Enter your name">
      <div class = "invalid-feedback">
        <?php echo $nameErr; ?>
      </div>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null;?>" id="email" name="email" placeholder="Enter your email">
      <div class = "invalid-feedback">
        <?php echo $emailErr; ?>
      </div>
    </div>
    <div class="mb-3">
      <label for="body" class="form-label">Feedback</label>
      <textarea class="form-control <?php echo $bodyErr ? 'is-invalid' : null;?>" id="body" name="body" placeholder="Enter your feedback"></textarea>
      <div class = "invalid-feedback">
        <?php echo $bodyErr; ?>
      </div>
    </div>
    <div class="mb-3">
      <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
    </div>
  </form>
<?php include "inc/footer.php"; ?>
