<?php include'includes/header.php'; ?>

<div id="wrapper">

    <?php include'includes/nav.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

      
            <!-- Page content -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome Admin
                        <small><?php echo $_SESSION['user_name']; ?></small>
                        
                    </h1>

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
                                           
                                <div class='huge'><?php echo $post_count = select_from('posts'); ?></div>
                                           
                                            
                                            <div>Posts</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="viewpost">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
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
                                            <div class='huge'><?php echo $comment_count = select_from('comments'); ?></div>
                                            
                                            <div>Comments</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="view_all_comments">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
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
                                            <div class='huge'><?php echo $user_count = select_from('users'); ?></div>
                                             
                                            <div> Users</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="viewuser">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
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
                                            <div class='huge'><?php echo $catogery_count = select_from('catogery'); ?></div>
                                             
                                            <div>Categories</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="addcatagory">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    
                                <?php 
                                            
                                            $published_post_count = status_result('posts' , 'post_status' , 'Publish');
                                             
                                            
                                        
                                            $draft_post_count = status_result('posts' , 'post_status' , 'Draft');
                    
                                         
                                            $pending_comments_count = status_result('comments' , 'comment_status' , 'unapproved');
                    
                    
                                           
                                            $suscriber_user_count = role_result('users' , 'user_role' , 'subscriber');
                                              
                                          

                                            ?>
                    <div class="row ">
                       <div class="container-fluid">
                        <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
            
            <?php 
            
            $arr_element = ['All Posts','Published Posts','Draft Posts' , 'Comments','Pending Comments', 'Users' , 'Subscribers','Categories'];
            $arr_element_count = [$post_count, $published_post_count ,$draft_post_count , $comment_count, $pending_comments_count , $user_count ,$suscriber_user_count, $catogery_count];
            
                for($i = 0; $i < 8; $i++){
                    echo" ['{$arr_element[$i]}'" . "," . "{$arr_element_count[$i]}],";
                }
            
            ?>
         
          
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
                        </script>
                         <div id="columnchart_material" style="width: 'auto'; height: 420px;"></div>
                    </div>
                    </div>
                </div>


            </div>


        </div>


    </div>
</div>

<?php include'includes/footer.php'; ?>










<!--PUSHER CODE-->
 <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
  <script>

   var pusher = new Pusher('d59a0e05855e1013d984' , {
    'cluster' : 'ap2',
    'useTLS' : true
   });
      
      var channel = pusher.subscribe('notification');
      channel.bind('new_user' , function(data){
         toastr.success(`${data} just registered`); 
          //alert(JSON.stringify(data + "just registered"));
      });
   
 
  </script>
  
 




















