function publish(model_type, id) {
    $.ajax({
        type : 'get',
        url: window.location.protocol + "//" + window.location.host + "/admin/" +  'publish/'+ model_type + '/' + id,
        success: function (data) {
            /*
                        var obj = JSON.parse(data);*/
            if(data.status == 'success'){
                location.reload();
            }
            else{
                alert(data['message'])
            }
        }
    });
}

function active(model_type, id) {
    $.ajax({
        type : 'get',
        url: window.location.protocol + "//" + window.location.host + "/admin/" +  'active/'+ model_type + '/' + id,
        success: function (data) {

            if(data.status == 'success'){
                location.reload();
            }
            else{
                alert(data['message'])
            }
        }
    });
}

function trash(model_type, id) {
    $.ajax({
        type : 'get',
        url: window.location.protocol + "//" + window.location.host + "/admin/" +  'trash/'+ model_type + '/' + id,
        success: function (data) {

            if (data.status == 'success') {
                location.reload();
            }
            else {
                alert(data['message'])
            }
        }
    });
}

function delete_permanently(model_type, id) {
    $.ajax({
        type : 'get',
        url: window.location.protocol + "//" + window.location.host + "/admin/" +  'delete/'+ model_type + '/' + id,
        success: function (data) {
            if (data.status == 'success') {
                location.reload();
            }
            else {
                alert(data['message'])
            }
        }
    });
}
