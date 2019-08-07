
<?php 
include 'inc/header.php';
include 'lib/Student.php';
?>

<?php
$std = new Student();
if($_SERVER['REQUEST_METHOD']=='POST'){
   $name = $_POST['name'];
   $roll = $_POST['roll'];
   $insertdata = $std->insertStudent($name,$roll);
}

?>

<?php

if(isset($insertdata)){
   echo $insertdata;
}
?>


         <!-- main body -->
         <div class="panel panel-default">
         	<div class="panel-heading">
         		<h3>
         			<a class="btn btn-success" href="add.php">Add Student</a>
         			<a class="btn btn-info pull-right" href="index.php">Back</a>
         		</h3>
         		
         	</div>

         	<div class="panel-body">
         	

         		<form action="" method="post">
         			
                  <div class="form-group">

                     <label for="name">Student Name:</label>
                     <input type="text" class = "form-control" name="name" id="name">
                     
                  </div>

                  <div class="form-group">

                     <label for="roll">Student Roll:</label>
                     <input type="text" class = "form-control" name="roll" id="roll">
                     
                  </div>

                  <div class="form-group">
                     
                     <input type="submit" name="submit" value="Add Student" class="btn btn-primary">
                     
                  </div>
         			
         		</form>
         		

         	</div>

         </div>

   <?php include 'inc/footer.php';?>      
         