//edit client
// $(".btnEditClient").click(function(){
    $(document).on("click", ".btnEditClient" , function() {

    var clientId = $(this).attr("clientId");

    var data = new FormData();
    data.append("clientId", clientId);

    $.ajax({
        url:"ajax/client.ajax.php",
        method:"POST",
        data:data,
        cache:false,
        contentType:false,
        processData:false,
        dataType:"json",
        success:function(response) {

            console.log("response", response);

            $("#clientId").val(response["id"]);
            $("#editName").val(response["name"]);
            $("#editDocumentId").val(response["id_document"]);
            $("#editEmail").val(response["email"]);
            $("#editPhone").val(response["phone"]);
            $("#editAddress").val(response["address"]);
            $("#editBirthday").val(response["birthday"]);
            $("#editTotalPurchase").val(response["total_purchases"]);
        }
    });
});

// delete client

// $(".btnDeleteClient").click(function(){
$(document).on("click", ".btnDeleteClient" , function() {

    var clientId = $(this).attr("clientId");
    console.log("clientId", clientId);

    swal({
        title:'Are you sure, Do you want to delete the client?',
        text:"if you're not sure you can cancel!",
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:"#3085d6",
        cancelButtonColor:"#d33",
        cancelButtonText :"Cancel",
        confirmButtonText : "Delete"
    }).then((result) => {
        if(result.value) {
            window.location = "index.php?page=client&clientId="+clientId;
        }
    })
});