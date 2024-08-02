<!DOCTYPE html>
<html lang="en">
    @include('layouts.head')

    <body class="account-page">
        <div id="global-loader">
            <div class="whirly-loader"> </div>
        </div>

        <div class="main-wrapper">
            <div class="account-content">
                <div class="account-content">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('layouts.script')
    </body>

</html>
