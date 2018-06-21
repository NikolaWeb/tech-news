$(document).ready(function(){

    $("#content").summernote({
        height: 300,
        popover: {
            image: [],
            link: [],
            air: []
        }
    });

    //disappearing notifications
    setTimeout(function() {
        $(".alert-success, .alert-danger").fadeOut().empty();
    }, 3000);

    $(".del-item").on("click",function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        //makes action dynamic
        var path = window.location.href;
        path = path.split('=')[1];

        $.ajax({
            url: "admin/php/" + path + "-delete.php",
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