$.ajax({
    url: 'http://speed.test/api/user',
    type: "GET",
    data:{api_token:'iueiurtiertitueri'},
    dataType:"json",
    contentType: 'application/json',
    success: function (responseData) {
        console.log(responseData);
    },
    error: function (reject) {
        console.log(reject);
    },
});
