
<?php include "includes/admin_header.php"; ?>

<?php 
                                            
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE username = '{$username}'";

        $select_user_profile_query = mysqli_query($connection, $query);

        if(!$select_user_profile_query) {
            die('QUERY FAILED!' . mysqli_error($connection));
        }

        while($row = mysqli_fetch_assoc($select_user_profile_query)) {
            
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_img = $row['user_img'];
            $user_role = $row['user_role'];
    
        }
    }                         

?>

<?php 

    if(isset($_POST['update_profile'])) {

        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        
        $query = "UPDATE users SET  username = '{$username}', ";
        $query .= "user_password = '{$user_password}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE username = '{$username}' ";

        $result = mysqli_query($connection, $query);

        confirm_query($result);

    }

?>

    <div id="wrapper">




        <!-- Navigation -->
        <?php include "includes/admin_nav.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                        
                        

                        <form action="" method="post" enctype="multipart/form-data">


                        <div class="form-group">
                            <label for="author">Firstname</label>
                            <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="status">Lastname</label>
                            <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname">
                        </div>


                        <div class="form-group">
                            <!-- <label for="post_category_id">Post Category Id</label>
                            <input type="text" class="form-control" name="post_category_id">  -->

                            <select name="user_role" id="post_category">

                                <option value="subscriber"><?php echo $user_role; ?></option>
                                <!-- <option value="admin" selected="">Admin</option>
                                <option value="subscriber">Subscriber</option> -->

                                <?php 
                                
                                    if($user_role == 'admin') {

                                        echo '<option value="subscriber">subscriber</option>';

                                    } else if($user_role == 'subscriber') {

                                        echo '<option value="admin">admin</option>';
                                    }

                                ?>

                            </select>
                        </div>


                        <div class="form-group">
                            <label for="user_img">User Image</label>
                            <input type="file" name="user_img">
                        </div>

                        <div class="form-group">
                            <label for="post_tags">Username</label>
                            <input type="text" value="<?php echo $username ?>" class="form-control" name="username">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Email</label>
                            <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Password</label>
                            <input type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                        </div>

                        </form>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        



        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>