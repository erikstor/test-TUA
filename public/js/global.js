$(document).ready(() => {

    let url = '';
    let data;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', '#send-logout', () => {
        $('#logout-form').submit()
    })

    if (window.location.pathname === '/users/list') {

        url = $("#dataDiv").data('urlGetUser')

        $.ajax({
            url: url,
            type: "GET",
            success: function (resp) {
                data = resp

                let dataSet = data.sort(compare);

                dataSet = dataSet.map((current) => {
                    return {
                        fullname: `${current.first_name} ${current.last_name}`,
                        phone: `${current.phone}`,
                        email: `${current.email}`,
                        status: `${(current.status === 1) ? 'Activo' : 'Inactivo'}`,
                    }
                })

                $("#userList").DataTable({
                    responsive: true,
                    data: dataSet,
                    columns: [
                        {
                            data: "fullname",

                        },
                        {
                            data: "phone",
                        },
                        {
                            data: "email",
                        },

                        {
                            data: "status",
                        },
                    ],
                });
            },
        })


        // $("#indexUsers").DataTable({
        //     destroy: true,
        //     responsive: true,
        //     searching: true,
        //     orderable: false,
        //     lengthChange: false,
        //     processing: true,
        //     serverSide: true,
        //     pageLength: 10,
        //     autoWidth: true,
        //     ajax: {
        //         url: url,
        //         data: function (d) {
        //             delete d.columns;
        //             return {
        //                 start: d.start,
        //                 length: d.length,
        //                 search: d.search.value,
        //                 draw: d.draw,
        //             };
        //         },
        //         type: "get",
        //     },
        //
        // });


    }

})


function compare(a, b) {
    if (a.first_name < b.first_name) {
        return -1;
    }
    if (a.first_name > b.first_name) {
        return 1;
    }
    return 0;
}


