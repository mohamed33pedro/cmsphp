<?php 

include "includes/db.php";
include "includes/header.php";

?>
    

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                            
                <?php

                if(isset($_GET['category'])) {
                    $post_category_id = $_GET['category'];       
                    
                    $cat_title_query = "SELECT cat_title FROM categories WHERE cat_id = {$post_category_id}";
                    $cat_title_results = mysqli_query($connection, $cat_title_query);
                    $select_cat_title = mysqli_fetch_array($cat_title_results);
                    $cat_title = $select_cat_title['cat_title'];
                    echo "<h1 class='page-header'>{$cat_title}</h1>";
                                        
                    
                    $query = "SELECT * FROM posts WHERE post_category_id = {$post_category_id} AND post_status = 'published'"; 

                    $select_all_posts_query = mysqli_query($connection, $query);
                    
                    if(mysqli_num_rows($select_all_posts_query) < 1) {
                        echo "<h1 class='text-center'>No Posts Available</h1>";    
                    } else {
                        
                        
                        while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                            $post_id = $row['post_id'];  
                            $post_title = $row['post_title'];  
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];  
                            $post_content = substr($row['post_content'], 0, 200)."...";

                            ?>

                            <!-- First Blog Post -->
                            <h2>
                                <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php">Start Bootstrap</a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                            <hr>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>
                        <?php 

                        }
                    }
                    
                } else {
                    header("Location: index.php");
                }

                ?>

                

                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>    