        <div class="main-sidebar">
          <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="/dashboard">AI Finance</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
              <a href="/dashboard">AIF</a>
            </div>
            <ul class="sidebar-menu">
                  <li class="{{ request()->is('dashboard*') ? 'active' : '' }}"><a class="nav-link" href="/dashboard"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
              <li class="menu-header">Finance</li>
              <li class="dropdown {{ request()->is('finance*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-coins"></i> <span>My Finance</span></a>
                <ul class="dropdown-menu">
                  <li class="{{ request()->is('finance/history*') ? 'active' : '' }}"><a class="nav-link" href="/finance/history"><i class="fas fa-history"> </i>History</a></li>
                  <li class="{{ request()->is('finance/wallet*') ? 'active' : '' }}"><a class="nav-link" href="/finance/wallet"><i class="fas fa-wallet"> </i>My Wallets</a></li>
                  <li class="{{ request()->is('finance/withdraw*') ? 'active' : '' }}"><a class="nav-link" href="/finance/withdraw"><i class="fas fa-money-bill-wave"> </i>Withdraw</a></li>
                  <li class="{{ request()->is('finance/reports*') ? 'active' : '' }}"><a class="nav-link " href="/finance/reports"><i class="fas fa-chart-bar"> </i>Reports</a></li>
                </ul>
              </li>
            <li class="{{ request()->is('deposit*') ? 'active' : '' }}"><a href="/deposit"><i class="fas fa-money-check-alt"></i> <span>Deposit</span></a></li>
              <li class="{{ request()->is('network*') ? 'active' : '' }}"><a href="/network"><i class="fas fa-network-wired"></i> <span>My Network</span></a></li>
              <li class="{{ request()->is('loan*') ? 'active' : '' }}"><a href="/loan"><i class="fas fa-landmark"></i> <span>Loan</span></a></li>
            </ul>
            <div class="p-3 mt-4 mb-4 hide-sidebar-mini">
              <a href="/faq" class="btn btn-outline-info btn-lg btn-icon-split btn-block"><i class="far fa-question-circle"></i> <div>FAQ</div>
                <a href="/downloads" class="btn btn-outline-dark btn-lg btn-icon-split btn-block"><i class="fas fa-file-download"></i> <div>Downloads</div>
              </a>
            </div>
          </aside>
        </div>