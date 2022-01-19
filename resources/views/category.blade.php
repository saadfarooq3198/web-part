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
            <button class="ml-5"><a href="categories">Categories</a></button>
        </h2>
    </x-slot>
    <div class="container">
        @can('add_product')
            <button class="btn btn-primary my-2" data-toggle="modal" data-target="#add_category">Add Category</button>
        @endcan
        <span id="table">
          @include('category_chaild_paginate')
        </span>
    </div>
    <!--Add user Modal -->
<div class="modal fade" id="add_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Add New Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('categories.store')}}" enctype="multipart/form-data">
            @method('post')
              @csrf
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name"  placeholder="Name" required>
              </div>
              <div class="form-group">
                <label for="name">Description</label>
                <input type="text" class="form-control" name="description"  placeholder="Description" required>
              </div>
              <button class="btn btn-primary">Save</button>
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

    $(document).ready(function(){
    $(document).on('click', '.pagination nav  a', function(event){
      event.preventDefault(); 
      var page = $(this).attr('href').split('page=')[1];
      fetch_data(page);
   });
  
   function fetch_data(page)
   {
    var _token = $("input[name=_token]").val();
    $.ajax({
        url:"{{ route('pagination.fetch') }}",
        method:"POST",
        data:{_token:_token, page:page},
        success:function(data)
        {
          console.log(data);
         $('#table').html(data);
        }
      });
   }
  });
</script>
