        <div class="main-sidebar">
          <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="/dashboard">Admin Panel</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
              <a href="/dashboard">Ad</a>
            </div>
            <ul class="sidebar-menu">
                <li class="{{ request()->is('dashboard*') ? 'active' : '' }}"><a class="nav-link" href="/dashboard"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
                <li class="{{ request()->is('deposit*') ? 'active' : '' }}"><a href="/admin/deposit"><i class="fas fa-money-check-alt"></i> <span>Deposit</span></a></li>
                <li class="{{ request()->is('users*') ? 'active' : '' }}"><a href="/admin/users"><i class="fas fa-users"></i> <span>Users</span></a></li>
                <li class="{{ request()->is('tickets*') ? 'active' : '' }}"><a href="/admin/tickets"><i class="fas fa-exclamation-circle"></i> <span>Tickets</span></a></li>
                <li class="{{ request()->is('faq*') ? 'active' : '' }}"><a href="/admin/faq"><i class="far fa-question-circle"></i> <span>Faq</span></a></li>
            </ul>
          </aside>
        </div>