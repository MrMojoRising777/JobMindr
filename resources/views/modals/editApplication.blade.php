<div class="modal" id="applicationModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('applications.update', ['application' => $application]) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="application_id" value="{{ $application->id }}" required>

                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit Application</h1>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <select class="form-control" name="status">
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" @if($application->status == $status) selected @endif>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3 @if($status != 'rejected') d-none @endif" id="reason-container">
                        <div class="col-12">
                            <select name="reason" class="form-control">
                                <option value="" selected disabled>What was the reason?</option>
                                @foreach($reasons as $reason)
                                    <option value="{{ $reason }}" @if (old('reason', $application->reason?->value) === $reason->value) selected @endif>{{ $reason->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                       <div class="col-12">
                           <label>Note</label>
                           <div id="quillContent">
                               {!! $application->notes !!}
                           </div>
                           <input type="hidden" name="notes" id="quillInput">
                       </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-pen"></i>
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            function toggleReasonSelect() {
                const status = $('select[name="status"]').val();

                if (status === 'rejected') {
                    $('#reason-container').removeClass('d-none');
                } else {
                    $('#reason-container').addClass('d-none');
                    $('#reason-container select').val('');
                }
            }

            toggleReasonSelect();

            $('select[name="status"]').on('change', toggleReasonSelect);
        });
    </script>
@endpush
