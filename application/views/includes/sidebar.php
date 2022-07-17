          <!-- Main Sidebar Container -->
          <aside class="main-sidebar sidebar-dark-primary elevation-4">
              <!-- Brand Logo -->
              <a href="<?php echo base_url(); ?>" class="brand-link">
                  <img src="<?php echo base_url(); ?>assets/dist/img/AdminLTELogo.png"
                      alt="<?php echo $this->config->item('web_app_name'); ?>"
                      class="brand-image img-circle elevation-3" style="opacity: .8">
                  <span class="brand-text font-weight-light"><?php echo $this->config->item('web_app_name'); ?></span>
              </a>

              <!-- Sidebar -->
              <div class="sidebar">

                  <!-- SidebarSearch Form -->
                  <div class="form-inline">
                      <div class="input-group" data-widget="sidebar-search">
                          <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                              aria-label="Search">
                          <div class="input-group-append">
                              <button class="btn btn-sidebar">
                                  <i class="fas fa-search fa-fw"></i>
                              </button>
                          </div>
                      </div>
                  </div>

                  <!-- Sidebar Menu -->
                  <nav class="mt-2">
                      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                          data-accordion="false">
                          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                          <li class="nav-item">
                              <a href="<?php echo base_url() . "dashboard"; ?>" class="nav-link">
                                  <i class="nav-icon fas fa-tachometer-alt"></i>
                                  <p>
                                      Dashboard
                                  </p>
                              </a>
                          </li>
                          <?php

if ($role == ROLE_ADMIN) {
    ?>




                          <li class="nav-item">
                              <a href="<?php echo base_url() . "user"; ?>" class="nav-link">
                                  <i class="nav-icon fas fa-address-book fa-fw"></i>
                                  <p>
                                      Users
                                  </p>
                              </a>
                          </li>

                          <?php
}
?>
                          <li class="nav-item">
                              <a href="<?php echo base_url() . "task"; ?>" class="nav-link">
                                  <i class="nav-icon fas fa-copy"></i>
                                  <p>
                                      Tasks
                                  </p>
                              </a>
                          </li>

                      </ul>
                  </nav>
                  <!-- /.sidebar-menu -->
              </div>
              <!-- /.sidebar -->
          </aside>