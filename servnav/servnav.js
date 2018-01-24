$(document).ready(function () {
    initServNav();
});

function initServNav() {
    if (location.pathname.indexOf('_layout') < 0) return false;

    var menu = '<div class="serv-menu"><div class="serv-menu__roll"></div></div>',
        pages = {
            'index': 'Главная',//формат 'НАЗВАНИЕ_ФАЙЛА_СТРАНИЦЫ':'НАЗВАНИЕ СТРАНИЦЫ'
        };

    $('body').append(menu);

    for (var k in pages) {
        $('.serv-menu').append('<a href="/_layout/' + k + '.html">' + pages[k] + '</a>');
    }


    $('.serv-menu a[href="' + location.pathname + '"]').addClass('active');
    $(document).on('click', '.serv-menu__roll', function () {
        $('.serv-menu').toggleClass('show');
        var t = $(this);
    });

    $('.nav_main .nav__item:first-child .nav__link').addClass('active');

    $(document).on('click', '.catalog-sort__link', function (e) {
        e.preventDefault();
        var t = $(this),
            p = t.closest('.catalog-sort');

        p.find('.active').removeClass('active');

        t.addClass('active');

    });

}
