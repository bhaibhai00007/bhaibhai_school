!function (e) {
    e.fn.dataTableExt.oStdClasses.sPageButton = "btn-flat small waves-effect";
    var a = function (a) {
        var t = [];
        return a.find("thead > tr > th").each(function () {
            var a = e(this);
            t.push({searchable: "undefined" == typeof a.data("searchable") || a.data("searchable"), orderable: "undefined" == typeof a.data("orderable") || a.data("orderable")})
        }), t
    }, t = function (a) {
        var t = a.parents(".dataTables_wrapper").eq(0), n = e("<nav>").prependTo(t), r = t.find(".nav-wrapper"), o = t.find(".dataTables_filter");
        o.addClass("input-field"), o.addClass("with-search-bar"), o.prependTo(r), t.find(".dataTables_filter label input").prependTo(o), t.find(".dataTables_filter label").remove(), o.append('<label for="search"><i class="material-icons">search</i></label>'), o.append('<i class="material-icons">close</i>'), r.prependTo(n)
    }, n = function () {
        var a = e("#btnDeleteAll");
        e(".crud-app table tbody [type=checkbox]:checked").length > 0 ? a.removeAttr("disabled") : a.attr("disabled", "disabled")
    }, r = function () {
        e(".crud-app").Lock({background: "rgba(249,249,249,.5)"})
    }, o = function () {
        e(".crud-app").Unlock()
    };
    e(document).ready(function () {
        e(".datatable").each(function () {
            var n = e(this);
            n.DataTable({order: [], columns: a(n), fnInitComplete: function (e, a) {
                    t(n)
                }, dom: "<'nav-wrapper'f><''tr><'row no-gutter'   <'col s12 m4'i>   <'col s12 m8'p>>"})
        }), n(), e(document).on("change",".crud-app [type=checkbox]", function () {
            setTimeout(n, 50)
        }), e(document).on("click",".btnDelete", function () {
            var tableIndex=0;
            var a = e(this), t = a.parents("tr").eq(0), l = t.children("td").eq(1).html(), d = "";
            tableIndex = t.children("td").eq(1).data("id");
            d += "<p>Are you sure you want to delete this item?</p>", d += "<p><b>" + l + "</b></p>";
            var c = {hooks: {onOk: function () {
                        r(), setTimeout(function () {
                            var a = e(".datatable").DataTable();
                            a.row(t).remove().draw();
                            $("body").Lock({background: "rgba(249,249,249,.5)"});
                            myJsMain.holiday_delete(tableIndex);
                        }, 1e3)
                    }}};
            e.Modal("Delete", d, c)
        }), e(document).on("click","#btnDeleteAll", function () {
            var a = e(".crud-app table tbody [type=checkbox]:checked"), t = "";
            t += "<p>Are you sure you want to delete these items?</p>", t += "<p>", a.each(function () {
                var a = e(this), n = a.parents("tr").eq(0), r = n.children("td").eq(1).html();
                t += '<div class="bold">' + r + "</div>"
            }), t += "</p>";
            var l = {hooks: {onOk: function () {
                        r(), setTimeout(function () {
                            var t = e(".datatable").DataTable();
                            a.each(function () {
                                var a = e(this), n = a.parents("tr").eq(0);
                                t.row(n).remove()
                            }), t.draw(), e("#chkDeleteAll").prop("checked", !1), n(), o(), Materialize.toast(a.length + " items deleted", 5e3, "success")
                        }, 1e3)
                    }}};
            e.Modal("Delete", t, l)
        })
    })
}(jQuery);

/**

a.each(function () {
                var a = e(this), n = a.parents("tr").eq(0), r = n.children("td").eq(1).html();
                t += '<div class="bold">' + r + "</div>"
            }),
 
 * **/