<script>
$(document).ready(function(){                
   $('#example').DataTable({
        layout: {
            topStart: {
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            }
        },
        columnDefs: [
            { "orderable": false, "targets": [0,7] } 
        ]
    });
});
</script>


<?php
// Delete Post.
if (isset($_GET["deleteActivity"])) {
    $activity_id = $_GET['deleteActivity'];
    $activity_image = $_GET['image'];
    $query = "DELETE FROM tbl_activity WHERE activity_id=$activity_id";
    $delete_query = mysqli_query($connection, $query);
    header("Location: activity.php");
    if (!$delete_query) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

if (isset($_POST["apply"])) {
    if (isset($_POST["checkBoxArray"])) {
        foreach ($_POST["checkBoxArray"] as $checkBoxValue) {
            $bulk_option = $_POST['bulk_option'];
            switch ($bulk_option) {
                case 'Published':
                    $query = "UPDATE tbl_activity SET activity_status = '$bulk_option' WHERE activity_id=$checkBoxValue";
                    $update_activity = mysqli_query($connection, $query);
                    echo "<p class='alert alert-success'>Activity published successfully.</p>";
                    if (!$update_activity) {
                        die("Query Failed: " . mysqli_error($connection));
                    }
                    break;
                case 'Draft':
                    $query = "UPDATE tbl_activity SET activity_status = '$bulk_option' WHERE activity_id=$checkBoxValue";
                    $update_activity = mysqli_query($connection, $query);
                    echo "<p class='alert alert-success'>Activity draftted successfully.</p>";
                    if (!$update_activity) {
                        die("Query Failed: " . mysqli_error($connection));
                    }
                    break;
                case 'Important':
                    $query = "UPDATE tbl_activity SET activity_pin = '1' WHERE activity_id=$checkBoxValue";
                    $update_activity = mysqli_query($connection, $query);
                    echo "<p class='alert alert-success'>Activity important successfully.</p>";
                    if (!$update_activity) {
                        die("Query Failed: " . mysqli_error($connection));
                    }
                    break;
                case 'Unimportant':
                    $query = "UPDATE tbl_activity SET activity_pin = '0' WHERE activity_id=$checkBoxValue";
                    $update_activity = mysqli_query($connection, $query);
                    echo "<p class='alert alert-success'>Activity unimportant successfully.</p>";
                    if (!$update_activity) {
                        die("Query Failed: " . mysqli_error($connection));
                    }
                    break;
                case 'Delete':
                    $query = "DELETE FROM tbl_activity WHERE activity_id = $checkBoxValue";
                    $update_activity = mysqli_query($connection, $query);
                    echo "<p class='alert alert-success'>Activity deleted successfully.</p>";
                    if (!$update_activity) {
                        die("Query Failed: " . mysqli_error($connection));
                    }
                    break;
                default:
                    echo "<p class='alert alert-danger'>Please an option.</p>";
                    break;
            }
        }
    } else {
        echo "<p class='alert alert-danger'>Please select activity.</p>";
    }
}
?>

<form action="" method="POST">
<table id="example" class="display" style="width:100%">
<div class="row d-flex align-items-center">
            <div class="col-4">
                <select class="form-control" name="bulk_option">
                    <option value="">Select Options</option>
                    <option value="Published">Publish</option>
                    <option value="Draft">Draft</option>
                    <option value="Important">Important</option>
                    <option value="Unimportant">Unimportant</option>
                    <option value="Delete">Delete</option>
                </select>
            </div>
            <div class="col-7">
                <input type="submit" class="btn btn-success" name="apply" value="Apply">
                <a class="btn btn-primary" href="posts.php?source=add_activity">Add New</a>
            </div>
        </div>
        <thead>
            <tr>
                <th><input type='checkbox' id='selectAllBoxes' onclick="selectAll(this)"></th>
                <th style="width:40px;">ID </th>
                <th style="width: 300px;">Title[EN] / Title[TH] / Title[CN]</th>
                <!-- <th style="width: 150px;">[ภาษาไทย] Title</th> -->
                <!-- <th style="width: 150px;">[ภาษาไทย] Category</th> -->
                <th>Status </th>
                <th style="width:48px ;">Pin </th>
                <th style="width:100px">Image</th>
                <th>Date</th>
                <th style="width:80px">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM tbl_activity order by activity_id desc ";
            $fetch_activity_data = mysqli_query($connection, $query);
            while ($Row = mysqli_fetch_assoc($fetch_activity_data)) {
                $the_activity_id = $Row['activity_id'];
                $the_activity_image = $Row['activity_image'];
                $the_activity_pin = $Row['activity_pin'];
                $the_activity_title = base64_decode($Row['activity_title']);
                $the_activity_title_thai = base64_decode($Row['activity_title_thai']);
                $the_activity_title_china = base64_decode($Row['activity_title_china']);             

                echo "<tr>"; ?>
                <td><input type='checkbox' name='checkBoxArray[]' value='<?php echo $the_activity_id ?>'></td>
            <?php
                echo "<td>{$Row['activity_id']}</td>
                    <td><a href='../activity.php?lang=en&p_id=$the_activity_id'>{$the_activity_title}</a>
                     / <a href='../activity.php?lang=th&p_id=$the_activity_id'>{$the_activity_title_thai}</a>
                     / <a href='../activity.php?lang=cn&p_id=$the_activity_id'>{$the_activity_title_china}</a>";

                 $date_data =  $Row['activity_date'];       
                 $date = new DateTime($date_data ); 
                 $date_DMY = $date->format('d/m/Y');

                echo "<td>{$Row['activity_status']}</td>";

                if ($the_activity_pin === "1") {
                    echo "<td><img src='../images/pin.png' alt='image'  width='20px' height='20px'></td>";
                } else {
                    echo "<td></td>";
                }

                echo "<td><img src='../activity/{$Row['activity_image']}' alt='image' width='150px' height='65px' style='object-fit: cover; text-align:center;'></td>
                    <td>{$date_DMY}</td>
                    <td class='text-center'>
                        <a href='activity.php?source=edit_activity&p_id=$the_activity_id'><i class='bi bi-pencil-square ' aria-hidden='true'></i></a> | 
                        <a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='activity.php?deleteActivity=$the_activity_id&image=$the_activity_image'><i class='bi bi-trash ' aria-hidden='true'></i></a> 
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</form>

