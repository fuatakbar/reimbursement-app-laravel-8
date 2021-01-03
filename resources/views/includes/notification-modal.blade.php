@if (Session::get('message') !== null)
    {{-- Modal Notif --}}
    <div class="modal notification fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="notifModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="notifModalTitle">NOTIFICATION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    {{ Session::get('message') }}
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif

@push('addon-script')
    <script type="text/javascript">
        $('#notifModal').modal({
            show: true
        })
    </script>
@endpush