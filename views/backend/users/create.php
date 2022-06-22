<?php backendpartials('header'); ?>

<div class="container-fluid">
    <div class="row">

        <?php backendpartials('sidebar'); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Create users</h1>
                <div class="mb-2 mb-md-0">
                    <a href="/dashboard/products" class="btn btn-sm btn-outline-secondary rounded-0">Back</a>
                </div>
            </div>

            <?php partials('notifications'); ?>
            <?php backendpartials('validator'); ?>

            <form action="/dashboard/uregister" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">User Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control rounded-0">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">E-Mail</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control rounded-0">
                    </div>
                </div>				
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" name="password" class="form-control rounded-0">
                    </div>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">User Type</label>
                    <div class="col-sm-10">
                           <select name="utype" class="form-control rounded-0">
                                <option value="0">Customer</option>
								<option value="1">Admin</option>
                        </select>
                    </div>
                </div>    				
                <div class="form-group row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary rounded-0">Create</button>
                    </div>
                </div>
            </form>

        </main>
    </div>
</div>

<?php backendpartials('footer'); ?>