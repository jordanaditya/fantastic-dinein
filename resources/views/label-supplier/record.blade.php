<div class="card">
    <div class="card-header">
        <h3 class="card-title">Expandable Table Tree</h3>
    </div>
    <!-- ./card-header -->

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <tr data-toggle="collapse" data-target="#data1" class="accordion-toggle">
                    <td>1</td>
                    <td>Data Item 1</td>
                    <td>Deskripsi Data Item 1</td>
                </tr>
                <tr>
                    <td colspan="3" class="hiddenRow">
                        <div class="accordian-body collapse" id="data1">
                            <!-- Tabel anak untuk Data Item 1 -->
                            <table class="table table-bordered child-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Header 1</th>
                                        <th>Header 2</th>
                                        <th>Header 3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-toggle="collapse" data-target="#data1-1" class="accordion-toggle">
                                        <td>1.1</td>
                                        <td>Data Item 1.1</td>
                                        <td>Deskripsi Data Item 1.1</td>
                                        <td><a href="#" class="expandable-row">Expand</a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="hiddenRow">
                                            <div class="accordian-body collapse" id="data1-1">
                                                <!-- Tabel anak untuk Data Item 1.1 -->
                                                <table class="table table-bordered child-table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Header 1.1</th>
                                                            <th>Header 1.2</th>
                                                            <th>Header 1.3</th>
                                                            <th><a href="#" class="expandable-row">Expand</a></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Data tabel anak untuk Data Item 1.1 akan diisi melalui JavaScript -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr data-toggle="collapse" data-target="#data2" class="accordion-toggle">
                    <td>2</td>
                    <td>Data Item 2</td>
                    <td>Deskripsi Data Item 2</td>
                </tr>
                <tr>
                    <td colspan="3" class="hiddenRow">
                        <div class="accordian-body collapse" id="data2">
                            <!-- Tabel anak untuk Data Item 2 -->
                            <table class="table table-bordered child-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Header 1</th>
                                        <th>Header 2</th>
                                        <th>Header 3</th>
                                        <th><a href="#" class="expandable-row">Expand</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data tabel anak untuk Data Item 2 akan diisi melalui JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                <!-- Tambahkan Data Item lainnya sesuai kebutuhan -->
            </tbody>
        </table>
    </div>
</div>
    <script>
        $(document).ready(function () {
            // Data untuk tabel anak (child table)
            var dataItem1 = [
                ["1.1.1", "Data 1.1.1.1", "Data 1.1.1.2", "Data 1.1.1.3"],
                ["1.1.2", "Data 1.1.2.1", "Data 1.1.2.2", "Data 1.1.2.3"],
                // Tambahkan data lainnya sesuai kebutuhan
            ];

            var dataItem2 = [
                ["2.1.1", "Data 2.1.1.1", "Data 2.1.1.2", "Data 2.1.1.3"],
                ["2.1.2", "Data 2.1.2.1", "Data 2.1.2.2", "Data 2.1.2.3"],
                // Tambahkan data lainnya sesuai kebutuhan
            ];

            // Fungsi untuk mengisi data ke tabel anak
            function fillChildTable(childTable, data) {
                var tbody = childTable.find("tbody");
                tbody.empty();
                $.each(data, function (index, rowData) {
                    var row = $("<tr>");
                    $.each(rowData, function (key, value) {
                        row.append($("<td>").text(value));
                    });
                    tbody.append(row);
                });
            }

            // Menambahkan event listener untuk meng-expand tabel anak di dalam "Header 1"
            $(".expandable-row").on("click", function (e) {
                e.preventDefault();
                var target = $(this).closest("tr").data("target");
                var childTable = $(target).find(".child-table");
                if (childTable.is(":visible")) {
                    childTable.slideUp();
                } else {
                    childTable.slideDown();
                }
            });

            // Menambahkan data ke tabel anak untuk Data Item 1.1
            var childTableData1_1 = $("#data1-1").find(".child-table");
            fillChildTable(childTableData1_1, dataItem1);

            // Menambahkan data ke tabel anak untuk Data Item 2
            var childTableData2 = $("#data2").find(".child-table");
            fillChildTable(childTableData2, dataItem2);
        });
    </script>