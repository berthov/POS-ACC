<?php
include("controller/session.php");
include("controller/doconnect.php");
?>

<!-- SIDE BAR -->
<div class="col-md-3 left_col menu_fixed">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>Bonne Journée!</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="images/user.png" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2> <?php echo($user_check); ?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->
    
    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a href="index.php"><i class="fa fa-home"></i> Dashboard </a>
          </li>
          <li><a><i class="fa fa-table"></i> Reports <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="sales_summary.php">Sales Summary</a></li>
              <li><a href="gross_profit.php">Gross Profit</a></li>
              <li><a href="payment_method.php">Payment Method</a></li>
              <li><a href="category_sales.php">Category Sales</a></li>
              <!-- <li><a href="reports.php">Reports</a></li> -->
            </ul>
          </li>
          <li><a><i class="fa fa-edit"></i> Forms <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="form_validation.php">Master Item Form</a></li>
              <li><a href="cogs.php">Cost of Goods Sold (COGS)</a></li>
              <!-- <li><a href="form.html">Invoice Form</a></li> -->
              <li><a href="form_po.php">Purchase Order Form</a></li>
              <li><a href="form_supplier.php">Form Supplier</a></li>
              <li><a href="recipe.php">Form Recipe</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-desktop"></i> Account Receivable <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <!-- <li><a href="projects.html">Projects</a></li> -->
              <!-- <li><a href="invoice.html">Invoice</a></li> -->
              <li><a href="media_gallery.php">Transaction</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="tables_dynamic.php">Table Inventory</a></li>
              <li><a href="tables_invoice.php">Table Invoice</a></li>
              <li><a href="table_cogs.php">Table COGS</a></li>
              <li><a href="po_summary.php">Table PO</a></li>   
              <li><a href="table_supplier.php">Table Supplier</a></li>             
            </ul>
          </li>
          <li><a><i class="fa fa-table"></i> Outlets Settings <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="outlets.php">Outlets</a></li>
              <li><a href="receipts.php">Receipt</a></li>
              <li><a href="employees.php">Employees</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <!-- sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
      </a>
      <a data-toggle="tooltip" data-placement="top" title="Logout" href="controller/dologout.php">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->

  </div>
</div>
<!-- END OF SIDE BAR -->