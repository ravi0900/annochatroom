<?php
//getting the value of get paramete 
$room=$_POST['room'];

if (strlen($room)>20 or strlen($room)<2) 
{
    $message ="Please choose a name between 2 to 20 characters";
    echo '<script language ="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';
    # code...
}

else if(!ctype_alnum($room))
{
    $message="Pleasee choose an alphnumeric room name";

    echo '<script language ="javascript">';
    echo 'alert("'. $message. '");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';
    
}
else 
{
    //connect db
    include 'dbase.php';


}

echo "<br> let's chat now";
//check exiting db
$sql= "SELECT * FROM `rooms` WHERE roomname='$room'";

$result = mysqli_query($conn,$sql); 
if($result)
{
    if (mysqli_num_rows($result)>0)
    {
        $message="user already exits, choose differnt user name";

        echo '<script language ="javascript">';
        echo 'alert("'. $message. '");';
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>';  
    }
    else
    {
        $sql="INSERT INTO `rooms` ( `roomname`, `stime`) VALUES ('$room', CURRENT_TIMESTAMP);";
        if(mysqli_query($conn,$sql))

        {
            $message="Enjoy annoChatroom";

        echo '<script language ="javascript">';
        echo 'alert("'. $message. '");';
        echo 'window.location="http://localhost:90/chatroom/rooms.php?roomname=' . $room. '";';
        echo '</script>';
        }

    }
}

else 
{
    echo "error: ".mysqli_error($conn);
}





?>