@props(['product'])
<div class="item bg-white shadow product-data rounded overflow-hidden group">
  <div class="relative">
    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }} " class="w-full h-52" />
    <div
      class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
      <a href="{{ route('product',['slug' => $product->slug]) }}"
        class="text-white text-lg w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
        title="view product">

        <i class="text-white  fa-solid fa-eye"></i>
      </a>
      <a href='#' {{-- "{{route('product', $product->slug)}}" --}}
        class="text-white text-lg addToWishlist w-9 h-8 rounded-full bg-primary flex items-center justify-center hover:bg-gray-800 transition"
        title="add to wishlist">
        <input type="text" value="{{ $product->id }}" hidden class="product_id"/>
        <i class="fa-solid fa-heart"></i>
      </a>
    </div>
  </div>
  <div class="pt-4 pb-3 px-4">
    <a href="{{ route('product', $product->slug) }}">
      <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">
        {{ $product->name }}
      </h4>
    </a>

    <div class="flex items-baseline mb-1 space-x-2">
      <p class="text-xl text-primary font-semibold">${{ $product->selling_price }}</p>
      <p class="text-sm text-gray-400 line-through">${{ $product->original_price }}</p>
      <p class="text-xl text-primary font-semibold">{{ $product->category->name }}</p>

    </div>
    <div class="flex items-center">
      <div class="flex gap-1 text-sm text-yellow-400">
        <span><i class="fa-solid fa-star"></i></span>
        <span><i class="fa-solid fa-star"></i></span>
        <span><i class="fa-solid fa-star"></i></span>
        <span><i class="fa-solid fa-star"></i></span>
        <span><i class="fa-solid fa-star"></i></span>
      </div>
      <div class="text-xs text-gray-500 ml-3">{{ $product->qty }}</div>
    </div>
  </div>
  <a href="#" {{-- {{route('product', $product->slug)}} --}}
    class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">Add
    to cart</a>
</div>
