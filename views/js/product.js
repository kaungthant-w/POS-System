$.ajax({
    url:"ajax/datable-products.ajax.php",
    success:function(response) {
        // console.log("response", response);
    }

});

$(document).ready(function() {
    $('.tablesProduct').DataTable( {
        "ajax": "ajax/datable-products.ajax.php",
        "deferRender": true,
        "retrieve": true,
        "processing": true
    } );
} );

// new code
$("#newCategory").change(function() {

    var idCategory = $(this).val();
    // console.log("idCategory", idCategory); 

    var data = new FormData();
    data.append("idCategory", idCategory);

    $.ajax({
        url:"ajax/products.ajax.php",
        method:"POST",
        data:data,
        cache:false,
        contentType:false,
        processData:false,
        dataType:"json",
        success:function(answer) {

            if(!answer) {
                var newCode = idCategory + "01";
                $("#newCode").val(newCode);
            } else {
                var newCode = Number(answer["code"]) + 1;
                $("#newCode").val(newCode);
            }
        }
    })
});

//new buying price
$("#newBuyingPrice, #editBuyingPrice").change(function() {

    if($(".percentage").prop("checked")) {
        
        var newPercentage = $(".newPercentage").val();
        
        var percentage = Number(($("#newBuyingPrice").val()*newPercentage/100))+Number($("#newBuyingPrice").val());

        var editPercentage = Number(($("#editBuyingPrice").val()*newPercentage/100))+Number($("#editBuyingPrice").val());
        
        // console.log("percentage" , percentage);

        $("#newSellingPrice").val(percentage);
        $("#newSellingPrice").prop("redonly");

        $("#editSellingPrice").val(editPercentage);
        $("#editSellingPrice").prop("redonly");
    }

});

//percentage 

$(".newPercentage").change(function() {
    if($(".percentage").prop("checked")) {
        
        var newPercentage = $(this).val();
        
        var percentage = Number(($("#newBuyingPrice").val()*newPercentage/100))+Number($("#newBuyingPrice").val());
        var editPercentage = Number(($("#editBuyingPrice").val()*newPercentage/100))+Number($("#editBuyingPrice").val());
        
        $("#newSellingPrice").val(percentage);
        $("#newSellingPrice").prop("redonly");

        $("#editSellingPrice").val(editPercentage);
        $("#editSellingPrice").prop("redonly");
    }
});

$(".percentage").on("ifUnchecked", function() {
    $("#newSellingPrice").prop("readonly", false);
    $("#editSellingPrice").prop("readonly", false);

});

$(".percentage").on("ifChecked", function() {
    $("#newSellingPrice").prop("readonly", true);
    $("#editSellingPrice").prop("readonly", true);

});

//Upload image
$(".newPhoto").change(function() {
    var image = this.files[0];
    console.log("image", image);

    if(image["type"] != "image/png" && image["type"] != "image/jpeg" && image["type"] != "image/jpg" ) {
        $(".newPhoto").val("");
        swal({
            title:"It is not photo!",
            text:"Please choose jpg, png or jpeg",
            type:"error",
            confirmButtonText:"Cancel"

        });
    } else if (image["size"] >=2000000) {
        $(".newPhoto").val("");
        swal({
            title:"Woow.. File size is too big !",
            text:"Please choose lower 2MB",
            type:"error",
            confirmButtonText:"Cancel"

        });
    } else {
        var dataImage = new FileReader;
        dataImage.readAsDataURL(image);
        $(dataImage).on("load", function(event) {
            var pageImage = event.target.result;
            $(".preview").attr("src", pageImage);

        });
    }
});


//Edit product
$(".tablesProduct tbody").on("click","button.btnEditProduct",function() {
    var productId =$(this).attr("productId");
    // console.log("idProduct", productId);

    var data = new FormData();
    data.append("productId", productId);

    $.ajax({
        url:"ajax/products.ajax.php",
        method : "POST",
        data:data,
        cache:false,
        contentType:false,
        processData:false,
        dataType:"json",
        success:function(response) {
            // console.log("response", response);

            var dataCategory = new FormData();
            dataCategory.append("idCategory", response["category_id"]);

            $.ajax({
                url:"ajax/category.ajax.php",
                method:"POST",
                data:dataCategory,
                cache:false,
                contentType:false,
                processData:false,
                dataType:"json",
                success:function(response) {
                    // console.log(response);

                    $("#editCategory").val(response["id"]);
                    $("#editCategory").html(response["category"]);
                }
            });

            $("#editCode").val(response["code"]);
            $("#editDescription").val(response["description"]);
            $("#editStock").val(response["stock"]);
            $("#editBuyingPrice").val(response["buying_price"]);
            $("#editSellingPrice").val(response["selling_price"]);

            if(response["image"] != "") {
                $("#ActualImage").val(response["image"]);
                $(".preview").attr("src", response["image"]);
            }
        }
    });
})


//edit upload
$(".editPhoto").change(function() {
    var image = this.files[0];
    console.log("image", image);

    if(image["type"] != "image/png" && image["type"] != "image/jpeg" && image["type"] != "image/jpg" ) {
        $(".newPhoto").val("");
        swal({
            title:"It is not photo!",
            text:"Please choose jpg, png or jpeg",
            type:"error",
            confirmButtonText:"Cancel"

        });
    } else if (image["size"] >=2000000) {
        $(".newPhoto").val("");
        swal({
            title:"Woow.. File size is too big !",
            text:"Please choose lower 2MB",
            type:"error",
            confirmButtonText:"Cancel"

        });
    } else {
        var dataImage = new FileReader;
        dataImage.readAsDataURL(image);
        $(dataImage).on("load", function(event) {
            var pageImage = event.target.result;
            $(".preview").attr("src", pageImage);

        });
    }
});

//Delete product
$(".tablesProduct tbody").on("click","button.btnDeleteProduct",function() {
    var productId =$(this).attr("productId");
    // console.log("idProduct", productId);

    var code =$(this).attr("code");
    var photo =$(this).attr("image");

    swal({
        title:'Are you sure, Do you want to delete the product?',
        text:"if you're not sure you can cancel!",
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:"#3085d6",
        cancelButtonColor:"#d33",
        cancelButtonText :"Cancel",
        confirmButtonText : "Delete"
    }).then((result) => {
        if(result.value) {
            window.location = "index.php?page=product&productId="+productId+"&photo="+photo+"&code"+code;
        }
    })

});    