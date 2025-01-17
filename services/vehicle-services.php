<?php
include ("../utils/db-connection.php");

function viewVehicle()
{
    try {
        $viewQuery = "SELECT * FROM vehicle";
        $results = mysqli_query(getConnectionInstance(), $viewQuery);
        if (!$results) {
            $message = "Error Fetching Data" . mysqli_error(getConnectionInstance());
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            return ($results);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function addVehicle($customerNic, $vehicleNo, $chassisNo, $engineNo, $insuranceType, $vehicleBrand, $vehicleModle, $vehicleValue, $yom)
{
    try {
        $insertQuery = "INSERT INTO vehicle (
        cus_nic,
        vehicle_no,
        engine_no,
        chassis_no,
        insurance_type,
        vehicle_brand,
        vehicle_modle,
        vehicle_value,
        yom
        ) VALUES ( 
        '$customerNic', 
        '$vehicleNo',
        '$engineNo',
        '$chassisNo',  
        '$insuranceType',
        '$vehicleBrand',
        '$vehicleModle',
        '$vehicleValue',
        '$yom'
        )";
        

        $result = mysqli_query(getConnectionInstance(), $insertQuery);

        if (!$result) {

            $message = "Error Inserting Data" . mysqli_error(getConnectionInstance());
            echo "<script type='text/javascript'>alert('$message');</script>";

        } else {
            echo "<script type='text/javascript'>alert('Data Inserted Sucessfully');</script>";
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function getUpdateRow($id)
{
    try {
        $viewQuery = "SELECT * FROM vehicle WHERE v_id = '$id'";
        $results = mysqli_query(getConnectionInstance(), $viewQuery);
        if (!$results) {
            $message = "Error Fetching Data" . mysqli_error(getConnectionInstance());
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            return ($results);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function updateVehicle($id, $customerNic, $vehicleNo, $engineNo, $chassisNo, $insuranceType, $vehicleBrand, $vehicleModle, $vehicleValue, $yom)
{
    try {
        $updateQuery = "UPDATE vehicle 
        SET 
        cus_nic='$customerNic', 
        vehicle_no='$vehicleNo',
        engine_no='$engineNo',
        chassis_no='$chassisNo',
        insurance_type='$insuranceType',
        vehicle_brand='$vehicleBrand',
        vehicle_modle='$vehicleModle',
        vehicle_value='$vehicleValue',
        yom='$yom'
        WHERE 
        v_id=$id";
       
       $result = mysqli_query(getConnectionInstance(), $updateQuery);

        if (!$result) {

            $message = "Error Inserting Data" . mysqli_error(getConnectionInstance());
            echo "<script type='text/javascript'>alert('$message');</script>";

        } else {
            echo "<script type='text/javascript'>alert('Data Updated Sucessfully');</script>";
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function deleteVehicle($id)
{
    try {
        $deleteQuery = "DELETE FROM vehicle 
        WHERE 
        v_id=$id";
        

        $result = mysqli_query(getConnectionInstance(), $deleteQuery);

        if (!$result) {

            $message = "Error Deleting Data" . mysqli_error(getConnectionInstance());
            echo "<script type='text/javascript'>alert('$message');</script>";

        } else {
            echo "<script type='text/javascript'>alert('Item Deleted Sucessfully');</script>";
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>