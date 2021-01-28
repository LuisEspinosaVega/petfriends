$("#searchUser").on("focus", function (e) {

    let value = $("#searchUser").val();
    searchUser(value);
});

$("#searchUser").on("keyup", function (e) {
    let value = $("#searchUser").val();
    searchUser(value);
});

$("#searchUser").on("focusout", function (e) {
    setTimeout(() => {
        $("#usersList").html('');
        $("#searchUser").val('');
    }, 300);
});

function searchUser(value) {

    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    fetch('/searchuser', {
        method: 'post',
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        },
        body: JSON.stringify({ value: value })
    })
        .then(response => response.json())
        .then(data => {
            $("#usersList").html('');
            data.map((user) => {
                document.getElementById("usersList").innerHTML += `<div style="z-index:100;"><a href="/profile/${user.username}" class="m-3" >${user.name}</a> </br></div>`;
            })
        })
        .catch((error) => {
            console.log(error);
        })
}
