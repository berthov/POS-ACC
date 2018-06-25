<div class="container">
    <div class='col-lg-3 col-md-3 col-xs-6' style="float:right">
        <div class="form-group">
            <div class='input-group date'>
                <input type='text' class="form-control" autocomplete="off" name="reservation2" id="reservation2"
                 value="<?php 
                    if (isset($reservation2) && !empty($reservation2)){
                      echo $reservation2;
                    }
                    else {
                      echo date('m-d-Y');
                    }
                  ?>"
                />
                <span class="add-on input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-lg-3 col-md-3 col-xs-6' style="float:right">
        <div class="form-group">
            <div class='input-group date'>
                <input type='text' class="form-control" autocomplete="off" name="reservation" id="reservation" 
                value="<?php
                    if (isset($reservation) && !empty($reservation)){
                      echo $reservation;
                    }
                    else {
                      echo date('m-d-Y');
                    }
                  ?>"
                />
                <span class="add-on input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
</div>