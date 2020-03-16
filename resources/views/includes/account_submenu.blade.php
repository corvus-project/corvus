<a href="{{ route('admin.accounts.index') }}" class="btn btn-primary btn-sm m-1" data-toggle="tooltip"
    title="List the accounts"><i class="fas fa-list"></i></a>

<a href="{{ route('admin.accounts.create') }}" class="btn btn-secondary btn-sm m-1" data-toggle="tooltip"
    title="New Account"><i class="fas fa-plus"></i></a>

@if(!empty($user))

<a href="{{ route('admin.accounts.orders', $user->id) }}" class="btn btn-light btn-sm m-1" data-toggle="tooltip"
    title="Orders"><i class="fas fas fa-wallet"></i></a>

<a href="{{ route('admin.accounts.edit', $user->id) }}" class="btn btn-secondary btn-sm m-1" data-toggle="tooltip"
    title="Edit the Account"><i class="fas fa-pen"></i></a>

<a href="{{ route('admin.accounts.view', $user->id) }}" class="btn btn-success btn-sm m-1" data-toggle="tooltip"
    title="Back to customer"><i class="fas fa-arrow-alt-circle-left"></i></a>
@endif