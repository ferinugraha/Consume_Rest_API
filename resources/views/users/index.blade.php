<x-layouts.app>
    <br>
    <br>
    <div class="card">
        <div>
            <a class="btn btn-primary btn-lg btn-block" href="{{ route('users.create') }}">Tambah Baru</a>
        </div>

        <div class="card-body">
            @if (session()->has('message'))

            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>

    @endif
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <tr>
                        <th>No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($users['data'] as $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user['firstName'] }}</td>
                            <td>{{ $user['lastName'] }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-success">Edit</a>
                                <form class="d-inline-block" action="{{ route('users.destroy', $user['id']) }}" method="POST" onsubmit="return confirm('Are you sure to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Record(s) Found!</td>
                        </tr>
                    @endforelse
                </table>
            </div>
            @if ($users['total'] > $users['limit'])

            @php $pages = ceil($users['total'] / $users['limit']) @endphp
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ request('page') == 1 || is_null(request('page')) ? 'disabled' : '' }}">
                        <a class="page-link" href="?page={{ request('page') ? request('page') - 1 : '1' }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $pages; $i++)
                        <li class="page-item {{ request('page') == $i || (is_null(request('page')) && $i == 1) ? 'active' : '' }}"><a class="page-link" href="?page={{ $i }}{{ request('search') ? '&search=' . request('search') : '' }}">{{ $i }}</a></li>
                    @endfor
                    <li class="page-item {{ request('page') == $pages ? 'disabled' : '' }}">
                        <a class="page-link" href="?page={{ request('page') ? request('page') + 1 : $pages - 1 }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

    @endif
        </div>

    </div>
</x-layouts.app>
