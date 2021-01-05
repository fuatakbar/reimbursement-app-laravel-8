@if (isset($must_fill_bank) && $must_fill_bank == true)
    {{-- Modal Notif --}}
    <div class="modal notification fade" id="notifModal" tabindex="-1" role="dialog" aria-labelledby="notifModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{route('user.add.bank')}}" method="post">
                @csrf
                @method('POST')
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Bank Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                        </div>
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="account_number">Account Number</label>
                                    <input class="form-control" type="text" name="account_number" id="account_number" required min="7" max='30'>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="bank_code">Bank Code</label>
                                    <input class="form-control" type="text" name="bank_code" id="bank_code" required min="2" max='5'>
                                </div>
                            </div>
    
                        <div class="modal-footer">
                        <button type="button" class="btn btn-grey" data-dismiss="modal">
                            Close</button>
                        <button type="submit" class="btn btn-secondary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif