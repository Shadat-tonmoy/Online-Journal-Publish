<?php
	//session_destroy();
	//session_start();
	include 'conn.php';
	include 'editors_header.php';
	//echo "Hello0";
	if(isset($_SESSION['ed_id']))
	{
		$ed_id = $_SESSION['ed_id'];
		//echo $ed_id;
	}
	if(isset($_GET['doc_id']))
	{
		$doc_id = $_GET['doc_id'];
		//echo "---$doc_id";
		$approve_sql = "UPDATE `published_docs` SET `status`='1' WHERE `id`='$doc_id'";
		$approve_result = mysqli_query($conn,$approve_sql);
		if($approve_result)
		{
			//echo "Done";
			//echo mysqli_affected_rows($approve_result);
		}
		else echo mysqli_error($conn);

		$approve_sql_req = "UPDATE `req` SET `status`='1' WHERE `req`='$doc_id'";
		$approve_result_req = mysqli_query($conn,$approve_sql_req);
		if($approve_result_req)
		{
			//echo "Done";
			//echo mysqli_affected_rows($approve_result);
		}
	}



?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

</head>
<body>
	<div class="main_div" style="margin-top: -2px;">
	<div class="req_div">
		<h2 class="editor_side_header">Your Requests </h2>		
	</div>
	<table style="width: 60%;margin-left: 10%;text-align: center;">
		<tr style="padding: 15px;">
			<th>Requested By</th>
			<th>Status</th>
			<th>Download Link</th>
			<th>Manage</th>
		</tr>
		<?php
		$req_sql = "SELECT * FROM `req` WHERE `req_to`='$ed_id'";
		$req_result = mysqli_query($conn,$req_sql);
		while($row=mysqli_fetch_assoc($req_result))
		{
			$id = $row['id'];
			$req_by = $row['req_by'];
			$req_for =  $row['req_for'];
			$status = $row['status'];
			$req_by_detail = "SELECT * FROM `user_data` WHERE `id`='$req_by'";
			$req_by_detail_result = mysqli_query($conn,$req_by_detail);
			$req_by_row = mysqli_fetch_assoc($req_by_detail_result);
			$name = $req_by_row['full_name'];
			$doc_link_sql = "SELECT * FROM `published_docs` WHERE `id`='$req_for'";
			$doc_link_result = mysqli_query($conn,$doc_link_sql);
			$doc_link_row = mysqli_fetch_assoc($doc_link_result);
			$doc_link = $doc_link_row['link'];
			$doc_status = $doc_link_row['status'];
		?>
			<tr style="padding: 15px;">
				<td><?php echo $name?></td>
				<td><?php if($doc_status=="0") echo "Not Approved Yet"; else echo "Published"?></td>
				<td><a href="new file.txt">Download Here</a></td>
				<td>
					<?php
						if($doc_status==0)
						{
					?>
						<form method="post">
							<a href=<?php echo "editors_dashboard.php?doc_id=$req_for"?> >Approve</a>						
						</form>

					<?php

						}
						else 
							echo "Already Approved";
					?>
					
				</td>
			</tr>
		<?php
			//echo "$id by $name $req_for $status<br>";
		}
		?>
		
	</table>
	</div>
	

</body>
</html>