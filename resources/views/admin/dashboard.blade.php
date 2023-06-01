<h1>Welcome to the Admin Dashboard</h1>
@can('manage-customers')
    <button>manage-customers</button>
@endcan
@role('admin')
    <button type="button">admin only1</button>
    <button type="button">admin only2</button>

@endrole
@can('manage-patients')
    <button type="button">manage-patients</button>
    <button type="button">manage-appointments</button>
@endcan
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>