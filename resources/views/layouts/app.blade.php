<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')

    <body>
        <div id="global-loader">
            <div class="whirly-loader"> </div>
        </div>

        <div class="main-wrapper">
            @include('layouts.navbar')
            @include('layouts.sidebar')

            <div class="page-wrapper">
                <div class="content container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('layouts.script')
        @yield('script')
    </body>

</html>
