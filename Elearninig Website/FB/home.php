<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
    function getTypePost(str)
    {
        var s=""
        if(str=="text")
        s=s+`Type Your Text<br> <textarea name='tx' rows='10' cols='50' class='form-control'></textarea>`;
    else
    s=s+"Select Your Medida File<br> <input type='file'name='file' class='form-control'>";
document.getElementById("data").innerHTML=s
    }
    </script>
</head>
<body>

<?php
$con=mysqli_connect('localhost','root','','fb');

session_start();
if(isset($_SESSION['loguser']))
{
    $uname=$_SESSION['loguser'];
}
else
header('location:index.php');
 ?>   
<div class="row">
 <div class="col-md-1"></div>
 <div class="col-md-10" style="border:2px solid gray; padding:10px">
    <div class="row">
    <div class="col-md-3">
        <h4>Welcome &emsp; &emsp; <?php echo $uname;?></h4>

</div>
<div class="col-md-3">

    <?php
    $q="select * from user where uname='$uname'";
    $rs=mysqli_query($con,$q);
    $r=mysqli_fetch_array($rs);
    
    ?>
    <img src="userimage\\<?php echo $r[8]?>" height='100' width='100' style="border:2px solid boue; border-radius:50px">
</div>
<div class="col-md-5">

&emsp; &emsp; 
<a href='lout.php' class='btn btn-danger'>Logout</a>

&emsp; &emsp; &emsp; 


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  What's in Your Mind
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Your Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype='multipart/form-data'>
        Slect Your Post Type
        <select class="form-select" onchange="getTypePost(this.value)" name='ty'>
        <option value="text">Text</option>
        <option value="image">Media</option>
        
    </select>
    <div id="data">
    </div>
    <br>
    <input type="submit" name="submit" value="Post" class='btn btn-success'>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
  <?php
  if(isset($_REQUEST['submit']))
  {
    $ty=$_REQUEST['ty'];
    if($ty=="text")
    {
        $text=$_REQUEST['tx'];
        $dt=date('D-M-Y');
        $q="insert into post(ptype,text,dt,uname)values('$ty','$text','$dt','$uname')";
        mysqli_query($con,$q);
    }
    else
    {
        $img=$_FILES['file']['name'];
   if(move_uploaded_file($_FILES['file']['tmp_name'],"postimage//$img"))
   {
    $dt=date('D-M-Y');
    $q="insert into post(ptype,image,dt,uname)values('$ty','$img','$dt','$uname')";
    mysqli_query($con,$q);

   }     

    }
  }
  ?>
</div>

</div>
</div>
<!--Show Post Here!-->


 </div>
 

</div>
<br><br>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-6">

<div class="row">

<?php
$q="select * from post";
$rs=mysqli_query($con,$q);
while($r=mysqli_fetch_row($rs))
{
?>
<div class="col-md-12" style="border:2px solid blue; padding:10px">

<h3><?php echo $r[5];?></h3>
&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; 
<?php
$q="select * from user where uname='$r[5]'";
$rs1=mysqli_query($con,$q);
$r1=mysqli_fetch_array($rs1);

?>

<img src="userimage\\<?php echo $r1[8]?>" height='50' width='50' style="border:2px solid boue; border-radius:25px">

&emsp; &emsp; &emsp; &emsp; &emsp; &emsp;

<?php echo $r[4]?>
</div>




<div class="row">

<div class="col-md-12">
<?php
if($r[1]=="text")
{
?>
<h3>
    <?php echo $r[2]?>
</h3>
<?php
}
else
{
    ?>

<img src="postimage\\<?php echo $r[3]?>" height='100%' width='100%'>

    <?php
}
?>

</div>
</div>
<?php

}
?>

</div>


</div>

</body>
</html>