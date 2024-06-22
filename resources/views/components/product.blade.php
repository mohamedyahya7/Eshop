@props(['name', 'image', 'route', 'dicription', 'old_price', 'new_price','id'])
<div style="width: 30%"
  class=" overflow-hidden product-data rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
  <a href="{{ $route }}" class="overflow-hidden rounded">
    <img class="mx-auto h-48 w-full " src="{{ Storage::url($image) }}" alt={{ $name }}" />
  </a>
  <div>
    <a href="{{ $route }}"
      class="text-lg mt-4 inline-block font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $name }}</a>
    <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400"> {{ $dicription }}</p>
  </div>
  <div>
    <p class="text-lg font-bold text-gray-900 dark:text-white">
      <span class="line-through"> {{ $old_price }} </span>
    </p>
    <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">{{ $new_price }}</p>
  </div>
  <div class="mt-6 flex items-center gap-2.5">
    <button data-tooltip-target="favourites-tooltip-1" type="button"
      class="inline-flex addToWishlist items-center justify-center gap-2 rounded-lg border border-primary bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
      <input type="text" class="product_id" value="{{ $id }}" hidden/>
      <i class="fa-solid fa-heart text-primary"></i>
    </button>
    <div id="favourites-tooltip-1" role="tooltip"
    class="tooltip invisible  absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
      Add to Wishlist
      <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
    <button type="button"
      class="inline-flex addTocart w-full gap-2 items-center justify-center rounded-lg bg-primary px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
      <i class="fa-solid fa-cart-shopping "></i>
      Add to cart
    </button>
  </div>
</div>
