
//upload image
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

//Update User
// $(".btnEditUser").click(function(){
    $(document).on("click", ".btnEditUser" , function() {
    var idUser = $(this).attr("idUser");
    // console.log("idUser", idUser);

    var data = new FormData();
    data.append("idUser", idUser);

    $.ajax({
        url:"ajax/user.ajax.php",
        method:"POST",
        data:data,
        cache:false,
        contentType:false,
        processData:false,
        dataType:"json",
        success:function(response) {
            // console.log("response", response);
            $("#editName").val(response["name"]);
            $("#editUser").val(response["user"]);
            $("#editProfile").html(response["profile"]);
            $("#photoActual").val(response["profile"]);
            $("#photoActual").val(response["photo"]);
            $("passwordActual").val(response["password"]);

            if(response["photo"] !="") {
                $(".preview").attr("src", response["photo"]);
            }
        }
    });
});

//active user
$(".btnActive").click(function() {
    var idUser = $(this).attr("idUser");
    var statusUser = $(this).attr("statusUser");

    var data = new FormData();
    data.append("activeId", idUser);
    data.append("activeUser", statusUser);

    $.ajax({
        url:"ajax/user.ajax.php",
        method:"POST",
        data:data,
        cache:false,
        contentType:false,
        processData:false,
        success: function(response) {
            if(window.matchMedia("(max-width:767px)").matches) {
                swal({
                    title: "Successfully it",
                    type:"success",
                    confirmButtonText : "Cancel",
                }).then(function(result){
                    if(result.value) {
                        window.location = "users";
                    }
                });
            }
        }
    });



    if(statusUser == 0) {
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).html("Deactived");
        $(this).attr("statusUser", 1);
    } else {
        $(this).addClass("btn-success");
        $(this).removeClass("btn-danger");
        $(this).html("active");
        $(this).attr("statusUser", 0);
    }
});

//no repeat same user
$("#newUser").change(function() {
    $(".alert").remove();
    var user = $(this).val();
    var data = new FormData();
    data.append("validateUser", user);

    $.ajax({
        url:"ajax/user.ajax.php",
        method:"POST",
        data:data,
        cache:false,
        contentType:false,
        processData:false,
        dataType:"json",
        success:function(response) {
            // console.log("response",response);
            if(response) {
                $("#newUser").parent().after("<div class='alert alert-warning'>username have already exist!</div>");
                $("#newUser").val("");
            }
        }
    });
});

//delete user
$(".btnDeleteUser").click(function(){
    var userId = $(this).attr("userId");
    var userPhoto = $(this).attr("userPhoto");
    var user = $(this).attr("user");

    swal({
        title:'Are you sure, Do you want to delete the user?',
        text:"if you're not sure you can cancel!",
        type:'warning',
        showCancelButton:true,
        confirmButtonColor:"#3085d6",
        cancelButtonColor:"#d33",
        cancelButtonText :"Cancel",
        confirmButtonText : "Delete"
    }).then((result) => {
        if(result.value) {
            window.location = "index.php?page=users&userId="+userId+"&user="+user+"&userPhoto="+userPhoto;
        }
    })
});