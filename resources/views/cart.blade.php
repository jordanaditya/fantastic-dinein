    <div class="container" style="margin-top: 50px">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center">CART</h4>
                <div class="card border-0 shadow-sm rounded-md mt-4">
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $item)
                                    <tr id="index_{{ $item['id'] }}">
                                        <td>{{ $item['title'] }}</td>
                                        <td>{{ $item['content'] }}</td>
                                        <td>{{ $item['price'] }}</td>
                                        <td>
                                            <input type="number" class="qty-input" value="{{ $item['qty'] }}"
                                                min="1" data-id="{{ $item['id'] }}">
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm"
                                                onclick="removeFromCart({{ $item['id'] }})">REMOVE</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Event listener untuk perubahan nilai qty
            $('.qty-input').on('change', function() {
                var itemId = $(this).data('id');
                var newQty = $(this).val();

                updateQtyInCart(itemId, newQty);
            });
        });

        function updateQtyInCart(itemId, newQty) {
            $.ajax({
                url: '/update-qty-in-cart', // Ganti dengan URL yang sesuai
                type: 'POST',
                data: {
                    id: itemId,
                    qty: newQty,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle success response, if needed
                    console.log(response);
                    // Update tampilan qty di tabel
                    $('#index_' + itemId + ' .qty-input').val(newQty);
                },
                error: function(xhr) {
                    // Handle error response, if needed
                    console.log(xhr.responseText);
                }
            });
        }

        function removeFromCart(postId) {
            $.ajax({
                url: '/remove-from-cart',
                type: 'POST',
                data: {
                    id: postId,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle success response, if needed
                    console.log(response);
                    // For example, you can show a success message or update the cart content
                    // Instead of location.reload(), you can remove the row directly from the table
                    $('#index_' + postId).remove();
                },
                error: function(xhr) {
                    // Handle error response, if needed
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
