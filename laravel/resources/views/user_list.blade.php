<table border='1' class="table table-striped list-table">
    <thead>
        <th>UserList</th>
        <th>&nbsp;</th>
    </thead>
    <tbody>
        @foreach ($userLists as $userList)
        <tr>
            <td class="table-text">
                <div>{{ $userList->name }}</div>
            </td>
            <td class="table-text">
                <div><img src="{{asset($userList->photo)}}" alt="" width="100px" height="100px"></div>
            </td>
            <td class="table-text">
                <div>{{ $userList->date_of_birth }}</div>
            </td>
            <td class="table-text">
                <div>{{ $userList->gender }}</div>
            </td>
            <td class="table-text">
                <div>{{ $userList->role_type }}</div>
            </td>
            <td class="table-text">
                <div>{{ $userList->email }}</div>
            </td>
            <td class="table-text">
                <div>{{ $userList->address }}</div>
            </td>
            <td class="table-text">
                <div>{{ $userList->phone_number }}</div>
            </td>
            <!-- userList Details Button -->
            <!-- <td>
                <form action="{{url('userdetail/'.$userList->id)}}" method="GET">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-btn fa-trash"></i>ShowDetail
                    </button>
                </form>
            </td> -->
            <!-- userList Update Button -->
            <td>
            <a href="{{url('userdetail/'.$userList->id)}}">Details</a>
            </td>
            <td>
                <!-- <form action="{{url('/useredit/'.$userList->id)}}" method="GET">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-btn fa-trash"></i>Update
                    </button>
                </form> -->
            <a href="{{url('/useredit/'.$userList->id)}}">Update</a>
            </td>
            <!-- userList Delete Button -->
            <td>
                <form action="{{ url('user/'.$userList->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button onclick="return confirm('Are you sure ?')" type="submit" class="btn btn-danger">
                        <i class="fa fa-btn fa-trash"></i>Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>