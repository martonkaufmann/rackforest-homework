{extends file='layout.tpl'}
{block name=body}
<div class="container mt-5">
  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="text-center">User List</h3>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Active</th>
                <th>Deleted</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {if isset($users) && count($users) > 0}
                {foreach $users as $user}
                  <tr>
                    <td>{$user->id}</td>
                    <td>{$user->email}</td>
                    <td>{$user->createdAt|date_format:"%Y-%m-%d"}</td>
                    <td>
                      {if $user->isActive === false}
                        <span class="badge bg-danger">&#10007;</span>
                      {else}
                        <span class="badge bg-success">&#x2713;</span>
                      {/if}
                    </td>
                    <td>
                      {if $user->deletedAt !== ''}
                        <span class="badge bg-danger">&#10007;</span>
                      {else}
                        <span class="badge bg-success">&#x2713;</span>
                      {/if}
                    </td>
                    <td>
                      <a href="/users/view/{$user->id}" class="btn btn-sm btn-info">
                        View
                      </a>
                      <a href="/users/edit/{$user->id}" class="btn btn-sm btn-primary">
                        Edit
                      </a>
                      <form method="POST" action="/users/delete">
                        <input type="hidden" value="{$user->id}" name="user" />
                          <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">
                            Delete
                          </button>
                      </form>
                    </td>
                  </tr>
                {/foreach}
              {else}
                <tr>
                  <td colspan="6" class="text-center">No users found</td>
                </tr>
              {/if}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
{/block}

