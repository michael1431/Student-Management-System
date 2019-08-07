
<?php
 include 'inc/header.php';
 include 'lib/Student.php';
?>


         <!-- main body -->
         <div class="panel panel-default">
         	<div class="panel-heading">
         		<h3>
         			<a class="btn btn-success" href="add.php">Add Student</a>
         			<a class="btn btn-info pull-right" href="index.php">Take Attendence</a>
         		</h3>
         		
         	</div>

         	<div class="panel-body">
         		

         		<form action="" method="post">
         			<table class="table table-striped">
         				<tr>

         					<th width="30%">Serial No</th>
                        <th width="50%">Attendence Date</th>
                        <th width="20%">Action</th>
         			
         				</tr>

         				<?php
                      $std = new Student();
         				 $get_date = $std->getDateList();

         				 if($get_date){
         				 	$i = 0;
         				 	while ($value = $get_date->fetch_assoc()) {
         				 		$i++;
         				 

         				?>

         				<tr>
         					<td><?php echo $i; ?></td>
         					<td><?php echo $value['att_time'];?></td>
         					<td>
         						<a class ="btn btn-warning" href="student_view.php?dt=<?php echo $value['att_time'];?>">View</a>
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
         