    
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <!-- heading of nav -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Admin</a> 
        
    </div>



    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="../index">Home</a></li>
        <!--<li><a href="#">Users Online : <span class="usersonline"><?php //echo users_online(); ?></span></a></li>-->
        <li><a href="#">Users Online : <!--<span class="usersonline"></span>--></a></li>
        <!-- envelope -->
        <!--<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu message-dropdown">

                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                            <span class="pull-left">
                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading">
                                    <strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>

                <li class="message-footer">
                    <a href="#">Read All New Messages</a>
                </li>
            </ul>
            </li>-->


            <!-- bell -->
            <!--  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li> 
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li> -->


            <!-- user -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>&nbsp;<?php 
                    
                    
                    
                   if(isset($_SESSION['user_name'])) {
                    echo $_SESSION['user_name'];
                    
                   }
                    
                    
                    ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <!--  <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li> -->
                    <!-- <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li> -->
                    <li class="divider"></li>
                    <li>
                        <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>


    </ul>

    <!-- top bar end -->




    <!--sidebar start -->

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="<?php if(isset($_GET['in'])){echo 'active';} ?>">
                <a href="index?in">
                     <i class="fa fa-fw fa-dashboard"></i>  My Data</a>
            </li>
            
            <?php if(isAdmin()): ?>
            <li class="<?php if(isset($_GET['da'])){echo 'active';} ?>">
                <a href="dashboard.php?da">
                     <i class="fa fa-fw fa-dashboard"></i>  Dashboard</a>
            </li>
            <?php endif; ?>
            <li class="<?php if(isset($_GET['post'])){echo 'active';} ?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#post">
                    <i class="fa fa-file-text fa"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="post" class="collapse">
                    <li>
                        <a href="viewpost?post">View Posts</a>
                    </li>
                    <li>
                        <a href="addpost?post">Add Post</a>
                    </li>

                </ul>
            </li>
            <!-- <li>
                        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li> -->
            <!-- <li>
                        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li> -->
            <li class="<?php if(isset($_GET['cat'])){echo 'active';} ?>">
                <a href="addcatagory?cat">
                     <i class="fa fa-list fa"></i> Catagories</a>
            </li>
            <li class="<?php if(isset($_GET['comment'])){echo 'active';} ?>">
                <a href="view_all_comments?comment">
                    <i class="fa fa-comments fa"></i> Comments</a>
            </li>


            <li class="<?php if(isset($_GET['user'])){echo 'active';} ?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#demo">
                   <i class="fa fa-user fa"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="viewuser?user">View Users</a>
                    </li>
                    <li>
                        <a href="adduser?user">Add User</a>
                    </li>
                </ul>
            </li>
            <li class="<?php if(isset($_GET['profile'])){echo 'active';} ?>">
                <a href="profile?profile">
                    <!-- <i class="fa fa-fw fa-file"></i> -->Profile</a>
            </li>
            <!-- <li>
                        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                    </li> -->
        </ul>
    </div>
    <!-- sidebar end -->

</nav>
