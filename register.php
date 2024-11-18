<?php require 'header.php'; ?>
 
<main>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h3 class="text-center mb-4">Register</h3>

        <form action="submit_register.php" method="POST">
        
            <div class="mb-3">
              <label for="nom" class="form-label">Name</label>
              <input type="text" class="form-control" name="nom" id="nom" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <p class="text-center mt-3">
              Already have an account? <a href="login.php">Login here</a>
            </p>
        </form>


      </div>
    </div>
  </div>
</main>


  <?php require 'footer.php'; ?>
