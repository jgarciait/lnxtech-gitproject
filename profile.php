<!DOCTYPE html>
<html lang="en">
<?php

    include('connection.php');
    include('header.php');

?>  

<?php
/**
*
* Author: CodexWorld
* Function Name: cwUpload()
* $field_name => Input file field name.
* $target_folder => Folder path where the image will be uploaded.
* $file_name => Custom thumbnail image name. Leave blank for default image name.
* $thumb => TRUE for create thumbnail. FALSE for only upload image.
* $thumb_folder => Folder path where the thumbnail will be stored.
* $thumb_width => Thumbnail width.
* $thumb_height => Thumbnail height.
*
**/
function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){

    //folder path setup
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;
    
    //file name setup
    $filename_err = explode(".",$_FILES[$field_name]['name']);
    $filename_err_count = count($filename_err);
    $file_ext = $filename_err[$filename_err_count-1];
    if($file_name != ''){
        $fileName = $file_name.'.'.$file_ext;
    }else{
        $fileName = $_FILES[$field_name]['name'];
    }
    
    //upload image path
    $upload_image = $target_path.basename($fileName);
    
    //upload image
    if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
    {
        //thumbnail creation
        if($thumb == TRUE)
        {
            $thumbnail = $thumb_path.$fileName;
            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;

                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                    break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
            }

            imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($file_ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,100);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,100);
                    break;

                case 'gif':
                    imagegif($thumb_create,$thumbnail,100);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail,100);
            }

        }
        return $fileName;
    }
    else
    {
        return false;
       
    }
}
if(!empty($_FILES['img'])){
    
    //call thumbnail creation function and store thumbnail name
    $upload_img = cwUpload('img','uploads/','',TRUE,'src/','200','160');
    
    //full path of the thumbnail image
    $thumb_src = 'src/'.$upload_img;
    
    //set success and error messages
    $message = $upload_img?"<span style='color:#008000;'>Image thumbnail have been created successfully.</span>":"<span style='color:#F00000;'>Some error occurred, please try again.</span>";
    
}else{
    
    //if form is not submitted, below variable should be blank
    $thumb_src = '';
    $message = '';
}
?>
<body>
    <div>
        <div id="page-wrapper">

            <div class="container-fluid">
         
                <!-- Page Heading -->

                <!-- /.row -->
<?php 
$query = 'SELECT * FROM users WHERE id='.$_GET['id'];
            $sql = mysqli_query($db, $query) or die(mysqli_error($db));
              while($row = mysqli_fetch_array($sql))
              {   
                $zz= $row['id'];
                $i= $row['first_name'];
                $a=$row['last_name'];
                $b=$row['mid_name'];
                $c=$row['address'];
                $d=$row['contact'];
                $e=$row['comment'];
                $f=$row['img'];
             
              }
              
              $id = $_GET['id'];
         
?>
<a href="index.php" type="button" class="btn btn-xs btn-info">Back</a>
                       
            <div class="col-md-12">
                <h2>View Records</h2>
                    <div>
<?php

echo "<tr><td><img src=src/$f class='rounded-circle'></td></tr>";


?>

                        <br></br>

                            <form role="form" method="post" enctype="multipart/form-data" action="profile1.php">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $zz; ?>" />
                            </div>
                            <div class="form-group">
                            <input type="file" name="img" value="<?php $thumb_src; ?>"/>
                            </div>
                            <div class="form-group">
                            <label>First Name</label>
                              <p class="form-control"><?php echo $i; ?> </p>
                            </div>
                            <div class="form-group">
                            <label>Last Name</label>
                            <p class="form-control"><?php echo $a; ?> </p>
                            </div> 
                            <div class="form-group">
                            <label>Middle Name</label>
                            <p class="form-control"><?php echo $b; ?> </p>
                            </div> 
                            <div class="form-group">
                            <label>Address</label>
                            <p class="form-control"><?php echo $c; ?> </p>
                            </div> 
                            <div class="form-group">
                            <label>Contact</label>
                            <p class="form-control"><?php echo $d; ?> </p>
                            </div>
                            <div class="form-group">
                             <label>Comment</label>
                             <p class="form-control"><?php echo $e; ?> </p>
                            </div>
                            <button type="submit" class="btn btn-default">Update Image</button>
                      </form>  
                    </div>
            </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>



</body>

</html>

