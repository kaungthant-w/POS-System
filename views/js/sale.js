// $.ajax({
//     url:"ajax/datable-sale.ajax.php",
//     success:function(response) {
//         // console.log("response", response);
//     }

// });

// local variable storange
if(localStorage.getItem("rangeCapture" != null)) {
    $("#daterange-btn span").html(localStorage.getItem("rangeCapture"));
} else {
    $("#daterange-btn span").html('<i class="fa fa-calendar"></i> Range of Date');
    // console.log("rangeCapture", rangeCapture);
}


$(document).ready(function() {
    $('.salesTable').DataTable( {
        "ajax": "ajax/datable-sale.ajax.php",
        "deferRender": true,
        "retrieve": true,
        "processing": true
    } );
} );

// large screen addProduct

$(".salesTable tbody").on("click", "button.addProduct", function(){

    var productId =$(this).attr("productId");
    // console.log("productId", productId);

    $(this).removeClass("btn-primary addProduct");
    $(this).addClass("btn-default");

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

            var description = response["description"];
            var stock = response["stock"];
            var price = response["selling_price"];

            //no stock item
            if(stock == 0) {
                swal({
                    title: "No stock avaliable",
                    type:"error",
                    confirmButtonText:"Ok!"
                });

                $("button[productId='"+productId+"']").addClass("btn-primary addProduct");
                return;
            }

            $(".newProduct").append(

            '<div class="row" style="padding:5px 15px">'+
            
                '<div class="col-xs-6" style="padding-right:0px">'+
                                        
                    '<div class="input-group">'+
                        '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" productId="'+productId+'" ><i class="fa fa-times"></i></button></span>'+

                        '<input type="text" class="form-control newDescriptionProduct" idProduct="" id="newDescriptionProduct" name="newDescriptionProduct" value="'+description+'" productId="'+productId+'" readonly required>'+
                    '</div>'+

                '</div>'+
 
                    '<div class="col-xs-3 enterQuantity">'+
                        '<input type="number" class="form-control newProductQuantity" min="1" value="1" stock="'+stock+'" name="newProductQuantity" id="newProductQuantity" newStock="'+Number(stock-1)+'" required>'+
                    '</div>'+
                    '<div class="col-xs-3 enterPrice" style="padding-left:0px">'+
                        '<div class="input-group">'+
                            '<span class="input-group-addon"><i class="ion ion-social-usd" ></i></span>'+
                            '<input type="text" class="form-control newProductPrice" realPrice="'+price+'" value="'+price+'"  name="newProductPrice" id="newProductPrice" required>'+
                        '</div>'+
                    '</div>'+
                '</div>');


                //total sum price
                sumPriceTotal();

                //total price tax
                addTaxes();

                // GROUP PRODUCTS IN JSON FORMAT
                listProducts();

                // format new product price
                $('.newProductPrice').number( true, 2 );

        }
    });
});

// remove product list
$(".salesTable").on("draw.dt", function(){
    if(localStorage.getItem("removeProduct") != null) {
        var ProductListId = JSON.parse(localStorage.getItem("removeProduct"));

        for(var i = 0; i < ProductListId.length; i++) {
            $("button.recallBackButton[productId='"+ProductListId[i]["productId"]+"']").removeClass('btn-default');
            $("button.recallBackButton[productId='"+ProductListId[i]["productId"]+"']").addClass('btn-primary addProduct');
        }
    }
});


//removeProduct
var removeProductId = [];
localStorage.removeItem("removeProduct");

$(".formSale").on("click", "button.removeProduct", function(){

    $(this).parent().parent().parent().parent().remove();
    var productId =$(this).attr("productId");
    // console.log(productId);

    //localstorage 
    if(localStorage.getItem("removeProduct") == null) {
        removeProductId = [];
    } else {
        removeProductId.concat(localStorage.getItem("removeProduct"));
    }

    removeProductId.push({"productId":productId});
    localStorage.setItem("removeProductId", JSON.stringify(removeProductId));
    
    $("button.recallBackButton[productId='"+productId+"']").removeClass('btn-default');
    $("button.recallBackButton[productId='"+productId+"']").addClass('btn-primary addProduct');

    if($(".newProduct").children().length == 0) {
        $("#newSaleTotal").val(0);
        $("#saleTotal").val(0);
        $("#newTaxSale").val(0);
        $("#newSaleTotal").attr("total",0);
    } else {
        //sum total price method
         sumPriceTotal();
        //total price tax
         addTaxes();
        // GROUP PRODUCTS IN JSON FORMAT
         listProducts();
    }



});

//add product small screen
var productNum = 0;

