<?php
if (isset($_POST['submit'])) {
    require_once('../database/config.php');
    require_once('../controllers/controllers.php');

    $db_login = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    if (!$db_login) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Sanitize inputs
    $fname = mysqli_real_escape_string($db_login, $_POST['firstname']);
    $lname = mysqli_real_escape_string($db_login, $_POST['lastname']);
    $trackingNumber = mysqli_real_escape_string($db_login, $_POST['tracknum']);
    $shipmentType = mysqli_real_escape_string($db_login, $_POST['shipmentType']);
    $content = mysqli_real_escape_string($db_login, $_POST['content']);
    $shipmentDate = mysqli_real_escape_string($db_login, $_POST['sdate']);
    $deliveryDate = mysqli_real_escape_string($db_login, $_POST['ddate']);
    $sourceCity = mysqli_real_escape_string($db_login, $_POST['scity']);
    $sourceState = mysqli_real_escape_string($db_login, $_POST['sstate']);
    $sourceZip = mysqli_real_escape_string($db_login, $_POST['szip']);
    $currentCity = mysqli_real_escape_string($db_login, $_POST['ccity']);
    $currentState = mysqli_real_escape_string($db_login, $_POST['cstate']);
    $currentZip = mysqli_real_escape_string($db_login, $_POST['czip']);
    $destinationCity = mysqli_real_escape_string($db_login, $_POST['dcity']);
    $destinationState = mysqli_real_escape_string($db_login, $_POST['dstate']);
    $destinationZip = mysqli_real_escape_string($db_login, $_POST['dzip']);
    $contactNumber = mysqli_real_escape_string($db_login, $_POST['contactnumber']);
    $status = mysqli_real_escape_string($db_login, $_POST['status']);

    // Insert query
    $query = "INSERT INTO tracking (
        first_name, last_name, tracking_number, shipment_type, content,
        shipment_date, delivery_date, source_city, source_state, source_zip,
        current_city, current_state, current_zip, destination_city, destination_state,
        destination_zip, contact_number, parcel_status
    ) VALUES (
        '$fname', '$lname', '$trackingNumber', '$shipmentType', '$content',
        '$shipmentDate', '$deliveryDate', '$sourceCity', '$sourceState', '$sourceZip',
        '$currentCity', '$currentState', '$currentZip', '$destinationCity', '$destinationState',
        '$destinationZip', '$contactNumber', '$status'
    )";

    $insert = mysqli_query($db_login, $query);

    if (!$insert) {
        die("Insert failed: " . mysqli_error($db_login));
    } else {
        header("Location: ./dashboard.php");
        exit(); // Prevent further output
    }
}
?>
