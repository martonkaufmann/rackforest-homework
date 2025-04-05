{extends file='layout.tpl'}
{block name=body}
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>User Details</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{$user->id}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{$user->email}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{$user->createdAt|date_format:"%Y-%m-%d %H:%M:%S"}</td>
                </tr>
                <tr>
                    <th>Deleted At</th>
                    <td>{if $user->deletedAt}{$user->deletedAt|date_format:"%Y-%m-%d %H:%M:%S"}{else}N/A{/if}</td>
                </tr>
                <tr>
                    <th>Is Active</th>
                    <td>
                      {if $user->isActive === false}
                        <span class="badge bg-danger">&#10007;</span>
                      {else}
                        <span class="badge bg-success">&#x2713;</span>
                      {/if}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
{/block}

