window.onTelegramAuth = function(telegram, url) {
    axios({
        method: 'post',
        url: url,
        data: {
            "id": telegram.id,
            "first_name": telegram.first_name,
            "last_name": telegram.last_name,
            "username": telegram.username,
            "photo_url": telegram.photo_url,
            "auth_date": telegram.auth_date,
            "hash": telegram.hash,
        },
        headers: {
            "Content-type": "application/json; charset=UTF-8"
        }
    })
    .then(function (response) {
        console.log("Server response received successfully!");
        console.log(response.data);
    })
    .catch(function (error) {
        console.log(error);
    });
}