$('#submit').click(function() {

    $('#snippets').html('');

    if ($('#gccodelist').val() == '') {
        $('#snippets').html('<p class="alert alert-warning">The text box is empty :(</p>');
        $('#snippets').show();
        return false;
    }

    var btn = $(this);
    $('#gccodelist').attr('readonly', true);
    $('#gccodelist').attr('disabled', true);

    btn.button('loading');
    $.ajax({
        url: "fetch.php",
        type: "POST",
        data: {
            list: $('#gccodelist').val(),
        },
        success: function(response) {
            if (!response || response === "" || typeof response != 'object' || !response.success || !response.data) {
                btn.button('reset');
                $('#gccodelist').attr('readonly', false);
                $('#gccodelist').attr('disabled', false);
                $('#snippets').append('<p class="alert alert-warning">No results :(</p>');
                $('#snippets').show();
                return false;
            }
            $.each(response.data, function(guid, data) {
                var html = '<h3><a href="http://www.geocaching.com/hide/report.aspx?guid=' + guid + '" ';
                html += 'onclick="window.open(this.href);return false;" title="Click here to edit this listing">' + data.title + '</a> <small>(' + data.gccode + ')</small></h3>\n';
                html += '<textarea rows="4" cols="50" class="form-control">' + data.spoilers + '</textarea>\n\n';
                $('#snippets').append(html);
                $('#instructions').show();
                $('#snippets').show();
            });
            btn.button('reset');
            $('#gccodelist').val(response.selected_gccodes);
            $('#gccodelist').attr('readonly', false);
            $('#gccodelist').attr('disabled', false);
        },
        failure: function() {}
    });
    return false;
});

if(window.location.hash && window.location.hash.substring(1) == 'help') {
    $('#help').modal('show');
}