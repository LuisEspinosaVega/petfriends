$(document).ready(function () {
    console.log("hola caraculo");
});

//no se para que es esto...
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#modalDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var iddel = button.data('iddel');

    var modal = $(this);

    modal.find('#id_delete').val(iddel);
});

$("#deletePostForm").submit(function (e) {
    e.preventDefault();
    const token = document.querySelector('meta[name="csrf-token"]').content;
    const id_delete = document.getElementById("id_delete").value;

    fetch('/post', {
        method: 'PATCH',
        headers: {
            "Content-Type": "application/json; charset=utf-8",
            "X-CSRF-TOKEN": token
        },
        body: JSON.stringify({ id_delete: id_delete })
    })
        .then(() => {
            location.reload();
        })

});
