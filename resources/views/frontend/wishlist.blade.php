<x-frontend-layout>
  <x-slot name="title">My Wishlist</x-slot>
  <x-slot name="content">
    <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16">

      <!-- sidebar -->
      <div class="col-span-3">
          <div class="px-4 py-3 shadow flex items-center gap-4">
              <div class="flex-shrink-0">
                  <img src="../assets/images/avatar.png" alt="profile"
                      class="rounded-full w-14 h-14 border border-gray-200 p-1 object-cover">
              </div>
              <div class="flex-grow">
                  <p class="text-gray-600">Hello,</p>
                  <h4 class="text-gray-800 font-medium">{{auth()->user()->name}}</h4>
              </div>
          </div>

          <div class="mt-6 bg-white shadow rounded p-4 divide-y divide-gray-200 space-y-4 text-gray-600">
              <div class="space-y-1 pl-8">
                  <a href="#" class="block font-medium capitalize transition">
                      <span class="absolute -left-8 top-0 text-base">
                          <i class="fa-regular fa-address-card"></i>
                      </span>
                      Manage account
                  </a>
                  <a href="#" class="relative hover:text-primary block capitalize transition">
                      Profile information
                  </a>
                  <a href="#" class="relative hover:text-primary block capitalize transition">
                      Manage addresses
                  </a>
                  <a href="#" class="relative hover:text-primary block capitalize transition">
                      Change password
                  </a>
              </div>

              <div class="space-y-1 pl-8 pt-4">
                  <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                      <span class="absolute -left-8 top-0 text-base">
                          <i class="fa-solid fa-box-archive"></i>
                      </span>
                      My order history
                  </a>
                  <a href="#" class="relative hover:text-primary block capitalize transition">
                      My returns
                  </a>
                  <a href="#" class="relative hover:text-primary block capitalize transition">
                      My Cancellations
                  </a>
                  <a href="#" class="relative hover:text-primary block capitalize transition">
                      My reviews
                  </a>
              </div>

              <div class="space-y-1 pl-8 pt-4">
                  <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                      <span class="absolute -left-8 top-0 text-base">
                          <i class="fa-regular fa-credit-card"></i>
                      </span>
                      Payment methods
                  </a>
                  <a href="#" class="relative hover:text-primary block capitalize transition">
                      voucher
                  </a>
              </div>

              <div class="space-y-1 pl-8 pt-4">
                  <a href="#" class="relative text-primary block font-medium capitalize transition">
                      <span class="absolute -left-8 top-0 text-base">
                          <i class="fa-regular fa-heart"></i>
                      </span>
                      My wishlist
                  </a>
              </div>

              <div class="space-y-1 pl-8 pt-4">
                  <a href="#" class="relative hover:text-primary block font-medium capitalize transition">
                      <span class="absolute -left-8 top-0 text-base">
                          <i class="fa-solid fa-right-from-bracket"></i>
                      </span>
                      Logout
                  </a>
              </div>

          </div>
      </div>
      <!-- ./sidebar -->
      <!-- wishlist -->
      <div class="col-span-9 space-y-4">
        @foreach ($wishlists as $item)
        <div class="flex items-center product-data justify-between border gap-6 p-4 border-gray-200 rounded">
            <input type="text" class="qty-input" hidden value="{{$item->product->id}}">
          <div class="w-28"><img src="{{ Storage::url($item->product->image) }}" alt="{{$item->product->name}}" class="w-24 h-24"></div>
            <div class= "flex w-3/5 ">
                <a href="{{route('product',['slug' => $item->product->slug])}}"></a>    
                <h2 class="text-gray-800 text-xl font-medium uppercase">{{$item->product->name}}</h2>
                @if ($item->product->qty >= 0)
                <p class="text-gray-500 text-sm">Availability: <span class="bg-green">In Stock</span></p>
                <a class="addToCart px-6 py-2 text-center text-sm text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">add
                to cart</a>
                @else
                <p class="text-gray-500 text-sm">Availability: <span class="text-red">Out of Stock</span></p>
                <a class="cursor-not-allowed px-6 py-2 text-center text-sm text-white bg-red-400 border border-red-400 rounded transition uppercase font-roboto font-medium">add
                to cart</a>
                @endif
            </div>
            <div class="text-gray-600 cursor-pointer hover:text-primary">
                <i class="fa-solid fa-trash"></i>
            </div>
        </div>
        @endforeach
      </div>
  </div>
  </x-slot>
</x-frontend-layout>
