!function (n) {
    n.TableOfContents = function () {
        var t = function () {
            n(".pushpin-wrapper").pushpin({top: e(), bottom: o(), offset: r()}), n(".scrollspy").scrollSpy()
        }, e = function () {
            var t = n("#nav-content nav").height(), e = n(".page-header") ? n(".page-header").parents(".row").height() : 0, o = n(".page-header") ? parseInt(n(".page-header").parents(".row").css("margin-bottom")) : 0, r = parseInt(n(".main-content").css("padding-top"));
            return t + e + o + r
        }, o = function () {
            var t = n("footer") ? n("footer").first().offset().top : 0, e = parseInt(n(".main-content").css("padding-bottom")), o = n(".pushpin-wrapper .table-of-contents").height(), r = 50;
            return t - e - o - r
        }, r = function () {
            return n("#nav-content").hasClass("navbar-fixed") ? 100 : 0
        }, a = function () {
            n(".tabs-wrapper .row").pushpin("remove"), t()
        };
        return{init: t, reload: a}
    }, n(document).ready(function () {
        setTimeout(function () {
            n.TableOfContents().init()
        }, 100)
    })
}(jQuery);