<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="navbar-brand d-flex align-items-center justify-content-center" href="http://localhost:8080/home/beranda">
        <img src="<?= base_url('images/' . (isset($jes[0]->logo) ? $jes[0]->logo : 'default_logo.png')) ?>" alt="Logo" style="width: 60px; height: 60px; object-fit: cover;" >

      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="http://localhost:8080/home/beranda">
          <i class="fas fa-fw fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">Calculator Section</div>

      

        
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('home/posts/'.session()->get('id_user'))?>">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Calculator</span>
          </a>
        </li>




        <hr class="sidebar-divider">
        <div class="sidebar-heading">Users Settings</div>

        <li class="nav-item">
        <a class="nav-link" href="<?=base_url('home/profile/'.session()->get('id_user'))?>">
          <i class="fas fa-fw fa-user"></i>
          <span>User Profile</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('home/logout')?>">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Log Out</span>
        </a>
      </li>
      <!-- Admin-specific Links -->
      <?php if(session()->get('level') == 2): ?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">Admin Sections</div>

        <li class="nav-item">
          <a class="nav-link" href="http://localhost:8080/home/setting">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Setting</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost:8080/home/user">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Users</span>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="http://localhost:8080/home/restore">
            <i class="fas fa-fw fa-edit"></i>
            <span>Restore Data</span>
          </a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="http://localhost:8080/home/activity_log">
            <i class="fas fa-fw fa-history"></i>
            <span>Activity Log</span>
          </a>
        </li>
      <?php endif; ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- End of Sidebar -->
    
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <img src="<?= base_url('img/' . session()->get('foto')) ?>" 
         alt="User Photo" 
         class="rounded-circle" 
         style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px;">
    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hi, <?= session()->get('username') ?>!</span>
  </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?=base_url('home/profile/'.session()->get('id_user'))?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="<?=base_url('home/logout')?>">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>




<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
