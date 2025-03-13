$(document).on('click', '.save_combo', function () {
    let formData = new FormData($('#comboAddForm')[0]);


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/combo/store',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#comboAddForm')[0].reset();
            $('#comboAddModal').modal('hide');
            toastr.success('Combo Added Successfully');
        },
    });


    function showData() {
        $.ajax({
            url: '/combo/view',
            type: 'GET',
            success: function (data) {
                if (data.status == 200) {

                    const combos = data.combos;
                    // Clear existing table rows if needed
                    $('#showTableData').empty();

                    // Loop through the combos array and append each item
                    combos.forEach(function (combo) {
                        $('#showTableData').append(`
                        <tr>
                            <td>${combo.id}</td>
                            <td>${combo.name ?? ""}</td>
                            <td>${combo.offerd_price}</td>
                            <td>
                            <img src="/uploads/combo/${combo.image}" alt="Combo Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                            </td>
                            <td>
                                <button class="btn btn-sm btn-danger status_inactive" value="${combo.status}">${combo.status}</button>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-info dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" class="dropdown-item edit" data-id="${combo.id}">Edit</a></li>
                                        <li><a href="#" class="dropdown-item delete" data-id="${combo.id}">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        `);
                    });

                }
            },
        });
    }

    showData();
});
