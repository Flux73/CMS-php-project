<?php 
    
        if(isset($_GET['p_id'])) {
            $the_post_id = $_GET['p_id'];


            $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";

            $select_post_by_id = mysqli_query($connection, $query);

            confirm_query($select_post_by_id);

            while($row = mysqli_fetch_assoc($select_post_by_id)) {
                $post_id = $row['post_id'];
                $post_cat_id = $row['post_category_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_content = $row['post_content'];
                $post_status = $row['post_status'];
                $post_img = $row['post_img'];
                $post_tags = $row['post_tags'];
                $post_comments = $row['post_comment_count'];
                $post_date = $row['post_date'];
            }
        }

        if(isset($_POST['update_post'])) {

            $post_author = $_POST['author'];
            $post_title = $_POST['title'];
            $post_cat_id = $_POST['post_category'];
            $post_status = $_POST['status'];

            $post_img = $_FILES['post_img']['name'];
            $post_img_temp = $_FILES['post_img']['tmp_name'];

            $post_content = $_POST['post_content'];
            $post_tags = $_POST['post_tags'];

            move_uploaded_file($post_img_temp, "../img/$post_img");

            if(empty($post_img)) {
                $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                $select_img = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_img)) {
                    $post_img = $row['post_img'];
                }
            }

            $query = "UPDATE posts SET ";
            $query .= "post_title = '$post_title', ";
            $query .= "post_category_id = '$post_cat_id', ";
            $query .= "post_date = now(), ";
            $query .= "post_author = '$post_author', ";
            $query .= "post_status = '$post_status', ";
            $query .= "post_tags = '$post_tags', ";
            $query .= "post_content = '$post_content', ";
            $query .= "post_img = '$post_img' ";
            $query .= "WHERE post_id = $the_post_id ";

            $update_query = mysqli_query($connection, $query);

            confirm_query($update_query);

            echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id=$the_post_id'>View Post &#8594;</a> Or <a href='posts.php'>Edit More Posts &#8594;</a></p>";

        }

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php if(isset($post_title)) echo $post_title;?>">
    </div>

    <div class="form-group">
        
        <select name="post_category" id="post_category">
            <?php 
                    
                $query = "SELECT * FROM categories";
                $select_categories_id = mysqli_query($connection, $query);

                confirm_query($select_categories_id);
    
                while($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }    
                    
            ?>

        </select>

    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php if(isset($post_author)) echo $post_author?>">
    </div>

    <div class="form-group">
        <select name="status" id="status">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <?php
            
                if($post_status =='published') {
                    echo "<option value='draft'>draf</option>";

                } else if($post_status == 'draft') {
                    echo "<option value='published'>published</option>";

                }

            ?>
        </select>
    </div>
    <div class="form-group">
        <img width="100" src="../img/<?php if(isset($post_img)) echo $post_img ?>" alt="">
    </div>
    <div class="form-group">
        <input type="file" name="post_img">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php if(isset($post_tags)) echo $post_tags?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php if(isset($post_content)) echo $post_content?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>

</form>
