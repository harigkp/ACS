            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Categories</h1>
                
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categories as $category) : ?>
                        <tr>
                            <td><?php echo $category->id; ?></td>
                            <td><?php echo $category->name; ?></td>
                            <td><?php echo $category->slug; ?></td>
                            <td>
                                <?php if($category->active) : ?>
                                    <button type="button" class="badge badge-success rounded-0 border-0 p-1">active</button>
                                <?php else: ?>
                                    <button type="button" class="badge badge-danger rounded-0 border-0 p-1">inactive</button>
                                <?php endif; ?>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    