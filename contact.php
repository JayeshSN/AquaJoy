<?php
$FullName = $_POST['getName'];
$Email = $_POST['getEmail'];
$Phone_Number = $_POST['getPhoneNumber'];
$FullSubject = $_POST['getSubject'];
$FullMessage = $_POST['getMessage'];

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'contact_us');

$response = array();

if ($conn->connect_error) {
    $response['status'] = 'error';
    $response['message'] = 'Connection Failed: ' . $conn->connect_error;
} else {
    $stmt = $conn->prepare("INSERT INTO contact_waterpark (FullName, Email, Phone_Number, FullSubject, FullMessage) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $FullName, $Email, $Phone_Number, $FullSubject, $FullMessage);

    if ($stmt->execute()) {
        $response['status'] = 'success';
        $response['message'] = 'Message Sent!';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

echo json_encode($response);
?>