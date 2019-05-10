@component('layouts.header')
    @slot('title')
        @yield('title')
    @endslot
@endcomponent
<div class="container-fluid">
    @yield('main')
</div>

<div class="modal fade" role="dialog" id="confirmation-modal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content border-primary">
            <div class="modal-header text-primary text-center">
                <h4 class="modal-title font-weight-bold"></h4>
            </div>
            <div class="modal-body text-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success btn-proceed">Proceed</button>
            </div>
        </div>
    </div>
</div>

@yield('scripts')
@include('layouts.footer')