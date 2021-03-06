
<?php backendpartials('header'); ?>

<div class="container-fluid">
    <div class="row">

        <?php backendpartials('sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Brands</h1>
                <div class="mb-2 mb-md-0">
                    <a href="/dashboard/brands/create" class="btn btn-sm btn-outline-success rounded-0">Create</a>
                </div>
            </div>

            <?php partials('notifications'); ?>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Active</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($brands as $brand) : ?>
                        <tr>
                            <td><?php echo $brand->id; ?></td>
                            <td><?php echo $brand->name; ?></td>
                            <td><?php echo $brand->slug; ?></td>
                            <td>
                                <?php if($brand->active) : ?>
                                    <button type="button" class="badge badge-success rounded-0 border-0 p-1">active</button>
                                <?php else: ?>
                                    <button type="button" class="badge badge-danger rounded-0 border-0 p-1">inactive</button>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/dashboard/brands/edit/<?php echo $brand->id; ?>" class="btn btn-sm btn-warning rounded-0 text-white">
                                    <span data-feather="edit"></span>
                                </a>
                                <a href="/dashboard/brands/delete/<?php echo $brand->id; ?>" class="btn btn-sm btn-danger rounded-0" 
                                    onclick=" return confirm('Are you sure, you want to delete brand!');">
                                    <span data-feather="trash-2"></span>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php backendpartials('footer'); ?>