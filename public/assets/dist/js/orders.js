$("#item-product").change(function() {
    const price = atob($(this).find(':selected').data('price'))
    const quantity = $("#quantity").val()
    const discount = atob($("#discount").find(':selected').data('pk'))
    const amount = price * quantity
    //compute discount
    const total_discount = ((discount/100)*amount)
    const total_amount = amount - total_discount

    $("#amount").val(amount)
    $("#total-per-item").val(total_amount)
})

$("#quantity").change(function() {
    const price = atob($("#item-product").find(':selected').data('price'))
    const quantity = $("#quantity").val()
    const discount = atob($("#discount").find(':selected').data('pk'))
    const amount = price * quantity
    //compute discount
    const total_discount = ((discount/100)*amount)
    const total_amount = amount - total_discount

    $("#amount").val(amount)
    $("#total-per-item").val(total_amount)
})

$("#discount").change(function() {
    const price = atob($("#item-product").find(':selected').data('price'))
    const quantity = $("#quantity").val()
    const discount = atob($("#discount").find(':selected').data('pk'))
    const amount = price * quantity
    //compute discount
    const total_discount = ((discount/100)*amount)
    const total_amount = amount - total_discount

    $("#amount").val(amount)
    $("#total-per-item").val(total_amount)
})

$("#location").change(function () {
    $("#delivery-total").text("₱ "+atob($(this).find(':selected').data('pk')))
    const all_in = computeAllIn($(this).find(':selected').data('pk'))
    $("#all-in").text("₱ "+all_in)
})

$("#add-button").click(function (e) {
    const price = atob($("#item-product").find(':selected').data('price'))
    const product_id = $("#item-product").val()
    const product_name = $("#item-product").find(':selected').text()

    const quantity = $("#quantity").val()

    const amount = $("#amount").val()

    const discount = $("#discount").find(':selected').text()
    const discount_amount = atob($("#discount").find(':selected').data('pk'))
    const discount_id = $("#discount").val()

    const total_amount = $("#total-per-item").val()

    const delivery_fee = $("#location").find(':selected').data('pk')

    const html = `<div class="form-row form-body" style="background-color: #ffeeba;">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="small mb-1">ORDER NAME</label>
                                <input type="text" readonly value="${product_name}" data-price="${amount}" data-pk="${product_id}" class="form-control product-name">
                            </div>
                            <div class="col-md-2">
                                <label class="small mb-1" >QUANTITY</label>
                                <input required autofocus="autofocus" value="${quantity}" readonly class="form-control quantity" type="number"/>
                            </div>
                            <div class="col-md-2">
                                <label class="small mb-1" >AMOUNT</label>
                                <input required autofocus="autofocus" class="form-control amount"   value="${amount}" readonly type="text"/>
                            </div>
                            <div class="col-md-2">
                                <label class="small mb-1">DISCOUNT</label>
                                <input type="text" readonly value="${discount}" data-discount_amt="${discount_amount}" data-pk="${discount_id}" class="form-control discount-name">
                            </div>
                            <div class="col-md-2">
                                <label class="small mb-1" >TOTAL AMT</label>
                                <input required autofocus="autofocus" class="form-control total-per-item" value="${total_amount}" readonly type="text"/>
                            </div>
                            <div class="col-md-1 pull-right">
                                <label class="small mb-1 " >&nbsp;</label><br>
                                <button class="btn btn-sm btn-danger  remove-button" type="button"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div><hr>`
    $("#attach-body").append(html)
    $("#delivery-total").text("₱ "+atob(delivery_fee))
    $("#sub-total").text("₱ "+computeSubTotal())
    const all_in = computeAllIn(delivery_fee)
    $("#all-in").text("₱ "+all_in)
    clearInputs()
})

$(document).on('click', '.remove-button', function () {
    const button = $(this)
    swal({
        title: "WARNING!",
        text: "Remove this from the list?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            button.parent().parent().parent().remove()
            $("#sub-total").text("₱ "+computeSubTotal())
            const delivery_fee = $("#location").find(':selected').data('pk')
            const all_in = computeAllIn(delivery_fee)
            $("#all-in").text("₱ "+all_in)
        }
    });
})

