
function todayDate(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }

    return  dd + '-' + mm + '-' + yyyy;
}

function deleteData(did, url) {
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            id: did
        },
        success: function (resp) {
            if (resp.code == 1) {
                window.location.reload();
            }
        },
        error: function () {
            window.location.reload();
        },
        done: function () {
            window.location.reload();
        }
    });
}

function directdelete(url) {
    window.location = url;
}

function datatable(table, reportTitle, cols) {
    $(table).DataTable({
        "autoWidth": false,
        "responsive": true,
        dom: 'lBfrtip',
        buttons: [{
            className: 'btn btn-default',
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o">XLS</i>',
            title: reportTitle,
            exportOptions: {
                columns: cols
            }
        },
        {
            className: 'btn btn-default',
            extend: 'pdfHtml5',
            text: '<i class="fa fa-file-pdf-o">PDF</i>',
            title: reportTitle,
            exportOptions: {
                columns: cols
            }
        }
        ]

    });
}

function validateData(form, rules) {
    $(form).validate({
        rules: rules,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
}