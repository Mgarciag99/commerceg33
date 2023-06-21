function addAlerts() {
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    var form = $("#form");
    // alert(form)

    form.validate({
        rules: {
            name: {
                required: true
            },
            surname: {
                required: true
            },
            phone: {
                required: true
            },
            mail: {
                required: true
            },
            direction: {
                required: true
            },
            department: {
                required: true
            },
            municipe: {
                required: true
            },
            nameFactur: {
                required: true
            },
            nit: {
                required: true
            },
            directionFact: {
                required: true
            }

        },
        messages: {
            name: {
                required: "El nombre es requerido"
            },
            surname: {
                required: "El Apellido es requerido"
            },
            phone: {
                required: "El Telefono es requerido"
            },
            mail: {
                required: "El mail es requerido"
            },
            direction: {
                required: "La direccion es requerida"
            },
            department: {
                required: "El departamento es requerido"
            },
            municipe: {
                required: "El municipio es requerido"
            },
            nameFactur: {
                required: "El nombre de factura es requerido"
            },
            nit: {
                required: "El nit es requerido"
            },
            directionFact: {
                required: "La direccion de la factura es requerida"
            }

        }
    })
}

function validateForm(step) {

    var linkOne = document.getElementById("sidebar-link-one");
    var linkTwo = document.getElementById("sidebar-link-two");
    var linkThree = document.getElementById("sidebar-link-three");
    //validations
    var validateStepOne = document.getElementById("validateStepOne").value;
    var validateStepTwo = document.getElementById("validateStepTwo").value;
    var validateStepThree = document.getElementById("validateStepThree").value;

    switch (step) {
        case 1:
            if (validateStepOne != 0) {
                linkOne.setAttribute("href", 'step_one.php');
            }
            break;
        case 2:
            if (validateStepOne != 0) {
                linkTwo.setAttribute("href", 'step_two.php');
            } else {
                swal("Info!", "Porfavor Completa el paso 1", "info");

            }



            break;
        case 3:
            if (validateStepOne != 0 && validateStepTwo != 0) {
                linkThree.setAttribute("href", 'step_three.php');
            } else {
                if (validateStepOne == 0 && validateStepTwo == 0) {
                    swal("Info!", "Porfavor Completa el paso 1 y 2 ", "info");
                } else if (validateStepOne == 0) {
                    swal("Info!", "Porfavor Completa el paso 1 ", "info");
                } else if (validateStepTwo == 0) {
                    swal("Info!", "Porfavor Completa el paso 2 ", "info");
                }

            }


            break;

    }

}





function addProductsToOrder() {

    var orderId = document.getElementById('orderId');
    var getCarShop = localStorage.getItem("dataCarShop");
    //    console.log(  orderId.value  );
    if (orderId.value !== '' && getCarShop !== null) {

        var url = 'http://localhost/commerce/PAGE/API/API_order.php';
        var formData = new FormData();
        formData.append('request', 'add_products_to_order');
        formData.append('arrCarShop', getCarShop);
        formData.append('orderId', orderId.value);

        fetch(url, {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(
                response => {
                    if (response.status !== true) {
                        //alert( "error" );
                        //console.log( response )
                        swal("Error!", response.message, "info")
                    } else {
                        //  alert('excelente');
                        swal("Excelente!", response.message, "success").then((value) => {
                            window.location.href = 'step_two.php';
                            // document.querySelector('.lbl-register').style.transform = 'scale(.6)';

                            //table();
                        })
                    }
                }
            )
            .catch(error => swal("Error!", "Ha ocurrido un error en el servidor", "warning"))
        //.catch( error => console.log( error ) )

    } else {

        // var form = $( "#form" );
        swal("Error!", "Debe llenar los campos Obligatorios", "info");

    }


}





function addDetailDataToOrder() {

    var orderId = document.getElementById('orderId');
    var name = document.getElementById("name");
    var surname = document.getElementById("surname");
    var phone = document.getElementById("phone");
    var mail = document.getElementById("mail");
    var direction = document.getElementById("direction");
    var department = document.getElementById("department");
    var municipe = document.getElementById("municipe");
    var nameFactur = document.getElementById("nameFactur");
    var nit = document.getElementById("nit");
    var directionFact = document.getElementById("directionFact");

    if (orderId.value !== '' && name.value !== '' && surname.value !== '' && phone.value !== '' && mail.value !== '' && direction.value !== '' && department.value !== '' && municipe.value !== '' && nameFactur.value !== '' && nit.value !== '' && directionFact.value !== '') {

        var url = 'http://localhost/commerce/PAGE/API/API_order.php';
        var formData = new FormData();
        formData.append('request', 'add_order_detail_data');
        formData.append('orderId', orderId.value);
        formData.append('name', name.value);
        formData.append('surname', surname.value);
        formData.append('phone', phone.value);
        formData.append('mail', mail.value);
        formData.append('direction', direction.value);
        formData.append('department', department.value);
        formData.append('municipe', municipe.value);
        formData.append('name_fact', nameFactur.value);
        formData.append('nit_fact', nit.value);
        formData.append('direction_fact', directionFact.value);



        fetch(url, {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(
                response => {
                    if (response.status !== true) {
                        //alert( "error" );
                        //console.log( response )
                        swal("Error!", response.message, "info")
                    } else {
                        //  alert('excelente');
                        swal("Excelente!", response.message, "success").then((value) => {
                            window.location.href = 'step_three.php';
                            // document.querySelector('.lbl-register').style.transform = 'scale(.6)';

                            //table();
                        })
                    }
                }
            )
            .catch(error => swal("Error!", "Ha ocurrido un error en el servidor", "warning"))
        //.catch( error => console.log( error ) )

    } else {

        var form = $("#form");
        form.valid();
        swal("Error!", "Debe llenar los campos Obligatorios", "info");

    }


}


function confirmOrder() {
    var total = localStorage.getItem('total');
    var orderId = document.getElementById('orderId');
    var getCarShop = localStorage.getItem("dataCarShop");


    if (orderId.value !== '' && total != null) {

        var url = 'http://localhost/commerce/PAGE/API/API_order.php';
        var formData = new FormData();
        formData.append('request', 'confirm_order');
        formData.append('orderId', orderId.value);
        formData.append('total', total);
        formData.append('arrCarShop', getCarShop);


        fetch(url, {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(
                response => {
                    if (response.status !== true) {
                        //alert( "error" );
                        //console.log( response )
                        swal("Error!", response.message, "info")
                    } else {
                        //  alert('excelente');
                        swal("Excelente!", response.message, "success").then((value) => {
                            window.location.href = '../PAGES/index.php';
                            // document.querySelector('.lbl-register').style.transform = 'scale(.6)';
                            localStorage.removeItem('total');
                            localStorage.removeItem('dataCarShop');

                            //table();
                        })
                    }
                }
            )
            .catch(error => swal("Error!", "Ha ocurrido un error en el servidor", "warning"))
        //.catch( error => console.log( error ) )

    } else {

        // var form = $( "#form" );
        swal("Error!", "Debe llenar los campos Obligatorios", "info");

    }

}