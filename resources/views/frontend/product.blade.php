<x-frontend-layout>
    <x-slot name="title">{{ $product->name }}</x-slot>
    <x-slot name="content">
        {{-- @php $image = ;@endphp --}}
        <section class="py-8 product-data bg-white md:py-16 dark:bg-gray-900 antialiased">
            <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                    <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                        <img class="w-full" src= "{{ Storage::url($product->image) }}" alt="{{ $product->name }}" />
                    </div>

                    <div class="mt-6 sm:mt-8 lg:mt-0">
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                            {{ $product->name }}
                        </h1>
                        <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                            <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white">
                                $ {{ $product->selling_price }}
                            </p>

                            <div class="flex items-center gap-2 mt-2 sm:mt-0">
                                <div class="flex items-center gap-1">
                                    <i class="fa-solid fa-star text-yellow-400"></i>
                                    <i class="fa-solid fa-star text-yellow-400"></i>
                                    <i class="fa-solid fa-star text-yellow-400"></i>
                                    <i class="fa-solid fa-star text-yellow-400"></i>
                                    <i class="fa-solid fa-star-half text-yellow-400"></i>

                                </div>
                                <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                                    (5.0)
                                </p>
                                <a href="#"
                                    class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white">
                                    345 Reviews
                                </a>
                            </div>
                        </div>
                        <p class="my-4 text-gray-700 ">Quantity <span class="qty-p  text-red-500 "></span></p>
                        <div class="select-none">
                            <span onclick="decreaseQuantity(event, '{{$product->slug. $product->id}}' )" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">-</span>
                            <input disabled type="text" value="1" id="{{$product->slug.$product->id}}"
                                class="qty-input w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white " name="quantity">
                            <span onclick="increaseQuantity(event, '{{$product->slug. $product->id}}' )" class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">+</span>
                        </div>
                        <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                            @if ($product->trending)
                                <p class="text-sm font-medium  text-white rounded-lg py-2.5 px-5 leading-none bg-red-900 "> Trending</p>
                            @endif
                            @if ($product->qty > 0)
                                <p class="text-sm font-medium text-white rounded-lg py-2.5 px-5 leading-none bg-green-600 dark:text-green-400">In Stockb</p>                                    
                                

                                <a role="button"
                                    class="addToCart text-white mt-4 sm:mt-0 cursor-pointer bg-primary hover:bg-primary focus:ring-4 focus:ring-primary font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary dark:hover:bg-primary focus:outline-none dark:focus:ring-primary flex items-center justify-center">
                                    <i class="fa-solid fa-cart-shopping text-white me-2"></i>

                                    Add to cart
                                </a>
                            @else
                                <p
                                    class="text-sm font-medium rounded-lg leading-none py-2.5 px-5 bg-red-600 dark:text-red-400">
                                    Out of Stock
                                </p>
                            @endif

                            <a role="button"
                                    class="flex items-center addToWishlist cursor-pointer justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    <input type="hidden" class="product_id" value="{{ $product->id }}">
                                    <i class="fa-solid fa-heart text-primary me-2"></i>
                                    Add to Wishlist
                                </a>
                        </div>

                        <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                            {{ $product->description }}
                        </p>

                        <p class="text-gray-500 dark:text-gray-400">
                            {{ $product->small_description }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </x-slot>
    {{-- <x-slot name="script">
        <script>
            $(document).ready(function() {
                // $('.addToCart').click(function(e) {
                //   e.preventDefault();
                //   var data = {
                //     '_token': '{{ csrf_token() }}',
                //     'quantity': parseInt($('.qty-input').val()),
                //     'product_id': {{ $product->id }},
                //   }
                //   var url = "{{ route('addToCart') }}";
                //   axios.post(url, data)
                //     .then(response => {
                //       alert(response.data.status);
                //       console.log(response.data);
                //     }).catch(error => {
                //       console.error(error);
                //     })

                //   //$.ajax({
                //   //  url: url,
                //   //  type: "POST",
                //   //  data: data,
                //   //  success: function(response) {
                //   //    alert(response.status);
                //   //    console.log(response);
                //   //  },
                //   //  error: function(jqXHR, textStatus, errorThrown) {
                //   //    console.log(textStatus, errorThrown);
                //   //  }
                //   //})
                // });

                // $('.increase-quantity').click(function(e) {
                //     e.preventDefault();
                //     var inc_value = $('.qty-input').val();
                //     var value = parseInt(inc_value, 10);
                //     value = isNaN(value) ? 0 : value;
                //     if (value < {{ $product->qty }}) {
                //         if (value < 10) {
                //             value++;
                //             $('.qty-input').val(value);
                //         }
                //     } else {
                //         var m = `There is only {{ $product->qty }} in stock`
                //         $('.qty-p').text(m);
                //         setTimeout(() => {
                //             $('.qty-p').text('');
                //         }, 2000);
                //     }
                // });
                // $('.decrease-quantity').click(function(e) {
                //     e.preventDefault();
                //     var inc_value = $('.qty-input').val();
                //     var value = parseInt(inc_value, 10);
                //     value = isNaN(value) ? 0 : value;
                //     if (value > 1) {
                //         value--;
                //         $('.qty-input').val(value);
                //     }
                // });
            });
        </script>
    </x-slot> --}}
</x-frontend-layout>
