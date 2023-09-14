<div class="card">
    <div class="card-header">
        <h3 class="card-title"><b>Record Label Supplier</b></h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="myTable" class="display nowrap w-100">
                <thead>
                    <tr>
                        <th></th>
                        <th style="width:98%;">Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supplierCategories as $record)
                        <tr>
                            <td style="details-control;"></td>
                            @if ($record->paper_type == 'R')
                                <td>Web Paper</td>
                            @elseif($record->paper_type == 'S')
                                <td>Sheetfed Paper</td>
                            @else
                                <td>Paper</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    td.details-control {
        background: url(https://www.datatables.net/examples/resources/details_open.png) no-repeat center center;
        cursor: pointer;
        filter: grayscale(100%);
        transition: .5s;
    }

    tr.shown td.details-control {
        background: url(https://www.datatables.net/examples/resources/details_close.png) no-repeat center center;
        filter: grayscale(100%);
        transition: .5s;
    }

    td.details-control1 {
        background: url(https://www.datatables.net/examples/resources/details_open.png) no-repeat center center;
        cursor: pointer;
        filter: grayscale(100%);
        transition: .5s;
    }

    tr.shown td.details-control1 {
        background: url(https://www.datatables.net/examples/resources/details_close.png) no-repeat center center;
        filter: grayscale(100%);
        transition: .5s;
    }

    td.details-control2 {
        background: url(https://www.datatables.net/examples/resources/details_open.png) no-repeat center center;
        cursor: pointer;
        filter: grayscale(100%);
        transition: .5s;
    }

    tr.shown td.details-control2 {
        background: url(https://www.datatables.net/examples/resources/details_close.png) no-repeat center center;
        width: 0px transition: .5s;
        filter: grayscale(100%);
    }
</style>
<script>
    var childEditors = {};
    var childTable;
    var childTable2;

    $(document).ready(function() {
        function format(rowData) {
            var paper_type = rowData.paper_type;
            if (paper_type === "Sheetfed Paper") {
                paper_type = "S";
            } else if (paper_type === "Web Paper") {
                paper_type = "R";
            }
            var childTable = '<table id="stockcode' + paper_type +
                '" class="display nowrap w-100" width="100%">' +
                '<thead>' +
                '<tr>' +
                '<th style=""></th>' +
                '<th style="width:10%;">Stockcode</th>' +
                '<th style="width:10%;">Tanggal Input</th>' +
                '<th style="width:30%;">Supplier</th>' +
                '<th style="width:30%;">Nama Barang</th>' +
                '<th style="width:20%;">Qty Barcode</th>' +
                '</tr>' +
                '</thead>' +
                '</table>';
            return childTable;
        }

        function format2(rowData) {
            var childTable = '<table id="barcode' + rowData.stock_code +
                '" class="display nowrap w-100" width="100%">' +
                '<thead>' +
                '<tr>' +
                '<th>No</th>' +
                '<th>Barcode</th>' +
                '<th>Qty</th>' +
                '<th>Status Print</th>' +
                '<th>Waktu Input</th>' +
                '<th>Aksi</th>' +
                '</tr>' +
                '</thead>' +
                '</table>';
            return childTable;
        }

        var table = $('#myTable').DataTable({
            "stripeClasses": [],
            columns: [{
                    className: 'details-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                {
                    data: 'paper_type'
                },
            ],
            order: [
                [1, 'asc']
            ]
        });

        // // Add event listener for opening and closing first level childdetails(stockcode)
        $('#myTable tbody').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var rowData = row.data();

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');

                // Destroy the Child Datatable
                $('#stockcode' + rowData.paper_type).DataTable().destroy();
            } else {
                // Open this row
                row.child(format(rowData)).show();
                var paper_type = rowData.paper_type;
                if (paper_type === "Sheetfed Paper") {
                    paper_type = "S";
                } else if (paper_type === "Web Paper") {
                    paper_type = "R";
                }

                childTable = $('#stockcode' + paper_type).DataTable({
                    "stripeClasses": [],
                    ajax: {
                        url: '/label-supplier/record/get-stockcode',
                        dataSrc: 'data',
                        data: function(d) {
                            return {
                                paper_type: paper_type,
                            };
                        },
                    },
                    columns: [{
                            className: 'details-control1',
                            orderable: false,
                            data: null,
                            defaultContent: '',
                        },
                        {
                            data: "stock_code",
                            title: "StockCode"
                        },
                        {
                            data: "created_at",
                            render: function(data) {
                                var date = new Date(data);
                                var day = ("0" + date.getDate()).slice(-2);
                                var month = ("0" + (date.getMonth() + 1)).slice(-2);
                                var year = date.getFullYear();
                                var hours = ("0" + date.getHours()).slice(-2);
                                var minutes = ("0" + date.getMinutes()).slice(-2);
                                var seconds = ("0" + date.getSeconds()).slice(-2);
                                return day + "/" + month + "/" + year;
                            },
                            title: "Tanggal Input"
                        },
                        {
                            data: "supplier_name",
                            title: "Supplier"
                        },
                        {
                            data: "material_desc",
                            title: "Nama Barang"
                        },
                        {
                            data: "barcode_qty",
                            title: "Qty Barcode"
                        },
                    ],
                    select: false,
                });

                tr.addClass('shown');
            }
        });

        // Add event listener for opening and closing second level childdetails
        $('tbody').on('click', 'td.details-control1', function() {
            var tr = $(this).closest('tr');
            var row = childTable.row(tr);
            var rowData = row.data();

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');

                // Destroy the Child Datatable
                $('#barcode' + rowData.stock_code).DataTable().destroy();
            } else {
                // Open this row
                row.child(format2(rowData)).show();
                var stock_code = rowData.stock_code;
                childTable2 = $('#barcode' + stock_code).DataTable({
                    "stripeClasses": [],
                    ajax: {
                        url: '/label-supplier/record/get-barcode',
                        dataSrc: 'data',
                        data: function(d) {
                            return {
                                stock_code: stock_code,
                            };
                        },
                    },
                    "columnDefs": [{
                        "targets": 0, // Kolom yang ingin Anda ganti dengan penomoran
                        "data": null,
                        "render": function(data, type, row, meta) {
                            // Mengembalikan nomor urut dari 1 hingga seterusnya
                            return meta.row + 1;
                        }
                    }],
                    columns: [
                        {
                            orderable: false,
                            data: null,
                            defaultContent: '',
                            title: 'No'
                        },
                        {
                            data: "barcode_material",
                        },
                        {
                            data: "material_qty",
                        },
                        {
                            data: function(row) {
                                var printed = row.barcodes && row.barcodes.printed;
                                if (printed === null || printed === undefined ||
                                    printed === "") {
                                    return "Belum Print";
                                } else {
                                    return "Sudah Print";
                                }
                            },
                        },
                        {
                            data: "created_at",
                            render: function(data) {
                                var date = new Date(data);
                                var day = ("0" + date.getDate()).slice(-2);
                                var month = ("0" + (date.getMonth() + 1)).slice(-2);
                                var year = date.getFullYear();
                                var hours = ("0" + date.getHours()).slice(-2);
                                var minutes = ("0" + date.getMinutes()).slice(-2);
                                var seconds = ("0" + date.getSeconds()).slice(-2);
                                return hours +
                                    ":" + minutes + ":" + seconds;
                            }
                        },
                        {
                            render: function(data, type, row) {
                                return '<input type="checkbox" class="checkBoxBarcode" name="check[]" value="' +
                                    row
                                    .barcode_material + '">';
                            },
                            title: "Aksi"
                        }
                    ],
                    select: false,
                });
                tr.addClass('shown');
            }
        });
    });
</script>
