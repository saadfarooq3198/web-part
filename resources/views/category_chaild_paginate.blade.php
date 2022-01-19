<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Number of Products</th>
        <th scope="col" style="border: none;"></th>
        <th scope="col" style="border: none;">Action</th>
      </tr>
    </thead>
    <tbody>
 @foreach($data as $category)
 <tr class="product-row1">
    <td class="product-name">{{$category->name}}</td>
    <td class="product-description">{{$category->description}}</td>
    {{-- $count = App\Models\Product::where('category_id',$category->id)->count('category_id')  --}}
    <td>{{$count = App\Models\Product::where('category_id',$category->id)->count('category_id') }}</td>
    <td style="border: none">
          @can('update_product')
          <button href="{{$category->id}}" class="btn btn-dark btn-sm edit-product">Edit
          </button>
          @endcannot
    </td>
    <td style="border: none">
          <form method="post" action=" {{ route('products.destroy', $category->id) }}">
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
 
 {{-- <div class="pagination">
 {!! $data->links() !!}
 </div> --}}