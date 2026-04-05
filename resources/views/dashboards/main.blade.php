@if(auth()->user()->role === 'admin')
    @include('dashboards.admin')
@else
    @include('dashboards.user')
@endif