$("#add-activity-submit").submit(function (e) {
    e.preventDefault()
    if($("#location").val() == "" || $("#location").val() == "Select Location"){
        swal("Warning", "Location is required", "error")
    }
    else{
        const customer = $("#customer").val()
        const location = $("#location").val()
        const delivery_amount = $("#location").find(':selected').data('pk')
        const orders = {
            "customer_name" : customer,
            "delivery_id" : location,
            "deliver_amount" : atob(delivery_amount),
            "sub_total": computeSubTotal(),
            "total_amount" : computeAllIn(delivery_amount)
        }
        let order_line = []
        const product = getAllProductID()
        const quantity = getAllQuantity()
        const discount = getDiscount()
        const total = getAllTotalAmount()

        product && product.map((x, index) => {
            order_line.push({
                "product_id" : x.product_id,
                "amount" : x.product_amount,
                "quantity" : quantity[index],
                "product_total_amount" : total[index],
                "discount_id" : discount.discount_id[index],
                "discount_amount" : discount.discount_amount[index]
            })
        })
        $.post("manageOrders", {data: order_line, orders}).done(function(msg){
            console.log(msg)
            swal("Great! "+msg.message, {
                icon: "success",
            }); // returns when successful insert
            setTimeout(function () {
                window.location = "home"
            }, 1500) //refresh the page
        })
        .fail(function(xhr, status, error) {
            console.log(error)
            swal("Error! "+error, {
                icon: "error",
            });
        }) //returns when error occur
    }
})

$(".view").click(function () {
    const order_id = $(this).data('pk')
    let html = ``
    $.post("manageOrders", {type:"view", order_id}, function (response) {
        const data = jQuery.parseJSON(response)
        console.log(data)
        $("#view-customer").val(data[0].customer_name)
        $("#view-location").val(data[0].delivery_id)
        $("#view-sub-total").text(data[0].sub_total)
        $("#view-delivery-total").text(data[0].deliver_amount)
        $("#view-all-in").text(data[0].total_amount)
        data && data.map(x => {
            html += `<div class="form-row form-body" style="background-color: #ffeeba;">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="small mb-1">ORDER NAME</label>
                                        <input type="text" readonly value="${x.product_name}" disabled class="form-control product-name">
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1" >QUANTITY</label>
                                    <input required autofocus="autofocus" value="${x.quantity}" readonly class="form-control quantity" type="number"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1" >AMOUNT</label>
                                    <input required autofocus="autofocus" class="form-control amount"   value="${x.amount}" readonly type="text"/>
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1">DISCOUNT</label>
                                    <input type="text" readonly value="${x.discount_amount} %" class="form-control discount-name">
                                </div>
                                <div class="col-md-2">
                                    <label class="small mb-1" >TOTAL AMT</label>
                                    <input required autofocus="autofocus" class="form-control total-per-item" value="${x.product_total_amount}" readonly type="text"/>
                                </div>
                            </div>
                        </div>
                    </div><hr>`
        })
        $("#view-attach-body").html(html)
        $("#view-order-modal").modal('show')
    })
})

//------------- FUNCTIONS ---------

const computeSubTotal = () => {
    let sub_total = 0
    $(".total-per-item").each(function (e) {
        sub_total += parseFloat($(this).val())
    })
    return sub_total.toFixed(2)
}

const computeAllIn = (delivery_fee) => {
    const all_in = parseFloat(computeSubTotal()) - parseFloat(atob(delivery_fee))
    return all_in.toFixed(2)
}

const clearInputs = () => {
    $("#item-product").val('')
    $("#quantity").val(1)
    $("#amount").val(0)
    $("#discount").val(0)
    $("#total-per-item").val(0)
}//clears the data of input fields after clicking ta add button

const getAllProductID = () => {
    let product = []
    $(".product-name").each(function () {
        product.push({
                "product_id" : $(this).data('pk'),
                "product_amount" : $(this).data('price')
        })
    })
    return product
} //get array of product_id and product_amount

const getAllQuantity = () => {
    let product_quantity = []
    $(".quantity").each(function () {
        product_quantity.push($(this).val())
    })
    return product_quantity
}

const getDiscount = () => {
    let discount_amount = []
    let discount_id = []
    $(".discount-name").each(function () {
        discount_amount.push($(this).data('discount_amt'))
        discount_id.push($(this).data('pk'))
    })
    return {"discount_amount" : discount_amount, "discount_id" : discount_id}
}

const getAllTotalAmount = () => {
    let total_amount = []
    $(".total-per-item").each(function () {
        total_amount.push($(this).val())
    })
    return total_amount
}










