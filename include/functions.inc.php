<?php
function dbconnect(){
		$connection = mysql_connect('localhost','root','');
		if(!$connection){
		return false;
		}

		if(!mysql_select_db('rhok')){//if(!mysql_select_db('test')){
		return false;
		}
		return $connection;
	}

	/*
	Query Executor for display function and returns result in array
    $query - sql query [even multiple query works]
	*/
	function basic_display($query){
    	dbconnect();
		$result = mysql_query($query) or die("query failed ".mysql_error());
		$result = db_results($result);
		return $result;
	}

	/*
	Basic Display
	$table - Table Name
	$Order - Order by which field
	$by - ASC or DESC0
	*/
	function display($table,$order,$by){

		dbconnect();
		$query = "SELECT * FROM $table ORDER BY $table.$order $by";
		$result = mysql_query($query) or die("query failed ".mysql_error());
		$result = db_results($result);
		return $result;
	}

		function user_details($table1,$table2,$where){
		dbconnect();
		$query = "SELECT * FROM $table1 A,
		                        $table2 B
							    $where";  //echo $query;
		$result = mysql_query($query)or die("query failed ".mysql_error());
		$result = db_results($result);
        return $result;
		}

		function user_details1($table1,$table2,$table3,$where){
		dbconnect();
		$query = "SELECT * FROM $table1 A,
		                        $table2 B,
								$table3 C
							    $where"; 						//echo $query;						die();
		$result = mysql_query($query)or die("query failed ".mysql_error());
		$result = db_results($result);
        return $result;
		}

	/*
	Display selected
	Need to upgrade this function with count
	$table - Table Name
	$where - Where Query
	*/

		function display_selected($table,$where){
		dbconnect();
		$query = "SELECT * FROM $table $where"; //echo $query;
		$result = mysql_query($query)or die("query failed ".mysql_error());
		$result = db_results($result);
		return $result;
	}

	/*
	Result pop
	Required for display function
	*/
	function db_results($result){

		$res_array = array();
		for($count=0;$row = mysql_fetch_array($result);$count++)
			{
				$res_array[$count] = $row;
			}
		return $res_array;
	}

	/*
	Universal Insert System
	*/
	include("settings.php");
	function insert($info, $table) {
		dbconnect();
   		if (!is_array($info)) { die("insert failed, info must be an array"); }
      	$sql = "INSERT INTO ".$table." (";
      	for ($i=0; $i<count($info); $i++) {
     		$sql .= key($info);
     		if ($i < (count($info)-1)) {
        		$sql .= ", ";
     		} else $sql .= ") ";
        next($info);
     }
     reset($info);
     $sql .= "VALUES (";
     for ($j=0; $j<count($info); $j++) {
        $sql .= "'".current($info)."'";
        if ($j < (count($info)-1)) {
           $sql .= ", ";
        } else $sql .= ") ";
        next($info);
     }
    //echo $sql; die();
         //execute the query
     mysql_query($sql) or die("query failed ".mysql_error());
         return mysql_insert_id();
      }

	  /*
	  Basic update Function

	  */
	  	function update_simple($table,$data,$where) {
		 dbconnect();
		$query = "UPDATE $table SET $data $where";
		//$query = "UPDATE $table SET $data $where";
		 $result = mysql_query($query)or die("query failed ".mysql_error());
		//$result = db_results($result);
		return $result;
      }

	   /*
	  Basic delete Function

	  */

	  function delete_simple($table,$where) {
		 dbconnect();
		 $query = "DELETE FROM $table $where";
		 $result = mysql_query($query)or die("query failed ".mysql_error());
		//$result = db_results($result);
		return $result;
      }



					/*
					ACTION: Upload Files
					$filename = Passess the FILE ARRAY
					$uploaddir = DIRECTORY to upload the file
					$filter = To filter file type images, documents, videos, all
					*/
					function upload_simple_files($filename,$uploaddir,$filter){
					//FILE TYPES FILTER
							$ftype1 = array("png","jpg","jpeg","gif");
							$ftype2 = array("txt","doc","pdf","PDF","xml","xls","docx");
							$ftype3 = array("mp4","avi","mp3","3gb","fla","swf","flv");
							$ftype4 = array("png","jpg","jpeg","gif","txt","doc","pdf","PDF","xml","xls","docx","mp4","avi","mp3","3gb","fla","swf");

							//UPLOAD DIRECTORY TO BE PASSED
							$filelocation = $uploaddir;
							//print_r($filename[0]);

							//GRAB EXTENSION AND VALID THE FILTER MODE
							$extension = findexts($filename[0]['name']);
							$randomname = rand(0,99999999999999);
							$newfilename = $randomname.".".$extension;

                             //echo $uploaddir; print_r($filename); echo $newfilename;
							//FILTER VALIDATION
							if($filter == "images"){
								if(in_array($extension,$ftype1)){
											$flag = 1;
											}
											else
											{
											$flag = 0;
											}
							}
							else
							if($filter == "documents"){
								if(in_array($extension,$ftype2)){
											$flag = 1;
											}
											else
											{
											$flag = 0;
											}
							}
							else
							if($filter == "videos"){
								if(in_array($extension,$ftype3)){
											 $flag = 1;
											}
											else
											{
											$flag = 0;
											}

							}
							else
							if($filter == "all"){
								if(in_array($extension,$ftype4)){
											$flag = 1;
											}
											else
											{
											$flag = 0;
											}
							}
							else
							{
							$message = "FILTER MODE NOT SELECTED";
							return $message;
							}
							//echo $newfilename;
							//die();

							$target_path = $filelocation.$newfilename;
							if($flag==1){  //print_r($filename); echo "<br />$extension<br />$target_path<br />";
							if(move_uploaded_file($filename[0]['tmp_name'], $target_path)){
								//die();
								//echo $target_path; die();

								$message = $newfilename;
								return $message;
							}
							else
							{
								//echo $filename;
								//die();
							$error = "No File Selected";
							return $error;
							}
							}
							else
							{
							$message = "Invalid File type. Please upload supported file types";
							return $message;
							}

					}

					//TO FIND FILE EXTENSION
					function findexts ($filename) {
					$filename = strtolower($filename) ;
					$exts = @split("[/\\.]", $filename) ;
					$n = count($exts)-1;
					$exts = $exts[$n];
					return $exts;
					}


					/*
					Forgot Password and Reset Password
					*/
					function forgotpassword($table,$where){
							dbconnect();
							$query = "SELECT * FROM $table $where";
							echo $query;die();
							$result = mysql_query($query) or die("query failed ".mysql_error());
							//$result = db_results($result);
							$count=mysql_num_rows($result);
							if($count > 0){
							$value = mysql_fetch_array($result);
							$id = $value[0];
							$hashkey = rand(0,999999999);
							$info = array("id" => $id,"password" => $password);
							$table  = "user";
							$result1 = insert($info, $table);
							$newvalue = $result1;
							if(!$newvalue){
								$error = "ERROR";
							return $error;
							}
							else
							{
							$url = "resetpassword.php?id=".$hashkey;
							$header = "from forgotpassword@localhost";
							$to = $value['email'];
							$subject = "Lee City Is Mine - Reset Password";
							$message = "Please click here: http://ltr.22feet.in/".$url." to reset your password\r\n";
							$sendmail = mail($to,$subject,$message,$header);
							if(!sendmail){
							$error = "Sending Mail Failed";
							return $error;
							}
							else
							{
								$message = "Reset Password has been sent to your mail ID";
								return $message;

							}
							}
							}
							else
							{
							$error = "The E-Mail address doesnot exist in our database";
							return $error;
							}
						}


						/*
						To reset password. And delete hashkey
						*/
						function resetpassword($table,$hashkey,$data,$where){
							dbconnect();
							$query = "SELECT * FROM ltr_hash WHERE hashkey = $hashkey";
							$result = mysql_query($query) or die("query failed ".mysql_error());
							//$result = db_results($result);
							$count=mysql_num_rows($result);
							if($count > 0){
								$value = mysql_fetch_array($result);
								$id = $value[0];
								$uid = $value[1];
								$query = "UPDATE $table SET $data $where '".$uid."'";;
		 						$result = mysql_query($query)or die("query failed ".mysql_error());
								//$result = db_results($result);
								if(!$result){
								$error = "Unable to update the new password";
								return $error;
								}
								else
								{
									$table1  = "ltr_hash";
									$where1 = "WHERE id = ".$id;
									delete_simple($table1,$where1);
								    $message = "Your New password is updated. Please login with the new password Click here: http://ltr.22feet.in/index.php";
								    return $message;
								}
							}
							else
							{
								    $error = "Invalid Reset Code";
								    return $error;
							}
						}

						/*
						COUNT USERS ONLINE
						*/
						function users_online(){

						}




						/*
						Basic Display with paginaton
						$table - Table Name
						$Order - Order by which field
						$by - ASC or DESC
						*/
						function display_pagination($table,$order,$by,$perpage,$startpage,$page,$sel = "*",$where="",$ord_table = null){
							dbconnect();
							$startpoint = ($page * $perpage) - $perpage;
							if($ord_table == null)
							{
								$ord_table = $table;
							}
							$query = "SELECT $sel FROM $table $where ORDER BY $ord_table.$order $by LIMIT $startpoint,$perpage";
							$result = mysql_query($query) or die("query failed ".mysql_error());
							$result = db_results($result);
							return $result;
						}
