    <nav id="myNavbar" class="navbar navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="<?= site_url(); ?>">Home</a></li>
            <li class="dropdown">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle">Leave Requests <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?= site_url(); ?>req_leave ">Request Leave</a></li>
                <li class="divider"></li>
                <li><a href="leaveapproved">Approved</a></li>
                <li class="divider"></li>
                <li><a href="<?= site_url();?>/leavepending">Pending</a></li>
                <li class="divider"></li>
                <li><a href="leavecancelled">Cancelled</a></li>
                <li class="divider"></li>
                <li><a href="leavehistory">History</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle"><?= $this->session->userdata('username')?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
             
              <li><a href="<?= site_url(); ?>/logout">Logout</a></li>
                </ul>
              </li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div>
      </nav>
