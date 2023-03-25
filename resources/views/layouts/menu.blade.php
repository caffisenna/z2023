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
            <p>式典欠席</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/reception_absent_list') }}"
            class="nav-link {{ Request::is('*admin/reception_absent_list') ? 'active' : '' }}">
            <p>レセプション欠席</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/cancel') }}" class="nav-link {{ Request::is('*admin/cancel*') ? 'active' : '' }}">
            <p>取消処理</p>
        </a>
    </li>
    <p class="uk-text-warning">座席情報</p>
    <li class="nav-item">
        <a href="{{ url('/admin/seat_number') }}"
            class="nav-link {{ Request::is('*/seat_number*') ? 'active' : '' }}">
            <p>式典座席</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ url('/admin/reception_seat_number') }}"
            class="nav-link {{ Request::is('*/reception_seat_number*') ? 'active' : '' }}">
            <p>レセプション座席</p>
        </a>
    </li>

    <li class="nav-item"><a href="https://colab.research.google.com/drive/1sQGFqa_sSCydO8O_p3htjDGU53wUJ8K6?usp=sharing"
            class="nav-link" target="_blank">隣接シート特定<span uk-icon="icon: google"></span></a>
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

    <p class="uk-text-warning">参加費</p>
    <li class="nav-item">
        <a href="{{ url('/admin/fee_check') }}"
            class="nav-link {{ Request::is('*admin/fee_check*') ? 'active' : '' }}">
            <p>レセプション参加費</p>
        </a>
    </li>

    <p class="uk-text-warning">情報</p>
    <li class="nav-item">
        <a href="{{ route('admin_staffinfos.index') }}"
            class="nav-link {{ Request::is('*admin_staffinfos*') ? 'active' : '' }}">
            <p>スタッフ情報</p>
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
    <li class="nav-item">
        <a href="{{ url('/s/absent/input') }}" class="nav-link {{ Request::is('/s/absent*') ? 'active' : '' }}">
            <p>通常欠席</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/s/fever_absent/input') }}"
            class="nav-link {{ Request::is('/s/fever_absent*') ? 'active' : '' }}">
            <p>発熱欠席</p>
        </a>
    </li>
    {{-- <li class="nav-item">
        <a href="{{ url('/s/cancel') }}" class="nav-link {{ Request::is('/s/cancel*') ? 'active' : '' }}">
            <p>取消処理</p>
        </a>
    </li> --}}
    <p class="uk-text-warning">情報</p>
    <li class="nav-item">
        <a href="{{ route('staffinfos.index') }}" class="nav-link {{ Request::is('staffinfos*') ? 'active' : '' }}">
            <p>スタッフ情報</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/s/digipass') }}"
            class="nav-link {{ Request::is('/s/digipass*') ? 'active' : '' }}">
            <p>デジタルパス</p>
        </a>
    </li>
@endif

@if (auth()->user()->is_pref)
    <p class="uk-text-warning">参加者</p>
    <li class="nav-item">
        {{-- <a href="{{ route('participants.index') }}" class="nav-link {{ Request::is('participants*') ? 'active' : '' }}"> --}}
        <a href="{{ url('pref/pref_participants') }}"
            class="nav-link {{ Request::is('pref_participants*') ? 'active' : '' }}">
            <p>県連代表</p>
        </a>
    </li>
@endif

{{-- <p class="uk-text-warning">マイページ</p>
<li class="nav-item">
    <a href="{{ url('') }}"
       class="nav-link {{ Request::is('/s/check_in/input*') ? 'active' : '' }}">
        <p>マイページ</p>
    </a>
</li>
 --}}
