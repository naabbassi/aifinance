        <div class="main-sidebar">
          <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="/dashboard">Admin Panel</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
              <a href="/dashboard">Admin</a>
            </div>
            <ul class="sidebar-menu">
                  <li class="{{ request()->is('dashboard*') ? 'active' : '' }}"><a class="nav-link" href="/dashboard"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
              <li class="menu-header">Finance</li>
              <li class="dropdown {{ request()->is('finance*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-coins"></i> <span>My Finance</span></a>
                <ul class="dropdown-menu">
                  <li class="{{ request()->is('finance/wallet*') ? 'active' : '' }}"><a class="nav-link" href="/finance/wallet"><i class="fas fa-wallet"> </i>My Wallets</a></li>
                  <li class="{{ request()->is('finance/revenue*') ? 'active' : '' }}"><a class="nav-link" href="/finance/revenue"><i class="fas fa-money-check-alt"></i>Revenue</a></li>
                  <li class="{{ request()->is('finance/withdraw*') ? 'active' : '' }}"><a class="nav-link" href="/finance/withdraw"><i class="fas fa-money-bill-wave"> </i>Withdraw</a></li>
                  <li class="{{ request()->is('finance/history*') ? 'active' : '' }}"><a class="nav-link" href="/finance/history"><i class="fas fa-history"> </i>History</a></li>
                  <li class="{{ request()->is('finance/reports*') ? 'active' : '' }}"><a class="nav-link " href="/finance/reports"><i class="fas fa-chart-bar"> </i>Reports</a></li>
                </ul>
              </li>
            <li class="{{ request()->is('deposit*') ? 'active' : '' }}"><a href="/admin/deposit"><i class="fas fa-money-check-alt"></i> <span>Deposit</span></a></li>
            <li class="{{ request()->is('users*') ? 'active' : '' }}"><a href="/admin/users"><i class="fas fa-users"></i> <span>Users</span></a></li>
            <li class="{{ request()->is('tickets*') ? 'active' : '' }}"><a href="/admin/tickets"><i class="fas fa-ticket-alt"></i> <span>Tickets</span></a></li>
            </ul>
          </aside>
        </div>