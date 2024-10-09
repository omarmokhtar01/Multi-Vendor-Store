<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach ($items as $item)
            <li class="nav-item">
                <a href="{{ route($item['route']) }}" class="nav-link {{ Route::is($item['active'] ?? '') ? 'active' : '' }}">
                    <i class="{{ $item['icon'] }} nav-icon fas fa-th"></i>
                    <p>
                        {{ $item['title'] }}
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>
        @endforeach
    </ul>
</nav>
