

$(document).ready(function() {
    $('.js-add-project-collections').on('click', function(e) {
        e.preventDefault();
        var $link = $(e.currentTarget);
        $link.toggleClass('fa-bookmark-o').toggleClass('fa-bookmark');
        $.ajax({
            method: 'POST',
            url: $link.attr('href')
        }).done(function(data) {
            $('.js-add-project-collections-count').html(data.hearts);
        })
    });
});
