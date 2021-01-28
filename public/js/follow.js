var btn = $("#btnFollow");
var follows = btn.data('follows');

followUnfollow(follows);

function followUnfollow(status) {
    if (status == true) {
        btn.text("Dejar de seguir").addClass('btn-danger').removeClass('btn-success');
    } else {
        btn.text("Seguir").addClass('btn-success').removeClass('btn-danger');
    }
}
console.log(follows);
$("#btnFollow").click(function (e) {
    e.preventDefault();
    let userid = $(this).data('userid');

    //Hacer la peticion con axios (*￣3￣)╭
    axios.post('/community/' + userid)
        .then(response => {
            // console.log(response);

        })
        .then(() => {
            follows = !follows;
            followUnfollow(follows);
        })
});

//Accion para mandar un mensaje =)
// $("#btnMensaje").click(function (e) {
//     e.preventDefault();
//     console.log("sewa mandar un mensaje");
// });

//Handle modal
$('#modalMessage').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var idto = button.data('idto');

    var modal = $(this);

    $('#id_to').val(idto);
    $("#message_content").val('');

    //Hacer la peticion cuando se de click en enviar

});

//Enviar el mensaje

$("#messageForm").submit(function (e) {
    e.preventDefault();
    axios.post('/community', {
        message_content: $("#message_content").val(),
        id_to: $("#id_to").val()
    })
        .then(function (response) {
            // console.log(response);
            $("#modalMessage").modal('hide');
        })
        .catch((error) => {
            console.log(error);
        })

});
