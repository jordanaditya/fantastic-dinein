<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Ajax CRUD</title>
    <style>
        body {
            background-color: lightgray !important;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="" id="brand-link">Your Brand</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item" id="home-link">
                    <a class="nav-link" href="">Home</a>
                </li>
                <li class="nav-item" id="cart-link">
                    <a class="nav-link" href="">Cart</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="margin-top: 50px" id="showPage">
    </div>

    <script>
        $(document).ready(function() {
            // Ambil URL halaman yang akan dimuat dari localStorage atau setel ke halaman beranda default
            var currentPage = localStorage.getItem('currentPage') || '/posts';

            // Muat konten halaman sesuai dengan URL yang diambil
            loadPage(currentPage);

            // Fungsi untuk memuat halaman menggunakan AJAX
            function loadPage(pageUrl) {
                $.ajax({
                    url: pageUrl,
                    type: 'GET',
                    success: function(data) {
                        $('#showPage').html(data);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            // Handler ketika tombol "Home" diklik
            $('#home-link').on('click', function(e) {
                e.preventDefault();
                loadPage('/posts');
                localStorage.setItem('currentPage', '/posts'); // Simpan URL halaman ke localStorage
            });

            // Handler ketika tombol "Cart" diklik
            $('#cart-link').on('click', function(e) {
                e.preventDefault();
                loadPage('/cart');
                localStorage.setItem('currentPage', '/cart'); // Simpan URL halaman ke localStorage
            });

            // Handler ketika brand/logo diklik
            $('#brand-link').on('click', function(e) {
                e.preventDefault();
                loadPage('/posts');
                localStorage.setItem('currentPage', '/posts'); // Simpan URL halaman ke localStorage
            });
        });
    </script>
</body>

</html>