<!-- Modal -->
<div class="modal fade" id="logModel" tabindex="-1" aria-labelledby="logModelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="logModelLabel">User Login</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="functions.php" method="post">
      <div class="modal-body">

      <!-- Reg Form -->

        <div class="form-group col-md-12 mt-2">
          <label>Email</label>
          <input type="email" name="email" class="form-control"  placeholder="Email" required>
        </div>
        <div class="form-group col-md-12 mt-2">
          <label for="inputPassword4">Password</label>
          <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password" required>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="logUser" class="btn btn-primary">Login</button>
      </div>

      </form>
    </div>
  </div>
</div>