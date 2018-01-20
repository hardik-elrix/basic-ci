<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?= CDN_PATH ?>img/profile_small.jpg"/>
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Admin Person</strong>
                             </span> <span class="text-muted text-xs block">Administrator <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li class="divider"></li>
                        <li><a href="<?=SITEURLADM?>system/logout/?ref=console">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    ADM
                </div>
            </li>
            <li <?= ($current['method'] == 'dashboard' || $current['method'] == 'index') ? 'class="active"' : ""; ?>>
                <a href="<?=SITEURLADM?>console/dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li <?= ($current['method'] == 'users') ? 'class="active"' : ""; ?>>
                <a href="#">
                    <i class="fa fa-user"></i> <span class="nav-label">Users</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li <?= ($current['option'] == 'users-view') ? 'class="active"' : ""; ?>>
                        <a href="<?=SITEURLADM?>console/users/view"><i class="fa fa-list"></i> View</a>
                    </li>
                </ul>
                <ul class="nav nav-second-level">
                    <li <?= ($current['option'] == 'users-add') ? 'class="active"' : ""; ?>>
                        <a href="<?=SITEURLADM?>console/users/add"><i class="fa fa-plus"></i> Add</a>
                    </li>
                </ul>
            </li>
            <li <?= ($current['method'] == 'doctors') ? 'class="active"' : ""; ?>>
                <a href="#">
                    <i class="fa fa-stethoscope"></i> <span class="nav-label">Doctors</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li <?= ($current['option'] == 'doctors-view') ? 'class="active"' : ""; ?>>
                        <a href="<?=SITEURLADM?>console/doctors/view"><i class="fa fa-list"></i> View</a>
                    </li>
                </ul>
                <ul class="nav nav-second-level">
                    <li <?= ($current['option'] == 'doctors-add') ? 'class="active"' : ""; ?>>
                        <a href="<?=SITEURLADM?>console/doctors/add"><i class="fa fa-plus"></i> Add</a>
                    </li>
                </ul>
            </li>
            <li <?= ($current['method'] == 'supplier') ? 'class="active"' : ""; ?>>
                <a href="#">
                    <i class="fa fa-truck"></i> <span class="nav-label">Suppliers</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li <?= ($current['option'] == 'supplier-view') ? 'class="active"' : ""; ?>>
                        <a href="<?=SITEURLADM?>console/supplier/view"><i class="fa fa-list"></i> View</a>
                    </li>
                </ul>
                <ul class="nav nav-second-level">
                    <li <?= ($current['option'] == 'supplier-add') ? 'class="active"' : ""; ?>>
                        <a href="<?=SITEURLADM?>console/supplier/add"><i class="fa fa-plus"></i> Add</a>
                    </li>
                </ul>
            </li>
            <li <?= ($current['method'] == 'jobs') ? 'class="active"' : ""; ?>>
                <a href="#">
                    <i class="fa fa-briefcase"></i> <span class="nav-label">Jobs</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li <?= ($current['option'] == 'jobs-view') ? 'class="active"' : ""; ?>>
                        <a href="<?=SITEURLADM?>console/jobs/view"><i class="fa fa-list"></i> View</a>
                    </li>
                </ul>
            </li>
            <li <?= ($current['method'] == 'product') ? 'class="active"' : ""; ?>>
                <a href="#">
                    <i class="fa fa-cubes"></i> <span class="nav-label">Products</span><span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li <?= ($current['option'] == 'product-view-doc') ? 'class="active"' : ""; ?>>
                        <a href="<?=SITEURLADM?>console/product/Doctor"><i class="fa fa-stethoscope"></i> &nbsp;By Doctor</a>
                    </li>
                </ul>
                <ul class="nav nav-second-level">
                    <li <?= ($current['option'] == 'product-view-sup') ? 'class="active"' : ""; ?>>
                        <a href="<?=SITEURLADM?>console/product/Supplier"><i class="fa fa-truck"></i> By Supplier</a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
</div>