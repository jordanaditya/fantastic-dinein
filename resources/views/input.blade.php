<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">LARAVEL CRUD AJAX</a>
            </h4>
            <div class="card border-0 shadow-sm rounded-md mt-4">
                <div class="card-body">

                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="btn-create-post">TAMBAH</a>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Price</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table-posts">
                            @foreach ($posts as $post)
                                <tr id="index_{{ $post->id }}">
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->content }}</td>
                                    <td>{{ $post->price }}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $post->id }}"
                                            class="btn btn-primary btn-sm">EDIT</a>
                                        <a href="javascript:void(0)" id="btn-delete-post" data-id="{{ $post->id }}"
                                            class="btn btn-danger btn-sm">DELETE</a>
                                        <a href="javascript:void(0)" id="btn-add-post" data-id="{{ $post->id }}"
                                            data-title="{{ $post->title }}" data-content="{{ $post->content }}"
                                            data-price="{{ $post->price }}" class="btn btn-success btn-sm">ADD CART
                                            +</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.modal-create')
@include('components.modal-edit')
@include('components.delete-post')

<script>
    $(document).ready(function() {
        function addToCart(postId, postTitle, postContent, postPrice) {
            $.ajax({
                url: '/add-to-cart',
                type: 'POST',
                data: {
                    id: postId,
                    title: postTitle,
                    content: postContent,
                    price: postPrice,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle success response, if needed
                    console.log(response);
                    // For example, you can show a success message or update the cart count
                },
                error: function(xhr) {
                    // Handle error response, if needed
                    console.log(xhr.responseText);
                }
            });
        }

        // Add click event listener to the "ADD CART +" buttons
        $('#table-posts').on('click', '#btn-add-post', function() {
            var postId = $(this).data('id');
            var postTitle = $(this).data('title');
            var postContent = $(this).data('content');
            var postPrice = $(this).data('price');
            addToCart(postId, postTitle, postContent, postPrice);
        });
    });
</script>
