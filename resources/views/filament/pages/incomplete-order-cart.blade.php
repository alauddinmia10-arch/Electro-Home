<div class="space-y-4">
    @if(isset($cartData['items']) && is_array($cartData['items']) && count($cartData['items']) > 0)
        <table class="w-full text-left text-sm border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Product</th>
                    <th class="p-2 border text-center">Quantity</th>
                    <th class="p-2 border text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartData['items'] as $item)
                    <tr>
                        <td class="p-2 border">{{ $item['name'] ?? 'Unknown' }}</td>
                        <td class="p-2 border text-center">{{ $item['quantity'] ?? 1 }}</td>
                        <td class="p-2 border text-right">৳{{ number_format((float)($item['price'] ?? 0), 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="flex justify-end pt-4 space-y-1">
            <div class="text-right">
                <div class="text-sm text-gray-600">Subtotal: ৳{{ number_format((float)($cartData['subtotal'] ?? 0), 2) }}</div>
                <div class="text-base font-bold text-gray-900 mt-1">Total: ৳{{ number_format((float)($cartData['total'] ?? 0), 2) }}</div>
            </div>
        </div>
    @else
        <div class="text-center text-gray-500 py-4">
            No items in cart.
        </div>
    @endif
</div>
