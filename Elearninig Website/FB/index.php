<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<div class="row">
<hr><center><h1>Welcome to My Friend Book</h1></center><hr>
<div class="col-md-2"></div>
<div class="col-md-3" style="border:2px solid gray; padding:20px">
<hr><center><h3>Login Here</h3></center><hr>
<br>
<form>
Enter User Name
<input type="text" class="form-control" name="u"><br>
Enter PASSWORD
<input type="text" class="form-control" name="p"><br>
<br>
<input type="submit" name="submit" class='btn btn-success' value="Login">

</form>
<hr>
<?php
$con=mysqli_connect('localhost','root','','fb');
if(isset($_REQUEST['submit']))
{
$u=$_REQUEST['u'];
$p=$_REQUEST['p'];
$q="select * from user where uname='$u' && password='$p'";
$rs=mysqli_query($con,$q);
$x=mysqli_num_rows($rs);
session_start();
if($x>0)
{
    $_SESSION['loguser']=$u;
header('location:home.php');
}
else
echo "<h3>Invalid user Name or Password</h3>";
}
?>
<hr>
</div>


<div class="col-md-1"></div>
<div class="col-md-5" style="border:2px solid gray; padding:20px">

<hr><center><h3>User Register Here</h3></center><hr>
<br>
<hr>
<hr>
<?php
$con=mysqli_connect('localhost','root','','fb');
if(isset($_REQUEST['register']))
{
    $u=$_REQUEST['u'];
    $p=$_REQUEST['p'];
    $f=$_REQUEST['f'];
    $ln=$_REQUEST['fn'];
    $e=$_REQUEST['e'];
    $ph=$_REQUEST['ph'];
    $d=$_REQUEST['d'];
    $m=$_REQUEST['m'];
    $y=$_REQUEST['y'];
    $g=$_REQUEST['g'];
    $dob=$d."-".$m."-".$y;
    $img=$_FILES['file']['name'];
    if(move_uploaded_file($_FILES['file']['tmp_name'],"userimage//$img"))
    {
        $q="insert into user values('$u','$p','$f','$ln','$e','$ph','$dob','$g','$img')";
mysqli_query($con,$q);
echo "<h3>User Regiter Succefully<h3>";
    }
    else
    echo "<br>Could not Upliad";
    
}
?>
<form method="post"  enctype="multipart/form-data">
<div class="row">
    <div class="col">
Enter User Name
<input type="text" class="form-control" name="u">
</div>
</div>
<br>
<div class="row">
    <div class="col">
Enter PASSWORD
<input type="text" class="form-control" name="p">
</div>
</div>
<br>
<div class="row">
    <div class="col">
Email
<input type="text" class="form-control" name="e">
</div>
<div class="col">
Phone
<input type="text" class="form-control" name="ph">
</div>

</div>
<br>
<div class="row">
    <div class="col">
Firt name
<input type="text" class="form-control" name="f">
</div>
<div class="col">
LastName
<input type="text" class="form-control" name="fn">
</div>

</div>
<br>

<div class="row">
    <div class="col">
Day
<input type="text" class="form-control" name="d">
</div>
<div class="col">
Month
<input type="text" class="form-control" name="m">
</div>

<div class="col">
Year
<input type="text" class="form-control" name="y">
</div>

</div>
<br>

<div class="row">
    <div class="col">
Gender
<input type="radio" class="form-check-input" name="g" value="Male">Male
&emsp; 
<input type="radio" class="form-check-input" name="g" value="Female">Female

</div>


</div>
<br>


<div class="row">
    <div class="col">
Select Image
<input type="file" class="form-control" name="file" >

</div>


</div>
<br>


<div class="row">
    <div class="col">
<input type="submit" name="register" class='btn btn-success' value="Register">
</div>

</form>
</div>


</div>
</body>
</html>