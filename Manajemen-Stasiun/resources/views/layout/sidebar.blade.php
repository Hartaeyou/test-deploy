<aside id="sidebar">
    <div class="d-flex justify-content-center align-items-center pb-1">
        <a href="#" class="btn fw-bold sidebar-logo-short" id="toggle-btn">
            MS
        </a>
        <div class="sidebar-logo text-center">
            <a href="/dashboardUser" id="sidebar-title">Manajemen Stasiun</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="/showStasiun" class="sidebar-link">
                <img src="{{ URL('img/icon/Vector.svg') }}" alt="">
                <span>Stasiun</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="/rute" class="sidebar-link">
                <i class="fa-solid fa-route"></i>
                <span>Rute</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="/kereta" class="sidebar-link">
                <i class="fa-solid fa-train"></i>
                <span>Kereta</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <a href="/logout" class="sidebar-link">
            <img src="{{ URL('img/icon/Logout.svg') }}" alt="">
            <span>LogOut</span>
        </a>
    </div>
</aside>
