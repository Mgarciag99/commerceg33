$(document).ready(function() {

    var $image = $(".image-crop > img")
    $($image).cropper({
        aspectRatio: 1.1,
        preview: ".img-preview",
        done: function(data) {
            // Output the result data for cropping image.
        }
    });

    var $inputImage = $("#inputImage");
    if (window.FileReader) {
        $inputImage.change(function() {
            var fileReader = new FileReader(),
                files = this.files,
                file;

            if (!files.length) {
                return;
            }

            file = files[0];

            if (/^image\/\w+$/.test(file.type)) {
                fileReader.readAsDataURL(file);
                fileReader.onload = function() {
                    $inputImage.val("");
                    $image.cropper("reset", true).cropper("replace", this.result);
                };
            } else {
                showMessage("Please choose an image file.");
            }
        });
    } else {
        $inputImage.addClass("hide");
    }

    $("#download").click(function() {
        var dataurl = $image.cropper("getDataURL");
        category = document.getElementById("category");
        type = document.getElementById("type");

        if( type.value == 2 ){
        codeCategory = document.getElementById("codeCategory");
        }
        codeImage = document.getElementById("codeImage");
       // console.log( type.value);
        var blob = dataURLtoBlob(dataurl);
        console.log( blob );

        /////////// POST /////////
        var http = new FormData();
        http.append("category", category.value );
        http.append("codeImage", codeImage.value );
        http.append("image", blob );
        http.append("type", type.value );

        var request = new XMLHttpRequest();
        request.open("POST", "http://localhost/commerce/SYSTEM/API/API_picture_edit_category.php");
        request.onload = () => {
            if (request.status >= 200 && request.status < 300) {
               console.log(request.responseText);
                resultado = JSON.parse(request.response);
                if (resultado.status === true) {
                    swal("Excelente!", "La imagen fue editada satisfactoriamente...", "success").then((value) => {
                        //console.log(value);
                        if( type.value == 1 ){
                            window.location.href = "management_category.php";
                        }else if( type.value == 2 ){
                            window.location.href = "management_sub_category.php?category=" + codeCategory.value;
                        }
                        // table_pictures_category( category.value );
                    });
                } else {
                    swal("Error", resultado.message, "error").then((value) => {
                        console.log(request.response);
                    });
                    return;
                }
            } else {
                console.log(request.response);
            }
        };
        request.onerror = () => reject(request.response.message);
        request.send(http);
    });

    function dataURLtoBlob(dataurl) {
        var arr = dataurl.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]),
            n = bstr.length,
            u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new Blob([u8arr], {
            type: mime
        });
    }

    $("#zoomIn").click(function() {
        $image.cropper("zoom", 0.1);
    });

    $("#zoomOut").click(function() {
        $image.cropper("zoom", -0.1);
    });

    $("#rotateLeft").click(function() {
        $image.cropper("rotate", 45);
    });

    $("#rotateRight").click(function() {
        $image.cropper("rotate", -45);
    });

    $("#setDrag").click(function() {
        $image.cropper("setDragMode", "crop");
    });
});