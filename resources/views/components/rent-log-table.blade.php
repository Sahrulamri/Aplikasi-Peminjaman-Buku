<div>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    <table class="table table-hover">
        <thead>
            <tr >
                <th>No.</th>
                <th>Users</th>
                <th>Book</th>
                <th>Rent Date</th>
                <th>Return Date</th>
                <th>Actual Return Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentlog as $key => $item)
                <tr class="{{ $item->actual_return_date == null ? '' : ($item->return_date < $item->actual_return_date ? 'text-bg-danger' : 'text-bg-success')  }}">
                  <td>{{ $rentlog->firstItem() + $key }}</td>
                  <td>{{ $item->user->username }}</td>
                  <td>{{ $item->book->title }}</td>
                  <td>{{ $item->rent_date }}</td>
                  <td>{{ $item->return_date }}</td>
                  <td>{{ $item->actual_return_date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div>
            Showing
            {{ $rentlog->firstItem() }}
            to
            {{ $rentlog->lastItem() }}
            of
            {{ $rentlog->total() }}
            entires
        </div> --}}
        {{ $rentlog->links() }}
</div>