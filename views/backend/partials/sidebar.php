<?php /* echo "<pre>";
print_r($_SESSION) */
$hide = '';
if($_SESSION['admin']==0){	
$hide = 'style="display:none"';	
}
?>

<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            
			<li class="nav-item" <?php echo $hide;?>>
                <a class="nav-link active" id="dash" href="javascript:void(0);"  onclick="return dashboard('dash');">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ord" href="javascript:void(0);"  onclick="return orders('ord');">
                    <span data-feather="file"></span>
                    Orders
                </a>
            </li>
            <li class="nav-item" <?php echo $hide;?>>
                <a class="nav-link" id="cat" href="javascript:void(0);" onclick="return category('cat');">
                    <span data-feather="layers"></span>
                    Categories
                </a>
            </li>
            <li class="nav-item" <?php echo $hide;?>>
                <a class="nav-link" id="pro" href="javascript:void(0);"  onclick="return product('pro');">
                    <span data-feather="shopping-cart"></span>
                    Products
                </a>
            </li>
			<ul>
			   <li class="nav-item" <?php echo $hide;?>>
                <a class="nav-link" id="proc" href="javascript:void(0);"  onclick="return product_create('proc');">
                    <span data-feather="database"></span>
                    Create Products
                </a>
            </li>
			</ul>
			
			<li class="nav-item">
                <a class="nav-link" href="http://<?php echo $_SERVER['HTTP_HOST']?>">
                    <span data-feather="users"></span>
                    Website
                </a>
            </li>

        </ul>

    </div>
</nav>