$(".newAddProduct").click(function(){

    productNum++;

    var productId =$(this).attr("productId");
    
    var data = new FormData();
    data.append("bringProduct", "ok");

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
            var price = response["buying_price"];

            $(".newProduct").append(

                '<div class="row" style="padding:5px 15px">'+
                
                    '<div class="col-xs-6" style="padding-right:0px">'+
                                            
                        '<div class="input-group">'+
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" productId ><i class="fa fa-times"></i></button></span>'+
    
                            '<select class="form-control newDescriptionProduct" id="product'+productNum +'" productId name="newDescriptionProduct">  required'+

                                '<option>Select Product</option>'+

                            '</select>'+
                            
                        '</div>'+
    
                    '</div>'+
    
                        '<div class="col-xs-3 enterQuantity">'+
                            
                            '<input type="number" class="form-control newProductQuantity" min="1" value="1" stock newStock name="newProductQuantity" required>'+
                        '</div>'+
    
                        '<div class="col-xs-3 enterPrice" style="padding-left:0px">'+
                            '<div class="input-group">'+
                                
                                '<span class="input-group-addon"><i class="ion ion-social-usd" ></i></span>'+
                                '<input type="text" class="form-control newProductPrice" realPrice="'+price+'" name="newProductPrice" readonly required>'+
                                
                            '</div>'+
                        '</div>'+
                    '</div>');

                    //sum total price method
                    sumPriceTotal();
                    //total price tax
                    addTaxes();

                    // format new product price
                    $(".newProductPrice").number(true, 2);

                    // add to products all select
                    response.forEach(functionForEach);
                    function functionForEach(item, index) {
                        if(item.stock != 0 ) {
                            $("#product"+productNum).append(
                                '<option productId="'+item.id+'" value = "'+item.description+'">'+item.description+'</option>'
                            )
                        }

                    }
        }    
    })
});



//select product
$(".formSale").on("change", "select.newDescriptionProduct", function(){

    var  productName = $(this).val();

    var newProductPrice = $(this).parent().parent().parent().children(".enterPrice").children().children(".newProductPrice");
    var newProductQuantity = $(this).parent().parent().parent().children(".enterQuantity").children(".newProductQuantity");

    // console.log("newProductPrice", newProductPrice);
    // console.log("productName", productName);

    var data = new FormData();
    data.append("productName", productName);

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
            // $(newProductQuantity).val(response["stock"]);

            $(newProductQuantity).attr("stock", response["stock"]);
            $(newProductPrice).attr("realPrice", response["buying_price"]);
            
            $(newProductQuantity).attr("newStock", Number(response["stock"]) - 1);
            $(newProductPrice).val(response["buying_price"]);

             //sum total price method
            sumPriceTotal();

             //total price tax
            addTaxes();

            // GROUP PRODUCTS IN JSON FORMAT
            listProducts(); 
        }    
    })  

})    


// modify new Product quantity
$(".formSale").on("change", "input.newProductQuantity", function(){
    var price = $(this).parent().parent().children(".enterPrice").children().children(".newProductPrice");

    console.log("price", price.attr("realPrice"));

    var finalPrice = $(this).val() * price.attr("realPrice");
    price.val(finalPrice);

    var newStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("newStock", newStock);

    if(Number($(this).val()) > Number($(this).attr("stock"))) {

        $(this).val(1);

        var finalPrice = $(this).val() * price.attr("realPrice");
        price.val(finalPrice);
        
        swal({
            title: "The quantity is more than your stock",
            text: "There's only "+$(this).attr("stock")+" stocks!",
            type: "error",
            confirmButtonText: "Close!"
          });
    }

    //sum total price method
    sumPriceTotal();

    //total price tax
    addTaxes();

    // GROUP PRODUCTS IN JSON FORMAT
    listProducts();


});

//sum price total
function sumPriceTotal() {
    var priceItem = $(".newProductPrice");
    var sumArrayPrice = [];

    for(var i=0;i<priceItem.length;i++) {
        sumArrayPrice.push(Number($(priceItem[i]).val()));
    }

    // console.log("sumArrayPrice",sumArrayPrice);

    function sumArrayPrices(total, number) {
        return total + number;
    }

    var sumPriceTotal = sumArrayPrice.reduce(sumArrayPrices);
    // console.log("sumPriceTotal", sumPriceTotal);
    $("#newSaleTotal").val(sumPriceTotal);
    $("#saleTotal").val(sumPriceTotal);
    $("#newSaleTotal").attr("total",sumPriceTotal);


}

// add taxes
function addTaxes() {
    var taxes = $("#newTaxSale").val();
    var totalTaxes = $("#newSaleTotal").attr("total");

    var priceTaxes = Number(totalTaxes * taxes/100);
    var totalWithTaxes = Number(priceTaxes) + Number(totalTaxes);

    $("#newSaleTotal").val(totalWithTaxes);
    $("#saleTotal").val(totalWithTaxes);

    $("#newPriceTaxes").val(priceTaxes);
    $("#newNetPrice").val(totalTaxes);

}

