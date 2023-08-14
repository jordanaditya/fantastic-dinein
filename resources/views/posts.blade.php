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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item" id="home-link">
                    <a class="nav-link" href="" >Home</a>
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
            loadHomeLink();
            function loadAboutPage() {
                $.ajax({
                    url: '/cart',
                    type: 'GET',
                    success: function(data) {
                        $('#showPage').html(data);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            $('#cart-link').on('click', function(e) {
                e.preventDefault();
                loadAboutPage();
            });

            function loadHomeLink() {
                $.ajax({
                    url: '/posts',
                    type: 'GET',
                    success: function(data) {
                        $('#showPage').html(data);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            $('#home-link').on('click', function(e) {
                e.preventDefault();
                loadHomeLink();
            });

            $('#brand-link').on('click', function(e) {
                e.preventDefault();
                loadHomeLink();
            });
        });
    </script>
</body>

</html>
