<x-app-layout>
    <x-slot name="header">
        <h1 style="display: none"> {{ $role1 = Auth::user()->roles->pluck('name') }}</h1>
        <h1 style="display: none"> {{ $role = trim($role1, '"[]') }}</h1>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            @can('view_user')
                <button class="ml-5"><a href="users">Users</a></button>
            @endcan
            <button class="ml-5"><a href="products">Products</a></button>
        </h2>
    </x-slot>
    <div class="container">
        @can('add_user')
            <button class="btn btn-primary m1-5 my-2" data-toggle="modal" data-target="#add-user-modal">Add User</button>
        @endcannot
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
                <tr>
                    <td id="manetd"></td>
                </tr>
                {{-- @foreach ($users as $user) --}}
                {{-- @can('view_product')
                @endcan --}}
                {{-- <tr class="user-row">
                        <td class="first-name">{{$user->first_name}}</td>
                        <td class="last-name">{{$user->last_name}}</td>
                        <td>{{$user->first_name. '  ' .$user->last_name }}</td>
                        <td class="email">{{$user->email}}</td>
                        <td><img src="{{'images/' .$user->image}}" alt="no image" width="100px" height="100px"/></td>
                        <td style="border: none">
                            @can('update_user')
                            <button href="{{$user->id}}" class="btn btn-dark btn-sm edit-user">Edit
                            </button>
                            @endcan
                            <td style="border: none">
                                <form method="post" action=" {{ route('users.destroy', $user->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    @can('delete_user')
                                <button type="submit" class="btn btn-danger btn-sm" style="background: red">Delete</button>
                                @endcan
                                </form>
                            </td>
                        </td>               
                    </tr> --}}
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>



    <!--Add user Modal -->
    <div class="modal fade" id="add-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($errors->any())
                    @foreach ($errors->all() as $error)
                        {{-- <li>{{$error}}</li> --}}
                    @endforeach
                    @endif
                        <form method="POST" id="add-user-form" enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name"
                                placeholder="First Name" required>
                                <span class="text-danger">@error('first_name'){{$message}} @enderror</span>
                        </div>

                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name"
                                placeholder="Last Name" required>
                                <span class="text-danger">@error('first_name'){{$message}} @enderror</span>
                                
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="name">Image</label>
                            <input type="file" class="form-control" name="img" id="image">
                        </div>

                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" class="form-control" name="password" id="password1"
                                placeholder="Password" required>
                                @if($errors->has('password'))
                                <input type="hidden" id="password-error" value="pass">
                                {{-- <div class="password-error">{{ $errors->first('password') }}</div> --}}
                                @endif
                                {{-- <span class="text-danger">@error('password'){{$message}} @enderror</span> --}}
                        </div>
                        <button class="btn btn-primary save-user-btn">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!--Edit user Modal -->
    <div class="modal fade" id="edit_user_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="PUT" id="edit_user_form_submit" class="edit_user_form" enctype="multipart/form-data">
                        @method('PUT')
                        {{-- @csrf --}}
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control first-name" name="first_name"
                                placeholder="First Name" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input type="text" class="form-control last-name" name="last_name" placeholder="Last Name"
                                required>
                        </div>
                        <input type="hidden" class="set_user_edit_id" name="edit_user">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control email" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Image</label>
                            <input type="file" class="form-control image-update" name="img">
                        </div>
                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" class="form-control password2" name="password" placeholder="Password"
                                required>
                        </div>
                        <button style="background: rgb(53, 53, 107)" type="submit"
                            class="btn btn-primary edit-save-btn">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Delete Modal --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    {{-- <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4> --}}
                </div>
                <div class="modal-body text-center">
                    <input type="hidden" name="set_user_id" class="set_user_id">
                    Are you sure you want to delete this project?
                </div>
                <div class="modal-footer">
                    <button type="submit" id="delete-btn" class="confirm-delete btn btn-default bg-danger">Yes</button>
                    <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    // $(function() {
    //     $('body').on('click','.edit-user', function() {
    //         var userId = $(this).attr('href');
    //         let row = $(this).parents('.user-row');
    //         $("#edit_user_form").attr('action', 'users/' + userId);
    //         $("#edit_user_form").find('.first-name').val(row.find('.first-name').text());
    //         $("#edit_user_form").find('.last-name').val(row.find('.last-name').text());
    //         $("#edit_user_form").find('.email').val(row.find('.email').text());
    //         $('#edit_user').modal('show');
    //     });
    // });
 
    $(document).ready(function() {
        // $('.save-user-btn').on('click',function(){
        // err = $('#password-error').val();
        // if(err === 'pass'){
        //     alert(err);
        // }
        // else{
        //     // console.log(err);
        //     $('#password-error').val('');
        //     alert(err);
        // }
        // if(err != 'undefined'){
        //     alert(err);
        //     // msg="password error";
        //     // toastr.success(msg);
        // }
        // else{
        //     console.log('hii');
        // }
        });
        // Fetch records using ajax
        fetch_users();
        function fetch_users() {
            $.ajax({
                url: 'get_users',
                type: "GET",
                success: function(response) {
                    $('tbody').html('');
                    $.each(response.users, function(key, item) {
                        $('tbody').append('<tr>\
                <td>' + item.first_name + '</td>\
                <td>' + item.last_name + '</td>\
                <td>'+ item.first_name +' '+ item.last_name + '</td>\
                <td>' + item.email + '</td>\
                <td><img src="images/' + item.image + ' " alt="no image" width="100px" height="100px"/></td>\
                <td>@can('update_user')<button value="' + item.id + '" class="btn-edit btn btn-primary btn-sm">Edit</button>@endcan</td>\
                <td>@can('delete_user')<button  value="' + item.id + '" class="delete-btn btn-delete btn btn-danger btn-sm">Delete</button>@endcan</td>\
              </tr>');
                });
                }
            });
        }
        // fetch End

        // Deleting Record From Database
        $('body').on('click', '.btn-delete', function(e) {
            e.preventDefault();
            var user_id = $(this).val();
            $('.set_user_id').val(user_id);
            $('#delete-modal').modal('show');
        });
        $('.confirm-delete').on('click', function(e) {
            e.preventDefault();
            var user_delete_id = $('.set_user_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: 'users/'+user_delete_id,
                success: function(response) {
                    $('#delete-modal').modal('hide');
                    toastr.success(response.message);
                    fetch_users();
                }
            });
        });

        // Updating Record
        $('body').on('click', '.btn-edit', function(e) {
            e.preventDefault();
            var edit_id = $(this).val();
            $('#edit_user_modal').modal('show');
            $.ajax({
                type: 'GET',
                url: 'get_user_to_edit/' + edit_id,
                success: function(response) {
                    $('.first-name').val(response.user.first_name);
                    $('.last-name').val(response.user.last_name);
                    $('.email').val(response.user.email);
                    $('.set_user_edit_id').val(edit_id);
                }
            });
        });

        $('.edit_user_form').on('submit', function(e) {
            e.preventDefault();
            var user_id_to_edit = $('.set_user_edit_id').val();
            var edit_form = $('.edit_user_form');
            let data = new FormData(this);
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'update_user/' + user_id_to_edit,
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#edit_user_modal').modal('hide');
                    toastr.success(response.message);
                    $('.edit_user_form').find('input').val('');
                    fetch_users();
                }
            });
        });
        // adding new students using ajax
        $('#add-user-form').on('submit', function(e) {
            e.preventDefault();
            let data = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('users.store') }}',
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        $('#add-user-modal').modal('hide');
                        toastr.success(response.message);
                        $('#add-user-form').find('input').val('');
                        fetch_users();
                    } else {
                        toastr.error(response.error);
                    }
                }
            });
        });
        //  Add Records End
    // });
</script>
