<?php 


$conn = mysqli_connect('localhost','katleho','test1234','pizzanija');

if(!$conn)
{
	echo 'connection error' . mysqli_connect_error() ;
}

?>