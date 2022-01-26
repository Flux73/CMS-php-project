<?php 

    if(isset($_GET['edit_user'])) {
        $user_id = $_GET['edit_user'];

        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $select_users_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_users_query)) {
                                     
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

        if (isset($_POST['edit_user'])) {

            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_role = $_POST['user_role'];

            $user_img = $_FILES['user_img']['name'];
            $user_img_temp = $_FILES['user_img']['tmp_name'];

            $username = $_POST['username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];
            // $post_date = date('d-m-y');

            move_uploaded_file($user_img_temp, "../img/$user_img");

            $query = "SELECT randSalt FROM users";
            $fetch_the_salt = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($fetch_the_salt);
            $salt = $row['randSalt'];
            $user_password = crypt($user_password, $salt);

            $query = "UPDATE users SET ";

            $query .= "username = '$username', ";
            $query .= "user_password = '$user_password', ";
            $query .= "user_firstname = '$user_firstname', ";
            $query .= "user_lastname = '$user_lastname', ";
            $query .= "user_email = '$user_email', ";
            $query .= "user_img = '$user_img', ";
            $query .= "user_role = '$user_role' ";

            $query .= "WHERE user_id = $user_id";

            $edit_user_query = mysqli_query($connection, $query);

            confirm_query($edit_user_query);

        }

?>


<form action="" method="post" enctype="multipart/form-data">

    <?php if (isset($_POST['edit_user'])) echo "<p>User Updated <a href='users.php'>View Users?</a></p>";?>
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

            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
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
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>

</form>