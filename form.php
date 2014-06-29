<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>CHILD CARE</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>

<div class="container">
<!-- Forms================================================== -->
<section id="forms"  >
  <div class="page-header">
    <h2 style="text-align:center;">CHILD CARE</h2>
  </div>

  <div class="row"  >
    <div class="col-lg-8">
      <form action="upload_process.php" enctype="multipart/form-data" method="POST" class="form-horizontal well">
        <fieldset>
          <legend>Student Details</legend>
          <div class="control-group">
            <label class="control-label" for="input01">Username</label>
            <div class="controls">
              <input type="text" class="form-control input-xlarge username" name="username" value="username" id="input01">
              <!--<p class="help-block">In addition to freeform text, any HTML5 text-based input appears like so.</p>-->
            </div>
          </div>
<div class="control-group">
	<label class="control-label" for="optionsCheckbox">Gender</label>
	<div class="controls">
		<label class="checkbox">
			<input type="checkbox" id="optionsCheckbox" class="gender" name="gender" value="male">
			Male
			<br>
			<input type="checkbox" id="optionsCheckbox" class="gender" name="gender" value="female">
			Female
		</label>
	</div>
</div>
<div class="control-group">
	<label class="control-label" for="textarea">Address</label>
	<div class="controls">
		<textarea class="form-control input-xlarge" id="textarea" name="address" value="address" rows="3"></textarea>
	</div>
</div>

	<div class="control-group">
		<label class="control-label" for="input01">Gaurdian Name</label>
		<div class="controls">
			<input type="text" class="form-control input-xlarge username" name="gaurdian" value="gaurdian/parent" id="input01">
			<!--<p class="help-block">In addition to freeform text, any HTML5 text-based input appears like so.</p>-->
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="select01">Blood group</label>
		<div class="controls">
			<select name="blood_group" id="select01" class="form-control">
				<option value="b+ve">B +ve</option>
				<option value="b-ve">B -ve</option>
				<option value="a+ve">A +ve</option>
				<option value="a-ve">A -ve</option>
				<option value="o+ve">O +ve</option>
				<option value="o-ve">O -ve</option>
				<option value="ab+ve">AB +ve</option>
				<option value="ab-ve">AB -ve</option>
			</select>
		</div>
	</div>
        <!--  <div class="control-group">
            <label class="control-label" for="multiSelect">Multicon-select</label>
            <div class="controls">
              <select multiple="multiple" id="multiSelect" class="form-control">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
            </div>
          </div>-->
          <div class="control-group">
            <label class="control-label" for="fileInput">User Photo</label>
            <div class="controls">
              <input type="file"  name="my_file" >
            </div>
          </div>

						<div class="control-group">
							<label class="control-label" for="select01">Select School</label>
							<div class="controls">
								<select name="school" id="select01" class="form-control">
									<option value="1">School A</option>
									<option value="2">School B</option>
									<option value="3">School C</option>
									<option value="4">School D</option>
									<option value="5">School E</option>
								</select>
							</div>
						</div>

          <div class="control-group">
            <label class="control-label" for="textarea">Class Details</label>
            <div class="controls">
              <textarea class="form-control input-xlarge" id="textarea classdetails" name="class_details" rows="3"></textarea>
            </div>
          </div>
          <!--<div class="control-group">
            <label class="control-label" for="optionsCheckbox2">Disabled checkbox</label>
            <div class="controls">
              <label class="checkbox">
                <input type="checkbox" id="optionsCheckbox2" value="option1" disabled="">
                This is a disabled checkbox
              </label>
            </div>
          </div>
          <div class="control-group warning">
            <label class="control-label" for="inputWarning">Input with warning</label>
            <div class="controls">
              <input type="text" id="inputWarning" class="form-control">
              <span class="help-inline">Something may have gone wrong</span>
            </div>
          </div>-->
         <hr>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="reset" class="btn">Cancel</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>

</section>



</div>


	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>
