
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
// code for update std attendence
$std = new Student();
// date ta get method diye dorbo jeta patacchi
$dt = $_GET['dt'];

if($_SERVER['REQUEST_METHOD']=='POST'){
   $attend = $_POST['attend'];
   $update_attd = $std->UpdateAttendence($dt,$attend);
  
}


?>


<?php

if(isset($update_attd)){
   echo $update_attd;
}
?>


         <!-- main body -->
         <div class = 'alert alert-danger' style="display: none; text-align: center;"><strong>Error !</strong> Student Roll Missing!</div>
         <div class="panel panel-default">
         	<div class="panel-heading">
         		<h3>
         			<a class="btn btn-success" href="add.php">Add Student</a>
         			<a class="btn btn-info pull-right" href="date_view.php">Back</a>
         		</h3>
         		
         	</div>

         	<div class="panel-body">
         		
               <div class="well text-center" style="font-size: 20px;">

                  <strong>Date:</strong><?php echo $dt; ?>
                  
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
                      
         				 $get_std = $std->getAllStudentByDate($dt);

         				 if($get_std){
         				 	$i = 0;
         				 	while ($value = $get_std->fetch_assoc()) {
         				 		$i++;
         				 

         				?>

         				<tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['name'];?></td>
                        <td><?php echo $value['roll'];?></td>
                        <td>
                           <input type="radio" name="attend[<?php echo $value['roll'];?>]" value="present" <?php if($value['attend']=="present"){echo "checked";}?> >P
                           <input type="radio" name="attend[<?php echo $value['roll'];?>]" value="absent"  <?php if($value['attend']=="absent"){echo "checked";}?> >A
                        </td>

                     </tr>


         				<?php } } ?>

         				<tr>
         					<td colspan="4">
         						<input type="submit" class="btn btn-primary" name="submit" value="Update">
         					</td>
         				</tr>
         			</table>
         			
         		</form>
         		

         	</div>

         </div>

   <?php include 'inc/footer.php';?>      
         