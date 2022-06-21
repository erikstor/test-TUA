$(document).ready(() => {

    let url = '';
    let data;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    setInterval(() => {
        url = $("#quantity_tasks").data('url')
        $.ajax({
            url: url,
            type: "GET",
            success: function (resp) {
                $("#quantity_tasks").html(resp)
            }
        })
    }, 1000)


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

    }


    if (window.location.pathname === '/tasks/list') {

        $("#taksList").DataTable({
            responsive: true,
            columns: [
                {"width": "85%"},
                null,
            ]
        })

        $(document).on('click', '.showButton', ($event) => {

            url = $event.target.dataset.url
            $("#exampleModalLabel").html('')
            $("#bodyModal").html('')
            $("#buttonSave").html('');

            if ($event.target.dataset.type === 'add' || $event.target.dataset.type === 'edit') {
                $("#exampleModalLabel").html(
                    `
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="floatingInput" placeholder="Title..." required>
                      <label for="floatingInput">Title...</label>
                    </div>
                `
                )
                $("#bodyModal").html(`
                    <div class="form-floating">
                      <textarea class="form-control" placeholder="Description..." id="floatingTextarea" required></textarea>
                      <label for="floatingTextarea">Description</label>
                    </div>
                `)
                $("#buttonSave").html(`
                        <button
                        type="button"
                        class="btn btn-primary"
                        id="saveModal"
                        data-id=""
                        data-type="${$event.target.dataset.type}"
                        data-url="${$event.target.dataset.send}"
                        >
                            Save changes
                        </button>`);
            }


            if ($event.target.dataset.type === 'show' || $event.target.dataset.type === 'edit') {
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function (resp) {
                        if ($event.target.dataset.type === 'show') {
                            $("#exampleModalLabel").html(resp.title)
                            $("#bodyModal").html(resp.description)
                        } else {
                            $("#floatingInput").val(resp.title)
                            $("#floatingTextarea").val(resp.description)
                            $("#saveModal").data('id', resp.id)
                        }
                    }
                })
            }

        })


        $(document).on('click', '#buttonSave', ($event) => {

            url = $event.target.dataset.url

            let type = 'POST'
            const data = {
                title: $("#floatingInput").val(),
                description: $("#floatingTextarea").val(),
            }

            if ($event.target.dataset.type === 'edit') {
                data.id = $("#saveModal").data('id')
                type = 'PUT'
            }

            $("#error-panel").addClass('d-none');
            $("#error-content").html('');

            $.ajax({
                url: url,
                type,
                data,
                success: function () {
                    Swal.fire({
                        title: 'Ok!',
                        text: 'We save your changes',
                        icon: 'success',
                        confirmButtonText: 'Cool'
                    })

                    $("#btn-close-modal").click();

                    setTimeout(() => {
                        window.location.reload()
                    }, 1000)

                },
                error: function (resp) {
                    Swal.fire({
                        title: 'Ups!',
                        text: `We can't save your changes`,
                        icon: 'error',
                        confirmButtonText: ':c'
                    })

                    $("#error-panel").removeClass('d-none');

                    let msg = ``
                    for (const item in resp.responseJSON.errors) {
                        msg += `<li>${resp.responseJSON.errors[item]}</li>`
                    }

                    $("#error-content").html(msg);

                },
            })

        })


        $(document).on('click', '.btn-erase', ($event) => {

            url = $event.target.dataset.url

            Swal.fire({
                title: 'Do you want to save the changes ?',
                showDenyButton: true,
                confirmButtonText: 'Yes',
                denyButtonText: `Cancel`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data,
                        success: function () {
                            Swal.fire({
                                title: 'Ok!',
                                text: 'We save your changes',
                                icon: 'success',
                                confirmButtonText: 'Cool'
                            })

                            $("#btn-close-modal").click();

                            setTimeout(() => {
                                window.location.reload()
                            }, 1000)

                        },
                        error: function (resp) {
                            Swal.fire({
                                title: 'Ups!',
                                text: `We can't save your changes`,
                                icon: 'error',
                                confirmButtonText: ':c'
                            })

                            $("#error-panel").removeClass('d-none');

                            let msg = ``
                            for (const item in resp.responseJSON.errors) {
                                msg += `<li>${resp.responseJSON.errors[item]}</li>`
                            }

                            $("#error-content").html(msg);

                        },
                    })
                }

            })


        })

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


