<x-frontend-layout>
  <x-slot name="title">My Cart</x-slot>
  <x-slot name="content">
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
      <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shopping Cart</h2>
        @php $total = 0;@endphp
                <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
          <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
            <div class="space-y-6">
              @foreach ($cart as $item)
                <div
                  class="rounded-lg border product-data border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                  <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                    <a href="#" class="w-20 shrink-0 md:order-1">
                      <img class="h-20 w-20 " src="{{ Storage::url($item->product->image) }}" alt="imac image" />
                    </a>

                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                      <span class="text-sm text-gray-500">orignal price:
                        <del>${{ $item->product->original_price }}</del></span>
                    </div>
                    <h1></h1>
                    {{-- <div class="select-none">
                      <span onclick="decreaseQuantity(event, '{{$product->slug. $product->id}}' )" class="px-2 py-1 cursor-pointer decrease-quantity bg-gray-200 rounded">-</span>
                      <input disabled type="text" value="1" id="{{$product->slug.$product->id}}"
                          class="w-10 text-center qty-input focus:border-none border-none " name="quantity">
                      <span onclick="increaseQuantity(event, '{{$product->slug. $product->id}}' )" class="px-2 py-1 cursor-pointer increase-quantity bg-gray-200 rounded">+</span>
                  </div> --}}
                    <label for="counter-input" class="sr-only">Choose quantity:</label>
                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                      @if ($item->product->qty > $item->quantity)
                          
                      <div class="flex items-center">
                        <button type="button" onclick="decreaseQuantity(event, '{{$item->id.$item->product->slug}}' )"
                          class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                          -
                        </button>
                        <input type="text" disabled id="{{ $item->id.$item->product->slug }}" 
                          class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                          placeholder="" value="{{ $item->quantity }}" required />
                        <button type="button" onclick="increaseQuantity(event, '{{$item->id.$item->product->slug}}','{{$item->product->max_to_buy}}' )"
                          class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                          +
                        </button>
                      </div>
                      @else
                      <h5 class="text-red-600 ">Out of Stock</h5>
                      @endif
                      <div class="text-end md:order-4 md:w-32">
                        <p class="text-base font-bold text-gray-900 dark:text-white">
                          ${{ $item->product->selling_price }}
                        </p>
                      </div>
                    </div> 

                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                      <a href="#"
                        class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $item->product->name }}</a>
                      <div class="flex items-center gap-4">
                        <button type="button"
                          class="inline-flex addToWishlist items-center text-sm font-medium text-gray-500 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                          <i class="fa-solid text-primary  fa-heart"></i>
                          <input type="text" class="product_id" value="{{ $item->product->id }}" hidden />
                          Add to Wishlist
                        </button>
                        <button type="button" onclick="removeFromCart({{ $item->id }})"
                          class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                          <i class="fa-solid text-primary  me-2 fa-heart fa-trash"></i>
                          Remove
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                @php $total += $item->product->selling_price * $item->quantity;@endphp
              @endforeach
            </div>
            {{-- <div class="hidden xl:mt-8 xl:block">
          <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">People also bought</h3>
          <div class="mt-6 grid grid-cols-3 gap-4 sm:mt-8">
            <div
              class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
              <a href="#" class="overflow-hidden rounded">
                <img class="mx-auto h-44 w-44 dark:hidden"
                  src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="imac image" />
                <img class="mx-auto hidden h-44 w-44 dark:block"
                  src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="imac image" />
              </a>
              <div>
                <a href="#"
                  class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">iMac 27”</a>
                <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">This generation has some
                  improvements, including a longer continuous battery life.</p>
              </div>
              <div>
                <p class="text-lg font-bold text-gray-900 dark:text-white">
                  <span class="line-through"> $399,99 </span>
                </p>
                <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">$299</p>
              </div>
              <div class="mt-6 flex items-center gap-2.5">
                <button data-tooltip-target="favourites-tooltip-1" type="button"
                  class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                  <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"></path>
                  </svg>
                </button>
                <div id="favourites-tooltip-1" role="tooltip"
                  class="tooltip invisible addToWishlist absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                  Add to Wishlist
                  <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <button type="button"
                  class="inline-flex w-full addToCart items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                  <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
                  </svg>
                  Add to cart
                </button>
              </div>
            </div>
            
          </div>
        </div> --}}
          </div>

          <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
            <div
              class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
              <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>

              <div class="space-y-4">
                <div class="space-y-2">
                  {{-- <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">$7,592.00</dd>
                  </dl> --}}
                  {{-- <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Original price</dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">$7,592.00</dd>
                  </dl>

                  <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Savings</dt>
                    <dd class="text-base font-medium text-green-600">-$299.00</dd>
                  </dl>

                  <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Store Pickup</dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">$99</dd>
                  </dl>

                  <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">$799</dd>
                  </dl>
                </div> --}}

                  <dl
                    class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                    <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                    <dd class="text-base font-bold text-gray-900 dark:text-white">${{ $total }}</dd>
                  </dl>
                </div>

                <a href="{{url('checkout')}}" class = "flex w-full items-center justify-center rounded-lg bg-primary px-5 py-2.5 text-sm font-medium text-white  focus:outline-none focus:ring-4 focus:ring-primary-300 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Proceed
                  to Checkout</a>

                <div class="flex items-center justify-center gap-2">
                  <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                  <a href="#" title=""
                    class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                    Continue Shopping
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 12H5m14 0-4 4m4-4-4-4" />
                    </svg>
                  </a>
                </div>
              </div>

              <div
                class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                <form class="space-y-4">
                  <div>
                    <label for="voucher" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Do you
                      have
                      a voucher or gift card? </label>
                    <input type="text" id="voucher"
                      class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                      placeholder="" required />
                  </div>
                  <button type="submit"
                    class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Apply
                    Code</button>
                </form>
              </div>
            </div>
          </div>
        </div>
    </section>
  </x-slot>
  <x-slot name="script">
    <script>
      function removeFromCart(id) {
        axios.post('{{ route('removeFromCart') }}', {
            'id': id
          })
          .then(function(response) {
            alert(response.data.status);
            window.location.reload();
          }).catch(function(error) {
            console.log(error);
          })
      }

      function updateQuantity(id, quantity) {
        console.log(id);
        //  axios.post('{{ route('updateQuantity') }}', {
        //      'id': id,
        //      'quantity': quantity
        //    })
        //    .then(function(response) {
        //      alert(response.data.status);
        //      window.location.reload();
        //    }).catch(function(error) {
        //      console.log(error);
        //    })
      }
    </script>
  </x-slot>
</x-frontend-layout>
