<x-frontend-layout>
    <x-slot name="title">Chekout</x-slot>
    <x-slot name="content">
        <form action="{{ url('place-order') }}" method="POST">
            @csrf
            <div class="container grid grid-cols-12 items-start pb-16 pt-4 gap-6">
                @php
                    $total = 0;
                    $user = auth()->user();
                @endphp

                <div class="col-span-8 border border-gray-200 p-4 rounded">
                    <h3 class="text-lg font-medium capitalize mb-4">Checkout</h3>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="fname" class="text-gray-600">First Name <span
                                        class="text-primary">*</span></label>
                                <input type="text" name="fname" value="{{ $user->?fname }}" id="fname"
                                    class="input-box">
                            </div>
                            <div>
                                <label for="lname" class="text-gray-600">Last Name <span
                                        class="text-primary">*</span></label>
                                <input type="text" name="lname" id="lname" value="{{ $user->lname }}"
                                    class="input-box">
                            </div>

                            <div>
                                <label for="address1" class="text-gray-600">Address 1</label>
                                <input type="text" name="address1" id="address1" value="{{ $user->address1 }}"
                                    class="input-box">
                            </div>
                            <div>
                                <label for="address2" class="text-gray-600">Address 2</label>
                                <input type="text" name="address2" id="address2" value="{{ $user->address2 }}"
                                    class="input-box">
                            </div>
                            <div>
                                <label for="phone" class="text-gray-600">Phone number</label>
                                <input type="text" name="phone" id="phone" value="{{ $user->phone }}"
                                    class="input-box">
                            </div>
                            <div>
                                <label for="email" class="text-gray-600">Email address</label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}"
                                    class="input-box">
                            </div>
                            <div>
                                <label for="country" class="text-gray-600">Country</label>
                                <input type="text" name="country" id="country" value="{{ $user->country }}"
                                    class="input-box">
                            </div>
                            <div>
                                <label for="state" class="text-gray-600">State</label>
                                <input type="text" name="state" id="state" value="{{ $user->state }}"
                                    class="input-box">
                            </div>
                            <div>
                                <label for="city" class="text-gray-600">City</label>
                                <input type="text" name="city" id="city" value="{{ $user->city }}"
                                    class="input-box">
                            </div>
                            <div>
                                <label for="zipCode" class="text-gray-600">Zip Code</label>
                                <input type="text" name="zipCode" id="zipCode" value="{{ $user->zipCode }}"
                                    class="input-box">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-span-4 border border-gray-200 p-4 rounded">
                    <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">order summary</h4>
                    <div class="space-y-2">
                        @foreach ($cartItems as $item)
                            <div class="flex justify-between">
                                <div>
                                    <h5 class="text-gray-800 font-medium">{{ $item->product->name }}</h5>
                                </div>
                                <p class="text-gray-600">
                                    {{ $item->quantity }}
                                </p>
                                <p class="text-gray-800 font-medium">$ {{ $item->product->selling_price }}</p>
                            </div>
                            @php $total += $item->quantity * $item->product->selling_price @endphp
                        @endforeach
                    </div>
                    <div
                        class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercas">
                        <p>subtotal</p>
                        <p>$ {{ $total }} </p>
                    </div>

                    <div
                        class="flex justify-between border-b border-gray-200 mt-1 text-gray-800 font-medium py-3 uppercas">
                        <p>shipping</p>
                        <p>Free</p>
                    </div>

                    <div class="flex justify-between text-gray-800 font-medium py-3 uppercas">
                        <p class="font-semibold">Total</p>
                        <p>$ {{ $total }} </p>
                    </div>

                    <div class="flex items-center mb-4 mt-2">
                        <input type="checkbox" name="aggrement" id="aggrement"
                            class="text-primary focus:ring-0 rounded-sm cursor-pointer w-3 h-3">
                        <label for="aggrement" class="text-gray-600 ml-3 cursor-pointer text-sm">I agree to the <a
                                href="#" class="text-primary">terms & conditions</a></label>
                    </div>

                    <button type="submit"
                        class="block w-full py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium">Place
                        order</button>
                </div>
            </div>
        </form>
    </x-slot>
</x-frontend-layout>
