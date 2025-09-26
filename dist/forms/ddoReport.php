<?php
// Include the database connection file
require_once '../../config/database.php';

// The SQL query
$sql = "SELECT External_System_Id, MAX(Total_Completions) AS Largest_Total_Completions FROM userreport GROUP BY External_System_Id ORDER BY `userreport`.`External_System_Id` ASC";

// Execute the query
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DDO Report</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DDO Report</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">User Completions Report</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="ddoReportTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>DDO Code</th>
                                        <th>No. of certificates highest achiever employee get</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr><td>" . $row["External_System_Id"]. "</td><td>" . $row["Largest_Total_Completions"]. "</td></tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='2'>No results found</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>

<script>
    $(function () {
        $("#ddoReportTable").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
    });
</script>
</body>
</html>
<?php
$conn->close();
?>
