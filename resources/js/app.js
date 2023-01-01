


if (window.location.href === 'http://pos.project:8080/transactions/page') {
    $(function () {
        var user_id = $('#user_id');
        var item_id;
        var quantity_item;
        const items = $('#items');
        const quanitiy = $('#quantity');
        const price = $('#price');
        const addItem = $('#add-item');
        const table = $('tbody');
        const totalSalesElement = $('#total-sales');
        let totalSales = 0;




        //! get all transactions today  and delete transactions
        $.ajax({
            type: "get",
            url: "http://pos.project:8080/api/transaction",
            success: function (response) {
                i = 1;
                response.body.forEach(element => {
                    table.append(`
                <tr id= "${element.id}">
                    <td>${i++}</td>
                    <td>${element.item_name}</td>
                    <td>${element.quantity}</td>
                    <td>$ ${element.total}</td>
                    <td>
                    <a data-id="${element.id}"><i id="trash" class="fa-solid fa-trash pe-3"></i></a>
                    <a href="/transactions/edit?id=${element.id}&item_id=${element.item_id}"><i id="edit" class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
                `);
                    $(`a[data-id="${element.id}"]`).click(function () {
                        let data = {
                            id: element.id,
                            item_id: element.item_id,
                            quantity: element.quantity
                        };
                        $.ajax({
                            type: "post",
                            url: "http://pos.project:8080/api/transaction/delete",
                            data: JSON.stringify(data),
                            success: function (response) {
                                totalSales = parseInt(totalSales) - parseInt(element.total);
                                totalSalesElement.text(totalSales);
                                swal({
                                    title: 'The Transaction Deleted',
                                    text: 'Redirecting...',
                                    icon: 'success',
                                    timer: 2000,
                                    buttons: false,
                                });
                                $(`tr[id=${element.id}]`).remove();
                            },
                            error: function (e) {
                            }

                        });
                    })
                    totalSales = parseInt(totalSales) + parseInt(element.total);
                });


                totalSalesElement.text(totalSales);
            }
        });



        //! fetch all items and show in the input select
        $.ajax({
            type: "get",
            url: "http://pos.project:8080/api/items",
            success: function (response) {
                var id_data = 1;
                response.body.forEach(element => {
                    $('#items').append(`
                <option id = "${id_data++}" value = ${element.id}> ${element.title}</option>
                `);
                });
            }
        });


        //! get item by id sellected from input select 
        $("#items").change(function () {
            item_id = $(this).children(":selected").attr("value")
            $.ajax({
                type: "post",
                url: "http://pos.project:8080/api/item",
                data: JSON.stringify({ id: item_id }),
                success: function (response) {
                    $("#quantity").attr({
                        "max": response.body.quantity,
                        "value": $("#quantity").val(),        // substitute your own         // values (or variables) here
                    });

                    $('#quantity').change(function () {
                        quantity_item = $('#quantity').val(),
                            $("#price").attr({
                                "value": response.body.price * $('#quantity').val(),        // substitute your own         // values (or variables) here
                            });
                    });
                },
            });

        });



        //! create transaction and update item quantity from table item and save the user_id created the transaction and transaction_id from this transaction
        addItem.click(function (e) {
            e.preventDefault();
            let data = {
                item_id: item_id,
                quantity: quantity_item,
                total: price.val(),
                user_id: user_id.val(),
            };
            if (data.quantity != 0) {
                $.ajax({
                    type: "post",
                    url: "http://pos.project:8080/api/transaction/create",
                    data: JSON.stringify(data),

                    success: function (response) {
                        swal({
                            title: 'The Transaction Add',
                            text: 'Redirecting...',
                            icon: 'success',
                            timer: 2000,
                            buttons: false,
                        });
                        i = 1;
                        response.body.forEach(element => {
                            table.append(`
                <tr id= "${element.id}">
                    <td>${i++}</td>
                    <td>${element.title_name}</td>
                    <td>${element.quantity}</td>
                    <td>$ ${element.total}</td>
                    <td>
                    <a data-id="${element.id}"><i id="trash" class="fa-solid fa-trash pe-3"></i></a>
                    <a href="/transactions/edit?id=${element.id}&item_id=${element.item_id}"><i id="edit" class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
                `);
                            $(`a[data-id="${element.id}"]`).click(function () {
                                let data = {
                                    id: element.id,
                                    item_id: element.item_id,
                                    quantity: element.quantity
                                };
                                $.ajax({
                                    type: "post",
                                    url: "http://pos.project:8080/api/transaction/delete",
                                    data: JSON.stringify(data),
                                    success: function (response) {
                                        totalSales = parseInt(totalSales) - parseInt(element.total);
                                        totalSalesElement.text(totalSales);
                                        swal({
                                            title: 'The Transaction Deleted',
                                            text: 'Redirecting...',
                                            icon: 'success',
                                            timer: 2000,
                                            buttons: false,
                                        });
                                        $(`tr[id="${element.id}"]`).remove();
                                    },
                                    error: function (e) {
                                    }
                                });
                            })
                            totalSales = parseInt(totalSales) + parseInt(element.total);
                        });
                        totalSalesElement.text(totalSales);

                    },
                    error: function (e) {
                        swal({
                            title: 'The Item is Empty',
                            text: 'Redirecting...',
                            icon: 'error',
                            timer: 2000,
                            buttons: false,
                        });
                    }
                });
            } else {
                swal({
                    title: 'You must enter the required quantity or required item',
                    text: 'Redirecting...',
                    icon: 'warning',
                    timer: 2000,
                    buttons: false,
                });
            }
        });
    });
}
