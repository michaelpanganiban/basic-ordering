$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
}); //handles csrf token for all request

$("#add-delivery-submit").submit(function (e) {
    e.preventDefault()
    const location = $("#location").val() //get the input value of location
    const amount = $("#amount").val() //get the input value of amount
    $.post('manageDelivery', {amount, location, type:"add"}) //sends request to the server
        .done(function(msg){
            swal("Great! "+msg.message, {
                icon: "success",
            }); // returns when successful insert
            setTimeout(function () {
                window.location = "deliveryConfiguration"
            }, 1500) //refresh the page
        })
        .fail(function(xhr, status, error) {
            swal("Error! "+error, {
                icon: "error",
            });
        }) //returns when error occur
}) //send request for creating new configuration

$(".delete-activity").click(function(e){
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
            $.post("manageDelivery", {id, "type": "delete"}, function(response){ //sends request to the server
                console.log(response)
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
