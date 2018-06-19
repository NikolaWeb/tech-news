
$(document).ready(function(){

    $("#search").keyup(function(){
        $("#paginationWrapper").hide();
        var search = $("#search").val();

        $.post("php/search-ajax.php", {
            search: search
        }, function(data, status){
            $("#searchResults").html(data);
            if(!search){
                $("#paginationWrapper").show();
                $("#searchTitle").hide();
            }
        });
    });

    $(".del-item").on("click",function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            url: "php/cart-remove-ajax.php",
            method: "post",
            data: {
                id : id
            },
            success: function(data, status, jqXHR) {

                console.log(id);

                $("<div>Are you sure you want to continue?</div>").dialog({
                    title: "Removing an item",
                    buttons: {
                        "Ok": function() {
                            window.location = "";
                        },
                        "Cancel": function() {
                            $(this).dialog("close");
                        }
                    }
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }

        });

    });

    //add to cart
    $(function() {

        $(".atc").on("click",function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                url: "php/favorites-ajax-insert.php",
                method: "post",
                dataType : 'text',
                data: {
                    id : id
                },
                success: function(data, status, jqXHR) {
                    console.log(jqXHR.status);
                    /*
                    console.log(hidden_price);
                    console.log(hidden_image);
                    */
                    console.log(id);

                    $('#addedToFav').text(data).show().delay(1000).fadeOut(500);

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }

            });
        });
    });

    //disappearing text
    setTimeout(function() {
        $(".item-changed").fadeOut().empty();
    }, 3000);

    //pull down add new item
    $("#addItemBtn").click(function(){
        $("#addItemDiv").slideDown();
        $("#addItemBtn").hide();
    });

    //select all checkboxes
    $(".all").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });


});