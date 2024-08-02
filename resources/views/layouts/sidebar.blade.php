<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
          <ul>
              <li class="{{ Request::is('home') ? 'active' : '' }}">
                  <a href="{{ route('home') }}"><img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="Dashboard"><span> Dashboard</span></a>
              </li>
              <li class="{{ Request::is('products.index') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}"><img src="{{ asset('assets/img/icons/product.svg') }}" alt="Produk"><span> Produk</span> </a>
              </li>
              <li>
                <a href="{{ route('transactions.index') }}"><img src="{{ asset('assets/img/icons/purchase1.svg') }}" alt="Transaksi"><span> Transaksi</span> </a>
              </li>
          </ul>
      </div>
  </div>
</div>
