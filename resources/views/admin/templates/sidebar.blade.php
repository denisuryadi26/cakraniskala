<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <!-- <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Brawijaya</span>
        </a> -->

        <a href="{{route('dashboard')}}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img class="" alt="logo" style="width: 40px !important; height: 40px !important;" src="{{ (!empty($setting['logo_icon']) ? asset('upload/'.$setting['logo_icon']) : asset('vuexy/assets/img/logo-sm-dark-cn.png')) }}">
            </span>
            <span class="app-brand-text demo menu-text fw-bold" style="font-size: 15px;">{{ ($setting['app_name_short'] ? $setting['app_name_short'] : '') }}</span>
        </a>


        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    @php
    $activeMenu = $menu['breadcrumbs'];
    @endphp
    <ul class="menu-inner py-1">
        @foreach($menu['parentMenu'] as $item => $value)

        @if($value->is_showed)


        @foreach($value->access as $val)
        @if ($val->id == \Illuminate\Support\Facades\Auth::user()->group_id)
        @if($val->pivot->is_viewable == true)

        @if($value->childs->isEmpty())
        <!-- Dashboards -->

        <li class="menu-item {{($value->name == $activeMenu->name ? 'active open' : '')}}">
            <a class="menu-link" href="{{route("$value->route_name")}}">
                <i class="menu-icon tf-icons ti {{$value->icon}}"></i>
                <div data-i18n="{{$value->name}}">{{$value->name}}</div>
            </a>
        </li>

        @else
        <li class="menu-item {{(isset($activeMenu->parent) ? ($value->name == $activeMenu->parent->name ? 'active open' : ''):'')}}">
            <a href="#{{$value->code}}" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti {{$value->icon}}"></i>
                <div data-i18n="{{$value->name}}">{{$value->name}}</div>
            </a>

            <ul class="menu-sub">

                @foreach($value->childs as $key => $sub)
                @foreach($sub->access as $key => $subaccess)
                @if($subaccess->count() > 0)
                @if($subaccess->id == \Illuminate\Support\Facades\Auth::user()->group_id && $subaccess->pivot->is_viewable == true)
                <li class="menu-item {{$sub->name == $activeMenu->name ? 'active' : ''}}">
                    <a class="menu-link" href="{{route("$sub->route_name")}}">
                        <i class="menu-icon tf-icons ti ti-menu-2"></i>
                        <div>{{$sub->name}}</div>
                    </a>
                </li>
                @endif
                @endif
                @endforeach
                @endforeach
            </ul>
        </li>
        @endif

        @endif
        @endif
        @endforeach

        @endif
        @endforeach
    </ul>
</aside>