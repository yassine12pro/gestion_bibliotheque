

<?php require 'header.php'; ?>
<main>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h3 class="text-center mb-4">Login</h3>

        <form action="submit_login.php" method="POST">
        
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
          <p class="text-center mt-3">
            <a href="register.php">Forget password ? </a>
          </p>
        </form>



      </div>
    </div>
  </div>
</main>

  <?php require 'footer.php'; ?>


