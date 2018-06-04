<!-- DATE PICKER -->
<div class="col-lg-9 col-md-9 col-xs-8">
  <fieldset >
    <div class="control-group" >
      <div class="controls" >
        <div class="input-prepend input-group">
          <input type="text" style="width: 200px" name="reservation" id="reservation" class="form-control pull-right"  
          value="<?php 
                if ($start_date = "" and $end_date =""){
                    echo date('m-d-Y'); echo" - "; date('m-d-Y');
                } else {
                    echo $reservation;
                }
              ?>" 
          />
          <span class="add-on input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>
  </fieldset>
</div>