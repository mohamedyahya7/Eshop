<x-frontend-layout>
  <x-slot name="title">Categories</x-slot>
  <x-slot name="content">
    <div class="text-3xl font-bold text-primary text-center my-4">Categories</div>
    <div class="flex gap-8 justify-center   align-middle flex-wrap">
      @foreach ($categories as $category)
<x-category-card :name="$category->name" :products_count="$category->products_count" :body="$category->description" :bg="$category->image" :route="route('category', ['slug' => $category->slug])" />
      @endforeach
      </div>
  </x-slot>
</x-frontend-layout>
