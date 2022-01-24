<?php 

    if(isset($_POST['create_post'])) {

        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_cat = $_POST['post_category'];
        $post_status = $_POST['post_status'];

        $post_img = $_FILES['post_img']['name'];
        $post_img_temp = $_FILES['post_img']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        // $post_comment_count = 4;

        move_uploaded_file($post_img_temp, "../img/$post_img");

        $query= "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_status) ";
        $query .= "VALUES ({$post_cat}, '{$post_title}', '{$post_author}', now(), '{$post_img}', '{$post_content}', '{$post_tags}', '{$post_status}') ";

        $create_post_query = mysqli_query($connection, $query);

        confirm_query($create_post_query);


        $the_post_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Post has been added. <a href='../post.php?p_id=$the_post_id'>View Post &#8594;</a> Or <a href='posts.php?source=add_post'>Add more posts &#8594;</a></p>";

    }

?>


<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <!-- <label for="post_category_id">Post Category Id</label>
        <input type="text" class="form-control" name="post_category_id">  -->

        <select name="post_category" id="post_category">

            <?php
            
                $query = "SELECT * FROM categories";
                $result = mysqli_query($connection, $query);
                confirm_query($result);

                while($row = mysqli_fetch_assoc($result)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<option value='$cat_id'>$cat_title</option>";
                }

            ?>

            

        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <!-- <label for="status">Post Status</label>
        <input type="text" class="form-control" name="status"> -->

        <select name="post_status" id="status">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_img">Post Image</label>
        <input type="file" name="post_img">
    </div>
    
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>

</form>