
 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="index.php">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="categories.php">
      <i class="bi bi-folder"></i>
      <span>Categories</span>
    </a>
  </li><!-- End Profile Page Nav -->
  <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="users-profile.html">
      <i class="bi bi-person"></i>
      <span>Categories Project</span>
    </a>
  </li>End Profile Page Nav -->


  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#activity-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-file-earmark-text"></i><span>Activity</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="activity-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="activity.php?source=add_activity">
          <i class="bi bi-circle"></i><span>Add Activity</span>
        </a>
      </li>
      <li>
        <a href="activity.php">
          <i class="bi bi-circle"></i><span>View Activity</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#post" data-bs-toggle="collapse" href="#">
      <i class="bi bi-file-earmark-text"></i><span>Post</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="post" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="posts.php?source=add_post">
          <i class="bi bi-circle"></i><span>Add Post</span>
        </a>
      </li>
      <li>
        <a href="posts.php">
          <i class="bi bi-circle"></i><span>View Post</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav -->
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="user-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="users.php?source=add_user">
          <i class="bi bi-circle"></i><span>Add User</span>
        </a>
      </li>
      <li>
        <a href="users.php">
          <i class="bi bi-circle"></i><span>View Users</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav -->

</ul>

</aside>