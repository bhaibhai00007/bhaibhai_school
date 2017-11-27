!function (o) {
    o.Modal = function (n, e, t,modalFooterType) {
        n = n || "", e = e || "",t=t || "",modalFooterType=modalFooterType || "";
		//alert("t "+t);
		if(modalFooterType=='alert'){
                    var c = {id: o.randomID(), fixedFooter: !1, closed: !1, dismissible: !0, opacity: .5, classes: {ok: "waves-effect waves-green btn-flat"}, texts: {ok: "Ok"}, hooks: {onShow: function () {
                                    }, onClose: function () {
                                    }, onOk: null, onCancel: null}}, t = t || {};
                    o.extend(c, t);
		}else{
                    var c = {id: o.randomID(), fixedFooter: !1, closed: !1, dismissible: !0, opacity: .5, classes: {ok: "waves-effect waves-green btn-flat", cancel: "waves-effect waves-red btn-flat"}, texts: {ok: "Ok", cancel: "Cancel"}, hooks: {onShow: function () {
                                    }, onClose: function () {
                                    }, onOk: null, onCancel: null}}, t = t || {};
                    o.extend(c, t);
		}
        var i = function () {
            var n = "";
            n += '<div id="' + c.id + '" class="' + l() + '">', n += '\t<div class="modal-content">' + d() + "</div>", n += a(), n += "</div>", o("body").append(n)
        }, l = function () {
            var o = "modal";
            return c.fixedFooter !== !1 && (o += " modal-fixed-footer"), o
        }, d = function () {
            var o = "";
            return n.length > 0 && (o += '<h5 id="title">' + n + "</h5>"), o += '<div id="content">' + e + "</div>"
        }, a = function () {
            var o = "";
            if(modalFooterType=='alert'){
                return null === c.hooks.onOk && null === c.hooks.onCancel ? o : (o += '<div class="modal-footer">', o += '   <a id="ok" class="modal-action modal-close ' + c.classes.ok + '">' + c.texts.ok + "</a>", o += "</div>")
            }else{
                return null === c.hooks.onOk && null === c.hooks.onCancel ? o : (o += '<div class="modal-footer">', o += '   <a id="cancel" class="modal-action modal-close ' + c.classes.cancel + '">' + c.texts.cancel + "</a>", o += '   <a id="ok" class="modal-action modal-close ' + c.classes.ok + '">' + c.texts.ok + "</a>", o += "</div>")
            }
        }, s = function () {
			if(modalFooterType=='alert'){
				var n = o("#" + c.id), e = n.find("#ok"),t = n.find("#ok");
			}else{
				var n = o("#" + c.id), e = n.find("#ok"), t = n.find("#cancel");
			}
            
            n.modal({dismissible: c.dismissible, opacity: c.opacity, ready: c.hooks.onShow, complete: c.hooks.onClose}), "function" == typeof c.hooks.onOk ? (e.off("click"), e.on("click", function (o) {
                c.hooks.onOk(o)
            })) : e.attr("href", c.hooks.onOk), "function" == typeof c.hooks.onCancel ? (t.off("click"), t.on("click", function (o) {
                c.hooks.onCancel(o)
            })) : t.attr("href", c.hooks.onCancel)
        }, f = function () {
            var n = o("#" + c.id);
            n.modal("open")
        }, u = function () {
            var n = o("#" + c.id);
            n.modal("close")
        }, r = function () {
            var t = o("#" + c.id), i = t.find("#title"), l = t.find("#content");
            i.html(n), l.html(e), s()
        }, k = function (o) {
            n = o, r()
        }, h = function (o) {
            e = o, r()
        }, v = function (n) {
            o.extend(t, n), o.extend(c, t), r()
        }, m = function () {
            return n
        }, p = function () {
            return e
        }, y = function () {
            return c
        };
        return i(), s(), c.closed === !1 && f(), {open: f, close: u, setTitle: k, setContent: h, setConfig: v, getTitle: m, getContent: p, getConfig: y}
    }, o(document).ready(function () {
        o(document).on("click", ".modal-trigger", function () {
            var n = o(this), e = n.data();
            "undefined" == typeof e.title && (e.title = ""), "undefined" == typeof e.content && (e.content = ""), "undefined" != typeof e.content && o.isValidSelector(e.content) && (e.content = o(e.content).html()), "undefined" == typeof e.hooks && (e.hooks = {}), "undefined" != typeof e.onshow && (e.hooks.onShow = e.onshow), "undefined" != typeof e.onclose && (e.hooks.onClose = e.onclose), "undefined" != typeof e.onok && (e.hooks.onOk = e.onok), "undefined" != typeof e.oncancel && (e.hooks.onCancel = e.oncancel);
            o.Modal(e.title, e.content, e)
        })
    })
}(jQuery);