//Handle modal
$('#cancelRequest').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id = button.data('id');

    var modal = $(this);

    $('#id').val(id);

    //Hacer la peticion cuando se de click en enviar

});

$('#requestModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var data = button.data('data');

    var modal = $(this);

    $('#age').text(data.age);
    $('#members').text(data.members);
    $('#agree').text(data.agree);
    $('#more').text(data.more);
    $('#many').text(data.many);
    $('#why').text(data.why);
    $('#data').text(data.data);
    $('#space').text(data.space);
    //Hacer la peticion cuando se de click en enviar

});

$('#rechazarModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_rechazar = button.data('idrechazar');

    var modal = $(this);

    $('#id_rechazar').val(id_rechazar);

    //Hacer la peticion cuando se de click en enviar

});

$('#aceptarModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_acept = button.data('idaceptar');

    var modal = $(this);

    $('#id_acept').val(id_acept);

    //Hacer la peticion cuando se de click en enviar

});
