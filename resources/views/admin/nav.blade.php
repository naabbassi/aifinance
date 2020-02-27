        <div class="main-sidebar">
          <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="/dashboard">Admin Panel</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
              <a href="/dashboard">Ad</a>
            </div>
            <ul class="sidebar-menu">
                <li class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}"><a class="nav-link" href="/admin/dashboard"><i class="fas fa-crown"></i></i></i><span>Admin Dashboard</span></a></li>
                <li class="{{ request()->is('/dashboard*') ? 'active' : '' }}"><a class="nav-link" href="/dashboard"><i class="fas fa-user"></i><span>User Dashboard</span></a></li>
                <li class="{{ request()->is('admin/deposit*') ? 'active' : '' }}"><a href="/admin/deposit"><i class="fas fa-money-check-alt"></i> <span>Deposit</span></a></li>
                <li class="{{ request()->is('admin/withdraw*') ? 'active' : '' }}"><a href="/admin/withdraw"><i class="fas fa-money-check-alt"></i> <span>Withdraws</span></a></li>
                <li class="{{ request()->is('admin/users*') ? 'active' : '' }}"><a href="/admin/users"><i class="fas fa-users"></i> <span>Users</span></a></li>
                <li class="{{ request()->is('admin/tickets*') ? 'active' : '' }}"><a href="/admin/tickets"><i class="fas fa-exclamation-circle"></i> <span>Tickets</span></a></li>
                <li class="{{ request()->is('admin/blog*') ? 'active' : '' }}"><a href="/admin/blog"><i class="fas fa-blog"></i> <span>Blog</span></a></li>
                <li class="{{ request()->is('admin/faq*') ? 'active' : '' }}"><a href="/admin/faq"><i class="fas fa-info-circle"></i> <span>Faq</span></a></li>
            </ul>
          </aside>
        </div>