$("#btnSendConversarion").click(function (e) {
    e.preventDefault();
    let profile_id = $("#profile_id").val();
    let message_content = $("#message_content").val();

    if (message_content == "") {
        $("#message_content").focus();
    } else {
        // console.log("mensaje al perfil: " + profile_id + " que dice: " + message_content);
        axios.post('/community', {
            message_content: message_content,
            id_to: profile_id
        })
            .then(function (response) {
                // console.log(response);
                location.reload();
            })
            .catch((error) => {
                console.log(error);
            })
    }
});
