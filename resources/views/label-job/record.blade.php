<div class="card">
    <div class="card-header">
        <h3 class="card-title"><b>Record Label Job</b></h3>
    </div>
    <div class="card-body">
        <input type="date" id="start_date" placeholder="Tanggal Awal" value="">
        <input type="date" id="end_date" placeholder="Tanggal Akhir" value="">
        <button id="filter_btn">Filter</button>
        <div class="table-responsive">
            <table id="myTable" class="display nowrap w-100">
                <thead>
                    <tr>
                        <th style="width:20px;"></th>
                        <th style="width:5%;">Stockcode</th>
                        <th style="width:95%;">Bahan</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Inisialisasi tanggal awal dan tanggal akhir ke hari ini
        var today = new Date();
        var startDate = today.toISOString().slice(0, 10);
        var endDate = today.toISOString().slice(0, 10);

        // Mengisi input tanggal awal dan tanggal akhir dengan hari ini
        $('#start_date').val(startDate);
        $('#end_date').val(endDate);

        var table = $('#myTable').DataTable({
            "stripeClasses": [],
            ajax: {
                url: '/label-job/master',
                dataSrc: 'data',
                data: function(d) {
                    // Mengambil nilai tanggal awal dan akhir dari input
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                },
            },
            columns: [{
                    className: 'details-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                {
                    data: 'stock_code'
                },
                {
                    data: 'material_desc'
                }
            ],
            order: [
                [1, 'asc']
            ]
        });

        // Menangani filter saat tombol "Filter" ditekan
        $('#filter_btn').on('click', function() {
            // Menggambar ulang tabel untuk menerapkan filter
            table.ajax.reload();
        });
    });
</script>
