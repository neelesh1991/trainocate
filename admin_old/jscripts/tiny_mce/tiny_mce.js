(function(e) {
    var a = /^\s*|\s*$/g,
        b, d = "B".replace(/A(.)|B/, "$1") === "$1";
    var c = {
        majorVersion: "3",
        minorVersion: "5.8",
        releaseDate: "2012-11-20",
        _init: function() {
            var s = this,
                q = document,
                o = navigator,
                g = o.userAgent,
                m, f, l, k, j, r;
            s.isOpera = e.opera && opera.buildNumber;
            s.isWebKit = /WebKit/.test(g);
            s.isIE = !s.isWebKit && !s.isOpera && (/MSIE/gi).test(g) && (/Explorer/gi).test(o.appName);
            s.isIE6 = s.isIE && /MSIE [56]/.test(g);
            s.isIE7 = s.isIE && /MSIE [7]/.test(g);
            s.isIE8 = s.isIE && /MSIE [8]/.test(g);
            s.isIE9 = s.isIE && /MSIE [9]/.test(g);
            s.isGecko = !s.isWebKit && /Gecko/.test(g);
            s.isMac = g.indexOf("Mac") != -1;
            s.isAir = /adobeair/i.test(g);
            s.isIDevice = /(iPad|iPhone)/.test(g);
            s.isIOS5 = s.isIDevice && g.match(/AppleWebKit\/(\d*)/)[1] >= 534;
            if (e.tinyMCEPreInit) {
                s.suffix = tinyMCEPreInit.suffix;
                s.baseURL = tinyMCEPreInit.base;
                s.query = tinyMCEPreInit.query;
                return
            }
            s.suffix = "";
            f = q.getElementsByTagName("base");
            for (m = 0; m < f.length; m++) {
                r = f[m].href;
                if (r) {
                    if (/^https?:\/\/[^\/]+$/.test(r)) {
                        r += "/"
                    }
                    k = r ? r.match(/.*\//)[0] : ""
                }
            }

            function h(i) {
                if (i.src && /tiny_mce(|_gzip|_jquery|_prototype|_full)(_dev|_src)?.js/.test(i.src)) {
                    if (/_(src|dev)\.js/g.test(i.src)) {
                        s.suffix = "_src"
                    }
                    if ((j = i.src.indexOf("?")) != -1) {
                        s.query = i.src.substring(j + 1)
                    }
                    s.baseURL = i.src.substring(0, i.src.lastIndexOf("/"));
                    if (k && s.baseURL.indexOf("://") == -1 && s.baseURL.indexOf("/") !== 0) {
                        s.baseURL = k + s.baseURL
                    }
                    return s.baseURL
                }
                return null
            }
            f = q.getElementsByTagName("script");
            for (m = 0; m < f.length; m++) {
                if (h(f[m])) {
                    return
                }
            }
            l = q.getElementsByTagName("head")[0];
            if (l) {
                f = l.getElementsByTagName("script");
                for (m = 0; m < f.length; m++) {
                    if (h(f[m])) {
                        return
                    }
                }
            }
            return
        },
        is: function(g, f) {
            if (!f) {
                return g !== b
            }
            if (f == "array" && c.isArray(g)) {
                return true
            }
            return typeof(g) == f
        },
        isArray: Array.isArray || function(f) {
            return Object.prototype.toString.call(f) === "[object Array]"
        },
        makeMap: function(f, j, h) {
            var g;
            f = f || [];
            j = j || ",";
            if (typeof(f) == "string") {
                f = f.split(j)
            }
            h = h || {};
            g = f.length;
            while (g--) {
                h[f[g]] = {}
            }
            return h
        },
        each: function(i, f, h) {
            var j, g;
            if (!i) {
                return 0
            }
            h = h || i;
            if (i.length !== b) {
                for (j = 0, g = i.length; j < g; j++) {
                    if (f.call(h, i[j], j, i) === false) {
                        return 0
                    }
                }
            } else {
                for (j in i) {
                    if (i.hasOwnProperty(j)) {
                        if (f.call(h, i[j], j, i) === false) {
                            return 0
                        }
                    }
                }
            }
            return 1
        },
        map: function(g, h) {
            var i = [];
            c.each(g, function(f) {
                i.push(h(f))
            });
            return i
        },
        grep: function(g, h) {
            var i = [];
            c.each(g, function(f) {
                if (!h || h(f)) {
                    i.push(f)
                }
            });
            return i
        },
        inArray: function(g, h) {
            var j, f;
            if (g) {
                for (j = 0, f = g.length; j < f; j++) {
                    if (g[j] === h) {
                        return j
                    }
                }
            }
            return -1
        },
        extend: function(n, k) {
            var j, f, h, g = arguments,
                m;
            for (j = 1, f = g.length; j < f; j++) {
                k = g[j];
                for (h in k) {
                    if (k.hasOwnProperty(h)) {
                        m = k[h];
                        if (m !== b) {
                            n[h] = m
                        }
                    }
                }
            }
            return n
        },
        trim: function(f) {
            return (f ? "" + f : "").replace(a, "")
        },
        create: function(o, f, j) {
            var n = this,
                g, i, k, l, h, m = 0;
            o = /^((static) )?([\w.]+)(:([\w.]+))?/.exec(o);
            k = o[3].match(/(^|\.)(\w+)$/i)[2];
            i = n.createNS(o[3].replace(/\.\w+$/, ""), j);
            if (i[k]) {
                return
            }
            if (o[2] == "static") {
                i[k] = f;
                if (this.onCreate) {
                    this.onCreate(o[2], o[3], i[k])
                }
                return
            }
            if (!f[k]) {
                f[k] = function() {};
                m = 1
            }
            i[k] = f[k];
            n.extend(i[k].prototype, f);
            if (o[5]) {
                g = n.resolve(o[5]).prototype;
                l = o[5].match(/\.(\w+)$/i)[1];
                h = i[k];
                if (m) {
                    i[k] = function() {
                        return g[l].apply(this, arguments)
                    }
                } else {
                    i[k] = function() {
                        this.parent = g[l];
                        return h.apply(this, arguments)
                    }
                }
                i[k].prototype[k] = i[k];
                n.each(g, function(p, q) {
                    i[k].prototype[q] = g[q]
                });
                n.each(f, function(p, q) {
                    if (g[q]) {
                        i[k].prototype[q] = function() {
                            this.parent = g[q];
                            return p.apply(this, arguments)
                        }
                    } else {
                        if (q != k) {
                            i[k].prototype[q] = p
                        }
                    }
                })
            }
            n.each(f["static"], function(p, q) {
                i[k][q] = p
            });
            if (this.onCreate) {
                this.onCreate(o[2], o[3], i[k].prototype)
            }
        },
        walk: function(i, h, j, g) {
            g = g || this;
            if (i) {
                if (j) {
                    i = i[j]
                }
                c.each(i, function(k, f) {
                    if (h.call(g, k, f, j) === false) {
                        return false
                    }
                    c.walk(k, h, j, g)
                })
            }
        },
        createNS: function(j, h) {
            var g, f;
            h = h || e;
            j = j.split(".");
            for (g = 0; g < j.length; g++) {
                f = j[g];
                if (!h[f]) {
                    h[f] = {}
                }
                h = h[f]
            }
            return h
        },
        resolve: function(j, h) {
            var g, f;
            h = h || e;
            j = j.split(".");
            for (g = 0, f = j.length; g < f; g++) {
                h = h[j[g]];
                if (!h) {
                    break
                }
            }
            return h
        },
        addUnload: function(j, i) {
            var h = this,
                g;
            g = function() {
                var f = h.unloads,
                    l, m;
                if (f) {
                    for (m in f) {
                        l = f[m];
                        if (l && l.func) {
                            l.func.call(l.scope, 1)
                        }
                    }
                    if (e.detachEvent) {
                        e.detachEvent("onbeforeunload", k);
                        e.detachEvent("onunload", g)
                    } else {
                        if (e.removeEventListener) {
                            e.removeEventListener("unload", g, false)
                        }
                    }
                    h.unloads = l = f = w = g = 0;
                    if (e.CollectGarbage) {
                        CollectGarbage()
                    }
                }
            };

            function k() {
                var l = document;

                function f() {
                    l.detachEvent("onstop", f);
                    if (g) {
                        g()
                    }
                    l = 0
                }
                if (l.readyState == "interactive") {
                    if (l) {
                        l.attachEvent("onstop", f)
                    }
                    e.setTimeout(function() {
                        if (l) {
                            l.detachEvent("onstop", f)
                        }
                    }, 0)
                }
            }
            j = {
                func: j,
                scope: i || this
            };
            if (!h.unloads) {
                if (e.attachEvent) {
                    e.attachEvent("onunload", g);
                    e.attachEvent("onbeforeunload", k)
                } else {
                    if (e.addEventListener) {
                        e.addEventListener("unload", g, false)
                    }
                }
                h.unloads = [j]
            } else {
                h.unloads.push(j)
            }
            return j
        },
        removeUnload: function(i) {
            var g = this.unloads,
                h = null;
            c.each(g, function(j, f) {
                if (j && j.func == i) {
                    g.splice(f, 1);
                    h = i;
                    return false
                }
            });
            return h
        },
        explode: function(f, g) {
            if (!f || c.is(f, "array")) {
                return f
            }
            return c.map(f.split(g || ","), c.trim)
        },
        _addVer: function(g) {
            var f;
            if (!this.query) {
                return g
            }
            f = (g.indexOf("?") == -1 ? "?" : "&") + this.query;
            if (g.indexOf("#") == -1) {
                return g + f
            }
            return g.replace("#", f + "#")
        },
        _replace: function(h, f, g) {
            if (d) {
                return g.replace(h, function() {
                    var l = f,
                        j = arguments,
                        k;
                    for (k = 0; k < j.length - 2; k++) {
                        if (j[k] === b) {
                            l = l.replace(new RegExp("\\$" + k, "g"), "")
                        } else {
                            l = l.replace(new RegExp("\\$" + k, "g"), j[k])
                        }
                    }
                    return l
                })
            }
            return g.replace(h, f)
        }
    };
    c._init();
    e.tinymce = e.tinyMCE = c
})(window);
tinymce.create("tinymce.util.Dispatcher", {
    scope: null,
    listeners: null,
    inDispatch: false,
    Dispatcher: function(a) {
        this.scope = a || this;
        this.listeners = []
    },
    add: function(b, a) {
        this.listeners.push({
            cb: b,
            scope: a || this.scope
        });
        return b
    },
    addToTop: function(d, b) {
        var a = this,
            c = {
                cb: d,
                scope: b || a.scope
            };
        if (a.inDispatch) {
            a.listeners = [c].concat(a.listeners)
        } else {
            a.listeners.unshift(c)
        }
        return d
    },
    remove: function(c) {
        var b = this.listeners,
            a = null;
        tinymce.each(b, function(e, d) {
            if (c == e.cb) {
                a = e;
                b.splice(d, 1);
                return false
            }
        });
        return a
    },
    dispatch: function() {
        var a = this,
            e, b = arguments,
            c, d = a.listeners,
            f;
        a.inDispatch = true;
        for (c = 0; c < d.length; c++) {
            f = d[c];
            e = f.cb.apply(f.scope, b.length > 0 ? b : [f.scope]);
            if (e === false) {
                break
            }
        }
        a.inDispatch = false;
        return e
    }
});
(function() {
    var a = tinymce.each;
    tinymce.create("tinymce.util.URI", {
        URI: function(e, g) {
            var f = this,
                i, d, c, h;
            e = tinymce.trim(e);
            g = f.settings = g || {};
            if (/^([\w\-]+):([^\/]{2})/i.test(e) || /^\s*#/.test(e)) {
                f.source = e;
                return
            }
            if (e.indexOf("/") === 0 && e.indexOf("//") !== 0) {
                e = (g.base_uri ? g.base_uri.protocol || "http" : "http") + "://mce_host" + e
            }
            if (!/^[\w\-]*:?\/\//.test(e)) {
                h = g.base_uri ? g.base_uri.path : new tinymce.util.URI(location.href).directory;
                e = ((g.base_uri && g.base_uri.protocol) || "http") + "://mce_host" + f.toAbsPath(h, e)
            }
            e = e.replace(/@@/g, "(mce_at)");
            e = /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@\/]*):?([^:@\/]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/.exec(e);
            a(["source", "protocol", "authority", "userInfo", "user", "password", "host", "port", "relative", "path", "directory", "file", "query", "anchor"], function(b, j) {
                var k = e[j];
                if (k) {
                    k = k.replace(/\(mce_at\)/g, "@@")
                }
                f[b] = k
            });
            c = g.base_uri;
            if (c) {
                if (!f.protocol) {
                    f.protocol = c.protocol
                }
                if (!f.userInfo) {
                    f.userInfo = c.userInfo
                }
                if (!f.port && f.host === "mce_host") {
                    f.port = c.port
                }
                if (!f.host || f.host === "mce_host") {
                    f.host = c.host
                }
                f.source = ""
            }
        },
        setPath: function(c) {
            var b = this;
            c = /^(.*?)\/?(\w+)?$/.exec(c);
            b.path = c[0];
            b.directory = c[1];
            b.file = c[2];
            b.source = "";
            b.getURI()
        },
        toRelative: function(b) {
            var d = this,
                f;
            if (b === "./") {
                return b
            }
            b = new tinymce.util.URI(b, {
                base_uri: d
            });
            if ((b.host != "mce_host" && d.host != b.host && b.host) || d.port != b.port || d.protocol != b.protocol) {
                return b.getURI()
            }
            var c = d.getURI(),
                e = b.getURI();
            if (c == e || (c.charAt(c.length - 1) == "/" && c.substr(0, c.length - 1) == e)) {
                return c
            }
            f = d.toRelPath(d.path, b.path);
            if (b.query) {
                f += "?" + b.query
            }
            if (b.anchor) {
                f += "#" + b.anchor
            }
            return f
        },
        toAbsolute: function(b, c) {
            b = new tinymce.util.URI(b, {
                base_uri: this
            });
            return b.getURI(this.host == b.host && this.protocol == b.protocol ? c : 0)
        },
        toRelPath: function(g, h) {
            var c, f = 0,
                d = "",
                e, b;
            g = g.substring(0, g.lastIndexOf("/"));
            g = g.split("/");
            c = h.split("/");
            if (g.length >= c.length) {
                for (e = 0, b = g.length; e < b; e++) {
                    if (e >= c.length || g[e] != c[e]) {
                        f = e + 1;
                        break
                    }
                }
            }
            if (g.length < c.length) {
                for (e = 0, b = c.length; e < b; e++) {
                    if (e >= g.length || g[e] != c[e]) {
                        f = e + 1;
                        break
                    }
                }
            }
            if (f === 1) {
                return h
            }
            for (e = 0, b = g.length - (f - 1); e < b; e++) {
                d += "../"
            }
            for (e = f - 1, b = c.length; e < b; e++) {
                if (e != f - 1) {
                    d += "/" + c[e]
                } else {
                    d += c[e]
                }
            }
            return d
        },
        toAbsPath: function(e, f) {
            var c, b = 0,
                h = [],
                d, g;
            d = /\/$/.test(f) ? "/" : "";
            e = e.split("/");
            f = f.split("/");
            a(e, function(i) {
                if (i) {
                    h.push(i)
                }
            });
            e = h;
            for (c = f.length - 1, h = []; c >= 0; c--) {
                if (f[c].length === 0 || f[c] === ".") {
                    continue
                }
                if (f[c] === "..") {
                    b++;
                    continue
                }
                if (b > 0) {
                    b--;
                    continue
                }
                h.push(f[c])
            }
            c = e.length - b;
            if (c <= 0) {
                g = h.reverse().join("/")
            } else {
                g = e.slice(0, c).join("/") + "/" + h.reverse().join("/")
            }
            if (g.indexOf("/") !== 0) {
                g = "/" + g
            }
            if (d && g.lastIndexOf("/") !== g.length - 1) {
                g += d
            }
            return g
        },
        getURI: function(d) {
            var c, b = this;
            if (!b.source || d) {
                c = "";
                if (!d) {
                    if (b.protocol) {
                        c += b.protocol + "://"
                    }
                    if (b.userInfo) {
                        c += b.userInfo + "@"
                    }
                    if (b.host) {
                        c += b.host
                    }
                    if (b.port) {
                        c += ":" + b.port
                    }
                }
                if (b.path) {
                    c += b.path
                }
                if (b.query) {
                    c += "?" + b.query
                }
                if (b.anchor) {
                    c += "#" + b.anchor
                }
                b.source = c
            }
            return b.source
        }
    })
})();
(function() {
    var a = tinymce.each;
    tinymce.create("static tinymce.util.Cookie", {
        getHash: function(d) {
            var b = this.get(d),
                c;
            if (b) {
                a(b.split("&"), function(e) {
                    e = e.split("=");
                    c = c || {};
                    c[unescape(e[0])] = unescape(e[1])
                })
            }
            return c
        },
        setHash: function(j, b, g, f, i, c) {
            var h = "";
            a(b, function(e, d) {
                h += (!h ? "" : "&") + escape(d) + "=" + escape(e)
            });
            this.set(j, h, g, f, i, c)
        },
        get: function(i) {
            var h = document.cookie,
                g, f = i + "=",
                d;
            if (!h) {
                return
            }
            d = h.indexOf("; " + f);
            if (d == -1) {
                d = h.indexOf(f);
                if (d !== 0) {
                    return null
                }
            } else {
                d += 2
            }
            g = h.indexOf(";", d);
            if (g == -1) {
                g = h.length
            }
            return unescape(h.substring(d + f.length, g))
        },
        set: function(i, b, g, f, h, c) {
            document.cookie = i + "=" + escape(b) + ((g) ? "; expires=" + g.toGMTString() : "") + ((f) ? "; path=" + escape(f) : "") + ((h) ? "; domain=" + h : "") + ((c) ? "; secure" : "")
        },
        remove: function(c, e, d) {
            var b = new Date();
            b.setTime(b.getTime() - 1000);
            this.set(c, "", b, e, d)
        }
    })
})();
(function() {
    function serialize(o, quote) {
        var i, v, t, name;
        quote = quote || '"';
        if (o == null) {
            return "null"
        }
        t = typeof o;
        if (t == "string") {
            v = "\bb\tt\nn\ff\rr\"\"''\\\\";
            return quote + o.replace(/([\u0080-\uFFFF\x00-\x1f\"\'\\])/g, function(a, b) {
                if (quote === '"' && a === "'") {
                    return a
                }
                i = v.indexOf(b);
                if (i + 1) {
                    return "\\" + v.charAt(i + 1)
                }
                a = b.charCodeAt().toString(16);
                return "\\u" + "0000".substring(a.length) + a
            }) + quote
        }
        if (t == "object") {
            if (o.hasOwnProperty && Object.prototype.toString.call(o) === "[object Array]") {
                for (i = 0, v = "["; i < o.length; i++) {
                    v += (i > 0 ? "," : "") + serialize(o[i], quote)
                }
                return v + "]"
            }
            v = "{";
            for (name in o) {
                if (o.hasOwnProperty(name)) {
                    v += typeof o[name] != "function" ? (v.length > 1 ? "," + quote : quote) + name + quote + ":" + serialize(o[name], quote) : ""
                }
            }
            return v + "}"
        }
        return "" + o
    }
    tinymce.util.JSON = {
        serialize: serialize,
        parse: function(s) {
            try {
                return eval("(" + s + ")")
            } catch (ex) {}
        }
    }
})();
tinymce.create("static tinymce.util.XHR", {
    send: function(g) {
        var a, e, b = window,
            h = 0;

        function f() {
            if (!g.async || a.readyState == 4 || h++ > 10000) {
                if (g.success && h < 10000 && a.status == 200) {
                    g.success.call(g.success_scope, "" + a.responseText, a, g)
                } else {
                    if (g.error) {
                        g.error.call(g.error_scope, h > 10000 ? "TIMED_OUT" : "GENERAL", a, g)
                    }
                }
                a = null
            } else {
                b.setTimeout(f, 10)
            }
        }
        g.scope = g.scope || this;
        g.success_scope = g.success_scope || g.scope;
        g.error_scope = g.error_scope || g.scope;
        g.async = g.async === false ? false : true;
        g.data = g.data || "";

        function d(i) {
            a = 0;
            try {
                a = new ActiveXObject(i)
            } catch (c) {}
            return a
        }
        a = b.XMLHttpRequest ? new XMLHttpRequest() : d("Microsoft.XMLHTTP") || d("Msxml2.XMLHTTP");
        if (a) {
            if (a.overrideMimeType) {
                a.overrideMimeType(g.content_type)
            }
            a.open(g.type || (g.data ? "POST" : "GET"), g.url, g.async);
            if (g.content_type) {
                a.setRequestHeader("Content-Type", g.content_type)
            }
            a.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            a.send(g.data);
            if (!g.async) {
                return f()
            }
            e = b.setTimeout(f, 10)
        }
    }
});
(function() {
    var c = tinymce.extend,
        b = tinymce.util.JSON,
        a = tinymce.util.XHR;
    tinymce.create("tinymce.util.JSONRequest", {
        JSONRequest: function(d) {
            this.settings = c({}, d);
            this.count = 0
        },
        send: function(f) {
            var e = f.error,
                d = f.success;
            f = c(this.settings, f);
            f.success = function(h, g) {
                h = b.parse(h);
                if (typeof(h) == "undefined") {
                    h = {
                        error: "JSON Parse error."
                    }
                }
                if (h.error) {
                    e.call(f.error_scope || f.scope, h.error, g)
                } else {
                    d.call(f.success_scope || f.scope, h.result)
                }
            };
            f.error = function(h, g) {
                if (e) {
                    e.call(f.error_scope || f.scope, h, g)
                }
            };
            f.data = b.serialize({
                id: f.id || "c" + (this.count++),
                method: f.method,
                params: f.params
            });
            f.content_type = "application/json";
            a.send(f)
        },
        "static": {
            sendRPC: function(d) {
                return new tinymce.util.JSONRequest().send(d)
            }
        }
    })
}());
(function(a) {
    a.VK = {
        BACKSPACE: 8,
        DELETE: 46,
        DOWN: 40,
        ENTER: 13,
        LEFT: 37,
        RIGHT: 39,
        SPACEBAR: 32,
        TAB: 9,
        UP: 38,
        modifierPressed: function(b) {
            return b.shiftKey || b.ctrlKey || b.altKey
        },
        metaKeyPressed: function(b) {
            return a.isMac ? b.metaKey : b.ctrlKey && !b.altKey
        }
    }
})(tinymce);
tinymce.util.Quirks = function(a) {
    var j = tinymce.VK,
        f = j.BACKSPACE,
        k = j.DELETE,
        e = a.dom,
        l = a.selection,
        H = a.settings,
        v = a.parser,
        o = a.serializer,
        E = tinymce.each;

    function A(N, M) {
        try {
            a.getDoc().execCommand(N, false, M)
        } catch (L) {}
    }

    function n() {
        var L = a.getDoc().documentMode;
        return L ? L : 6
    }

    function z(L) {
        return L.isDefaultPrevented()
    }

    function J() {
        function L(O) {
            var M, Q, N, P;
            M = l.getRng();
            Q = e.getParent(M.startContainer, e.isBlock);
            if (O) {
                Q = e.getNext(Q, e.isBlock)
            }
            if (Q) {
                N = Q.firstChild;
                while (N && N.nodeType == 3 && N.nodeValue.length === 0) {
                    N = N.nextSibling
                }
                if (N && N.nodeName === "SPAN") {
                    P = N.cloneNode(false)
                }
            }
            E(e.select("span", Q), function(R) {
                R.setAttribute("data-mce-mark", "1")
            });
            a.getDoc().execCommand(O ? "ForwardDelete" : "Delete", false, null);
            Q = e.getParent(M.startContainer, e.isBlock);
            E(e.select("span", Q), function(R) {
                var S = l.getBookmark();
                if (P) {
                    e.replace(P.cloneNode(false), R, true)
                } else {
                    if (!R.getAttribute("data-mce-mark")) {
                        e.remove(R, true)
                    } else {
                        R.removeAttribute("data-mce-mark")
                    }
                }
                l.moveToBookmark(S)
            })
        }
        a.onKeyDown.add(function(M, O) {
            var N;
            N = O.keyCode == k;
            if (!z(O) && (N || O.keyCode == f) && !j.modifierPressed(O)) {
                O.preventDefault();
                L(N)
            }
        });
        a.addCommand("Delete", function() {
            L()
        })
    }

    function q() {
        function L(O) {
            var N = e.create("body");
            var P = O.cloneContents();
            N.appendChild(P);
            return l.serializer.serialize(N, {
                format: "html"
            })
        }

        function M(N) {
            var P = L(N);
            var Q = e.createRng();
            Q.selectNode(a.getBody());
            var O = L(Q);
            return P === O
        }
        a.onKeyDown.add(function(O, Q) {
            var P = Q.keyCode,
                N;
            if (!z(Q) && (P == k || P == f)) {
                N = O.selection.isCollapsed();
                if (N && !e.isEmpty(O.getBody())) {
                    return
                }
                if (tinymce.isIE && !N) {
                    return
                }
                if (!N && !M(O.selection.getRng())) {
                    return
                }
                O.setContent("");
                O.selection.setCursorLocation(O.getBody(), 0);
                O.nodeChanged()
            }
        })
    }

    function I() {
        a.onKeyDown.add(function(L, M) {
            if (!z(M) && M.keyCode == 65 && j.metaKeyPressed(M)) {
                M.preventDefault();
                L.execCommand("SelectAll")
            }
        })
    }

    function K() {
        if (!a.settings.content_editable) {
            e.bind(a.getDoc(), "focusin", function(L) {
                l.setRng(l.getRng())
            });
            e.bind(a.getDoc(), "mousedown", function(L) {
                if (L.target == a.getDoc().documentElement) {
                    a.getWin().focus();
                    l.setRng(l.getRng())
                }
            })
        }
    }

    function B() {
        a.onKeyDown.add(function(L, O) {
            if (!z(O) && O.keyCode === f) {
                if (l.isCollapsed() && l.getRng(true).startOffset === 0) {
                    var N = l.getNode();
                    var M = N.previousSibling;
                    if (M && M.nodeName && M.nodeName.toLowerCase() === "hr") {
                        e.remove(M);
                        tinymce.dom.Event.cancel(O)
                    }
                }
            }
        })
    }

    function y() {
        if (!Range.prototype.getClientRects) {
            a.onMouseDown.add(function(M, N) {
                if (!z(N) && N.target.nodeName === "HTML") {
                    var L = M.getBody();
                    L.blur();
                    setTimeout(function() {
                        L.focus()
                    }, 0)
                }
            })
        }
    }

    function h() {
        a.onClick.add(function(L, M) {
            M = M.target;
            if (/^(IMG|HR)$/.test(M.nodeName)) {
                l.getSel().setBaseAndExtent(M, 0, M, 1)
            }
            if (M.nodeName == "A" && e.hasClass(M, "mceItemAnchor")) {
                l.select(M)
            }
            L.nodeChanged()
        })
    }

    function c() {
        function M() {
            var O = e.getAttribs(l.getStart().cloneNode(false));
            return function() {
                var P = l.getStart();
                if (P !== a.getBody()) {
                    e.setAttrib(P, "style", null);
                    E(O, function(Q) {
                        P.setAttributeNode(Q.cloneNode(true))
                    })
                }
            }
        }

        function L() {
            return !l.isCollapsed() && e.getParent(l.getStart(), e.isBlock) != e.getParent(l.getEnd(), e.isBlock)
        }

        function N(O, P) {
            P.preventDefault();
            return false
        }
        a.onKeyPress.add(function(O, Q) {
            var P;
            if (!z(Q) && (Q.keyCode == 8 || Q.keyCode == 46) && L()) {
                P = M();
                O.getDoc().execCommand("delete", false, null);
                P();
                Q.preventDefault();
                return false
            }
        });
        e.bind(a.getDoc(), "cut", function(P) {
            var O;
            if (!z(P) && L()) {
                O = M();
                a.onKeyUp.addToTop(N);
                setTimeout(function() {
                    O();
                    a.onKeyUp.remove(N)
                }, 0)
            }
        })
    }

    function b() {
        var M, L;
        e.bind(a.getDoc(), "selectionchange", function() {
            if (L) {
                clearTimeout(L);
                L = 0
            }
            L = window.setTimeout(function() {
                var N = l.getRng();
                if (!M || !tinymce.dom.RangeUtils.compareRanges(N, M)) {
                    a.nodeChanged();
                    M = N
                }
            }, 50)
        })
    }

    function x() {
        document.body.setAttribute("role", "application")
    }

    function t() {
        a.onKeyDown.add(function(L, N) {
            if (!z(N) && N.keyCode === f) {
                if (l.isCollapsed() && l.getRng(true).startOffset === 0) {
                    var M = l.getNode().previousSibling;
                    if (M && M.nodeName && M.nodeName.toLowerCase() === "table") {
                        return tinymce.dom.Event.cancel(N)
                    }
                }
            }
        })
    }

    function C() {
        if (n() > 7) {
            return
        }
        A("RespectVisibilityInDesign", true);
        a.contentStyles.push(".mceHideBrInPre pre br {display: none}");
        e.addClass(a.getBody(), "mceHideBrInPre");
        v.addNodeFilter("pre", function(L, N) {
            var O = L.length,
                Q, M, R, P;
            while (O--) {
                Q = L[O].getAll("br");
                M = Q.length;
                while (M--) {
                    R = Q[M];
                    P = R.prev;
                    if (P && P.type === 3 && P.value.charAt(P.value - 1) != "\n") {
                        P.value += "\n"
                    } else {
                        R.parent.insert(new tinymce.html.Node("#text", 3), R, true).value = "\n"
                    }
                }
            }
        });
        o.addNodeFilter("pre", function(L, N) {
            var O = L.length,
                Q, M, R, P;
            while (O--) {
                Q = L[O].getAll("br");
                M = Q.length;
                while (M--) {
                    R = Q[M];
                    P = R.prev;
                    if (P && P.type == 3) {
                        P.value = P.value.replace(/\r?\n$/, "")
                    }
                }
            }
        })
    }

    function g() {
        e.bind(a.getBody(), "mouseup", function(N) {
            var M, L = l.getNode();
            if (L.nodeName == "IMG") {
                if (M = e.getStyle(L, "width")) {
                    e.setAttrib(L, "width", M.replace(/[^0-9%]+/g, ""));
                    e.setStyle(L, "width", "")
                }
                if (M = e.getStyle(L, "height")) {
                    e.setAttrib(L, "height", M.replace(/[^0-9%]+/g, ""));
                    e.setStyle(L, "height", "")
                }
            }
        })
    }

    function d() {
        a.onKeyDown.add(function(R, S) {
            var Q, L, M, O, P, T, N;
            Q = S.keyCode == k;
            if (!z(S) && (Q || S.keyCode == f) && !j.modifierPressed(S)) {
                L = l.getRng();
                M = L.startContainer;
                O = L.startOffset;
                N = L.collapsed;
                if (M.nodeType == 3 && M.nodeValue.length > 0 && ((O === 0 && !N) || (N && O === (Q ? 0 : 1)))) {
                    nonEmptyElements = R.schema.getNonEmptyElements();
                    S.preventDefault();
                    P = e.create("br", {
                        id: "__tmp"
                    });
                    M.parentNode.insertBefore(P, M);
                    R.getDoc().execCommand(Q ? "ForwardDelete" : "Delete", false, null);
                    M = l.getRng().startContainer;
                    T = M.previousSibling;
                    if (T && T.nodeType == 1 && !e.isBlock(T) && e.isEmpty(T) && !nonEmptyElements[T.nodeName.toLowerCase()]) {
                        e.remove(T)
                    }
                    e.remove("__tmp")
                }
            }
        })
    }

    function G() {
        a.onKeyDown.add(function(P, Q) {
            var N, M, R, L, O;
            if (z(Q) || Q.keyCode != j.BACKSPACE) {
                return
            }
            N = l.getRng();
            M = N.startContainer;
            R = N.startOffset;
            L = e.getRoot();
            O = M;
            if (!N.collapsed || R !== 0) {
                return
            }
            while (O && O.parentNode && O.parentNode.firstChild == O && O.parentNode != L) {
                O = O.parentNode
            }
            if (O.tagName === "BLOCKQUOTE") {
                P.formatter.toggle("blockquote", null, O);
                N = e.createRng();
                N.setStart(M, 0);
                N.setEnd(M, 0);
                l.setRng(N)
            }
        })
    }

    function F() {
        function L() {
            a._refreshContentEditable();
            A("StyleWithCSS", false);
            A("enableInlineTableEditing", false);
            if (!H.object_resizing) {
                A("enableObjectResizing", false)
            }
        }
        if (!H.readonly) {
            a.onBeforeExecCommand.add(L);
            a.onMouseDown.add(L)
        }
    }

    function s() {
        function L(M, N) {
            E(e.select("a"), function(Q) {
                var O = Q.parentNode,
                    P = e.getRoot();
                if (O.lastChild === Q) {
                    while (O && !e.isBlock(O)) {
                        if (O.parentNode.lastChild !== O || O === P) {
                            return
                        }
                        O = O.parentNode
                    }
                    e.add(O, "br", {
                        "data-mce-bogus": 1
                    })
                }
            })
        }
        a.onExecCommand.add(function(M, N) {
            if (N === "CreateLink") {
                L(M)
            }
        });
        a.onSetContent.add(l.onSetContent.add(L))
    }

    function m() {
        if (H.forced_root_block) {
            a.onInit.add(function() {
                A("DefaultParagraphSeparator", H.forced_root_block)
            })
        }
    }

    function p() {
        function L(N, M) {
            if (!N || !M.initial) {
                a.execCommand("mceRepaint")
            }
        }
        a.onUndo.add(L);
        a.onRedo.add(L);
        a.onSetContent.add(L)
    }

    function i() {
        a.onKeyDown.add(function(M, N) {
            var L;
            if (!z(N) && N.keyCode == f) {
                L = M.getDoc().selection.createRange();
                if (L && L.item) {
                    N.preventDefault();
                    M.undoManager.beforeChange();
                    e.remove(L.item(0));
                    M.undoManager.add()
                }
            }
        })
    }

    function r() {
        var L;
        if (n() >= 10) {
            L = "";
            E("p div h1 h2 h3 h4 h5 h6".split(" "), function(M, N) {
                L += (N > 0 ? "," : "") + M + ":empty"
            });
            a.contentStyles.push(L + "{padding-right: 1px !important}")
        }
    }

    function u() {
        var N, M, ad, L, Y, ab, Z, ac, O, P, aa, W, V, X = document,
            T = a.getDoc();
        if (!H.object_resizing || H.webkit_fake_resize === false) {
            return
        }
        A("enableObjectResizing", false);
        aa = {
            n: [0.5, 0, 0, -1],
            e: [1, 0.5, 1, 0],
            s: [0.5, 1, 0, 1],
            w: [0, 0.5, -1, 0],
            nw: [0, 0, -1, -1],
            ne: [1, 0, 1, -1],
            se: [1, 1, 1, 1],
            sw: [0, 1, -1, 1]
        };

        function R(ah) {
            var ag, af;
            ag = ah.screenX - ab;
            af = ah.screenY - Z;
            W = ag * Y[2] + ac;
            V = af * Y[3] + O;
            W = W < 5 ? 5 : W;
            V = V < 5 ? 5 : V;
            if (j.modifierPressed(ah) || (ad.nodeName == "IMG" && Y[2] * Y[3] !== 0)) {
                W = Math.round(V / P);
                V = Math.round(W * P)
            }
            e.setStyles(L, {
                width: W,
                height: V
            });
            if (Y[2] < 0 && L.clientWidth <= W) {
                e.setStyle(L, "left", N + (ac - W))
            }
            if (Y[3] < 0 && L.clientHeight <= V) {
                e.setStyle(L, "top", M + (O - V))
            }
        }

        function ae() {
            function af(ag, ah) {
                if (ah) {
                    if (ad.style[ag] || !a.schema.isValid(ad.nodeName.toLowerCase(), ag)) {
                        e.setStyle(ad, ag, ah)
                    } else {
                        e.setAttrib(ad, ag, ah)
                    }
                }
            }
            af("width", W);
            af("height", V);
            e.unbind(T, "mousemove", R);
            e.unbind(T, "mouseup", ae);
            if (X != T) {
                e.unbind(X, "mousemove", R);
                e.unbind(X, "mouseup", ae)
            }
            e.remove(L);
            Q(ad)
        }

        function Q(ai) {
            var ag, ah, af;
            S();
            ag = e.getPos(ai);
            N = ag.x;
            M = ag.y;
            ah = ai.offsetWidth;
            af = ai.offsetHeight;
            if (ad != ai) {
                ad = ai;
                W = V = 0
            }
            E(aa, function(al, aj) {
                var ak;
                ak = e.get("mceResizeHandle" + aj);
                if (!ak) {
                    ak = e.add(T.documentElement, "div", {
                        id: "mceResizeHandle" + aj,
                        "class": "mceResizeHandle",
                        style: "cursor:" + aj + "-resize; margin:0; padding:0"
                    });
                    e.bind(ak, "mousedown", function(am) {
                        am.preventDefault();
                        ae();
                        ab = am.screenX;
                        Z = am.screenY;
                        ac = ad.clientWidth;
                        O = ad.clientHeight;
                        P = O / ac;
                        Y = al;
                        L = ad.cloneNode(true);
                        e.addClass(L, "mceClonedResizable");
                        e.setStyles(L, {
                            left: N,
                            top: M,
                            margin: 0
                        });
                        T.documentElement.appendChild(L);
                        e.bind(T, "mousemove", R);
                        e.bind(T, "mouseup", ae);
                        if (X != T) {
                            e.bind(X, "mousemove", R);
                            e.bind(X, "mouseup", ae)
                        }
                    })
                } else {
                    e.show(ak)
                }
                e.setStyles(ak, {
                    left: (ah * al[0] + N) - (ak.offsetWidth / 2),
                    top: (af * al[1] + M) - (ak.offsetHeight / 2)
                })
            });
            if (!tinymce.isOpera && ad.nodeName == "IMG") {
                ad.setAttribute("data-mce-selected", "1")
            }
        }

        function S() {
            if (ad) {
                ad.removeAttribute("data-mce-selected")
            }
            for (var af in aa) {
                e.hide("mceResizeHandle" + af)
            }
        }
        a.contentStyles.push(".mceResizeHandle {position: absolute;border: 1px solid black;background: #FFF;width: 5px;height: 5px;z-index: 10000}.mceResizeHandle:hover {background: #000}img[data-mce-selected] {outline: 1px solid black}img.mceClonedResizable, table.mceClonedResizable {position: absolute;outline: 1px dashed black;opacity: .5;z-index: 10000}");

        function U() {
            var af = e.getParent(l.getNode(), "table,img");
            E(e.select("img[data-mce-selected]"), function(ag) {
                ag.removeAttribute("data-mce-selected")
            });
            if (af) {
                Q(af)
            } else {
                S()
            }
        }
        a.onNodeChange.add(U);
        e.bind(T, "selectionchange", U);
        a.serializer.addAttributeFilter("data-mce-selected", function(af, ag) {
            var ah = af.length;
            while (ah--) {
                af[ah].attr(ag, null)
            }
        })
    }

    function D() {
        if (n() < 9) {
            v.addNodeFilter("noscript", function(L) {
                var M = L.length,
                    N, O;
                while (M--) {
                    N = L[M];
                    O = N.firstChild;
                    if (O) {
                        N.attr("data-mce-innertext", O.value)
                    }
                }
            });
            o.addNodeFilter("noscript", function(L) {
                var M = L.length,
                    N, P, O;
                while (M--) {
                    N = L[M];
                    P = L[M].firstChild;
                    if (P) {
                        P.value = tinymce.html.Entities.decode(P.value)
                    } else {
                        O = N.attributes.map["data-mce-innertext"];
                        if (O) {
                            N.attr("data-mce-innertext", null);
                            P = new tinymce.html.Node("#text", 3);
                            P.value = O;
                            P.raw = true;
                            N.append(P)
                        }
                    }
                }
            })
        }
    }
    t();
    G();
    q();
    if (tinymce.isWebKit) {
        d();
        J();
        K();
        h();
        m();
        if (tinymce.isIDevice) {
            b()
        } else {
            u();
            I()
        }
    }
    if (tinymce.isIE) {
        B();
        x();
        C();
        g();
        i();
        r();
        D()
    }
    if (tinymce.isGecko) {
        B();
        y();
        c();
        F();
        s();
        p()
    }
    if (tinymce.isOpera) {
        u()
    }
};
(function(j) {
    var a, g, d, k = /[&<>\"\u007E-\uD7FF\uE000-\uFFEF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g,
        b = /[<>&\u007E-\uD7FF\uE000-\uFFEF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g,
        f = /[<>&\"\']/g,
        c = /&(#x|#)?([\w]+);/g,
        i = {
            128: "\u20AC",
            130: "\u201A",
            131: "\u0192",
            132: "\u201E",
            133: "\u2026",
            134: "\u2020",
            135: "\u2021",
            136: "\u02C6",
            137: "\u2030",
            138: "\u0160",
            139: "\u2039",
            140: "\u0152",
            142: "\u017D",
            145: "\u2018",
            146: "\u2019",
            147: "\u201C",
            148: "\u201D",
            149: "\u2022",
            150: "\u2013",
            151: "\u2014",
            152: "\u02DC",
            153: "\u2122",
            154: "\u0161",
            155: "\u203A",
            156: "\u0153",
            158: "\u017E",
            159: "\u0178"
        };
    g = {
        '"': "&quot;",
        "'": "&#39;",
        "<": "&lt;",
        ">": "&gt;",
        "&": "&amp;"
    };
    d = {
        "&lt;": "<",
        "&gt;": ">",
        "&amp;": "&",
        "&quot;": '"',
        "&apos;": "'"
    };

    function h(l) {
        var m;
        m = document.createElement("div");
        m.innerHTML = l;
        return m.textContent || m.innerText || l
    }

    function e(m, p) {
        var n, o, l, q = {};
        if (m) {
            m = m.split(",");
            p = p || 10;
            for (n = 0; n < m.length; n += 2) {
                o = String.fromCharCode(parseInt(m[n], p));
                if (!g[o]) {
                    l = "&" + m[n + 1] + ";";
                    q[o] = l;
                    q[l] = o
                }
            }
            return q
        }
    }
    a = e("50,nbsp,51,iexcl,52,cent,53,pound,54,curren,55,yen,56,brvbar,57,sect,58,uml,59,copy,5a,ordf,5b,laquo,5c,not,5d,shy,5e,reg,5f,macr,5g,deg,5h,plusmn,5i,sup2,5j,sup3,5k,acute,5l,micro,5m,para,5n,middot,5o,cedil,5p,sup1,5q,ordm,5r,raquo,5s,frac14,5t,frac12,5u,frac34,5v,iquest,60,Agrave,61,Aacute,62,Acirc,63,Atilde,64,Auml,65,Aring,66,AElig,67,Ccedil,68,Egrave,69,Eacute,6a,Ecirc,6b,Euml,6c,Igrave,6d,Iacute,6e,Icirc,6f,Iuml,6g,ETH,6h,Ntilde,6i,Ograve,6j,Oacute,6k,Ocirc,6l,Otilde,6m,Ouml,6n,times,6o,Oslash,6p,Ugrave,6q,Uacute,6r,Ucirc,6s,Uuml,6t,Yacute,6u,THORN,6v,szlig,70,agrave,71,aacute,72,acirc,73,atilde,74,auml,75,aring,76,aelig,77,ccedil,78,egrave,79,eacute,7a,ecirc,7b,euml,7c,igrave,7d,iacute,7e,icirc,7f,iuml,7g,eth,7h,ntilde,7i,ograve,7j,oacute,7k,ocirc,7l,otilde,7m,ouml,7n,divide,7o,oslash,7p,ugrave,7q,uacute,7r,ucirc,7s,uuml,7t,yacute,7u,thorn,7v,yuml,ci,fnof,sh,Alpha,si,Beta,sj,Gamma,sk,Delta,sl,Epsilon,sm,Zeta,sn,Eta,so,Theta,sp,Iota,sq,Kappa,sr,Lambda,ss,Mu,st,Nu,su,Xi,sv,Omicron,t0,Pi,t1,Rho,t3,Sigma,t4,Tau,t5,Upsilon,t6,Phi,t7,Chi,t8,Psi,t9,Omega,th,alpha,ti,beta,tj,gamma,tk,delta,tl,epsilon,tm,zeta,tn,eta,to,theta,tp,iota,tq,kappa,tr,lambda,ts,mu,tt,nu,tu,xi,tv,omicron,u0,pi,u1,rho,u2,sigmaf,u3,sigma,u4,tau,u5,upsilon,u6,phi,u7,chi,u8,psi,u9,omega,uh,thetasym,ui,upsih,um,piv,812,bull,816,hellip,81i,prime,81j,Prime,81u,oline,824,frasl,88o,weierp,88h,image,88s,real,892,trade,89l,alefsym,8cg,larr,8ch,uarr,8ci,rarr,8cj,darr,8ck,harr,8dl,crarr,8eg,lArr,8eh,uArr,8ei,rArr,8ej,dArr,8ek,hArr,8g0,forall,8g2,part,8g3,exist,8g5,empty,8g7,nabla,8g8,isin,8g9,notin,8gb,ni,8gf,prod,8gh,sum,8gi,minus,8gn,lowast,8gq,radic,8gt,prop,8gu,infin,8h0,ang,8h7,and,8h8,or,8h9,cap,8ha,cup,8hb,int,8hk,there4,8hs,sim,8i5,cong,8i8,asymp,8j0,ne,8j1,equiv,8j4,le,8j5,ge,8k2,sub,8k3,sup,8k4,nsub,8k6,sube,8k7,supe,8kl,oplus,8kn,otimes,8l5,perp,8m5,sdot,8o8,lceil,8o9,rceil,8oa,lfloor,8ob,rfloor,8p9,lang,8pa,rang,9ea,loz,9j0,spades,9j3,clubs,9j5,hearts,9j6,diams,ai,OElig,aj,oelig,b0,Scaron,b1,scaron,bo,Yuml,m6,circ,ms,tilde,802,ensp,803,emsp,809,thinsp,80c,zwnj,80d,zwj,80e,lrm,80f,rlm,80j,ndash,80k,mdash,80o,lsquo,80p,rsquo,80q,sbquo,80s,ldquo,80t,rdquo,80u,bdquo,810,dagger,811,Dagger,81g,permil,81p,lsaquo,81q,rsaquo,85c,euro", 32);
    j.html = j.html || {};
    j.html.Entities = {
        encodeRaw: function(m, l) {
            return m.replace(l ? k : b, function(n) {
                return g[n] || n
            })
        },
        encodeAllRaw: function(l) {
            return ("" + l).replace(f, function(m) {
                return g[m] || m
            })
        },
        encodeNumeric: function(m, l) {
            return m.replace(l ? k : b, function(n) {
                if (n.length > 1) {
                    return "&#" + (((n.charCodeAt(0) - 55296) * 1024) + (n.charCodeAt(1) - 56320) + 65536) + ";"
                }
                return g[n] || "&#" + n.charCodeAt(0) + ";"
            })
        },
        encodeNamed: function(n, l, m) {
            m = m || a;
            return n.replace(l ? k : b, function(o) {
                return g[o] || m[o] || o
            })
        },
        getEncodeFunc: function(l, o) {
            var p = j.html.Entities;
            o = e(o) || a;

            function m(r, q) {
                return r.replace(q ? k : b, function(s) {
                    return g[s] || o[s] || "&#" + s.charCodeAt(0) + ";" || s
                })
            }

            function n(r, q) {
                return p.encodeNamed(r, q, o)
            }
            l = j.makeMap(l.replace(/\+/g, ","));
            if (l.named && l.numeric) {
                return m
            }
            if (l.named) {
                if (o) {
                    return n
                }
                return p.encodeNamed
            }
            if (l.numeric) {
                return p.encodeNumeric
            }
            return p.encodeRaw
        },
        decode: function(l) {
            return l.replace(c, function(n, m, o) {
                if (m) {
                    o = parseInt(o, m.length === 2 ? 16 : 10);
                    if (o > 65535) {
                        o -= 65536;
                        return String.fromCharCode(55296 + (o >> 10), 56320 + (o & 1023))
                    } else {
                        return i[o] || String.fromCharCode(o)
                    }
                }
                return d[n] || a[n] || h(n)
            })
        }
    }
})(tinymce);
tinymce.html.Styles = function(d, f) {
    var k = /rgb\s*\(\s*([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)\s*\)/gi,
        h = /(?:url(?:(?:\(\s*\"([^\"]+)\"\s*\))|(?:\(\s*\'([^\']+)\'\s*\))|(?:\(\s*([^)\s]+)\s*\))))|(?:\'([^\']+)\')|(?:\"([^\"]+)\")/gi,
        b = /\s*([^:]+):\s*([^;]+);?/g,
        l = /\s+$/,
        m = /rgb/,
        e, g, a = {},
        j;
    d = d || {};
    j = "\\\" \\' \\; \\: ; : \uFEFF".split(" ");
    for (g = 0; g < j.length; g++) {
        a[j[g]] = "\uFEFF" + g;
        a["\uFEFF" + g] = j[g]
    }

    function c(n, q, p, i) {
        function o(r) {
            r = parseInt(r).toString(16);
            return r.length > 1 ? r : "0" + r
        }
        return "#" + o(q) + o(p) + o(i)
    }
    return {
        toHex: function(i) {
            return i.replace(k, c)
        },
        parse: function(s) {
            var z = {},
                q, n, x, r, v = d.url_converter,
                y = d.url_converter_scope || this;

            function p(D, G) {
                var F, C, B, E;
                F = z[D + "-top" + G];
                if (!F) {
                    return
                }
                C = z[D + "-right" + G];
                if (F != C) {
                    return
                }
                B = z[D + "-bottom" + G];
                if (C != B) {
                    return
                }
                E = z[D + "-left" + G];
                if (B != E) {
                    return
                }
                z[D + G] = E;
                delete z[D + "-top" + G];
                delete z[D + "-right" + G];
                delete z[D + "-bottom" + G];
                delete z[D + "-left" + G]
            }

            function u(C) {
                var D = z[C],
                    B;
                if (!D || D.indexOf(" ") < 0) {
                    return
                }
                D = D.split(" ");
                B = D.length;
                while (B--) {
                    if (D[B] !== D[0]) {
                        return false
                    }
                }
                z[C] = D[0];
                return true
            }

            function A(D, C, B, E) {
                if (!u(C)) {
                    return
                }
                if (!u(B)) {
                    return
                }
                if (!u(E)) {
                    return
                }
                z[D] = z[C] + " " + z[B] + " " + z[E];
                delete z[C];
                delete z[B];
                delete z[E]
            }

            function t(B) {
                r = true;
                return a[B]
            }

            function i(C, B) {
                if (r) {
                    C = C.replace(/\uFEFF[0-9]/g, function(D) {
                        return a[D]
                    })
                }
                if (!B) {
                    C = C.replace(/\\([\'\";:])/g, "$1")
                }
                return C
            }

            function o(C, B, F, E, G, D) {
                G = G || D;
                if (G) {
                    G = i(G);
                    return "'" + G.replace(/\'/g, "\\'") + "'"
                }
                B = i(B || F || E);
                if (v) {
                    B = v.call(y, B, "style")
                }
                return "url('" + B.replace(/\'/g, "\\'") + "')"
            }
            if (s) {
                s = s.replace(/\\[\"\';:\uFEFF]/g, t).replace(/\"[^\"]+\"|\'[^\']+\'/g, function(B) {
                    return B.replace(/[;:]/g, t)
                });
                while (q = b.exec(s)) {
                    n = q[1].replace(l, "").toLowerCase();
                    x = q[2].replace(l, "");
                    if (n && x.length > 0) {
                        if (n === "font-weight" && x === "700") {
                            x = "bold"
                        } else {
                            if (n === "color" || n === "background-color") {
                                x = x.toLowerCase()
                            }
                        }
                        x = x.replace(k, c);
                        x = x.replace(h, o);
                        z[n] = r ? i(x, true) : x
                    }
                    b.lastIndex = q.index + q[0].length
                }
                p("border", "");
                p("border", "-width");
                p("border", "-color");
                p("border", "-style");
                p("padding", "");
                p("margin", "");
                A("border", "border-width", "border-style", "border-color");
                if (z.border === "medium none") {
                    delete z.border
                }
            }
            return z
        },
        serialize: function(p, r) {
            var o = "",
                n, q;

            function i(t) {
                var x, u, s, v;
                x = f.styles[t];
                if (x) {
                    for (u = 0, s = x.length; u < s; u++) {
                        t = x[u];
                        v = p[t];
                        if (v !== e && v.length > 0) {
                            o += (o.length > 0 ? " " : "") + t + ": " + v + ";"
                        }
                    }
                }
            }
            if (r && f && f.styles) {
                i("*");
                i(r)
            } else {
                for (n in p) {
                    q = p[n];
                    if (q !== e && q.length > 0) {
                        o += (o.length > 0 ? " " : "") + n + ": " + q + ";"
                    }
                }
            }
            return o
        }
    }
};
(function(f) {
    var a = {},
        e = f.makeMap,
        g = f.each;

    function d(j, i) {
        return j.split(i || ",")
    }

    function h(m, l) {
        var j, k = {};

        function i(n) {
            return n.replace(/[A-Z]+/g, function(o) {
                return i(m[o])
            })
        }
        for (j in m) {
            if (m.hasOwnProperty(j)) {
                m[j] = i(m[j])
            }
        }
        i(l).replace(/#/g, "#text").replace(/(\w+)\[([^\]]+)\]\[([^\]]*)\]/g, function(q, o, n, p) {
            n = d(n, "|");
            k[o] = {
                attributes: e(n),
                attributesOrder: n,
                children: e(p, "|", {
                    "#comment": {}
                })
            }
        });
        return k
    }

    function b() {
        var i = a.html5;
        if (!i) {
            i = a.html5 = h({
                A: "id|accesskey|class|dir|draggable|item|hidden|itemprop|role|spellcheck|style|subject|title|onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|onkeyup",
                B: "#|a|abbr|area|audio|b|bdo|br|button|canvas|cite|code|command|datalist|del|dfn|em|embed|i|iframe|img|input|ins|kbd|keygen|label|link|map|mark|meta|meter|noscript|object|output|progress|q|ruby|samp|script|select|small|span|strong|sub|sup|svg|textarea|time|var|video|wbr",
                C: "#|a|abbr|area|address|article|aside|audio|b|bdo|blockquote|br|button|canvas|cite|code|command|datalist|del|details|dfn|dialog|div|dl|em|embed|fieldset|figure|footer|form|h1|h2|h3|h4|h5|h6|header|hgroup|hr|i|iframe|img|input|ins|kbd|keygen|label|link|map|mark|menu|meta|meter|nav|noscript|ol|object|output|p|pre|progress|q|ruby|samp|script|section|select|small|span|strong|style|sub|sup|svg|table|textarea|time|ul|var|video"
            }, "html[A|manifest][body|head]head[A][base|command|link|meta|noscript|script|style|title]title[A][#]base[A|href|target][]link[A|href|rel|media|type|sizes][]meta[A|http-equiv|name|content|charset][]style[A|type|media|scoped][#]script[A|charset|type|src|defer|async][#]noscript[A][C]body[A][C]section[A][C]nav[A][C]article[A][C]aside[A][C]h1[A][B]h2[A][B]h3[A][B]h4[A][B]h5[A][B]h6[A][B]hgroup[A][h1|h2|h3|h4|h5|h6]header[A][C]footer[A][C]address[A][C]p[A][B]br[A][]pre[A][B]dialog[A][dd|dt]blockquote[A|cite][C]ol[A|start|reversed][li]ul[A][li]li[A|value][C]dl[A][dd|dt]dt[A][B]dd[A][C]a[A|href|target|ping|rel|media|type][B]em[A][B]strong[A][B]small[A][B]cite[A][B]q[A|cite][B]dfn[A][B]abbr[A][B]code[A][B]var[A][B]samp[A][B]kbd[A][B]sub[A][B]sup[A][B]i[A][B]b[A][B]mark[A][B]progress[A|value|max][B]meter[A|value|min|max|low|high|optimum][B]time[A|datetime][B]ruby[A][B|rt|rp]rt[A][B]rp[A][B]bdo[A][B]span[A][B]ins[A|cite|datetime][B]del[A|cite|datetime][B]figure[A][C|legend|figcaption]figcaption[A][C]img[A|alt|src|height|width|usemap|ismap][]iframe[A|name|src|height|width|sandbox|seamless][]embed[A|src|height|width|type][]object[A|data|type|height|width|usemap|name|form|classid][param]param[A|name|value][]details[A|open][C|legend]command[A|type|label|icon|disabled|checked|radiogroup][]menu[A|type|label][C|li]legend[A][C|B]div[A][C]source[A|src|type|media][]audio[A|src|autobuffer|autoplay|loop|controls][source]video[A|src|autobuffer|autoplay|loop|controls|width|height|poster][source]hr[A][]form[A|accept-charset|action|autocomplete|enctype|method|name|novalidate|target][C]fieldset[A|disabled|form|name][C|legend]label[A|form|for][B]input[A|type|accept|alt|autocomplete|autofocus|checked|disabled|form|formaction|formenctype|formmethod|formnovalidate|formtarget|height|list|max|maxlength|min|multiple|pattern|placeholder|readonly|required|size|src|step|width|files|value|name][]button[A|autofocus|disabled|form|formaction|formenctype|formmethod|formnovalidate|formtarget|name|value|type][B]select[A|autofocus|disabled|form|multiple|name|size][option|optgroup]datalist[A][B|option]optgroup[A|disabled|label][option]option[A|disabled|selected|label|value][]textarea[A|autofocus|disabled|form|maxlength|name|placeholder|readonly|required|rows|cols|wrap][]keygen[A|autofocus|challenge|disabled|form|keytype|name][]output[A|for|form|name][B]canvas[A|width|height][]map[A|name][B|C]area[A|shape|coords|href|alt|target|media|rel|ping|type][]mathml[A][]svg[A][]table[A|border][caption|colgroup|thead|tfoot|tbody|tr]caption[A][C]colgroup[A|span][col]col[A|span][]thead[A][tr]tfoot[A][tr]tbody[A][tr]tr[A][th|td]th[A|headers|rowspan|colspan|scope][B]td[A|headers|rowspan|colspan][C]wbr[A][]")
        }
        return i
    }

    function c() {
        var i = a.html4;
        if (!i) {
            i = a.html4 = h({
                Z: "H|K|N|O|P",
                Y: "X|form|R|Q",
                ZG: "E|span|width|align|char|charoff|valign",
                X: "p|T|div|U|W|isindex|fieldset|table",
                ZF: "E|align|char|charoff|valign",
                W: "pre|hr|blockquote|address|center|noframes",
                ZE: "abbr|axis|headers|scope|rowspan|colspan|align|char|charoff|valign|nowrap|bgcolor|width|height",
                ZD: "[E][S]",
                U: "ul|ol|dl|menu|dir",
                ZC: "p|Y|div|U|W|table|br|span|bdo|object|applet|img|map|K|N|Q",
                T: "h1|h2|h3|h4|h5|h6",
                ZB: "X|S|Q",
                S: "R|P",
                ZA: "a|G|J|M|O|P",
                R: "a|H|K|N|O",
                Q: "noscript|P",
                P: "ins|del|script",
                O: "input|select|textarea|label|button",
                N: "M|L",
                M: "em|strong|dfn|code|q|samp|kbd|var|cite|abbr|acronym",
                L: "sub|sup",
                K: "J|I",
                J: "tt|i|b|u|s|strike",
                I: "big|small|font|basefont",
                H: "G|F",
                G: "br|span|bdo",
                F: "object|applet|img|map|iframe",
                E: "A|B|C",
                D: "accesskey|tabindex|onfocus|onblur",
                C: "onclick|ondblclick|onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|onkeydown|onkeyup",
                B: "lang|xml:lang|dir",
                A: "id|class|style|title"
            }, "script[id|charset|type|language|src|defer|xml:space][]style[B|id|type|media|title|xml:space][]object[E|declare|classid|codebase|data|type|codetype|archive|standby|width|height|usemap|name|tabindex|align|border|hspace|vspace][#|param|Y]param[id|name|value|valuetype|type][]p[E|align][#|S]a[E|D|charset|type|name|href|hreflang|rel|rev|shape|coords|target][#|Z]br[A|clear][]span[E][#|S]bdo[A|C|B][#|S]applet[A|codebase|archive|code|object|alt|name|width|height|align|hspace|vspace][#|param|Y]h1[E|align][#|S]img[E|src|alt|name|longdesc|width|height|usemap|ismap|align|border|hspace|vspace][]map[B|C|A|name][X|form|Q|area]h2[E|align][#|S]iframe[A|longdesc|name|src|frameborder|marginwidth|marginheight|scrolling|align|width|height][#|Y]h3[E|align][#|S]tt[E][#|S]i[E][#|S]b[E][#|S]u[E][#|S]s[E][#|S]strike[E][#|S]big[E][#|S]small[E][#|S]font[A|B|size|color|face][#|S]basefont[id|size|color|face][]em[E][#|S]strong[E][#|S]dfn[E][#|S]code[E][#|S]q[E|cite][#|S]samp[E][#|S]kbd[E][#|S]var[E][#|S]cite[E][#|S]abbr[E][#|S]acronym[E][#|S]sub[E][#|S]sup[E][#|S]input[E|D|type|name|value|checked|disabled|readonly|size|maxlength|src|alt|usemap|onselect|onchange|accept|align][]select[E|name|size|multiple|disabled|tabindex|onfocus|onblur|onchange][optgroup|option]optgroup[E|disabled|label][option]option[E|selected|disabled|label|value][]textarea[E|D|name|rows|cols|disabled|readonly|onselect|onchange][]label[E|for|accesskey|onfocus|onblur][#|S]button[E|D|name|value|type|disabled][#|p|T|div|U|W|table|G|object|applet|img|map|K|N|Q]h4[E|align][#|S]ins[E|cite|datetime][#|Y]h5[E|align][#|S]del[E|cite|datetime][#|Y]h6[E|align][#|S]div[E|align][#|Y]ul[E|type|compact][li]li[E|type|value][#|Y]ol[E|type|compact|start][li]dl[E|compact][dt|dd]dt[E][#|S]dd[E][#|Y]menu[E|compact][li]dir[E|compact][li]pre[E|width|xml:space][#|ZA]hr[E|align|noshade|size|width][]blockquote[E|cite][#|Y]address[E][#|S|p]center[E][#|Y]noframes[E][#|Y]isindex[A|B|prompt][]fieldset[E][#|legend|Y]legend[E|accesskey|align][#|S]table[E|summary|width|border|frame|rules|cellspacing|cellpadding|align|bgcolor][caption|col|colgroup|thead|tfoot|tbody|tr]caption[E|align][#|S]col[ZG][]colgroup[ZG][col]thead[ZF][tr]tr[ZF|bgcolor][th|td]th[E|ZE][#|Y]form[E|action|method|name|enctype|onsubmit|onreset|accept|accept-charset|target][#|X|R|Q]noscript[E][#|Y]td[E|ZE][#|Y]tfoot[ZF][tr]tbody[ZF][tr]area[E|D|shape|coords|href|nohref|alt|target][]base[id|href|target][]body[E|onload|onunload|background|bgcolor|text|link|vlink|alink][#|Y]")
        }
        return i
    }
    f.html.Schema = function(A) {
        var u = this,
            s = {},
            k = {},
            j = [],
            D, y;
        var o, q, z, r, v, n, p = {};

        function m(F, E, H) {
            var G = A[F];
            if (!G) {
                G = a[F];
                if (!G) {
                    G = e(E, " ", e(E.toUpperCase(), " "));
                    G = f.extend(G, H);
                    a[F] = G
                }
            } else {
                G = e(G, ",", e(G.toUpperCase(), " "))
            }
            return G
        }
        A = A || {};
        y = A.schema == "html5" ? b() : c();
        if (A.verify_html === false) {
            A.valid_elements = "*[*]"
        }
        if (A.valid_styles) {
            D = {};
            g(A.valid_styles, function(F, E) {
                D[E] = f.explode(F)
            })
        }
        o = m("whitespace_elements", "pre script noscript style textarea");
        q = m("self_closing_elements", "colgroup dd dt li option p td tfoot th thead tr");
        z = m("short_ended_elements", "area base basefont br col frame hr img input isindex link meta param embed source wbr");
        r = m("boolean_attributes", "checked compact declare defer disabled ismap multiple nohref noresize noshade nowrap readonly selected autoplay loop controls");
        n = m("non_empty_elements", "td th iframe video audio object", z);
        textBlockElementsMap = m("text_block_elements", "h1 h2 h3 h4 h5 h6 p div address pre form blockquote center dir fieldset header footer article section hgroup aside nav figure");
        v = m("block_elements", "hr table tbody thead tfoot th tr td li ol ul caption dl dt dd noscript menu isindex samp option datalist select optgroup", textBlockElementsMap);

        function i(E) {
            return new RegExp("^" + E.replace(/([?+*])/g, ".$1") + "$")
        }

        function C(L) {
            var K, G, Z, V, aa, F, I, U, X, Q, Y, ac, O, J, W, E, S, H, ab, ad, P, T, N = /^([#+\-])?([^\[\/]+)(?:\/([^\[]+))?(?:\[([^\]]+)\])?$/,
                R = /^([!\-])?(\w+::\w+|[^=:<]+)?(?:([=:<])(.*))?$/,
                M = /[*?+]/;
            if (L) {
                L = d(L);
                if (s["@"]) {
                    S = s["@"].attributes;
                    H = s["@"].attributesOrder
                }
                for (K = 0, G = L.length; K < G; K++) {
                    F = N.exec(L[K]);
                    if (F) {
                        W = F[1];
                        Q = F[2];
                        E = F[3];
                        X = F[4];
                        O = {};
                        J = [];
                        I = {
                            attributes: O,
                            attributesOrder: J
                        };
                        if (W === "#") {
                            I.paddEmpty = true
                        }
                        if (W === "-") {
                            I.removeEmpty = true
                        }
                        if (S) {
                            for (ad in S) {
                                O[ad] = S[ad]
                            }
                            J.push.apply(J, H)
                        }
                        if (X) {
                            X = d(X, "|");
                            for (Z = 0, V = X.length; Z < V; Z++) {
                                F = R.exec(X[Z]);
                                if (F) {
                                    U = {};
                                    ac = F[1];
                                    Y = F[2].replace(/::/g, ":");
                                    W = F[3];
                                    T = F[4];
                                    if (ac === "!") {
                                        I.attributesRequired = I.attributesRequired || [];
                                        I.attributesRequired.push(Y);
                                        U.required = true
                                    }
                                    if (ac === "-") {
                                        delete O[Y];
                                        J.splice(f.inArray(J, Y), 1);
                                        continue
                                    }
                                    if (W) {
                                        if (W === "=") {
                                            I.attributesDefault = I.attributesDefault || [];
                                            I.attributesDefault.push({
                                                name: Y,
                                                value: T
                                            });
                                            U.defaultValue = T
                                        }
                                        if (W === ":") {
                                            I.attributesForced = I.attributesForced || [];
                                            I.attributesForced.push({
                                                name: Y,
                                                value: T
                                            });
                                            U.forcedValue = T
                                        }
                                        if (W === "<") {
                                            U.validValues = e(T, "?")
                                        }
                                    }
                                    if (M.test(Y)) {
                                        I.attributePatterns = I.attributePatterns || [];
                                        U.pattern = i(Y);
                                        I.attributePatterns.push(U)
                                    } else {
                                        if (!O[Y]) {
                                            J.push(Y)
                                        }
                                        O[Y] = U
                                    }
                                }
                            }
                        }
                        if (!S && Q == "@") {
                            S = O;
                            H = J
                        }
                        if (E) {
                            I.outputName = Q;
                            s[E] = I
                        }
                        if (M.test(Q)) {
                            I.pattern = i(Q);
                            j.push(I)
                        } else {
                            s[Q] = I
                        }
                    }
                }
            }
        }

        function t(E) {
            s = {};
            j = [];
            C(E);
            g(y, function(G, F) {
                k[F] = G.children
            })
        }

        function l(F) {
            var E = /^(~)?(.+)$/;
            if (F) {
                g(d(F), function(J) {
                    var H = E.exec(J),
                        I = H[1] === "~",
                        K = I ? "span" : "div",
                        G = H[2];
                    k[G] = k[K];
                    p[G] = K;
                    if (!I) {
                        v[G.toUpperCase()] = {};
                        v[G] = {}
                    }
                    if (!s[G]) {
                        s[G] = s[K]
                    }
                    g(k, function(L, M) {
                        if (L[K]) {
                            L[G] = L[K]
                        }
                    })
                })
            }
        }

        function x(F) {
            var E = /^([+\-]?)(\w+)\[([^\]]+)\]$/;
            if (F) {
                g(d(F), function(J) {
                    var I = E.exec(J),
                        G, H;
                    if (I) {
                        H = I[1];
                        if (H) {
                            G = k[I[2]]
                        } else {
                            G = k[I[2]] = {
                                "#comment": {}
                            }
                        }
                        G = k[I[2]];
                        g(d(I[3], "|"), function(K) {
                            if (H === "-") {
                                delete G[K]
                            } else {
                                G[K] = {}
                            }
                        })
                    }
                })
            }
        }

        function B(E) {
            var G = s[E],
                F;
            if (G) {
                return G
            }
            F = j.length;
            while (F--) {
                G = j[F];
                if (G.pattern.test(E)) {
                    return G
                }
            }
        }
        if (!A.valid_elements) {
            g(y, function(F, E) {
                s[E] = {
                    attributes: F.attributes,
                    attributesOrder: F.attributesOrder
                };
                k[E] = F.children
            });
            if (A.schema != "html5") {
                g(d("strong/b,em/i"), function(E) {
                    E = d(E, "/");
                    s[E[1]].outputName = E[0]
                })
            }
            s.img.attributesDefault = [{
                name: "alt",
                value: ""
            }];
            g(d("ol,ul,sub,sup,blockquote,span,font,a,table,tbody,tr,strong,em,b,i"), function(E) {
                if (s[E]) {
                    s[E].removeEmpty = true
                }
            });
            g(d("p,h1,h2,h3,h4,h5,h6,th,td,pre,div,address,caption"), function(E) {
                s[E].paddEmpty = true
            })
        } else {
            t(A.valid_elements)
        }
        l(A.custom_elements);
        x(A.valid_children);
        C(A.extended_valid_elements);
        x("+ol[ul|ol],+ul[ul|ol]");
        if (A.invalid_elements) {
            f.each(f.explode(A.invalid_elements), function(E) {
                if (s[E]) {
                    delete s[E]
                }
            })
        }
        if (!B("span")) {
            C("span[!data-mce-type|*]")
        }
        u.children = k;
        u.styles = D;
        u.getBoolAttrs = function() {
            return r
        };
        u.getBlockElements = function() {
            return v
        };
        u.getTextBlockElements = function() {
            return textBlockElementsMap
        };
        u.getShortEndedElements = function() {
            return z
        };
        u.getSelfClosingElements = function() {
            return q
        };
        u.getNonEmptyElements = function() {
            return n
        };
        u.getWhiteSpaceElements = function() {
            return o
        };
        u.isValidChild = function(E, G) {
            var F = k[E];
            return !!(F && F[G])
        };
        u.isValid = function(F, E) {
            var H, G, I = B(F);
            if (I) {
                if (E) {
                    if (I.attributes[E]) {
                        return true
                    }
                    H = I.attributePatterns;
                    if (H) {
                        G = H.length;
                        while (G--) {
                            if (H[G].pattern.test(F)) {
                                return true
                            }
                        }
                    }
                } else {
                    return true
                }
            }
            return false
        };
        u.getElementRule = B;
        u.getCustomElements = function() {
            return p
        };
        u.addValidElements = C;
        u.setValidElements = t;
        u.addCustomElements = l;
        u.addValidChildren = x;
        u.elements = s
    }
})(tinymce);
(function(a) {
    a.html.SaxParser = function(c, e) {
        var b = this,
            d = function() {};
        c = c || {};
        b.schema = e = e || new a.html.Schema();
        if (c.fix_self_closing !== false) {
            c.fix_self_closing = true
        }
        a.each("comment cdata text start end pi doctype".split(" "), function(f) {
            if (f) {
                b[f] = c[f] || d
            }
        });
        b.parse = function(E) {
            var n = this,
                g, G = 0,
                I, B, A = [],
                N, Q, C, r, z, s, M, H, O, v, m, k, t, R, o, P, F, S, L, f, J, l, D, K, h, x = 0,
                j = a.html.Entities.decode,
                y, q;

            function u(T) {
                var V, U;
                V = A.length;
                while (V--) {
                    if (A[V].name === T) {
                        break
                    }
                }
                if (V >= 0) {
                    for (U = A.length - 1; U >= V; U--) {
                        T = A[U];
                        if (T.valid) {
                            n.end(T.name)
                        }
                    }
                    A.length = V
                }
            }

            function p(U, T, Y, X, W) {
                var Z, V;
                T = T.toLowerCase();
                Y = T in H ? T : j(Y || X || W || "");
                if (v && !z && T.indexOf("data-") !== 0) {
                    Z = P[T];
                    if (!Z && F) {
                        V = F.length;
                        while (V--) {
                            Z = F[V];
                            if (Z.pattern.test(T)) {
                                break
                            }
                        }
                        if (V === -1) {
                            Z = null
                        }
                    }
                    if (!Z) {
                        return
                    }
                    if (Z.validValues && !(Y in Z.validValues)) {
                        return
                    }
                }
                N.map[T] = Y;
                N.push({
                    name: T,
                    value: Y
                })
            }
            l = new RegExp("<(?:(?:!--([\\w\\W]*?)-->)|(?:!\\[CDATA\\[([\\w\\W]*?)\\]\\]>)|(?:!DOCTYPE([\\w\\W]*?)>)|(?:\\?([^\\s\\/<>]+) ?([\\w\\W]*?)[?/]>)|(?:\\/([^>]+)>)|(?:([A-Za-z0-9\\-\\:\\.]+)((?:\\s+[^\"'>]+(?:(?:\"[^\"]*\")|(?:'[^']*')|[^>]*))*|\\/|\\s+)>))", "g");
            D = /([\w:\-]+)(?:\s*=\s*(?:(?:\"((?:[^\"])*)\")|(?:\'((?:[^\'])*)\')|([^>\s]+)))?/g;
            K = {
                script: /<\/script[^>]*>/gi,
                style: /<\/style[^>]*>/gi,
                noscript: /<\/noscript[^>]*>/gi
            };
            M = e.getShortEndedElements();
            J = c.self_closing_elements || e.getSelfClosingElements();
            H = e.getBoolAttrs();
            v = c.validate;
            s = c.remove_internals;
            y = c.fix_self_closing;
            q = a.isIE;
            o = /^:/;
            while (g = l.exec(E)) {
                if (G < g.index) {
                    n.text(j(E.substr(G, g.index - G)))
                }
                if (I = g[6]) {
                    I = I.toLowerCase();
                    if (q && o.test(I)) {
                        I = I.substr(1)
                    }
                    u(I)
                } else {
                    if (I = g[7]) {
                        I = I.toLowerCase();
                        if (q && o.test(I)) {
                            I = I.substr(1)
                        }
                        O = I in M;
                        if (y && J[I] && A.length > 0 && A[A.length - 1].name === I) {
                            u(I)
                        }
                        if (!v || (m = e.getElementRule(I))) {
                            k = true;
                            if (v) {
                                P = m.attributes;
                                F = m.attributePatterns
                            }
                            if (R = g[8]) {
                                z = R.indexOf("data-mce-type") !== -1;
                                if (z && s) {
                                    k = false
                                }
                                N = [];
                                N.map = {};
                                R.replace(D, p)
                            } else {
                                N = [];
                                N.map = {}
                            }
                            if (v && !z) {
                                S = m.attributesRequired;
                                L = m.attributesDefault;
                                f = m.attributesForced;
                                if (f) {
                                    Q = f.length;
                                    while (Q--) {
                                        t = f[Q];
                                        r = t.name;
                                        h = t.value;
                                        if (h === "{$uid}") {
                                            h = "mce_" + x++
                                        }
                                        N.map[r] = h;
                                        N.push({
                                            name: r,
                                            value: h
                                        })
                                    }
                                }
                                if (L) {
                                    Q = L.length;
                                    while (Q--) {
                                        t = L[Q];
                                        r = t.name;
                                        if (!(r in N.map)) {
                                            h = t.value;
                                            if (h === "{$uid}") {
                                                h = "mce_" + x++
                                            }
                                            N.map[r] = h;
                                            N.push({
                                                name: r,
                                                value: h
                                            })
                                        }
                                    }
                                }
                                if (S) {
                                    Q = S.length;
                                    while (Q--) {
                                        if (S[Q] in N.map) {
                                            break
                                        }
                                    }
                                    if (Q === -1) {
                                        k = false
                                    }
                                }
                                if (N.map["data-mce-bogus"]) {
                                    k = false
                                }
                            }
                            if (k) {
                                n.start(I, N, O)
                            }
                        } else {
                            k = false
                        }
                        if (B = K[I]) {
                            B.lastIndex = G = g.index + g[0].length;
                            if (g = B.exec(E)) {
                                if (k) {
                                    C = E.substr(G, g.index - G)
                                }
                                G = g.index + g[0].length
                            } else {
                                C = E.substr(G);
                                G = E.length
                            }
                            if (k && C.length > 0) {
                                n.text(C, true)
                            }
                            if (k) {
                                n.end(I)
                            }
                            l.lastIndex = G;
                            continue
                        }
                        if (!O) {
                            if (!R || R.indexOf("/") != R.length - 1) {
                                A.push({
                                    name: I,
                                    valid: k
                                })
                            } else {
                                if (k) {
                                    n.end(I)
                                }
                            }
                        }
                    } else {
                        if (I = g[1]) {
                            n.comment(I)
                        } else {
                            if (I = g[2]) {
                                n.cdata(I)
                            } else {
                                if (I = g[3]) {
                                    n.doctype(I)
                                } else {
                                    if (I = g[4]) {
                                        n.pi(I, g[5])
                                    }
                                }
                            }
                        }
                    }
                }
                G = g.index + g[0].length
            }
            if (G < E.length) {
                n.text(j(E.substr(G)))
            }
            for (Q = A.length - 1; Q >= 0; Q--) {
                I = A[Q];
                if (I.valid) {
                    n.end(I.name)
                }
            }
        }
    }
})(tinymce);
(function(d) {
    var c = /^[ \t\r\n]*$/,
        e = {
            "#text": 3,
            "#comment": 8,
            "#cdata": 4,
            "#pi": 7,
            "#doctype": 10,
            "#document-fragment": 11
        };

    function a(k, l, j) {
        var i, h, f = j ? "lastChild" : "firstChild",
            g = j ? "prev" : "next";
        if (k[f]) {
            return k[f]
        }
        if (k !== l) {
            i = k[g];
            if (i) {
                return i
            }
            for (h = k.parent; h && h !== l; h = h.parent) {
                i = h[g];
                if (i) {
                    return i
                }
            }
        }
    }

    function b(f, g) {
        this.name = f;
        this.type = g;
        if (g === 1) {
            this.attributes = [];
            this.attributes.map = {}
        }
    }
    d.extend(b.prototype, {
        replace: function(g) {
            var f = this;
            if (g.parent) {
                g.remove()
            }
            f.insert(g, f);
            f.remove();
            return f
        },
        attr: function(h, l) {
            var f = this,
                g, j, k;
            if (typeof h !== "string") {
                for (j in h) {
                    f.attr(j, h[j])
                }
                return f
            }
            if (g = f.attributes) {
                if (l !== k) {
                    if (l === null) {
                        if (h in g.map) {
                            delete g.map[h];
                            j = g.length;
                            while (j--) {
                                if (g[j].name === h) {
                                    g = g.splice(j, 1);
                                    return f
                                }
                            }
                        }
                        return f
                    }
                    if (h in g.map) {
                        j = g.length;
                        while (j--) {
                            if (g[j].name === h) {
                                g[j].value = l;
                                break
                            }
                        }
                    } else {
                        g.push({
                            name: h,
                            value: l
                        })
                    }
                    g.map[h] = l;
                    return f
                } else {
                    return g.map[h]
                }
            }
        },
        clone: function() {
            var g = this,
                n = new b(g.name, g.type),
                h, f, m, j, k;
            if (m = g.attributes) {
                k = [];
                k.map = {};
                for (h = 0, f = m.length; h < f; h++) {
                    j = m[h];
                    if (j.name !== "id") {
                        k[k.length] = {
                            name: j.name,
                            value: j.value
                        };
                        k.map[j.name] = j.value
                    }
                }
                n.attributes = k
            }
            n.value = g.value;
            n.shortEnded = g.shortEnded;
            return n
        },
        wrap: function(g) {
            var f = this;
            f.parent.insert(g, f);
            g.append(f);
            return f
        },
        unwrap: function() {
            var f = this,
                h, g;
            for (h = f.firstChild; h;) {
                g = h.next;
                f.insert(h, f, true);
                h = g
            }
            f.remove()
        },
        remove: function() {
            var f = this,
                h = f.parent,
                g = f.next,
                i = f.prev;
            if (h) {
                if (h.firstChild === f) {
                    h.firstChild = g;
                    if (g) {
                        g.prev = null
                    }
                } else {
                    i.next = g
                }
                if (h.lastChild === f) {
                    h.lastChild = i;
                    if (i) {
                        i.next = null
                    }
                } else {
                    g.prev = i
                }
                f.parent = f.next = f.prev = null
            }
            return f
        },
        append: function(h) {
            var f = this,
                g;
            if (h.parent) {
                h.remove()
            }
            g = f.lastChild;
            if (g) {
                g.next = h;
                h.prev = g;
                f.lastChild = h
            } else {
                f.lastChild = f.firstChild = h
            }
            h.parent = f;
            return h
        },
        insert: function(h, f, i) {
            var g;
            if (h.parent) {
                h.remove()
            }
            g = f.parent || this;
            if (i) {
                if (f === g.firstChild) {
                    g.firstChild = h
                } else {
                    f.prev.next = h
                }
                h.prev = f.prev;
                h.next = f;
                f.prev = h
            } else {
                if (f === g.lastChild) {
                    g.lastChild = h
                } else {
                    f.next.prev = h
                }
                h.next = f.next;
                h.prev = f;
                f.next = h
            }
            h.parent = g;
            return h
        },
        getAll: function(g) {
            var f = this,
                h, i = [];
            for (h = f.firstChild; h; h = a(h, f)) {
                if (h.name === g) {
                    i.push(h)
                }
            }
            return i
        },
        empty: function() {
            var g = this,
                f, h, j;
            if (g.firstChild) {
                f = [];
                for (j = g.firstChild; j; j = a(j, g)) {
                    f.push(j)
                }
                h = f.length;
                while (h--) {
                    j = f[h];
                    j.parent = j.firstChild = j.lastChild = j.next = j.prev = null
                }
            }
            g.firstChild = g.lastChild = null;
            return g
        },
        isEmpty: function(k) {
            var f = this,
                j = f.firstChild,
                h, g;
            if (j) {
                do {
                    if (j.type === 1) {
                        if (j.attributes.map["data-mce-bogus"]) {
                            continue
                        }
                        if (k[j.name]) {
                            return false
                        }
                        h = j.attributes.length;
                        while (h--) {
                            g = j.attributes[h].name;
                            if (g === "name" || g.indexOf("data-mce-") === 0) {
                                return false
                            }
                        }
                    }
                    if (j.type === 8) {
                        return false
                    }
                    if ((j.type === 3 && !c.test(j.value))) {
                        return false
                    }
                } while (j = a(j, f))
            }
            return true
        },
        walk: function(f) {
            return a(this, null, f)
        }
    });
    d.extend(b, {
        create: function(g, f) {
            var i, h;
            i = new b(g, e[g] || 1);
            if (f) {
                for (h in f) {
                    i.attr(h, f[h])
                }
            }
            return i
        }
    });
    d.html.Node = b
})(tinymce);
(function(b) {
    var a = b.html.Node;
    b.html.DomParser = function(g, h) {
        var f = this,
            e = {},
            d = [],
            i = {},
            c = {};
        g = g || {};
        g.validate = "validate" in g ? g.validate : true;
        g.root_name = g.root_name || "body";
        f.schema = h = h || new b.html.Schema();

        function j(n) {
            var p, q, y, x, A, o, r, l, u, v, k, t, m, z, s;
            t = b.makeMap("tr,td,th,tbody,thead,tfoot,table");
            k = h.getNonEmptyElements();
            m = h.getTextBlockElements();
            for (p = 0; p < n.length; p++) {
                q = n[p];
                if (!q.parent || q.fixed) {
                    continue
                }
                if (m[q.name] && q.parent.name == "li") {
                    z = q.next;
                    while (z) {
                        if (m[z.name]) {
                            z.name = "li";
                            z.fixed = true;
                            q.parent.insert(z, q.parent)
                        } else {
                            break
                        }
                        z = z.next
                    }
                    q.unwrap(q);
                    continue
                }
                x = [q];
                for (y = q.parent; y && !h.isValidChild(y.name, q.name) && !t[y.name]; y = y.parent) {
                    x.push(y)
                }
                if (y && x.length > 1) {
                    x.reverse();
                    A = o = f.filterNode(x[0].clone());
                    for (u = 0; u < x.length - 1; u++) {
                        if (h.isValidChild(o.name, x[u].name)) {
                            r = f.filterNode(x[u].clone());
                            o.append(r)
                        } else {
                            r = o
                        }
                        for (l = x[u].firstChild; l && l != x[u + 1];) {
                            s = l.next;
                            r.append(l);
                            l = s
                        }
                        o = r
                    }
                    if (!A.isEmpty(k)) {
                        y.insert(A, x[0], true);
                        y.insert(q, A)
                    } else {
                        y.insert(q, x[0], true)
                    }
                    y = x[0];
                    if (y.isEmpty(k) || y.firstChild === y.lastChild && y.firstChild.name === "br") {
                        y.empty().remove()
                    }
                } else {
                    if (q.parent) {
                        if (q.name === "li") {
                            z = q.prev;
                            if (z && (z.name === "ul" || z.name === "ul")) {
                                z.append(q);
                                continue
                            }
                            z = q.next;
                            if (z && (z.name === "ul" || z.name === "ul")) {
                                z.insert(q, z.firstChild, true);
                                continue
                            }
                            q.wrap(f.filterNode(new a("ul", 1)));
                            continue
                        }
                        if (h.isValidChild(q.parent.name, "div") && h.isValidChild("div", q.name)) {
                            q.wrap(f.filterNode(new a("div", 1)))
                        } else {
                            if (q.name === "style" || q.name === "script") {
                                q.empty().remove()
                            } else {
                                q.unwrap()
                            }
                        }
                    }
                }
            }
        }
        f.filterNode = function(m) {
            var l, k, n;
            if (k in e) {
                n = i[k];
                if (n) {
                    n.push(m)
                } else {
                    i[k] = [m]
                }
            }
            l = d.length;
            while (l--) {
                k = d[l].name;
                if (k in m.attributes.map) {
                    n = c[k];
                    if (n) {
                        n.push(m)
                    } else {
                        c[k] = [m]
                    }
                }
            }
            return m
        };
        f.addNodeFilter = function(k, l) {
            b.each(b.explode(k), function(m) {
                var n = e[m];
                if (!n) {
                    e[m] = n = []
                }
                n.push(l)
            })
        };
        f.addAttributeFilter = function(k, l) {
            b.each(b.explode(k), function(m) {
                var n;
                for (n = 0; n < d.length; n++) {
                    if (d[n].name === m) {
                        d[n].callbacks.push(l);
                        return
                    }
                }
                d.push({
                    name: m,
                    callbacks: [l]
                })
            })
        };
        f.parse = function(v, m) {
            var n, J, B, A, D, C, x, r, F, N, z, o, E, M = [],
                L, t, k, y, s, p, u, q;
            m = m || {};
            i = {};
            c = {};
            o = b.extend(b.makeMap("script,style,head,html,body,title,meta,param"), h.getBlockElements());
            u = h.getNonEmptyElements();
            p = h.children;
            z = g.validate;
            q = "forced_root_block" in m ? m.forced_root_block : g.forced_root_block;
            s = h.getWhiteSpaceElements();
            E = /^[ \t\r\n]+/;
            t = /[ \t\r\n]+$/;
            k = /[ \t\r\n]+/g;
            y = /^[ \t\r\n]+$/;

            function G() {
                var O = J.firstChild,
                    l, P;
                while (O) {
                    l = O.next;
                    if (O.type == 3 || (O.type == 1 && O.name !== "p" && !o[O.name] && !O.attr("data-mce-type"))) {
                        if (!P) {
                            P = K(q, 1);
                            J.insert(P, O);
                            P.append(O)
                        } else {
                            P.append(O)
                        }
                    } else {
                        P = null
                    }
                    O = l
                }
            }

            function K(l, O) {
                var P = new a(l, O),
                    Q;
                if (l in e) {
                    Q = i[l];
                    if (Q) {
                        Q.push(P)
                    } else {
                        i[l] = [P]
                    }
                }
                return P
            }

            function I(P) {
                var Q, l, O;
                for (Q = P.prev; Q && Q.type === 3;) {
                    l = Q.value.replace(t, "");
                    if (l.length > 0) {
                        Q.value = l;
                        Q = Q.prev
                    } else {
                        O = Q.prev;
                        Q.remove();
                        Q = O
                    }
                }
            }

            function H(O) {
                var P, l = {};
                for (P in O) {
                    if (P !== "li" && P != "p") {
                        l[P] = O[P]
                    }
                }
                return l
            }
            n = new b.html.SaxParser({
                validate: z,
                self_closing_elements: H(h.getSelfClosingElements()),
                cdata: function(l) {
                    B.append(K("#cdata", 4)).value = l
                },
                text: function(P, l) {
                    var O;
                    if (!L) {
                        P = P.replace(k, " ");
                        if (B.lastChild && o[B.lastChild.name]) {
                            P = P.replace(E, "")
                        }
                    }
                    if (P.length !== 0) {
                        O = K("#text", 3);
                        O.raw = !!l;
                        B.append(O).value = P
                    }
                },
                comment: function(l) {
                    B.append(K("#comment", 8)).value = l
                },
                pi: function(l, O) {
                    B.append(K(l, 7)).value = O;
                    I(B)
                },
                doctype: function(O) {
                    var l;
                    l = B.append(K("#doctype", 10));
                    l.value = O;
                    I(B)
                },
                start: function(l, W, P) {
                    var U, R, Q, O, S, X, V, T;
                    Q = z ? h.getElementRule(l) : {};
                    if (Q) {
                        U = K(Q.outputName || l, 1);
                        U.attributes = W;
                        U.shortEnded = P;
                        B.append(U);
                        T = p[B.name];
                        if (T && p[U.name] && !T[U.name]) {
                            M.push(U)
                        }
                        R = d.length;
                        while (R--) {
                            S = d[R].name;
                            if (S in W.map) {
                                F = c[S];
                                if (F) {
                                    F.push(U)
                                } else {
                                    c[S] = [U]
                                }
                            }
                        }
                        if (o[l]) {
                            I(U)
                        }
                        if (!P) {
                            B = U
                        }
                        if (!L && s[l]) {
                            L = true
                        }
                    }
                },
                end: function(l) {
                    var S, P, R, O, Q;
                    P = z ? h.getElementRule(l) : {};
                    if (P) {
                        if (o[l]) {
                            if (!L) {
                                S = B.firstChild;
                                if (S && S.type === 3) {
                                    R = S.value.replace(E, "");
                                    if (R.length > 0) {
                                        S.value = R;
                                        S = S.next
                                    } else {
                                        O = S.next;
                                        S.remove();
                                        S = O
                                    }
                                    while (S && S.type === 3) {
                                        R = S.value;
                                        O = S.next;
                                        if (R.length === 0 || y.test(R)) {
                                            S.remove();
                                            S = O
                                        }
                                        S = O
                                    }
                                }
                                S = B.lastChild;
                                if (S && S.type === 3) {
                                    R = S.value.replace(t, "");
                                    if (R.length > 0) {
                                        S.value = R;
                                        S = S.prev
                                    } else {
                                        O = S.prev;
                                        S.remove();
                                        S = O
                                    }
                                    while (S && S.type === 3) {
                                        R = S.value;
                                        O = S.prev;
                                        if (R.length === 0 || y.test(R)) {
                                            S.remove();
                                            S = O
                                        }
                                        S = O
                                    }
                                }
                            }
                        }
                        if (L && s[l]) {
                            L = false
                        }
                        if (P.removeEmpty || P.paddEmpty) {
                            if (B.isEmpty(u)) {
                                if (P.paddEmpty) {
                                    B.empty().append(new a("#text", "3")).value = "\u00a0"
                                } else {
                                    if (!B.attributes.map.name && !B.attributes.map.id) {
                                        Q = B.parent;
                                        B.empty().remove();
                                        B = Q;
                                        return
                                    }
                                }
                            }
                        }
                        B = B.parent
                    }
                }
            }, h);
            J = B = new a(m.context || g.root_name, 11);
            n.parse(v);
            if (z && M.length) {
                if (!m.context) {
                    j(M)
                } else {
                    m.invalid = true
                }
            }
            if (q && J.name == "body") {
                G()
            }
            if (!m.invalid) {
                for (N in i) {
                    F = e[N];
                    A = i[N];
                    x = A.length;
                    while (x--) {
                        if (!A[x].parent) {
                            A.splice(x, 1)
                        }
                    }
                    for (D = 0, C = F.length; D < C; D++) {
                        F[D](A, N, m)
                    }
                }
                for (D = 0, C = d.length; D < C; D++) {
                    F = d[D];
                    if (F.name in c) {
                        A = c[F.name];
                        x = A.length;
                        while (x--) {
                            if (!A[x].parent) {
                                A.splice(x, 1)
                            }
                        }
                        for (x = 0, r = F.callbacks.length; x < r; x++) {
                            F.callbacks[x](A, F.name, m)
                        }
                    }
                }
            }
            return J
        };
        if (g.remove_trailing_brs) {
            f.addNodeFilter("br", function(n, m) {
                var r, q = n.length,
                    o, v = b.extend({}, h.getBlockElements()),
                    k = h.getNonEmptyElements(),
                    t, s, p, u;
                v.body = 1;
                for (r = 0; r < q; r++) {
                    o = n[r];
                    t = o.parent;
                    if (v[o.parent.name] && o === t.lastChild) {
                        p = o.prev;
                        while (p) {
                            u = p.name;
                            if (u !== "span" || p.attr("data-mce-type") !== "bookmark") {
                                if (u !== "br") {
                                    break
                                }
                                if (u === "br") {
                                    o = null;
                                    break
                                }
                            }
                            p = p.prev
                        }
                        if (o) {
                            o.remove();
                            if (t.isEmpty(k)) {
                                elementRule = h.getElementRule(t.name);
                                if (elementRule) {
                                    if (elementRule.removeEmpty) {
                                        t.remove()
                                    } else {
                                        if (elementRule.paddEmpty) {
                                            t.empty().append(new b.html.Node("#text", 3)).value = "\u00a0"
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        s = o;
                        while (t.firstChild === s && t.lastChild === s) {
                            s = t;
                            if (v[t.name]) {
                                break
                            }
                            t = t.parent
                        }
                        if (s === t) {
                            textNode = new b.html.Node("#text", 3);
                            textNode.value = "\u00a0";
                            o.replace(textNode)
                        }
                    }
                }
            })
        }
        if (!g.allow_html_in_named_anchor) {
            f.addAttributeFilter("id,name", function(k, l) {
                var n = k.length,
                    p, m, o, q;
                while (n--) {
                    q = k[n];
                    if (q.name === "a" && q.firstChild && !q.attr("href")) {
                        o = q.parent;
                        p = q.lastChild;
                        do {
                            m = p.prev;
                            o.insert(p, q);
                            p = m
                        } while (p)
                    }
                }
            })
        }
    }
})(tinymce);
tinymce.html.Writer = function(e) {
    var c = [],
        a, b, d, f, g;
    e = e || {};
    a = e.indent;
    b = tinymce.makeMap(e.indent_before || "");
    d = tinymce.makeMap(e.indent_after || "");
    f = tinymce.html.Entities.getEncodeFunc(e.entity_encoding || "raw", e.entities);
    g = e.element_format == "html";
    return {
        start: function(m, k, p) {
            var n, j, h, o;
            if (a && b[m] && c.length > 0) {
                o = c[c.length - 1];
                if (o.length > 0 && o !== "\n") {
                    c.push("\n")
                }
            }
            c.push("<", m);
            if (k) {
                for (n = 0, j = k.length; n < j; n++) {
                    h = k[n];
                    c.push(" ", h.name, '="', f(h.value, true), '"')
                }
            }
            if (!p || g) {
                c[c.length] = ">"
            } else {
                c[c.length] = " />"
            }
            if (p && a && d[m] && c.length > 0) {
                o = c[c.length - 1];
                if (o.length > 0 && o !== "\n") {
                    c.push("\n")
                }
            }
        },
        end: function(h) {
            var i;
            c.push("</", h, ">");
            if (a && d[h] && c.length > 0) {
                i = c[c.length - 1];
                if (i.length > 0 && i !== "\n") {
                    c.push("\n")
                }
            }
        },
        text: function(i, h) {
            if (i.length > 0) {
                c[c.length] = h ? i : f(i)
            }
        },
        cdata: function(h) {
            c.push("<![CDATA[", h, "]]>")
        },
        comment: function(h) {
            c.push("<!--", h, "-->")
        },
        pi: function(h, i) {
            if (i) {
                c.push("<?", h, " ", i, "?>")
            } else {
                c.push("<?", h, "?>")
            }
            if (a) {
                c.push("\n")
            }
        },
        doctype: function(h) {
            c.push("<!DOCTYPE", h, ">", a ? "\n" : "")
        },
        reset: function() {
            c.length = 0
        },
        getContent: function() {
            return c.join("").replace(/\n$/, "")
        }
    }
};
(function(a) {
    a.html.Serializer = function(c, d) {
        var b = this,
            e = new a.html.Writer(c);
        c = c || {};
        c.validate = "validate" in c ? c.validate : true;
        b.schema = d = d || new a.html.Schema();
        b.writer = e;
        b.serialize = function(h) {
            var g, i;
            i = c.validate;
            g = {
                3: function(k, j) {
                    e.text(k.value, k.raw)
                },
                8: function(j) {
                    e.comment(j.value)
                },
                7: function(j) {
                    e.pi(j.name, j.value)
                },
                10: function(j) {
                    e.doctype(j.value)
                },
                4: function(j) {
                    e.cdata(j.value)
                },
                11: function(j) {
                    if ((j = j.firstChild)) {
                        do {
                            f(j)
                        } while (j = j.next)
                    }
                }
            };
            e.reset();

            function f(k) {
                var t = g[k.type],
                    j, o, s, r, p, u, n, m, q;
                if (!t) {
                    j = k.name;
                    o = k.shortEnded;
                    s = k.attributes;
                    if (i && s && s.length > 1) {
                        u = [];
                        u.map = {};
                        q = d.getElementRule(k.name);
                        for (n = 0, m = q.attributesOrder.length; n < m; n++) {
                            r = q.attributesOrder[n];
                            if (r in s.map) {
                                p = s.map[r];
                                u.map[r] = p;
                                u.push({
                                    name: r,
                                    value: p
                                })
                            }
                        }
                        for (n = 0, m = s.length; n < m; n++) {
                            r = s[n].name;
                            if (!(r in u.map)) {
                                p = s.map[r];
                                u.map[r] = p;
                                u.push({
                                    name: r,
                                    value: p
                                })
                            }
                        }
                        s = u
                    }
                    e.start(k.name, s, o);
                    if (!o) {
                        if ((k = k.firstChild)) {
                            do {
                                f(k)
                            } while (k = k.next)
                        }
                        e.end(j)
                    }
                } else {
                    t(k)
                }
            }
            if (h.type == 1 && !c.inner) {
                f(h)
            } else {
                g[11](h)
            }
            return e.getContent()
        }
    }
})(tinymce);
tinymce.dom = {};
(function(b, h) {
    var g = !!document.addEventListener;

    function c(k, j, l, i) {
        if (k.addEventListener) {
            k.addEventListener(j, l, i || false)
        } else {
            if (k.attachEvent) {
                k.attachEvent("on" + j, l)
            }
        }
    }

    function e(k, j, l, i) {
        if (k.removeEventListener) {
            k.removeEventListener(j, l, i || false)
        } else {
            if (k.detachEvent) {
                k.detachEvent("on" + j, l)
            }
        }
    }

    function a(n, l) {
        var i, k = l || {};

        function j() {
            return false
        }

        function m() {
            return true
        }
        for (i in n) {
            if (i !== "layerX" && i !== "layerY") {
                k[i] = n[i]
            }
        }
        if (!k.target) {
            k.target = k.srcElement || document
        }
        k.preventDefault = function() {
            k.isDefaultPrevented = m;
            if (n) {
                if (n.preventDefault) {
                    n.preventDefault()
                } else {
                    n.returnValue = false
                }
            }
        };
        k.stopPropagation = function() {
            k.isPropagationStopped = m;
            if (n) {
                if (n.stopPropagation) {
                    n.stopPropagation()
                } else {
                    n.cancelBubble = true
                }
            }
        };
        k.stopImmediatePropagation = function() {
            k.isImmediatePropagationStopped = m;
            k.stopPropagation()
        };
        if (!k.isDefaultPrevented) {
            k.isDefaultPrevented = j;
            k.isPropagationStopped = j;
            k.isImmediatePropagationStopped = j
        }
        return k
    }

    function d(m, n, l) {
        var k = m.document,
            j = {
                type: "ready"
            };

        function i() {
            if (!l.domLoaded) {
                l.domLoaded = true;
                n(j)
            }
        }
        if (k.readyState == "complete") {
            i();
            return
        }
        if (g) {
            c(m, "DOMContentLoaded", i)
        } else {
            c(k, "readystatechange", function() {
                if (k.readyState === "complete") {
                    e(k, "readystatechange", arguments.callee);
                    i()
                }
            });
            if (k.documentElement.doScroll && m === m.top) {
                (function() {
                    try {
                        k.documentElement.doScroll("left")
                    } catch (o) {
                        setTimeout(arguments.callee, 0);
                        return
                    }
                    i()
                })()
            }
        }
        c(m, "load", i)
    }

    function f(k) {
        var q = this,
            p = {},
            i, o, n, m, l;
        m = "onmouseenter" in document.documentElement;
        n = "onfocusin" in document.documentElement;
        l = {
            mouseenter: "mouseover",
            mouseleave: "mouseout"
        };
        i = 1;
        q.domLoaded = false;
        q.events = p;

        function j(t, x) {
            var s, u, r, v;
            s = p[x][t.type];
            if (s) {
                for (u = 0, r = s.length; u < r; u++) {
                    v = s[u];
                    if (v && v.func.call(v.scope, t) === false) {
                        t.preventDefault()
                    }
                    if (t.isImmediatePropagationStopped()) {
                        return
                    }
                }
            }
        }
        q.bind = function(x, A, D, E) {
            var s, t, u, r, B, z, C, v = window;

            function y(F) {
                j(a(F || v.event), s)
            }
            if (!x || x.nodeType === 3 || x.nodeType === 8) {
                return
            }
            if (!x[h]) {
                s = i++;
                x[h] = s;
                p[s] = {}
            } else {
                s = x[h];
                if (!p[s]) {
                    p[s] = {}
                }
            }
            E = E || x;
            A = A.split(" ");
            u = A.length;
            while (u--) {
                r = A[u];
                z = y;
                B = C = false;
                if (r === "DOMContentLoaded") {
                    r = "ready"
                }
                if ((q.domLoaded || x.readyState == "complete") && r === "ready") {
                    q.domLoaded = true;
                    D.call(E, a({
                        type: r
                    }));
                    continue
                }
                if (!m) {
                    B = l[r];
                    if (B) {
                        z = function(F) {
                            var H, G;
                            H = F.currentTarget;
                            G = F.relatedTarget;
                            if (G && H.contains) {
                                G = H.contains(G)
                            } else {
                                while (G && G !== H) {
                                    G = G.parentNode
                                }
                            }
                            if (!G) {
                                F = a(F || v.event);
                                F.type = F.type === "mouseout" ? "mouseleave" : "mouseenter";
                                F.target = H;
                                j(F, s)
                            }
                        }
                    }
                }
                if (!n && (r === "focusin" || r === "focusout")) {
                    C = true;
                    B = r === "focusin" ? "focus" : "blur";
                    z = function(F) {
                        F = a(F || v.event);
                        F.type = F.type === "focus" ? "focusin" : "focusout";
                        j(F, s)
                    }
                }
                t = p[s][r];
                if (!t) {
                    p[s][r] = t = [{
                        func: D,
                        scope: E
                    }];
                    t.fakeName = B;
                    t.capture = C;
                    t.nativeHandler = z;
                    if (!g) {
                        t.proxyHandler = k(s)
                    }
                    if (r === "ready") {
                        d(x, z, q)
                    } else {
                        c(x, B || r, g ? z : t.proxyHandler, C)
                    }
                } else {
                    t.push({
                        func: D,
                        scope: E
                    })
                }
            }
            x = t = 0;
            return D
        };
        q.unbind = function(x, z, A) {
            var s, u, v, B, r, t;
            if (!x || x.nodeType === 3 || x.nodeType === 8) {
                return q
            }
            s = x[h];
            if (s) {
                t = p[s];
                if (z) {
                    z = z.split(" ");
                    v = z.length;
                    while (v--) {
                        r = z[v];
                        u = t[r];
                        if (u) {
                            if (A) {
                                B = u.length;
                                while (B--) {
                                    if (u[B].func === A) {
                                        u.splice(B, 1)
                                    }
                                }
                            }
                            if (!A || u.length === 0) {
                                delete t[r];
                                e(x, u.fakeName || r, g ? u.nativeHandler : u.proxyHandler, u.capture)
                            }
                        }
                    }
                } else {
                    for (r in t) {
                        u = t[r];
                        e(x, u.fakeName || r, g ? u.nativeHandler : u.proxyHandler, u.capture)
                    }
                    t = {}
                }
                for (r in t) {
                    return q
                }
                delete p[s];
                try {
                    delete x[h]
                } catch (y) {
                    x[h] = null
                }
            }
            return q
        };
        q.fire = function(u, s, r) {
            var v, t;
            if (!u || u.nodeType === 3 || u.nodeType === 8) {
                return q
            }
            t = a(null, r);
            t.type = s;
            do {
                v = u[h];
                if (v) {
                    j(t, v)
                }
                u = u.parentNode || u.ownerDocument || u.defaultView || u.parentWindow
            } while (u && !t.isPropagationStopped());
            return q
        };
        q.clean = function(u) {
            var s, r, t = q.unbind;
            if (!u || u.nodeType === 3 || u.nodeType === 8) {
                return q
            }
            if (u[h]) {
                t(u)
            }
            if (!u.getElementsByTagName) {
                u = u.document
            }
            if (u && u.getElementsByTagName) {
                t(u);
                r = u.getElementsByTagName("*");
                s = r.length;
                while (s--) {
                    u = r[s];
                    if (u[h]) {
                        t(u)
                    }
                }
            }
            return q
        };
        q.callNativeHandler = function(s, r) {
            if (p) {
                p[s][r.type].nativeHandler(r)
            }
        };
        q.destory = function() {
            p = {}
        };
        q.add = function(v, s, u, t) {
            if (typeof(v) === "string") {
                v = document.getElementById(v)
            }
            if (v && v instanceof Array) {
                var r = v.length;
                while (r--) {
                    q.add(v[r], s, u, t)
                }
                return
            }
            if (s === "init") {
                s = "ready"
            }
            return q.bind(v, s instanceof Array ? s.join(" ") : s, u, t)
        };
        q.remove = function(v, s, u, t) {
            if (!v) {
                return q
            }
            if (typeof(v) === "string") {
                v = document.getElementById(v)
            }
            if (v instanceof Array) {
                var r = v.length;
                while (r--) {
                    q.remove(v[r], s, u, t)
                }
                return q
            }
            return q.unbind(v, s instanceof Array ? s.join(" ") : s, u)
        };
        q.clear = function(r) {
            if (typeof(r) === "string") {
                r = document.getElementById(r)
            }
            return q.clean(r)
        };
        q.cancel = function(r) {
            if (r) {
                q.prevent(r);
                q.stop(r)
            }
            return false
        };
        q.prevent = function(r) {
            if (!r.preventDefault) {
                r = a(r)
            }
            r.preventDefault();
            return false
        };
        q.stop = function(r) {
            if (!r.stopPropagation) {
                r = a(r)
            }
            r.stopPropagation();
            return false
        }
    }
    b.EventUtils = f;
    b.Event = new f(function(i) {
        return function(j) {
            tinymce.dom.Event.callNativeHandler(i, j)
        }
    });
    b.Event.bind(window, "ready", function() {});
    b = 0
})(tinymce.dom, "data-mce-expando");
tinymce.dom.TreeWalker = function(a, c) {
    var b = a;

    function d(i, f, e, j) {
        var h, g;
        if (i) {
            if (!j && i[f]) {
                return i[f]
            }
            if (i != c) {
                h = i[e];
                if (h) {
                    return h
                }
                for (g = i.parentNode; g && g != c; g = g.parentNode) {
                    h = g[e];
                    if (h) {
                        return h
                    }
                }
            }
        }
    }
    this.current = function() {
        return b
    };
    this.next = function(e) {
        return (b = d(b, "firstChild", "nextSibling", e))
    };
    this.prev = function(e) {
        return (b = d(b, "lastChild", "previousSibling", e))
    }
};
(function(e) {
    var g = e.each,
        d = e.is,
        f = e.isWebKit,
        b = e.isIE,
        h = e.html.Entities,
        c = /^([a-z0-9],?)+$/i,
        a = /^[ \t\r\n]*$/;
    e.create("tinymce.dom.DOMUtils", {
        doc: null,
        root: null,
        files: null,
        pixelStyles: /^(top|left|bottom|right|width|height|borderWidth)$/,
        props: {
            "for": "htmlFor",
            "class": "className",
            className: "className",
            checked: "checked",
            disabled: "disabled",
            maxlength: "maxLength",
            readonly: "readOnly",
            selected: "selected",
            value: "value",
            id: "id",
            name: "name",
            type: "type"
        },
        DOMUtils: function(o, l) {
            var k = this,
                i, j, n;
            k.doc = o;
            k.win = window;
            k.files = {};
            k.cssFlicker = false;
            k.counter = 0;
            k.stdMode = !e.isIE || o.documentMode >= 8;
            k.boxModel = !e.isIE || o.compatMode == "CSS1Compat" || k.stdMode;
            k.hasOuterHTML = "outerHTML" in o.createElement("a");
            k.settings = l = e.extend({
                keep_values: false,
                hex_colors: 1
            }, l);
            k.schema = l.schema;
            k.styles = new e.html.Styles({
                url_converter: l.url_converter,
                url_converter_scope: l.url_converter_scope
            }, l.schema);
            if (e.isIE6) {
                try {
                    o.execCommand("BackgroundImageCache", false, true)
                } catch (m) {
                    k.cssFlicker = true
                }
            }
            k.fixDoc(o);
            k.events = l.ownEvents ? new e.dom.EventUtils(l.proxy) : e.dom.Event;
            e.addUnload(k.destroy, k);
            n = l.schema ? l.schema.getBlockElements() : {};
            k.isBlock = function(q) {
                if (!q) {
                    return false
                }
                var p = q.nodeType;
                if (p) {
                    return !!(p === 1 && n[q.nodeName])
                }
                return !!n[q]
            }
        },
        fixDoc: function(k) {
            var j = this.settings,
                i;
            if (b && j.schema) {
                ("abbr article aside audio canvas details figcaption figure footer header hgroup mark menu meter nav output progress section summary time video").replace(/\w+/g, function(l) {
                    k.createElement(l)
                });
                for (i in j.schema.getCustomElements()) {
                    k.createElement(i)
                }
            }
        },
        clone: function(k, i) {
            var j = this,
                m, l;
            if (!b || k.nodeType !== 1 || i) {
                return k.cloneNode(i)
            }
            l = j.doc;
            if (!i) {
                m = l.createElement(k.nodeName);
                g(j.getAttribs(k), function(n) {
                    j.setAttrib(m, n.nodeName, j.getAttrib(k, n.nodeName))
                });
                return m
            }
            return m.firstChild
        },
        getRoot: function() {
            var i = this,
                j = i.settings;
            return (j && i.get(j.root_element)) || i.doc.body
        },
        getViewPort: function(j) {
            var k, i;
            j = !j ? this.win : j;
            k = j.document;
            i = this.boxModel ? k.documentElement : k.body;
            return {
                x: j.pageXOffset || i.scrollLeft,
                y: j.pageYOffset || i.scrollTop,
                w: j.innerWidth || i.clientWidth,
                h: j.innerHeight || i.clientHeight
            }
        },
        getRect: function(l) {
            var k, i = this,
                j;
            l = i.get(l);
            k = i.getPos(l);
            j = i.getSize(l);
            return {
                x: k.x,
                y: k.y,
                w: j.w,
                h: j.h
            }
        },
        getSize: function(l) {
            var j = this,
                i, k;
            l = j.get(l);
            i = j.getStyle(l, "width");
            k = j.getStyle(l, "height");
            if (i.indexOf("px") === -1) {
                i = 0
            }
            if (k.indexOf("px") === -1) {
                k = 0
            }
            return {
                w: parseInt(i, 10) || l.offsetWidth || l.clientWidth,
                h: parseInt(k, 10) || l.offsetHeight || l.clientHeight
            }
        },
        getParent: function(k, j, i) {
            return this.getParents(k, j, i, false)
        },
        getParents: function(s, m, k, q) {
            var j = this,
                i, l = j.settings,
                p = [];
            s = j.get(s);
            q = q === undefined;
            if (l.strict_root) {
                k = k || j.getRoot()
            }
            if (d(m, "string")) {
                i = m;
                if (m === "*") {
                    m = function(o) {
                        return o.nodeType == 1
                    }
                } else {
                    m = function(o) {
                        return j.is(o, i)
                    }
                }
            }
            while (s) {
                if (s == k || !s.nodeType || s.nodeType === 9) {
                    break
                }
                if (!m || m(s)) {
                    if (q) {
                        p.push(s)
                    } else {
                        return s
                    }
                }
                s = s.parentNode
            }
            return q ? p : null
        },
        get: function(i) {
            var j;
            if (i && this.doc && typeof(i) == "string") {
                j = i;
                i = this.doc.getElementById(i);
                if (i && i.id !== j) {
                    return this.doc.getElementsByName(j)[1]
                }
            }
            return i
        },
        getNext: function(j, i) {
            return this._findSib(j, i, "nextSibling")
        },
        getPrev: function(j, i) {
            return this._findSib(j, i, "previousSibling")
        },
        select: function(k, j) {
            var i = this;
            return e.dom.Sizzle(k, i.get(j) || i.get(i.settings.root_element) || i.doc, [])
        },
        is: function(l, j) {
            var k;
            if (l.length === undefined) {
                if (j === "*") {
                    return l.nodeType == 1
                }
                if (c.test(j)) {
                    j = j.toLowerCase().split(/,/);
                    l = l.nodeName.toLowerCase();
                    for (k = j.length - 1; k >= 0; k--) {
                        if (j[k] == l) {
                            return true
                        }
                    }
                    return false
                }
            }
            return e.dom.Sizzle.matches(j, l.nodeType ? [l] : l).length > 0
        },
        add: function(l, o, i, k, m) {
            var j = this;
            return this.run(l, function(r) {
                var q, n;
                q = d(o, "string") ? j.doc.createElement(o) : o;
                j.setAttribs(q, i);
                if (k) {
                    if (k.nodeType) {
                        q.appendChild(k)
                    } else {
                        j.setHTML(q, k)
                    }
                }
                return !m ? r.appendChild(q) : q
            })
        },
        create: function(k, i, j) {
            return this.add(this.doc.createElement(k), k, i, j, 1)
        },
        createHTML: function(q, i, m) {
            var p = "",
                l = this,
                j;
            p += "<" + q;
            for (j in i) {
                if (i.hasOwnProperty(j)) {
                    p += " " + j + '="' + l.encode(i[j]) + '"'
                }
            }
            if (typeof(m) != "undefined") {
                return p + ">" + m + "</" + q + ">"
            }
            return p + " />"
        },
        remove: function(i, j) {
            return this.run(i, function(l) {
                var m, k = l.parentNode;
                if (!k) {
                    return null
                }
                if (j) {
                    while (m = l.firstChild) {
                        if (!e.isIE || m.nodeType !== 3 || m.nodeValue) {
                            k.insertBefore(m, l)
                        } else {
                            l.removeChild(m)
                        }
                    }
                }
                return k.removeChild(l)
            })
        },
        setStyle: function(l, i, j) {
            var k = this;
            return k.run(l, function(o) {
                var n, m;
                n = o.style;
                i = i.replace(/-(\D)/g, function(q, p) {
                    return p.toUpperCase()
                });
                if (k.pixelStyles.test(i) && (e.is(j, "number") || /^[\-0-9\.]+$/.test(j))) {
                    j += "px"
                }
                switch (i) {
                    case "opacity":
                        if (b) {
                            n.filter = j === "" ? "" : "alpha(opacity=" + (j * 100) + ")";
                            if (!l.currentStyle || !l.currentStyle.hasLayout) {
                                n.display = "inline-block"
                            }
                        }
                        n[i] = n["-moz-opacity"] = n["-khtml-opacity"] = j || "";
                        break;
                    case "float":
                        b ? n.styleFloat = j : n.cssFloat = j;
                        break;
                    default:
                        n[i] = j || ""
                }
                if (k.settings.update_styles) {
                    k.setAttrib(o, "data-mce-style")
                }
            })
        },
        getStyle: function(l, i, k) {
            l = this.get(l);
            if (!l) {
                return
            }
            if (this.doc.defaultView && k) {
                i = i.replace(/[A-Z]/g, function(m) {
                    return "-" + m
                });
                try {
                    return this.doc.defaultView.getComputedStyle(l, null).getPropertyValue(i)
                } catch (j) {
                    return null
                }
            }
            i = i.replace(/-(\D)/g, function(n, m) {
                return m.toUpperCase()
            });
            if (i == "float") {
                i = b ? "styleFloat" : "cssFloat"
            }
            if (l.currentStyle && k) {
                return l.currentStyle[i]
            }
            return l.style ? l.style[i] : undefined
        },
        setStyles: function(l, m) {
            var j = this,
                k = j.settings,
                i;
            i = k.update_styles;
            k.update_styles = 0;
            g(m, function(o, p) {
                j.setStyle(l, p, o)
            });
            k.update_styles = i;
            if (k.update_styles) {
                j.setAttrib(l, k.cssText)
            }
        },
        removeAllAttribs: function(i) {
            return this.run(i, function(l) {
                var k, j = l.attributes;
                for (k = j.length - 1; k >= 0; k--) {
                    l.removeAttributeNode(j.item(k))
                }
            })
        },
        setAttrib: function(k, l, i) {
            var j = this;
            if (!k || !l) {
                return
            }
            if (j.settings.strict) {
                l = l.toLowerCase()
            }
            return this.run(k, function(p) {
                var o = j.settings;
                var m = p.getAttribute(l);
                if (i !== null) {
                    switch (l) {
                        case "style":
                            if (!d(i, "string")) {
                                g(i, function(q, r) {
                                    j.setStyle(p, r, q)
                                });
                                return
                            }
                            if (o.keep_values) {
                                if (i && !j._isRes(i)) {
                                    p.setAttribute("data-mce-style", i, 2)
                                } else {
                                    p.removeAttribute("data-mce-style", 2)
                                }
                            }
                            p.style.cssText = i;
                            break;
                        case "class":
                            p.className = i || "";
                            break;
                        case "src":
                        case "href":
                            if (o.keep_values) {
                                if (o.url_converter) {
                                    i = o.url_converter.call(o.url_converter_scope || j, i, l, p)
                                }
                                j.setAttrib(p, "data-mce-" + l, i, 2)
                            }
                            break;
                        case "shape":
                            p.setAttribute("data-mce-style", i);
                            break
                    }
                }
                if (d(i) && i !== null && i.length !== 0) {
                    p.setAttribute(l, "" + i, 2)
                } else {
                    p.removeAttribute(l, 2)
                }
                if (tinyMCE.activeEditor && m != i) {
                    var n = tinyMCE.activeEditor;
                    n.onSetAttrib.dispatch(n, p, l, i)
                }
            })
        },
        setAttribs: function(j, k) {
            var i = this;
            return this.run(j, function(l) {
                g(k, function(m, o) {
                    i.setAttrib(l, o, m)
                })
            })
        },
        getAttrib: function(m, o, k) {
            var i, j = this,
                l;
            m = j.get(m);
            if (!m || m.nodeType !== 1) {
                return k === l ? false : k
            }
            if (!d(k)) {
                k = ""
            }
            if (/^(src|href|style|coords|shape)$/.test(o)) {
                i = m.getAttribute("data-mce-" + o);
                if (i) {
                    return i
                }
            }
            if (b && j.props[o]) {
                i = m[j.props[o]];
                i = i && i.nodeValue ? i.nodeValue : i
            }
            if (!i) {
                i = m.getAttribute(o, 2)
            }
            if (/^(checked|compact|declare|defer|disabled|ismap|multiple|nohref|noshade|nowrap|readonly|selected)$/.test(o)) {
                if (m[j.props[o]] === true && i === "") {
                    return o
                }
                return i ? o : ""
            }
            if (m.nodeName === "FORM" && m.getAttributeNode(o)) {
                return m.getAttributeNode(o).nodeValue
            }
            if (o === "style") {
                i = i || m.style.cssText;
                if (i) {
                    i = j.serializeStyle(j.parseStyle(i), m.nodeName);
                    if (j.settings.keep_values && !j._isRes(i)) {
                        m.setAttribute("data-mce-style", i)
                    }
                }
            }
            if (f && o === "class" && i) {
                i = i.replace(/(apple|webkit)\-[a-z\-]+/gi, "")
            }
            if (b) {
                switch (o) {
                    case "rowspan":
                    case "colspan":
                        if (i === 1) {
                            i = ""
                        }
                        break;
                    case "size":
                        if (i === "+0" || i === 20 || i === 0) {
                            i = ""
                        }
                        break;
                    case "width":
                    case "height":
                    case "vspace":
                    case "checked":
                    case "disabled":
                    case "readonly":
                        if (i === 0) {
                            i = ""
                        }
                        break;
                    case "hspace":
                        if (i === -1) {
                            i = ""
                        }
                        break;
                    case "maxlength":
                    case "tabindex":
                        if (i === 32768 || i === 2147483647 || i === "32768") {
                            i = ""
                        }
                        break;
                    case "multiple":
                    case "compact":
                    case "noshade":
                    case "nowrap":
                        if (i === 65535) {
                            return o
                        }
                        return k;
                    case "shape":
                        i = i.toLowerCase();
                        break;
                    default:
                        if (o.indexOf("on") === 0 && i) {
                            i = e._replace(/^function\s+\w+\(\)\s+\{\s+(.*)\s+\}$/, "$1", "" + i)
                        }
                }
            }
            return (i !== l && i !== null && i !== "") ? "" + i : k
        },
        getPos: function(q, l) {
            var j = this,
                i = 0,
                p = 0,
                m, o = j.doc,
                k;
            q = j.get(q);
            l = l || o.body;
            if (q) {
                if (q.getBoundingClientRect) {
                    q = q.getBoundingClientRect();
                    m = j.boxModel ? o.documentElement : o.body;
                    i = q.left + (o.documentElement.scrollLeft || o.body.scrollLeft) - m.clientTop;
                    p = q.top + (o.documentElement.scrollTop || o.body.scrollTop) - m.clientLeft;
                    return {
                        x: i,
                        y: p
                    }
                }
                k = q;
                while (k && k != l && k.nodeType) {
                    i += k.offsetLeft || 0;
                    p += k.offsetTop || 0;
                    k = k.offsetParent
                }
                k = q.parentNode;
                while (k && k != l && k.nodeType) {
                    i -= k.scrollLeft || 0;
                    p -= k.scrollTop || 0;
                    k = k.parentNode
                }
            }
            return {
                x: i,
                y: p
            }
        },
        parseStyle: function(i) {
            return this.styles.parse(i)
        },
        serializeStyle: function(j, i) {
            return this.styles.serialize(j, i)
        },
        addStyle: function(j) {
            var k = this.doc,
                i;
            styleElm = k.getElementById("mceDefaultStyles");
            if (!styleElm) {
                styleElm = k.createElement("style"), styleElm.id = "mceDefaultStyles";
                styleElm.type = "text/css";
                i = k.getElementsByTagName("head")[0];
                if (i.firstChild) {
                    i.insertBefore(styleElm, i.firstChild)
                } else {
                    i.appendChild(styleElm)
                }
            }
            if (styleElm.styleSheet) {
                styleElm.styleSheet.cssText += j
            } else {
                styleElm.appendChild(k.createTextNode(j))
            }
        },
        loadCSS: function(i) {
            var k = this,
                l = k.doc,
                j;
            if (!i) {
                i = ""
            }
            j = l.getElementsByTagName("head")[0];
            g(i.split(","), function(m) {
                var n;
                if (k.files[m]) {
                    return
                }
                k.files[m] = true;
                n = k.create("link", {
                    rel: "stylesheet",
                    href: e._addVer(m)
                });
                if (b && l.documentMode && l.recalc) {
                    n.onload = function() {
                        if (l.recalc) {
                            l.recalc()
                        }
                        n.onload = null
                    }
                }
                j.appendChild(n)
            })
        },
        addClass: function(i, j) {
            return this.run(i, function(k) {
                var l;
                if (!j) {
                    return 0
                }
                if (this.hasClass(k, j)) {
                    return k.className
                }
                l = this.removeClass(k, j);
                return k.className = (l != "" ? (l + " ") : "") + j
            })
        },
        removeClass: function(k, l) {
            var i = this,
                j;
            return i.run(k, function(n) {
                var m;
                if (i.hasClass(n, l)) {
                    if (!j) {
                        j = new RegExp("(^|\\s+)" + l + "(\\s+|$)", "g")
                    }
                    m = n.className.replace(j, " ");
                    m = e.trim(m != " " ? m : "");
                    n.className = m;
                    if (!m) {
                        n.removeAttribute("class");
                        n.removeAttribute("className")
                    }
                    return m
                }
                return n.className
            })
        },
        hasClass: function(j, i) {
            j = this.get(j);
            if (!j || !i) {
                return false
            }
            return (" " + j.className + " ").indexOf(" " + i + " ") !== -1
        },
        show: function(i) {
            return this.setStyle(i, "display", "block")
        },
        hide: function(i) {
            return this.setStyle(i, "display", "none")
        },
        isHidden: function(i) {
            i = this.get(i);
            return !i || i.style.display == "none" || this.getStyle(i, "display") == "none"
        },
        uniqueId: function(i) {
            return (!i ? "mce_" : i) + (this.counter++)
        },
        setHTML: function(k, j) {
            var i = this;
            return i.run(k, function(m) {
                if (b) {
                    while (m.firstChild) {
                        m.removeChild(m.firstChild)
                    }
                    try {
                        m.innerHTML = "<br />" + j;
                        m.removeChild(m.firstChild)
                    } catch (l) {
                        var n = i.create("div");
                        n.innerHTML = "<br />" + j;
                        g(e.grep(n.childNodes), function(p, o) {
                            if (o && m.canHaveHTML) {
                                m.appendChild(p)
                            }
                        })
                    }
                } else {
                    m.innerHTML = j
                }
                return j
            })
        },
        getOuterHTML: function(k) {
            var j, i = this;
            k = i.get(k);
            if (!k) {
                return null
            }
            if (k.nodeType === 1 && i.hasOuterHTML) {
                return k.outerHTML
            }
            j = (k.ownerDocument || i.doc).createElement("body");
            j.appendChild(k.cloneNode(true));
            return j.innerHTML
        },
        setOuterHTML: function(l, j, m) {
            var i = this;

            function k(p, o, r) {
                var s, q;
                q = r.createElement("body");
                q.innerHTML = o;
                s = q.lastChild;
                while (s) {
                    i.insertAfter(s.cloneNode(true), p);
                    s = s.previousSibling
                }
                i.remove(p)
            }
            return this.run(l, function(o) {
                o = i.get(o);
                if (o.nodeType == 1) {
                    m = m || o.ownerDocument || i.doc;
                    if (b) {
                        try {
                            if (b && o.nodeType == 1) {
                                o.outerHTML = j
                            } else {
                                k(o, j, m)
                            }
                        } catch (n) {
                            k(o, j, m)
                        }
                    } else {
                        k(o, j, m)
                    }
                }
            })
        },
        decode: h.decode,
        encode: h.encodeAllRaw,
        insertAfter: function(i, j) {
            j = this.get(j);
            return this.run(i, function(l) {
                var k, m;
                k = j.parentNode;
                m = j.nextSibling;
                if (m) {
                    k.insertBefore(l, m)
                } else {
                    k.appendChild(l)
                }
                return l
            })
        },
        replace: function(m, l, i) {
            var j = this;
            if (d(l, "array")) {
                m = m.cloneNode(true)
            }
            return j.run(l, function(k) {
                if (i) {
                    g(e.grep(k.childNodes), function(n) {
                        m.appendChild(n)
                    })
                }
                return k.parentNode.replaceChild(m, k)
            })
        },
        rename: function(l, i) {
            var k = this,
                j;
            if (l.nodeName != i.toUpperCase()) {
                j = k.create(i);
                g(k.getAttribs(l), function(m) {
                    k.setAttrib(j, m.nodeName, k.getAttrib(l, m.nodeName))
                });
                k.replace(j, l, 1)
            }
            return j || l
        },
        findCommonAncestor: function(k, i) {
            var l = k,
                j;
            while (l) {
                j = i;
                while (j && l != j) {
                    j = j.parentNode
                }
                if (l == j) {
                    break
                }
                l = l.parentNode
            }
            if (!l && k.ownerDocument) {
                return k.ownerDocument.documentElement
            }
            return l
        },
        toHex: function(i) {
            var k = /^\s*rgb\s*?\(\s*?([0-9]+)\s*?,\s*?([0-9]+)\s*?,\s*?([0-9]+)\s*?\)\s*$/i.exec(i);

            function j(l) {
                l = parseInt(l, 10).toString(16);
                return l.length > 1 ? l : "0" + l
            }
            if (k) {
                i = "#" + j(k[1]) + j(k[2]) + j(k[3]);
                return i
            }
            return i
        },
        getClasses: function() {
            var n = this,
                j = [],
                m, o = {},
                p = n.settings.class_filter,
                l;
            if (n.classes) {
                return n.classes
            }

            function q(i) {
                g(i.imports, function(s) {
                    q(s)
                });
                g(i.cssRules || i.rules, function(s) {
                    switch (s.type || 1) {
                        case 1:
                            if (s.selectorText) {
                                g(s.selectorText.split(","), function(r) {
                                    r = r.replace(/^\s*|\s*$|^\s\./g, "");
                                    if (/\.mce/.test(r) || !/\.[\w\-]+$/.test(r)) {
                                        return
                                    }
                                    l = r;
                                    r = e._replace(/.*\.([a-z0-9_\-]+).*/i, "$1", r);
                                    if (p && !(r = p(r, l))) {
                                        return
                                    }
                                    if (!o[r]) {
                                        j.push({
                                            "class": r
                                        });
                                        o[r] = 1
                                    }
                                })
                            }
                            break;
                        case 3:
                            q(s.styleSheet);
                            break
                    }
                })
            }
            try {
                g(n.doc.styleSheets, q)
            } catch (k) {}
            if (j.length > 0) {
                n.classes = j
            }
            return j
        },
        run: function(l, k, j) {
            var i = this,
                m;
            if (i.doc && typeof(l) === "string") {
                l = i.get(l)
            }
            if (!l) {
                return false
            }
            j = j || this;
            if (!l.nodeType && (l.length || l.length === 0)) {
                m = [];
                g(l, function(o, n) {
                    if (o) {
                        if (typeof(o) == "string") {
                            o = i.doc.getElementById(o)
                        }
                        m.push(k.call(j, o, n))
                    }
                });
                return m
            }
            return k.call(j, l)
        },
        getAttribs: function(j) {
            var i;
            j = this.get(j);
            if (!j) {
                return []
            }
            if (b) {
                i = [];
                if (j.nodeName == "OBJECT") {
                    return j.attributes
                }
                if (j.nodeName === "OPTION" && this.getAttrib(j, "selected")) {
                    i.push({
                        specified: 1,
                        nodeName: "selected"
                    })
                }
                j.cloneNode(false).outerHTML.replace(/<\/?[\w:\-]+ ?|=[\"][^\"]+\"|=\'[^\']+\'|=[\w\-]+|>/gi, "").replace(/[\w:\-]+/gi, function(k) {
                    i.push({
                        specified: 1,
                        nodeName: k
                    })
                });
                return i
            }
            return j.attributes
        },
        isEmpty: function(m, k) {
            var r = this,
                o, n, q, j, l, p = 0;
            m = m.firstChild;
            if (m) {
                j = new e.dom.TreeWalker(m, m.parentNode);
                k = k || r.schema ? r.schema.getNonEmptyElements() : null;
                do {
                    q = m.nodeType;
                    if (q === 1) {
                        if (m.getAttribute("data-mce-bogus")) {
                            continue
                        }
                        l = m.nodeName.toLowerCase();
                        if (k && k[l]) {
                            if (l === "br") {
                                p++;
                                continue
                            }
                            return false
                        }
                        n = r.getAttribs(m);
                        o = m.attributes.length;
                        while (o--) {
                            l = m.attributes[o].nodeName;
                            if (l === "name" || l === "data-mce-bookmark") {
                                return false
                            }
                        }
                    }
                    if (q == 8) {
                        return false
                    }
                    if ((q === 3 && !a.test(m.nodeValue))) {
                        return false
                    }
                } while (m = j.next())
            }
            return p <= 1
        },
        destroy: function(j) {
            var i = this;
            i.win = i.doc = i.root = i.events = i.frag = null;
            if (!j) {
                e.removeUnload(i.destroy)
            }
        },
        createRng: function() {
            var i = this.doc;
            return i.createRange ? i.createRange() : new e.dom.Range(this)
        },
        nodeIndex: function(m, n) {
            var i = 0,
                k, l, j;
            if (m) {
                for (k = m.nodeType, m = m.previousSibling, l = m; m; m = m.previousSibling) {
                    j = m.nodeType;
                    if (n && j == 3) {
                        if (j == k || !m.nodeValue.length) {
                            continue
                        }
                    }
                    i++;
                    k = j
                }
            }
            return i
        },
        split: function(m, l, p) {
            var q = this,
                i = q.createRng(),
                n, k, o;

            function j(v) {
                var t, s = v.childNodes,
                    u = v.nodeType;

                function x(A) {
                    var z = A.previousSibling && A.previousSibling.nodeName == "SPAN";
                    var y = A.nextSibling && A.nextSibling.nodeName == "SPAN";
                    return z && y
                }
                if (u == 1 && v.getAttribute("data-mce-type") == "bookmark") {
                    return
                }
                for (t = s.length - 1; t >= 0; t--) {
                    j(s[t])
                }
                if (u != 9) {
                    if (u == 3 && v.nodeValue.length > 0) {
                        var r = e.trim(v.nodeValue).length;
                        if (!q.isBlock(v.parentNode) || r > 0 || r === 0 && x(v)) {
                            return
                        }
                    } else {
                        if (u == 1) {
                            s = v.childNodes;
                            if (s.length == 1 && s[0] && s[0].nodeType == 1 && s[0].getAttribute("data-mce-type") == "bookmark") {
                                v.parentNode.insertBefore(s[0], v)
                            }
                            if (s.length || /^(br|hr|input|img)$/i.test(v.nodeName)) {
                                return
                            }
                        }
                    }
                    q.remove(v)
                }
                return v
            }
            if (m && l) {
                i.setStart(m.parentNode, q.nodeIndex(m));
                i.setEnd(l.parentNode, q.nodeIndex(l));
                n = i.extractContents();
                i = q.createRng();
                i.setStart(l.parentNode, q.nodeIndex(l) + 1);
                i.setEnd(m.parentNode, q.nodeIndex(m) + 1);
                k = i.extractContents();
                o = m.parentNode;
                o.insertBefore(j(n), m);
                if (p) {
                    o.replaceChild(p, l)
                } else {
                    o.insertBefore(l, m)
                }
                o.insertBefore(j(k), m);
                q.remove(m);
                return p || l
            }
        },
        bind: function(l, i, k, j) {
            return this.events.add(l, i, k, j || this)
        },
        unbind: function(k, i, j) {
            return this.events.remove(k, i, j)
        },
        fire: function(k, j, i) {
            return this.events.fire(k, j, i)
        },
        getContentEditable: function(j) {
            var i;
            if (j.nodeType != 1) {
                return null
            }
            i = j.getAttribute("data-mce-contenteditable");
            if (i && i !== "inherit") {
                return i
            }
            return j.contentEditable !== "inherit" ? j.contentEditable : null
        },
        _findSib: function(l, i, j) {
            var k = this,
                m = i;
            if (l) {
                if (d(m, "string")) {
                    m = function(n) {
                        return k.is(n, i)
                    }
                }
                for (l = l[j]; l; l = l[j]) {
                    if (m(l)) {
                        return l
                    }
                }
            }
            return null
        },
        _isRes: function(i) {
            return /^(top|left|bottom|right|width|height)/i.test(i) || /;\s*(top|left|bottom|right|width|height)/i.test(i)
        }
    });
    e.DOM = new e.dom.DOMUtils(document, {
        process_html: 0
    })
})(tinymce);
(function(a) {
    function b(c) {
        var O = this,
            e = c.doc,
            U = 0,
            F = 1,
            j = 2,
            E = true,
            S = false,
            W = "startOffset",
            h = "startContainer",
            Q = "endContainer",
            A = "endOffset",
            k = tinymce.extend,
            n = c.nodeIndex;
        k(O, {
            startContainer: e,
            startOffset: 0,
            endContainer: e,
            endOffset: 0,
            collapsed: E,
            commonAncestorContainer: e,
            START_TO_START: 0,
            START_TO_END: 1,
            END_TO_END: 2,
            END_TO_START: 3,
            setStart: q,
            setEnd: s,
            setStartBefore: g,
            setStartAfter: J,
            setEndBefore: K,
            setEndAfter: u,
            collapse: B,
            selectNode: y,
            selectNodeContents: G,
            compareBoundaryPoints: v,
            deleteContents: p,
            extractContents: I,
            cloneContents: d,
            insertNode: D,
            surroundContents: N,
            cloneRange: L,
            toStringIE: T
        });

        function x() {
            return e.createDocumentFragment()
        }

        function q(X, t) {
            C(E, X, t)
        }

        function s(X, t) {
            C(S, X, t)
        }

        function g(t) {
            q(t.parentNode, n(t))
        }

        function J(t) {
            q(t.parentNode, n(t) + 1)
        }

        function K(t) {
            s(t.parentNode, n(t))
        }

        function u(t) {
            s(t.parentNode, n(t) + 1)
        }

        function B(t) {
            if (t) {
                O[Q] = O[h];
                O[A] = O[W]
            } else {
                O[h] = O[Q];
                O[W] = O[A]
            }
            O.collapsed = E
        }

        function y(t) {
            g(t);
            u(t)
        }

        function G(t) {
            q(t, 0);
            s(t, t.nodeType === 1 ? t.childNodes.length : t.nodeValue.length)
        }

        function v(aa, t) {
            var ad = O[h],
                Y = O[W],
                ac = O[Q],
                X = O[A],
                ab = t.startContainer,
                af = t.startOffset,
                Z = t.endContainer,
                ae = t.endOffset;
            if (aa === 0) {
                return H(ad, Y, ab, af)
            }
            if (aa === 1) {
                return H(ac, X, ab, af)
            }
            if (aa === 2) {
                return H(ac, X, Z, ae)
            }
            if (aa === 3) {
                return H(ad, Y, Z, ae)
            }
        }

        function p() {
            l(j)
        }

        function I() {
            return l(U)
        }

        function d() {
            return l(F)
        }

        function D(aa) {
            var X = this[h],
                t = this[W],
                Z, Y;
            if ((X.nodeType === 3 || X.nodeType === 4) && X.nodeValue) {
                if (!t) {
                    X.parentNode.insertBefore(aa, X)
                } else {
                    if (t >= X.nodeValue.length) {
                        c.insertAfter(aa, X)
                    } else {
                        Z = X.splitText(t);
                        X.parentNode.insertBefore(aa, Z)
                    }
                }
            } else {
                if (X.childNodes.length > 0) {
                    Y = X.childNodes[t]
                }
                if (Y) {
                    X.insertBefore(aa, Y)
                } else {
                    X.appendChild(aa)
                }
            }
        }

        function N(X) {
            var t = O.extractContents();
            O.insertNode(X);
            X.appendChild(t);
            O.selectNode(X)
        }

        function L() {
            return k(new b(c), {
                startContainer: O[h],
                startOffset: O[W],
                endContainer: O[Q],
                endOffset: O[A],
                collapsed: O.collapsed,
                commonAncestorContainer: O.commonAncestorContainer
            })
        }

        function P(t, X) {
            var Y;
            if (t.nodeType == 3) {
                return t
            }
            if (X < 0) {
                return t
            }
            Y = t.firstChild;
            while (Y && X > 0) {
                --X;
                Y = Y.nextSibling
            }
            if (Y) {
                return Y
            }
            return t
        }

        function m() {
            return (O[h] == O[Q] && O[W] == O[A])
        }

        function H(Z, ab, X, aa) {
            var ac, Y, t, ad, af, ae;
            if (Z == X) {
                if (ab == aa) {
                    return 0
                }
                if (ab < aa) {
                    return -1
                }
                return 1
            }
            ac = X;
            while (ac && ac.parentNode != Z) {
                ac = ac.parentNode
            }
            if (ac) {
                Y = 0;
                t = Z.firstChild;
                while (t != ac && Y < ab) {
                    Y++;
                    t = t.nextSibling
                }
                if (ab <= Y) {
                    return -1
                }
                return 1
            }
            ac = Z;
            while (ac && ac.parentNode != X) {
                ac = ac.parentNode
            }
            if (ac) {
                Y = 0;
                t = X.firstChild;
                while (t != ac && Y < aa) {
                    Y++;
                    t = t.nextSibling
                }
                if (Y < aa) {
                    return -1
                }
                return 1
            }
            ad = c.findCommonAncestor(Z, X);
            af = Z;
            while (af && af.parentNode != ad) {
                af = af.parentNode
            }
            if (!af) {
                af = ad
            }
            ae = X;
            while (ae && ae.parentNode != ad) {
                ae = ae.parentNode
            }
            if (!ae) {
                ae = ad
            }
            if (af == ae) {
                return 0
            }
            t = ad.firstChild;
            while (t) {
                if (t == af) {
                    return -1
                }
                if (t == ae) {
                    return 1
                }
                t = t.nextSibling
            }
        }

        function C(X, aa, Z) {
            var t, Y;
            if (X) {
                O[h] = aa;
                O[W] = Z
            } else {
                O[Q] = aa;
                O[A] = Z
            }
            t = O[Q];
            while (t.parentNode) {
                t = t.parentNode
            }
            Y = O[h];
            while (Y.parentNode) {
                Y = Y.parentNode
            }
            if (Y == t) {
                if (H(O[h], O[W], O[Q], O[A]) > 0) {
                    O.collapse(X)
                }
            } else {
                O.collapse(X)
            }
            O.collapsed = m();
            O.commonAncestorContainer = c.findCommonAncestor(O[h], O[Q])
        }

        function l(ad) {
            var ac, Z = 0,
                af = 0,
                X, ab, Y, aa, t, ae;
            if (O[h] == O[Q]) {
                return f(ad)
            }
            for (ac = O[Q], X = ac.parentNode; X; ac = X, X = X.parentNode) {
                if (X == O[h]) {
                    return r(ac, ad)
                }++Z
            }
            for (ac = O[h], X = ac.parentNode; X; ac = X, X = X.parentNode) {
                if (X == O[Q]) {
                    return V(ac, ad)
                }++af
            }
            ab = af - Z;
            Y = O[h];
            while (ab > 0) {
                Y = Y.parentNode;
                ab--
            }
            aa = O[Q];
            while (ab < 0) {
                aa = aa.parentNode;
                ab++
            }
            for (t = Y.parentNode, ae = aa.parentNode; t != ae; t = t.parentNode, ae = ae.parentNode) {
                Y = t;
                aa = ae
            }
            return o(Y, aa, ad)
        }

        function f(ac) {
            var ae, af, t, Y, Z, ad, aa, X, ab;
            if (ac != j) {
                ae = x()
            }
            if (O[W] == O[A]) {
                return ae
            }
            if (O[h].nodeType == 3) {
                af = O[h].nodeValue;
                t = af.substring(O[W], O[A]);
                if (ac != F) {
                    Y = O[h];
                    X = O[W];
                    ab = O[A] - O[W];
                    if (X === 0 && ab >= Y.nodeValue.length - 1) {
                        Y.parentNode.removeChild(Y)
                    } else {
                        Y.deleteData(X, ab)
                    }
                    O.collapse(E)
                }
                if (ac == j) {
                    return
                }
                if (t.length > 0) {
                    ae.appendChild(e.createTextNode(t))
                }
                return ae
            }
            Y = P(O[h], O[W]);
            Z = O[A] - O[W];
            while (Y && Z > 0) {
                ad = Y.nextSibling;
                aa = z(Y, ac);
                if (ae) {
                    ae.appendChild(aa)
                }--Z;
                Y = ad
            }
            if (ac != F) {
                O.collapse(E)
            }
            return ae
        }

        function r(ad, aa) {
            var ac, ab, X, t, Z, Y;
            if (aa != j) {
                ac = x()
            }
            ab = i(ad, aa);
            if (ac) {
                ac.appendChild(ab)
            }
            X = n(ad);
            t = X - O[W];
            if (t <= 0) {
                if (aa != F) {
                    O.setEndBefore(ad);
                    O.collapse(S)
                }
                return ac
            }
            ab = ad.previousSibling;
            while (t > 0) {
                Z = ab.previousSibling;
                Y = z(ab, aa);
                if (ac) {
                    ac.insertBefore(Y, ac.firstChild)
                }--t;
                ab = Z
            }
            if (aa != F) {
                O.setEndBefore(ad);
                O.collapse(S)
            }
            return ac
        }

        function V(ab, aa) {
            var ad, X, ac, t, Z, Y;
            if (aa != j) {
                ad = x()
            }
            ac = R(ab, aa);
            if (ad) {
                ad.appendChild(ac)
            }
            X = n(ab);
            ++X;
            t = O[A] - X;
            ac = ab.nextSibling;
            while (ac && t > 0) {
                Z = ac.nextSibling;
                Y = z(ac, aa);
                if (ad) {
                    ad.appendChild(Y)
                }--t;
                ac = Z
            }
            if (aa != F) {
                O.setStartAfter(ab);
                O.collapse(E)
            }
            return ad
        }

        function o(ab, t, ae) {
            var Y, ag, aa, ac, ad, X, af, Z;
            if (ae != j) {
                ag = x()
            }
            Y = R(ab, ae);
            if (ag) {
                ag.appendChild(Y)
            }
            aa = ab.parentNode;
            ac = n(ab);
            ad = n(t);
            ++ac;
            X = ad - ac;
            af = ab.nextSibling;
            while (X > 0) {
                Z = af.nextSibling;
                Y = z(af, ae);
                if (ag) {
                    ag.appendChild(Y)
                }
                af = Z;
                --X
            }
            Y = i(t, ae);
            if (ag) {
                ag.appendChild(Y)
            }
            if (ae != F) {
                O.setStartAfter(ab);
                O.collapse(E)
            }
            return ag
        }

        function i(ac, ad) {
            var Y = P(O[Q], O[A] - 1),
                ae, ab, aa, t, X, Z = Y != O[Q];
            if (Y == ac) {
                return M(Y, Z, S, ad)
            }
            ae = Y.parentNode;
            ab = M(ae, S, S, ad);
            while (ae) {
                while (Y) {
                    aa = Y.previousSibling;
                    t = M(Y, Z, S, ad);
                    if (ad != j) {
                        ab.insertBefore(t, ab.firstChild)
                    }
                    Z = E;
                    Y = aa
                }
                if (ae == ac) {
                    return ab
                }
                Y = ae.previousSibling;
                ae = ae.parentNode;
                X = M(ae, S, S, ad);
                if (ad != j) {
                    X.appendChild(ab)
                }
                ab = X
            }
        }

        function R(ac, ad) {
            var Z = P(O[h], O[W]),
                aa = Z != O[h],
                ae, ab, Y, t, X;
            if (Z == ac) {
                return M(Z, aa, E, ad)
            }
            ae = Z.parentNode;
            ab = M(ae, S, E, ad);
            while (ae) {
                while (Z) {
                    Y = Z.nextSibling;
                    t = M(Z, aa, E, ad);
                    if (ad != j) {
                        ab.appendChild(t)
                    }
                    aa = E;
                    Z = Y
                }
                if (ae == ac) {
                    return ab
                }
                Z = ae.nextSibling;
                ae = ae.parentNode;
                X = M(ae, S, E, ad);
                if (ad != j) {
                    X.appendChild(ab)
                }
                ab = X
            }
        }

        function M(t, aa, ad, ae) {
            var Z, Y, ab, X, ac;
            if (aa) {
                return z(t, ae)
            }
            if (t.nodeType == 3) {
                Z = t.nodeValue;
                if (ad) {
                    X = O[W];
                    Y = Z.substring(X);
                    ab = Z.substring(0, X)
                } else {
                    X = O[A];
                    Y = Z.substring(0, X);
                    ab = Z.substring(X)
                }
                if (ae != F) {
                    t.nodeValue = ab
                }
                if (ae == j) {
                    return
                }
                ac = c.clone(t, S);
                ac.nodeValue = Y;
                return ac
            }
            if (ae == j) {
                return
            }
            return c.clone(t, S)
        }

        function z(X, t) {
            if (t != j) {
                return t == F ? c.clone(X, E) : X
            }
            X.parentNode.removeChild(X)
        }

        function T() {
            return c.create("body", null, d()).outerText
        }
        return O
    }
    a.Range = b;
    b.prototype.toString = function() {
        return this.toStringIE()
    }
})(tinymce.dom);
(function() {
    function a(d) {
        var b = this,
            h = d.dom,
            c = true,
            f = false;

        function e(i, j) {
            var k, t = 0,
                q, n, m, l, o, r, p = -1,
                s;
            k = i.duplicate();
            k.collapse(j);
            s = k.parentElement();
            if (s.ownerDocument !== d.dom.doc) {
                return
            }
            while (s.contentEditable === "false") {
                s = s.parentNode
            }
            if (!s.hasChildNodes()) {
                return {
                    node: s,
                    inside: 1
                }
            }
            m = s.children;
            q = m.length - 1;
            while (t <= q) {
                r = Math.floor((t + q) / 2);
                l = m[r];
                k.moveToElementText(l);
                p = k.compareEndPoints(j ? "StartToStart" : "EndToEnd", i);
                if (p > 0) {
                    q = r - 1
                } else {
                    if (p < 0) {
                        t = r + 1
                    } else {
                        return {
                            node: l
                        }
                    }
                }
            }
            if (p < 0) {
                if (!l) {
                    k.moveToElementText(s);
                    k.collapse(true);
                    l = s;
                    n = true
                } else {
                    k.collapse(false)
                }
                o = 0;
                while (k.compareEndPoints(j ? "StartToStart" : "StartToEnd", i) !== 0) {
                    if (k.move("character", 1) === 0 || s != k.parentElement()) {
                        break
                    }
                    o++
                }
            } else {
                k.collapse(true);
                o = 0;
                while (k.compareEndPoints(j ? "StartToStart" : "StartToEnd", i) !== 0) {
                    if (k.move("character", -1) === 0 || s != k.parentElement()) {
                        break
                    }
                    o++
                }
            }
            return {
                node: l,
                position: p,
                offset: o,
                inside: n
            }
        }

        function g() {
            var i = d.getRng(),
                r = h.createRng(),
                l, k, p, q, m, j;
            l = i.item ? i.item(0) : i.parentElement();
            if (l.ownerDocument != h.doc) {
                return r
            }
            k = d.isCollapsed();
            if (i.item) {
                r.setStart(l.parentNode, h.nodeIndex(l));
                r.setEnd(r.startContainer, r.startOffset + 1);
                return r
            }

            function o(A) {
                var u = e(i, A),
                    s, y, z = 0,
                    x, v, t;
                s = u.node;
                y = u.offset;
                if (u.inside && !s.hasChildNodes()) {
                    r[A ? "setStart" : "setEnd"](s, 0);
                    return
                }
                if (y === v) {
                    r[A ? "setStartBefore" : "setEndAfter"](s);
                    return
                }
                if (u.position < 0) {
                    x = u.inside ? s.firstChild : s.nextSibling;
                    if (!x) {
                        r[A ? "setStartAfter" : "setEndAfter"](s);
                        return
                    }
                    if (!y) {
                        if (x.nodeType == 3) {
                            r[A ? "setStart" : "setEnd"](x, 0)
                        } else {
                            r[A ? "setStartBefore" : "setEndBefore"](x)
                        }
                        return
                    }
                    while (x) {
                        t = x.nodeValue;
                        z += t.length;
                        if (z >= y) {
                            s = x;
                            z -= y;
                            z = t.length - z;
                            break
                        }
                        x = x.nextSibling
                    }
                } else {
                    x = s.previousSibling;
                    if (!x) {
                        return r[A ? "setStartBefore" : "setEndBefore"](s)
                    }
                    if (!y) {
                        if (s.nodeType == 3) {
                            r[A ? "setStart" : "setEnd"](x, s.nodeValue.length)
                        } else {
                            r[A ? "setStartAfter" : "setEndAfter"](x)
                        }
                        return
                    }
                    while (x) {
                        z += x.nodeValue.length;
                        if (z >= y) {
                            s = x;
                            z -= y;
                            break
                        }
                        x = x.previousSibling
                    }
                }
                r[A ? "setStart" : "setEnd"](s, z)
            }
            try {
                o(true);
                if (!k) {
                    o()
                }
            } catch (n) {
                if (n.number == -2147024809) {
                    m = b.getBookmark(2);
                    p = i.duplicate();
                    p.collapse(true);
                    l = p.parentElement();
                    if (!k) {
                        p = i.duplicate();
                        p.collapse(false);
                        q = p.parentElement();
                        q.innerHTML = q.innerHTML
                    }
                    l.innerHTML = l.innerHTML;
                    b.moveToBookmark(m);
                    i = d.getRng();
                    o(true);
                    if (!k) {
                        o()
                    }
                } else {
                    throw n
                }
            }
            return r
        }
        this.getBookmark = function(m) {
            var j = d.getRng(),
                o, i, l = {};

            function n(u) {
                var t, p, s, r, q = [];
                t = u.parentNode;
                p = h.getRoot().parentNode;
                while (t != p && t.nodeType !== 9) {
                    s = t.children;
                    r = s.length;
                    while (r--) {
                        if (u === s[r]) {
                            q.push(r);
                            break
                        }
                    }
                    u = t;
                    t = t.parentNode
                }
                return q
            }

            function k(q) {
                var p;
                p = e(j, q);
                if (p) {
                    return {
                        position: p.position,
                        offset: p.offset,
                        indexes: n(p.node),
                        inside: p.inside
                    }
                }
            }
            if (m === 2) {
                if (!j.item) {
                    l.start = k(true);
                    if (!d.isCollapsed()) {
                        l.end = k()
                    }
                } else {
                    l.start = {
                        ctrl: true,
                        indexes: n(j.item(0))
                    }
                }
            }
            return l
        };
        this.moveToBookmark = function(k) {
            var j, i = h.doc.body;

            function m(o) {
                var r, q, n, p;
                r = h.getRoot();
                for (q = o.length - 1; q >= 0; q--) {
                    p = r.children;
                    n = o[q];
                    if (n <= p.length - 1) {
                        r = p[n]
                    }
                }
                return r
            }

            function l(r) {
                var n = k[r ? "start" : "end"],
                    q, p, o;
                if (n) {
                    q = n.position > 0;
                    p = i.createTextRange();
                    p.moveToElementText(m(n.indexes));
                    offset = n.offset;
                    if (offset !== o) {
                        p.collapse(n.inside || q);
                        p.moveStart("character", q ? -offset : offset)
                    } else {
                        p.collapse(r)
                    }
                    j.setEndPoint(r ? "StartToStart" : "EndToStart", p);
                    if (r) {
                        j.collapse(true)
                    }
                }
            }
            if (k.start) {
                if (k.start.ctrl) {
                    j = i.createControlRange();
                    j.addElement(m(k.start.indexes));
                    j.select()
                } else {
                    j = i.createTextRange();
                    l(true);
                    l();
                    j.select()
                }
            }
        };
        this.addRange = function(i) {
            var n, l, k, p, v, q, t, s = d.dom.doc,
                m = s.body,
                r, u;

            function j(C) {
                var y, B, x, A, z;
                x = h.create("a");
                y = C ? k : v;
                B = C ? p : q;
                A = n.duplicate();
                if (y == s || y == s.documentElement) {
                    y = m;
                    B = 0
                }
                if (y.nodeType == 3) {
                    y.parentNode.insertBefore(x, y);
                    A.moveToElementText(x);
                    A.moveStart("character", B);
                    h.remove(x);
                    n.setEndPoint(C ? "StartToStart" : "EndToEnd", A)
                } else {
                    z = y.childNodes;
                    if (z.length) {
                        if (B >= z.length) {
                            h.insertAfter(x, z[z.length - 1])
                        } else {
                            y.insertBefore(x, z[B])
                        }
                        A.moveToElementText(x)
                    } else {
                        if (y.canHaveHTML) {
                            y.innerHTML = "<span>\uFEFF</span>";
                            x = y.firstChild;
                            A.moveToElementText(x);
                            A.collapse(f)
                        }
                    }
                    n.setEndPoint(C ? "StartToStart" : "EndToEnd", A);
                    h.remove(x)
                }
            }
            k = i.startContainer;
            p = i.startOffset;
            v = i.endContainer;
            q = i.endOffset;
            n = m.createTextRange();
            if (k == v && k.nodeType == 1) {
                if (p == q && !k.hasChildNodes()) {
                    if (k.canHaveHTML) {
                        t = k.previousSibling;
                        if (t && !t.hasChildNodes() && h.isBlock(t)) {
                            t.innerHTML = "\uFEFF"
                        } else {
                            t = null
                        }
                        k.innerHTML = "<span>\uFEFF</span><span>\uFEFF</span>";
                        n.moveToElementText(k.lastChild);
                        n.select();
                        h.doc.selection.clear();
                        k.innerHTML = "";
                        if (t) {
                            t.innerHTML = ""
                        }
                        return
                    } else {
                        p = h.nodeIndex(k);
                        k = k.parentNode
                    }
                }
                if (p == q - 1) {
                    try {
                        u = k.childNodes[p];
                        l = m.createControlRange();
                        l.addElement(u);
                        l.select();
                        r = d.getRng();
                        if (r.item && u === r.item(0)) {
                            return
                        }
                    } catch (o) {}
                }
            }
            j(true);
            j();
            n.select()
        };
        this.getRangeAt = g
    }
    tinymce.dom.TridentSelection = a
})();
(function() {
    var n = /((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,
        i = "sizcache",
        o = 0,
        r = Object.prototype.toString,
        h = false,
        g = true,
        q = /\\/g,
        u = /\r\n/g,
        x = /\W/;
    [0, 0].sort(function() {
        g = false;
        return 0
    });
    var d = function(C, e, F, G) {
        F = F || [];
        e = e || document;
        var I = e;
        if (e.nodeType !== 1 && e.nodeType !== 9) {
            return []
        }
        if (!C || typeof C !== "string") {
            return F
        }
        var z, K, N, y, J, M, L, E, B = true,
            A = d.isXML(e),
            D = [],
            H = C;
        do {
            n.exec("");
            z = n.exec(H);
            if (z) {
                H = z[3];
                D.push(z[1]);
                if (z[2]) {
                    y = z[3];
                    break
                }
            }
        } while (z);
        if (D.length > 1 && j.exec(C)) {
            if (D.length === 2 && k.relative[D[0]]) {
                K = s(D[0] + D[1], e, G)
            } else {
                K = k.relative[D[0]] ? [e] : d(D.shift(), e);
                while (D.length) {
                    C = D.shift();
                    if (k.relative[C]) {
                        C += D.shift()
                    }
                    K = s(C, K, G)
                }
            }
        } else {
            if (!G && D.length > 1 && e.nodeType === 9 && !A && k.match.ID.test(D[0]) && !k.match.ID.test(D[D.length - 1])) {
                J = d.find(D.shift(), e, A);
                e = J.expr ? d.filter(J.expr, J.set)[0] : J.set[0]
            }
            if (e) {
                J = G ? {
                    expr: D.pop(),
                    set: l(G)
                } : d.find(D.pop(), D.length === 1 && (D[0] === "~" || D[0] === "+") && e.parentNode ? e.parentNode : e, A);
                K = J.expr ? d.filter(J.expr, J.set) : J.set;
                if (D.length > 0) {
                    N = l(K)
                } else {
                    B = false
                }
                while (D.length) {
                    M = D.pop();
                    L = M;
                    if (!k.relative[M]) {
                        M = ""
                    } else {
                        L = D.pop()
                    }
                    if (L == null) {
                        L = e
                    }
                    k.relative[M](N, L, A)
                }
            } else {
                N = D = []
            }
        }
        if (!N) {
            N = K
        }
        if (!N) {
            d.error(M || C)
        }
        if (r.call(N) === "[object Array]") {
            if (!B) {
                F.push.apply(F, N)
            } else {
                if (e && e.nodeType === 1) {
                    for (E = 0; N[E] != null; E++) {
                        if (N[E] && (N[E] === true || N[E].nodeType === 1 && d.contains(e, N[E]))) {
                            F.push(K[E])
                        }
                    }
                } else {
                    for (E = 0; N[E] != null; E++) {
                        if (N[E] && N[E].nodeType === 1) {
                            F.push(K[E])
                        }
                    }
                }
            }
        } else {
            l(N, F)
        }
        if (y) {
            d(y, I, F, G);
            d.uniqueSort(F)
        }
        return F
    };
    d.uniqueSort = function(y) {
        if (p) {
            h = g;
            y.sort(p);
            if (h) {
                for (var e = 1; e < y.length; e++) {
                    if (y[e] === y[e - 1]) {
                        y.splice(e--, 1)
                    }
                }
            }
        }
        return y
    };
    d.matches = function(e, y) {
        return d(e, null, null, y)
    };
    d.matchesSelector = function(e, y) {
        return d(y, null, null, [e]).length > 0
    };
    d.find = function(E, e, F) {
        var D, z, B, A, C, y;
        if (!E) {
            return []
        }
        for (z = 0, B = k.order.length; z < B; z++) {
            C = k.order[z];
            if ((A = k.leftMatch[C].exec(E))) {
                y = A[1];
                A.splice(1, 1);
                if (y.substr(y.length - 1) !== "\\") {
                    A[1] = (A[1] || "").replace(q, "");
                    D = k.find[C](A, e, F);
                    if (D != null) {
                        E = E.replace(k.match[C], "");
                        break
                    }
                }
            }
        }
        if (!D) {
            D = typeof e.getElementsByTagName !== "undefined" ? e.getElementsByTagName("*") : []
        }
        return {
            set: D,
            expr: E
        }
    };
    d.filter = function(I, H, L, B) {
        var D, e, G, N, K, y, A, C, J, z = I,
            M = [],
            F = H,
            E = H && H[0] && d.isXML(H[0]);
        while (I && H.length) {
            for (G in k.filter) {
                if ((D = k.leftMatch[G].exec(I)) != null && D[2]) {
                    y = k.filter[G];
                    A = D[1];
                    e = false;
                    D.splice(1, 1);
                    if (A.substr(A.length - 1) === "\\") {
                        continue
                    }
                    if (F === M) {
                        M = []
                    }
                    if (k.preFilter[G]) {
                        D = k.preFilter[G](D, F, L, M, B, E);
                        if (!D) {
                            e = N = true
                        } else {
                            if (D === true) {
                                continue
                            }
                        }
                    }
                    if (D) {
                        for (C = 0;
                            (K = F[C]) != null; C++) {
                            if (K) {
                                N = y(K, D, C, F);
                                J = B ^ N;
                                if (L && N != null) {
                                    if (J) {
                                        e = true
                                    } else {
                                        F[C] = false
                                    }
                                } else {
                                    if (J) {
                                        M.push(K);
                                        e = true
                                    }
                                }
                            }
                        }
                    }
                    if (N !== undefined) {
                        if (!L) {
                            F = M
                        }
                        I = I.replace(k.match[G], "");
                        if (!e) {
                            return []
                        }
                        break
                    }
                }
            }
            if (I === z) {
                if (e == null) {
                    d.error(I)
                } else {
                    break
                }
            }
            z = I
        }
        return F
    };
    d.error = function(e) {
        throw new Error("Syntax error, unrecognized expression: " + e)
    };
    var b = d.getText = function(B) {
        var z, A, e = B.nodeType,
            y = "";
        if (e) {
            if (e === 1 || e === 9 || e === 11) {
                if (typeof B.textContent === "string") {
                    return B.textContent
                } else {
                    if (typeof B.innerText === "string") {
                        return B.innerText.replace(u, "")
                    } else {
                        for (B = B.firstChild; B; B = B.nextSibling) {
                            y += b(B)
                        }
                    }
                }
            } else {
                if (e === 3 || e === 4) {
                    return B.nodeValue
                }
            }
        } else {
            for (z = 0;
                (A = B[z]); z++) {
                if (A.nodeType !== 8) {
                    y += b(A)
                }
            }
        }
        return y
    };
    var k = d.selectors = {
        order: ["ID", "NAME", "TAG"],
        match: {
            ID: /#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
            CLASS: /\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
            NAME: /\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,
            ATTR: /\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(?:(['"])(.*?)\3|(#?(?:[\w\u00c0-\uFFFF\-]|\\.)*)|)|)\s*\]/,
            TAG: /^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,
            CHILD: /:(only|nth|last|first)-child(?:\(\s*(even|odd|(?:[+\-]?\d+|(?:[+\-]?\d*)?n\s*(?:[+\-]\s*\d+)?))\s*\))?/,
            POS: /:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,
            PSEUDO: /:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/
        },
        leftMatch: {},
        attrMap: {
            "class": "className",
            "for": "htmlFor"
        },
        attrHandle: {
            href: function(e) {
                return e.getAttribute("href")
            },
            type: function(e) {
                return e.getAttribute("type")
            }
        },
        relative: {
            "+": function(D, y) {
                var A = typeof y === "string",
                    C = A && !x.test(y),
                    E = A && !C;
                if (C) {
                    y = y.toLowerCase()
                }
                for (var z = 0, e = D.length, B; z < e; z++) {
                    if ((B = D[z])) {
                        while ((B = B.previousSibling) && B.nodeType !== 1) {}
                        D[z] = E || B && B.nodeName.toLowerCase() === y ? B || false : B === y
                    }
                }
                if (E) {
                    d.filter(y, D, true)
                }
            },
            ">": function(D, y) {
                var C, B = typeof y === "string",
                    z = 0,
                    e = D.length;
                if (B && !x.test(y)) {
                    y = y.toLowerCase();
                    for (; z < e; z++) {
                        C = D[z];
                        if (C) {
                            var A = C.parentNode;
                            D[z] = A.nodeName.toLowerCase() === y ? A : false
                        }
                    }
                } else {
                    for (; z < e; z++) {
                        C = D[z];
                        if (C) {
                            D[z] = B ? C.parentNode : C.parentNode === y
                        }
                    }
                    if (B) {
                        d.filter(y, D, true)
                    }
                }
            },
            "": function(A, y, C) {
                var B, z = o++,
                    e = t;
                if (typeof y === "string" && !x.test(y)) {
                    y = y.toLowerCase();
                    B = y;
                    e = a
                }
                e("parentNode", y, z, A, B, C)
            },
            "~": function(A, y, C) {
                var B, z = o++,
                    e = t;
                if (typeof y === "string" && !x.test(y)) {
                    y = y.toLowerCase();
                    B = y;
                    e = a
                }
                e("previousSibling", y, z, A, B, C)
            }
        },
        find: {
            ID: function(y, z, A) {
                if (typeof z.getElementById !== "undefined" && !A) {
                    var e = z.getElementById(y[1]);
                    return e && e.parentNode ? [e] : []
                }
            },
            NAME: function(z, C) {
                if (typeof C.getElementsByName !== "undefined") {
                    var y = [],
                        B = C.getElementsByName(z[1]);
                    for (var A = 0, e = B.length; A < e; A++) {
                        if (B[A].getAttribute("name") === z[1]) {
                            y.push(B[A])
                        }
                    }
                    return y.length === 0 ? null : y
                }
            },
            TAG: function(e, y) {
                if (typeof y.getElementsByTagName !== "undefined") {
                    return y.getElementsByTagName(e[1])
                }
            }
        },
        preFilter: {
            CLASS: function(A, y, z, e, D, E) {
                A = " " + A[1].replace(q, "") + " ";
                if (E) {
                    return A
                }
                for (var B = 0, C;
                    (C = y[B]) != null; B++) {
                    if (C) {
                        if (D ^ (C.className && (" " + C.className + " ").replace(/[\t\n\r]/g, " ").indexOf(A) >= 0)) {
                            if (!z) {
                                e.push(C)
                            }
                        } else {
                            if (z) {
                                y[B] = false
                            }
                        }
                    }
                }
                return false
            },
            ID: function(e) {
                return e[1].replace(q, "")
            },
            TAG: function(y, e) {
                return y[1].replace(q, "").toLowerCase()
            },
            CHILD: function(e) {
                if (e[1] === "nth") {
                    if (!e[2]) {
                        d.error(e[0])
                    }
                    e[2] = e[2].replace(/^\+|\s*/g, "");
                    var y = /(-?)(\d*)(?:n([+\-]?\d*))?/.exec(e[2] === "even" && "2n" || e[2] === "odd" && "2n+1" || !/\D/.test(e[2]) && "0n+" + e[2] || e[2]);
                    e[2] = (y[1] + (y[2] || 1)) - 0;
                    e[3] = y[3] - 0
                } else {
                    if (e[2]) {
                        d.error(e[0])
                    }
                }
                e[0] = o++;
                return e
            },
            ATTR: function(B, y, z, e, C, D) {
                var A = B[1] = B[1].replace(q, "");
                if (!D && k.attrMap[A]) {
                    B[1] = k.attrMap[A]
                }
                B[4] = (B[4] || B[5] || "").replace(q, "");
                if (B[2] === "~=") {
                    B[4] = " " + B[4] + " "
                }
                return B
            },
            PSEUDO: function(B, y, z, e, C) {
                if (B[1] === "not") {
                    if ((n.exec(B[3]) || "").length > 1 || /^\w/.test(B[3])) {
                        B[3] = d(B[3], null, null, y)
                    } else {
                        var A = d.filter(B[3], y, z, true ^ C);
                        if (!z) {
                            e.push.apply(e, A)
                        }
                        return false
                    }
                } else {
                    if (k.match.POS.test(B[0]) || k.match.CHILD.test(B[0])) {
                        return true
                    }
                }
                return B
            },
            POS: function(e) {
                e.unshift(true);
                return e
            }
        },
        filters: {
            enabled: function(e) {
                return e.disabled === false && e.type !== "hidden"
            },
            disabled: function(e) {
                return e.disabled === true
            },
            checked: function(e) {
                return e.checked === true
            },
            selected: function(e) {
                if (e.parentNode) {
                    e.parentNode.selectedIndex
                }
                return e.selected === true
            },
            parent: function(e) {
                return !!e.firstChild
            },
            empty: function(e) {
                return !e.firstChild
            },
            has: function(z, y, e) {
                return !!d(e[3], z).length
            },
            header: function(e) {
                return (/h\d/i).test(e.nodeName)
            },
            text: function(z) {
                var e = z.getAttribute("type"),
                    y = z.type;
                return z.nodeName.toLowerCase() === "input" && "text" === y && (e === y || e === null)
            },
            radio: function(e) {
                return e.nodeName.toLowerCase() === "input" && "radio" === e.type
            },
            checkbox: function(e) {
                return e.nodeName.toLowerCase() === "input" && "checkbox" === e.type
            },
            file: function(e) {
                return e.nodeName.toLowerCase() === "input" && "file" === e.type
            },
            password: function(e) {
                return e.nodeName.toLowerCase() === "input" && "password" === e.type
            },
            submit: function(y) {
                var e = y.nodeName.toLowerCase();
                return (e === "input" || e === "button") && "submit" === y.type
            },
            image: function(e) {
                return e.nodeName.toLowerCase() === "input" && "image" === e.type
            },
            reset: function(y) {
                var e = y.nodeName.toLowerCase();
                return (e === "input" || e === "button") && "reset" === y.type
            },
            button: function(y) {
                var e = y.nodeName.toLowerCase();
                return e === "input" && "button" === y.type || e === "button"
            },
            input: function(e) {
                return (/input|select|textarea|button/i).test(e.nodeName)
            },
            focus: function(e) {
                return e === e.ownerDocument.activeElement
            }
        },
        setFilters: {
            first: function(y, e) {
                return e === 0
            },
            last: function(z, y, e, A) {
                return y === A.length - 1
            },
            even: function(y, e) {
                return e % 2 === 0
            },
            odd: function(y, e) {
                return e % 2 === 1
            },
            lt: function(z, y, e) {
                return y < e[3] - 0
            },
            gt: function(z, y, e) {
                return y > e[3] - 0
            },
            nth: function(z, y, e) {
                return e[3] - 0 === y
            },
            eq: function(z, y, e) {
                return e[3] - 0 === y
            }
        },
        filter: {
            PSEUDO: function(z, E, D, F) {
                var e = E[1],
                    y = k.filters[e];
                if (y) {
                    return y(z, D, E, F)
                } else {
                    if (e === "contains") {
                        return (z.textContent || z.innerText || b([z]) || "").indexOf(E[3]) >= 0
                    } else {
                        if (e === "not") {
                            var A = E[3];
                            for (var C = 0, B = A.length; C < B; C++) {
                                if (A[C] === z) {
                                    return false
                                }
                            }
                            return true
                        } else {
                            d.error(e)
                        }
                    }
                }
            },
            CHILD: function(z, B) {
                var A, H, D, G, e, C, F, E = B[1],
                    y = z;
                switch (E) {
                    case "only":
                    case "first":
                        while ((y = y.previousSibling)) {
                            if (y.nodeType === 1) {
                                return false
                            }
                        }
                        if (E === "first") {
                            return true
                        }
                        y = z;
                    case "last":
                        while ((y = y.nextSibling)) {
                            if (y.nodeType === 1) {
                                return false
                            }
                        }
                        return true;
                    case "nth":
                        A = B[2];
                        H = B[3];
                        if (A === 1 && H === 0) {
                            return true
                        }
                        D = B[0];
                        G = z.parentNode;
                        if (G && (G[i] !== D || !z.nodeIndex)) {
                            C = 0;
                            for (y = G.firstChild; y; y = y.nextSibling) {
                                if (y.nodeType === 1) {
                                    y.nodeIndex = ++C
                                }
                            }
                            G[i] = D
                        }
                        F = z.nodeIndex - H;
                        if (A === 0) {
                            return F === 0
                        } else {
                            return (F % A === 0 && F / A >= 0)
                        }
                }
            },
            ID: function(y, e) {
                return y.nodeType === 1 && y.getAttribute("id") === e
            },
            TAG: function(y, e) {
                return (e === "*" && y.nodeType === 1) || !!y.nodeName && y.nodeName.toLowerCase() === e
            },
            CLASS: function(y, e) {
                return (" " + (y.className || y.getAttribute("class")) + " ").indexOf(e) > -1
            },
            ATTR: function(C, A) {
                var z = A[1],
                    e = d.attr ? d.attr(C, z) : k.attrHandle[z] ? k.attrHandle[z](C) : C[z] != null ? C[z] : C.getAttribute(z),
                    D = e + "",
                    B = A[2],
                    y = A[4];
                return e == null ? B === "!=" : !B && d.attr ? e != null : B === "=" ? D === y : B === "*=" ? D.indexOf(y) >= 0 : B === "~=" ? (" " + D + " ").indexOf(y) >= 0 : !y ? D && e !== false : B === "!=" ? D !== y : B === "^=" ? D.indexOf(y) === 0 : B === "$=" ? D.substr(D.length - y.length) === y : B === "|=" ? D === y || D.substr(0, y.length + 1) === y + "-" : false
            },
            POS: function(B, y, z, C) {
                var e = y[2],
                    A = k.setFilters[e];
                if (A) {
                    return A(B, z, y, C)
                }
            }
        }
    };
    var j = k.match.POS,
        c = function(y, e) {
            return "\\" + (e - 0 + 1)
        };
    for (var f in k.match) {
        k.match[f] = new RegExp(k.match[f].source + (/(?![^\[]*\])(?![^\(]*\))/.source));
        k.leftMatch[f] = new RegExp(/(^(?:.|\r|\n)*?)/.source + k.match[f].source.replace(/\\(\d+)/g, c))
    }
    k.match.globalPOS = j;
    var l = function(y, e) {
        y = Array.prototype.slice.call(y, 0);
        if (e) {
            e.push.apply(e, y);
            return e
        }
        return y
    };
    try {
        Array.prototype.slice.call(document.documentElement.childNodes, 0)[0].nodeType
    } catch (v) {
        l = function(B, A) {
            var z = 0,
                y = A || [];
            if (r.call(B) === "[object Array]") {
                Array.prototype.push.apply(y, B)
            } else {
                if (typeof B.length === "number") {
                    for (var e = B.length; z < e; z++) {
                        y.push(B[z])
                    }
                } else {
                    for (; B[z]; z++) {
                        y.push(B[z])
                    }
                }
            }
            return y
        }
    }
    var p, m;
    if (document.documentElement.compareDocumentPosition) {
        p = function(y, e) {
            if (y === e) {
                h = true;
                return 0
            }
            if (!y.compareDocumentPosition || !e.compareDocumentPosition) {
                return y.compareDocumentPosition ? -1 : 1
            }
            return y.compareDocumentPosition(e) & 4 ? -1 : 1
        }
    } else {
        p = function(F, E) {
            if (F === E) {
                h = true;
                return 0
            } else {
                if (F.sourceIndex && E.sourceIndex) {
                    return F.sourceIndex - E.sourceIndex
                }
            }
            var C, y, z = [],
                e = [],
                B = F.parentNode,
                D = E.parentNode,
                G = B;
            if (B === D) {
                return m(F, E)
            } else {
                if (!B) {
                    return -1
                } else {
                    if (!D) {
                        return 1
                    }
                }
            }
            while (G) {
                z.unshift(G);
                G = G.parentNode
            }
            G = D;
            while (G) {
                e.unshift(G);
                G = G.parentNode
            }
            C = z.length;
            y = e.length;
            for (var A = 0; A < C && A < y; A++) {
                if (z[A] !== e[A]) {
                    return m(z[A], e[A])
                }
            }
            return A === C ? m(F, e[A], -1) : m(z[A], E, 1)
        };
        m = function(y, e, z) {
            if (y === e) {
                return z
            }
            var A = y.nextSibling;
            while (A) {
                if (A === e) {
                    return -1
                }
                A = A.nextSibling
            }
            return 1
        }
    }(function() {
        var y = document.createElement("div"),
            z = "script" + (new Date()).getTime(),
            e = document.documentElement;
        y.innerHTML = "<a name='" + z + "'/>";
        e.insertBefore(y, e.firstChild);
        if (document.getElementById(z)) {
            k.find.ID = function(B, C, D) {
                if (typeof C.getElementById !== "undefined" && !D) {
                    var A = C.getElementById(B[1]);
                    return A ? A.id === B[1] || typeof A.getAttributeNode !== "undefined" && A.getAttributeNode("id").nodeValue === B[1] ? [A] : undefined : []
                }
            };
            k.filter.ID = function(C, A) {
                var B = typeof C.getAttributeNode !== "undefined" && C.getAttributeNode("id");
                return C.nodeType === 1 && B && B.nodeValue === A
            }
        }
        e.removeChild(y);
        e = y = null
    })();
    (function() {
        var e = document.createElement("div");
        e.appendChild(document.createComment(""));
        if (e.getElementsByTagName("*").length > 0) {
            k.find.TAG = function(y, C) {
                var B = C.getElementsByTagName(y[1]);
                if (y[1] === "*") {
                    var A = [];
                    for (var z = 0; B[z]; z++) {
                        if (B[z].nodeType === 1) {
                            A.push(B[z])
                        }
                    }
                    B = A
                }
                return B
            }
        }
        e.innerHTML = "<a href='#'></a>";
        if (e.firstChild && typeof e.firstChild.getAttribute !== "undefined" && e.firstChild.getAttribute("href") !== "#") {
            k.attrHandle.href = function(y) {
                return y.getAttribute("href", 2)
            }
        }
        e = null
    })();
    if (document.querySelectorAll) {
        (function() {
            var e = d,
                A = document.createElement("div"),
                z = "__sizzle__";
            A.innerHTML = "<p class='TEST'></p>";
            if (A.querySelectorAll && A.querySelectorAll(".TEST").length === 0) {
                return
            }
            d = function(L, C, G, K) {
                C = C || document;
                if (!K && !d.isXML(C)) {
                    var J = /^(\w+$)|^\.([\w\-]+$)|^#([\w\-]+$)/.exec(L);
                    if (J && (C.nodeType === 1 || C.nodeType === 9)) {
                        if (J[1]) {
                            return l(C.getElementsByTagName(L), G)
                        } else {
                            if (J[2] && k.find.CLASS && C.getElementsByClassName) {
                                return l(C.getElementsByClassName(J[2]), G)
                            }
                        }
                    }
                    if (C.nodeType === 9) {
                        if (L === "body" && C.body) {
                            return l([C.body], G)
                        } else {
                            if (J && J[3]) {
                                var F = C.getElementById(J[3]);
                                if (F && F.parentNode) {
                                    if (F.id === J[3]) {
                                        return l([F], G)
                                    }
                                } else {
                                    return l([], G)
                                }
                            }
                        }
                        try {
                            return l(C.querySelectorAll(L), G)
                        } catch (H) {}
                    } else {
                        if (C.nodeType === 1 && C.nodeName.toLowerCase() !== "object") {
                            var D = C,
                                E = C.getAttribute("id"),
                                B = E || z,
                                N = C.parentNode,
                                M = /^\s*[+~]/.test(L);
                            if (!E) {
                                C.setAttribute("id", B)
                            } else {
                                B = B.replace(/'/g, "\\$&")
                            }
                            if (M && N) {
                                C = C.parentNode
                            }
                            try {
                                if (!M || N) {
                                    return l(C.querySelectorAll("[id='" + B + "'] " + L), G)
                                }
                            } catch (I) {} finally {
                                if (!E) {
                                    D.removeAttribute("id")
                                }
                            }
                        }
                    }
                }
                return e(L, C, G, K)
            };
            for (var y in e) {
                d[y] = e[y]
            }
            A = null
        })()
    }(function() {
        var e = document.documentElement,
            z = e.matchesSelector || e.mozMatchesSelector || e.webkitMatchesSelector || e.msMatchesSelector;
        if (z) {
            var B = !z.call(document.createElement("div"), "div"),
                y = false;
            try {
                z.call(document.documentElement, "[test!='']:sizzle")
            } catch (A) {
                y = true
            }
            d.matchesSelector = function(D, F) {
                F = F.replace(/\=\s*([^'"\]]*)\s*\]/g, "='$1']");
                if (!d.isXML(D)) {
                    try {
                        if (y || !k.match.PSEUDO.test(F) && !/!=/.test(F)) {
                            var C = z.call(D, F);
                            if (C || !B || D.document && D.document.nodeType !== 11) {
                                return C
                            }
                        }
                    } catch (E) {}
                }
                return d(F, null, null, [D]).length > 0
            }
        }
    })();
    (function() {
        var e = document.createElement("div");
        e.innerHTML = "<div class='test e'></div><div class='test'></div>";
        if (!e.getElementsByClassName || e.getElementsByClassName("e").length === 0) {
            return
        }
        e.lastChild.className = "e";
        if (e.getElementsByClassName("e").length === 1) {
            return
        }
        k.order.splice(1, 0, "CLASS");
        k.find.CLASS = function(y, z, A) {
            if (typeof z.getElementsByClassName !== "undefined" && !A) {
                return z.getElementsByClassName(y[1])
            }
        };
        e = null
    })();

    function a(y, D, C, G, E, F) {
        for (var A = 0, z = G.length; A < z; A++) {
            var e = G[A];
            if (e) {
                var B = false;
                e = e[y];
                while (e) {
                    if (e[i] === C) {
                        B = G[e.sizset];
                        break
                    }
                    if (e.nodeType === 1 && !F) {
                        e[i] = C;
                        e.sizset = A
                    }
                    if (e.nodeName.toLowerCase() === D) {
                        B = e;
                        break
                    }
                    e = e[y]
                }
                G[A] = B
            }
        }
    }

    function t(y, D, C, G, E, F) {
        for (var A = 0, z = G.length; A < z; A++) {
            var e = G[A];
            if (e) {
                var B = false;
                e = e[y];
                while (e) {
                    if (e[i] === C) {
                        B = G[e.sizset];
                        break
                    }
                    if (e.nodeType === 1) {
                        if (!F) {
                            e[i] = C;
                            e.sizset = A
                        }
                        if (typeof D !== "string") {
                            if (e === D) {
                                B = true;
                                break
                            }
                        } else {
                            if (d.filter(D, [e]).length > 0) {
                                B = e;
                                break
                            }
                        }
                    }
                    e = e[y]
                }
                G[A] = B
            }
        }
    }
    if (document.documentElement.contains) {
        d.contains = function(y, e) {
            return y !== e && (y.contains ? y.contains(e) : true)
        }
    } else {
        if (document.documentElement.compareDocumentPosition) {
            d.contains = function(y, e) {
                return !!(y.compareDocumentPosition(e) & 16)
            }
        } else {
            d.contains = function() {
                return false
            }
        }
    }
    d.isXML = function(e) {
        var y = (e ? e.ownerDocument || e : 0).documentElement;
        return y ? y.nodeName !== "HTML" : false
    };
    var s = function(z, e, D) {
        var C, E = [],
            B = "",
            F = e.nodeType ? [e] : e;
        while ((C = k.match.PSEUDO.exec(z))) {
            B += C[0];
            z = z.replace(k.match.PSEUDO, "")
        }
        z = k.relative[z] ? z + "*" : z;
        for (var A = 0, y = F.length; A < y; A++) {
            d(z, F[A], E, D)
        }
        return d.filter(B, E)
    };
    window.tinymce.dom.Sizzle = d
})();
(function(a) {
    a.dom.Element = function(f, d) {
        var b = this,
            e, c;
        b.settings = d = d || {};
        b.id = f;
        b.dom = e = d.dom || a.DOM;
        if (!a.isIE) {
            c = e.get(b.id)
        }
        a.each(("getPos,getRect,getParent,add,setStyle,getStyle,setStyles,setAttrib,setAttribs,getAttrib,addClass,removeClass,hasClass,getOuterHTML,setOuterHTML,remove,show,hide,isHidden,setHTML,get").split(/,/), function(g) {
            b[g] = function() {
                var h = [f],
                    j;
                for (j = 0; j < arguments.length; j++) {
                    h.push(arguments[j])
                }
                h = e[g].apply(e, h);
                b.update(g);
                return h
            }
        });
        a.extend(b, {
            on: function(i, h, g) {
                return a.dom.Event.add(b.id, i, h, g)
            },
            getXY: function() {
                return {
                    x: parseInt(b.getStyle("left")),
                    y: parseInt(b.getStyle("top"))
                }
            },
            getSize: function() {
                var g = e.get(b.id);
                return {
                    w: parseInt(b.getStyle("width") || g.clientWidth),
                    h: parseInt(b.getStyle("height") || g.clientHeight)
                }
            },
            moveTo: function(g, h) {
                b.setStyles({
                    left: g,
                    top: h
                })
            },
            moveBy: function(g, i) {
                var h = b.getXY();
                b.moveTo(h.x + g, h.y + i)
            },
            resizeTo: function(g, i) {
                b.setStyles({
                    width: g,
                    height: i
                })
            },
            resizeBy: function(g, j) {
                var i = b.getSize();
                b.resizeTo(i.w + g, i.h + j)
            },
            update: function(h) {
                var g;
                if (a.isIE6 && d.blocker) {
                    h = h || "";
                    if (h.indexOf("get") === 0 || h.indexOf("has") === 0 || h.indexOf("is") === 0) {
                        return
                    }
                    if (h == "remove") {
                        e.remove(b.blocker);
                        return
                    }
                    if (!b.blocker) {
                        b.blocker = e.uniqueId();
                        g = e.add(d.container || e.getRoot(), "iframe", {
                            id: b.blocker,
                            style: "position:absolute;",
                            frameBorder: 0,
                            src: 'javascript:""'
                        });
                        e.setStyle(g, "opacity", 0)
                    } else {
                        g = e.get(b.blocker)
                    }
                    e.setStyles(g, {
                        left: b.getStyle("left", 1),
                        top: b.getStyle("top", 1),
                        width: b.getStyle("width", 1),
                        height: b.getStyle("height", 1),
                        display: b.getStyle("display", 1),
                        zIndex: parseInt(b.getStyle("zIndex", 1) || 0) - 1
                    })
                }
            }
        })
    }
})(tinymce);
(function(d) {
    function f(g) {
        return g.replace(/[\n\r]+/g, "")
    }
    var c = d.is,
        b = d.isIE,
        e = d.each,
        a = d.dom.TreeWalker;
    d.create("tinymce.dom.Selection", {
        Selection: function(k, j, i, h) {
            var g = this;
            g.dom = k;
            g.win = j;
            g.serializer = i;
            g.editor = h;
            e(["onBeforeSetContent", "onBeforeGetContent", "onSetContent", "onGetContent"], function(l) {
                g[l] = new d.util.Dispatcher(g)
            });
            if (!g.win.getSelection) {
                g.tridentSel = new d.dom.TridentSelection(g)
            }
            if (d.isIE && k.boxModel) {
                this._fixIESelection()
            }
            d.addUnload(g.destroy, g)
        },
        setCursorLocation: function(i, j) {
            var g = this;
            var h = g.dom.createRng();
            h.setStart(i, j);
            h.setEnd(i, j);
            g.setRng(h);
            g.collapse(false)
        },
        getContent: function(h) {
            var g = this,
                i = g.getRng(),
                m = g.dom.create("body"),
                k = g.getSel(),
                j, l, o;
            h = h || {};
            j = l = "";
            h.get = true;
            h.format = h.format || "html";
            h.forced_root_block = "";
            g.onBeforeGetContent.dispatch(g, h);
            if (h.format == "text") {
                return g.isCollapsed() ? "" : (i.text || (k.toString ? k.toString() : ""))
            }
            if (i.cloneContents) {
                o = i.cloneContents();
                if (o) {
                    m.appendChild(o)
                }
            } else {
                if (c(i.item) || c(i.htmlText)) {
                    m.innerHTML = "<br>" + (i.item ? i.item(0).outerHTML : i.htmlText);
                    m.removeChild(m.firstChild)
                } else {
                    m.innerHTML = i.toString()
                }
            }
            if (/^\s/.test(m.innerHTML)) {
                j = " "
            }
            if (/\s+$/.test(m.innerHTML)) {
                l = " "
            }
            h.getInner = true;
            h.content = g.isCollapsed() ? "" : j + g.serializer.serialize(m, h) + l;
            g.onGetContent.dispatch(g, h);
            return h.content
        },
        setContent: function(h, j) {
            var o = this,
                g = o.getRng(),
                k, l = o.win.document,
                n, m;
            j = j || {
                format: "html"
            };
            j.set = true;
            h = j.content = h;
            if (!j.no_events) {
                o.onBeforeSetContent.dispatch(o, j)
            }
            h = j.content;
            if (g.insertNode) {
                h += '<span id="__caret">_</span>';
                if (g.startContainer == l && g.endContainer == l) {
                    l.body.innerHTML = h
                } else {
                    g.deleteContents();
                    if (l.body.childNodes.length === 0) {
                        l.body.innerHTML = h
                    } else {
                        if (g.createContextualFragment) {
                            g.insertNode(g.createContextualFragment(h))
                        } else {
                            n = l.createDocumentFragment();
                            m = l.createElement("div");
                            n.appendChild(m);
                            m.outerHTML = h;
                            g.insertNode(n)
                        }
                    }
                }
                k = o.dom.get("__caret");
                g = l.createRange();
                g.setStartBefore(k);
                g.setEndBefore(k);
                o.setRng(g);
                o.dom.remove("__caret");
                try {
                    o.setRng(g)
                } catch (i) {}
            } else {
                if (g.item) {
                    l.execCommand("Delete", false, null);
                    g = o.getRng()
                }
                if (/^\s+/.test(h)) {
                    g.pasteHTML('<span id="__mce_tmp">_</span>' + h);
                    o.dom.remove("__mce_tmp")
                } else {
                    g.pasteHTML(h)
                }
            }
            if (!j.no_events) {
                o.onSetContent.dispatch(o, j)
            }
        },
        getStart: function() {
            var i = this,
                h = i.getRng(),
                j, g, l, k;
            if (h.duplicate || h.item) {
                if (h.item) {
                    return h.item(0)
                }
                l = h.duplicate();
                l.collapse(1);
                j = l.parentElement();
                if (j.ownerDocument !== i.dom.doc) {
                    j = i.dom.getRoot()
                }
                g = k = h.parentElement();
                while (k = k.parentNode) {
                    if (k == j) {
                        j = g;
                        break
                    }
                }
                return j
            } else {
                j = h.startContainer;
                if (j.nodeType == 1 && j.hasChildNodes()) {
                    j = j.childNodes[Math.min(j.childNodes.length - 1, h.startOffset)]
                }
                if (j && j.nodeType == 3) {
                    return j.parentNode
                }
                return j
            }
        },
        getEnd: function() {
            var h = this,
                g = h.getRng(),
                j, i;
            if (g.duplicate || g.item) {
                if (g.item) {
                    return g.item(0)
                }
                g = g.duplicate();
                g.collapse(0);
                j = g.parentElement();
                if (j.ownerDocument !== h.dom.doc) {
                    j = h.dom.getRoot()
                }
                if (j && j.nodeName == "BODY") {
                    return j.lastChild || j
                }
                return j
            } else {
                j = g.endContainer;
                i = g.endOffset;
                if (j.nodeType == 1 && j.hasChildNodes()) {
                    j = j.childNodes[i > 0 ? i - 1 : i]
                }
                if (j && j.nodeType == 3) {
                    return j.parentNode
                }
                return j
            }
        },
        getBookmark: function(s, v) {
            var y = this,
                n = y.dom,
                h, k, j, o, i, p, q, m = "\uFEFF",
                x;

            function g(z, A) {
                var t = 0;
                e(n.select(z), function(C, B) {
                    if (C == A) {
                        t = B
                    }
                });
                return t
            }

            function u(t) {
                function z(E) {
                    var A, D, C, B = E ? "start" : "end";
                    A = t[B + "Container"];
                    D = t[B + "Offset"];
                    if (A.nodeType == 1 && A.nodeName == "TR") {
                        C = A.childNodes;
                        A = C[Math.min(E ? D : D - 1, C.length - 1)];
                        if (A) {
                            D = E ? 0 : A.childNodes.length;
                            t["set" + (E ? "Start" : "End")](A, D)
                        }
                    }
                }
                z(true);
                z();
                return t
            }

            function l() {
                var z = y.getRng(true),
                    t = n.getRoot(),
                    A = {};

                function B(E, J) {
                    var D = E[J ? "startContainer" : "endContainer"],
                        I = E[J ? "startOffset" : "endOffset"],
                        C = [],
                        F, H, G = 0;
                    if (D.nodeType == 3) {
                        if (v) {
                            for (F = D.previousSibling; F && F.nodeType == 3; F = F.previousSibling) {
                                I += F.nodeValue.length
                            }
                        }
                        C.push(I)
                    } else {
                        H = D.childNodes;
                        if (I >= H.length && H.length) {
                            G = 1;
                            I = Math.max(0, H.length - 1)
                        }
                        C.push(y.dom.nodeIndex(H[I], v) + G)
                    }
                    for (; D && D != t; D = D.parentNode) {
                        C.push(y.dom.nodeIndex(D, v))
                    }
                    return C
                }
                A.start = B(z, true);
                if (!y.isCollapsed()) {
                    A.end = B(z)
                }
                return A
            }
            if (s == 2) {
                if (y.tridentSel) {
                    return y.tridentSel.getBookmark(s)
                }
                return l()
            }
            if (s) {
                return {
                    rng: y.getRng()
                }
            }
            h = y.getRng();
            j = n.uniqueId();
            o = tinyMCE.activeEditor.selection.isCollapsed();
            x = "overflow:hidden;line-height:0px";
            if (h.duplicate || h.item) {
                if (!h.item) {
                    k = h.duplicate();
                    try {
                        h.collapse();
                        h.pasteHTML('<span data-mce-type="bookmark" id="' + j + '_start" style="' + x + '">' + m + "</span>");
                        if (!o) {
                            k.collapse(false);
                            h.moveToElementText(k.parentElement());
                            if (h.compareEndPoints("StartToEnd", k) === 0) {
                                k.move("character", -1)
                            }
                            k.pasteHTML('<span data-mce-type="bookmark" id="' + j + '_end" style="' + x + '">' + m + "</span>")
                        }
                    } catch (r) {
                        return null
                    }
                } else {
                    p = h.item(0);
                    i = p.nodeName;
                    return {
                        name: i,
                        index: g(i, p)
                    }
                }
            } else {
                p = y.getNode();
                i = p.nodeName;
                if (i == "IMG") {
                    return {
                        name: i,
                        index: g(i, p)
                    }
                }
                k = u(h.cloneRange());
                if (!o) {
                    k.collapse(false);
                    k.insertNode(n.create("span", {
                        "data-mce-type": "bookmark",
                        id: j + "_end",
                        style: x
                    }, m))
                }
                h = u(h);
                h.collapse(true);
                h.insertNode(n.create("span", {
                    "data-mce-type": "bookmark",
                    id: j + "_start",
                    style: x
                }, m))
            }
            y.moveToBookmark({
                id: j,
                keep: 1
            });
            return {
                id: j
            }
        },
        moveToBookmark: function(o) {
            var s = this,
                m = s.dom,
                j, i, g, r, k, u, p, q;

            function h(A) {
                var t = o[A ? "start" : "end"],
                    x, y, z, v;
                if (t) {
                    z = t[0];
                    for (y = r, x = t.length - 1; x >= 1; x--) {
                        v = y.childNodes;
                        if (t[x] > v.length - 1) {
                            return
                        }
                        y = v[t[x]]
                    }
                    if (y.nodeType === 3) {
                        z = Math.min(t[0], y.nodeValue.length)
                    }
                    if (y.nodeType === 1) {
                        z = Math.min(t[0], y.childNodes.length)
                    }
                    if (A) {
                        g.setStart(y, z)
                    } else {
                        g.setEnd(y, z)
                    }
                }
                return true
            }

            function l(B) {
                var v = m.get(o.id + "_" + B),
                    A, t, y, z, x = o.keep;
                if (v) {
                    A = v.parentNode;
                    if (B == "start") {
                        if (!x) {
                            t = m.nodeIndex(v)
                        } else {
                            A = v.firstChild;
                            t = 1
                        }
                        k = u = A;
                        p = q = t
                    } else {
                        if (!x) {
                            t = m.nodeIndex(v)
                        } else {
                            A = v.firstChild;
                            t = 1
                        }
                        u = A;
                        q = t
                    }
                    if (!x) {
                        z = v.previousSibling;
                        y = v.nextSibling;
                        e(d.grep(v.childNodes), function(C) {
                            if (C.nodeType == 3) {
                                C.nodeValue = C.nodeValue.replace(/\uFEFF/g, "")
                            }
                        });
                        while (v = m.get(o.id + "_" + B)) {
                            m.remove(v, 1)
                        }
                        if (z && y && z.nodeType == y.nodeType && z.nodeType == 3 && !d.isOpera) {
                            t = z.nodeValue.length;
                            z.appendData(y.nodeValue);
                            m.remove(y);
                            if (B == "start") {
                                k = u = z;
                                p = q = t
                            } else {
                                u = z;
                                q = t
                            }
                        }
                    }
                }
            }

            function n(t) {
                if (m.isBlock(t) && !t.innerHTML && !b) {
                    t.innerHTML = '<br data-mce-bogus="1" />'
                }
                return t
            }
            if (o) {
                if (o.start) {
                    g = m.createRng();
                    r = m.getRoot();
                    if (s.tridentSel) {
                        return s.tridentSel.moveToBookmark(o)
                    }
                    if (h(true) && h()) {
                        s.setRng(g)
                    }
                } else {
                    if (o.id) {
                        l("start");
                        l("end");
                        if (k) {
                            g = m.createRng();
                            g.setStart(n(k), p);
                            g.setEnd(n(u), q);
                            s.setRng(g)
                        }
                    } else {
                        if (o.name) {
                            s.select(m.select(o.name)[o.index])
                        } else {
                            if (o.rng) {
                                s.setRng(o.rng)
                            }
                        }
                    }
                }
            }
        },
        select: function(l, k) {
            var j = this,
                m = j.dom,
                h = m.createRng(),
                g;

            function i(n, p) {
                var o = new a(n, n);
                do {
                    if (n.nodeType == 3 && d.trim(n.nodeValue).length !== 0) {
                        if (p) {
                            h.setStart(n, 0)
                        } else {
                            h.setEnd(n, n.nodeValue.length)
                        }
                        return
                    }
                    if (n.nodeName == "BR") {
                        if (p) {
                            h.setStartBefore(n)
                        } else {
                            h.setEndBefore(n)
                        }
                        return
                    }
                } while (n = (p ? o.next() : o.prev()))
            }
            if (l) {
                g = m.nodeIndex(l);
                h.setStart(l.parentNode, g);
                h.setEnd(l.parentNode, g + 1);
                if (k) {
                    i(l, 1);
                    i(l)
                }
                j.setRng(h)
            }
            return l
        },
        isCollapsed: function() {
            var g = this,
                i = g.getRng(),
                h = g.getSel();
            if (!i || i.item) {
                return false
            }
            if (i.compareEndPoints) {
                return i.compareEndPoints("StartToEnd", i) === 0
            }
            return !h || i.collapsed
        },
        collapse: function(g) {
            var i = this,
                h = i.getRng(),
                j;
            if (h.item) {
                j = h.item(0);
                h = i.win.document.body.createTextRange();
                h.moveToElementText(j)
            }
            h.collapse(!!g);
            i.setRng(h)
        },
        getSel: function() {
            var h = this,
                g = this.win;
            return g.getSelection ? g.getSelection() : g.document.selection
        },
        getRng: function(m) {
            var h = this,
                j, g, l, k = h.win.document;
            if (m && h.tridentSel) {
                return h.tridentSel.getRangeAt(0)
            }
            try {
                if (j = h.getSel()) {
                    g = j.rangeCount > 0 ? j.getRangeAt(0) : (j.createRange ? j.createRange() : k.createRange())
                }
            } catch (i) {}
            if (d.isIE && g && g.setStart && k.selection.createRange().item) {
                l = k.selection.createRange().item(0);
                g = k.createRange();
                g.setStartBefore(l);
                g.setEndAfter(l)
            }
            if (!g) {
                g = k.createRange ? k.createRange() : k.body.createTextRange()
            }
            if (g.setStart && g.startContainer.nodeType === 9 && g.collapsed) {
                l = h.dom.getRoot();
                g.setStart(l, 0);
                g.setEnd(l, 0)
            }
            if (h.selectedRange && h.explicitRange) {
                if (g.compareBoundaryPoints(g.START_TO_START, h.selectedRange) === 0 && g.compareBoundaryPoints(g.END_TO_END, h.selectedRange) === 0) {
                    g = h.explicitRange
                } else {
                    h.selectedRange = null;
                    h.explicitRange = null
                }
            }
            return g
        },
        setRng: function(k, g) {
            var j, i = this;
            if (!i.tridentSel) {
                j = i.getSel();
                if (j) {
                    i.explicitRange = k;
                    try {
                        j.removeAllRanges()
                    } catch (h) {}
                    j.addRange(k);
                    if (g === false && j.extend) {
                        j.collapse(k.endContainer, k.endOffset);
                        j.extend(k.startContainer, k.startOffset)
                    }
                    i.selectedRange = j.rangeCount > 0 ? j.getRangeAt(0) : null
                }
            } else {
                if (k.cloneRange) {
                    try {
                        i.tridentSel.addRange(k);
                        return
                    } catch (h) {}
                }
                try {
                    k.select()
                } catch (h) {}
            }
        },
        setNode: function(h) {
            var g = this;
            g.setContent(g.dom.getOuterHTML(h));
            return h
        },
        getNode: function() {
            var i = this,
                h = i.getRng(),
                j = i.getSel(),
                m, l = h.startContainer,
                g = h.endContainer;

            function k(q, o) {
                var p = q;
                while (q && q.nodeType === 3 && q.length === 0) {
                    q = o ? q.nextSibling : q.previousSibling
                }
                return q || p
            }
            if (!h) {
                return i.dom.getRoot()
            }
            if (h.setStart) {
                m = h.commonAncestorContainer;
                if (!h.collapsed) {
                    if (h.startContainer == h.endContainer) {
                        if (h.endOffset - h.startOffset < 2) {
                            if (h.startContainer.hasChildNodes()) {
                                m = h.startContainer.childNodes[h.startOffset]
                            }
                        }
                    }
                    if (l.nodeType === 3 && g.nodeType === 3) {
                        if (l.length === h.startOffset) {
                            l = k(l.nextSibling, true)
                        } else {
                            l = l.parentNode
                        }
                        if (h.endOffset === 0) {
                            g = k(g.previousSibling, false)
                        } else {
                            g = g.parentNode
                        }
                        if (l && l === g) {
                            return l
                        }
                    }
                }
                if (m && m.nodeType == 3) {
                    return m.parentNode
                }
                return m
            }
            return h.item ? h.item(0) : h.parentElement()
        },
        getSelectedBlocks: function(p, h) {
            var o = this,
                k = o.dom,
                m, l, i, j = [];
            m = k.getParent(p || o.getStart(), k.isBlock);
            l = k.getParent(h || o.getEnd(), k.isBlock);
            if (m) {
                j.push(m)
            }
            if (m && l && m != l) {
                i = m;
                var g = new a(m, k.getRoot());
                while ((i = g.next()) && i != l) {
                    if (k.isBlock(i)) {
                        j.push(i)
                    }
                }
            }
            if (l && m != l) {
                j.push(l)
            }
            return j
        },
        isForward: function() {
            var i = this.dom,
                g = this.getSel(),
                j, h;
            if (!g || g.anchorNode == null || g.focusNode == null) {
                return true
            }
            j = i.createRng();
            j.setStart(g.anchorNode, g.anchorOffset);
            j.collapse(true);
            h = i.createRng();
            h.setStart(g.focusNode, g.focusOffset);
            h.collapse(true);
            return j.compareBoundaryPoints(j.START_TO_START, h) <= 0
        },
        normalize: function() {
            var h = this,
                g, m, l, j, i;

            function k(p) {
                var o, r, n, s = h.dom,
                    u = s.getRoot(),
                    q, t, v;

                function y(z, A) {
                    var B = new a(z, s.getParent(z.parentNode, s.isBlock) || u);
                    while (z = B[A ? "prev" : "next"]()) {
                        if (z.nodeName === "BR") {
                            return true
                        }
                    }
                }

                function x(B, z) {
                    var C, A;
                    z = z || o;
                    C = new a(z, s.getParent(z.parentNode, s.isBlock) || u);
                    while (q = C[B ? "prev" : "next"]()) {
                        if (q.nodeType === 3 && q.nodeValue.length > 0) {
                            o = q;
                            r = B ? q.nodeValue.length : 0;
                            m = true;
                            return
                        }
                        if (s.isBlock(q) || t[q.nodeName.toLowerCase()]) {
                            return
                        }
                        A = q
                    }
                    if (l && A) {
                        o = A;
                        m = true;
                        r = 0
                    }
                }
                o = g[(p ? "start" : "end") + "Container"];
                r = g[(p ? "start" : "end") + "Offset"];
                t = s.schema.getNonEmptyElements();
                if (o.nodeType === 9) {
                    o = s.getRoot();
                    r = 0
                }
                if (o === u) {
                    if (p) {
                        q = o.childNodes[r > 0 ? r - 1 : 0];
                        if (q) {
                            v = q.nodeName.toLowerCase();
                            if (t[q.nodeName] || q.nodeName == "TABLE") {
                                return
                            }
                        }
                    }
                    if (o.hasChildNodes()) {
                        o = o.childNodes[Math.min(!p && r > 0 ? r - 1 : r, o.childNodes.length - 1)];
                        r = 0;
                        if (o.hasChildNodes() && !/TABLE/.test(o.nodeName)) {
                            q = o;
                            n = new a(o, u);
                            do {
                                if (q.nodeType === 3 && q.nodeValue.length > 0) {
                                    r = p ? 0 : q.nodeValue.length;
                                    o = q;
                                    m = true;
                                    break
                                }
                                if (t[q.nodeName.toLowerCase()]) {
                                    r = s.nodeIndex(q);
                                    o = q.parentNode;
                                    if (q.nodeName == "IMG" && !p) {
                                        r++
                                    }
                                    m = true;
                                    break
                                }
                            } while (q = (p ? n.next() : n.prev()))
                        }
                    }
                }
                if (l) {
                    if (o.nodeType === 3 && r === 0) {
                        x(true)
                    }
                    if (o.nodeType === 1) {
                        q = o.childNodes[r];
                        if (q && q.nodeName === "BR" && !y(q) && !y(q, true)) {
                            x(true, o.childNodes[r])
                        }
                    }
                }
                if (p && !l && o.nodeType === 3 && r === o.nodeValue.length) {
                    x(false)
                }
                if (m) {
                    g["set" + (p ? "Start" : "End")](o, r)
                }
            }
            if (d.isIE) {
                return
            }
            g = h.getRng();
            l = g.collapsed;
            k(true);
            if (!l) {
                k()
            }
            if (m) {
                if (l) {
                    g.collapse(true)
                }
                h.setRng(g, h.isForward())
            }
        },
        selectorChanged: function(g, j) {
            var h = this,
                i;
            if (!h.selectorChangedData) {
                h.selectorChangedData = {};
                i = {};
                h.editor.onNodeChange.addToTop(function(l, k, o) {
                    var p = h.dom,
                        m = p.getParents(o, null, p.getRoot()),
                        n = {};
                    e(h.selectorChangedData, function(r, q) {
                        e(m, function(s) {
                            if (p.is(s, q)) {
                                if (!i[q]) {
                                    e(r, function(t) {
                                        t(true, {
                                            node: s,
                                            selector: q,
                                            parents: m
                                        })
                                    });
                                    i[q] = r
                                }
                                n[q] = r;
                                return false
                            }
                        })
                    });
                    e(i, function(r, q) {
                        if (!n[q]) {
                            delete i[q];
                            e(r, function(s) {
                                s(false, {
                                    node: o,
                                    selector: q,
                                    parents: m
                                })
                            })
                        }
                    })
                })
            }
            if (!h.selectorChangedData[g]) {
                h.selectorChangedData[g] = []
            }
            h.selectorChangedData[g].push(j);
            return h
        },
        scrollIntoView: function(k) {
            var j, h, g = this,
                i = g.dom;
            h = i.getViewPort(g.editor.getWin());
            j = i.getPos(k).y;
            if (j < h.y || j + 25 > h.y + h.h) {
                g.editor.getWin().scrollTo(0, j < h.y ? j : j - h.h + 25)
            }
        },
        destroy: function(h) {
            var g = this;
            g.win = null;
            if (!h) {
                d.removeUnload(g.destroy)
            }
        },
        _fixIESelection: function() {
            var h = this.dom,
                n = h.doc,
                i = n.body,
                k, o, g;

            function j(p, s) {
                var q = i.createTextRange();
                try {
                    q.moveToPoint(p, s)
                } catch (r) {
                    q = null
                }
                return q
            }

            function m(q) {
                var p;
                if (q.button) {
                    p = j(q.x, q.y);
                    if (p) {
                        if (p.compareEndPoints("StartToStart", o) > 0) {
                            p.setEndPoint("StartToStart", o)
                        } else {
                            p.setEndPoint("EndToEnd", o)
                        }
                        p.select()
                    }
                } else {
                    l()
                }
            }

            function l() {
                var p = n.selection.createRange();
                if (o && !p.item && p.compareEndPoints("StartToEnd", p) === 0) {
                    o.select()
                }
                h.unbind(n, "mouseup", l);
                h.unbind(n, "mousemove", m);
                o = k = 0
            }
            n.documentElement.unselectable = true;
            h.bind(n, ["mousedown", "contextmenu"], function(p) {
                if (p.target.nodeName === "HTML") {
                    if (k) {
                        l()
                    }
                    g = n.documentElement;
                    if (g.scrollHeight > g.clientHeight) {
                        return
                    }
                    k = 1;
                    o = j(p.x, p.y);
                    if (o) {
                        h.bind(n, "mouseup", l);
                        h.bind(n, "mousemove", m);
                        h.win.focus();
                        o.select()
                    }
                }
            })
        }
    })
})(tinymce);
(function(a) {
    a.dom.Serializer = function(e, i, f) {
        var h, b, d = a.isIE,
            g = a.each,
            c;
        if (!e.apply_source_formatting) {
            e.indent = false
        }
        i = i || a.DOM;
        f = f || new a.html.Schema(e);
        e.entity_encoding = e.entity_encoding || "named";
        e.remove_trailing_brs = "remove_trailing_brs" in e ? e.remove_trailing_brs : true;
        h = new a.util.Dispatcher(self);
        b = new a.util.Dispatcher(self);
        c = new a.html.DomParser(e, f);
        c.addAttributeFilter("src,href,style", function(k, j) {
            var o = k.length,
                l, q, n = "data-mce-" + j,
                p = e.url_converter,
                r = e.url_converter_scope,
                m;
            while (o--) {
                l = k[o];
                q = l.attributes.map[n];
                if (q !== m) {
                    l.attr(j, q.length > 0 ? q : null);
                    l.attr(n, null)
                } else {
                    q = l.attributes.map[j];
                    if (j === "style") {
                        q = i.serializeStyle(i.parseStyle(q), l.name)
                    } else {
                        if (p) {
                            q = p.call(r, q, j, l.name)
                        }
                    }
                    l.attr(j, q.length > 0 ? q : null)
                }
            }
        });
        c.addAttributeFilter("class", function(j, k) {
            var l = j.length,
                m, n;
            while (l--) {
                m = j[l];
                n = m.attr("class").replace(/(?:^|\s)mce(Item\w+|Selected)(?!\S)/g, "");
                m.attr("class", n.length > 0 ? n : null)
            }
        });
        c.addAttributeFilter("data-mce-type", function(j, l, k) {
            var m = j.length,
                n;
            while (m--) {
                n = j[m];
                if (n.attributes.map["data-mce-type"] === "bookmark" && !k.cleanup) {
                    n.remove()
                }
            }
        });
        c.addAttributeFilter("data-mce-expando", function(j, l, k) {
            var m = j.length;
            while (m--) {
                j[m].attr(l, null)
            }
        });
        c.addNodeFilter("noscript", function(j) {
            var k = j.length,
                l;
            while (k--) {
                l = j[k].firstChild;
                if (l) {
                    l.value = a.html.Entities.decode(l.value)
                }
            }
        });
        c.addNodeFilter("script,style", function(k, l) {
            var m = k.length,
                n, o;

            function j(p) {
                return p.replace(/(<!--\[CDATA\[|\]\]-->)/g, "\n").replace(/^[\r\n]*|[\r\n]*$/g, "").replace(/^\s*((<!--)?(\s*\/\/)?\s*<!\[CDATA\[|(<!--\s*)?\/\*\s*<!\[CDATA\[\s*\*\/|(\/\/)?\s*<!--|\/\*\s*<!--\s*\*\/)\s*[\r\n]*/gi, "").replace(/\s*(\/\*\s*\]\]>\s*\*\/(-->)?|\s*\/\/\s*\]\]>(-->)?|\/\/\s*(-->)?|\]\]>|\/\*\s*-->\s*\*\/|\s*-->\s*)\s*$/g, "")
            }
            while (m--) {
                n = k[m];
                o = n.firstChild ? n.firstChild.value : "";
                if (l === "script") {
                    n.attr("type", (n.attr("type") || "text/javascript").replace(/^mce\-/, ""));
                    if (o.length > 0) {
                        n.firstChild.value = "// <![CDATA[\n" + j(o) + "\n// ]]>"
                    }
                } else {
                    if (o.length > 0) {
                        n.firstChild.value = "<!--\n" + j(o) + "\n-->"
                    }
                }
            }
        });
        c.addNodeFilter("#comment", function(j, k) {
            var l = j.length,
                m;
            while (l--) {
                m = j[l];
                if (m.value.indexOf("[CDATA[") === 0) {
                    m.name = "#cdata";
                    m.type = 4;
                    m.value = m.value.replace(/^\[CDATA\[|\]\]$/g, "")
                } else {
                    if (m.value.indexOf("mce:protected ") === 0) {
                        m.name = "#text";
                        m.type = 3;
                        m.raw = true;
                        m.value = unescape(m.value).substr(14)
                    }
                }
            }
        });
        c.addNodeFilter("xml:namespace,input", function(j, k) {
            var l = j.length,
                m;
            while (l--) {
                m = j[l];
                if (m.type === 7) {
                    m.remove()
                } else {
                    if (m.type === 1) {
                        if (k === "input" && !("type" in m.attributes.map)) {
                            m.attr("type", "text")
                        }
                    }
                }
            }
        });
        if (e.fix_list_elements) {
            c.addNodeFilter("ul,ol", function(k, l) {
                var m = k.length,
                    n, j;
                while (m--) {
                    n = k[m];
                    j = n.parent;
                    if (j.name === "ul" || j.name === "ol") {
                        if (n.prev && n.prev.name === "li") {
                            n.prev.append(n)
                        }
                    }
                }
            })
        }
        c.addAttributeFilter("data-mce-src,data-mce-href,data-mce-style", function(j, k) {
            var l = j.length;
            while (l--) {
                j[l].attr(k, null)
            }
        });
        return {
            schema: f,
            addNodeFilter: c.addNodeFilter,
            addAttributeFilter: c.addAttributeFilter,
            onPreProcess: h,
            onPostProcess: b,
            serialize: function(o, m) {
                var l, p, k, j, n;
                if (d && i.select("script,style,select,map").length > 0) {
                    n = o.innerHTML;
                    o = o.cloneNode(false);
                    i.setHTML(o, n)
                } else {
                    o = o.cloneNode(true)
                }
                l = o.ownerDocument.implementation;
                if (l.createHTMLDocument) {
                    p = l.createHTMLDocument("");
                    g(o.nodeName == "BODY" ? o.childNodes : [o], function(q) {
                        p.body.appendChild(p.importNode(q, true))
                    });
                    if (o.nodeName != "BODY") {
                        o = p.body.firstChild
                    } else {
                        o = p.body
                    }
                    k = i.doc;
                    i.doc = p
                }
                m = m || {};
                m.format = m.format || "html";
                if (!m.no_events) {
                    m.node = o;
                    h.dispatch(self, m)
                }
                j = new a.html.Serializer(e, f);
                m.content = j.serialize(c.parse(a.trim(m.getInner ? o.innerHTML : i.getOuterHTML(o)), m));
                if (!m.cleanup) {
                    m.content = m.content.replace(/\uFEFF/g, "")
                }
                if (!m.no_events) {
                    b.dispatch(self, m)
                }
                if (k) {
                    i.doc = k
                }
                m.node = null;
                return m.content
            },
            addRules: function(j) {
                f.addValidElements(j)
            },
            setRules: function(j) {
                f.setValidElements(j)
            }
        }
    }
})(tinymce);
(function(a) {
    a.dom.ScriptLoader = function(h) {
        var c = 0,
            k = 1,
            i = 2,
            l = {},
            j = [],
            e = {},
            d = [],
            g = 0,
            f;

        function b(m, v) {
            var x = this,
                q = a.DOM,
                s, o, r, n;

            function p() {
                q.remove(n);
                if (s) {
                    s.onreadystatechange = s.onload = s = null
                }
                v()
            }

            function u() {
                if (typeof(console) !== "undefined" && console.log) {
                    console.log("Failed to load: " + m)
                }
            }
            n = q.uniqueId();
            if (a.isIE6) {
                o = new a.util.URI(m);
                r = location;
                if (o.host == r.hostname && o.port == r.port && (o.protocol + ":") == r.protocol && o.protocol.toLowerCase() != "file") {
                    a.util.XHR.send({
                        url: a._addVer(o.getURI()),
                        success: function(y) {
                            var t = q.create("script", {
                                type: "text/javascript"
                            });
                            t.text = y;
                            document.getElementsByTagName("head")[0].appendChild(t);
                            q.remove(t);
                            p()
                        },
                        error: u
                    });
                    return
                }
            }
            s = document.createElement("script");
            s.id = n;
            s.type = "text/javascript";
            s.src = a._addVer(m);
            if (!a.isIE) {
                s.onload = p
            }
            s.onerror = u;
            if (!a.isOpera) {
                s.onreadystatechange = function() {
                    var t = s.readyState;
                    if (t == "complete" || t == "loaded") {
                        p()
                    }
                }
            }(document.getElementsByTagName("head")[0] || document.body).appendChild(s)
        }
        this.isDone = function(m) {
            return l[m] == i
        };
        this.markDone = function(m) {
            l[m] = i
        };
        this.add = this.load = function(m, q, n) {
            var o, p = l[m];
            if (p == f) {
                j.push(m);
                l[m] = c
            }
            if (q) {
                if (!e[m]) {
                    e[m] = []
                }
                e[m].push({
                    func: q,
                    scope: n || this
                })
            }
        };
        this.loadQueue = function(n, m) {
            this.loadScripts(j, n, m)
        };
        this.loadScripts = function(m, q, p) {
            var o;

            function n(r) {
                a.each(e[r], function(s) {
                    s.func.call(s.scope)
                });
                e[r] = f
            }
            d.push({
                func: q,
                scope: p || this
            });
            o = function() {
                var r = a.grep(m);
                m.length = 0;
                a.each(r, function(s) {
                    if (l[s] == i) {
                        n(s);
                        return
                    }
                    if (l[s] != k) {
                        l[s] = k;
                        g++;
                        b(s, function() {
                            l[s] = i;
                            g--;
                            n(s);
                            o()
                        })
                    }
                });
                if (!g) {
                    a.each(d, function(s) {
                        s.func.call(s.scope)
                    });
                    d.length = 0
                }
            };
            o()
        }
    };
    a.ScriptLoader = new a.dom.ScriptLoader()
})(tinymce);
(function(a) {
    a.dom.RangeUtils = function(c) {
        var b = "\uFEFF";
        this.walk = function(d, s) {
            var i = d.startContainer,
                l = d.startOffset,
                t = d.endContainer,
                m = d.endOffset,
                j, g, o, h, r, q, e;
            e = c.select("td.mceSelected,th.mceSelected");
            if (e.length > 0) {
                a.each(e, function(u) {
                    s([u])
                });
                return
            }

            function f(u) {
                var v;
                v = u[0];
                if (v.nodeType === 3 && v === i && l >= v.nodeValue.length) {
                    u.splice(0, 1)
                }
                v = u[u.length - 1];
                if (m === 0 && u.length > 0 && v === t && v.nodeType === 3) {
                    u.splice(u.length - 1, 1)
                }
                return u
            }

            function p(x, v, u) {
                var y = [];
                for (; x && x != u; x = x[v]) {
                    y.push(x)
                }
                return y
            }

            function n(v, u) {
                do {
                    if (v.parentNode == u) {
                        return v
                    }
                    v = v.parentNode
                } while (v)
            }

            function k(x, v, y) {
                var u = y ? "nextSibling" : "previousSibling";
                for (h = x, r = h.parentNode; h && h != v; h = r) {
                    r = h.parentNode;
                    q = p(h == x ? h : h[u], u);
                    if (q.length) {
                        if (!y) {
                            q.reverse()
                        }
                        s(f(q))
                    }
                }
            }
            if (i.nodeType == 1 && i.hasChildNodes()) {
                i = i.childNodes[l]
            }
            if (t.nodeType == 1 && t.hasChildNodes()) {
                t = t.childNodes[Math.min(m - 1, t.childNodes.length - 1)]
            }
            if (i == t) {
                return s(f([i]))
            }
            j = c.findCommonAncestor(i, t);
            for (h = i; h; h = h.parentNode) {
                if (h === t) {
                    return k(i, j, true)
                }
                if (h === j) {
                    break
                }
            }
            for (h = t; h; h = h.parentNode) {
                if (h === i) {
                    return k(t, j)
                }
                if (h === j) {
                    break
                }
            }
            g = n(i, j) || i;
            o = n(t, j) || t;
            k(i, g, true);
            q = p(g == i ? g : g.nextSibling, "nextSibling", o == t ? o.nextSibling : o);
            if (q.length) {
                s(f(q))
            }
            k(t, o)
        };
        this.split = function(e) {
            var h = e.startContainer,
                d = e.startOffset,
                i = e.endContainer,
                g = e.endOffset;

            function f(j, k) {
                return j.splitText(k)
            }
            if (h == i && h.nodeType == 3) {
                if (d > 0 && d < h.nodeValue.length) {
                    i = f(h, d);
                    h = i.previousSibling;
                    if (g > d) {
                        g = g - d;
                        h = i = f(i, g).previousSibling;
                        g = i.nodeValue.length;
                        d = 0
                    } else {
                        g = 0
                    }
                }
            } else {
                if (h.nodeType == 3 && d > 0 && d < h.nodeValue.length) {
                    h = f(h, d);
                    d = 0
                }
                if (i.nodeType == 3 && g > 0 && g < i.nodeValue.length) {
                    i = f(i, g).previousSibling;
                    g = i.nodeValue.length
                }
            }
            return {
                startContainer: h,
                startOffset: d,
                endContainer: i,
                endOffset: g
            }
        }
    };
    a.dom.RangeUtils.compareRanges = function(c, b) {
        if (c && b) {
            if (c.item || c.duplicate) {
                if (c.item && b.item && c.item(0) === b.item(0)) {
                    return true
                }
                if (c.isEqual && b.isEqual && b.isEqual(c)) {
                    return true
                }
            } else {
                return c.startContainer == b.startContainer && c.startOffset == b.startOffset
            }
        }
        return false
    }
})(tinymce);
(function(b) {
    var a = b.dom.Event,
        c = b.each;
    b.create("tinymce.ui.KeyboardNavigation", {
        KeyboardNavigation: function(e, f) {
            var q = this,
                n = e.root,
                m = e.items,
                o = e.enableUpDown,
                i = e.enableLeftRight || !e.enableUpDown,
                l = e.excludeFromTabOrder,
                k, h, p, d, g;
            f = f || b.DOM;
            k = function(r) {
                g = r.target.id
            };
            h = function(r) {
                f.setAttrib(r.target.id, "tabindex", "-1")
            };
            d = function(r) {
                var s = f.get(g);
                f.setAttrib(s, "tabindex", "0");
                s.focus()
            };
            q.focus = function() {
                f.get(g).focus()
            };
            q.destroy = function() {
                c(m, function(s) {
                    var t = f.get(s.id);
                    f.unbind(t, "focus", k);
                    f.unbind(t, "blur", h)
                });
                var r = f.get(n);
                f.unbind(r, "focus", d);
                f.unbind(r, "keydown", p);
                m = f = n = q.focus = k = h = p = d = null;
                q.destroy = function() {}
            };
            q.moveFocus = function(v, s) {
                var r = -1,
                    u = q.controls,
                    t;
                if (!g) {
                    return
                }
                c(m, function(y, x) {
                    if (y.id === g) {
                        r = x;
                        return false
                    }
                });
                r += v;
                if (r < 0) {
                    r = m.length - 1
                } else {
                    if (r >= m.length) {
                        r = 0
                    }
                }
                t = m[r];
                f.setAttrib(g, "tabindex", "-1");
                f.setAttrib(t.id, "tabindex", "0");
                f.get(t.id).focus();
                if (e.actOnFocus) {
                    e.onAction(t.id)
                }
                if (s) {
                    a.cancel(s)
                }
            };
            p = function(z) {
                var v = 37,
                    u = 39,
                    y = 38,
                    A = 40,
                    r = 27,
                    t = 14,
                    s = 13,
                    x = 32;
                switch (z.keyCode) {
                    case v:
                        if (i) {
                            q.moveFocus(-1)
                        }
                        break;
                    case u:
                        if (i) {
                            q.moveFocus(1)
                        }
                        break;
                    case y:
                        if (o) {
                            q.moveFocus(-1)
                        }
                        break;
                    case A:
                        if (o) {
                            q.moveFocus(1)
                        }
                        break;
                    case r:
                        if (e.onCancel) {
                            e.onCancel();
                            a.cancel(z)
                        }
                        break;
                    case t:
                    case s:
                    case x:
                        if (e.onAction) {
                            e.onAction(g);
                            a.cancel(z)
                        }
                        break
                }
            };
            c(m, function(t, r) {
                var s, u;
                if (!t.id) {
                    t.id = f.uniqueId("_mce_item_")
                }
                u = f.get(t.id);
                if (l) {
                    f.bind(u, "blur", h);
                    s = "-1"
                } else {
                    s = (r === 0 ? "0" : "-1")
                }
                u.setAttribute("tabindex", s);
                f.bind(u, "focus", k)
            });
            if (m[0]) {
                g = m[0].id
            }
            f.setAttrib(n, "tabindex", "-1");
            var j = f.get(n);
            f.bind(j, "focus", d);
            f.bind(j, "keydown", p)
        }
    })
})(tinymce);
(function(c) {
    var b = c.DOM,
        a = c.is;
    c.create("tinymce.ui.Control", {
        Control: function(f, e, d) {
            this.id = f;
            this.settings = e = e || {};
            this.rendered = false;
            this.onRender = new c.util.Dispatcher(this);
            this.classPrefix = "";
            this.scope = e.scope || this;
            this.disabled = 0;
            this.active = 0;
            this.editor = d
        },
        setAriaProperty: function(f, e) {
            var d = b.get(this.id + "_aria") || b.get(this.id);
            if (d) {
                b.setAttrib(d, "aria-" + f, !!e)
            }
        },
        focus: function() {
            b.get(this.id).focus()
        },
        setDisabled: function(d) {
            if (d != this.disabled) {
                this.setAriaProperty("disabled", d);
                this.setState("Disabled", d);
                this.setState("Enabled", !d);
                this.disabled = d
            }
        },
        isDisabled: function() {
            return this.disabled
        },
        setActive: function(d) {
            if (d != this.active) {
                this.setState("Active", d);
                this.active = d;
                this.setAriaProperty("pressed", d)
            }
        },
        isActive: function() {
            return this.active
        },
        setState: function(f, d) {
            var e = b.get(this.id);
            f = this.classPrefix + f;
            if (d) {
                b.addClass(e, f)
            } else {
                b.removeClass(e, f)
            }
        },
        isRendered: function() {
            return this.rendered
        },
        renderHTML: function() {},
        renderTo: function(d) {
            b.setHTML(d, this.renderHTML())
        },
        postRender: function() {
            var e = this,
                d;
            if (a(e.disabled)) {
                d = e.disabled;
                e.disabled = -1;
                e.setDisabled(d)
            }
            if (a(e.active)) {
                d = e.active;
                e.active = -1;
                e.setActive(d)
            }
        },
        remove: function() {
            b.remove(this.id);
            this.destroy()
        },
        destroy: function() {
            c.dom.Event.clear(this.id)
        }
    })
})(tinymce);
tinymce.create("tinymce.ui.Container:tinymce.ui.Control", {
    Container: function(c, b, a) {
        this.parent(c, b, a);
        this.controls = [];
        this.lookup = {}
    },
    add: function(a) {
        this.lookup[a.id] = a;
        this.controls.push(a);
        return a
    },
    get: function(a) {
        return this.lookup[a]
    }
});
tinymce.create("tinymce.ui.Separator:tinymce.ui.Control", {
    Separator: function(b, a) {
        this.parent(b, a);
        this.classPrefix = "mceSeparator";
        this.setDisabled(true)
    },
    renderHTML: function() {
        return tinymce.DOM.createHTML("span", {
            "class": this.classPrefix,
            role: "separator",
            "aria-orientation": "vertical",
            tabindex: "-1"
        })
    }
});
(function(d) {
    var c = d.is,
        b = d.DOM,
        e = d.each,
        a = d.walk;
    d.create("tinymce.ui.MenuItem:tinymce.ui.Control", {
        MenuItem: function(g, f) {
            this.parent(g, f);
            this.classPrefix = "mceMenuItem"
        },
        setSelected: function(f) {
            this.setState("Selected", f);
            this.setAriaProperty("checked", !!f);
            this.selected = f
        },
        isSelected: function() {
            return this.selected
        },
        postRender: function() {
            var f = this;
            f.parent();
            if (c(f.selected)) {
                f.setSelected(f.selected)
            }
        }
    })
})(tinymce);
(function(d) {
    var c = d.is,
        b = d.DOM,
        e = d.each,
        a = d.walk;
    d.create("tinymce.ui.Menu:tinymce.ui.MenuItem", {
        Menu: function(h, g) {
            var f = this;
            f.parent(h, g);
            f.items = {};
            f.collapsed = false;
            f.menuCount = 0;
            f.onAddItem = new d.util.Dispatcher(this)
        },
        expand: function(g) {
            var f = this;
            if (g) {
                a(f, function(h) {
                    if (h.expand) {
                        h.expand()
                    }
                }, "items", f)
            }
            f.collapsed = false
        },
        collapse: function(g) {
            var f = this;
            if (g) {
                a(f, function(h) {
                    if (h.collapse) {
                        h.collapse()
                    }
                }, "items", f)
            }
            f.collapsed = true
        },
        isCollapsed: function() {
            return this.collapsed
        },
        add: function(f) {
            if (!f.settings) {
                f = new d.ui.MenuItem(f.id || b.uniqueId(), f)
            }
            this.onAddItem.dispatch(this, f);
            return this.items[f.id] = f
        },
        addSeparator: function() {
            return this.add({
                separator: true
            })
        },
        addMenu: function(f) {
            if (!f.collapse) {
                f = this.createMenu(f)
            }
            this.menuCount++;
            return this.add(f)
        },
        hasMenus: function() {
            return this.menuCount !== 0
        },
        remove: function(f) {
            delete this.items[f.id]
        },
        removeAll: function() {
            var f = this;
            a(f, function(g) {
                if (g.removeAll) {
                    g.removeAll()
                } else {
                    g.remove()
                }
                g.destroy()
            }, "items", f);
            f.items = {}
        },
        createMenu: function(g) {
            var f = new d.ui.Menu(g.id || b.uniqueId(), g);
            f.onAddItem.add(this.onAddItem.dispatch, this.onAddItem);
            return f
        }
    })
})(tinymce);
(function(e) {
    var d = e.is,
        c = e.DOM,
        f = e.each,
        a = e.dom.Event,
        b = e.dom.Element;
    e.create("tinymce.ui.DropMenu:tinymce.ui.Menu", {
        DropMenu: function(h, g) {
            g = g || {};
            g.container = g.container || c.doc.body;
            g.offset_x = g.offset_x || 0;
            g.offset_y = g.offset_y || 0;
            g.vp_offset_x = g.vp_offset_x || 0;
            g.vp_offset_y = g.vp_offset_y || 0;
            if (d(g.icons) && !g.icons) {
                g["class"] += " mceNoIcons"
            }
            this.parent(h, g);
            this.onShowMenu = new e.util.Dispatcher(this);
            this.onHideMenu = new e.util.Dispatcher(this);
            this.classPrefix = "mceMenu"
        },
        createMenu: function(j) {
            var h = this,
                i = h.settings,
                g;
            j.container = j.container || i.container;
            j.parent = h;
            j.constrain = j.constrain || i.constrain;
            j["class"] = j["class"] || i["class"];
            j.vp_offset_x = j.vp_offset_x || i.vp_offset_x;
            j.vp_offset_y = j.vp_offset_y || i.vp_offset_y;
            j.keyboard_focus = i.keyboard_focus;
            g = new e.ui.DropMenu(j.id || c.uniqueId(), j);
            g.onAddItem.add(h.onAddItem.dispatch, h.onAddItem);
            return g
        },
        focus: function() {
            var g = this;
            if (g.keyboardNav) {
                g.keyboardNav.focus()
            }
        },
        update: function() {
            var i = this,
                j = i.settings,
                g = c.get("menu_" + i.id + "_tbl"),
                l = c.get("menu_" + i.id + "_co"),
                h, k;
            h = j.max_width ? Math.min(g.offsetWidth, j.max_width) : g.offsetWidth;
            k = j.max_height ? Math.min(g.offsetHeight, j.max_height) : g.offsetHeight;
            if (!c.boxModel) {
                i.element.setStyles({
                    width: h + 2,
                    height: k + 2
                })
            } else {
                i.element.setStyles({
                    width: h,
                    height: k
                })
            }
            if (j.max_width) {
                c.setStyle(l, "width", h)
            }
            if (j.max_height) {
                c.setStyle(l, "height", k);
                if (g.clientHeight < j.max_height) {
                    c.setStyle(l, "overflow", "hidden")
                }
            }
        },
        showMenu: function(p, n, r) {
            var z = this,
                A = z.settings,
                o, g = c.getViewPort(),
                u, l, v, q, i = 2,
                k, j, m = z.classPrefix;
            z.collapse(1);
            if (z.isMenuVisible) {
                return
            }
            if (!z.rendered) {
                o = c.add(z.settings.container, z.renderNode());
                f(z.items, function(h) {
                    h.postRender()
                });
                z.element = new b("menu_" + z.id, {
                    blocker: 1,
                    container: A.container
                })
            } else {
                o = c.get("menu_" + z.id)
            }
            if (!e.isOpera) {
                c.setStyles(o, {
                    left: -65535,
                    top: -65535
                })
            }
            c.show(o);
            z.update();
            p += A.offset_x || 0;
            n += A.offset_y || 0;
            g.w -= 4;
            g.h -= 4;
            if (A.constrain) {
                u = o.clientWidth - i;
                l = o.clientHeight - i;
                v = g.x + g.w;
                q = g.y + g.h;
                if ((p + A.vp_offset_x + u) > v) {
                    p = r ? r - u : Math.max(0, (v - A.vp_offset_x) - u)
                }
                if ((n + A.vp_offset_y + l) > q) {
                    n = Math.max(0, (q - A.vp_offset_y) - l)
                }
            }
            c.setStyles(o, {
                left: p,
                top: n
            });
            z.element.update();
            z.isMenuVisible = 1;
            z.mouseClickFunc = a.add(o, "click", function(s) {
                var h;
                s = s.target;
                if (s && (s = c.getParent(s, "tr")) && !c.hasClass(s, m + "ItemSub")) {
                    h = z.items[s.id];
                    if (h.isDisabled()) {
                        return
                    }
                    k = z;
                    while (k) {
                        if (k.hideMenu) {
                            k.hideMenu()
                        }
                        k = k.settings.parent
                    }
                    if (h.settings.onclick) {
                        h.settings.onclick(s)
                    }
                    return false
                }
            });
            if (z.hasMenus()) {
                z.mouseOverFunc = a.add(o, "mouseover", function(x) {
                    var h, t, s;
                    x = x.target;
                    if (x && (x = c.getParent(x, "tr"))) {
                        h = z.items[x.id];
                        if (z.lastMenu) {
                            z.lastMenu.collapse(1)
                        }
                        if (h.isDisabled()) {
                            return
                        }
                        if (x && c.hasClass(x, m + "ItemSub")) {
                            t = c.getRect(x);
                            h.showMenu((t.x + t.w - i), t.y - i, t.x);
                            z.lastMenu = h;
                            c.addClass(c.get(h.id).firstChild, m + "ItemActive")
                        }
                    }
                })
            }
            a.add(o, "keydown", z._keyHandler, z);
            z.onShowMenu.dispatch(z);
            if (A.keyboard_focus) {
                z._setupKeyboardNav()
            }
        },
        hideMenu: function(j) {
            var g = this,
                i = c.get("menu_" + g.id),
                h;
            if (!g.isMenuVisible) {
                return
            }
            if (g.keyboardNav) {
                g.keyboardNav.destroy()
            }
            a.remove(i, "mouseover", g.mouseOverFunc);
            a.remove(i, "click", g.mouseClickFunc);
            a.remove(i, "keydown", g._keyHandler);
            c.hide(i);
            g.isMenuVisible = 0;
            if (!j) {
                g.collapse(1)
            }
            if (g.element) {
                g.element.hide()
            }
            if (h = c.get(g.id)) {
                c.removeClass(h.firstChild, g.classPrefix + "ItemActive")
            }
            g.onHideMenu.dispatch(g)
        },
        add: function(i) {
            var g = this,
                h;
            i = g.parent(i);
            if (g.isRendered && (h = c.get("menu_" + g.id))) {
                g._add(c.select("tbody", h)[0], i)
            }
            return i
        },
        collapse: function(g) {
            this.parent(g);
            this.hideMenu(1)
        },
        remove: function(g) {
            c.remove(g.id);
            this.destroy();
            return this.parent(g)
        },
        destroy: function() {
            var g = this,
                h = c.get("menu_" + g.id);
            if (g.keyboardNav) {
                g.keyboardNav.destroy()
            }
            a.remove(h, "mouseover", g.mouseOverFunc);
            a.remove(c.select("a", h), "focus", g.mouseOverFunc);
            a.remove(h, "click", g.mouseClickFunc);
            a.remove(h, "keydown", g._keyHandler);
            if (g.element) {
                g.element.remove()
            }
            c.remove(h)
        },
        renderNode: function() {
            var i = this,
                j = i.settings,
                l, h, k, g;
            g = c.create("div", {
                role: "listbox",
                id: "menu_" + i.id,
                "class": j["class"],
                style: "position:absolute;left:0;top:0;z-index:200000;outline:0"
            });
            if (i.settings.parent) {
                c.setAttrib(g, "aria-parent", "menu_" + i.settings.parent.id)
            }
            k = c.add(g, "div", {
                role: "presentation",
                id: "menu_" + i.id + "_co",
                "class": i.classPrefix + (j["class"] ? " " + j["class"] : "")
            });
            i.element = new b("menu_" + i.id, {
                blocker: 1,
                container: j.container
            });
            if (j.menu_line) {
                c.add(k, "span", {
                    "class": i.classPrefix + "Line"
                })
            }
            l = c.add(k, "table", {
                role: "presentation",
                id: "menu_" + i.id + "_tbl",
                border: 0,
                cellPadding: 0,
                cellSpacing: 0
            });
            h = c.add(l, "tbody");
            f(i.items, function(m) {
                i._add(h, m)
            });
            i.rendered = true;
            return g
        },
        _setupKeyboardNav: function() {
            var i, h, g = this;
            i = c.get("menu_" + g.id);
            h = c.select("a[role=option]", "menu_" + g.id);
            h.splice(0, 0, i);
            g.keyboardNav = new e.ui.KeyboardNavigation({
                root: "menu_" + g.id,
                items: h,
                onCancel: function() {
                    g.hideMenu()
                },
                enableUpDown: true
            });
            i.focus()
        },
        _keyHandler: function(g) {
            var h = this,
                i;
            switch (g.keyCode) {
                case 37:
                    if (h.settings.parent) {
                        h.hideMenu();
                        h.settings.parent.focus();
                        a.cancel(g)
                    }
                    break;
                case 39:
                    if (h.mouseOverFunc) {
                        h.mouseOverFunc(g)
                    }
                    break
            }
        },
        _add: function(j, h) {
            var i, q = h.settings,
                p, l, k, m = this.classPrefix,
                g;
            if (q.separator) {
                l = c.add(j, "tr", {
                    id: h.id,
                    "class": m + "ItemSeparator"
                });
                c.add(l, "td", {
                    "class": m + "ItemSeparator"
                });
                if (i = l.previousSibling) {
                    c.addClass(i, "mceLast")
                }
                return
            }
            i = l = c.add(j, "tr", {
                id: h.id,
                "class": m + "Item " + m + "ItemEnabled"
            });
            i = k = c.add(i, q.titleItem ? "th" : "td");
            i = p = c.add(i, "a", {
                id: h.id + "_aria",
                role: q.titleItem ? "presentation" : "option",
                href: "javascript:;",
                onclick: "return false;",
                onmousedown: "return false;"
            });
            if (q.parent) {
                c.setAttrib(p, "aria-haspopup", "true");
                c.setAttrib(p, "aria-owns", "menu_" + h.id)
            }
            c.addClass(k, q["class"]);
            g = c.add(i, "span", {
                "class": "mceIcon" + (q.icon ? " mce_" + q.icon : "")
            });
            if (q.icon_src) {
                c.add(g, "img", {
                    src: q.icon_src
                })
            }
            i = c.add(i, q.element || "span", {
                "class": "mceText",
                title: h.settings.title
            }, h.settings.title);
            if (h.settings.style) {
                if (typeof h.settings.style == "function") {
                    h.settings.style = h.settings.style()
                }
                c.setAttrib(i, "style", h.settings.style)
            }
            if (j.childNodes.length == 1) {
                c.addClass(l, "mceFirst")
            }
            if ((i = l.previousSibling) && c.hasClass(i, m + "ItemSeparator")) {
                c.addClass(l, "mceFirst")
            }
            if (h.collapse) {
                c.addClass(l, m + "ItemSub")
            }
            if (i = l.previousSibling) {
                c.removeClass(i, "mceLast")
            }
            c.addClass(l, "mceLast")
        }
    })
})(tinymce);
(function(b) {
    var a = b.DOM;
    b.create("tinymce.ui.Button:tinymce.ui.Control", {
        Button: function(e, d, c) {
            this.parent(e, d, c);
            this.classPrefix = "mceButton"
        },
        renderHTML: function() {
            var f = this.classPrefix,
                e = this.settings,
                d, c;
            c = a.encode(e.label || "");
            d = '<a role="button" id="' + this.id + '" href="javascript:;" class="' + f + " " + f + "Enabled " + e["class"] + (c ? " " + f + "Labeled" : "") + '" onmousedown="return false;" onclick="return false;" aria-labelledby="' + this.id + '_voice" title="' + a.encode(e.title) + '">';
            if (e.image && !(this.editor && this.editor.forcedHighContrastMode)) {
                d += '<span class="mceIcon ' + e["class"] + '"><img class="mceIcon" src="' + e.image + '" alt="' + a.encode(e.title) + '" /></span>' + (c ? '<span class="' + f + 'Label">' + c + "</span>" : "")
            } else {
                d += '<span class="mceIcon ' + e["class"] + '"></span>' + (c ? '<span class="' + f + 'Label">' + c + "</span>" : "")
            }
            d += '<span class="mceVoiceLabel mceIconOnly" style="display: none;" id="' + this.id + '_voice">' + e.title + "</span>";
            d += "</a>";
            return d
        },
        postRender: function() {
            var d = this,
                e = d.settings,
                c;
            if (b.isIE && d.editor) {
                b.dom.Event.add(d.id, "mousedown", function(f) {
                    var g = d.editor.selection.getNode().nodeName;
                    c = g === "IMG" ? d.editor.selection.getBookmark() : null
                })
            }
            b.dom.Event.add(d.id, "click", function(f) {
                if (!d.isDisabled()) {
                    if (b.isIE && d.editor && c !== null) {
                        d.editor.selection.moveToBookmark(c)
                    }
                    return e.onclick.call(e.scope, f)
                }
            });
            b.dom.Event.add(d.id, "keyup", function(f) {
                if (!d.isDisabled() && f.keyCode == b.VK.SPACEBAR) {
                    return e.onclick.call(e.scope, f)
                }
            })
        }
    })
})(tinymce);
(function(e) {
    var d = e.DOM,
        b = e.dom.Event,
        f = e.each,
        a = e.util.Dispatcher,
        c;
    e.create("tinymce.ui.ListBox:tinymce.ui.Control", {
        ListBox: function(j, i, g) {
            var h = this;
            h.parent(j, i, g);
            h.items = [];
            h.onChange = new a(h);
            h.onPostRender = new a(h);
            h.onAdd = new a(h);
            h.onRenderMenu = new e.util.Dispatcher(this);
            h.classPrefix = "mceListBox";
            h.marked = {}
        },
        select: function(h) {
            var g = this,
                j, i;
            g.marked = {};
            if (h == c) {
                return g.selectByIndex(-1)
            }
            if (h && typeof(h) == "function") {
                i = h
            } else {
                i = function(k) {
                    return k == h
                }
            }
            if (h != g.selectedValue) {
                f(g.items, function(l, k) {
                    if (i(l.value)) {
                        j = 1;
                        g.selectByIndex(k);
                        return false
                    }
                });
                if (!j) {
                    g.selectByIndex(-1)
                }
            }
        },
        selectByIndex: function(g) {
            var i = this,
                j, k, h;
            i.marked = {};
            if (g != i.selectedIndex) {
                j = d.get(i.id + "_text");
                h = d.get(i.id + "_voiceDesc");
                k = i.items[g];
                if (k) {
                    i.selectedValue = k.value;
                    i.selectedIndex = g;
                    d.setHTML(j, d.encode(k.title));
                    d.setHTML(h, i.settings.title + " - " + k.title);
                    d.removeClass(j, "mceTitle");
                    d.setAttrib(i.id, "aria-valuenow", k.title)
                } else {
                    d.setHTML(j, d.encode(i.settings.title));
                    d.setHTML(h, d.encode(i.settings.title));
                    d.addClass(j, "mceTitle");
                    i.selectedValue = i.selectedIndex = null;
                    d.setAttrib(i.id, "aria-valuenow", i.settings.title)
                }
                j = 0
            }
        },
        mark: function(g) {
            this.marked[g] = true
        },
        add: function(j, g, i) {
            var h = this;
            i = i || {};
            i = e.extend(i, {
                title: j,
                value: g
            });
            h.items.push(i);
            h.onAdd.dispatch(h, i)
        },
        getLength: function() {
            return this.items.length
        },
        renderHTML: function() {
            var j = "",
                g = this,
                i = g.settings,
                k = g.classPrefix;
            j = '<span role="listbox" aria-haspopup="true" aria-labelledby="' + g.id + '_voiceDesc" aria-describedby="' + g.id + '_voiceDesc"><table role="presentation" tabindex="0" id="' + g.id + '" cellpadding="0" cellspacing="0" class="' + k + " " + k + "Enabled" + (i["class"] ? (" " + i["class"]) : "") + '"><tbody><tr>';
            j += "<td>" + d.createHTML("span", {
                id: g.id + "_voiceDesc",
                "class": "voiceLabel",
                style: "display:none;"
            }, g.settings.title);
            j += d.createHTML("a", {
                id: g.id + "_text",
                tabindex: -1,
                href: "javascript:;",
                "class": "mceText",
                onclick: "return false;",
                onmousedown: "return false;"
            }, d.encode(g.settings.title)) + "</td>";
            j += "<td>" + d.createHTML("a", {
                id: g.id + "_open",
                tabindex: -1,
                href: "javascript:;",
                "class": "mceOpen",
                onclick: "return false;",
                onmousedown: "return false;"
            }, '<span><span style="display:none;" class="mceIconOnly" aria-hidden="true">\u25BC</span></span>') + "</td>";
            j += "</tr></tbody></table></span>";
            return j
        },
        showMenu: function() {
            var h = this,
                j, i = d.get(this.id),
                g;
            if (h.isDisabled() || h.items.length === 0) {
                return
            }
            if (h.menu && h.menu.isMenuVisible) {
                return h.hideMenu()
            }
            if (!h.isMenuRendered) {
                h.renderMenu();
                h.isMenuRendered = true
            }
            j = d.getPos(i);
            g = h.menu;
            g.settings.offset_x = j.x;
            g.settings.offset_y = j.y;
            g.settings.keyboard_focus = !e.isOpera;
            f(h.items, function(k) {
                if (g.items[k.id]) {
                    g.items[k.id].setSelected(0)
                }
            });
            f(h.items, function(k) {
                if (g.items[k.id] && h.marked[k.value]) {
                    g.items[k.id].setSelected(1)
                }
                if (k.value === h.selectedValue) {
                    g.items[k.id].setSelected(1)
                }
            });
            g.showMenu(0, i.clientHeight);
            b.add(d.doc, "mousedown", h.hideMenu, h);
            d.addClass(h.id, h.classPrefix + "Selected")
        },
        hideMenu: function(h) {
            var g = this;
            if (g.menu && g.menu.isMenuVisible) {
                d.removeClass(g.id, g.classPrefix + "Selected");
                if (h && h.type == "mousedown" && (h.target.id == g.id + "_text" || h.target.id == g.id + "_open")) {
                    return
                }
                if (!h || !d.getParent(h.target, ".mceMenu")) {
                    d.removeClass(g.id, g.classPrefix + "Selected");
                    b.remove(d.doc, "mousedown", g.hideMenu, g);
                    g.menu.hideMenu()
                }
            }
        },
        renderMenu: function() {
            var h = this,
                g;
            g = h.settings.control_manager.createDropMenu(h.id + "_menu", {
                menu_line: 1,
                "class": h.classPrefix + "Menu mceNoIcons",
                max_width: 250,
                max_height: 150
            });
            g.onHideMenu.add(function() {
                h.hideMenu();
                h.focus()
            });
            g.add({
                title: h.settings.title,
                "class": "mceMenuItemTitle",
                onclick: function() {
                    if (h.settings.onselect("") !== false) {
                        h.select("")
                    }
                }
            });
            f(h.items, function(i) {
                if (i.value === c) {
                    g.add({
                        title: i.title,
                        role: "option",
                        "class": "mceMenuItemTitle",
                        onclick: function() {
                            if (h.settings.onselect("") !== false) {
                                h.select("")
                            }
                        }
                    })
                } else {
                    i.id = d.uniqueId();
                    i.role = "option";
                    i.onclick = function() {
                        if (h.settings.onselect(i.value) !== false) {
                            h.select(i.value)
                        }
                    };
                    g.add(i)
                }
            });
            h.onRenderMenu.dispatch(h, g);
            h.menu = g
        },
        postRender: function() {
            var g = this,
                h = g.classPrefix;
            b.add(g.id, "click", g.showMenu, g);
            b.add(g.id, "keydown", function(i) {
                if (i.keyCode == 32) {
                    g.showMenu(i);
                    b.cancel(i)
                }
            });
            b.add(g.id, "focus", function() {
                if (!g._focused) {
                    g.keyDownHandler = b.add(g.id, "keydown", function(i) {
                        if (i.keyCode == 40) {
                            g.showMenu();
                            b.cancel(i)
                        }
                    });
                    g.keyPressHandler = b.add(g.id, "keypress", function(j) {
                        var i;
                        if (j.keyCode == 13) {
                            i = g.selectedValue;
                            g.selectedValue = null;
                            b.cancel(j);
                            g.settings.onselect(i)
                        }
                    })
                }
                g._focused = 1
            });
            b.add(g.id, "blur", function() {
                b.remove(g.id, "keydown", g.keyDownHandler);
                b.remove(g.id, "keypress", g.keyPressHandler);
                g._focused = 0
            });
            if (e.isIE6 || !d.boxModel) {
                b.add(g.id, "mouseover", function() {
                    if (!d.hasClass(g.id, h + "Disabled")) {
                        d.addClass(g.id, h + "Hover")
                    }
                });
                b.add(g.id, "mouseout", function() {
                    if (!d.hasClass(g.id, h + "Disabled")) {
                        d.removeClass(g.id, h + "Hover")
                    }
                })
            }
            g.onPostRender.dispatch(g, d.get(g.id))
        },
        destroy: function() {
            this.parent();
            b.clear(this.id + "_text");
            b.clear(this.id + "_open")
        }
    })
})(tinymce);
(function(e) {
    var d = e.DOM,
        b = e.dom.Event,
        f = e.each,
        a = e.util.Dispatcher,
        c;
    e.create("tinymce.ui.NativeListBox:tinymce.ui.ListBox", {
        NativeListBox: function(h, g) {
            this.parent(h, g);
            this.classPrefix = "mceNativeListBox"
        },
        setDisabled: function(g) {
            d.get(this.id).disabled = g;
            this.setAriaProperty("disabled", g)
        },
        isDisabled: function() {
            return d.get(this.id).disabled
        },
        select: function(h) {
            var g = this,
                j, i;
            if (h == c) {
                return g.selectByIndex(-1)
            }
            if (h && typeof(h) == "function") {
                i = h
            } else {
                i = function(k) {
                    return k == h
                }
            }
            if (h != g.selectedValue) {
                f(g.items, function(l, k) {
                    if (i(l.value)) {
                        j = 1;
                        g.selectByIndex(k);
                        return false
                    }
                });
                if (!j) {
                    g.selectByIndex(-1)
                }
            }
        },
        selectByIndex: function(g) {
            d.get(this.id).selectedIndex = g + 1;
            this.selectedValue = this.items[g] ? this.items[g].value : null
        },
        add: function(k, h, g) {
            var j, i = this;
            g = g || {};
            g.value = h;
            if (i.isRendered()) {
                d.add(d.get(this.id), "option", g, k)
            }
            j = {
                title: k,
                value: h,
                attribs: g
            };
            i.items.push(j);
            i.onAdd.dispatch(i, j)
        },
        getLength: function() {
            return this.items.length
        },
        renderHTML: function() {
            var i, g = this;
            i = d.createHTML("option", {
                value: ""
            }, "-- " + g.settings.title + " --");
            f(g.items, function(h) {
                i += d.createHTML("option", {
                    value: h.value
                }, h.title)
            });
            i = d.createHTML("select", {
                id: g.id,
                "class": "mceNativeListBox",
                "aria-labelledby": g.id + "_aria"
            }, i);
            i += d.createHTML("span", {
                id: g.id + "_aria",
                style: "display: none"
            }, g.settings.title);
            return i
        },
        postRender: function() {
            var h = this,
                i, j = true;
            h.rendered = true;

            function g(l) {
                var k = h.items[l.target.selectedIndex - 1];
                if (k && (k = k.value)) {
                    h.onChange.dispatch(h, k);
                    if (h.settings.onselect) {
                        h.settings.onselect(k)
                    }
                }
            }
            b.add(h.id, "change", g);
            b.add(h.id, "keydown", function(l) {
                var k;
                b.remove(h.id, "change", i);
                j = false;
                k = b.add(h.id, "blur", function() {
                    if (j) {
                        return
                    }
                    j = true;
                    b.add(h.id, "change", g);
                    b.remove(h.id, "blur", k)
                });
                if (e.isWebKit && (l.keyCode == 37 || l.keyCode == 39)) {
                    return b.prevent(l)
                }
                if (l.keyCode == 13 || l.keyCode == 32) {
                    g(l);
                    return b.cancel(l)
                }
            });
            h.onPostRender.dispatch(h, d.get(h.id))
        }
    })
})(tinymce);
(function(c) {
    var b = c.DOM,
        a = c.dom.Event,
        d = c.each;
    c.create("tinymce.ui.MenuButton:tinymce.ui.Button", {
        MenuButton: function(g, f, e) {
            this.parent(g, f, e);
            this.onRenderMenu = new c.util.Dispatcher(this);
            f.menu_container = f.menu_container || b.doc.body
        },
        showMenu: function() {
            var g = this,
                j, i, h = b.get(g.id),
                f;
            if (g.isDisabled()) {
                return
            }
            if (!g.isMenuRendered) {
                g.renderMenu();
                g.isMenuRendered = true
            }
            if (g.isMenuVisible) {
                return g.hideMenu()
            }
            j = b.getPos(g.settings.menu_container);
            i = b.getPos(h);
            f = g.menu;
            f.settings.offset_x = i.x;
            f.settings.offset_y = i.y;
            f.settings.vp_offset_x = i.x;
            f.settings.vp_offset_y = i.y;
            f.settings.keyboard_focus = g._focused;
            f.showMenu(0, h.firstChild.clientHeight);
            a.add(b.doc, "mousedown", g.hideMenu, g);
            g.setState("Selected", 1);
            g.isMenuVisible = 1
        },
        renderMenu: function() {
            var f = this,
                e;
            e = f.settings.control_manager.createDropMenu(f.id + "_menu", {
                menu_line: 1,
                "class": this.classPrefix + "Menu",
                icons: f.settings.icons
            });
            e.onHideMenu.add(function() {
                f.hideMenu();
                f.focus()
            });
            f.onRenderMenu.dispatch(f, e);
            f.menu = e
        },
        hideMenu: function(g) {
            var f = this;
            if (g && g.type == "mousedown" && b.getParent(g.target, function(h) {
                    return h.id === f.id || h.id === f.id + "_open"
                })) {
                return
            }
            if (!g || !b.getParent(g.target, ".mceMenu")) {
                f.setState("Selected", 0);
                a.remove(b.doc, "mousedown", f.hideMenu, f);
                if (f.menu) {
                    f.menu.hideMenu()
                }
            }
            f.isMenuVisible = 0
        },
        postRender: function() {
            var e = this,
                f = e.settings;
            a.add(e.id, "click", function() {
                if (!e.isDisabled()) {
                    if (f.onclick) {
                        f.onclick(e.value)
                    }
                    e.showMenu()
                }
            })
        }
    })
})(tinymce);
(function(c) {
    var b = c.DOM,
        a = c.dom.Event,
        d = c.each;
    c.create("tinymce.ui.SplitButton:tinymce.ui.MenuButton", {
        SplitButton: function(g, f, e) {
            this.parent(g, f, e);
            this.classPrefix = "mceSplitButton"
        },
        renderHTML: function() {
            var i, f = this,
                g = f.settings,
                e;
            i = "<tbody><tr>";
            if (g.image) {
                e = b.createHTML("img ", {
                    src: g.image,
                    role: "presentation",
                    "class": "mceAction " + g["class"]
                })
            } else {
                e = b.createHTML("span", {
                    "class": "mceAction " + g["class"]
                }, "")
            }
            e += b.createHTML("span", {
                "class": "mceVoiceLabel mceIconOnly",
                id: f.id + "_voice",
                style: "display:none;"
            }, g.title);
            i += "<td >" + b.createHTML("a", {
                role: "button",
                id: f.id + "_action",
                tabindex: "-1",
                href: "javascript:;",
                "class": "mceAction " + g["class"],
                onclick: "return false;",
                onmousedown: "return false;",
                title: g.title
            }, e) + "</td>";
            e = b.createHTML("span", {
                "class": "mceOpen " + g["class"]
            }, '<span style="display:none;" class="mceIconOnly" aria-hidden="true">\u25BC</span>');
            i += "<td >" + b.createHTML("a", {
                role: "button",
                id: f.id + "_open",
                tabindex: "-1",
                href: "javascript:;",
                "class": "mceOpen " + g["class"],
                onclick: "return false;",
                onmousedown: "return false;",
                title: g.title
            }, e) + "</td>";
            i += "</tr></tbody>";
            i = b.createHTML("table", {
                role: "presentation",
                "class": "mceSplitButton mceSplitButtonEnabled " + g["class"],
                cellpadding: "0",
                cellspacing: "0",
                title: g.title
            }, i);
            return b.createHTML("div", {
                id: f.id,
                role: "button",
                tabindex: "0",
                "aria-labelledby": f.id + "_voice",
                "aria-haspopup": "true"
            }, i)
        },
        postRender: function() {
            var e = this,
                g = e.settings,
                f;
            if (g.onclick) {
                f = function(h) {
                    if (!e.isDisabled()) {
                        g.onclick(e.value);
                        a.cancel(h)
                    }
                };
                a.add(e.id + "_action", "click", f);
                a.add(e.id, ["click", "keydown"], function(h) {
                    var k = 32,
                        m = 14,
                        i = 13,
                        j = 38,
                        l = 40;
                    if ((h.keyCode === 32 || h.keyCode === 13 || h.keyCode === 14) && !h.altKey && !h.ctrlKey && !h.metaKey) {
                        f();
                        a.cancel(h)
                    } else {
                        if (h.type === "click" || h.keyCode === l) {
                            e.showMenu();
                            a.cancel(h)
                        }
                    }
                })
            }
            a.add(e.id + "_open", "click", function(h) {
                e.showMenu();
                a.cancel(h)
            });
            a.add([e.id, e.id + "_open"], "focus", function() {
                e._focused = 1
            });
            a.add([e.id, e.id + "_open"], "blur", function() {
                e._focused = 0
            });
            if (c.isIE6 || !b.boxModel) {
                a.add(e.id, "mouseover", function() {
                    if (!b.hasClass(e.id, "mceSplitButtonDisabled")) {
                        b.addClass(e.id, "mceSplitButtonHover")
                    }
                });
                a.add(e.id, "mouseout", function() {
                    if (!b.hasClass(e.id, "mceSplitButtonDisabled")) {
                        b.removeClass(e.id, "mceSplitButtonHover")
                    }
                })
            }
        },
        destroy: function() {
            this.parent();
            a.clear(this.id + "_action");
            a.clear(this.id + "_open");
            a.clear(this.id)
        }
    })
})(tinymce);
(function(d) {
    var c = d.DOM,
        a = d.dom.Event,
        b = d.is,
        e = d.each;
    d.create("tinymce.ui.ColorSplitButton:tinymce.ui.SplitButton", {
        ColorSplitButton: function(i, h, f) {
            var g = this;
            g.parent(i, h, f);
            g.settings = h = d.extend({
                colors: "000000,993300,333300,003300,003366,000080,333399,333333,800000,FF6600,808000,008000,008080,0000FF,666699,808080,FF0000,FF9900,99CC00,339966,33CCCC,3366FF,800080,999999,FF00FF,FFCC00,FFFF00,00FF00,00FFFF,00CCFF,993366,C0C0C0,FF99CC,FFCC99,FFFF99,CCFFCC,CCFFFF,99CCFF,CC99FF,FFFFFF",
                grid_width: 8,
                default_color: "#888888"
            }, g.settings);
            g.onShowMenu = new d.util.Dispatcher(g);
            g.onHideMenu = new d.util.Dispatcher(g);
            g.value = h.default_color
        },
        showMenu: function() {
            var f = this,
                g, j, i, h;
            if (f.isDisabled()) {
                return
            }
            if (!f.isMenuRendered) {
                f.renderMenu();
                f.isMenuRendered = true
            }
            if (f.isMenuVisible) {
                return f.hideMenu()
            }
            i = c.get(f.id);
            c.show(f.id + "_menu");
            c.addClass(i, "mceSplitButtonSelected");
            h = c.getPos(i);
            c.setStyles(f.id + "_menu", {
                left: h.x,
                top: h.y + i.firstChild.clientHeight,
                zIndex: 200000
            });
            i = 0;
            a.add(c.doc, "mousedown", f.hideMenu, f);
            f.onShowMenu.dispatch(f);
            if (f._focused) {
                f._keyHandler = a.add(f.id + "_menu", "keydown", function(k) {
                    if (k.keyCode == 27) {
                        f.hideMenu()
                    }
                });
                c.select("a", f.id + "_menu")[0].focus()
            }
            f.keyboardNav = new d.ui.KeyboardNavigation({
                root: f.id + "_menu",
                items: c.select("a", f.id + "_menu"),
                onCancel: function() {
                    f.hideMenu();
                    f.focus()
                }
            });
            f.keyboardNav.focus();
            f.isMenuVisible = 1
        },
        hideMenu: function(g) {
            var f = this;
            if (f.isMenuVisible) {
                if (g && g.type == "mousedown" && c.getParent(g.target, function(h) {
                        return h.id === f.id + "_open"
                    })) {
                    return
                }
                if (!g || !c.getParent(g.target, ".mceSplitButtonMenu")) {
                    c.removeClass(f.id, "mceSplitButtonSelected");
                    a.remove(c.doc, "mousedown", f.hideMenu, f);
                    a.remove(f.id + "_menu", "keydown", f._keyHandler);
                    c.hide(f.id + "_menu")
                }
                f.isMenuVisible = 0;
                f.onHideMenu.dispatch();
                f.keyboardNav.destroy()
            }
        },
        renderMenu: function() {
            var p = this,
                h, k = 0,
                q = p.settings,
                g, j, l, o, f;
            o = c.add(q.menu_container, "div", {
                role: "listbox",
                id: p.id + "_menu",
                "class": q.menu_class + " " + q["class"],
                style: "position:absolute;left:0;top:-1000px;"
            });
            h = c.add(o, "div", {
                "class": q["class"] + " mceSplitButtonMenu"
            });
            c.add(h, "span", {
                "class": "mceMenuLine"
            });
            g = c.add(h, "table", {
                role: "presentation",
                "class": "mceColorSplitMenu"
            });
            j = c.add(g, "tbody");
            k = 0;
            e(b(q.colors, "array") ? q.colors : q.colors.split(","), function(m) {
                m = m.replace(/^#/, "");
                if (!k--) {
                    l = c.add(j, "tr");
                    k = q.grid_width - 1
                }
                g = c.add(l, "td");
                var i = {
                    href: "javascript:;",
                    style: {
                        backgroundColor: "#" + m
                    },
                    title: p.editor.getLang("colors." + m, m),
                    "data-mce-color": "#" + m
                };
                if (!d.isIE) {
                    i.role = "option"
                }
                g = c.add(g, "a", i);
                if (p.editor.forcedHighContrastMode) {
                    g = c.add(g, "canvas", {
                        width: 16,
                        height: 16,
                        "aria-hidden": "true"
                    });
                    if (g.getContext && (f = g.getContext("2d"))) {
                        f.fillStyle = "#" + m;
                        f.fillRect(0, 0, 16, 16)
                    } else {
                        c.remove(g)
                    }
                }
            });
            if (q.more_colors_func) {
                g = c.add(j, "tr");
                g = c.add(g, "td", {
                    colspan: q.grid_width,
                    "class": "mceMoreColors"
                });
                g = c.add(g, "a", {
                    role: "option",
                    id: p.id + "_more",
                    href: "javascript:;",
                    onclick: "return false;",
                    "class": "mceMoreColors"
                }, q.more_colors_title);
                a.add(g, "click", function(i) {
                    q.more_colors_func.call(q.more_colors_scope || this);
                    return a.cancel(i)
                })
            }
            c.addClass(h, "mceColorSplitMenu");
            a.add(p.id + "_menu", "mousedown", function(i) {
                return a.cancel(i)
            });
            a.add(p.id + "_menu", "click", function(i) {
                var m;
                i = c.getParent(i.target, "a", j);
                if (i && i.nodeName.toLowerCase() == "a" && (m = i.getAttribute("data-mce-color"))) {
                    p.setColor(m)
                }
                return false
            });
            return o
        },
        setColor: function(f) {
            this.displayColor(f);
            this.hideMenu();
            this.settings.onselect(f)
        },
        displayColor: function(g) {
            var f = this;
            c.setStyle(f.id + "_preview", "backgroundColor", g);
            f.value = g
        },
        postRender: function() {
            var f = this,
                g = f.id;
            f.parent();
            c.add(g + "_action", "div", {
                id: g + "_preview",
                "class": "mceColorPreview"
            });
            c.setStyle(f.id + "_preview", "backgroundColor", f.value)
        },
        destroy: function() {
            var f = this;
            f.parent();
            a.clear(f.id + "_menu");
            a.clear(f.id + "_more");
            c.remove(f.id + "_menu");
            if (f.keyboardNav) {
                f.keyboardNav.destroy()
            }
        }
    })
})(tinymce);
(function(b) {
    var d = b.DOM,
        c = b.each,
        a = b.dom.Event;
    b.create("tinymce.ui.ToolbarGroup:tinymce.ui.Container", {
        renderHTML: function() {
            var f = this,
                i = [],
                e = f.controls,
                j = b.each,
                g = f.settings;
            i.push('<div id="' + f.id + '" role="group" aria-labelledby="' + f.id + '_voice">');
            i.push("<span role='application'>");
            i.push('<span id="' + f.id + '_voice" class="mceVoiceLabel" style="display:none;">' + d.encode(g.name) + "</span>");
            j(e, function(h) {
                i.push(h.renderHTML())
            });
            i.push("</span>");
            i.push("</div>");
            return i.join("")
        },
        focus: function() {
            var e = this;
            d.get(e.id).focus()
        },
        postRender: function() {
            var f = this,
                e = [];
            c(f.controls, function(g) {
                c(g.controls, function(h) {
                    if (h.id) {
                        e.push(h)
                    }
                })
            });
            f.keyNav = new b.ui.KeyboardNavigation({
                root: f.id,
                items: e,
                onCancel: function() {
                    if (b.isWebKit) {
                        d.get(f.editor.id + "_ifr").focus()
                    }
                    f.editor.focus()
                },
                excludeFromTabOrder: !f.settings.tab_focus_toolbar
            })
        },
        destroy: function() {
            var e = this;
            e.parent();
            e.keyNav.destroy();
            a.clear(e.id)
        }
    })
})(tinymce);
(function(a) {
    var c = a.DOM,
        b = a.each;
    a.create("tinymce.ui.Toolbar:tinymce.ui.Container", {
        renderHTML: function() {
            var m = this,
                f = "",
                j, k, n = m.settings,
                e, d, g, l;
            l = m.controls;
            for (e = 0; e < l.length; e++) {
                k = l[e];
                d = l[e - 1];
                g = l[e + 1];
                if (e === 0) {
                    j = "mceToolbarStart";
                    if (k.Button) {
                        j += " mceToolbarStartButton"
                    } else {
                        if (k.SplitButton) {
                            j += " mceToolbarStartSplitButton"
                        } else {
                            if (k.ListBox) {
                                j += " mceToolbarStartListBox"
                            }
                        }
                    }
                    f += c.createHTML("td", {
                        "class": j
                    }, c.createHTML("span", null, "<!-- IE -->"))
                }
                if (d && k.ListBox) {
                    if (d.Button || d.SplitButton) {
                        f += c.createHTML("td", {
                            "class": "mceToolbarEnd"
                        }, c.createHTML("span", null, "<!-- IE -->"))
                    }
                }
                if (c.stdMode) {
                    f += '<td style="position: relative">' + k.renderHTML() + "</td>"
                } else {
                    f += "<td>" + k.renderHTML() + "</td>"
                }
                if (g && k.ListBox) {
                    if (g.Button || g.SplitButton) {
                        f += c.createHTML("td", {
                            "class": "mceToolbarStart"
                        }, c.createHTML("span", null, "<!-- IE -->"))
                    }
                }
            }
            j = "mceToolbarEnd";
            if (k.Button) {
                j += " mceToolbarEndButton"
            } else {
                if (k.SplitButton) {
                    j += " mceToolbarEndSplitButton"
                } else {
                    if (k.ListBox) {
                        j += " mceToolbarEndListBox"
                    }
                }
            }
            f += c.createHTML("td", {
                "class": j
            }, c.createHTML("span", null, "<!-- IE -->"));
            return c.createHTML("table", {
                id: m.id,
                "class": "mceToolbar" + (n["class"] ? " " + n["class"] : ""),
                cellpadding: "0",
                cellspacing: "0",
                align: m.settings.align || "",
                role: "presentation",
                tabindex: "-1"
            }, "<tbody><tr>" + f + "</tr></tbody>")
        }
    })
})(tinymce);
(function(b) {
    var a = b.util.Dispatcher,
        c = b.each;
    b.create("tinymce.AddOnManager", {
        AddOnManager: function() {
            var d = this;
            d.items = [];
            d.urls = {};
            d.lookup = {};
            d.onAdd = new a(d)
        },
        get: function(d) {
            if (this.lookup[d]) {
                return this.lookup[d].instance
            } else {
                return undefined
            }
        },
        dependencies: function(e) {
            var d;
            if (this.lookup[e]) {
                d = this.lookup[e].dependencies
            }
            return d || []
        },
        requireLangPack: function(e) {
            var d = b.settings;
            if (d && d.language && d.language_load !== false) {
                b.ScriptLoader.add(this.urls[e] + "/langs/" + d.language + ".js")
            }
        },
        add: function(f, e, d) {
            this.items.push(e);
            this.lookup[f] = {
                instance: e,
                dependencies: d
            };
            this.onAdd.dispatch(this, f, e);
            return e
        },
        createUrl: function(d, e) {
            if (typeof e === "object") {
                return e
            } else {
                return {
                    prefix: d.prefix,
                    resource: e,
                    suffix: d.suffix
                }
            }
        },
        addComponents: function(f, d) {
            var e = this.urls[f];
            b.each(d, function(g) {
                b.ScriptLoader.add(e + "/" + g)
            })
        },
        load: function(j, f, d, h) {
            var g = this,
                e = f;

            function i() {
                var k = g.dependencies(j);
                b.each(k, function(m) {
                    var l = g.createUrl(f, m);
                    g.load(l.resource, l, undefined, undefined)
                });
                if (d) {
                    if (h) {
                        d.call(h)
                    } else {
                        d.call(b.ScriptLoader)
                    }
                }
            }
            if (g.urls[j]) {
                return
            }
            if (typeof f === "object") {
                e = f.prefix + f.resource + f.suffix
            }
            if (e.indexOf("/") !== 0 && e.indexOf("://") == -1) {
                e = b.baseURL + "/" + e
            }
            g.urls[j] = e.substring(0, e.lastIndexOf("/"));
            if (g.lookup[j]) {
                i()
            } else {
                b.ScriptLoader.add(e, i, h)
            }
        }
    });
    b.PluginManager = new b.AddOnManager();
    b.ThemeManager = new b.AddOnManager()
}(tinymce));
(function(j) {
    var g = j.each,
        d = j.extend,
        k = j.DOM,
        i = j.dom.Event,
        f = j.ThemeManager,
        b = j.PluginManager,
        e = j.explode,
        h = j.util.Dispatcher,
        a, c = 0;
    j.documentBaseURL = window.location.href.replace(/[\?#].*$/, "").replace(/[\/\\][^\/]+$/, "");
    if (!/[\/\\]$/.test(j.documentBaseURL)) {
        j.documentBaseURL += "/"
    }
    j.baseURL = new j.util.URI(j.documentBaseURL).toAbsolute(j.baseURL);
    j.baseURI = new j.util.URI(j.baseURL);
    j.onBeforeUnload = new h(j);
    i.add(window, "beforeunload", function(l) {
        j.onBeforeUnload.dispatch(j, l)
    });
    j.onAddEditor = new h(j);
    j.onRemoveEditor = new h(j);
    j.EditorManager = d(j, {
        editors: [],
        i18n: {},
        activeEditor: null,
        init: function(x) {
            var v = this,
                o, n = j.ScriptLoader,
                u, l = [],
                r;

            function q(t) {
                var s = t.id;
                if (!s) {
                    s = t.name;
                    if (s && !k.get(s)) {
                        s = t.name
                    } else {
                        s = k.uniqueId()
                    }
                    t.setAttribute("id", s)
                }
                return s
            }

            function m(z, A, t) {
                var y = z[A];
                if (!y) {
                    return
                }
                if (j.is(y, "string")) {
                    t = y.replace(/\.\w+$/, "");
                    t = t ? j.resolve(t) : 0;
                    y = j.resolve(y)
                }
                return y.apply(t || this, Array.prototype.slice.call(arguments, 2))
            }

            function p(t, s) {
                return s.constructor === RegExp ? s.test(t.className) : k.hasClass(t, s)
            }
            v.settings = x;
            i.bind(window, "ready", function() {
                var s, t;
                m(x, "onpageload");
                switch (x.mode) {
                    case "exact":
                        s = x.elements || "";
                        if (s.length > 0) {
                            g(e(s), function(y) {
                                if (k.get(y)) {
                                    r = new j.Editor(y, x);
                                    l.push(r);
                                    r.render(1)
                                } else {
                                    g(document.forms, function(z) {
                                        g(z.elements, function(A) {
                                            if (A.name === y) {
                                                y = "mce_editor_" + c++;
                                                k.setAttrib(A, "id", y);
                                                r = new j.Editor(y, x);
                                                l.push(r);
                                                r.render(1)
                                            }
                                        })
                                    })
                                }
                            })
                        }
                        break;
                    case "textareas":
                    case "specific_textareas":
                        g(k.select("textarea"), function(y) {
                            if (x.editor_deselector && p(y, x.editor_deselector)) {
                                return
                            }
                            if (!x.editor_selector || p(y, x.editor_selector)) {
                                r = new j.Editor(q(y), x);
                                l.push(r);
                                r.render(1)
                            }
                        });
                        break;
                    default:
                        if (x.types) {
                            g(x.types, function(y) {
                                g(k.select(y.selector), function(A) {
                                    var z = new j.Editor(q(A), j.extend({}, x, y));
                                    l.push(z);
                                    z.render(1)
                                })
                            })
                        } else {
                            if (x.selector) {
                                g(k.select(x.selector), function(z) {
                                    var y = new j.Editor(q(z), x);
                                    l.push(y);
                                    y.render(1)
                                })
                            }
                        }
                }
                if (x.oninit) {
                    s = t = 0;
                    g(l, function(y) {
                        t++;
                        if (!y.initialized) {
                            y.onInit.add(function() {
                                s++;
                                if (s == t) {
                                    m(x, "oninit")
                                }
                            })
                        } else {
                            s++
                        }
                        if (s == t) {
                            m(x, "oninit")
                        }
                    })
                }
            })
        },
        get: function(l) {
            if (l === a) {
                return this.editors
            }
            if (!this.editors.hasOwnProperty(l)) {
                return a
            }
            return this.editors[l]
        },
        getInstanceById: function(l) {
            return this.get(l)
        },
        add: function(m) {
            var l = this,
                n = l.editors;
            n[m.id] = m;
            n.push(m);
            l._setActive(m);
            l.onAddEditor.dispatch(l, m);
            return m
        },
        remove: function(n) {
            var m = this,
                l, o = m.editors;
            if (!o[n.id]) {
                return null
            }
            delete o[n.id];
            for (l = 0; l < o.length; l++) {
                if (o[l] == n) {
                    o.splice(l, 1);
                    break
                }
            }
            if (m.activeEditor == n) {
                m._setActive(o[0])
            }
            n.destroy();
            m.onRemoveEditor.dispatch(m, n);
            return n
        },
        execCommand: function(r, p, o) {
            var q = this,
                n = q.get(o),
                l;

            function m() {
                n.destroy();
                l.detachEvent("onunload", m);
                l = l.tinyMCE = l.tinymce = null
            }
            switch (r) {
                case "mceFocus":
                    n.focus();
                    return true;
                case "mceAddEditor":
                case "mceAddControl":
                    if (!q.get(o)) {
                        new j.Editor(o, q.settings).render()
                    }
                    return true;
                case "mceAddFrameControl":
                    l = o.window;
                    l.tinyMCE = tinyMCE;
                    l.tinymce = j;
                    j.DOM.doc = l.document;
                    j.DOM.win = l;
                    n = new j.Editor(o.element_id, o);
                    n.render();
                    if (j.isIE) {
                        l.attachEvent("onunload", m)
                    }
                    o.page_window = null;
                    return true;
                case "mceRemoveEditor":
                case "mceRemoveControl":
                    if (n) {
                        n.remove()
                    }
                    return true;
                case "mceToggleEditor":
                    if (!n) {
                        q.execCommand("mceAddControl", 0, o);
                        return true
                    }
                    if (n.isHidden()) {
                        n.show()
                    } else {
                        n.hide()
                    }
                    return true
            }
            if (q.activeEditor) {
                return q.activeEditor.execCommand(r, p, o)
            }
            return false
        },
        execInstanceCommand: function(p, o, n, m) {
            var l = this.get(p);
            if (l) {
                return l.execCommand(o, n, m)
            }
            return false
        },
        triggerSave: function() {
            g(this.editors, function(l) {
                l.save()
            })
        },
        addI18n: function(n, q) {
            var l, m = this.i18n;
            if (!j.is(n, "string")) {
                g(n, function(r, p) {
                    g(r, function(t, s) {
                        g(t, function(v, u) {
                            if (s === "common") {
                                m[p + "." + u] = v
                            } else {
                                m[p + "." + s + "." + u] = v
                            }
                        })
                    })
                })
            } else {
                g(q, function(r, p) {
                    m[n + "." + p] = r
                })
            }
        },
        _setActive: function(l) {
            this.selectedInstance = this.activeEditor = l
        }
    })
})(tinymce);
(function(k) {
    var l = k.DOM,
        j = k.dom.Event,
        f = k.extend,
        i = k.each,
        a = k.isGecko,
        b = k.isIE,
        e = k.isWebKit,
        d = k.is,
        h = k.ThemeManager,
        c = k.PluginManager,
        g = k.explode;
    k.create("tinymce.Editor", {
        Editor: function(p, o) {
            var m = this,
                n = true;
            m.settings = o = f({
                id: p,
                language: "en",
                theme: "advanced",
                skin: "default",
                delta_width: 0,
                delta_height: 0,
                popup_css: "",
                plugins: "",
                document_base_url: k.documentBaseURL,
                add_form_submit_trigger: n,
                submit_patch: n,
                add_unload_trigger: n,
                convert_urls: n,
                relative_urls: n,
                remove_script_host: n,
                table_inline_editing: false,
                object_resizing: n,
                accessibility_focus: n,
                doctype: k.isIE6 ? '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">' : "<!DOCTYPE>",
                visual: n,
                font_size_style_values: "xx-small,x-small,small,medium,large,x-large,xx-large",
                font_size_legacy_values: "xx-small,small,medium,large,x-large,xx-large,300%",
                apply_source_formatting: n,
                directionality: "ltr",
                forced_root_block: "p",
                hidden_input: n,
                padd_empty_editor: n,
                render_ui: n,
                indentation: "30px",
                fix_table_elements: n,
                inline_styles: n,
                convert_fonts_to_spans: n,
                indent: "simple",
                indent_before: "p,h1,h2,h3,h4,h5,h6,blockquote,div,title,style,pre,script,td,ul,li,area,table,thead,tfoot,tbody,tr,section,article,hgroup,aside,figure,option,optgroup,datalist",
                indent_after: "p,h1,h2,h3,h4,h5,h6,blockquote,div,title,style,pre,script,td,ul,li,area,table,thead,tfoot,tbody,tr,section,article,hgroup,aside,figure,option,optgroup,datalist",
                validate: n,
                entity_encoding: "named",
                url_converter: m.convertURL,
                url_converter_scope: m,
                ie7_compat: n
            }, o);
            m.id = m.editorId = p;
            m.isNotDirty = false;
            m.plugins = {};
            m.documentBaseURI = new k.util.URI(o.document_base_url || k.documentBaseURL, {
                base_uri: tinyMCE.baseURI
            });
            m.baseURI = k.baseURI;
            m.contentCSS = [];
            m.contentStyles = [];
            m.setupEvents();
            m.execCommands = {};
            m.queryStateCommands = {};
            m.queryValueCommands = {};
            m.execCallback("setup", m)
        },
        render: function(o) {
            var p = this,
                q = p.settings,
                r = p.id,
                m = k.ScriptLoader;
            if (!j.domLoaded) {
                j.add(window, "ready", function() {
                    p.render()
                });
                return
            }
            tinyMCE.settings = q;
            if (!p.getElement()) {
                return
            }
            if (k.isIDevice && !k.isIOS5) {
                return
            }
            if (!/TEXTAREA|INPUT/i.test(p.getElement().nodeName) && q.hidden_input && l.getParent(r, "form")) {
                l.insertAfter(l.create("input", {
                    type: "hidden",
                    name: r
                }), r)
            }
            if (!q.content_editable) {
                p.orgVisibility = p.getElement().style.visibility;
                p.getElement().style.visibility = "hidden"
            }
            if (k.WindowManager) {
                p.windowManager = new k.WindowManager(p)
            }
            if (q.encoding == "xml") {
                p.onGetContent.add(function(s, t) {
                    if (t.save) {
                        t.content = l.encode(t.content)
                    }
                })
            }
            if (q.add_form_submit_trigger) {
                p.onSubmit.addToTop(function() {
                    if (p.initialized) {
                        p.save();
                        p.isNotDirty = 1
                    }
                })
            }
            if (q.add_unload_trigger) {
                p._beforeUnload = tinyMCE.onBeforeUnload.add(function() {
                    if (p.initialized && !p.destroyed && !p.isHidden()) {
                        p.save({
                            format: "raw",
                            no_events: true
                        })
                    }
                })
            }
            k.addUnload(p.destroy, p);
            if (q.submit_patch) {
                p.onBeforeRenderUI.add(function() {
                    var s = p.getElement().form;
                    if (!s) {
                        return
                    }
                    if (s._mceOldSubmit) {
                        return
                    }
                    if (!s.submit.nodeType && !s.submit.length) {
                        p.formElement = s;
                        s._mceOldSubmit = s.submit;
                        s.submit = function() {
                            k.triggerSave();
                            p.isNotDirty = 1;
                            return p.formElement._mceOldSubmit(p.formElement)
                        }
                    }
                    s = null
                })
            }

            function n() {
                if (q.language && q.language_load !== false) {
                    m.add(k.baseURL + "/langs/" + q.language + ".js")
                }
                if (q.theme && typeof q.theme != "function" && q.theme.charAt(0) != "-" && !h.urls[q.theme]) {
                    h.load(q.theme, "themes/" + q.theme + "/editor_template" + k.suffix + ".js")
                }
                i(g(q.plugins), function(t) {
                    if (t && !c.urls[t]) {
                        if (t.charAt(0) == "-") {
                            t = t.substr(1, t.length);
                            var s = c.dependencies(t);
                            i(s, function(v) {
                                var u = {
                                    prefix: "plugins/",
                                    resource: v,
                                    suffix: "/editor_plugin" + k.suffix + ".js"
                                };
                                v = c.createUrl(u, v);
                                c.load(v.resource, v)
                            })
                        } else {
                            if (t == "safari") {
                                return
                            }
                            c.load(t, {
                                prefix: "plugins/",
                                resource: t,
                                suffix: "/editor_plugin" + k.suffix + ".js"
                            })
                        }
                    }
                });
                m.loadQueue(function() {
                    if (!p.removed) {
                        p.init()
                    }
                })
            }
            n()
        },
        init: function() {
            var q, G = this,
                H = G.settings,
                D, y, z, C = G.getElement(),
                p, m, E, v, B, F, x, r = [];
            k.add(G);
            H.aria_label = H.aria_label || l.getAttrib(C, "aria-label", G.getLang("aria.rich_text_area"));
            if (H.theme) {
                if (typeof H.theme != "function") {
                    H.theme = H.theme.replace(/-/, "");
                    p = h.get(H.theme);
                    G.theme = new p();
                    if (G.theme.init) {
                        G.theme.init(G, h.urls[H.theme] || k.documentBaseURL.replace(/\/$/, ""))
                    }
                } else {
                    G.theme = H.theme
                }
            }

            function A(s) {
                var t = c.get(s),
                    o = c.urls[s] || k.documentBaseURL.replace(/\/$/, ""),
                    n;
                if (t && k.inArray(r, s) === -1) {
                    i(c.dependencies(s), function(u) {
                        A(u)
                    });
                    n = new t(G, o);
                    G.plugins[s] = n;
                    if (n.init) {
                        n.init(G, o);
                        r.push(s)
                    }
                }
            }
            i(g(H.plugins.replace(/\-/g, "")), A);
            if (H.popup_css !== false) {
                if (H.popup_css) {
                    H.popup_css = G.documentBaseURI.toAbsolute(H.popup_css)
                } else {
                    H.popup_css = G.baseURI.toAbsolute("themes/" + H.theme + "/skins/" + H.skin + "/dialog.css")
                }
            }
            if (H.popup_css_add) {
                H.popup_css += "," + G.documentBaseURI.toAbsolute(H.popup_css_add)
            }
            G.controlManager = new k.ControlManager(G);
            G.onBeforeRenderUI.dispatch(G, G.controlManager);
            if (H.render_ui && G.theme) {
                G.orgDisplay = C.style.display;
                if (typeof H.theme != "function") {
                    D = H.width || C.style.width || C.offsetWidth;
                    y = H.height || C.style.height || C.offsetHeight;
                    z = H.min_height || 100;
                    F = /^[0-9\.]+(|px)$/i;
                    if (F.test("" + D)) {
                        D = Math.max(parseInt(D, 10) + (p.deltaWidth || 0), 100)
                    }
                    if (F.test("" + y)) {
                        y = Math.max(parseInt(y, 10) + (p.deltaHeight || 0), z)
                    }
                    p = G.theme.renderUI({
                        targetNode: C,
                        width: D,
                        height: y,
                        deltaWidth: H.delta_width,
                        deltaHeight: H.delta_height
                    });
                    l.setStyles(p.sizeContainer || p.editorContainer, {
                        width: D,
                        height: y
                    });
                    y = (p.iframeHeight || y) + (typeof(y) == "number" ? (p.deltaHeight || 0) : "");
                    if (y < z) {
                        y = z
                    }
                } else {
                    p = H.theme(G, C);
                    if (p.editorContainer.nodeType) {
                        p.editorContainer = p.editorContainer.id = p.editorContainer.id || G.id + "_parent"
                    }
                    if (p.iframeContainer.nodeType) {
                        p.iframeContainer = p.iframeContainer.id = p.iframeContainer.id || G.id + "_iframecontainer"
                    }
                    y = p.iframeHeight || C.offsetHeight;
                    if (b) {
                        G.onInit.add(function(n) {
                            n.dom.bind(n.getBody(), "beforedeactivate keydown", function() {
                                n.lastIERng = n.selection.getRng()
                            })
                        })
                    }
                }
                G.editorContainer = p.editorContainer
            }
            if (H.content_css) {
                i(g(H.content_css), function(n) {
                    G.contentCSS.push(G.documentBaseURI.toAbsolute(n))
                })
            }
            if (H.content_style) {
                G.contentStyles.push(H.content_style)
            }
            if (H.content_editable) {
                C = q = p = null;
                return G.initContentBody()
            }
            if (document.domain && location.hostname != document.domain) {
                k.relaxedDomain = document.domain
            }
            G.iframeHTML = H.doctype + '<html><head xmlns="http://www.w3.org/1999/xhtml">';
            if (H.document_base_url != k.documentBaseURL) {
                G.iframeHTML += '<base href="' + G.documentBaseURI.getURI() + '" />'
            }
            if (k.isIE8) {
                if (H.ie7_compat) {
                    G.iframeHTML += '<meta http-equiv="X-UA-Compatible" content="IE=7" />'
                } else {
                    G.iframeHTML += '<meta http-equiv="X-UA-Compatible" content="IE=edge" />'
                }
            }
            G.iframeHTML += '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            for (x = 0; x < G.contentCSS.length; x++) {
                G.iframeHTML += '<link type="text/css" rel="stylesheet" href="' + G.contentCSS[x] + '" />'
            }
            G.contentCSS = [];
            v = H.body_id || "tinymce";
            if (v.indexOf("=") != -1) {
                v = G.getParam("body_id", "", "hash");
                v = v[G.id] || v
            }
            B = H.body_class || "";
            if (B.indexOf("=") != -1) {
                B = G.getParam("body_class", "", "hash");
                B = B[G.id] || ""
            }
            G.iframeHTML += '</head><body id="' + v + '" class="mceContentBody ' + B + '" onload="window.parent.tinyMCE.get(\'' + G.id + "').onLoad.dispatch();\"><br></body></html>";
            if (k.relaxedDomain && (b || (k.isOpera && parseFloat(opera.version()) < 11))) {
                E = 'javascript:(function(){document.open();document.domain="' + document.domain + '";var ed = window.parent.tinyMCE.get("' + G.id + '");document.write(ed.iframeHTML);document.close();ed.initContentBody();})()'
            }
            q = l.add(p.iframeContainer, "iframe", {
                id: G.id + "_ifr",
                src: E || 'javascript:""',
                frameBorder: "0",
                allowTransparency: "true",
                title: H.aria_label,
                style: {
                    width: "100%",
                    height: y,
                    display: "block"
                }
            });
            G.contentAreaContainer = p.iframeContainer;
            if (p.editorContainer) {
                l.get(p.editorContainer).style.display = G.orgDisplay
            }
            C.style.visibility = G.orgVisibility;
            l.get(G.id).style.display = "none";
            l.setAttrib(G.id, "aria-hidden", true);
            if (!k.relaxedDomain || !E) {
                G.initContentBody()
            }
            C = q = p = null
        },
        initContentBody: function() {
            var n = this,
                p = n.settings,
                q = l.get(n.id),
                r = n.getDoc(),
                o, m, s;
            if ((!b || !k.relaxedDomain) && !p.content_editable) {
                r.open();
                r.write(n.iframeHTML);
                r.close();
                if (k.relaxedDomain) {
                    r.domain = k.relaxedDomain
                }
            }
            if (p.content_editable) {
                l.addClass(q, "mceContentBody");
                n.contentDocument = r = p.content_document || document;
                n.contentWindow = p.content_window || window;
                n.bodyElement = q;
                p.content_document = p.content_window = null
            }
            m = n.getBody();
            m.disabled = true;
            if (!p.readonly) {
                m.contentEditable = n.getParam("content_editable_state", true)
            }
            m.disabled = false;
            n.schema = new k.html.Schema(p);
            n.dom = new k.dom.DOMUtils(r, {
                keep_values: true,
                url_converter: n.convertURL,
                url_converter_scope: n,
                hex_colors: p.force_hex_style_colors,
                class_filter: p.class_filter,
                update_styles: true,
                root_element: p.content_editable ? n.id : null,
                schema: n.schema
            });
            n.parser = new k.html.DomParser(p, n.schema);
            n.parser.addAttributeFilter("src,href,style", function(t, u) {
                var v = t.length,
                    y, A = n.dom,
                    z, x;
                while (v--) {
                    y = t[v];
                    z = y.attr(u);
                    x = "data-mce-" + u;
                    if (!y.attributes.map[x]) {
                        if (u === "style") {
                            y.attr(x, A.serializeStyle(A.parseStyle(z), y.name))
                        } else {
                            y.attr(x, n.convertURL(z, u, y.name))
                        }
                    }
                }
            });
            n.parser.addNodeFilter("script", function(t, u) {
                var v = t.length,
                    x;
                while (v--) {
                    x = t[v];
                    x.attr("type", "mce-" + (x.attr("type") || "text/javascript"))
                }
            });
            n.parser.addNodeFilter("#cdata", function(t, u) {
                var v = t.length,
                    x;
                while (v--) {
                    x = t[v];
                    x.type = 8;
                    x.name = "#comment";
                    x.value = "[CDATA[" + x.value + "]]"
                }
            });
            n.parser.addNodeFilter("p,h1,h2,h3,h4,h5,h6,div", function(u, v) {
                var x = u.length,
                    y, t = n.schema.getNonEmptyElements();
                while (x--) {
                    y = u[x];
                    if (y.isEmpty(t)) {
                        y.empty().append(new k.html.Node("br", 1)).shortEnded = true
                    }
                }
            });
            n.serializer = new k.dom.Serializer(p, n.dom, n.schema);
            n.selection = new k.dom.Selection(n.dom, n.getWin(), n.serializer, n);
            n.formatter = new k.Formatter(n);
            n.undoManager = new k.UndoManager(n);
            n.forceBlocks = new k.ForceBlocks(n);
            n.enterKey = new k.EnterKey(n);
            n.editorCommands = new k.EditorCommands(n);
            n.onExecCommand.add(function(t, u) {
                if (!/^(FontName|FontSize)$/.test(u)) {
                    n.nodeChanged()
                }
            });
            n.serializer.onPreProcess.add(function(t, u) {
                return n.onPreProcess.dispatch(n, u, t)
            });
            n.serializer.onPostProcess.add(function(t, u) {
                return n.onPostProcess.dispatch(n, u, t)
            });
            n.onPreInit.dispatch(n);
            if (!p.browser_spellcheck && !p.gecko_spellcheck) {
                r.body.spellcheck = false
            }
            if (!p.readonly) {
                n.bindNativeEvents()
            }
            n.controlManager.onPostRender.dispatch(n, n.controlManager);
            n.onPostRender.dispatch(n);
            n.quirks = k.util.Quirks(n);
            if (p.directionality) {
                m.dir = p.directionality
            }
            if (p.nowrap) {
                m.style.whiteSpace = "nowrap"
            }
            if (p.protect) {
                n.onBeforeSetContent.add(function(t, u) {
                    i(p.protect, function(v) {
                        u.content = u.content.replace(v, function(x) {
                            return "<!--mce:protected " + escape(x) + "-->"
                        })
                    })
                })
            }
            n.onSetContent.add(function() {
                n.addVisual(n.getBody())
            });
            if (p.padd_empty_editor) {
                n.onPostProcess.add(function(t, u) {
                    u.content = u.content.replace(/^(<p[^>]*>(&nbsp;|&#160;|\s|\u00a0|)<\/p>[\r\n]*|<br \/>[\r\n]*)$/, "")
                })
            }
            n.load({
                initial: true,
                format: "html"
            });
            n.startContent = n.getContent({
                format: "raw"
            });
            n.initialized = true;
            n.onInit.dispatch(n);
            n.execCallback("setupcontent_callback", n.id, m, r);
            n.execCallback("init_instance_callback", n);
            n.focus(true);
            n.nodeChanged({
                initial: true
            });
            if (n.contentStyles.length > 0) {
                s = "";
                i(n.contentStyles, function(t) {
                    s += t + "\r\n"
                });
                n.dom.addStyle(s)
            }
            i(n.contentCSS, function(t) {
                n.dom.loadCSS(t)
            });
            if (p.auto_focus) {
                setTimeout(function() {
                    var t = k.get(p.auto_focus);
                    t.selection.select(t.getBody(), 1);
                    t.selection.collapse(1);
                    t.getBody().focus();
                    t.getWin().focus()
                }, 100)
            }
            q = r = m = null
        },
        focus: function(p) {
            var o, u = this,
                t = u.selection,
                q = u.settings.content_editable,
                n, r, s = u.getDoc(),
                m;
            if (!p) {
                if (u.lastIERng) {
                    t.setRng(u.lastIERng)
                }
                n = t.getRng();
                if (n.item) {
                    r = n.item(0)
                }
                u._refreshContentEditable();
                if (!q) {
                    u.getWin().focus()
                }
                if (k.isGecko || q) {
                    m = u.getBody();
                    if (m.setActive) {
                        m.setActive()
                    } else {
                        m.focus()
                    }
                    if (q) {
                        t.normalize()
                    }
                }
                if (r && r.ownerDocument == s) {
                    n = s.body.createControlRange();
                    n.addElement(r);
                    n.select()
                }
            }
            if (k.activeEditor != u) {
                if ((o = k.activeEditor) != null) {
                    o.onDeactivate.dispatch(o, u)
                }
                u.onActivate.dispatch(u, o)
            }
            k._setActive(u)
        },
        execCallback: function(q) {
            var m = this,
                p = m.settings[q],
                o;
            if (!p) {
                return
            }
            if (m.callbackLookup && (o = m.callbackLookup[q])) {
                p = o.func;
                o = o.scope
            }
            if (d(p, "string")) {
                o = p.replace(/\.\w+$/, "");
                o = o ? k.resolve(o) : 0;
                p = k.resolve(p);
                m.callbackLookup = m.callbackLookup || {};
                m.callbackLookup[q] = {
                    func: p,
                    scope: o
                }
            }
            return p.apply(o || m, Array.prototype.slice.call(arguments, 1))
        },
        translate: function(m) {
            var o = this.settings.language || "en",
                n = k.i18n;
            if (!m) {
                return ""
            }
            return n[o + "." + m] || m.replace(/\{\#([^\}]+)\}/g, function(q, p) {
                return n[o + "." + p] || "{#" + p + "}"
            })
        },
        getLang: function(o, m) {
            return k.i18n[(this.settings.language || "en") + "." + o] || (d(m) ? m : "{#" + o + "}")
        },
        getParam: function(t, q, m) {
            var r = k.trim,
                p = d(this.settings[t]) ? this.settings[t] : q,
                s;
            if (m === "hash") {
                s = {};
                if (d(p, "string")) {
                    i(p.indexOf("=") > 0 ? p.split(/[;,](?![^=;,]*(?:[;,]|$))/) : p.split(","), function(n) {
                        n = n.split("=");
                        if (n.length > 1) {
                            s[r(n[0])] = r(n[1])
                        } else {
                            s[r(n[0])] = r(n)
                        }
                    })
                } else {
                    s = p
                }
                return s
            }
            return p
        },
        nodeChanged: function(q) {
            var m = this,
                n = m.selection,
                p;
            if (m.initialized) {
                q = q || {};
                p = n.getStart() || m.getBody();
                p = b && p.ownerDocument != m.getDoc() ? m.getBody() : p;
                q.parents = [];
                m.dom.getParent(p, function(o) {
                    if (o.nodeName == "BODY") {
                        return true
                    }
                    q.parents.push(o)
                });
                m.onNodeChange.dispatch(m, q ? q.controlManager || m.controlManager : m.controlManager, p, n.isCollapsed(), q)
            }
        },
        addButton: function(n, o) {
            var m = this;
            m.buttons = m.buttons || {};
            m.buttons[n] = o
        },
        addCommand: function(m, o, n) {
            this.execCommands[m] = {
                func: o,
                scope: n || this
            }
        },
        addQueryStateHandler: function(m, o, n) {
            this.queryStateCommands[m] = {
                func: o,
                scope: n || this
            }
        },
        addQueryValueHandler: function(m, o, n) {
            this.queryValueCommands[m] = {
                func: o,
                scope: n || this
            }
        },
        addShortcut: function(o, q, m, p) {
            var n = this,
                r;
            if (n.settings.custom_shortcuts === false) {
                return false
            }
            n.shortcuts = n.shortcuts || {};
            if (d(m, "string")) {
                r = m;
                m = function() {
                    n.execCommand(r, false, null)
                }
            }
            if (d(m, "object")) {
                r = m;
                m = function() {
                    n.execCommand(r[0], r[1], r[2])
                }
            }
            i(g(o), function(s) {
                var t = {
                    func: m,
                    scope: p || this,
                    desc: n.translate(q),
                    alt: false,
                    ctrl: false,
                    shift: false
                };
                i(g(s, "+"), function(u) {
                    switch (u) {
                        case "alt":
                        case "ctrl":
                        case "shift":
                            t[u] = true;
                            break;
                        default:
                            t.charCode = u.charCodeAt(0);
                            t.keyCode = u.toUpperCase().charCodeAt(0)
                    }
                });
                n.shortcuts[(t.ctrl ? "ctrl" : "") + "," + (t.alt ? "alt" : "") + "," + (t.shift ? "shift" : "") + "," + t.keyCode] = t
            });
            return true
        },
        execCommand: function(u, r, x, m) {
            var p = this,
                q = 0,
                v, n;
            if (!/^(mceAddUndoLevel|mceEndUndoLevel|mceBeginUndoLevel|mceRepaint|SelectAll)$/.test(u) && (!m || !m.skip_focus)) {
                p.focus()
            }
            m = f({}, m);
            p.onBeforeExecCommand.dispatch(p, u, r, x, m);
            if (m.terminate) {
                return false
            }
            if (p.execCallback("execcommand_callback", p.id, p.selection.getNode(), u, r, x)) {
                p.onExecCommand.dispatch(p, u, r, x, m);
                return true
            }
            if (v = p.execCommands[u]) {
                n = v.func.call(v.scope, r, x);
                if (n !== true) {
                    p.onExecCommand.dispatch(p, u, r, x, m);
                    return n
                }
            }
            i(p.plugins, function(o) {
                if (o.execCommand && o.execCommand(u, r, x)) {
                    p.onExecCommand.dispatch(p, u, r, x, m);
                    q = 1;
                    return false
                }
            });
            if (q) {
                return true
            }
            if (p.theme && p.theme.execCommand && p.theme.execCommand(u, r, x)) {
                p.onExecCommand.dispatch(p, u, r, x, m);
                return true
            }
            if (p.editorCommands.execCommand(u, r, x)) {
                p.onExecCommand.dispatch(p, u, r, x, m);
                return true
            }
            p.getDoc().execCommand(u, r, x);
            p.onExecCommand.dispatch(p, u, r, x, m)
        },
        queryCommandState: function(q) {
            var n = this,
                r, p;
            if (n._isHidden()) {
                return
            }
            if (r = n.queryStateCommands[q]) {
                p = r.func.call(r.scope);
                if (p !== true) {
                    return p
                }
            }
            r = n.editorCommands.queryCommandState(q);
            if (r !== -1) {
                return r
            }
            try {
                return this.getDoc().queryCommandState(q)
            } catch (m) {}
        },
        queryCommandValue: function(r) {
            var n = this,
                q, p;
            if (n._isHidden()) {
                return
            }
            if (q = n.queryValueCommands[r]) {
                p = q.func.call(q.scope);
                if (p !== true) {
                    return p
                }
            }
            q = n.editorCommands.queryCommandValue(r);
            if (d(q)) {
                return q
            }
            try {
                return this.getDoc().queryCommandValue(r)
            } catch (m) {}
        },
        show: function() {
            var m = this;
            l.show(m.getContainer());
            l.hide(m.id);
            m.load()
        },
        hide: function() {
            var m = this,
                n = m.getDoc();
            if (b && n) {
                n.execCommand("SelectAll")
            }
            m.save();
            l.hide(m.getContainer());
            l.setStyle(m.id, "display", m.orgDisplay)
        },
        isHidden: function() {
            return !l.isHidden(this.id)
        },
        setProgressState: function(m, n, p) {
            this.onSetProgressState.dispatch(this, m, n, p);
            return m
        },
        load: function(q) {
            var m = this,
                p = m.getElement(),
                n;
            if (p) {
                q = q || {};
                q.load = true;
                n = m.setContent(d(p.value) ? p.value : p.innerHTML, q);
                q.element = p;
                if (!q.no_events) {
                    m.onLoadContent.dispatch(m, q)
                }
                q.element = p = null;
                return n
            }
        },
        save: function(r) {
            var m = this,
                q = m.getElement(),
                n, p;
            if (!q || !m.initialized) {
                return
            }
            r = r || {};
            r.save = true;
            r.element = q;
            n = r.content = m.getContent(r);
            if (!r.no_events) {
                m.onSaveContent.dispatch(m, r)
            }
            n = r.content;
            if (!/TEXTAREA|INPUT/i.test(q.nodeName)) {
                q.innerHTML = n;
                if (p = l.getParent(m.id, "form")) {
                    i(p.elements, function(o) {
                        if (o.name == m.id) {
                            o.value = n;
                            return false
                        }
                    })
                }
            } else {
                q.value = n
            }
            r.element = q = null;
            return n
        },
        setContent: function(r, p) {
            var o = this,
                n, m = o.getBody(),
                q;
            p = p || {};
            p.format = p.format || "html";
            p.set = true;
            p.content = r;
            if (!p.no_events) {
                o.onBeforeSetContent.dispatch(o, p)
            }
            r = p.content;
            if (!k.isIE && (r.length === 0 || /^\s+$/.test(r))) {
                q = o.settings.forced_root_block;
                if (q) {
                    r = "<" + q + '><br data-mce-bogus="1"></' + q + ">"
                } else {
                    r = '<br data-mce-bogus="1">'
                }
                m.innerHTML = r;
                o.selection.select(m, true);
                o.selection.collapse(true);
                return
            }
            if (p.format !== "raw") {
                r = new k.html.Serializer({}, o.schema).serialize(o.parser.parse(r))
            }
            p.content = k.trim(r);
            o.dom.setHTML(m, p.content);
            if (!p.no_events) {
                o.onSetContent.dispatch(o, p)
            }
            if (!o.settings.content_editable || document.activeElement === o.getBody()) {
                o.selection.normalize()
            }
            return p.content
        },
        getContent: function(o) {
            var n = this,
                p, m = n.getBody();
            o = o || {};
            o.format = o.format || "html";
            o.get = true;
            o.getInner = true;
            if (!o.no_events) {
                n.onBeforeGetContent.dispatch(n, o)
            }
            if (o.format == "raw") {
                p = m.innerHTML
            } else {
                if (o.format == "text") {
                    p = m.innerText || m.textContent
                } else {
                    p = n.serializer.serialize(m, o)
                }
            }
            if (o.format != "text") {
                o.content = k.trim(p)
            } else {
                o.content = p
            }
            if (!o.no_events) {
                n.onGetContent.dispatch(n, o)
            }
            return o.content
        },
        isDirty: function() {
            var m = this;
            return k.trim(m.startContent) != k.trim(m.getContent({
                format: "raw",
                no_events: 1
            })) && !m.isNotDirty
        },
        getContainer: function() {
            var m = this;
            if (!m.container) {
                m.container = l.get(m.editorContainer || m.id + "_parent")
            }
            return m.container
        },
        getContentAreaContainer: function() {
            return this.contentAreaContainer
        },
        getElement: function() {
            return l.get(this.settings.content_element || this.id)
        },
        getWin: function() {
            var m = this,
                n;
            if (!m.contentWindow) {
                n = l.get(m.id + "_ifr");
                if (n) {
                    m.contentWindow = n.contentWindow
                }
            }
            return m.contentWindow
        },
        getDoc: function() {
            var m = this,
                n;
            if (!m.contentDocument) {
                n = m.getWin();
                if (n) {
                    m.contentDocument = n.document
                }
            }
            return m.contentDocument
        },
        getBody: function() {
            return this.bodyElement || this.getDoc().body
        },
        convertURL: function(o, n, q) {
            var m = this,
                p = m.settings;
            if (p.urlconverter_callback) {
                return m.execCallback("urlconverter_callback", o, q, true, n)
            }
            if (!p.convert_urls || (q && q.nodeName == "LINK") || o.indexOf("file:") === 0) {
                return o
            }
            if (p.relative_urls) {
                return m.documentBaseURI.toRelative(o)
            }
            o = m.documentBaseURI.toAbsolute(o, p.remove_script_host);
            return o
        },
        addVisual: function(q) {
            var n = this,
                o = n.settings,
                p = n.dom,
                m;
            q = q || n.getBody();
            if (!d(n.hasVisual)) {
                n.hasVisual = o.visual
            }
            i(p.select("table,a", q), function(s) {
                var r;
                switch (s.nodeName) {
                    case "TABLE":
                        m = o.visual_table_class || "mceItemTable";
                        r = p.getAttrib(s, "border");
                        if (!r || r == "0") {
                            if (n.hasVisual) {
                                p.addClass(s, m)
                            } else {
                                p.removeClass(s, m)
                            }
                        }
                        return;
                    case "A":
                        if (!p.getAttrib(s, "href", false)) {
                            r = p.getAttrib(s, "name") || s.id;
                            m = "mceItemAnchor";
                            if (r) {
                                if (n.hasVisual) {
                                    p.addClass(s, m)
                                } else {
                                    p.removeClass(s, m)
                                }
                            }
                        }
                        return
                }
            });
            n.onVisualAid.dispatch(n, q, n.hasVisual)
        },
        remove: function() {
            var m = this,
                o = m.getContainer(),
                n = m.getDoc();
            if (!m.removed) {
                m.removed = 1;
                if (b && n) {
                    n.execCommand("SelectAll")
                }
                m.save();
                l.setStyle(m.id, "display", m.orgDisplay);
                if (!m.settings.content_editable) {
                    j.unbind(m.getWin());
                    j.unbind(m.getDoc())
                }
                j.unbind(m.getBody());
                j.clear(o);
                m.execCallback("remove_instance_callback", m);
                m.onRemove.dispatch(m);
                m.onExecCommand.listeners = [];
                k.remove(m);
                l.remove(o)
            }
        },
        destroy: function(n) {
            var m = this;
            if (m.destroyed) {
                return
            }
            if (a) {
                j.unbind(m.getDoc());
                j.unbind(m.getWin());
                j.unbind(m.getBody())
            }
            if (!n) {
                k.removeUnload(m.destroy);
                tinyMCE.onBeforeUnload.remove(m._beforeUnload);
                if (m.theme && m.theme.destroy) {
                    m.theme.destroy()
                }
                m.controlManager.destroy();
                m.selection.destroy();
                m.dom.destroy()
            }
            if (m.formElement) {
                m.formElement.submit = m.formElement._mceOldSubmit;
                m.formElement._mceOldSubmit = null
            }
            m.contentAreaContainer = m.formElement = m.container = m.settings.content_element = m.bodyElement = m.contentDocument = m.contentWindow = null;
            if (m.selection) {
                m.selection = m.selection.win = m.selection.dom = m.selection.dom.doc = null
            }
            m.destroyed = 1
        },
        _refreshContentEditable: function() {
            var n = this,
                m, o;
            if (n._isHidden()) {
                m = n.getBody();
                o = m.parentNode;
                o.removeChild(m);
                o.appendChild(m);
                m.focus()
            }
        },
        _isHidden: function() {
            var m;
            if (!a) {
                return 0
            }
            m = this.selection.getSel();
            return (!m || !m.rangeCount || m.rangeCount === 0)
        }
    })
})(tinymce);
(function(a) {
    var b = a.each;
    a.Editor.prototype.setupEvents = function() {
        var c = this,
            d = c.settings;
        b(["onPreInit", "onBeforeRenderUI", "onPostRender", "onLoad", "onInit", "onRemove", "onActivate", "onDeactivate", "onClick", "onEvent", "onMouseUp", "onMouseDown", "onDblClick", "onKeyDown", "onKeyUp", "onKeyPress", "onContextMenu", "onSubmit", "onReset", "onPaste", "onPreProcess", "onPostProcess", "onBeforeSetContent", "onBeforeGetContent", "onSetContent", "onGetContent", "onLoadContent", "onSaveContent", "onNodeChange", "onChange", "onBeforeExecCommand", "onExecCommand", "onUndo", "onRedo", "onVisualAid", "onSetProgressState", "onSetAttrib"], function(e) {
            c[e] = new a.util.Dispatcher(c)
        });
        if (d.cleanup_callback) {
            c.onBeforeSetContent.add(function(e, f) {
                f.content = e.execCallback("cleanup_callback", "insert_to_editor", f.content, f)
            });
            c.onPreProcess.add(function(e, f) {
                if (f.set) {
                    e.execCallback("cleanup_callback", "insert_to_editor_dom", f.node, f)
                }
                if (f.get) {
                    e.execCallback("cleanup_callback", "get_from_editor_dom", f.node, f)
                }
            });
            c.onPostProcess.add(function(e, f) {
                if (f.set) {
                    f.content = e.execCallback("cleanup_callback", "insert_to_editor", f.content, f)
                }
                if (f.get) {
                    f.content = e.execCallback("cleanup_callback", "get_from_editor", f.content, f)
                }
            })
        }
        if (d.save_callback) {
            c.onGetContent.add(function(e, f) {
                if (f.save) {
                    f.content = e.execCallback("save_callback", e.id, f.content, e.getBody())
                }
            })
        }
        if (d.handle_event_callback) {
            c.onEvent.add(function(f, g, h) {
                if (c.execCallback("handle_event_callback", g, f, h) === false) {
                    g.preventDefault();
                    g.stopPropagation()
                }
            })
        }
        if (d.handle_node_change_callback) {
            c.onNodeChange.add(function(f, e, g) {
                f.execCallback("handle_node_change_callback", f.id, g, -1, -1, true, f.selection.isCollapsed())
            })
        }
        if (d.save_callback) {
            c.onSaveContent.add(function(e, g) {
                var f = e.execCallback("save_callback", e.id, g.content, e.getBody());
                if (f) {
                    g.content = f
                }
            })
        }
        if (d.onchange_callback) {
            c.onChange.add(function(f, e) {
                f.execCallback("onchange_callback", f, e)
            })
        }
    };
    a.Editor.prototype.bindNativeEvents = function() {
        var l = this,
            f, d = l.settings,
            e = l.dom,
            h;
        h = {
            mouseup: "onMouseUp",
            mousedown: "onMouseDown",
            click: "onClick",
            keyup: "onKeyUp",
            keydown: "onKeyDown",
            keypress: "onKeyPress",
            submit: "onSubmit",
            reset: "onReset",
            contextmenu: "onContextMenu",
            dblclick: "onDblClick",
            paste: "onPaste"
        };

        function c(i, m) {
            var n = i.type;
            if (l.removed) {
                return
            }
            if (l.onEvent.dispatch(l, i, m) !== false) {
                l[h[i.fakeType || i.type]].dispatch(l, i, m)
            }
        }

        function j(i) {
            l.focus(true)
        }

        function k(i, m) {
            if (m.keyCode != 65 || !a.VK.metaKeyPressed(m)) {
                l.selection.normalize()
            }
            l.nodeChanged()
        }
        b(h, function(m, n) {
            var i = d.content_editable ? l.getBody() : l.getDoc();
            switch (n) {
                case "contextmenu":
                    e.bind(i, n, c);
                    break;
                case "paste":
                    e.bind(l.getBody(), n, c);
                    break;
                case "submit":
                case "reset":
                    e.bind(l.getElement().form || a.DOM.getParent(l.id, "form"), n, c);
                    break;
                default:
                    e.bind(i, n, c)
            }
        });
        e.bind(d.content_editable ? l.getBody() : (a.isGecko ? l.getDoc() : l.getWin()), "focus", function(i) {
            l.focus(true)
        });
        if (d.content_editable && a.isOpera) {
            e.bind(l.getBody(), "click", j);
            e.bind(l.getBody(), "keydown", j)
        }
        l.onMouseUp.add(k);
        l.onKeyUp.add(function(i, n) {
            var m = n.keyCode;
            if ((m >= 33 && m <= 36) || (m >= 37 && m <= 40) || m == 13 || m == 45 || m == 46 || m == 8 || (a.isMac && (m == 91 || m == 93)) || n.ctrlKey) {
                k(i, n)
            }
        });
        l.onReset.add(function() {
            l.setContent(l.startContent, {
                format: "raw"
            })
        });

        function g(m, i) {
            if (m.altKey || m.ctrlKey || m.metaKey) {
                b(l.shortcuts, function(n) {
                    var o = a.isMac ? m.metaKey : m.ctrlKey;
                    if (n.ctrl != o || n.alt != m.altKey || n.shift != m.shiftKey) {
                        return
                    }
                    if (m.keyCode == n.keyCode || (m.charCode && m.charCode == n.charCode)) {
                        m.preventDefault();
                        if (i) {
                            n.func.call(n.scope)
                        }
                        return true
                    }
                })
            }
        }
        l.onKeyUp.add(function(i, m) {
            g(m)
        });
        l.onKeyPress.add(function(i, m) {
            g(m)
        });
        l.onKeyDown.add(function(i, m) {
            g(m, true)
        });
        if (a.isOpera) {
            l.onClick.add(function(i, m) {
                m.preventDefault()
            })
        }
    }
})(tinymce);
(function(d) {
    var e = d.each,
        b, a = true,
        c = false;
    d.EditorCommands = function(n) {
        var m = n.dom,
            p = n.selection,
            j = {
                state: {},
                exec: {},
                value: {}
            },
            k = n.settings,
            q = n.formatter,
            o;

        function r(z, y, x) {
            var v;
            z = z.toLowerCase();
            if (v = j.exec[z]) {
                v(z, y, x);
                return a
            }
            return c
        }

        function l(x) {
            var v;
            x = x.toLowerCase();
            if (v = j.state[x]) {
                return v(x)
            }
            return -1
        }

        function h(x) {
            var v;
            x = x.toLowerCase();
            if (v = j.value[x]) {
                return v(x)
            }
            return c
        }

        function u(v, x) {
            x = x || "exec";
            e(v, function(z, y) {
                e(y.toLowerCase().split(","), function(A) {
                    j[x][A] = z
                })
            })
        }
        d.extend(this, {
            execCommand: r,
            queryCommandState: l,
            queryCommandValue: h,
            addCommands: u
        });

        function f(y, x, v) {
            if (x === b) {
                x = c
            }
            if (v === b) {
                v = null
            }
            return n.getDoc().execCommand(y, x, v)
        }

        function t(v) {
            return q.match(v)
        }

        function s(v, x) {
            q.toggle(v, x ? {
                value: x
            } : b)
        }

        function i(v) {
            o = p.getBookmark(v)
        }

        function g() {
            p.moveToBookmark(o)
        }
        u({
            "mceResetDesignMode,mceBeginUndoLevel": function() {},
            "mceEndUndoLevel,mceAddUndoLevel": function() {
                n.undoManager.add()
            },
            "Cut,Copy,Paste": function(z) {
                var y = n.getDoc(),
                    v;
                try {
                    f(z)
                } catch (x) {
                    v = a
                }
                if (v || !y.queryCommandSupported(z)) {
                    if (d.isGecko) {
                        n.windowManager.confirm(n.getLang("clipboard_msg"), function(A) {
                            if (A) {
                                open("http://www.mozilla.org/editor/midasdemo/securityprefs.html", "_blank")
                            }
                        })
                    } else {
                        n.windowManager.alert(n.getLang("clipboard_no_support"))
                    }
                }
            },
            unlink: function(v) {
                if (p.isCollapsed()) {
                    p.select(p.getNode())
                }
                f(v);
                p.collapse(c)
            },
            "JustifyLeft,JustifyCenter,JustifyRight,JustifyFull": function(v) {
                var x = v.substring(7);
                e("left,center,right,full".split(","), function(y) {
                    if (x != y) {
                        q.remove("align" + y)
                    }
                });
                s("align" + x);
                r("mceRepaint")
            },
            "InsertUnorderedList,InsertOrderedList": function(y) {
                var v, x;
                f(y);
                v = m.getParent(p.getNode(), "ol,ul");
                if (v) {
                    x = v.parentNode;
                    if (/^(H[1-6]|P|ADDRESS|PRE)$/.test(x.nodeName)) {
                        i();
                        m.split(x, v);
                        g()
                    }
                }
            },
            "Bold,Italic,Underline,Strikethrough,Superscript,Subscript": function(v) {
                s(v)
            },
            "ForeColor,HiliteColor,FontName": function(y, x, v) {
                s(y, v)
            },
            FontSize: function(z, y, x) {
                var v, A;
                if (x >= 1 && x <= 7) {
                    A = d.explode(k.font_size_style_values);
                    v = d.explode(k.font_size_classes);
                    if (v) {
                        x = v[x - 1] || x
                    } else {
                        x = A[x - 1] || x
                    }
                }
                s(z, x)
            },
            RemoveFormat: function(v) {
                q.remove(v)
            },
            mceBlockQuote: function(v) {
                s("blockquote")
            },
            FormatBlock: function(y, x, v) {
                return s(v || "p")
            },
            mceCleanup: function() {
                var v = p.getBookmark();
                n.setContent(n.getContent({
                    cleanup: a
                }), {
                    cleanup: a
                });
                p.moveToBookmark(v)
            },
            mceRemoveNode: function(z, y, x) {
                var v = x || p.getNode();
                if (v != n.getBody()) {
                    i();
                    n.dom.remove(v, a);
                    g()
                }
            },
            mceSelectNodeDepth: function(z, y, x) {
                var v = 0;
                m.getParent(p.getNode(), function(A) {
                    if (A.nodeType == 1 && v++ == x) {
                        p.select(A);
                        return c
                    }
                }, n.getBody())
            },
            mceSelectNode: function(y, x, v) {
                p.select(v)
            },
            mceInsertContent: function(B, I, K) {
                var y, J, E, z, F, G, D, C, L, x, A, M, v, H;
                y = n.parser;
                J = new d.html.Serializer({}, n.schema);
                v = '<span id="mce_marker" data-mce-type="bookmark">\uFEFF</span>';
                G = {
                    content: K,
                    format: "html"
                };
                p.onBeforeSetContent.dispatch(p, G);
                K = G.content;
                if (K.indexOf("{$caret}") == -1) {
                    K += "{$caret}"
                }
                K = K.replace(/\{\$caret\}/, v);
                if (!p.isCollapsed()) {
                    n.getDoc().execCommand("Delete", false, null)
                }
                E = p.getNode();
                G = {
                    context: E.nodeName.toLowerCase()
                };
                F = y.parse(K, G);
                A = F.lastChild;
                if (A.attr("id") == "mce_marker") {
                    D = A;
                    for (A = A.prev; A; A = A.walk(true)) {
                        if (A.type == 3 || !m.isBlock(A.name)) {
                            A.parent.insert(D, A, A.name === "br");
                            break
                        }
                    }
                }
                if (!G.invalid) {
                    K = J.serialize(F);
                    A = E.firstChild;
                    M = E.lastChild;
                    if (!A || (A === M && A.nodeName === "BR")) {
                        m.setHTML(E, K)
                    } else {
                        p.setContent(K)
                    }
                } else {
                    p.setContent(v);
                    E = p.getNode();
                    z = n.getBody();
                    if (E.nodeType == 9) {
                        E = A = z
                    } else {
                        A = E
                    }
                    while (A !== z) {
                        E = A;
                        A = A.parentNode
                    }
                    K = E == z ? z.innerHTML : m.getOuterHTML(E);
                    K = J.serialize(y.parse(K.replace(/<span (id="mce_marker"|id=mce_marker).+?<\/span>/i, function() {
                        return J.serialize(F)
                    })));
                    if (E == z) {
                        m.setHTML(z, K)
                    } else {
                        m.setOuterHTML(E, K)
                    }
                }
                D = m.get("mce_marker");
                C = m.getRect(D);
                L = m.getViewPort(n.getWin());
                if ((C.y + C.h > L.y + L.h || C.y < L.y) || (C.x > L.x + L.w || C.x < L.x)) {
                    H = d.isIE ? n.getDoc().documentElement : n.getBody();
                    H.scrollLeft = C.x;
                    H.scrollTop = C.y - L.h + 25
                }
                x = m.createRng();
                A = D.previousSibling;
                if (A && A.nodeType == 3) {
                    x.setStart(A, A.nodeValue.length)
                } else {
                    x.setStartBefore(D);
                    x.setEndBefore(D)
                }
                m.remove(D);
                p.setRng(x);
                p.onSetContent.dispatch(p, G);
                n.addVisual()
            },
            mceInsertRawHTML: function(y, x, v) {
                p.setContent("tiny_mce_marker");
                n.setContent(n.getContent().replace(/tiny_mce_marker/g, function() {
                    return v
                }))
            },
            mceToggleFormat: function(y, x, v) {
                s(v)
            },
            mceSetContent: function(y, x, v) {
                n.setContent(v)
            },
            "Indent,Outdent": function(z) {
                var x, v, y;
                x = k.indentation;
                v = /[a-z%]+$/i.exec(x);
                x = parseInt(x);
                if (!l("InsertUnorderedList") && !l("InsertOrderedList")) {
                    if (!k.forced_root_block && !m.getParent(p.getNode(), m.isBlock)) {
                        q.apply("div")
                    }
                    e(p.getSelectedBlocks(), function(A) {
                        if (z == "outdent") {
                            y = Math.max(0, parseInt(A.style.paddingLeft || 0) - x);
                            m.setStyle(A, "paddingLeft", y ? y + v : "")
                        } else {
                            m.setStyle(A, "paddingLeft", (parseInt(A.style.paddingLeft || 0) + x) + v)
                        }
                    })
                } else {
                    f(z)
                }
            },
            mceRepaint: function() {
                var x;
                if (d.isGecko) {
                    try {
                        i(a);
                        if (p.getSel()) {
                            p.getSel().selectAllChildren(n.getBody())
                        }
                        p.collapse(a);
                        g()
                    } catch (v) {}
                }
            },
            mceToggleFormat: function(y, x, v) {
                q.toggle(v)
            },
            InsertHorizontalRule: function() {
                n.execCommand("mceInsertContent", false, "<hr />")
            },
            mceToggleVisualAid: function() {
                n.hasVisual = !n.hasVisual;
                n.addVisual()
            },
            mceReplaceContent: function(y, x, v) {
                n.execCommand("mceInsertContent", false, v.replace(/\{\$selection\}/g, p.getContent({
                    format: "text"
                })))
            },
            mceInsertLink: function(z, y, x) {
                var v;
                if (typeof(x) == "string") {
                    x = {
                        href: x
                    }
                }
                v = m.getParent(p.getNode(), "a");
                x.href = x.href.replace(" ", "%20");
                if (!v || !x.href) {
                    q.remove("link")
                }
                if (x.href) {
                    q.apply("link", x, v)
                }
            },
            selectAll: function() {
                var x = m.getRoot(),
                    v = m.createRng();
                if (p.getRng().setStart) {
                    v.setStart(x, 0);
                    v.setEnd(x, x.childNodes.length);
                    p.setRng(v)
                } else {
                    f("SelectAll")
                }
            }
        });
        u({
            "JustifyLeft,JustifyCenter,JustifyRight,JustifyFull": function(z) {
                var x = "align" + z.substring(7);
                var v = p.isCollapsed() ? [m.getParent(p.getNode(), m.isBlock)] : p.getSelectedBlocks();
                var y = d.map(v, function(A) {
                    return !!q.matchNode(A, x)
                });
                return d.inArray(y, a) !== -1
            },
            "Bold,Italic,Underline,Strikethrough,Superscript,Subscript": function(v) {
                return t(v)
            },
            mceBlockQuote: function() {
                return t("blockquote")
            },
            Outdent: function() {
                var v;
                if (k.inline_styles) {
                    if ((v = m.getParent(p.getStart(), m.isBlock)) && parseInt(v.style.paddingLeft) > 0) {
                        return a
                    }
                    if ((v = m.getParent(p.getEnd(), m.isBlock)) && parseInt(v.style.paddingLeft) > 0) {
                        return a
                    }
                }
                return l("InsertUnorderedList") || l("InsertOrderedList") || (!k.inline_styles && !!m.getParent(p.getNode(), "BLOCKQUOTE"))
            },
            "InsertUnorderedList,InsertOrderedList": function(x) {
                var v = m.getParent(p.getNode(), "ul,ol");
                return v && (x === "insertunorderedlist" && v.tagName === "UL" || x === "insertorderedlist" && v.tagName === "OL")
            }
        }, "state");
        u({
            "FontSize,FontName": function(y) {
                var x = 0,
                    v;
                if (v = m.getParent(p.getNode(), "span")) {
                    if (y == "fontsize") {
                        x = v.style.fontSize
                    } else {
                        x = v.style.fontFamily.replace(/, /g, ",").replace(/[\'\"]/g, "").toLowerCase()
                    }
                }
                return x
            }
        }, "value");
        u({
            Undo: function() {
                n.undoManager.undo()
            },
            Redo: function() {
                n.undoManager.redo()
            }
        })
    }
})(tinymce);
(function(b) {
    var a = b.util.Dispatcher;
    b.UndoManager = function(h) {
        var l, i = 0,
            e = [],
            g, k, j, f;

        function c() {
            return b.trim(h.getContent({
                format: "raw",
                no_events: 1
            }).replace(/<span[^>]+data-mce-bogus[^>]+>[\u200B\uFEFF]+<\/span>/g, ""))
        }

        function d() {
            l.typing = false;
            l.add()
        }
        onBeforeAdd = new a(l);
        k = new a(l);
        j = new a(l);
        f = new a(l);
        k.add(function(m, n) {
            if (m.hasUndo()) {
                return h.onChange.dispatch(h, n, m)
            }
        });
        j.add(function(m, n) {
            return h.onUndo.dispatch(h, n, m)
        });
        f.add(function(m, n) {
            return h.onRedo.dispatch(h, n, m)
        });
        h.onInit.add(function() {
            l.add()
        });
        h.onBeforeExecCommand.add(function(m, p, o, q, n) {
            if (p != "Undo" && p != "Redo" && p != "mceRepaint" && (!n || !n.skip_undo)) {
                l.beforeChange()
            }
        });
        h.onExecCommand.add(function(m, p, o, q, n) {
            if (p != "Undo" && p != "Redo" && p != "mceRepaint" && (!n || !n.skip_undo)) {
                l.add()
            }
        });
        h.onSaveContent.add(d);
        h.dom.bind(h.dom.getRoot(), "dragend", d);
        h.dom.bind(h.getBody(), "focusout", function(m) {
            if (!h.removed && l.typing) {
                d()
            }
        });
        h.onKeyUp.add(function(m, o) {
            var n = o.keyCode;
            if ((n >= 33 && n <= 36) || (n >= 37 && n <= 40) || n == 45 || n == 13 || o.ctrlKey) {
                d()
            }
        });
        h.onKeyDown.add(function(m, o) {
            var n = o.keyCode;
            if ((n >= 33 && n <= 36) || (n >= 37 && n <= 40) || n == 45) {
                if (l.typing) {
                    d()
                }
                return
            }
            if ((n < 16 || n > 20) && n != 224 && n != 91 && !l.typing) {
                l.beforeChange();
                l.typing = true;
                l.add()
            }
        });
        h.onMouseDown.add(function(m, n) {
            if (l.typing) {
                d()
            }
        });
        h.addShortcut("ctrl+z", "undo_desc", "Undo");
        h.addShortcut("ctrl+y", "redo_desc", "Redo");
        l = {
            data: e,
            typing: false,
            onBeforeAdd: onBeforeAdd,
            onAdd: k,
            onUndo: j,
            onRedo: f,
            beforeChange: function() {
                g = h.selection.getBookmark(2, true)
            },
            add: function(p) {
                var m, n = h.settings,
                    o;
                p = p || {};
                p.content = c();
                l.onBeforeAdd.dispatch(l, p);
                o = e[i];
                if (o && o.content == p.content) {
                    return null
                }
                if (e[i]) {
                    e[i].beforeBookmark = g
                }
                if (n.custom_undo_redo_levels) {
                    if (e.length > n.custom_undo_redo_levels) {
                        for (m = 0; m < e.length - 1; m++) {
                            e[m] = e[m + 1]
                        }
                        e.length--;
                        i = e.length
                    }
                }
                p.bookmark = h.selection.getBookmark(2, true);
                if (i < e.length - 1) {
                    e.length = i + 1
                }
                e.push(p);
                i = e.length - 1;
                l.onAdd.dispatch(l, p);
                h.isNotDirty = 0;
                return p
            },
            undo: function() {
                var n, m;
                if (l.typing) {
                    l.add();
                    l.typing = false
                }
                if (i > 0) {
                    n = e[--i];
                    h.setContent(n.content, {
                        format: "raw"
                    });
                    h.selection.moveToBookmark(n.beforeBookmark);
                    l.onUndo.dispatch(l, n)
                }
                return n
            },
            redo: function() {
                var m;
                if (i < e.length - 1) {
                    m = e[++i];
                    h.setContent(m.content, {
                        format: "raw"
                    });
                    h.selection.moveToBookmark(m.bookmark);
                    l.onRedo.dispatch(l, m)
                }
                return m
            },
            clear: function() {
                e = [];
                i = 0;
                l.typing = false
            },
            hasUndo: function() {
                return i > 0 || this.typing
            },
            hasRedo: function() {
                return i < e.length - 1 && !this.typing
            }
        };
        return l
    }
})(tinymce);
tinymce.ForceBlocks = function(c) {
    var b = c.settings,
        e = c.dom,
        a = c.selection,
        d = c.schema.getBlockElements();

    function f() {
        var j = a.getStart(),
            h = c.getBody(),
            g, k, o, s, q, i, l, m = -16777215,
            p, r;
        if (!j || j.nodeType !== 1 || !b.forced_root_block) {
            return
        }
        while (j && j != h) {
            if (d[j.nodeName]) {
                return
            }
            j = j.parentNode
        }
        g = a.getRng();
        if (g.setStart) {
            k = g.startContainer;
            o = g.startOffset;
            s = g.endContainer;
            q = g.endOffset
        } else {
            if (g.item) {
                j = g.item(0);
                g = c.getDoc().body.createTextRange();
                g.moveToElementText(j)
            }
            r = g.parentElement().ownerDocument === c.getDoc();
            tmpRng = g.duplicate();
            tmpRng.collapse(true);
            o = tmpRng.move("character", m) * -1;
            if (!tmpRng.collapsed) {
                tmpRng = g.duplicate();
                tmpRng.collapse(false);
                q = (tmpRng.move("character", m) * -1) - o
            }
        }
        j = h.firstChild;
        while (j) {
            if (j.nodeType === 3 || (j.nodeType == 1 && !d[j.nodeName])) {
                if (j.nodeType === 3 && j.nodeValue.length == 0) {
                    l = j;
                    j = j.nextSibling;
                    e.remove(l);
                    continue
                }
                if (!i) {
                    i = e.create(b.forced_root_block);
                    j.parentNode.insertBefore(i, j);
                    p = true
                }
                l = j;
                j = j.nextSibling;
                i.appendChild(l)
            } else {
                i = null;
                j = j.nextSibling
            }
        }
        if (p) {
            if (g.setStart) {
                g.setStart(k, o);
                g.setEnd(s, q);
                a.setRng(g)
            } else {
                if (r) {
                    try {
                        g = c.getDoc().body.createTextRange();
                        g.moveToElementText(h);
                        g.collapse(true);
                        g.moveStart("character", o);
                        if (q > 0) {
                            g.moveEnd("character", q)
                        }
                        g.select()
                    } catch (n) {}
                }
            }
            c.nodeChanged()
        }
    }
    if (b.forced_root_block) {
        c.onKeyUp.add(f);
        c.onNodeChange.add(f)
    }
};
(function(c) {
    var b = c.DOM,
        a = c.dom.Event,
        d = c.each,
        e = c.extend;
    c.create("tinymce.ControlManager", {
        ControlManager: function(f, j) {
            var h = this,
                g;
            j = j || {};
            h.editor = f;
            h.controls = {};
            h.onAdd = new c.util.Dispatcher(h);
            h.onPostRender = new c.util.Dispatcher(h);
            h.prefix = j.prefix || f.id + "_";
            h._cls = {};
            h.onPostRender.add(function() {
                d(h.controls, function(i) {
                    i.postRender()
                })
            })
        },
        get: function(f) {
            return this.controls[this.prefix + f] || this.controls[f]
        },
        setActive: function(h, f) {
            var g = null;
            if (g = this.get(h)) {
                g.setActive(f)
            }
            return g
        },
        setDisabled: function(h, f) {
            var g = null;
            if (g = this.get(h)) {
                g.setDisabled(f)
            }
            return g
        },
        add: function(g) {
            var f = this;
            if (g) {
                f.controls[g.id] = g;
                f.onAdd.dispatch(g, f)
            }
            return g
        },
        createControl: function(j) {
            var o, k, g, h = this,
                m = h.editor,
                n, f;
            if (!h.controlFactories) {
                h.controlFactories = [];
                d(m.plugins, function(i) {
                    if (i.createControl) {
                        h.controlFactories.push(i)
                    }
                })
            }
            n = h.controlFactories;
            for (k = 0, g = n.length; k < g; k++) {
                o = n[k].createControl(j, h);
                if (o) {
                    return h.add(o)
                }
            }
            if (j === "|" || j === "separator") {
                return h.createSeparator()
            }
            if (m.buttons && (o = m.buttons[j])) {
                return h.createButton(j, o)
            }
            return h.add(o)
        },
        createDropMenu: function(f, n, h) {
            var m = this,
                i = m.editor,
                j, g, k, l;
            n = e({
                "class": "mceDropDown",
                constrain: i.settings.constrain_menus
            }, n);
            n["class"] = n["class"] + " " + i.getParam("skin") + "Skin";
            if (k = i.getParam("skin_variant")) {
                n["class"] += " " + i.getParam("skin") + "Skin" + k.substring(0, 1).toUpperCase() + k.substring(1)
            }
            n["class"] += i.settings.directionality == "rtl" ? " mceRtl" : "";
            f = m.prefix + f;
            l = h || m._cls.dropmenu || c.ui.DropMenu;
            j = m.controls[f] = new l(f, n);
            j.onAddItem.add(function(r, q) {
                var p = q.settings;
                p.title = i.getLang(p.title, p.title);
                if (!p.onclick) {
                    p.onclick = function(o) {
                        if (p.cmd) {
                            i.execCommand(p.cmd, p.ui || false, p.value)
                        }
                    }
                }
            });
            i.onRemove.add(function() {
                j.destroy()
            });
            if (c.isIE) {
                j.onShowMenu.add(function() {
                    i.focus();
                    g = i.selection.getBookmark(1)
                });
                j.onHideMenu.add(function() {
                    if (g) {
                        i.selection.moveToBookmark(g);
                        g = 0
                    }
                })
            }
            return m.add(j)
        },
        createListBox: function(f, n, h) {
            var l = this,
                j = l.editor,
                i, k, m;
            if (l.get(f)) {
                return null
            }
            n.title = j.translate(n.title);
            n.scope = n.scope || j;
            if (!n.onselect) {
                n.onselect = function(o) {
                    j.execCommand(n.cmd, n.ui || false, o || n.value)
                }
            }
            n = e({
                title: n.title,
                "class": "mce_" + f,
                scope: n.scope,
                control_manager: l
            }, n);
            f = l.prefix + f;

            function g(o) {
                return o.settings.use_accessible_selects && !c.isGecko
            }
            if (j.settings.use_native_selects || g(j)) {
                k = new c.ui.NativeListBox(f, n)
            } else {
                m = h || l._cls.listbox || c.ui.ListBox;
                k = new m(f, n, j)
            }
            l.controls[f] = k;
            if (c.isWebKit) {
                k.onPostRender.add(function(p, o) {
                    a.add(o, "mousedown", function() {
                        j.bookmark = j.selection.getBookmark(1)
                    });
                    a.add(o, "focus", function() {
                        j.selection.moveToBookmark(j.bookmark);
                        j.bookmark = null
                    })
                })
            }
            if (k.hideMenu) {
                j.onMouseDown.add(k.hideMenu, k)
            }
            return l.add(k)
        },
        createButton: function(m, i, l) {
            var h = this,
                g = h.editor,
                j, k, f;
            if (h.get(m)) {
                return null
            }
            i.title = g.translate(i.title);
            i.label = g.translate(i.label);
            i.scope = i.scope || g;
            if (!i.onclick && !i.menu_button) {
                i.onclick = function() {
                    g.execCommand(i.cmd, i.ui || false, i.value)
                }
            }
            i = e({
                title: i.title,
                "class": "mce_" + m,
                unavailable_prefix: g.getLang("unavailable", ""),
                scope: i.scope,
                control_manager: h
            }, i);
            m = h.prefix + m;
            if (i.menu_button) {
                f = l || h._cls.menubutton || c.ui.MenuButton;
                k = new f(m, i, g);
                g.onMouseDown.add(k.hideMenu, k)
            } else {
                f = h._cls.button || c.ui.Button;
                k = new f(m, i, g)
            }
            return h.add(k)
        },
        createMenuButton: function(h, f, g) {
            f = f || {};
            f.menu_button = 1;
            return this.createButton(h, f, g)
        },
        createSplitButton: function(m, i, l) {
            var h = this,
                g = h.editor,
                j, k, f;
            if (h.get(m)) {
                return null
            }
            i.title = g.translate(i.title);
            i.scope = i.scope || g;
            if (!i.onclick) {
                i.onclick = function(n) {
                    g.execCommand(i.cmd, i.ui || false, n || i.value)
                }
            }
            if (!i.onselect) {
                i.onselect = function(n) {
                    g.execCommand(i.cmd, i.ui || false, n || i.value)
                }
            }
            i = e({
                title: i.title,
                "class": "mce_" + m,
                scope: i.scope,
                control_manager: h
            }, i);
            m = h.prefix + m;
            f = l || h._cls.splitbutton || c.ui.SplitButton;
            k = h.add(new f(m, i, g));
            g.onMouseDown.add(k.hideMenu, k);
            return k
        },
        createColorSplitButton: function(f, n, h) {
            var l = this,
                j = l.editor,
                i, k, m, g;
            if (l.get(f)) {
                return null
            }
            n.title = j.translate(n.title);
            n.scope = n.scope || j;
            if (!n.onclick) {
                n.onclick = function(o) {
                    if (c.isIE) {
                        g = j.selection.getBookmark(1)
                    }
                    j.execCommand(n.cmd, n.ui || false, o || n.value)
                }
            }
            if (!n.onselect) {
                n.onselect = function(o) {
                    j.execCommand(n.cmd, n.ui || false, o || n.value)
                }
            }
            n = e({
                title: n.title,
                "class": "mce_" + f,
                menu_class: j.getParam("skin") + "Skin",
                scope: n.scope,
                more_colors_title: j.getLang("more_colors")
            }, n);
            f = l.prefix + f;
            m = h || l._cls.colorsplitbutton || c.ui.ColorSplitButton;
            k = new m(f, n, j);
            j.onMouseDown.add(k.hideMenu, k);
            j.onRemove.add(function() {
                k.destroy()
            });
            if (c.isIE) {
                k.onShowMenu.add(function() {
                    j.focus();
                    g = j.selection.getBookmark(1)
                });
                k.onHideMenu.add(function() {
                    if (g) {
                        j.selection.moveToBookmark(g);
                        g = 0
                    }
                })
            }
            return l.add(k)
        },
        createToolbar: function(k, h, j) {
            var i, g = this,
                f;
            k = g.prefix + k;
            f = j || g._cls.toolbar || c.ui.Toolbar;
            i = new f(k, h, g.editor);
            if (g.get(k)) {
                return null
            }
            return g.add(i)
        },
        createToolbarGroup: function(k, h, j) {
            var i, g = this,
                f;
            k = g.prefix + k;
            f = j || this._cls.toolbarGroup || c.ui.ToolbarGroup;
            i = new f(k, h, g.editor);
            if (g.get(k)) {
                return null
            }
            return g.add(i)
        },
        createSeparator: function(g) {
            var f = g || this._cls.separator || c.ui.Separator;
            return new f()
        },
        setControlType: function(g, f) {
            return this._cls[g.toLowerCase()] = f
        },
        destroy: function() {
            d(this.controls, function(f) {
                f.destroy()
            });
            this.controls = null
        }
    })
})(tinymce);
(function(d) {
    var a = d.util.Dispatcher,
        e = d.each,
        c = d.isIE,
        b = d.isOpera;
    d.create("tinymce.WindowManager", {
        WindowManager: function(f) {
            var g = this;
            g.editor = f;
            g.onOpen = new a(g);
            g.onClose = new a(g);
            g.params = {};
            g.features = {}
        },
        open: function(z, h) {
            var v = this,
                k = "",
                n, m, i = v.editor.settings.dialog_type == "modal",
                q, o, j, g = d.DOM.getViewPort(),
                r;
            z = z || {};
            h = h || {};
            o = b ? g.w : screen.width;
            j = b ? g.h : screen.height;
            z.name = z.name || "mc_" + new Date().getTime();
            z.width = parseInt(z.width || 320);
            z.height = parseInt(z.height || 240);
            z.resizable = true;
            z.left = z.left || parseInt(o / 2) - (z.width / 2);
            z.top = z.top || parseInt(j / 2) - (z.height / 2);
            h.inline = false;
            h.mce_width = z.width;
            h.mce_height = z.height;
            h.mce_auto_focus = z.auto_focus;
            if (i) {
                if (c) {
                    z.center = true;
                    z.help = false;
                    z.dialogWidth = z.width + "px";
                    z.dialogHeight = z.height + "px";
                    z.scroll = z.scrollbars || false
                }
            }
            e(z, function(p, f) {
                if (d.is(p, "boolean")) {
                    p = p ? "yes" : "no"
                }
                if (!/^(name|url)$/.test(f)) {
                    if (c && i) {
                        k += (k ? ";" : "") + f + ":" + p
                    } else {
                        k += (k ? "," : "") + f + "=" + p
                    }
                }
            });
            v.features = z;
            v.params = h;
            v.onOpen.dispatch(v, z, h);
            r = z.url || z.file;
            r = d._addVer(r);
            try {
                if (c && i) {
                    q = 1;
                    window.showModalDialog(r, window, k)
                } else {
                    q = window.open(r, z.name, k)
                }
            } catch (l) {}
            if (!q) {
                alert(v.editor.getLang("popup_blocked"))
            }
        },
        close: function(f) {
            f.close();
            this.onClose.dispatch(this)
        },
        createInstance: function(i, h, g, m, l, k) {
            var j = d.resolve(i);
            return new j(h, g, m, l, k)
        },
        confirm: function(h, f, i, g) {
            g = g || window;
            f.call(i || this, g.confirm(this._decode(this.editor.getLang(h, h))))
        },
        alert: function(h, f, j, g) {
            var i = this;
            g = g || window;
            g.alert(i._decode(i.editor.getLang(h, h)));
            if (f) {
                f.call(j || i)
            }
        },
        resizeBy: function(f, g, h) {
            h.resizeBy(f, g)
        },
        _decode: function(f) {
            return d.DOM.decode(f).replace(/\\n/g, "\n")
        }
    })
}(tinymce));
(function(a) {
    a.Formatter = function(aa) {
        var Q = {},
            T = a.each,
            c = aa.dom,
            r = aa.selection,
            t = a.dom.TreeWalker,
            N = new a.dom.RangeUtils(c),
            d = aa.schema.isValidChild,
            A = a.isArray,
            H = c.isBlock,
            m = aa.settings.forced_root_block,
            s = c.nodeIndex,
            G = "\uFEFF",
            e = /^(src|href|style)$/,
            X = false,
            C = true,
            P, D, x = c.getContentEditable;

        function I(ab) {
            return !!aa.schema.getTextBlocks()[ab.toLowerCase()]
        }

        function n(ac, ab) {
            return c.getParents(ac, ab, c.getRoot())
        }

        function b(ab) {
            return ab.nodeType === 1 && ab.id === "_mce_caret"
        }

        function j() {
            l({
                alignleft: [{
                    selector: "figure,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li",
                    styles: {
                        textAlign: "left"
                    },
                    defaultBlock: "div"
                }, {
                    selector: "img,table",
                    collapsed: false,
                    styles: {
                        "float": "left"
                    }
                }],
                aligncenter: [{
                    selector: "figure,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li",
                    styles: {
                        textAlign: "center"
                    },
                    defaultBlock: "div"
                }, {
                    selector: "img",
                    collapsed: false,
                    styles: {
                        display: "block",
                        marginLeft: "auto",
                        marginRight: "auto"
                    }
                }, {
                    selector: "table",
                    collapsed: false,
                    styles: {
                        marginLeft: "auto",
                        marginRight: "auto"
                    }
                }],
                alignright: [{
                    selector: "figure,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li",
                    styles: {
                        textAlign: "right"
                    },
                    defaultBlock: "div"
                }, {
                    selector: "img,table",
                    collapsed: false,
                    styles: {
                        "float": "right"
                    }
                }],
                alignfull: [{
                    selector: "figure,p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li",
                    styles: {
                        textAlign: "justify"
                    },
                    defaultBlock: "div"
                }],
                bold: [{
                    inline: "strong",
                    remove: "all"
                }, {
                    inline: "span",
                    styles: {
                        fontWeight: "bold"
                    }
                }, {
                    inline: "b",
                    remove: "all"
                }],
                italic: [{
                    inline: "em",
                    remove: "all"
                }, {
                    inline: "span",
                    styles: {
                        fontStyle: "italic"
                    }
                }, {
                    inline: "i",
                    remove: "all"
                }],
                underline: [{
                    inline: "span",
                    styles: {
                        textDecoration: "underline"
                    },
                    exact: true
                }, {
                    inline: "u",
                    remove: "all"
                }],
                strikethrough: [{
                    inline: "span",
                    styles: {
                        textDecoration: "line-through"
                    },
                    exact: true
                }, {
                    inline: "strike",
                    remove: "all"
                }],
                forecolor: {
                    inline: "span",
                    styles: {
                        color: "%value"
                    },
                    wrap_links: false
                },
                hilitecolor: {
                    inline: "span",
                    styles: {
                        backgroundColor: "%value"
                    },
                    wrap_links: false
                },
                fontname: {
                    inline: "span",
                    styles: {
                        fontFamily: "%value"
                    }
                },
                fontsize: {
                    inline: "span",
                    styles: {
                        fontSize: "%value"
                    }
                },
                fontsize_class: {
                    inline: "span",
                    attributes: {
                        "class": "%value"
                    }
                },
                blockquote: {
                    block: "blockquote",
                    wrapper: 1,
                    remove: "all"
                },
                subscript: {
                    inline: "sub"
                },
                superscript: {
                    inline: "sup"
                },
                link: {
                    inline: "a",
                    selector: "a",
                    remove: "all",
                    split: true,
                    deep: true,
                    onmatch: function(ab) {
                        return true
                    },
                    onformat: function(ad, ab, ac) {
                        T(ac, function(af, ae) {
                            c.setAttrib(ad, ae, af)
                        })
                    }
                },
                removeformat: [{
                    selector: "b,strong,em,i,font,u,strike",
                    remove: "all",
                    split: true,
                    expand: false,
                    block_expand: true,
                    deep: true
                }, {
                    selector: "span",
                    attributes: ["style", "class"],
                    remove: "empty",
                    split: true,
                    expand: false,
                    deep: true
                }, {
                    selector: "*",
                    attributes: ["style", "class"],
                    split: false,
                    expand: false,
                    deep: true
                }]
            });
            T("p h1 h2 h3 h4 h5 h6 div address pre div code dt dd samp".split(/\s/), function(ab) {
                l(ab, {
                    block: ab,
                    remove: "all"
                })
            });
            l(aa.settings.formats)
        }

        function W() {
            aa.addShortcut("ctrl+b", "bold_desc", "Bold");
            aa.addShortcut("ctrl+i", "italic_desc", "Italic");
            aa.addShortcut("ctrl+u", "underline_desc", "Underline");
            for (var ab = 1; ab <= 6; ab++) {
                aa.addShortcut("ctrl+" + ab, "", ["FormatBlock", false, "h" + ab])
            }
            aa.addShortcut("ctrl+7", "", ["FormatBlock", false, "p"]);
            aa.addShortcut("ctrl+8", "", ["FormatBlock", false, "div"]);
            aa.addShortcut("ctrl+9", "", ["FormatBlock", false, "address"])
        }

        function V(ab) {
            return ab ? Q[ab] : Q
        }

        function l(ab, ac) {
            if (ab) {
                if (typeof(ab) !== "string") {
                    T(ab, function(ae, ad) {
                        l(ad, ae)
                    })
                } else {
                    ac = ac.length ? ac : [ac];
                    T(ac, function(ad) {
                        if (ad.deep === D) {
                            ad.deep = !ad.selector
                        }
                        if (ad.split === D) {
                            ad.split = !ad.selector || ad.inline
                        }
                        if (ad.remove === D && ad.selector && !ad.inline) {
                            ad.remove = "none"
                        }
                        if (ad.selector && ad.inline) {
                            ad.mixed = true;
                            ad.block_expand = true
                        }
                        if (typeof(ad.classes) === "string") {
                            ad.classes = ad.classes.split(/\s+/)
                        }
                    });
                    Q[ab] = ac
                }
            }
        }
        var i = function(ac) {
            var ab;
            aa.dom.getParent(ac, function(ad) {
                ab = aa.dom.getStyle(ad, "text-decoration");
                return ab && ab !== "none"
            });
            return ab
        };
        var L = function(ab) {
            var ac;
            if (ab.nodeType === 1 && ab.parentNode && ab.parentNode.nodeType === 1) {
                ac = i(ab.parentNode);
                if (aa.dom.getStyle(ab, "color") && ac) {
                    aa.dom.setStyle(ab, "text-decoration", ac)
                } else {
                    if (aa.dom.getStyle(ab, "textdecoration") === ac) {
                        aa.dom.setStyle(ab, "text-decoration", null)
                    }
                }
            }
        };

        function Y(ae, al, ag) {
            var ah = V(ae),
                am = ah[0],
                ak, ac, aj, ai = r.isCollapsed();

            function ab(aq, ap) {
                ap = ap || am;
                if (aq) {
                    if (ap.onformat) {
                        ap.onformat(aq, ap, al, ag)
                    }
                    T(ap.styles, function(at, ar) {
                        c.setStyle(aq, ar, q(at, al))
                    });
                    T(ap.attributes, function(at, ar) {
                        c.setAttrib(aq, ar, q(at, al))
                    });
                    T(ap.classes, function(ar) {
                        ar = q(ar, al);
                        if (!c.hasClass(aq, ar)) {
                            c.addClass(aq, ar)
                        }
                    })
                }
            }

            function af() {
                function ar(ay, aw) {
                    var ax = new t(aw);
                    for (ag = ax.current(); ag; ag = ax.prev()) {
                        if (ag.childNodes.length > 1 || ag == ay || ag.tagName == "BR") {
                            return ag
                        }
                    }
                }
                var aq = aa.selection.getRng();
                var av = aq.startContainer;
                var ap = aq.endContainer;
                if (av != ap && aq.endOffset === 0) {
                    var au = ar(av, ap);
                    var at = au.nodeType == 3 ? au.length : au.childNodes.length;
                    aq.setEnd(au, at)
                }
                return aq
            }

            function ad(at, ay, aw, av, aq) {
                var ap = [],
                    ar = -1,
                    ax, aA = -1,
                    au = -1,
                    az;
                T(at.childNodes, function(aC, aB) {
                    if (aC.nodeName === "UL" || aC.nodeName === "OL") {
                        ar = aB;
                        ax = aC;
                        return false
                    }
                });
                T(at.childNodes, function(aC, aB) {
                    if (aC.nodeName === "SPAN" && c.getAttrib(aC, "data-mce-type") == "bookmark") {
                        if (aC.id == ay.id + "_start") {
                            aA = aB
                        } else {
                            if (aC.id == ay.id + "_end") {
                                au = aB
                            }
                        }
                    }
                });
                if (ar <= 0 || (aA < ar && au > ar)) {
                    T(a.grep(at.childNodes), aq);
                    return 0
                } else {
                    az = c.clone(aw, X);
                    T(a.grep(at.childNodes), function(aC, aB) {
                        if ((aA < ar && aB < ar) || (aA > ar && aB > ar)) {
                            ap.push(aC);
                            aC.parentNode.removeChild(aC)
                        }
                    });
                    if (aA < ar) {
                        at.insertBefore(az, ax)
                    } else {
                        if (aA > ar) {
                            at.insertBefore(az, ax.nextSibling)
                        }
                    }
                    av.push(az);
                    T(ap, function(aB) {
                        az.appendChild(aB)
                    });
                    return az
                }
            }

            function an(aq, at, aw) {
                var ap = [],
                    av, ar, au = true;
                av = am.inline || am.block;
                ar = c.create(av);
                ab(ar);
                N.walk(aq, function(ax) {
                    var ay;

                    function az(aA) {
                        var aF, aD, aB, aC, aE;
                        aE = au;
                        aF = aA.nodeName.toLowerCase();
                        aD = aA.parentNode.nodeName.toLowerCase();
                        if (aA.nodeType === 1 && x(aA)) {
                            aE = au;
                            au = x(aA) === "true";
                            aC = true
                        }
                        if (g(aF, "br")) {
                            ay = 0;
                            if (am.block) {
                                c.remove(aA)
                            }
                            return
                        }
                        if (am.wrapper && y(aA, ae, al)) {
                            ay = 0;
                            return
                        }
                        if (au && !aC && am.block && !am.wrapper && I(aF)) {
                            aA = c.rename(aA, av);
                            ab(aA);
                            ap.push(aA);
                            ay = 0;
                            return
                        }
                        if (am.selector) {
                            T(ah, function(aG) {
                                if ("collapsed" in aG && aG.collapsed !== ai) {
                                    return
                                }
                                if (c.is(aA, aG.selector) && !b(aA)) {
                                    ab(aA, aG);
                                    aB = true
                                }
                            });
                            if (!am.inline || aB) {
                                ay = 0;
                                return
                            }
                        }
                        if (au && !aC && d(av, aF) && d(aD, av) && !(!aw && aA.nodeType === 3 && aA.nodeValue.length === 1 && aA.nodeValue.charCodeAt(0) === 65279) && !b(aA)) {
                            if (!ay) {
                                ay = c.clone(ar, X);
                                aA.parentNode.insertBefore(ay, aA);
                                ap.push(ay)
                            }
                            ay.appendChild(aA)
                        } else {
                            if (aF == "li" && at) {
                                ay = ad(aA, at, ar, ap, az)
                            } else {
                                ay = 0;
                                T(a.grep(aA.childNodes), az);
                                if (aC) {
                                    au = aE
                                }
                                ay = 0
                            }
                        }
                    }
                    T(ax, az)
                });
                if (am.wrap_links === false) {
                    T(ap, function(ax) {
                        function ay(aC) {
                            var aB, aA, az;
                            if (aC.nodeName === "A") {
                                aA = c.clone(ar, X);
                                ap.push(aA);
                                az = a.grep(aC.childNodes);
                                for (aB = 0; aB < az.length; aB++) {
                                    aA.appendChild(az[aB])
                                }
                                aC.appendChild(aA)
                            }
                            T(a.grep(aC.childNodes), ay)
                        }
                        ay(ax)
                    })
                }
                T(ap, function(az) {
                    var ax;

                    function aA(aC) {
                        var aB = 0;
                        T(aC.childNodes, function(aD) {
                            if (!f(aD) && !K(aD)) {
                                aB++
                            }
                        });
                        return aB
                    }

                    function ay(aB) {
                        var aD, aC;
                        T(aB.childNodes, function(aE) {
                            if (aE.nodeType == 1 && !K(aE) && !b(aE)) {
                                aD = aE;
                                return X
                            }
                        });
                        if (aD && h(aD, am)) {
                            aC = c.clone(aD, X);
                            ab(aC);
                            c.replace(aC, aB, C);
                            c.remove(aD, 1)
                        }
                        return aC || aB
                    }
                    ax = aA(az);
                    if ((ap.length > 1 || !H(az)) && ax === 0) {
                        c.remove(az, 1);
                        return
                    }
                    if (am.inline || am.wrapper) {
                        if (!am.exact && ax === 1) {
                            az = ay(az)
                        }
                        T(ah, function(aB) {
                            T(c.select(aB.inline, az), function(aD) {
                                var aC;
                                if (aB.wrap_links === false) {
                                    aC = aD.parentNode;
                                    do {
                                        if (aC.nodeName === "A") {
                                            return
                                        }
                                    } while (aC = aC.parentNode)
                                }
                                Z(aB, al, aD, aB.exact ? aD : null)
                            })
                        });
                        if (y(az.parentNode, ae, al)) {
                            c.remove(az, 1);
                            az = 0;
                            return C
                        }
                        if (am.merge_with_parents) {
                            c.getParent(az.parentNode, function(aB) {
                                if (y(aB, ae, al)) {
                                    c.remove(az, 1);
                                    az = 0;
                                    return C
                                }
                            })
                        }
                        if (az && am.merge_siblings !== false) {
                            az = u(E(az), az);
                            az = u(az, E(az, C))
                        }
                    }
                })
            }
            if (am) {
                if (ag) {
                    if (ag.nodeType) {
                        ac = c.createRng();
                        ac.setStartBefore(ag);
                        ac.setEndAfter(ag);
                        an(p(ac, ah), null, true)
                    } else {
                        an(ag, null, true)
                    }
                } else {
                    if (!ai || !am.inline || c.select("td.mceSelected,th.mceSelected").length) {
                        var ao = aa.selection.getNode();
                        if (!m && ah[0].defaultBlock && !c.getParent(ao, c.isBlock)) {
                            Y(ah[0].defaultBlock)
                        }
                        aa.selection.setRng(af());
                        ak = r.getBookmark();
                        an(p(r.getRng(C), ah), ak);
                        if (am.styles && (am.styles.color || am.styles.textDecoration)) {
                            a.walk(ao, L, "childNodes");
                            L(ao)
                        }
                        r.moveToBookmark(ak);
                        R(r.getRng(C));
                        aa.nodeChanged()
                    } else {
                        U("apply", ae, al)
                    }
                }
            }
        }

        function B(ad, am, af) {
            var ag = V(ad),
                ao = ag[0],
                ak, aj, ac, al = true;

            function ae(av) {
                var au, at, ar, aq, ax, aw;
                if (av.nodeType === 3) {
                    return
                }
                if (av.nodeType === 1 && x(av)) {
                    ax = al;
                    al = x(av) === "true";
                    aw = true
                }
                au = a.grep(av.childNodes);
                if (al && !aw) {
                    for (at = 0, ar = ag.length; at < ar; at++) {
                        if (Z(ag[at], am, av, av)) {
                            break
                        }
                    }
                }
                if (ao.deep) {
                    if (au.length) {
                        for (at = 0, ar = au.length; at < ar; at++) {
                            ae(au[at])
                        }
                        if (aw) {
                            al = ax
                        }
                    }
                }
            }

            function ah(aq) {
                var ar;
                T(n(aq.parentNode).reverse(), function(at) {
                    var au;
                    if (!ar && at.id != "_start" && at.id != "_end") {
                        au = y(at, ad, am);
                        if (au && au.split !== false) {
                            ar = at
                        }
                    }
                });
                return ar
            }

            function ab(au, aq, aw, az) {
                var aA, ay, ax, at, av, ar;
                if (au) {
                    ar = au.parentNode;
                    for (aA = aq.parentNode; aA && aA != ar; aA = aA.parentNode) {
                        ay = c.clone(aA, X);
                        for (av = 0; av < ag.length; av++) {
                            if (Z(ag[av], am, ay, ay)) {
                                ay = 0;
                                break
                            }
                        }
                        if (ay) {
                            if (ax) {
                                ay.appendChild(ax)
                            }
                            if (!at) {
                                at = ay
                            }
                            ax = ay
                        }
                    }
                    if (az && (!ao.mixed || !H(au))) {
                        aq = c.split(au, aq)
                    }
                    if (ax) {
                        aw.parentNode.insertBefore(ax, aw);
                        at.appendChild(aw)
                    }
                }
                return aq
            }

            function an(aq) {
                return ab(ah(aq), aq, aq, true)
            }

            function ai(at) {
                var ar = c.get(at ? "_start" : "_end"),
                    aq = ar[at ? "firstChild" : "lastChild"];
                if (K(aq)) {
                    aq = aq[at ? "firstChild" : "lastChild"]
                }
                c.remove(ar, true);
                return aq
            }

            function ap(aq) {
                var at, au, ar;
                aq = p(aq, ag, C);
                if (ao.split) {
                    at = M(aq, C);
                    au = M(aq);
                    if (at != au) {
                        if (/^(TR|TD)$/.test(at.nodeName) && at.firstChild) {
                            at = (at.nodeName == "TD" ? at.firstChild : at.firstChild.firstChild) || at
                        }
                        at = S(at, "span", {
                            id: "_start",
                            "data-mce-type": "bookmark"
                        });
                        au = S(au, "span", {
                            id: "_end",
                            "data-mce-type": "bookmark"
                        });
                        an(at);
                        an(au);
                        at = ai(C);
                        au = ai()
                    } else {
                        at = au = an(at)
                    }
                    aq.startContainer = at.parentNode;
                    aq.startOffset = s(at);
                    aq.endContainer = au.parentNode;
                    aq.endOffset = s(au) + 1
                }
                N.walk(aq, function(av) {
                    T(av, function(aw) {
                        ae(aw);
                        if (aw.nodeType === 1 && aa.dom.getStyle(aw, "text-decoration") === "underline" && aw.parentNode && i(aw.parentNode) === "underline") {
                            Z({
                                deep: false,
                                exact: true,
                                inline: "span",
                                styles: {
                                    textDecoration: "underline"
                                }
                            }, null, aw)
                        }
                    })
                })
            }
            if (af) {
                if (af.nodeType) {
                    ac = c.createRng();
                    ac.setStartBefore(af);
                    ac.setEndAfter(af);
                    ap(ac)
                } else {
                    ap(af)
                }
                return
            }
            if (!r.isCollapsed() || !ao.inline || c.select("td.mceSelected,th.mceSelected").length) {
                ak = r.getBookmark();
                ap(r.getRng(C));
                r.moveToBookmark(ak);
                if (ao.inline && k(ad, am, r.getStart())) {
                    R(r.getRng(true))
                }
                aa.nodeChanged()
            } else {
                U("remove", ad, am)
            }
        }

        function F(ac, ae, ad) {
            var ab = V(ac);
            if (k(ac, ae, ad) && (!("toggle" in ab[0]) || ab[0].toggle)) {
                B(ac, ae, ad)
            } else {
                Y(ac, ae, ad)
            }
        }

        function y(ac, ab, ah, af) {
            var ad = V(ab),
                ai, ag, ae;

            function aj(an, ap, aq) {
                var am, ao, ak = ap[aq],
                    al;
                if (ap.onmatch) {
                    return ap.onmatch(an, ap, aq)
                }
                if (ak) {
                    if (ak.length === D) {
                        for (am in ak) {
                            if (ak.hasOwnProperty(am)) {
                                if (aq === "attributes") {
                                    ao = c.getAttrib(an, am)
                                } else {
                                    ao = O(an, am)
                                }
                                if (af && !ao && !ap.exact) {
                                    return
                                }
                                if ((!af || ap.exact) && !g(ao, q(ak[am], ah))) {
                                    return
                                }
                            }
                        }
                    } else {
                        for (al = 0; al < ak.length; al++) {
                            if (aq === "attributes" ? c.getAttrib(an, ak[al]) : O(an, ak[al])) {
                                return ap
                            }
                        }
                    }
                }
                return ap
            }
            if (ad && ac) {
                for (ag = 0; ag < ad.length; ag++) {
                    ai = ad[ag];
                    if (h(ac, ai) && aj(ac, ai, "attributes") && aj(ac, ai, "styles")) {
                        if (ae = ai.classes) {
                            for (ag = 0; ag < ae.length; ag++) {
                                if (!c.hasClass(ac, ae[ag])) {
                                    return
                                }
                            }
                        }
                        return ai
                    }
                }
            }
        }

        function k(ad, af, ae) {
            var ac;

            function ab(ag) {
                ag = c.getParent(ag, function(ah) {
                    return !!y(ah, ad, af, true)
                });
                return y(ag, ad, af)
            }
            if (ae) {
                return ab(ae)
            }
            ae = r.getNode();
            if (ab(ae)) {
                return C
            }
            ac = r.getStart();
            if (ac != ae) {
                if (ab(ac)) {
                    return C
                }
            }
            return X
        }

        function v(ai, ah) {
            var af, ag = [],
                ae = {},
                ad, ac, ab;
            af = r.getStart();
            c.getParent(af, function(al) {
                var ak, aj;
                for (ak = 0; ak < ai.length; ak++) {
                    aj = ai[ak];
                    if (!ae[aj] && y(al, aj, ah)) {
                        ae[aj] = true;
                        ag.push(aj)
                    }
                }
            }, c.getRoot());
            return ag
        }

        function z(af) {
            var ah = V(af),
                ae, ad, ag, ac, ab;
            if (ah) {
                ae = r.getStart();
                ad = n(ae);
                for (ac = ah.length - 1; ac >= 0; ac--) {
                    ab = ah[ac].selector;
                    if (!ab) {
                        return C
                    }
                    for (ag = ad.length - 1; ag >= 0; ag--) {
                        if (c.is(ad[ag], ab)) {
                            return C
                        }
                    }
                }
            }
            return X
        }

        function J(ab, ae, ac) {
            var ad;
            if (!P) {
                P = {};
                ad = {};
                aa.onNodeChange.addToTop(function(ag, af, ai) {
                    var ah = n(ai),
                        aj = {};
                    T(P, function(ak, al) {
                        T(ah, function(am) {
                            if (y(am, al, {}, ak.similar)) {
                                if (!ad[al]) {
                                    T(ak, function(an) {
                                        an(true, {
                                            node: am,
                                            format: al,
                                            parents: ah
                                        })
                                    });
                                    ad[al] = ak
                                }
                                aj[al] = ak;
                                return false
                            }
                        })
                    });
                    T(ad, function(ak, al) {
                        if (!aj[al]) {
                            delete ad[al];
                            T(ak, function(am) {
                                am(false, {
                                    node: ai,
                                    format: al,
                                    parents: ah
                                })
                            })
                        }
                    })
                })
            }
            T(ab.split(","), function(af) {
                if (!P[af]) {
                    P[af] = [];
                    P[af].similar = ac
                }
                P[af].push(ae)
            });
            return this
        }
        a.extend(this, {
            get: V,
            register: l,
            apply: Y,
            remove: B,
            toggle: F,
            match: k,
            matchAll: v,
            matchNode: y,
            canApply: z,
            formatChanged: J
        });
        j();
        W();

        function h(ab, ac) {
            if (g(ab, ac.inline)) {
                return C
            }
            if (g(ab, ac.block)) {
                return C
            }
            if (ac.selector) {
                return c.is(ab, ac.selector)
            }
        }

        function g(ac, ab) {
            ac = ac || "";
            ab = ab || "";
            ac = "" + (ac.nodeName || ac);
            ab = "" + (ab.nodeName || ab);
            return ac.toLowerCase() == ab.toLowerCase()
        }

        function O(ac, ab) {
            var ad = c.getStyle(ac, ab);
            if (ab == "color" || ab == "backgroundColor") {
                ad = c.toHex(ad)
            }
            if (ab == "fontWeight" && ad == 700) {
                ad = "bold"
            }
            return "" + ad
        }

        function q(ab, ac) {
            if (typeof(ab) != "string") {
                ab = ab(ac)
            } else {
                if (ac) {
                    ab = ab.replace(/%(\w+)/g, function(ae, ad) {
                        return ac[ad] || ae
                    })
                }
            }
            return ab
        }

        function f(ab) {
            return ab && ab.nodeType === 3 && /^([\t \r\n]+|)$/.test(ab.nodeValue)
        }

        function S(ad, ac, ab) {
            var ae = c.create(ac, ab);
            ad.parentNode.insertBefore(ae, ad);
            ae.appendChild(ad);
            return ae
        }

        function p(ab, am, ae) {
            var ap, an, ah, al, ad = ab.startContainer,
                ai = ab.startOffset,
                ar = ab.endContainer,
                ak = ab.endOffset;

            function ao(aA) {
                var au, ax, az, aw, av, at;
                au = ax = aA ? ad : ar;
                av = aA ? "previousSibling" : "nextSibling";
                at = c.getRoot();

                function ay(aB) {
                    return aB.nodeName == "BR" && aB.getAttribute("data-mce-bogus") && !aB.nextSibling
                }
                if (au.nodeType == 3 && !f(au)) {
                    if (aA ? ai > 0 : ak < au.nodeValue.length) {
                        return au
                    }
                }
                for (;;) {
                    if (!am[0].block_expand && H(ax)) {
                        return ax
                    }
                    for (aw = ax[av]; aw; aw = aw[av]) {
                        if (!K(aw) && !f(aw) && !ay(aw)) {
                            return ax
                        }
                    }
                    if (ax.parentNode == at) {
                        au = ax;
                        break
                    }
                    ax = ax.parentNode
                }
                return au
            }

            function ag(at, au) {
                if (au === D) {
                    au = at.nodeType === 3 ? at.length : at.childNodes.length
                }
                while (at && at.hasChildNodes()) {
                    at = at.childNodes[au];
                    if (at) {
                        au = at.nodeType === 3 ? at.length : at.childNodes.length
                    }
                }
                return {
                    node: at,
                    offset: au
                }
            }
            if (ad.nodeType == 1 && ad.hasChildNodes()) {
                an = ad.childNodes.length - 1;
                ad = ad.childNodes[ai > an ? an : ai];
                if (ad.nodeType == 3) {
                    ai = 0
                }
            }
            if (ar.nodeType == 1 && ar.hasChildNodes()) {
                an = ar.childNodes.length - 1;
                ar = ar.childNodes[ak > an ? an : ak - 1];
                if (ar.nodeType == 3) {
                    ak = ar.nodeValue.length
                }
            }

            function aq(au) {
                var at = au;
                while (at) {
                    if (at.nodeType === 1 && x(at)) {
                        return x(at) === "false" ? at : au
                    }
                    at = at.parentNode
                }
                return au
            }

            function aj(au, ay, aA) {
                var ax, av, az, at;

                function aw(aC, aE) {
                    var aF, aB, aD = aC.nodeValue;
                    if (typeof(aE) == "undefined") {
                        aE = aA ? aD.length : 0
                    }
                    if (aA) {
                        aF = aD.lastIndexOf(" ", aE);
                        aB = aD.lastIndexOf("\u00a0", aE);
                        aF = aF > aB ? aF : aB;
                        if (aF !== -1 && !ae) {
                            aF++
                        }
                    } else {
                        aF = aD.indexOf(" ", aE);
                        aB = aD.indexOf("\u00a0", aE);
                        aF = aF !== -1 && (aB === -1 || aF < aB) ? aF : aB
                    }
                    return aF
                }
                if (au.nodeType === 3) {
                    az = aw(au, ay);
                    if (az !== -1) {
                        return {
                            container: au,
                            offset: az
                        }
                    }
                    at = au
                }
                ax = new t(au, c.getParent(au, H) || aa.getBody());
                while (av = ax[aA ? "prev" : "next"]()) {
                    if (av.nodeType === 3) {
                        at = av;
                        az = aw(av);
                        if (az !== -1) {
                            return {
                                container: av,
                                offset: az
                            }
                        }
                    } else {
                        if (H(av)) {
                            break
                        }
                    }
                }
                if (at) {
                    if (aA) {
                        ay = 0
                    } else {
                        ay = at.length
                    }
                    return {
                        container: at,
                        offset: ay
                    }
                }
            }

            function af(au, at) {
                var av, aw, ay, ax;
                if (au.nodeType == 3 && au.nodeValue.length === 0 && au[at]) {
                    au = au[at]
                }
                av = n(au);
                for (aw = 0; aw < av.length; aw++) {
                    for (ay = 0; ay < am.length; ay++) {
                        ax = am[ay];
                        if ("collapsed" in ax && ax.collapsed !== ab.collapsed) {
                            continue
                        }
                        if (c.is(av[aw], ax.selector)) {
                            return av[aw]
                        }
                    }
                }
                return au
            }

            function ac(au, at, aw) {
                var av;
                if (!am[0].wrapper) {
                    av = c.getParent(au, am[0].block)
                }
                if (!av) {
                    av = c.getParent(au.nodeType == 3 ? au.parentNode : au, I)
                }
                if (av && am[0].wrapper) {
                    av = n(av, "ul,ol").reverse()[0] || av
                }
                if (!av) {
                    av = au;
                    while (av[at] && !H(av[at])) {
                        av = av[at];
                        if (g(av, "br")) {
                            break
                        }
                    }
                }
                return av || au
            }
            ad = aq(ad);
            ar = aq(ar);
            if (K(ad.parentNode) || K(ad)) {
                ad = K(ad) ? ad : ad.parentNode;
                ad = ad.nextSibling || ad;
                if (ad.nodeType == 3) {
                    ai = 0
                }
            }
            if (K(ar.parentNode) || K(ar)) {
                ar = K(ar) ? ar : ar.parentNode;
                ar = ar.previousSibling || ar;
                if (ar.nodeType == 3) {
                    ak = ar.length
                }
            }
            if (am[0].inline) {
                if (ab.collapsed) {
                    al = aj(ad, ai, true);
                    if (al) {
                        ad = al.container;
                        ai = al.offset
                    }
                    al = aj(ar, ak);
                    if (al) {
                        ar = al.container;
                        ak = al.offset
                    }
                }
                ah = ag(ar, ak);
                if (ah.node) {
                    while (ah.node && ah.offset === 0 && ah.node.previousSibling) {
                        ah = ag(ah.node.previousSibling)
                    }
                    if (ah.node && ah.offset > 0 && ah.node.nodeType === 3 && ah.node.nodeValue.charAt(ah.offset - 1) === " ") {
                        if (ah.offset > 1) {
                            ar = ah.node;
                            ar.splitText(ah.offset - 1)
                        }
                    }
                }
            }
            if (am[0].inline || am[0].block_expand) {
                if (!am[0].inline || (ad.nodeType != 3 || ai === 0)) {
                    ad = ao(true)
                }
                if (!am[0].inline || (ar.nodeType != 3 || ak === ar.nodeValue.length)) {
                    ar = ao()
                }
            }
            if (am[0].selector && am[0].expand !== X && !am[0].inline) {
                ad = af(ad, "previousSibling");
                ar = af(ar, "nextSibling")
            }
            if (am[0].block || am[0].selector) {
                ad = ac(ad, "previousSibling");
                ar = ac(ar, "nextSibling");
                if (am[0].block) {
                    if (!H(ad)) {
                        ad = ao(true)
                    }
                    if (!H(ar)) {
                        ar = ao()
                    }
                }
            }
            if (ad.nodeType == 1) {
                ai = s(ad);
                ad = ad.parentNode
            }
            if (ar.nodeType == 1) {
                ak = s(ar) + 1;
                ar = ar.parentNode
            }
            return {
                startContainer: ad,
                startOffset: ai,
                endContainer: ar,
                endOffset: ak
            }
        }

        function Z(ah, ag, ae, ab) {
            var ad, ac, af;
            if (!h(ae, ah)) {
                return X
            }
            if (ah.remove != "all") {
                T(ah.styles, function(aj, ai) {
                    aj = q(aj, ag);
                    if (typeof(ai) === "number") {
                        ai = aj;
                        ab = 0
                    }
                    if (!ab || g(O(ab, ai), aj)) {
                        c.setStyle(ae, ai, "")
                    }
                    af = 1
                });
                if (af && c.getAttrib(ae, "style") == "") {
                    ae.removeAttribute("style");
                    ae.removeAttribute("data-mce-style")
                }
                T(ah.attributes, function(ak, ai) {
                    var aj;
                    ak = q(ak, ag);
                    if (typeof(ai) === "number") {
                        ai = ak;
                        ab = 0
                    }
                    if (!ab || g(c.getAttrib(ab, ai), ak)) {
                        if (ai == "class") {
                            ak = c.getAttrib(ae, ai);
                            if (ak) {
                                aj = "";
                                T(ak.split(/\s+/), function(al) {
                                    if (/mce\w+/.test(al)) {
                                        aj += (aj ? " " : "") + al
                                    }
                                });
                                if (aj) {
                                    c.setAttrib(ae, ai, aj);
                                    return
                                }
                            }
                        }
                        if (ai == "class") {
                            ae.removeAttribute("className")
                        }
                        if (e.test(ai)) {
                            ae.removeAttribute("data-mce-" + ai)
                        }
                        ae.removeAttribute(ai)
                    }
                });
                T(ah.classes, function(ai) {
                    ai = q(ai, ag);
                    if (!ab || c.hasClass(ab, ai)) {
                        c.removeClass(ae, ai)
                    }
                });
                ac = c.getAttribs(ae);
                for (ad = 0; ad < ac.length; ad++) {
                    if (ac[ad].nodeName.indexOf("_") !== 0) {
                        return X
                    }
                }
            }
            if (ah.remove != "none") {
                o(ae, ah);
                return C
            }
        }

        function o(ad, ae) {
            var ab = ad.parentNode,
                ac;

            function af(ah, ag, ai) {
                ah = E(ah, ag, ai);
                return !ah || (ah.nodeName == "BR" || H(ah))
            }
            if (ae.block) {
                if (!m) {
                    if (H(ad) && !H(ab)) {
                        if (!af(ad, X) && !af(ad.firstChild, C, 1)) {
                            ad.insertBefore(c.create("br"), ad.firstChild)
                        }
                        if (!af(ad, C) && !af(ad.lastChild, X, 1)) {
                            ad.appendChild(c.create("br"))
                        }
                    }
                } else {
                    if (ab == c.getRoot()) {
                        if (!ae.list_block || !g(ad, ae.list_block)) {
                            T(a.grep(ad.childNodes), function(ag) {
                                if (d(m, ag.nodeName.toLowerCase())) {
                                    if (!ac) {
                                        ac = S(ag, m)
                                    } else {
                                        ac.appendChild(ag)
                                    }
                                } else {
                                    ac = 0
                                }
                            })
                        }
                    }
                }
            }
            if (ae.selector && ae.inline && !g(ae.inline, ad)) {
                return
            }
            c.remove(ad, 1)
        }

        function E(ac, ab, ad) {
            if (ac) {
                ab = ab ? "nextSibling" : "previousSibling";
                for (ac = ad ? ac : ac[ab]; ac; ac = ac[ab]) {
                    if (ac.nodeType == 1 || !f(ac)) {
                        return ac
                    }
                }
            }
        }

        function K(ab) {
            return ab && ab.nodeType == 1 && ab.getAttribute("data-mce-type") == "bookmark"
        }

        function u(af, ae) {
            var ab, ad, ac;

            function ah(ak, aj) {
                if (ak.nodeName != aj.nodeName) {
                    return X
                }

                function ai(am) {
                    var an = {};
                    T(c.getAttribs(am), function(ao) {
                        var ap = ao.nodeName.toLowerCase();
                        if (ap.indexOf("_") !== 0 && ap !== "style") {
                            an[ap] = c.getAttrib(am, ap)
                        }
                    });
                    return an
                }

                function al(ap, ao) {
                    var an, am;
                    for (am in ap) {
                        if (ap.hasOwnProperty(am)) {
                            an = ao[am];
                            if (an === D) {
                                return X
                            }
                            if (ap[am] != an) {
                                return X
                            }
                            delete ao[am]
                        }
                    }
                    for (am in ao) {
                        if (ao.hasOwnProperty(am)) {
                            return X
                        }
                    }
                    return C
                }
                if (!al(ai(ak), ai(aj))) {
                    return X
                }
                if (!al(c.parseStyle(c.getAttrib(ak, "style")), c.parseStyle(c.getAttrib(aj, "style")))) {
                    return X
                }
                return C
            }

            function ag(aj, ai) {
                for (ad = aj; ad; ad = ad[ai]) {
                    if (ad.nodeType == 3 && ad.nodeValue.length !== 0) {
                        return aj
                    }
                    if (ad.nodeType == 1 && !K(ad)) {
                        return ad
                    }
                }
                return aj
            }
            if (af && ae) {
                af = ag(af, "previousSibling");
                ae = ag(ae, "nextSibling");
                if (ah(af, ae)) {
                    for (ad = af.nextSibling; ad && ad != ae;) {
                        ac = ad;
                        ad = ad.nextSibling;
                        af.appendChild(ac)
                    }
                    c.remove(ae);
                    T(a.grep(ae.childNodes), function(ai) {
                        af.appendChild(ai)
                    });
                    return af
                }
            }
            return ae
        }

        function I(ab) {
            return /^(h[1-6]|p|div|pre|address|dl|dt|dd)$/.test(ab)
        }

        function M(ac, ag) {
            var ab, af, ad, ae;
            ab = ac[ag ? "startContainer" : "endContainer"];
            af = ac[ag ? "startOffset" : "endOffset"];
            if (ab.nodeType == 1) {
                ad = ab.childNodes.length - 1;
                if (!ag && af) {
                    af--
                }
                ab = ab.childNodes[af > ad ? ad : af]
            }
            if (ab.nodeType === 3 && ag && af >= ab.nodeValue.length) {
                ab = new t(ab, aa.getBody()).next() || ab
            }
            if (ab.nodeType === 3 && !ag && af === 0) {
                ab = new t(ab, aa.getBody()).prev() || ab
            }
            return ab
        }

        function U(ak, ab, ai) {
            var al = "_mce_caret",
                ac = aa.settings.caret_debug;

            function ad(ap) {
                var ao = c.create("span", {
                    id: al,
                    "data-mce-bogus": true,
                    style: ac ? "color:red" : ""
                });
                if (ap) {
                    ao.appendChild(aa.getDoc().createTextNode(G))
                }
                return ao
            }

            function aj(ap, ao) {
                while (ap) {
                    if ((ap.nodeType === 3 && ap.nodeValue !== G) || ap.childNodes.length > 1) {
                        return false
                    }
                    if (ao && ap.nodeType === 1) {
                        ao.push(ap)
                    }
                    ap = ap.firstChild
                }
                return true
            }

            function ag(ao) {
                while (ao) {
                    if (ao.id === al) {
                        return ao
                    }
                    ao = ao.parentNode
                }
            }

            function af(ao) {
                var ap;
                if (ao) {
                    ap = new t(ao, ao);
                    for (ao = ap.current(); ao; ao = ap.next()) {
                        if (ao.nodeType === 3) {
                            return ao
                        }
                    }
                }
            }

            function ae(aq, ap) {
                var ar, ao;
                if (!aq) {
                    aq = ag(r.getStart());
                    if (!aq) {
                        while (aq = c.get(al)) {
                            ae(aq, false)
                        }
                    }
                } else {
                    ao = r.getRng(true);
                    if (aj(aq)) {
                        if (ap !== false) {
                            ao.setStartBefore(aq);
                            ao.setEndBefore(aq)
                        }
                        c.remove(aq)
                    } else {
                        ar = af(aq);
                        if (ar.nodeValue.charAt(0) === G) {
                            ar = ar.deleteData(0, 1)
                        }
                        c.remove(aq, 1)
                    }
                    r.setRng(ao)
                }
            }

            function ah() {
                var aq, ao, av, au, ar, ap, at;
                aq = r.getRng(true);
                au = aq.startOffset;
                ap = aq.startContainer;
                at = ap.nodeValue;
                ao = ag(r.getStart());
                if (ao) {
                    av = af(ao)
                }
                if (at && au > 0 && au < at.length && /\w/.test(at.charAt(au)) && /\w/.test(at.charAt(au - 1))) {
                    ar = r.getBookmark();
                    aq.collapse(true);
                    aq = p(aq, V(ab));
                    aq = N.split(aq);
                    Y(ab, ai, aq);
                    r.moveToBookmark(ar)
                } else {
                    if (!ao || av.nodeValue !== G) {
                        ao = ad(true);
                        av = ao.firstChild;
                        aq.insertNode(ao);
                        au = 1;
                        Y(ab, ai, ao)
                    } else {
                        Y(ab, ai, ao)
                    }
                    r.setCursorLocation(av, au)
                }
            }

            function am() {
                var ao = r.getRng(true),
                    ap, ar, av, au, aq, ay, ax = [],
                    at, aw;
                ap = ao.startContainer;
                ar = ao.startOffset;
                aq = ap;
                if (ap.nodeType == 3) {
                    if (ar != ap.nodeValue.length || ap.nodeValue === G) {
                        au = true
                    }
                    aq = aq.parentNode
                }
                while (aq) {
                    if (y(aq, ab, ai)) {
                        ay = aq;
                        break
                    }
                    if (aq.nextSibling) {
                        au = true
                    }
                    ax.push(aq);
                    aq = aq.parentNode
                }
                if (!ay) {
                    return
                }
                if (au) {
                    av = r.getBookmark();
                    ao.collapse(true);
                    ao = p(ao, V(ab), true);
                    ao = N.split(ao);
                    B(ab, ai, ao);
                    r.moveToBookmark(av)
                } else {
                    aw = ad();
                    aq = aw;
                    for (at = ax.length - 1; at >= 0; at--) {
                        aq.appendChild(c.clone(ax[at], false));
                        aq = aq.firstChild
                    }
                    aq.appendChild(c.doc.createTextNode(G));
                    aq = aq.firstChild;
                    c.insertAfter(aw, ay);
                    r.setCursorLocation(aq, 1)
                }
            }

            function an() {
                var ap, ao, aq;
                ao = ag(r.getStart());
                if (ao && !c.isEmpty(ao)) {
                    a.walk(ao, function(ar) {
                        if (ar.nodeType == 1 && ar.id !== al && !c.isEmpty(ar)) {
                            c.setAttrib(ar, "data-mce-bogus", null)
                        }
                    }, "childNodes")
                }
            }
            if (!self._hasCaretEvents) {
                aa.onBeforeGetContent.addToTop(function() {
                    var ao = [],
                        ap;
                    if (aj(ag(r.getStart()), ao)) {
                        ap = ao.length;
                        while (ap--) {
                            c.setAttrib(ao[ap], "data-mce-bogus", "1")
                        }
                    }
                });
                a.each("onMouseUp onKeyUp".split(" "), function(ao) {
                    aa[ao].addToTop(function() {
                        ae();
                        an()
                    })
                });
                aa.onKeyDown.addToTop(function(ao, aq) {
                    var ap = aq.keyCode;
                    if (ap == 8 || ap == 37 || ap == 39) {
                        ae(ag(r.getStart()))
                    }
                    an()
                });
                r.onSetContent.add(an);
                self._hasCaretEvents = true
            }
            if (ak == "apply") {
                ah()
            } else {
                am()
            }
        }

        function R(ac) {
            var ab = ac.startContainer,
                ai = ac.startOffset,
                ae, ah, ag, ad, af;
            if (ab.nodeType == 3 && ai >= ab.nodeValue.length) {
                ai = s(ab);
                ab = ab.parentNode;
                ae = true
            }
            if (ab.nodeType == 1) {
                ad = ab.childNodes;
                ab = ad[Math.min(ai, ad.length - 1)];
                ah = new t(ab, c.getParent(ab, c.isBlock));
                if (ai > ad.length - 1 || ae) {
                    ah.next()
                }
                for (ag = ah.current(); ag; ag = ah.next()) {
                    if (ag.nodeType == 3 && !f(ag)) {
                        af = c.create("a", null, G);
                        ag.parentNode.insertBefore(af, ag);
                        ac.setStart(ag, 0);
                        r.setRng(ac);
                        c.remove(af);
                        return
                    }
                }
            }
        }
    }
})(tinymce);
tinymce.onAddEditor.add(function(e, a) {
    var d, h, g, c = a.settings;

    function b(j, i) {
        e.each(i, function(l, k) {
            if (l) {
                g.setStyle(j, k, l)
            }
        });
        g.rename(j, "span")
    }

    function f(i, j) {
        g = i.dom;
        if (c.convert_fonts_to_spans) {
            e.each(g.select("font,u,strike", j.node), function(k) {
                d[k.nodeName.toLowerCase()](a.dom, k)
            })
        }
    }
    if (c.inline_styles) {
        h = e.explode(c.font_size_legacy_values);
        d = {
            font: function(j, i) {
                b(i, {
                    backgroundColor: i.style.backgroundColor,
                    color: i.color,
                    fontFamily: i.face,
                    fontSize: h[parseInt(i.size, 10) - 1]
                })
            },
            u: function(j, i) {
                b(i, {
                    textDecoration: "underline"
                })
            },
            strike: function(j, i) {
                b(i, {
                    textDecoration: "line-through"
                })
            }
        };
        a.onPreProcess.add(f);
        a.onSetContent.add(f);
        a.onInit.add(function() {
            a.selection.onSetContent.add(f)
        })
    }
});
(function(b) {
    var a = b.dom.TreeWalker;
    b.EnterKey = function(f) {
        var i = f.dom,
            e = f.selection,
            d = f.settings,
            h = f.undoManager,
            c = f.schema.getNonEmptyElements();

        function g(A) {
            var v = e.getRng(true),
                G, j, z, u, p, M, B, o, k, n, t, J, x, C;

            function E(N) {
                return N && i.isBlock(N) && !/^(TD|TH|CAPTION|FORM)$/.test(N.nodeName) && !/^(fixed|absolute)/i.test(N.style.position) && i.getContentEditable(N) !== "true"
            }

            function F(O) {
                var N;
                if (b.isIE && i.isBlock(O)) {
                    N = e.getRng();
                    O.appendChild(i.create("span", null, "\u00a0"));
                    e.select(O);
                    O.lastChild.outerHTML = "";
                    e.setRng(N)
                }
            }

            function y(P) {
                var O = P,
                    Q = [],
                    N;
                while (O = O.firstChild) {
                    if (i.isBlock(O)) {
                        return
                    }
                    if (O.nodeType == 1 && !c[O.nodeName.toLowerCase()]) {
                        Q.push(O)
                    }
                }
                N = Q.length;
                while (N--) {
                    O = Q[N];
                    if (!O.hasChildNodes() || (O.firstChild == O.lastChild && O.firstChild.nodeValue === "")) {
                        i.remove(O)
                    } else {
                        if (O.nodeName == "A" && (O.innerText || O.textContent) === " ") {
                            i.remove(O)
                        }
                    }
                }
            }

            function m(O) {
                var T, R, N, U, S, Q = O,
                    P;
                N = i.createRng();
                if (O.hasChildNodes()) {
                    T = new a(O, O);
                    while (R = T.current()) {
                        if (R.nodeType == 3) {
                            N.setStart(R, 0);
                            N.setEnd(R, 0);
                            break
                        }
                        if (c[R.nodeName.toLowerCase()]) {
                            N.setStartBefore(R);
                            N.setEndBefore(R);
                            break
                        }
                        Q = R;
                        R = T.next()
                    }
                    if (!R) {
                        N.setStart(Q, 0);
                        N.setEnd(Q, 0)
                    }
                } else {
                    if (O.nodeName == "BR") {
                        if (O.nextSibling && i.isBlock(O.nextSibling)) {
                            if (!M || M < 9) {
                                P = i.create("br");
                                O.parentNode.insertBefore(P, O)
                            }
                            N.setStartBefore(O);
                            N.setEndBefore(O)
                        } else {
                            N.setStartAfter(O);
                            N.setEndAfter(O)
                        }
                    } else {
                        N.setStart(O, 0);
                        N.setEnd(O, 0)
                    }
                }
                e.setRng(N);
                i.remove(P);
                S = i.getViewPort(f.getWin());
                U = i.getPos(O).y;
                if (U < S.y || U + 25 > S.y + S.h) {
                    f.getWin().scrollTo(0, U < S.y ? U : U - S.h + 25)
                }
            }

            function r(O) {
                var P = z,
                    R, Q, N;
                R = O || t == "TABLE" ? i.create(O || x) : p.cloneNode(false);
                N = R;
                if (d.keep_styles !== false) {
                    do {
                        if (/^(SPAN|STRONG|B|EM|I|FONT|STRIKE|U)$/.test(P.nodeName)) {
                            if (P.id == "_mce_caret") {
                                continue
                            }
                            Q = P.cloneNode(false);
                            i.setAttrib(Q, "id", "");
                            if (R.hasChildNodes()) {
                                Q.appendChild(R.firstChild);
                                R.appendChild(Q)
                            } else {
                                N = Q;
                                R.appendChild(Q)
                            }
                        }
                    } while (P = P.parentNode)
                }
                if (!b.isIE) {
                    N.innerHTML = '<br data-mce-bogus="1">'
                }
                return R
            }

            function q(Q) {
                var P, O, N;
                if (z.nodeType == 3 && (Q ? u > 0 : u < z.nodeValue.length)) {
                    return false
                }
                if (z.parentNode == p && C && !Q) {
                    return true
                }
                if (Q && z.nodeType == 1 && z == p.firstChild) {
                    return true
                }
                if (z.nodeName === "TABLE" || (z.previousSibling && z.previousSibling.nodeName == "TABLE")) {
                    return (C && !Q) || (!C && Q)
                }
                P = new a(z, p);
                if (z.nodeType == 3) {
                    if (Q && u == 0) {
                        P.prev()
                    } else {
                        if (!Q && u == z.nodeValue.length) {
                            P.next()
                        }
                    }
                }
                while (O = P.current()) {
                    if (O.nodeType === 1) {
                        if (!O.getAttribute("data-mce-bogus")) {
                            N = O.nodeName.toLowerCase();
                            if (c[N] && N !== "br") {
                                return false
                            }
                        }
                    } else {
                        if (O.nodeType === 3 && !/^[ \t\r\n]*$/.test(O.nodeValue)) {
                            return false
                        }
                    }
                    if (Q) {
                        P.prev()
                    } else {
                        P.next()
                    }
                }
                return true
            }

            function l(N, T) {
                var U, S, P, R, Q, O = x || "P";
                S = i.getParent(N, i.isBlock);
                if (!S || !E(S)) {
                    S = S || j;
                    if (!S.hasChildNodes()) {
                        U = i.create(O);
                        S.appendChild(U);
                        v.setStart(U, 0);
                        v.setEnd(U, 0);
                        return U
                    }
                    R = N;
                    while (R.parentNode != S) {
                        R = R.parentNode
                    }
                    while (R && !i.isBlock(R)) {
                        P = R;
                        R = R.previousSibling
                    }
                    if (P) {
                        U = i.create(O);
                        P.parentNode.insertBefore(U, P);
                        R = P;
                        while (R && !i.isBlock(R)) {
                            Q = R.nextSibling;
                            U.appendChild(R);
                            R = Q
                        }
                        v.setStart(N, T);
                        v.setEnd(N, T)
                    }
                }
                return N
            }

            function H() {
                function N(P) {
                    var O = n[P ? "firstChild" : "lastChild"];
                    while (O) {
                        if (O.nodeType == 1) {
                            break
                        }
                        O = O[P ? "nextSibling" : "previousSibling"]
                    }
                    return O === p
                }
                o = x ? r(x) : i.create("BR");
                if (N(true) && N()) {
                    i.replace(o, n)
                } else {
                    if (N(true)) {
                        n.parentNode.insertBefore(o, n)
                    } else {
                        if (N()) {
                            i.insertAfter(o, n);
                            F(o)
                        } else {
                            G = v.cloneRange();
                            G.setStartAfter(p);
                            G.setEndAfter(n);
                            k = G.extractContents();
                            i.insertAfter(k, n);
                            i.insertAfter(o, n)
                        }
                    }
                }
                i.remove(p);
                m(o);
                h.add()
            }

            function D() {
                var O = new a(z, p),
                    N;
                while (N = O.current()) {
                    if (N.nodeName == "BR") {
                        return true
                    }
                    N = O.next()
                }
            }

            function L() {
                var P, O, N;
                if (z && z.nodeType == 3 && u >= z.nodeValue.length) {
                    if (!b.isIE && !D()) {
                        P = i.create("br");
                        v.insertNode(P);
                        v.setStartAfter(P);
                        v.setEndAfter(P);
                        O = true
                    }
                }
                P = i.create("br");
                v.insertNode(P);
                if (b.isIE && t == "PRE" && (!M || M < 8)) {
                    P.parentNode.insertBefore(i.doc.createTextNode("\r"), P)
                }
                N = i.create("span", {}, "&nbsp;");
                P.parentNode.insertBefore(N, P);
                e.scrollIntoView(N);
                i.remove(N);
                if (!O) {
                    v.setStartAfter(P);
                    v.setEndAfter(P)
                } else {
                    v.setStartBefore(P);
                    v.setEndBefore(P)
                }
                e.setRng(v);
                h.add()
            }

            function s(N) {
                do {
                    if (N.nodeType === 3) {
                        N.nodeValue = N.nodeValue.replace(/^[\r\n]+/, "")
                    }
                    N = N.firstChild
                } while (N)
            }

            function K(P) {
                var N = i.getRoot(),
                    O, Q;
                O = P;
                while (O !== N && i.getContentEditable(O) !== "false") {
                    if (i.getContentEditable(O) === "true") {
                        Q = O
                    }
                    O = O.parentNode
                }
                return O !== N ? Q : N
            }

            function I(O) {
                var N;
                if (!b.isIE) {
                    O.normalize();
                    N = O.lastChild;
                    if (!N || (/^(left|right)$/gi.test(i.getStyle(N, "float", true)))) {
                        i.add(O, "br")
                    }
                }
            }
            if (!v.collapsed) {
                f.execCommand("Delete");
                return
            }
            if (A.isDefaultPrevented()) {
                return
            }
            z = v.startContainer;
            u = v.startOffset;
            x = (d.force_p_newlines ? "p" : "") || d.forced_root_block;
            x = x ? x.toUpperCase() : "";
            M = i.doc.documentMode;
            B = A.shiftKey;
            if (z.nodeType == 1 && z.hasChildNodes()) {
                C = u > z.childNodes.length - 1;
                z = z.childNodes[Math.min(u, z.childNodes.length - 1)] || z;
                if (C && z.nodeType == 3) {
                    u = z.nodeValue.length
                } else {
                    u = 0
                }
            }
            j = K(z);
            if (!j) {
                return
            }
            h.beforeChange();
            if (!i.isBlock(j) && j != i.getRoot()) {
                if (!x || B) {
                    L()
                }
                return
            }
            if ((x && !B) || (!x && B)) {
                z = l(z, u)
            }
            p = i.getParent(z, i.isBlock);
            n = p ? i.getParent(p.parentNode, i.isBlock) : null;
            t = p ? p.nodeName.toUpperCase() : "";
            J = n ? n.nodeName.toUpperCase() : "";
            if (J == "LI" && !A.ctrlKey) {
                p = n;
                t = J
            }
            if (t == "LI") {
                if (!x && B) {
                    L();
                    return
                }
                if (i.isEmpty(p)) {
                    if (/^(UL|OL|LI)$/.test(n.parentNode.nodeName)) {
                        return false
                    }
                    H();
                    return
                }
            }
            if (t == "PRE" && d.br_in_pre !== false) {
                if (!B) {
                    L();
                    return
                }
            } else {
                if ((!x && !B && t != "LI") || (x && B)) {
                    L();
                    return
                }
            }
            x = x || "P";
            if (q()) {
                if (/^(H[1-6]|PRE)$/.test(t) && J != "HGROUP") {
                    o = r(x)
                } else {
                    o = r()
                }
                if (d.end_container_on_empty_block && E(n) && i.isEmpty(p)) {
                    o = i.split(n, p)
                } else {
                    i.insertAfter(o, p)
                }
                m(o)
            } else {
                if (q(true)) {
                    o = p.parentNode.insertBefore(r(), p);
                    F(o)
                } else {
                    G = v.cloneRange();
                    G.setEndAfter(p);
                    k = G.extractContents();
                    s(k);
                    o = k.firstChild;
                    i.insertAfter(k, p);
                    y(o);
                    I(p);
                    m(o)
                }
            }
            i.setAttrib(o, "id", "");
            h.add()
        }
        f.onKeyDown.add(function(k, j) {
            if (j.keyCode == 13) {
                if (g(j) !== false) {
                    j.preventDefault()
                }
            }
        })
    }
})(tinymce);