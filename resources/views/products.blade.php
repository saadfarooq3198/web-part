<x-app-layout>
    <x-slot name="header">
        <h1 style="display: none"> {{ $role1=Auth::user()->roles->pluck('name') }}</h1>
        <h1 style="display: none"> {{ $role = trim($role1,'"[]')}}</h1>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            @can('view_user')
            <button class="ml-5"><a href="users">Users</a></button>
            @endcan
            <button class="ml-5"><a href="products">Products</a></button>
        </h2>
    </x-slot>
    <div class="container">
        @can('add_product')
            <button class="btn btn-primary m1-5 my-2" data-toggle="modal" data-target="#add_user">Add Product</button>
        @endcan
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scope="col">Image</th>
                <th scope="col" style="border: none;"></th>
                <th scope="col" style="border: none;">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="product-row">
                        <td class="product-name">{{$product->name}}</td>
                        <td class="product-description">{{$product->description}}</td>
                        <td class="product-price">{{$product->price }}</td>
                        <td class="product-status">{{$product->status}}</td>
                        <td><img src="{{'images/' .$product->image}}" alt="no image" width="100px" height="100px"/></td>
                        <td style="border: none">
                            @can('update_product')
                            <button href="{{$product->id}}" class="btn btn-dark btn-sm edit-product">Edit
                            </button>
                            @endcannot
                        </td>
                        <td style="border: none">
                            <form method="post" action=" {{ route('products.destroy', $product->id) }}">
                                @method('DELETE')
                                @csrf
                            @can('delete_product')
                            <button type="submit" class="btn btn-danger btn-sm" style="background: red">Delete</button>
                            @endcannot
                            </form>
                        </td>
                        </td>               
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
    <!--Add user Modal -->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add New Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('products.store')}}" enctype="multipart/form-data">
            @method('post')
              @csrf
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="product_name"  placeholder="Name" required>
              </div>
              <div class="form-group">
                <label for="name">Description</label>
                <input type="text" class="form-control" name="product_description"  placeholder="Description" required>
              </div>
              <div class="form-group">
                <label for="email">Price</label>
                <input type="text" class="form-control" name="product_price"  placeholder="Price" required>
              </div>
              <div class="form-group">
                <label for="cars">Status</label>
                <select name="product_status">
                    <option value="enable">Enable</option>
                    <option value="disable">Disable</option>
                </select>
              </div>
              <div class="form-group">
                <label for="name">Image</label>
                <input type="file" class="form-control" name="img">
              </div>
              <button   class="btn btn-primary">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<!--Edit user Modal -->
<div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add New Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{-- {{route('products.update',$product->id)}} --}}
          <form method="post"  action="" id="edit_product_form" enctype="multipart/form-data">
            @method('PUT')
              @csrf
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control product-name" name="product_name" id="product_name"   required>
              </div>
              <div class="form-group">
                <label for="name">Description</label>
                <input type="text" class="form-control product-description" name="product_description" id="product_description"  required>
              </div>
              <div class="form-group">
                <label for="email">Price</label>
                <input type="text" class="form-control product-price" name="product_price" id="product_price"  required>
              </div>
              <div class="form-group">
                <label for="cars">Status</label>
                <select name="product_status" id="product_status">
                    <option value="enable">Enable</option>
                    <option value="disable">Disable</option>
                </select>
              </div>
              <div class="form-group">
                <label for="name">Image</label>
                <input type="file" class="form-control" name="img">
              </div>
              <button   class="btn btn-primary">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div> 
</x-app-layout>
<script>
    $(function() {
        $('.edit-product').on('click', function() {
           var href = $(this).attr('href');
           let row = $(this).parents('.product-row');
        $("#edit_product_form").attr('action', 'products/'+href);
        $("#edit_product_form").find('.product-name').val(row.find('.product-name').text());
       $("#edit_product_form").find('.product-description').val(row.find('.product-description').text());
    $("#edit_product_form").find('.product-price').val(row.find('.product-price').text());
        $('#edit_product').modal('show');
        });
    });
</script>
