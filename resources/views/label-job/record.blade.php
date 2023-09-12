<div class="card">
    <div class="card-header">
        <h3 class="card-title"><b>Record Label Job</b></h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="myTable" class="display nowrap w-100">
                <thead>
                    <tr>
                        <th style="width:20px;"></th>
                        <th style="width:5%;">ID Site</th>
                        <th style="width:95%;">Site</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supplierRecords as $record)
                        <tr>
                            <td style="details-control;"></td>
                            <td>{{ $record->stock_code }}</td>
                            <td>{{ $record->material_desc }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $('#myTable').DataTable({
        "stripeClasses": [],
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
</script>
