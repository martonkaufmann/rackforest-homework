{extends file='layout.tpl'}
{block name=body}
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="text-center">Login</h3>
        </div>
        <div class="card-body">
          {if isset($error)}
            <div class="alert alert-danger" role="alert">
              {$error}
            </div>
          {/if}
          <form action="/auth/authenticate" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
{/block}

