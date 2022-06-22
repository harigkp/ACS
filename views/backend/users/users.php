        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
          <h1 class="h2">Dashboard</h1>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Active</th>
                <th>Email Verified At</th>
              </tr>
            </thead>
            <tbody>
              <?php
			  $i=1;
			  foreach(\App\Models\User::all() as $user) : ?>
              <tr>
                <td><?=$i; ?></td>
                <td><?= $user->name; ?></td>
                <td><?= $user->email; ?></td>
                <td><?=$foo = $user->active ? "Yes" : "No";?></td>
                <td><?= $user->email_verified_at; ?></td>
              </tr>
              <?php $i++; endforeach; ?>
            </tbody>
          </table>
        </div>