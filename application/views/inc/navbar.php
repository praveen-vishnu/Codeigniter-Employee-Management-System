      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <?php if($this->session->userdata('username') !== NULL): ?>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            <?php endif; ?>
            <a class="navbar-brand" href="<?= site_url(); ?>"><?= $project_name; ?></a>
          </div>

          <?php if($this->session->userdata('username') !== NULL): ?>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="<?= site_url(); ?>">Home</a></li>
              <li><a href="<?= site_url(); ?>/employee">Employees</a></li>
              <li><a href="<?= site_url(); ?>/leaverequests">Leave Requests</a></li>
              <li><a href="<?= site_url(); ?>/workhours_list">Work Hours List</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href=""><?= $this->session->userdata('username') ?></a></li>
              <li><a href="<?= site_url(); ?>/logout">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
          <?php endif; ?>
        </div><!--/.container-fluid -->
      </nav>