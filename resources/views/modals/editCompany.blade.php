<div class="modal" id="companyModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('companies.store', ['company' => $company]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}" required>

                <div class="modal-header">
                    <div class="row">
                        <div class="col-12">
                            <span class="fs-5 fw-semibold">
                                <input type="text" class="form-control" name="name" value="{{ $company->name ?? old('name') }}">
                            </span>
                        </div>

                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <input type="text" class="form-control" name="street" value="{{ $company->street ?? old('street') }}" placeholder="Street">
                        </div>

                        <div class="col-3">
                            <input type="text" class="form-control" name="housenr" value="{{ $company->housenr ?? old('housenr') }}" placeholder="Housenr">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <input type="text" class="form-control" name="zipcode" value="{{ $company->zipcode ?? old('zipcode') }}" placeholder="Zipcode">
                        </div>

                        <div class="col-3">
                            <input type="text" class="form-control" name="city" value="{{ $company->city ?? old('city') }}" placeholder="City">
                        </div>

                        <div class="col-3">
                            <input type="text" class="form-control" name="region" value="{{ $company->region ?? old('region') }}" placeholder="Region">
                        </div>

                        <div class="col-3">
                            <input type="text" class="form-control" name="country" value="{{ $company->country ?? old('country') }}" placeholder="country">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-4">
                            <input type="text" class="form-control" name="sector" value="{{ $company->sector ?? old('sector') }}" placeholder="Sector">
                        </div>

                        <div class="col-4">
                            <input type="text" class="form-control" name="website" value="{{ $company->website ?? old('website') }}" placeholder="Website">
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
