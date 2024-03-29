  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <span class="brand-link">
      <img src="../public/assets/dist/img/logo.jpg" alt="Logo Naval" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-bold">Naval Services</span>
</span>

    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 860px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../public/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <span class="text-light"><?php echo $name . " " . $lastName; ?></span>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div><div class="sidebar-search-results"><div class="list-group"><a href="#" class="list-group-item"><div class="search-title"><strong class="text-light"></strong>N<strong class="text-light"></strong>o<strong class="text-light"></strong> <strong class="text-light"></strong>e<strong class="text-light"></strong>l<strong class="text-light"></strong>e<strong class="text-light"></strong>m<strong class="text-light"></strong>e<strong class="text-light"></strong>n<strong class="text-light"></strong>t<strong class="text-light"></strong> <strong class="text-light"></strong>f<strong class="text-light"></strong>o<strong class="text-light"></strong>u<strong class="text-light"></strong>n<strong class="text-light"></strong>d<strong class="text-light"></strong>!<strong class="text-light"></strong></div><div class="search-path"></div></a></div></div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/dashboard" class="nav-link">
              <i class="fas fa-home nav-icon"></i>
              <p><?php echo $this->lang->line('dashboard'); ?></p>
            </a>
          </li>
          <?php if ($session['mShipowner']) { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-anchor"></i>
              <p>
              <?php echo $this->lang->line('control_shipowner'); ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($session['addShipowner']) { ?>
              <li class="nav-item">
                <a href="/formShipowner" class="nav-link">
                <i class="fas fa-plus-circle"></i>
                  <p><?php echo $this->lang->line('add_shipowner'); ?></p>
                </a>
              </li>
              <?php } ?>
              <?php if ($session['listShipowner']) { ?>
              <li class="nav-item">
                <a href="/listShipowner" class="nav-link">
                  <i class="fas fa-list-ul"></i>
                  <p><?php echo $this->lang->line('list_shipowner'); ?></p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php if ($session['mNavio']) { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-anchor"></i>
              <p>
              <?php echo $this->lang->line('control_boats'); ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($session['addNavio']) { ?>
              <li class="nav-item">
                <a href="/formBoat" class="nav-link">
                <i class="fas fa-plus-circle"></i>
                  <p><?php echo $this->lang->line('add_boats'); ?></p>
                </a>
              </li>
              <?php } ?>
              <?php if ($session['listNavio']) { ?>
              <li class="nav-item">
                <a href="/listBoats" class="nav-link">
                  <i class="fas fa-list-ul"></i>
                  <p><?php echo $this->lang->line('list_boats'); ?></p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php if ($session['mOrder']) { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon far fa-file-alt"></i>
              <p>
                <?php echo $this->lang->line('control_orders'); ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if ($session['addOrder']) { ?>
              <li class="nav-item">
                <a href="/formOrder" class="nav-link">
                <i class="fas fa-plus-circle"></i>
                  <p><?php echo $this->lang->line('add_orders'); ?></p>
                </a>
              </li>
              <?php } ?>
              <?php if ($session['listOrder']) { ?>
              <li class="nav-item">
                <a href="/listOrders" class="nav-link">
                  <i class="fas fa-list-ul"></i>
                  <p><?php echo $this->lang->line('list_orders'); ?></p>
                </a>
              </li>
              <?php } ?>
              <?php if ($session['validOrder']) { ?>
              <li class="nav-item">
                <a href="/checkOrders" class="nav-link">
                <i class="fas fa-check"></i>
                <p><?php echo $this->lang->line('check_orders'); ?></p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>

          <?php if ($session['mCert']) { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-award"></i>
              <p>
                <?php echo $this->lang->line('control_certs'); ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($session['listCert']) { ?>
              <li class="nav-item">
                <a href="/listCerts" class="nav-link">
                  <i class="fas fa-list-ul"></i>
                  <p><?php echo $this->lang->line('list_certs'); ?></p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>

          <?php if ($session['mUser']) { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>
                <?php echo $this->lang->line('control_users'); ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if ($session['addUser']) { ?>
              <li class="nav-item">
                <a href="/formUsers" class="nav-link">
                <i class="fas fa-plus-circle"></i>
                <p><?php echo $this->lang->line('add_users'); ?></p>
                </a>
              </li>
              <?php } ?>
              <?php if ($session['listUser']) { ?>
              <li class="nav-item">
                <a href="/listUsers" class="nav-link">
                  <i class="fas fa-list-ul"></i>
                  <p><?php echo $this->lang->line('list_users'); ?></p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php if ($session['mEmployee']) { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
              <?php echo $this->lang->line('control_employees'); ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($session['addEmployee']) { ?>
              <li class="nav-item">
                <a href="/formEmployee" class="nav-link">
                <i class="fas fa-plus-circle"></i>
                  <p><?php echo $this->lang->line('add_employees'); ?></p>
                </a>
              </li>
              <?php } ?>
              <?php if ($session['listEmployee']) { ?>
              <li class="nav-item">
                <a href="/listEmployee" class="nav-link">
                  <i class="fas fa-list-ul"></i>
                  <p><?php echo $this->lang->line('list_employees'); ?></p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php if ($session['mConfig']) { ?>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-cogs"></i>
              <p>
              <?php echo $this->lang->line('configuration'); ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if ($session['business']) { ?>
              <li class="nav-item">
                <a href="/listBusiness" class="nav-link">
                <i class="fas fa-building"></i>
                  <p><?php echo $this->lang->line('business'); ?></p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 58.3517%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
    <!-- /.sidebar -->
  </aside>
