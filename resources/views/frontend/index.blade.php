<x-frontend-layout>
  <x-slot name="title">E-Shop</x-slot>
  <x-slot name="content">

    <x-slider />
    <div class="container mt-6">
      <h3 class="text-2xl font-semibold mb-6">Trending Products</h3>
      <div class="product-carousel owl-carousel owl-theme  col-span-3">
        @foreach ($trending_products as $product)
          <x-productindex :product="$product" />
        @endforeach
      </div>
    </div>
  </x-slot>
  <x-slot name="script">
    <script>
      $('.product-carousel').owlCarousel( {
        loop: true,
        margin: 10,
        //nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        //navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>',
        //  '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 3
          },
          1000: {
            items: 4
          }
        }
      })
    </script>
  </x-slot>
</x-frontend-layout>
