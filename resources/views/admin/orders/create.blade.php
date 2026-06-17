@extends('layouts.dashboard')

@section('title', 'Create Order')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Create Order</h2>
    <p class="text-gray-600">Create a new order</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-4xl">
    <form action="{{ route('admin.orders.store') }}" method="POST" id="orderForm">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Customer <span class="text-red-500">*</span></label>
                <select name="user_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" required>
                    <option value="">Select Customer</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
                <input type="text" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Shipping Address <span class="text-red-500">*</span></label>
            <textarea name="shipping_address" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
            <textarea name="notes" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500"></textarea>
        </div>

        <hr class="my-4">

        <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Items</h3>
        <div id="itemsContainer">
            <div class="item-row grid grid-cols-1 md:grid-cols-4 gap-4 mb-3">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Product</label>
                    <select name="items[0][product_id]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" required>
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Quantity</label>
                    <input type="number" name="items[0][quantity]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" value="1" min="1" required>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Price</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 item-price" readonly>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Subtotal</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 item-subtotal" readonly>
                </div>
            </div>
        </div>

        <button type="button" onclick="addItem()" class="mb-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
            + Add Item
        </button>

        <div class="text-right text-xl font-bold mt-4">
            Total: <span id="totalDisplay">Rp 0</span>
        </div>

        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg transition">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">Create Order</button>
        </div>
    </form>
</div>

<script>
let itemCount = 1;

function addItem() {
    const container = document.getElementById('itemsContainer');
    const template = container.querySelector('.item-row').cloneNode(true);
    
    // Update name attributes
    const selects = template.querySelectorAll('select');
    const inputs = template.querySelectorAll('input');
    
    selects.forEach(el => {
        el.name = el.name.replace(/\[\d+\]/, `[${itemCount}]`);
        el.value = '';
    });
    
    inputs.forEach(el => {
        el.name = el.name.replace(/\[\d+\]/, `[${itemCount}]`);
        el.value = el.name.includes('quantity') ? '1' : '';
    });
    
    container.appendChild(template);
    itemCount++;
}

// Auto-calculate subtotal
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('change', function(e) {
        if (e.target.name.includes('product_id') || e.target.name.includes('quantity')) {
            const row = e.target.closest('.item-row');
            const select = row.querySelector('select');
            const qty = row.querySelector('input[type="number"]');
            const priceInput = row.querySelector('.item-price');
            const subtotalInput = row.querySelector('.item-subtotal');
            
            if (select.value && qty.value) {
                const price = parseFloat(select.options[select.selectedIndex]?.dataset?.price || 0);
                const subtotal = price * parseInt(qty.value);
                
                priceInput.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(price);
                subtotalInput.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
            }
            
            calculateTotal();
        }
    });
});

function calculateTotal() {
    const subtotals = document.querySelectorAll('.item-subtotal');
    let total = 0;
    subtotals.forEach(el => {
        const val = el.value.replace(/[^0-9]/g, '');
        total += parseInt(val) || 0;
    });
    document.getElementById('totalDisplay').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
}
</script>
@endsection