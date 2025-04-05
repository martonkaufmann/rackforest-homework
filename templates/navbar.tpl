<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/users/list">Rackforest</a>
    <section>
        <a href="/users/list">Users</a>
        <a href="/posts/list">Posts</a>
    </section>
    <section class="d-flex">
    <form action="/auth/logout" method="POST">
      <button class="btn btn-outline-success" type="submit">Logout</button>
    </form>
    </section>
  </div>
</nav>
