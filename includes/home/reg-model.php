<!-- Modal -->
<div class="modal fade" id="regModel" tabindex="-1" aria-labelledby="regModelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="regModelLabel">User Registration</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="functions.php" method="post">
      <div class="modal-body">

      <!-- Reg Form -->

      <div class="form-group col-md-12 mt-2">
          <label for="inputEmail4">User Name</label>
          <input type="text" name="name" class="form-control" id="inputEmail4" placeholder="User Name" required>
        </div>
        <div class="form-group col-md-12 mt-2">
          <label>Email</label>
          <input type="email" name="email" class="form-control"  placeholder="Email" required>
        </div>
        <div class="form-group col-md-12 mt-2">
          <label for="inputPassword4">Password</label>
          <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password" required>
        </div>
        <div class="form-group col-md-12 mt-2">
          <label for="inputPassword4">City</label>
          <input type="text" name="city" class="form-control" id="inputPassword4" placeholder="City" required>
        </div>
        <div class="form-group col-md-12 mt-2">
          <label for="inputPassword4">Address</label>
          <textarea type="text" name="address" class="form-control" id="inputPassword4" placeholder="Address" required></textarea>
        </div>
       


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="reguser" class="btn btn-primary">Save changes</button>
      </div>

      </form>
    </div>
  </div>
</div>