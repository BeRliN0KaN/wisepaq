<div id="wrapper">
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><b>WISEPAQ</b><span style="font-size: 18px;">admin</span></a>
        <!-- <a class="navbar-brand" href="index.php">WISEPAQ  <small><?php echo $_SESSION['username'] ?></small></a> -->
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a href="../../index.php">Website</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle"  data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username'] ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a  href="profile.php"><i class="fa fa-fw fa-user "></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../includes_admin/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a style="padding-left: 22px;" href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a style="padding-left: 21px;" href="javascript:;" data-toggle="collapse" data-target="#posts-dropdown">
                    <i class="fa fa-table"></i> Posts <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="posts-dropdown" class="collapse">
                    <li>
                        <a href="posts.php?source=add_post">Add Post</a>
                    </li>
                    <li>
                        <a href="posts.php">View Posts</a>
                    </li>
                </ul>
            </li>
            <li>
                <a style="padding-left: 21px;" href="categories.php">
                    <i class="fa fa-folder"></i> Categories
                </a>
            </li>

            <li>
                <a style="padding-left:22px;" href="javascript:;" data-toggle="collapse" data-target="#users-dropdown">
                    <i class="fa fa-user"></i> Users <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="users-dropdown" class="collapse">
                    <li>
                        <a href="users.php?source=add_user">Add User</a>
                    </li>
                    <li>
                        <a href="users.php">View Users</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>