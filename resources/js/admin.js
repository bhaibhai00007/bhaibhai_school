!function (t) {
    t(document).ready(function () {
        t(".button-collapse").sideNav(), t(".input-field select").material_select(), t(".datepicker").pickadate({selectYears: 20}), t(".slimscroll").each(function () {
            var a = t(this), e = {};
            t.extend(e, a.data()), a.slimScroll(e)
        }), t(".modal").modal(), t("pre").each(function () {
            var a = t(this), e = a.children("code").eq(0);
            a.addClass("prettyprint"), a.addClass(e.attr("class")), a.attr("data-language", e.attr("class")), a.html(e.html().trim())
        }), t("pre").length > 0 && prettyPrint()
    })
}(jQuery);