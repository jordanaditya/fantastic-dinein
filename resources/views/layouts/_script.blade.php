    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>

    <script>
        $(document).ready(function() {
            $(".table tbody tr[data-depth]").each(function() {
                var depth = $(this).data("depth");
                var indent = depth * 20; // Mengatur jarak indentasi

                $(this).find(".number-cell").css("padding-left", indent + "px");

                if ($(this).next("tr").data("depth") > depth) {
                    $(this).addClass("expandable");
                }
            });

            $(".expandable").click(function() {
                var depth = $(this).data("depth");
                var nextDepth = depth + 1;

                $(this).toggleClass("expanded");

                $(this).nextAll("tr[data-depth=" + nextDepth + "]").each(function() {
                    if ($(this).data("depth") === nextDepth) {
                        $(this).toggle();
                        $(this).find(".number-cell").toggleClass("no-border");
                    } else {
                        return false;
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var currentPage = localStorage.getItem('currentPage') || '/posts';

            loadPage(currentPage);

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

            $('#brand-link').on('click', function(e) {
                e.preventDefault();
                loadPage('/posts');
                localStorage.setItem('currentPage', '/posts');
            });

            $('#home-link').on('click', function(e) {
                e.preventDefault();
                loadPage('/posts');
                localStorage.setItem('currentPage', '/posts');
            });

            $('#cart-link').on('click', function(e) {
                e.preventDefault();
                loadPage('/cart');
                localStorage.setItem('currentPage', '/cart');
            });

            $('#history-link').on('click', function(e) {
                e.preventDefault();
                loadPage('/history');
                localStorage.setItem('currentPage', '/history');
            });

            $('#recordLabelJob-link').on('click', function(e) {
                e.preventDefault();
                loadPage('/label-job/record');
                localStorage.setItem('currentPage',
                    '/label-job/record');
            });

            $('#recordMutasiBarang-link').on('click', function(e) {
                e.preventDefault();
                loadPage('/mutasi-barang/record');
                localStorage.setItem('currentPage',
                    '/mutasi-barang/record');
            });

            $('#recordLabelEFI-link').on('click', function(e) {
                e.preventDefault();
                loadPage('/label-efi/record');
                localStorage.setItem('currentPage',
                    '/label-efi/record');
            });
        });
    </script>
