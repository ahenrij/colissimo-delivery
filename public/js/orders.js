$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

/**
 * Add an item to items table on orders creation form.
 * 
 * @returns void
 */
function addItem() {
    var no = $('#id_item_no').val()
    var title = $('#id_item_title').val()
    var quantity = $('#id_item_quantity').val()

    // Check errors
    if (no == "") {
        $('#id_item_no').tooltip('show')
        return
    }
    if (title == "") {
        $('#id_item_title').tooltip('show')
        return
    }
    if (quantity == "") {
        $('#id_item_quantity').tooltip('show')
        return
    }

    //Get last item line id
    var id = parseInt($('#increment').attr('value'))

    //Show table if first time
    if (id == 0) {
        $('#id_items_table').removeAttr('hidden')
    }

    //Increment last line id
    id++
    $('#increment').attr('value', id)

    // Append line to table
    $('#id_items_table_body').append(
        '<tr id="item_' + id + '">' +
        '<td id="no_' + id + '"style="min-width: 30px">' + no + '</td>' +
        '<td id="title_' + id + '"style="min-width: 150px">' + title + '</td>' +
        '<td id="quantity_' + id + '" style="min-width: 50px">' + quantity + '</td>' +
        '</tr>')

    // Clear form fields
    $('#id_item_no').val('')
    $('#id_item_title').val('')
    $('#id_item_quantity').val(1)
}

/**
 * 
 * @param {*} event 
 */
function addItemOnEnter(event) {
    if (event.keyCode === 13) {
        event.preventDefault()
        addItem()
    }
}

/**
 * Removes last line of item on ordres creation form
 * 
 * @returns void
 */
function removeLastItem() {
    var id = parseInt($('#increment').attr('value'))
    if (id == 0) return
    $('#item_' + id).remove()
    id--
    $('#increment').attr('value', id)

    if (id == 0) {
        $('#id_items_table').attr('hidden', '')
        return
    }
}

/**
 * Save order with related items via Ajax.
 */
function saveOrder() {
    let form = Object()
    form.url = $('#id_order_form').attr('action')
    form.redirectUrl = $('#id_order_form').attr('redirect')
    form.no = $('#no')
    form.customerName = $('#customer_name')
    form.deliveryAddress = $('#delivery_address')
    form.website = $('#website')
    form.deliveryExpectedAt = $('#delivery_expected_at')
    form.itemsTable = $('#id_items_table')

    if (!validateSaveOrderForm(form)) {
        return
    }

    var items = getItems()

    $.ajax({
        url: form.url,
        type: 'POST',
        data: {
            'no': form.no.val(),
            'customer_name': form.customerName.val(),
            'delivery_address': form.deliveryAddress.val(),
            'website': form.website.val(),
            'delivery_expected_at': form.deliveryExpectedAt.val(),
            'items': items
        },
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                window.location.href = form.redirectUrl
            } else {
                console.log(response.message)
                alert('Oops ! Désolé une erreur s\'est produite. Veuillez réessayer !')
            }
        },
        error: function (result, status, error) {
            console.log(result, status, error)
        }
    })
}

/**
 * Validate save order form inputs.
 * 
 * @param form (Object) Attributes are form elements.
 * @returns true if all fields are valid, false else.
 */
function validateSaveOrderForm(form) {

    //Validate mandatory field
    if (isNaN(parseInt(form.no.val()))) {
        alert("Invalid order number")
        return false
    }
    if (form.customerName.val() == '') {
        alert("Customer name field is mandatory")
        return false
    }
    if (form.deliveryAddress.val() == '') {
        alert("Delivery address field is mandatory")
        return false
    }
    if (form.deliveryExpectedAt.val() == '') {
        alert("Delivery expected date field is mandatory")
        return false
    }
    if (form.itemsTable.is(':hidden')) {
        alert("Order must contains at least 1 item !")
        return false
    }
    return true
}

/**
 * Get items array from items table element.
 * 
 * @returns {Array} array of items as array
 */
function getItems() {
    var items = []
    var length = parseInt($('#increment').attr('value'))
    for (var i = 0; i < length; i++) {
        var item = []
        item.push($('#no_' + (i + 1)).html())
        item.push($('#title_' + (i + 1)).html())
        item.push(parseInt($('#quantity_' + (i + 1)).html()))
        items.push(item)
    }
    return items
}

$('#datetime').datetimepicker({
    "allowInputToggle": true,
    "showClose": true,
    "showClear": true,
    "showTodayButton": true,
    "format": "MM/DD/YYYY hh:mm:ss A",
});
