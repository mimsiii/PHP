<?php
require 'dbcon.php';

if(isset($_POST['save_contact'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $cgroup = mysqli_real_escape_string($con, $_POST['cgroup']);

    if($name == NULL || $email == NULL || $phone == NULL || $cgroup == NULL){
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    
    $query = "INSERT INTO `contacts` (name,email,phone,cgroup) VALUES ('$name','$email','$phone','$cgroup')";
    $query_run = mysqli_query($con,$query);

    if($query_run){
        $res = [
            'status' => 200,
            'message' => 'Contact created successfully'
        ];
        echo json_encode($res);
        return;
    }
    else{
        $res = [
            'status' => 500,
            'message' => 'Contact not created'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['update_contact'])){
    $contact_id = mysqli_real_escape_string($con, $_POST['contact_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $cgroup = mysqli_real_escape_string($con, $_POST['cgroup']);

    if($name == NULL || $email == NULL || $phone == NULL || $cgroup == NULL){
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE `contacts` SET name='$name', email='$email', phone='$phone', cgroup='$cgroup' WHERE id='$contact_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $res = [
            'status' => 200,
            'message' => 'Contact updated successfully'
        ];
        echo json_encode($res);
        return;
    }
    else{
        $res = [
            'status' => 500,
            'message' => 'Contact not updated'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_GET['contact_id'])){
    $contact_id = mysqli_real_escape_string($con, $_GET['contact_id']);
    $query = "SELECT * FROM `contacts` WHERE id='$contact_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1){
        $contact = mysqli_fetch_array($query_run);
        $res = [
            'status' => 200,
            'message' => 'Contact fetched successfully',
            'data' => $contact
        ];
        echo json_encode($res);
        return;
    }
    else{
        $res = [
            'status' => 404,
            'message' => 'Contact not found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_contact'])){
    $contact_id = mysqli_real_escape_string($con, $_POST['contact_id']);

    $query = "DELETE FROM `contacts` WHERE id = '$contact_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Contact deleted successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Contact not deleted'
        ];
        echo json_encode($res);
        return;
    }
}
?>