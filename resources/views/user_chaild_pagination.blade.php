<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Image</th>
            <th scope="col" style="border: none;">Edit</th>
            <th scope="col" style="border: none;">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>  {{$user->first_name}}  </td>
            <td>   {{$user->last_name}}  </td>
            <td> {{$user->first_name }}  {{$user->last_name}} </td>
            <td>  {{$user->email }}  </td>
            <td><img src="images/{{$user->image}}" alt="no image" width="100px" height="100px"/></td>
            <td>@can('update_user')<button value="{{$user->id}}" class="btn-edit btn btn-primary btn-sm">Edit</button>@endcan</td>
            <td>@can('delete_user')<button  value="{{$user->id}}" class="delete-btn btn-delete btn btn-danger btn-sm">Delete</button>@endcan</td>
          </tr>
          @endforeach
    </tbody>
</table>
<div class="pagination">
    {!! $users->links() !!}
    </div>