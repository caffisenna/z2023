@if (auth()->user()->is_admin)
    <p class="uk-text-warning">管理業務</p>
    <li class="nav-item">
        <a href="{{ route('participants.index') }}" class="nav-link {{ Request::is('*participants*') ? 'active' : '' }}">
            <p>参加者リスト</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('/admin/checked_in') }}" class="nav-link {{ Request::is('*admin/checked_in') ? 'active' : '' }}">
            <p>チェックイン済み</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/not_checked_in') }}"
            class="nav-link {{ Request::is('*admin/not_checked_in') ? 'active' : '' }}">
            <p>未チェックイン</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/absent_list') }}"
            class="nav-link {{ Request::is('*admin/absent_list') ? 'active' : '' }}">
            <p>全体会欠席リスト</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/reception_absent_list') }}"
            class="nav-link {{ Request::is('*admin/reception_absent_list') ? 'active' : '' }}">
            <p>交歓会欠席リスト</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/cancel') }}" class="nav-link {{ Request::is('*admin/cancel*') ? 'active' : '' }}">
            <p>取消処理</p>
        </a>
    </li>

    <p class="uk-text-warning">情報</p>
    <li class="nav-item">
        <a href="{{ route('addUsers.index') }}" class="nav-link {{ Request::is('addUsers*') ? 'active' : '' }}">
            <p>アカウント作成</p>
        </a>
    </li>

    <p class="uk-text-warning">メール送信</p>
    <li class="nav-item">
        <a href="{{ url('/admin/sendmail') }}" class="nav-link {{ Request::is('*sendmail') ? 'active' : '' }}">
            <p>デジパス送信(個別)</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/sendmail_pref') }}"
            class="nav-link {{ Request::is('*sendmail_pref') ? 'active' : '' }}">
            <p>デジパス送信(県連単位)</p>
        </a>
    </li>
@endif

@if (auth()->user()->is_staff)
    <p class="uk-text-warning">業務</p>
    <li class="nav-item">
        <a href="{{ url('/s/check_in/input') }}"
            class="nav-link {{ Request::is('/s/check_in/input*') ? 'active' : '' }}">
            <p>チェックイン</p>
        </a>
    </li>
@endif