//change input tax sale
$("#newTaxSale").change(function(){
    addTaxes();
});

                    
// format new product price
// $('#newSaleTotal').number( true, 2 );

// SELECT PAYMENT METHOD
$("#newPaymentMethod").change(function(){

    var method = $(this).val();

    if(method == "cash") {
        $(this).parent().parent().removeClass("col-xs-6");

        $(this).parent().parent().addClass("col-xs-4");
        $(this).parent().parent().parent().children(".paymentMethodBoxes").html(

            '<div class="col-xs-4">'+ 

                '<div class="input-group">'+ 

                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

                    '<input type="text" class="form-control" id="newCashValue" placeholder="000000" required>'+

                '</div>'+

            '</div>'+

            '<div class="col-xs-4" id="getCashChange" style="padding-left:0px">'+

                '<div class="input-group">'+

                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

                    '<input type="text" class="form-control" id="newCashChange" placeholder="000000" readonly required>'+

                '</div>'+

            '</div>');

            //adding format to the price
            $('#newCashValue').number( true, 2);
            $('#newCashChange').number( true, 2);

            // List method in the entry
            listMethods();


    } else {
        $(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.paymentMethodBoxes').html(

		 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="number" min="0" class="form-control" id="newCodeTransition" placeholder="Transaction code"  required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

              '</div>')
    }
})


// cash change

$(".formSale").on("change", "input#newCashValue", function(){
	
	var cash = $(this).val();

	var change =  Number(cash) - Number($('#saleTotal').val());

	var newCashChange = $(this).parent().parent().parent().children('#getCashChange').children().children('#newCashChange');

	newCashChange.val(change);

});

// CHANGE TRANSACTION CODE
$(".formSale").on("change", "input#newCodeTransition", function(){

	// List method in the entry
     listMethods();


});

// LIST ALL THE PRODUCTS

function listProducts(){

	var productsList = [];

	var description = $(".newDescriptionProduct");

	var quantity = $(".newProductQuantity");

	var price = $(".newProductPrice");

	for(var i = 0; i < description.length; i++) {

		productsList.push({ "id" : $(description[i]).attr("productId"), 
							  "description" : $(description[i]).val(),
							  "quantity" : $(quantity[i]).val(),
							  "stock" : $(quantity[i]).attr("newStock"),
							  "price" : $(price[i]).attr("realPrice"),
							  "totalPrice" : $(price[i]).val()})
	}

    // console.log("productsList", JSON.stringify(productsList));

	$("#productsList").val(JSON.stringify(productsList)); 

}

// listProducts();

// LIST METHOD PAYMENT

function listMethods(){

	var listMethods = "";

	if($("#newPaymentMethod").val() == "cash"){

		$("#listPaymentMethod").val("cash");

	}else{

		$("#listPaymentMethod").val($("#newPaymentMethod").val()+"-"+$("#newCodeTransition").val());

	}

}

// edit sale
// $(".btnEditSale").click(function(){
    $(".tables").on("click", ".btnEditSale", function() {
    var saleId = $(this).attr("saleId");
    window.location = "index.php?page=edit-sale&saleId="+saleId;
});


// delete sale
$(".tables").on("click", ".btnDeleteSale", function() {
    // console.log("deleted");
    var saleId = $(this).attr("saleId");

    swal({
        title:'Are you sure, Do you want to delete the sale?',
        text:"if you're not sure you can cancel!",
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:"#3085d6",
        cancelButtonColor:"#d33",
        cancelButtonText :"Cancel",
        confirmButtonText : "Delete"
    }).then((result) => {
        if(result.value) {
            window.location = "index.php?page=sale&saleId="+saleId;
        }
    })
    
});

//print sale
$(".tables").on("click", ".btnPrintBill", function() {
    var saleCode = $(this).attr("saleCode");

    window.open("extensions/tcpdf/pdf/bill.php?code="+saleCode, "_blank");
});


//Date range as a button
$(function() {
    $('#daterange-btn').daterangepicker(
    {
    ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate  : moment()
    },
    function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var initialDate = start.format('YYYY-M-D');
    // console.log("initialDate", initialDate);

    var endDate = end.format('YYYY-M-D');
    // console.log("endDate", endDate);

    var rangeCapture = $("#daterange-btn span").html();
    // console.log("rangeCapture", rangeCapture);
    localStorage.setItem("rangeCapture", rangeCapture);
    window.location = "index.php?page=sale&initialDate="+initialDate+"&endDate="+endDate;

})
})

// cancel date range
$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function() {
    localStorage.removeItem("rangeCapture");
    localStorage.clear();
    window.location = "sale";
})