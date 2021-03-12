$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
}); //handles csrf token for all request

$("#add-product-submit").submit(function (e) {
    e.preventDefault()
    const product_name = $("#product-name").val() //get the input value of product_name
    const amount = $("#amount").val() //get the input value of amount
    $.post('manageProduct', {product_name, amount, type:"add"}) //sends request to the server
        .done(function(msg){
            swal("Great! "+msg.message, {
                icon: "success",
            }); // returns when successful insert
            setTimeout(function () {
                window.location = "productConfiguration"
            }, 1500) //refresh the page
        })
        .fail(function(xhr, status, error) {
            swal("Error! "+error, {
                icon: "error",
            });
        }) //returns when error occur
}) //send request for creating new configuration
//
$(".delete-product").click(function(e){
    const id = $(this).data('pk')
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this configuration!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.post("manageProduct", {id, "type": "delete"}, function(response){ //sends request to the server
                    if(response.success == true){
                        swal(response.message, {
                            icon: "success",
                        });
                    } // returns when successful insert
                    else{
                        swal("Error! "+response.message, {
                            icon: "error",
                        });
                    } //returns when error occur
                })
                setTimeout(function(e){
                    location.reload()
                }, 1500) //refresh the page
            }
        }); //prompt the user to delete a check in
}) //delete check in request
