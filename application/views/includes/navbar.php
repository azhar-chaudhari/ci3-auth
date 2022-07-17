  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="dropdown tasks-menu nav-item">
              <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-history"></i>
              </a>

              <ul class="dropdown-menu">
                  <li class="header dropdown-item"> Last Login : <i class="fa fa-clock-o"></i>
                      <?=empty($last_login) ? "First Time Login" : $last_login;?></li>
              </ul>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu nav-item">
              <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <span class="hidden-xs"><?php echo $name; ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right ">
                  <!-- User image -->
                  <li class="card card-widget widget-user">
                      <div class="widget-user-header bg-info">
                          <h3 class="widget-user-username"><?php echo $name; ?></h3>
                          <h5 class="widget-user-desc"><?php echo $role_text; ?></h5>
                      </div>
                      <div class="widget-user-image">
                          <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle elevation-2"
                              alt="User Image" />
                      </div>



                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer0">
                      <a class="dropdown-item" href="<?php echo base_url(); ?>profile"><i class="fa fa-edit"></i>Edit
                          Profile</a>
                      <div class="pull-left">
                          <a href="<?php echo base_url(); ?>loadChangePass" class="dropdown-item"><i
                                  class="fa fa-key"></i>
                              <span>Change
                                  Password</span> </a>
                      </div>
                      <div class="pull-right">
                          <a href="<?php echo base_url(); ?>logout" class="dropdown-item"><i class="fa fa-key"></i>
                              <span>Sign out</span> </a>
                      </div>
                  </li>
              </ul>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>
      </ul>
  </nav>