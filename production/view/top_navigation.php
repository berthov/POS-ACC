<!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/user.png" alt=""><?php echo($user_check); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Billing</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Email Notification</a></li>
                    <li><a href="controller/dologout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
<!-- INI UNTUK NOTIFICATION NANTI PAKE QUERY AJA -->
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-green">
                    
                    <?php

                        $sql = "SELECT 
                          (SELECT
                          COUNT(description) as description
                          FROM 
                          inventory i
                          where 
                          ledger_id = '".$ledger_new."'
                          and qty <= min 
                          and status = 'Active'
                          ) +
                          (SELECT 
                          COUNT(invoice_number)
                          from invoice_header ih
                          where
                          ih.ledger_id = '".$ledger_new."'
                          and ih.outstanding_status not like 'Paid'
                          and datediff(date_format(sysdate(),'%Y-%m-%d'),due_date) <= 4) as count
                          FROM DUAL
                          ";

                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                        echo $row['count'];
                        }
                    ?>
                    

                    </span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    
                    <?php
                        $sql = "SELECT concat(description, ' : Quantity below Minimum') as description
                          FROM 
                          inventory i
                          where 
                          ledger_id = '".$ledger_new."'
                          and qty <= min 
                          and status = 'Active'
                          UNION All
                          select concat('Invoice Number : ',invoice_number)
                          from invoice_header ih
                          where
                          ih.ledger_id = '".$ledger_new."'
                          and ih.outstanding_status not like 'Paid'
                          and datediff(date_format(sysdate(),'%Y-%m-%d'),due_date) <= 4
                          LIMIT 5
                          ";

                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                    ?>
                    
                    <li>
                      <a>
                        <span class="image"><img src="images/user.png" alt="Profile Image" /></span>
                        <span>
                          <span><?php echo ($user_check); ?></span>
                        </span>
                        <span class="message">
                          <h6><b><?php echo $row['description'];?></b></h6>
                        </span>
                      </a>
                    </li>
                    
                    <?php
                    
                    }
                    
                    ?>

                    <li>
                      <div class="text-center">
                      <a data-target=".bs-example-modal-sm1" data-toggle="modal" >
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        
          <!--Modal -->
          <div id="modal" class="modal fade bs-example-modal-sm1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">

                  <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">All Alert</h4>
                  </div>

                  <div class="modal-body">
                    <div class="form-group">
                      <div>
                    
                    <?php
                        $sql = "SELECT concat(description, ' : Quantity below Minimum') as description
                          FROM 
                          inventory i
                          where 
                          ledger_id = '".$ledger_new."'
                          and qty <= min 
                          and status = 'Active'
                          UNION All
                          select concat('Invoice Number : ',invoice_number)
                          from invoice_header ih
                          where
                          ih.ledger_id = '".$ledger_new."'
                          and ih.outstanding_status not like 'Paid'
                          and datediff(date_format(sysdate(),'%Y-%m-%d'),due_date) <= 4
                          LIMIT 5
                          ";

                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                    ?>
                    
                      <div class="text-right">
                        
                          <h6><b><?php echo $row['description'];?></b></h6>
                        
                      </div>
                    
                    <?php
                    
                    }
                    
                    ?>
                      
                      </div>
                    </div>
                  </div>
                  <p></p>
              </div>
            </div>
          </div>
        <!--Modal -->

        </div>
<!-- /top navigation -->