//special pagination :)

						function display_pagination2($table,$order,$by,$perpage,$startpage,$page,$sel = "*",$where="",$ord_table = null){
							dbconnect();
							$startpoint = ($page * $perpage) - $perpage;
							if($ord_table == null)
							{
								$ord_table = $table;
							}
							$query = "SELECT u.name,u.id as id,u.username,u.email,u.status as ustatus,u.city,count(p.id)as count,p.id as pid,p.user_id,p.small_image FROM `photos` AS p,user AS u WHERE p.user_id=u.id    GROUP  by p.user_id ORDER by p.created_date DESC";
							$result = mysql_query($query) or die("query failed ".mysql_error());
							$result = db_results($result);
							return $result;
						}

						/*
						PAGINATION SYSTEM (SIMPLE PAGINATION)
						$table = $table name
						$limit = how many rows to show
						$pagepath = the link for navigation
						$style = style code for pagination. Only master style code needs to be changed
						*/

						function pagination($tbl_name,$limit,$path,$style)
						{
							$query = "SELECT COUNT(*) as num FROM $tbl_name";
							$total_pages = mysql_fetch_array(mysql_query($query));
							$total_pages = $total_pages['num'];
							$adjacents = "2";
							$page = @$_GET['page'];
							if($page)
							$start = ($page - 1) * $limit;
							else
							$start = 0;

							$sql = "SELECT id FROM $tbl_name LIMIT $start, $limit";
							$result = mysql_query($sql);

								if ($page == 0) $page = 1;
								$prev = $page - 1;
								$next = $page + 1;
								//$lastpage = ceil($total_pages/$limit);
								$lpm1 = $lastpage - 1;

								$pagination = "";
							if($lastpage > 1)
							{
								$pagination .= "<div class='".$style."' style='display: block;' >";
							if ($page > 1)
								$pagination.= "<a href='".$path."page=$prev'>previous</a>";
							else
								$pagination.= "<a href class='disabled'>previous</span>";

							if ($lastpage < 7 + ($adjacents * 2))
							{
							for ($counter = 1; $counter <= $lastpage; $counter++)
							{
							if ($counter == $page)
								$pagination.= "<a href='' class='active'>$counter</a>";
							else
								$pagination.= "<a href='".$path."page=$counter'>$counter</a>";
							}
							}
							elseif($lastpage > 5 + ($adjacents * 2))
							{
							if($page < 1 + ($adjacents * 2))
							{
							for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
							{
							if ($counter == $page)
								$pagination.= "<a href='' class='active'>$counter</a>";
							else
								$pagination.= "<a href='".$path."page=$counter'>$counter</a>";
							}
								$pagination.= "<a href=''>...</a>";
								$pagination.= "<a href='".$path."page=$lpm1'>$lpm1</a>";
								$pagination.= "<a href='".$path."page=$lastpage'>$lastpage</a>";
							}
							elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
							{
								$pagination.= "<a href='".$path."page=1'>1</a>";
								$pagination.= "<a href='".$path."page=2'>2</a>";
								$pagination.= "<a href=''>...</a>";
							for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
							{
							if ($counter == $page)
								$pagination.= "<a href='' class='active'>$counter</a>";
							else
								$pagination.= "<a href='".$path."page=$counter'>$counter</a>";
							}
								$pagination.= "<a href=''>..</a>";
								$pagination.= "<a href='".$path."page=$lpm1'>$lpm1</a>";
								$pagination.= "<a href='".$path."page=$lastpage'>$lastpage</a>";
							}
							else
							{
								$pagination.= "<a href='".$path."page=1'>1</a>";
								$pagination.= "<a href='".$path."page=2'>2</a>";
								$pagination.= "<a href=''>..</a>";
							for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
							{
							if ($counter == $page)
								$pagination.= "<a href='' class='active'>$counter</a>";
							else
								$pagination.= "<a href='".$path."page=$counter'>$counter</a>";
							}
							}
							}

							if ($page < $counter - 1)
								$pagination.= "<a href='".$path."page=$next'>next</a>";
							else
								$pagination.= "<a href='' class=''>next</a>";

							}

							$pagination.= "</div>";
							return $pagination;
						}


 //function to remove sql injection
 function escape_data($data){
 	$data= stripslashes($data);
 	$data=   htmlentities($data);
 	$data=    html_entity_decode($data);
 	return $data;
 }


 //pagination
 function custom_pagination($tbl_name,$where,$limit,$path,$style){

		$query = "SELECT COUNT(*) as num FROM $tbl_name $where";
		$total_pages = mysql_fetch_array(mysql_query($query));
		$total_pages = $total_pages['num'];
		$adjacents = "2";

		$page = @$_GET['page'];

		if($page)

		  $start = ($page - 1) * $limit;

		else

		  $start = 0;

		$sql = "SELECT id FROM $tbl_name $where LIMIT $start, $limit";

		$result = mysql_query($sql);



		if ($page == 0) $page = 1;

		 $prev = $page - 1;

		 $next = $page + 1;

		 $lastpage = ceil($total_pages/$limit);

		 $lpm1 = $lastpage - 1;

		 $pagination = "";

		 if($lastpage > 1){

			$pagination .= "<div class='".$style."'>";

		    if ($page > 1)

				 $pagination.= "<a href='".$path."page=$prev' class='buttonPrev'>Prev Page</a>";

			else

				 $pagination.= "<span  class='buttonPrev'>Prev Page</span>";



          //dropdown with page numbers.

		  $pagination .= " <select name='pageno1' id='pageno1' onchange=\"javascript:var x= '".$path."page='+document.getElementById('pageno1').value;window.location= x;\" >";

		  for ($counter = 1; $counter <= $lastpage; $counter++){

				$pagination .= "<option";

			     if($page==$counter){

			       $pagination .= " selected='selected' ";

			     }

				$pagination .=">";

				$pagination .= $counter."</option>";

		  }

		  $pagination = $pagination."</select> ";

		  //end of pagenumber

		if ($page < $lastpage)

					$pagination .= "<a href='".$path."page=$next' class='buttonNext'>Next Page</a>";

		else

				$pagination.= "<span  class='buttonNext'>Next Page</span>";

				$pagination.= "</div>\n";

		}

		 return $pagination;

	}




 // FUNCTION TO GET IP ADDRESS
 function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}



//Function to display with array assoc

 	function display_selected_assoc($table,$fields,$where){

		dbconnect();



		$query = "SELECT $fields FROM $table $where";
//echo $query;


		$result = mysql_query($query)or die("query failed ".mysql_error());



		//$result = mysql_fetch_array($result);

		$result = db_results_assoc($result);

		return $result;

 	}



 	//result by using assoc

 	function db_results_assoc($result){







		$res_array = array();



		for($count=0;$row = mysql_fetch_assoc($result);$count++)



			{



				$res_array[$count] = $row;



			}



		return $res_array;



	}



	function db_display_selected($table,$fields,$where){

		dbconnect();



		$query = "SELECT $fields FROM $table $where";

//echo $query;

		$result = mysql_query($query)or die("query failed ".mysql_error());



		$result = mysql_fetch_array($result);

		//$result = db_results_assoc($result);

		return $result;

	}


?>
