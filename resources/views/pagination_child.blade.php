<table class="table table-bordered">
   <thead>
     <tr>
       <th scope="col">Name</th>
       <th scope="col">Description</th>
       <th scope="col">Price</th>
       <th scope="col">Category</th>
       <th scope="col">Status</th>
       <th scope="col">Image</th>
       <th scope="col" style="border: none;"></th>
       <th scope="col" style="border: none;">Action</th>
     </tr>
   </thead>
   <tbody>

@foreach($data as $product)
<tr class="product-row">
   <td class="product-name">{{$product->name}}</td>
   <td class="product-description">{{$product->description}}</td>
   <td class="product-price">{{$product->price }}</td>
   <td class="product-category">{{$product->category->name}}</td>
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

<div class="pagination">
{!! $data->links() !!}
</div>