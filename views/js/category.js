//edit Category
$(".btnEditCategory").click(function() {
    var idCategory = $(this).attr("idCategory");

    
    var data = new FormData();
    data.append("idCategory", idCategory);
    $.ajax({
        url:"ajax/category.ajax.php",
        method:"POST",
        data:data,
        cache:false,
        contentType:false,
        processData:false,
        dataType:"json",
        success:function(represent) {
            // console.log("represent", represent);
            $("#editCategory").val(represent["category"]);
            $("#idCategory").val(represent["id"]);
        }
    });
});

//delete category
$(".btnDeleteCategory").click(function(){

    var idCategory = $(this).attr("idCategory");

    swal({
        title: 'Are you sure you want to delete the category?',
       text: "if you're not sure you can cancel!",
       type: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       cancelButtonText: 'Cancel',
       confirmButtonText: 'Yes, delete category!'
    }).then(result => {
        if(result.value){
            window.location = "index.php?page=category&idCategory="+idCategory;
        }
    })

})