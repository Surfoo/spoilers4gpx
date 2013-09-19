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
        success: function(data) {
            if (!data || data === "" || typeof data != 'object' || !data.success || !data.list) {
                btn.button('reset');
                $('#gccodelist').attr('readonly', false);
                $('#gccodelist').attr('disabled', false);
                $('#snippets').append('<p class="alert alert-warning">No results :(</p>');
                $('#snippets').show();
                return false;
            }
            $.each(data.list, function(guid, spoiler) {
                var html = '<h3><a href="http://www.geocaching.com/hide/report.aspx?guid=' + guid + '" ';
                html += 'onclick="window.open(this.href);return false;" title="Click here to edit this listing">' + spoiler.gccode + '</a></h3>\n';
                html += '<textarea rows="4" cols="50" class="form-control">' + spoiler.list + '</textarea>\n\n';
                $('#snippets').append(html);
                $('#instructions').show();
                $('#snippets').show();
            });
            btn.button('reset');
            $('#gccodelist').attr('readonly', false);
            $('#gccodelist').attr('disabled', false);
        },
        failure: function() {}
    });
    return false;
});
