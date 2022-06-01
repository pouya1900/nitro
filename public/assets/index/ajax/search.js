function search(model_type, search_value, output_id) {
    $("#" + output_id).show();
    $.ajax({
        type : 'get',
        dataType: 'html',
        url: window.location.protocol + "//" + window.location.host + "/" + 'csearch/'+ model_type + '/' + search_value,
        success: function (data) {
            $(".search_result_class").remove();
            $("#" + output_id).append(data);
        }
    });
}

function topMenuSearch()
{
    var search_value =$('#topMenuSearchValue').val();
    return search('ads', search_value, 'topMenuSearchOutput')
}

function blogSideSearch()
{
    var search_value =$('#blogSideSearchValue').val();
    return search('blog', search_value, 'blogSideSearchOutput')
}
