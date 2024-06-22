<x-frontend-layout>
  <x-slot name="title">{{$category->name}}</x-slot>
  <x-slot name="content">
    <div class="text-3xl font-bold text-primary text-center my-4">{{ucfirst($category->name)}}</div>
    <div class="flex  justify-center container gap-3 align-middle flex-wrap">
      @foreach ($products as $product)
        <x-product :name="$product->name" :id="$product->id" :dicription="$product->description" :new_price="$product->selling_price" :old_price="$product->original_price" :image="$product->image" :route="route('product', ['slug' => $product->slug])"/>
      @endforeach
      </div>
  </x-slot>
</x-frontend-layout>