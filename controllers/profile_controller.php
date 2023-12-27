<?php
//$db = mysqli_connect('localhost', 'root', '', 'chat');
//
//if (file_exists('../_classes/Friend_request.php')) {
//    include_once '../_classes/Friend_request.php';
//    session_start();
//}
$request = new Friend_request();
////$myId = $_SESSION['user_id'];
//$invite = $request->getInvitation($myId);
//////var_dump($invite);
///
if(isset($_POST['accept']))
{
    $id_me = $_POST['myid'];
    $id_user = $_POST['friendid'];
    if($request->acceptInvitation($id_me, $id_user)){
        $request->deleteInvitation($id_me, $id_user);
        header("Location: index.php?page=home");
        exit();
    }
}
if(isset($_POST['decline']))
{
    $id_me = $_POST['myid'];
    $id_user = $_POST['friendid'];
    $request->deleteInvitation($id_me, $id_user);

}