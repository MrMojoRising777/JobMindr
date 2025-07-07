<div class="modal" id="contactModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('contacts.store', ['contact' => $contact ?? null]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->id }}" required>

                <div class="modal-header">
                    <div class="row">
                        <div class="col-5">
                            <span class="fs-5 fw-semibold">
                                <input type="text" class="form-control" name="first_name" value="{{ $contact?->first_name ?? old('first_name') }}" placeholder="First name">
                            </span>
                        </div>
                        <div class="col-5">
                            <span class="fs-5 fw-semibold">
                                <input type="text" class="form-control" name="last_name" value="{{ $contact?->last_name ?? old('last_name') }}" placeholder="Last name">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <img class="img-thumbnail rounded-circle" width="200" src="https://haieng.com/wp-content/uploads/2017/10/test-image-500x500.jpg" alt="test img">

                            <span class="fs-6 text-secondary-emphasis">
                                <input type="text" class="form-control mt-2" name="position" value="{{ $contact?->position ?? old('position') }}" placeholder="Position">
                            </span>
                        </div>
                        <div class="col-8">
                            <table class="table">
                                <tr>
                                    <td class="pt-3">
                                        <i class="bi bi-envelope"></i>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="email" value="{{ $contact?->email ?? old('email') }}" placeholder="Email">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <i class="bi bi-telephone"></i>
                                    </td>
                                    <td>
                                        <input type="tel" class="form-control" name="phone" value="{{ $contact?->phone ?? old('phone') }}" placeholder="Phone">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pt-3">
                                        <i class="bi bi-linkedin"></i>
                                    </td>
                                    <td>
                                        <input type="url" class="form-control" name="linkedin" value="{{ $contact?->linkedin ?? old('linkedin') }}" placeholder="Linkedin">
                                    </td>
                                </tr>
                            </table>
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
