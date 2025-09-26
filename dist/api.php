<?php
require_once '../config/database.php'; // Include database connection
// Fetch EMP_DISPLAY_CODE from the request
$empDisplayCode = isset($_GET['EMP_DISPLAY_CODE']) ? $_GET['EMP_DISPLAY_CODE'] : null;

if ($empDisplayCode) {
    // Fetch data from employee_master table based on EMP_DISPLAY_CODE
    $sql = "SELECT * FROM employee_master WHERE EMP_DISPLAY_CODE = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $empDisplayCode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employeeData = $result->fetch_assoc();
        $mobileNumber = $employeeData['MOBILE_NO'];

        if (!empty($mobileNumber)) {
            // Check if the mobile number is already registered
            $checkSql = "SELECT Phone_Number FROM user_activity WHERE Phone_Number = ?";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bind_param("s", $mobileNumber);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                // Mobile number is already registered, return an error
                echo json_encode(["error" => "mobile number already exist"]);
            } else {
                // Mobile number is not registered, return employee data
                // The original code returned an array, so we'll create an array with the single row.
                echo json_encode([$employeeData]);
            }
            $checkStmt->close();
        } else {
            // No mobile number found for the employee, return employee data
            echo json_encode([$employeeData]);
        }
    } else {
        echo json_encode([]);
    }
    $stmt->close();
} 

// API to fetch the last row from the registrations table
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'getLastRegistration') {
    $sql = "SELECT * FROM registrations ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "No data found"]);
    }

    $conn->close();
    exit;
}

// API to delete a row from the registrations table based on mobile number
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'deleteByMobile') {
    $mobileNumber = isset($_GET['mobile']) ? $_GET['mobile'] : null;

    if ($mobileNumber) {
        $sql = "DELETE FROM registrations WHERE mobile = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $mobileNumber);

        if ($stmt->execute()) {
            echo json_encode(["success" => "Record deleted successfully"]);
        } else {
            echo json_encode(["error" => "Failed to delete record"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["error" => "Mobile number is required"]);
    }

    $conn->close();
    exit;
}

$conn->close();
?>
