-<!DOCTYPE html>
<?php
include('connection.php');
include('header.php');
?>
<html>

<head>
    <title>Search</title>
</head>
<body>

<a href="index.php" type="button" class="btn btn-xs btn-info">Back</a>

<div id="page-wrapper">

    <div class="container-fluid">


        <div class="row">
        <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Las Name</th>
                        <th>Middle Name</th>
                        <th>Address</th>
                        <th>Comment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            <tbody>
            <?php
            include('connection.php');

            $button = $_GET ['submit'];
            $search = $_GET ['search'];



            $sql = "SELECT * FROM users WHERE CONCAT(first_name, last_name) LIKE ('%" . $search ."%')";
            $run = mysqli_query($db,$sql);
            $foundnum = mysqli_num_rows($run);

            if($foundnum==0)
            {
                echo "We were unable to find a product with a search term of '<b>$search</b>'.";
            }
            else{
                
                echo "<h1><strong> $foundnum Results Found for \"" .$search."\" </strong></h1>";
                $sql = "SELECT * FROM users WHERE CONCAT(first_name, last_name) LIKE ('%" . $search ."%')";
                $getquery = mysqli_query($db,$sql);
                $count =1;
                while($runrows = mysqli_fetch_array($getquery))
                {
            ?>
                        <tr>  
                            <td><?php echo $count;?></td>
                            <td><?php echo $runrows['first_name'];?></td>
                            <td><?php echo $runrows['last_name'];?></td>
                            <td><?php echo $runrows['mid_name'];?></td>
                            <td><?php echo $runrows['address'];?></td>
                            <td><?php echo $runrows['comment'];?></td>
                            <td>
                            <?php echo '<a  type="button" class="btn btn-xs btn-warning" href="edit.php?action=edit & id='.$runrows['id'] . '"> EDIT </a>'; ?>
                            <?php echo '<a  type="button" class="btn btn-xs btn-danger" href="del.php?type=users&delete & id='. $runrows['id'] . '">DELETE </a>'; ?>
                            </td>
                        </tr>     
           
            <?php
            $count = $count+1;
            }}
            ?>
            </tbody>
            </table>
        </div>
        </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstarp/3.3.0/js/bootstrap.min.js"></script>
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" rel="stylesheet"/>


</body>
</html>
