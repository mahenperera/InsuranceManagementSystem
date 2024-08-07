<!DOCTYPE html>
<html lang="en">


<head>
    <title>Insurance-Type-Management</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="../asserts/js/insurance-type-management.js"></script>
    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 550px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
        }

        /* On small screens, set height to 'auto' for the grid */
        @media screen and (max-width: 767px) {
            .row.content {
                height: auto;
            }
        }
    </style>
</head>

<body>

    <?php
    include ("../services/insurance-types-service.php");
    include ("../utils/url-helper.php");

    if (isset($_POST['i-submit'])) {

        $cus_nic = $_POST['cus_nic'];
        $insurance_type = $_POST['insurance_type'];
        $price = $_POST['price'];
        $vehicle_no = $_POST['vehicle_no'];
        $description = $_POST['description'];

        addinsuranceTypes($cus_nic, $vehicle_no, $insurance_type, $price, $description);
    }

    // update logic 
    $typeId = deconsturctURLFragment($_SERVER["QUERY_STRING"]);
    $updateRow = getUpdateRow($typeId)->fetch_array(MYSQLI_ASSOC);

    if (isset($_POST['i-edit-submit'])) {

        $cus_nic = $_POST['cus_nic'];
        $vehicle_no = $_POST['vehicle_no'];
        $insurance_type = $_POST['insurance_type'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        updateinsuranceTypes($cus_nic, $vehicle_no, $insurance_type, $price, $description);
    }

    if (isset($_POST['i-delete-submit'])) {
        $id = $_POST['ins_id'];
        deleteInsuranceType($id);
    }

    ?>

    <div class="container-fluid">
        <div class="row content">
            <?php include ("../partials/user-dashboard-navbar-md.php"); ?>
            <br>
            <div class="col-sm-9">
                <button style="margin-bottom: 45px;" type="button" class="btn btn-info btn-lg" data-toggle="modal"
                    data-target="#myModal">
                    Add Insurance Type</button>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Customer NIC</th>
                            <th>Vehicle No</th>
                            <th>Insurance Type</th>
                            <th>Price</th>
                            <th>Decsription</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (viewinsuranceTypes()->num_rows > 0) {
                            foreach (viewinsuranceTypes()->fetch_all() as $ins) {
                                echo "<tr>";
                                echo "<td>" . $ins[0] . "</td>";
                                echo "<td>" . $ins[1] . "</td>";
                                echo "<td>" . $ins[2] . "</td>";
                                echo "<td>" . $ins[3] . "</td>";
                                echo "<td>" . $ins[4] . "</td>";
                                echo "<td>";
                                echo "<div style='flex-direction: row; display:flex; gap:10px;'>";

                                echo " <button onclick='getInsuranceTypeId(" . $ins[0] . ")' data-toggle='modal' data-target='#updateModal' class='btn btn-primary edit'>Edit</button>";
                                echo " <form method='post' enctype='multipart/form-data'>";
                                echo " <input type='hidden' name='ins_id' id='ins_id' value=" . $ins[0] . " >";
                                echo " <button type='submit' name='i-delete-submit' class='btn btn-danger'>Delete</button>";
                                echo " </form>";
                                echo "</div>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } ?>
                    </tbody>
                </table>


                <!-- Insert Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add Insurance Type</h4>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"
                                    enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Type ID</label>
                                        <input type="text" class="form-control" id="ins_id"
                                            placeholder="Enter customer NIC" name="i_type_id" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Customer NIC</label>
                                        <input type="text" class="form-control" id="cus_nic"
                                            placeholder="Enter customer NIC" name="cus_nic" required>
                                    </div>
                                    <div class="form-group">

                                        <label>Vehicle No</label>
                                        <input type="text" class="form-control" id="vehicle_no"
                                            placeholder="Enter Vehicle No" name="vehicle_no" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Insurance Type</label>
                                        <input type="text" class="form-control" id="insurance_type"
                                            placeholder="Enter Insurance Type" name="insurance_type" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Value</label>
                                        <input type="text" class="form-control" id="price" placeholder="Enter Value"
                                            name="price" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Message</label>
                                        <input type="text" class="form-control" id="description"
                                            placeholder="Enter Message" name="description" required>
                                    </div>
                                    <button type="submit" name="i-submit" class="btn btn-default">Add</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Insert Modal -->

                <!-- Update Modal -->
                <div class="modal fade" id="updateModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Update Insurance Type</h4>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"
                                    enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label>Customer NIC</label>
                                        <input type="text" class="form-control" id="cus_nic"
                                            placeholder="Enter customer NIC" name="cus_nic"
                                            value="<?php echo $updateRow["cus_nic"]; ?>" required>
                                    </div>
                                    <div class="form-group">

                                        <label>Vehicle No</label>
                                        <input type="text" class="form-control" id="vehicle_no"
                                            placeholder="Enter Vehicle No" name="vehicle_no"
                                            value="<?php echo $updateRow["vehicle_no"]; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Insurance Type</label>
                                        <input type="text" class="form-control" id="insurance_type"
                                            placeholder="Enter Insurance Type" name="insurance_type"
                                            value="<?php echo $updateRow["insurance_type"]; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Value</label>
                                        <input type="text" class="form-control" id="price" placeholder="Enter Value"
                                            name="price" value="<?php echo $updateRow["price"]; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Message</label>
                                        <input type="text" class="form-control" id="description"
                                            placeholder="Enter Message" name="description"
                                            value="<?php echo $updateRow["description"]; ?>" required>
                                    </div>
                                    <button type="submit" name="i-edit-submit" class="btn btn-default">Update</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Update Modal -->
            </div>
        </div>
    </div>

   



    

</body>

</html>