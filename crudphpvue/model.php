<?php

    $conn = new mysqli('localhost', 'root', '', 'crud');

    if($conn->connect_error) {
        die("Could not connect to database.");
    }

    $res = array('error'=> false);

    $action = $_GET["p"];

    if($action == "read") {
        $sql = $conn->query("SELECT id, name, email FROM users");
        $users = array();

        while($row = $sql->fetch_assoc()) {
            $users[] = $row;
        }

        $res['users'] = $users;

    }

    if($action == "insert") {

        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = $conn->query("INSERT INTO users(name, email) VALUES('$name', '$email')");

        if($sql) {
            $res['message'] = "User Add success.";
        } else {
            $res['error'] = true;
            $res['message'] = "Add not success.";
        }

    }

    if($action == "update") {

        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = $conn->query("UPDATE users SET name = '$name', email = '$email' WHERE id = '$id'");

        if($sql) {
            $res['message'] = "User Update success.";
        } else {
            $res['error'] = true;
            $res['message'] = "Update not success.";
        }

    }

    if($action == "delete") {

        $id = $_POST['id'];

        $sql = $conn->query("DELETE FROM users WHERE id = '$id'");

        if($sql) {
            $res['message'] = "User Delete success.";
        } else {
            $res['error'] = true;
            $res['message'] = "Delete not success.";
        }

    }

    $conn->close();
    header("Content-Type: application/json");
    echo json_encode($res);
    die();

?>