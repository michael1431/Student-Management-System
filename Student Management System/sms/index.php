
<?php
 include 'inc/header.php';
 include 'lib/Student.php';
?>

<script type="text/javascript">
	// code for radio button validation

	$(document).ready(function(){

		$("form").submit(function(){

			var roll = true;
			$(':radio').each(function(){
				// loop calaichi prititi roll check korte

				name = $(this).attr('name');
				if(roll && !$(':radio[name="'+ name +'"]:checked').length){
					$('.alert').show();
					roll = false;

				}
			});
			return roll;
		});
	});

</script>

<?php
// kono notice show na korar jonno error_reporting use korchi
error_reporting(0);
$std = new Student();
$cur_date = date('Y-m-d'); 

if($_SERVER['REQUEST_METHOD']=='POST'){
   $attend = $_POST['attend'];
   $attend_data = $std->insertAttendence($cur_date,$attend);
  
}


?>


<?php

if(isset($attend_data)){
   echo $attend_data;
}
?>
         <!-- main body -->


          <div class = 'alert alert-danger' style="display: none; text-align: center;"><strong>Error !</strong> Student Roll Missing!</div>
         <div class="panel panel-default">
         	<div class="panel-heading">
         		<h3>
         			<a class="btn btn-success" href="add.php">Add Student</a>
         			<a class="btn btn-info pull-right" href="date_view.php">View All</a>
         		</h3>
         		
         	</div>

         	<div class="panel-body">
         		<!-- show the current date -->
         		<div class="well text-center" style="font-size: 20px;">
         			<strong>Date:</strong><?php echo $cur_date; ?>
         			
         		</div>

         		<form action="" method="post">
         			<table class="table table-striped">
         				<tr>

         					<th width="25%">Serial No</th>
         					<th width="25%">Student Name</th>
         					<th width="25%">Student Roll</th>
         					<th width="25%">Attendence</th>


         				</tr>

         				<?php
         				 $get_student = $std->getStudents();

         				 if($get_student){
         				 	$i = 0;
         				 	while ($value = $get_student->fetch_assoc()) {
         				 		$i++;
         				 

         				?>

         				<tr>
         					<td><?php echo $i; ?></td>
         					<td><?php echo $value['name'];?></td>
         					<td><?php echo $value['roll'];?></td>
         					<td>
         						<input type="radio" name="attend[<?php echo $value['roll'];?>]" value="present" >P
         						<input type="radio" name="attend[<?php echo $value['roll'];?>]" value="absent" >A
         					</td>

         				</tr>

         				<?php } } ?>

         				<tr>
         					<td colspan="4">
         						<input type="submit" class="btn btn-primary" name="submit" value="Submit">
         					</td>
         				</tr>
         			</table>
         			
         		</form>
         		

         	</div>

         </div>

   <?php include 'inc/footer.php';?>      
         