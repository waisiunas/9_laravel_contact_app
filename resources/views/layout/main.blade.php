<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body>
    <div class="wrapper">
        @include('partials.sidebar')

        <div class="main">
            @include('partials.topbar')

            <main class="content">
                @yield('content')
            </main>

            @include('partials.footer')
        </div>
    </div>

    @include('partials.scripts')

</body>

</html>
