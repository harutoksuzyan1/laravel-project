@extends ('layouts.app')

@section ('content')
    <div id="panel" class="m-t-50">

        <!-- Nav tabs <div id="rootwizard" class="m-t-50"> -->
        <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm">
            <li class="active">
                <a data-toggle="tab" href="#tab1"><i class="fa fa-briefcase"></i> <span>Service</span></a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#tab2"><i class="fa fa-clock-o"></i> <span>Staff</span></a>
            </li>
            <!--     <li class="">
                  <a data-toggle="tab" href="#tab3"><i class="fa fa-cogs"></i> <span>Settings</span></a>
                </li>  -->
            <li class="">
                <a data-toggle="tab" href="#tab4"><i class="fa fa-bar-chart"></i> <span>Statistics</span></a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <!-- SERVICE TAB -->
        @include ('app.services.profile.service')

        <!-- STAFF TAB -->
        @include ('app.services.profile.staff')

        <!-- SETTINGS TAB -->
        @include ('app.services.profile.settings')

        <!-- STATISTICS TAB -->
            @include ('app.services.profile.statistics')
        </div>
    </div>
@endsection

@section ('scripts')
    <script src="{{ asset('assets/plugins/switchery/js/switchery.min.js') }}"></script>
    <script src="{{ asset('pages/js/pages.min.js') }}"></script>
@endsection