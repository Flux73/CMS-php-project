<?php 

    


    if(isset($_POST['create_user'])) {

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

        $query= "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_img, user_role) ";
        
        $query .= "VALUES ('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_img}', '{$user_role}') ";

        $create_user_query = mysqli_query($connection, $query);

        confirm_query($create_user_query);

        echo "A user has been created: " . " " . "<a href='users.php'>View Users</a>";

    }

?>


<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="author">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>


    <div class="form-group">
        <!-- <label for="post_category_id">Post Category Id</label>
        <input type="text" class="form-control" name="post_category_id">  -->

        <select name="user_role" id="post_category">

            <option value="subscriber">Select Options</option>
           <option value="admin">Admin</option>
           <option value="subscriber">Subscriber</option>

        </select>
    </div>


    <div class="form-group">
        <label for="user_img">User Image</label>
        <input type="file" name="user_img">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>

</form>