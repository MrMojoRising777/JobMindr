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

                    <hr class="hr" />

                    <div class="row mt-3">
                        <div class="col-5">
                            <div class="input-group">
                                <span class="input-group-text">Min</span>
                                <input type="number" name="application[properties][salary_range][min]" class="form-control" placeholder="3000"
                                       value="{{ $application->properties['salary_range']['min'] ?? '' }}" min="0" step="100">
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="input-group">
                                <span class="input-group-text">Max</span>
                                <input type="number" name="application[properties][salary_range][max]" class="form-control" placeholder="4000"
                                       value="{{ $application->properties['salary_range']['min'] ?? '' }}" min="0" step="100">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-5">
                            <select name="application[properties][job_type]" class="form-control">
                                <option value="">Job Type</option>
                                <option value="full-time" {{ ($application->properties['job_type'] ?? '') === 'full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="part-time" {{ ($application->properties['job_type'] ?? '') === 'part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="contract" {{ ($application->properties['job_type'] ?? '') === 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="internship" {{ ($application->properties['job_type'] ?? '') === 'internship' ? 'selected' : '' }}>Internship</option>
                            </select>
                        </div>

                        <div class="col-5">
                            <select name="application[properties][work_location]" class="form-control">
                                <option value="">Work Location</option>
                                <option value="on-site" {{ ($application->properties['work_location'] ?? '') === 'on-site' ? 'selected' : '' }}>On-site</option>
                                <option value="remote" {{ ($application->properties['work_location'] ?? '') === 'remote' ? 'selected' : '' }}>Remote</option>
                                <option value="hybrid" {{ ($application->properties['work_location'] ?? '') === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-5">
                            <select name="application[properties][experience_level]" class="form-control">
                                <option value="">Experience Level</option>
                                <option value="junior" {{ ($application->properties['experience_level'] ?? '') === 'junior' ? 'selected' : '' }}>Junior</option>
                                <option value="medior" {{ ($application->properties['experience_level'] ?? '') === 'medior' ? 'selected' : '' }}>Medior (3–5 years)</option>
                                <option value="senior" {{ ($application->properties['experience_level'] ?? '') === 'senior' ? 'selected' : '' }}>Senior (5–7 years)</option>
                                <option value="lead" {{ ($application->properties['experience_level'] ?? '') === 'lead' ? 'selected' : '' }}>Lead (7+ years)</option>
                                <option value="none" {{ ($application->properties['experience_level'] ?? '') === 'none' ? 'selected' : '' }}>None required</option>
                            </select>
                        </div>

                        <div class="col-5">
                            <select name="application[properties][education_level]" class="form-control">
                                <option value="">Education Level</option>
                                <option value="high_school" {{ ($application->properties['education_level'] ?? '') === 'high_school' ? 'selected' : '' }}>High School</option>
                                <option value="bachelor" {{ ($application->properties['education_level'] ?? '') === 'bachelor' ? 'selected' : '' }}>Bachelor</option>
                                <option value="master" {{ ($application->properties['education_level'] ?? '') === 'master' ? 'selected' : '' }}>Master</option>
                                <option value="phd" {{ ($application->properties['education_level'] ?? '') === 'phd' ? 'selected' : '' }}>PhD</option>
                                <option value="none" {{ ($application->properties['education_level'] ?? '') === 'none' ? 'selected' : '' }}>None required</option>
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
