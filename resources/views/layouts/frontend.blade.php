<!doctype html>
<html lang="{{ config('app.locale') }}">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App Name - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- Alert Toastre --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="css/app.css">

    @livewireStyles
    @yield('css_before')
</head>

<body>
    <div class="b-example-divider"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top" aria-label="Main navigation">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link link-dark px-2 active"
                            aria-current="page">{{ __('messages.HOME') }}</a></li>
                    <li class="nav-item"><a href="{{ url('/posts') }}"
                            class="nav-link link-dark px-2">{{ __('messages.ARTICLE') }}</a></li>
                    @auth
                        @if (Auth::user()->role === 1 || Auth::user()->role === 2)
                            <li class="nav-item"><a href="{{ url('/category') }}"
                                    class="nav-link link-dark px-2">{{ __('messages.CATEGORY') }}</a>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item"><a href="{{ route('roles.index') }}"
                            class="nav-link link-dark px-2">{{ __('messages.ROLE-MANAGEMENT') }}</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('users.index') }}"
                            class="nav-link link-dark px-2">{{ __('messages.USERS-MANAGEMENT') }}</a></li>
                    <li class="nav-item"><a href="{{ url('/products') }}"
                            class="nav-link link-dark px-2">{{ __('messages.PRODUCT') }}</a>
                    </li>
                    <li class="nav-item"><a href="{{ url('/aboute') }}"
                            class="nav-link link-dark px-2">{{ __('messages.ABOUTE') }}</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a href="{{ route('login') }}"
                                    class="nav-link link-dark px-2">{{ __('messages.LOGIN') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}"
                                    class="nav-link link-dark px-2">{{ __('messages.REGISTER') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                v-pre>{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ออกจากระบบ</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <li>
                        <select class="form-control changeLang">
                            <option value="th" {{ session()->get('locale') === 'th' ? 'selected' : '' }}>ภาษาไทย
                            </option>
                            <option value="en" {{ session()->get('locale') === 'en' ? 'selected' : '' }}>English
                            </option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        @yield('content')
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

{{-- Alert Toastre --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@if (Session::has('success'))
    <script>
        toastr.success(('{{ Session::get('success') }}'))
    </script>
@endif

{{-- Alert Sweet --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (Session::has('success'))
    <script>
        Swal.fire({
            title: "แจ้งเตือนทำรายการ",
            text: "บันทึกข้อมูลเรียบร้อย",
            icon: "success"
        });
    </script>
@elseif (Session::has('error'))
    <script>
        Swal.fire({
            title: "แจ้งเตือนทำรายการ",
            text: "ลบข้อมูลเรียบร้อย",
            icon: "error"
        });
    </script>
@endif --}}

<script type="text/javascript">
    var url = "{{ route('changeLang') }}";
    $(".changeLang").change(function() {
        window.location.href = url + "?lang=" + $(this).val();
    });
    console.log(url)
</script>

@livewireScripts

@yield('js_before')

</html>
