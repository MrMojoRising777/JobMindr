<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Company</th>
        <th scope="col">Job title</th>
        <th scope="col">Status</th>
        <th scope="col">Region</th>
        <th scope="col">Applied on</th>
    </tr>
    </thead>
    <tbody>
    @forelse($applications as $application)
        @php
            $status = strtolower($application->status->value);
            $badgeClass = match ($status) {
                'applied'   => 'text-bg-warning',
                'interview' => 'text-bg-info',
                'rejected'  => 'text-bg-danger',
                'accepted'  => 'text-bg-success',
                default     => 'text-bg-secondary',
            };
        @endphp

        <tr class="pointer" data-href="{{ route('applications.show', ['application' => $application]) }}">
            <th scope="row">{{ $application->id }}</th>
            <td>{{ $application->company?->name }}</td>
            <td>{{ $application->position }}</td>
            <td>
                <span class="badge {{ $badgeClass }}">{{ ucfirst($application->status->value) }}</span>
            </td>
            <td>{{ $application->company?->region }}</td>
            <td>{{ $application->applied_at }}</td>
        </tr>
    @empty
        <tr>
            <th scope="row">x</th>
            <td colspan="5">No applications found</td>
        </tr>
    @endforelse
    </tbody>
</table>
