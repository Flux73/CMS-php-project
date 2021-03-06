<?php 

    if (isset ($_POST['checkBoxArray'])) {
        $arrIds = $_POST['checkBoxArray'];
        foreach ($arrIds as $post_val_id) {
            $bulk_options = $_POST['bulk_options'];

            switch ($bulk_options) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$post_val_id}'";
                    
                    $update_publish = mysqli_query($connection, $query);
                    confirm_query($update_publish);
                break;

                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$post_val_id}'";

                    $update_draft = mysqli_query($connection, $query);
                    confirm_query($update_draft);
                break;  
                
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = {$post_val_id}";

                    $delete_post = mysqli_query($connection, $query);
                break;
            }
        }
    }

?>

<form action="" method="post">

    
    <div id="bulk-options-container" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            <option>Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        
    </div>
    
    <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th><input id="select-all-boxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- <tr> -->
                <?php 
                                
                $query = "SELECT * FROM posts";
                $select_posts = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($select_posts)) {
                    
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
                    
                    echo "<tr>";
                    ?>
                    <td><input class='checkBoxes' 
                    type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>' /></td>
                    <?php
                    echo "<td>{$post_id}</td>";
                    echo "<td>{$post_author}</td>";
                    echo "<td>{$post_title}</td>";
                    
                    
                    $query = "SELECT * FROM categories WHERE cat_id = {$post_cat_id}";
                    $select_categories_id = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($select_categories_id)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        
                        
                        echo "<td>$cat_title</td>";
                    }
                    
                    
                    
                    
                    echo "<td>{$post_status}</td>";
                    echo "<td><img width='150' src='../img/{$post_img}' alt='image'/></td>";
                    echo "<td>{$post_tags}</td>";
                    echo "<td>{$post_comments}</td>";
                    echo "<td>{$post_date}</td>";
                    echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                    echo "</tr>";
                    
                    
                }
                
                
                
                ?>

</tbody>
</table>

</form>
<?php 

    if(isset($_GET['delete'])) {

        $post_id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE post_id = {$post_id}";

        $delete_post = mysqli_query($connection, $query);

        confirm_query($delete_post);
        header('Location: posts.php');

    }

?>