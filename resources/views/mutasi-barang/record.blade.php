<div class="card">
    <div class="card-header">
        <h3 class="card-title"><b>Report Mutasi Barang</b></h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="record-table" class="container-fluid"></div>
        </div>
    </div>
</div>
<script>
    var barangs = [];
    @foreach ($supplierRecord as $record)
        barangs.push({
            data: {
                'Title': '{{ $record->barcode_material }}',
            },
            kids: []
        });
    @endforeach

    var settings = {
        iDisplayLength: 15,
        bLengthChange: false,
        bFilter: false,
        bSort: false,
        bInfo: false,
        searching: false,
    };

    var table = new nestedTables.TableHierarchy(
        'record-table',
        barangs,
        settings
    );
    table.initializeTableHierarchy();
</script>
