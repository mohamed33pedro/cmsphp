<?php include "includes/admin_header.php"?>


<?php

$all_posts_query = "SELECT * FROM posts";
$select_all_posts = mysqli_query($connection, $all_posts_query);
$post_counts = mysqli_num_rows($select_all_posts);

$all_comments_query = "SELECT * FROM comments";
$select_all_comments = mysqli_query($connection, $all_comments_query);
$comment_counts = mysqli_num_rows($select_all_comments);

$all_users_query = "SELECT * FROM users";
$select_all_users = mysqli_query($connection, $all_users_query);
$user_counts = mysqli_num_rows($select_all_users);

$all_categories_query = "SELECT * FROM categories";
$select_all_categories = mysqli_query($connection, $all_categories_query);
$category_counts = mysqli_num_rows($select_all_categories);

?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                            Welcome to Admin                            
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>


                </div>
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                   

                                    <div class='huge'><?php echo $post_counts ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Posts</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $comment_counts ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Comments</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $user_counts ?></div>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Users</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class='huge'><?php echo $category_counts ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Categories</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            
<?php
$published_posts_query = "SELECT * FROM posts WHERE post_status = 'published'";
$select_all_published_posts = mysqli_query($connection, $published_posts_query);
$post_published_counts = mysqli_num_rows($select_all_published_posts); 
    
$draft_posts_query = "SELECT * FROM posts WHERE post_status = 'draft'";
$select_all_draft_posts = mysqli_query($connection, $draft_posts_query);
$post_draft_counts = mysqli_num_rows($select_all_draft_posts); 

$unapproved_comments_query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
$select_unapproved_comments = mysqli_query($connection, $unapproved_comments_query);
$unapproved_comments_counts = mysqli_num_rows($select_unapproved_comments); 

$subscriber_query = "SELECT * FROM users WHERE user_role = 'subscriber'";
$select_subscribers = mysqli_query($connection, $subscriber_query);
$subscriber_counts = mysqli_num_rows($select_subscribers); 
    
?>
            
            <div class="row" id="columnchart_material">                
            </div>
            
            <script type="text/javascript">
                  google.load("visualization", "1.1", {packages:["bar"]});
                  google.setOnLoadCallback(drawChart);
                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Data', 'Count'],

<?php

$element_text = ['All Posts','Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];    
$element_counts = [$post_counts, $post_published_counts, $post_draft_counts, $comment_counts, $unapproved_comments_counts, $user_counts, $subscriber_counts, $category_counts];    

for($i = 0; $i < 8; $i++) {
echo "['{$element_text[$i]}'" . "," . "{$element_counts[$i]}],";
}

?>

//                          ['Posts', 1000],

                    ]);

                    var options = {
                      chart: {
                        title: '',
                        subtitle: '',
                      }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, options);
                  }
            </script>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes/admin_footer.php" ?>