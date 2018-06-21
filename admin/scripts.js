$(document).ready(function(){
    $(".del-item").on("click",function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        $.ajax({
            url: "admin/php/slider-delete.php",
            method: "post",
            data: {
                id : id
            },
            success: function(data, status, jqXHR) {

                $("<div>Are you sure you want to continue?</div>").dialog({
                    title: "Removing an item",
                    buttons: {
                        "Ok": function() {
                            $("#item-row"+id).remove();
                            $(this).dialog("close");
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
});