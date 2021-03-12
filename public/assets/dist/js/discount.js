$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
}); //handles csrf token for all request

$("#add-discount-submit").submit(function (e) {
    e.preventDefault()
    const discount_name = $("#discount-name").val() //get the input value of discount_name
    const percent = $("#percent").val() //get the input value of percent
    $.post('manageDiscount', {discount_name, percent, type:"add"}) //sends request to the server
        .done(function(msg){
            swal("Great! "+msg.message, {
                icon: "success",
            }); // returns when successful insert
            setTimeout(function () {
                window.location = "discountConfiguration"
            }, 1500) //refresh the page
        })
        .fail(function(xhr, status, error) {
            swal("Error! "+error, {
                icon: "error",
            });
        }) //returns when error occur
}) //send request for creating new configuration

$(".delete-discount").click(function(e){
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
                $.post("manageDiscount", {id, "type": "delete"}, function(response){ //sends request to the server
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
