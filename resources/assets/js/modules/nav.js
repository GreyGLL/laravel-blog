module.exports = function nav() {
    $('.js-nav-toggle').on('click', function(e) {
        e.preventDefault();
        $('.js-nav-menu').toggleClass('is-active');
    });

}();