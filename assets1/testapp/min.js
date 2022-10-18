AmCharts.translations["export"] || (AmCharts.translations["export"] = {}), AmCharts.translations["export"].en || (AmCharts.translations["export"].en = {
        "fallback.save.text": "CTRL + C to copy the data into the clipboard.",
        "fallback.save.image": "Rightclick -> Save picture as... to save the image.",
        "capturing.delayed.menu.label": "{{duration}}",
        "capturing.delayed.menu.title": "Click to cancel",
        "menu.label.print": "Print",
        "menu.label.undo": "Undo",
        "menu.label.redo": "Redo",
        "menu.label.cancel": "Cancel",
        "menu.label.save.image": "Download as ...",
        "menu.label.save.data": "Save as ...",
        "menu.label.draw": "Annotate ...",
        "menu.label.draw.change": "Change ...",
        "menu.label.draw.add": "Add ...",
        "menu.label.draw.shapes": "Shape ...",
        "menu.label.draw.colors": "Color ...",
        "menu.label.draw.widths": "Size ...",
        "menu.label.draw.opacities": "Opacity ...",
        "menu.label.draw.text": "Text",
        "menu.label.draw.modes": "Mode ...",
        "menu.label.draw.modes.pencil": "Pencil",
        "menu.label.draw.modes.line": "Line",
        "menu.label.draw.modes.arrow": "Arrow",
        "label.saved.from": "Saved from: "
    }),
    function() {
        AmCharts["export"] = function(t, r) {
            var s, d = {
                name: "export",
                version: "1.4.76",
                libs: {
                    async: !0,
                    autoLoad: !0,
                    reload: !1,
                    resources: ["fabric.js/fabric.min.js", "FileSaver.js/FileSaver.min.js", {
                        "jszip/jszip.min.js": ["xlsx/xlsx.min.js"],
                        "pdfmake/pdfmake.min.js": ["pdfmake/vfs_fonts.js"]
                    }],
                    namespaces: {
                        "pdfmake.min.js": "pdfMake",
                        "jszip.min.js": "JSZip",
                        "xlsx.min.js": "XLSX",
                        "fabric.min.js": "fabric",
                        "FileSaver.min.js": "saveAs"
                    },
                    loadTimeout: 1e4,
                    unsupportedIE9libs: ["pdfmake.min.js", "jszip.min.js", "xlsx.min.js"]
                },
                config: {},
                setup: {
                    chart: t,
                    hasBlob: !1,
                    wrapper: !1,
                    isIE: !!window.document.documentMode,
                    IEversion: window.document.documentMode,
                    hasTouch: "object" == typeof window.Touch,
                    focusedMenuItem: void 0,
                    hasClasslist: "classList" in document.createElement("_")
                },
                drawing: {
                    enabled: !1,
                    undos: [],
                    redos: [],
                    buffer: {
                        position: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 0,
                            xD: 0,
                            yD: 0
                        }
                    },
                    handler: {
                        undo: function() {
                            var c = d.drawing.undos.pop();
                            if (c) {
                                if (c.selectable = !0, d.drawing.redos.push(c), "added" == c.action) d.setup.fabric.remove(c.target);
                                else {
                                    if (!c.target.changed && "added:modified" == c.action) return void d.drawing.handler.undo();
                                    var u = JSON.parse(c.state);
                                    c.target.recentState = c.state, c.target instanceof fabric.Group ? (u = d.prepareGroupState(u), c.target.set(u), d.drawing.handler.change({
                                        color: u.cfg.color,
                                        width: u.cfg.width,
                                        opacity: u.cfg.opacity
                                    }, !0, c.target)) : c.target.set(u)
                                }
                                d.setup.fabric.renderAll()
                            }
                        },
                        redo: function() {
                            var c = d.drawing.redos.pop();
                            if (c) {
                                if (c.selectable = !0, d.drawing.undos.push(c), "added" == c.action) d.setup.fabric.add(c.target);
                                else if ("added:modified" == c.action) return void d.drawing.handler.redo();
                                var u = JSON.parse(c.state);
                                c.target.recentState = c.state, c.target instanceof fabric.Group ? (u = d.prepareGroupState(u), c.target.set(u), d.drawing.handler.change({
                                    color: u.cfg.color,
                                    width: u.cfg.width,
                                    opacity: u.cfg.opacity
                                }, !0, c.target)) : c.target.set(u), d.setup.fabric.renderAll()
                            }
                        },
                        done: function() {
                            d.drawing.enabled = !1, d.drawing.buffer.enabled = !1, d.drawing.undos = [], d.drawing.redos = [], d.createMenu(d.config.menu), d.setup.fabric.deactivateAll(), d.isElement(d.setup.wrapper) && d.isElement(d.setup.wrapper.parentNode) && d.setup.wrapper.parentNode.removeChild && (d.setup.wrapper.parentNode.removeChild(d.setup.wrapper), d.setup.wrapper = !1)
                        },
                        add: function(c) {
                            var u = d.deepMerge({
                                    top: d.setup.fabric.height / 2,
                                    left: d.setup.fabric.width / 2
                                }, c || {}),
                                f = -1 == u.url.indexOf(".svg") ? fabric.Image.fromURL : fabric.loadSVGFromURL;
                            f(u.url, function(h, m) {
                                var w = void 0 === m ? h : fabric.util.groupSVGElements(h, m),
                                    N = !1;
                                (w.height > d.setup.fabric.height || w.width > d.setup.fabric.width) && (N = d.setup.fabric.height / 2 / w.height), u.top > d.setup.fabric.height && (u.top = d.setup.fabric.height / 2), u.left > d.setup.fabric.width && (u.left = d.setup.fabric.width / 2), d.drawing.buffer.isDrawing = !0, w.set({
                                    originX: "center",
                                    originY: "center",
                                    top: u.top,
                                    left: u.left,
                                    width: N ? w.width * N : w.width,
                                    height: N ? w.height * N : w.height,
                                    fill: d.drawing.color
                                }), d.setup.fabric.add(w)
                            })
                        },
                        change: function(c, u, f) {
                            var m, w, N, h = d.deepMerge({}, c || {}),
                                S = f || d.drawing.buffer.target,
                                T = S ? S._objects ? S._objects : [S] : null;
                            if (h.mode && (d.drawing.mode = h.mode), h.width && (d.drawing.width = h.width, d.drawing.fontSize = h.fontSize = 3 * h.width, 1 == d.drawing.width && (d.drawing.fontSize = h.fontSize = d.defaults.fabric.drawing.fontSize)), h.fontSize && (d.drawing.fontSize = h.fontSize), h.color && (d.drawing.color = h.color), h.opacity && (d.drawing.opacity = h.opacity), N = d.getRGBA(d.drawing.color), N.pop(), N.push(d.drawing.opacity), d.drawing.color = "rgba(" + N.join() + ")", d.setup.fabric.freeDrawingBrush.color = d.drawing.color, d.setup.fabric.freeDrawingBrush.width = d.drawing.width, S) {
                                for (m = JSON.parse(S.recentState).cfg, m && (h.color = h.color || m.color, h.width = h.width || m.width, h.opacity = h.opacity || m.opacity, h.fontSize = h.fontSize || m.fontSize, N = d.getRGBA(h.color), N.pop(), N.push(h.opacity), h.color = "rgba(" + N.join() + ")"), S.changed = !0, w = 0; w < T.length; w++) T[w] instanceof fabric.Text || T[w] instanceof fabric.PathGroup || T[w] instanceof fabric.Triangle ? ((h.color || h.opacity) && T[w].set({
                                    fill: h.color
                                }), h.fontSize && T[w].set({
                                    fontSize: h.fontSize
                                })) : (T[w] instanceof fabric.Path || T[w] instanceof fabric.Line) && (S instanceof fabric.Group ? (h.color || h.opacity) && T[w].set({
                                    stroke: h.color
                                }) : ((h.color || h.opacity) && T[w].set({
                                    stroke: h.color
                                }), h.width && T[w].set({
                                    strokeWidth: h.width
                                })));
                                u || (m = JSON.stringify(d.deepMerge(d.getState(S), {
                                    cfg: {
                                        color: h.color,
                                        width: h.width,
                                        opacity: h.opacity
                                    }
                                })), S.recentState = m, d.drawing.redos = [], d.drawing.undos.push({
                                    action: "modified",
                                    target: S,
                                    state: m
                                })), d.setup.fabric.renderAll()
                            }
                        },
                        text: function(c) {
                            var u = d.deepMerge({
                                text: d.i18l("menu.label.draw.text"),
                                top: d.setup.fabric.height / 2,
                                left: d.setup.fabric.width / 2,
                                fontSize: d.drawing.fontSize,
                                fontFamily: d.setup.chart.fontFamily || "Verdana",
                                fill: d.drawing.color
                            }, c || {});
                            u.click = function() {};
                            var f = new fabric.IText(u.text, u);
                            return d.drawing.buffer.isDrawing = !0, d.setup.fabric.add(f), d.setup.fabric.setActiveObject(f), f.selectAll(), f.enterEditing(), f
                        },
                        line: function(c) {
                            var f, h, m, w, u = d.deepMerge({
                                    x1: d.setup.fabric.width / 2 - d.setup.fabric.width / 10,
                                    x2: d.setup.fabric.width / 2 + d.setup.fabric.width / 10,
                                    y1: d.setup.fabric.height / 2,
                                    y2: d.setup.fabric.height / 2,
                                    angle: 90,
                                    strokeLineCap: d.drawing.lineCap,
                                    arrow: d.drawing.arrow,
                                    color: d.drawing.color,
                                    width: d.drawing.width,
                                    group: []
                                }, c || {}),
                                N = new fabric.Line([u.x1, u.y1, u.x2, u.y2], {
                                    stroke: u.color,
                                    strokeWidth: u.width,
                                    strokeLineCap: u.strokeLineCap
                                });
                            if (u.group.push(N), u.arrow && (u.angle = u.angle ? u.angle : d.getAngle(u.x1, u.y1, u.x2, u.y2), "start" == u.arrow ? (m = u.y1 + u.width / 2, w = u.x1 + u.width / 2) : "middle" == u.arrow ? (m = u.y2 + u.width / 2 - (u.y2 - u.y1) / 2, w = u.x2 + u.width / 2 - (u.x2 - u.x1) / 2) : (m = u.y2 + u.width / 2, w = u.x2 + u.width / 2), h = new fabric.Triangle({
                                    top: m,
                                    left: w,
                                    fill: u.color,
                                    height: 7 * u.width,
                                    width: 7 * u.width,
                                    angle: u.angle,
                                    originX: "center",
                                    originY: "bottom"
                                }), u.group.push(h)), d.drawing.buffer.isDrawing = !0, "config" != u.action) {
                                if (u.arrow) {
                                    var S = new fabric.Group(u.group);
                                    return S.set({
                                        cfg: u,
                                        fill: u.color,
                                        action: u.action,
                                        selectable: !0,
                                        known: "change" == u.action
                                    }), "change" == u.action && d.setup.fabric.setActiveObject(S), d.setup.fabric.add(S), S
                                }
                                return d.setup.fabric.add(N), N
                            }
                            for (f = 0; f < u.group.length; f++) u.group[f].ignoreUndo = !0, d.setup.fabric.add(u.group[f]);
                            return u
                        }
                    }
                },
                defaults: {
                    position: "top-right",
                    fileName: "amCharts",
                    action: "download",
                    overflow: !0,
                    path: (t.path || "") + "plugins/export/",
                    formats: {
                        JPG: {
                            mimeType: "image/jpg",
                            extension: "jpg",
                            capture: !0
                        },
                        PNG: {
                            mimeType: "image/png",
                            extension: "png",
                            capture: !0
                        },
                        SVG: {
                            mimeType: "text/xml",
                            extension: "svg",
                            capture: !0
                        },
                        PDF: {
                            mimeType: "application/pdf",
                            extension: "pdf",
                            capture: !0
                        },
                        CSV: {
                            mimeType: "text/plain",
                            extension: "csv"
                        },
                        JSON: {
                            mimeType: "text/plain",
                            extension: "json"
                        },
                        XLSX: {
                            mimeType: "application/octet-stream",
                            extension: "xlsx"
                        }
                    },
                    fabric: {
                        backgroundColor: "#FFFFFF",
                        removeImages: !0,
                        forceRemoveImages: !1,
                        selection: !1,
                        loadTimeout: 5e3,
                        drawing: {
                            enabled: !0,
                            arrow: "end",
                            lineCap: "butt",
                            mode: "pencil",
                            modes: ["pencil", "line", "arrow"],
                            color: "#000000",
                            colors: ["#000000", "#FFFFFF", "#FF0000", "#00FF00", "#0000FF"],
                            shapes: ["11.svg", "14.svg", "16.svg", "17.svg", "20.svg", "27.svg"],
                            width: 1,
                            fontSize: 11,
                            widths: [1, 5, 10, 15],
                            opacity: 1,
                            opacities: [1, 0.8, 0.6, 0.4, 0.2],
                            menu: void 0,
                            autoClose: !0
                        },
                        border: {
                            fill: "",
                            fillOpacity: 0,
                            stroke: "#000000",
                            strokeWidth: 1,
                            strokeOpacity: 1
                        }
                    },
                    pdfMake: {
                        images: {},
                        pageOrientation: "portrait",
                        pageMargins: 40,
                        pageOrigin: !0,
                        pageSize: "A4",
                        pageSizes: {
                            "4A0": [4767.87, 6740.79],
                            "2A0": [3370.39, 4767.87],
                            A0: [2383.94, 3370.39],
                            A1: [1683.78, 2383.94],
                            A2: [1190.55, 1683.78],
                            A3: [841.89, 1190.55],
                            A4: [595.28, 841.89],
                            A5: [419.53, 595.28],
                            A6: [297.64, 419.53],
                            A7: [209.76, 297.64],
                            A8: [147.4, 209.76],
                            A9: [104.88, 147.4],
                            A10: [73.7, 104.88],
                            B0: [2834.65, 4008.19],
                            B1: [2004.09, 2834.65],
                            B2: [1417.32, 2004.09],
                            B3: [1000.63, 1417.32],
                            B4: [708.66, 1000.63],
                            B5: [498.9, 708.66],
                            B6: [354.33, 498.9],
                            B7: [249.45, 354.33],
                            B8: [175.75, 249.45],
                            B9: [124.72, 175.75],
                            B10: [87.87, 124.72],
                            C0: [2599.37, 3676.54],
                            C1: [1836.85, 2599.37],
                            C2: [1298.27, 1836.85],
                            C3: [918.43, 1298.27],
                            C4: [649.13, 918.43],
                            C5: [459.21, 649.13],
                            C6: [323.15, 459.21],
                            C7: [229.61, 323.15],
                            C8: [161.57, 229.61],
                            C9: [113.39, 161.57],
                            C10: [79.37, 113.39],
                            RA0: [2437.8, 3458.27],
                            RA1: [1729.13, 2437.8],
                            RA2: [1218.9, 1729.13],
                            RA3: [864.57, 1218.9],
                            RA4: [609.45, 864.57],
                            SRA0: [2551.18, 3628.35],
                            SRA1: [1814.17, 2551.18],
                            SRA2: [1275.59, 1814.17],
                            SRA3: [907.09, 1275.59],
                            SRA4: [637.8, 907.09],
                            EXECUTIVE: [521.86, 756],
                            FOLIO: [612, 936],
                            LEGAL: [612, 1008],
                            LETTER: [612, 792],
                            TABLOID: [792, 1224]
                        }
                    },
                    menu: void 0,
                    divId: null,
                    menuReviver: null,
                    menuWalker: null,
                    fallback: !0,
                    keyListener: !0,
                    fileListener: !0,
                    compress: !0,
                    debug: !1
                },
                listenersToRemove: [],
                i18l: function(c, u) {
                    var f = u ? u : d.setup.chart.language ? d.setup.chart.language : "en",
                        h = AmCharts.translations[d.name][f] || AmCharts.translations[d.name].en;
                    return h[c] || c
                },
                prepareGroupState: function(c) {
                    return c = c || {}, delete c.width, delete c.strokeWidth, c
                },
                getState: function(c) {
                    var u = c.saveState();
                    return u._stateProperties || u.originalState
                },
                download: function(c, u, f) {
                    if (window.saveAs && d.setup.hasBlob) d.toBlob({
                        data: c,
                        type: u
                    }, function(T) {
                        saveAs(T, f)
                    });
                    else if (d.config.fallback && "text/plain" == u) {
                        var m = document.createElement("div"),
                            w = document.createElement("div"),
                            N = document.createElement("textarea");
                        w.innerHTML = d.i18l("fallback.save.text"), m.appendChild(w), m.appendChild(N), w.setAttribute("class", "amcharts-export-fallback-message"), m.setAttribute("class", "amcharts-export-fallback"), d.setup.chart.containerDiv.appendChild(m), N.setAttribute("readonly", ""), N.value = c, N.focus(), N.select(), d.createMenu([{
                            "class": "export-main export-close",
                            label: "Done",
                            click: function() {
                                d.createMenu(d.config.menu), d.isElement(d.setup.chart.containerDiv) && d.setup.chart.containerDiv.removeChild(m)
                            }
                        }])
                    } else if (d.config.fallback && "image" == u.split("/")[0]) {
                        var m = document.createElement("div"),
                            w = document.createElement("div"),
                            S = d.toImage({
                                data: c
                            });
                        w.innerHTML = d.i18l("fallback.save.image"), m.appendChild(w), m.appendChild(S), w.setAttribute("class", "amcharts-export-fallback-message"), m.setAttribute("class", "amcharts-export-fallback"), d.setup.chart.containerDiv.appendChild(m), d.createMenu([{
                            "class": "export-main export-close",
                            label: "Done",
                            click: function() {
                                d.createMenu(d.config.menu), d.isElement(d.setup.chart.containerDiv) && d.setup.chart.containerDiv.removeChild(m)
                            }
                        }])
                    } else throw new Error("Unable to create file. Ensure saveAs (FileSaver.js) is supported.");
                    return c
                },
                loadResource: function(c, u) {
                    function f() {
                        d.handleLog(["amCharts[export]: Loading error on ", this.src || this.href].join(""))
                    }
                    function h() {
                        if (u)
                            for (m = 0; m < u.length; m++) d.loadResource(u[m])
                    }
                    var m, w, N, S, T, A, M = -1 == c.indexOf("//") ? [d.libs.path, c].join("") : c;
                    for (-1 == c.indexOf(".js") ? -1 != c.indexOf(".css") && (N = document.createElement("link"), N.setAttribute("type", "text/css"), N.setAttribute("rel", "stylesheet"), N.setAttribute("href", M)) : (N = document.createElement("script"), N.setAttribute("type", "text/javascript"), N.setAttribute("src", M), d.libs.async && N.setAttribute("async", "")), m = 0; m < document.head.childNodes.length; m++)
                        if (S = document.head.childNodes[m], T = !!S && (S.src || S.href), A = !!S && S.tagName, S && T && -1 != T.indexOf(c)) {
                            d.libs.reload && document.head.removeChild(S), w = !0;
                            break
                        }
                    Object.keys(d.libs.namespaces).some(function(F) {
                        var D = d.libs.namespaces[F],
                            E = c.toLowerCase(),
                            I = F.toLowerCase();
                        if (-1 != E.indexOf(I)) {
                            if (d.setup.isIE && 9 >= d.setup.IEversion && d.libs.unsupportedIE9libs && -1 != d.libs.unsupportedIE9libs.indexOf(I)) return !1;
                            if (void 0 !== window[D]) return w = !0, !0
                        }
                    }), (!w || d.libs.reload) && (N.addEventListener("load", h), d.addListenerToRemove("load", N, h), N.addEventListener("error", f), d.addListenerToRemove("error", N, f), document.head.appendChild(N))
                },
                addListenerToRemove: function(c, u, f) {
                    d.listenersToRemove.push({
                        node: u,
                        method: f,
                        event: c
                    })
                },
                loadDependencies: function() {
                    var c;
                    if (d.libs.autoLoad)
                        for (c = 0; c < d.libs.resources.length; c++) d.libs.resources[c] instanceof Object ? Object.keys(d.libs.resources[c]).some(function(f) {
                            d.loadResource(f, d.libs.resources[c][f])
                        }) : d.loadResource(d.libs.resources[c])
                },
                pxToNumber: function(c, u) {
                    return !c && u ? void 0 : +(c + "").replace("px", "") || 0
                },
                numberToPx: function(c) {
                    return c + "px"
                },
                cloneObject: function(c) {
                    var u, f, m, w;
                    return u = Array.isArray(c) ? [] : {}, Object.keys(c).some(function(N) {
                        f = c[N], m = "object" == typeof f, w = f instanceof Date, u[N] = m && !w ? d.cloneObject(f) : f
                    }), u
                },
                deepMerge: function(c, u, f) {
                    var m, w = u instanceof Array ? "array" : "object";
                    return c instanceof Object || c instanceof Array ? (Object.keys(u).some(function(N) {
                        return "array" == w && isNaN(N) ? !1 : void(m = u[N], (c && void 0 == c[N] || f) && (m instanceof Array ? c[N] = [] : m instanceof Function ? c[N] = function() {} : m instanceof Date ? c[N] = new Date : m instanceof Object ? c[N] = {} : m instanceof Number ? c[N] = new Number : m instanceof String && (c[N] = new String)), (m instanceof Object || m instanceof Array) && !(m instanceof Function || m instanceof Date || d.isElement(m)) && "chart" != N && "scope" != N ? d.deepMerge(c[N], m, f) : c instanceof Array && !f ? c.push(m) : c && (c[N] = m))
                    }), c) : c
                },
                isElement: function(c) {
                    return c instanceof Object && c && 1 === c.nodeType
                },
                isHashbanged: function(c) {
                    var u = (c + "").replace(/\"/g, "");
                    return "url" == u.slice(0, 3) && u.slice(u.indexOf("#") + 1, u.length - 1)
                },
                isPressed: function(c) {
                    return "mousemove" == c.type && 1 === c.which || ("touchmove" == c.type || 1 === c.buttons || 1 === c.button || 1 === c.which ? d.drawing.buffer.isPressed = !0 : d.drawing.buffer.isPressed = !1), d.drawing.buffer.isPressed
                },
                removeImage: function(c) {
                    if (c) {
                        if (d.config.fabric.forceRemoveImages) return !0;
                        if (d.config.fabric.removeImages && d.isTainted(c)) return !0;
                        if (d.setup.isIE && (10 == d.setup.IEversion || 11 == d.setup.IEversion) && -1 != c.toLowerCase().indexOf(".svg")) return !0
                    }
                    return !1
                },
                isTainted: function(c) {
                    var u = (window.location.origin || window.location.protocol + "//" + window.location.hostname + (window.location.port ? ":" + window.location.port : "")) + "";
                    if (c) {
                        if (-1 != u.indexOf(":\\") || -1 != c.indexOf(":\\") || -1 != u.indexOf("file://") || -1 != c.indexOf("file://")) return !0;
                        if (-1 != c.indexOf("//") && -1 == c.indexOf(u.replace(/.*:/, ""))) return !0
                    }
                    return !1
                },
                isSupported: function() {
                    return !!d.config.enabled && (d.setup.isIE && 9 >= d.setup.IEversion && (!Array.prototype.indexOf || !document.head || !1 === d.config.fallback) ? !1 : !0)
                },
                getAngle: function(c, u, f, h) {
                    var N, m = f - c,
                        w = h - u;
                    return N = 0 == m ? 0 == w ? 0 : 0 < w ? Math.PI / 2 : 3 * Math.PI / 2 : 0 == w ? 0 < m ? 0 : Math.PI : 0 > m ? Math.atan(w / m) + Math.PI : 0 > w ? Math.atan(w / m) + 2 * Math.PI : Math.atan(w / m), 180 * N / Math.PI
                },
                gatherAttribute: function(c, u, f, h) {
                    var m, h = h ? h : 0,
                        f = f ? f : 3;
                    return c && (m = c.getAttribute(u), !m && h < f) ? d.gatherAttribute(c.parentNode, u, f, h + 1) : m
                },
                gatherClassName: function(c, u, f, h) {
                    var m, h = h ? h : 0,
                        f = f ? f : 3;
                    if (d.isElement(c)) {
                        if (m = -1 != (c.getAttribute("class") || "").split(" ").indexOf(u), !m && h < f) return d.gatherClassName(c.parentNode, u, f, h + 1);
                        m && (m = c)
                    }
                    return m
                },
                gatherElements: function(c, u, f) {
                    var h, m;
                    for (h = 0; h < c.children.length; h++) {
                        var w = c.children[h];
                        if ("clipPath" == w.tagName) {
                            var N = {},
                                S = fabric.parseTransformAttribute(d.gatherAttribute(w, "transform"));
                            for (m = 0; m < w.childNodes.length; m++) w.childNodes[m].setAttribute("fill", "transparent"), N = {
                                x: d.pxToNumber(w.childNodes[m].getAttribute("x")),
                                y: d.pxToNumber(w.childNodes[m].getAttribute("y")),
                                width: d.pxToNumber(w.childNodes[m].getAttribute("width")),
                                height: d.pxToNumber(w.childNodes[m].getAttribute("height"))
                            };
                            c.clippings[w.id] = {
                                svg: w,
                                bbox: N,
                                transform: S
                            }
                        } else if ("pattern" == w.tagName) {
                            var T = {
                                node: w,
                                source: w.getAttribute("xlink:href"),
                                width: +w.getAttribute("width"),
                                height: +w.getAttribute("height"),
                                repeat: "repeat",
                                offsetX: 0,
                                offsetY: 0
                            };
                            for (m = 0; m < w.childNodes.length; m++)
                                if ("rect" == w.childNodes[m].tagName) T.fill = w.childNodes[m].getAttribute("fill");
                                else if ("image" == w.childNodes[m].tagName) {
                                var A = fabric.parseAttributes(w.childNodes[m], fabric.SHARED_ATTRIBUTES);
                                A.transformMatrix && (T.offsetX = A.transformMatrix[4], T.offsetY = A.transformMatrix[5])
                            }
                            d.removeImage(T.source) ? c.patterns[w.id] = T.fill ? T.fill : "transparent" : c.patterns[T.node.id] = T
                        } else if ("image" == w.tagName) f.included++, fabric.Image.fromURL(w.getAttribute("xlink:href"), function() {
                            f.loaded++
                        });
                        else {
                            var A = ["fill", "stroke"];
                            for (m = 0; m < A.length; m++) {
                                var M = A[m],
                                    F = w.getAttribute(M),
                                    D = d.getRGBA(F),
                                    E = d.isHashbanged(F);
                                !F || D || E || (w.setAttribute(M, "none"), w.setAttribute(M + "-opacity", "0"))
                            }
                        }
                    }
                    return c
                },
                getRGBA: function(c, u) {
                    return "none" != c && "transparent" != c && !d.isHashbanged(c) && (c = new fabric.Color(c), c._source) && (u ? c : c.getSource())
                },
                gatherPosition: function(c, u) {
                    var m, f = d.drawing.buffer.position,
                        h = fabric.util.invertTransform(d.setup.fabric.viewportTransform);
                    return "touchmove" == c.type && ("touches" in c ? c = c.touches[0] : "changedTouches" in c && (c = c.changedTouches[0])), m = fabric.util.transformPoint(d.setup.fabric.getPointer(c, !0), h), 1 == u && (f.x1 = m.x, f.y1 = m.y), f.x2 = m.x, f.y2 = m.y, f.xD = 0 > f.x1 - f.x2 ? -1 * (f.x1 - f.x2) : f.x1 - f.x2, f.yD = 0 > f.y1 - f.y2 ? -1 * (f.y1 - f.y2) : f.y1 - f.y2, f
                },
                modifyFabric: function() {
                    fabric.ElementsParser.prototype.resolveGradient = function(c, u) {
                        var f = c.get(u);
                        if (/^url\(/.test(f)) {
                            var h = f.slice(f.indexOf("#") + 1, f.length - 1);
                            if (fabric.gradientDefs[this.svgUid][h]) {
                                var m = fabric.Gradient.fromElement(fabric.gradientDefs[this.svgUid][h], c);
                                m.coords.y1 && "pie" != d.setup.chart.type && (m.coords.y2 = -1 * m.coords.y1, m.coords.y1 = 0), c.set(u, m)
                            }
                        }
                    }, fabric.Text.fromElement = function(c, u) {
                        if (!c) return null;
                        var f = fabric.parseAttributes(c, fabric.Text.ATTRIBUTE_NAMES);
                        u = fabric.util.object.extend(u ? fabric.util.object.clone(u) : {}, f), u.top = u.top || 0, u.left = u.left || 0, "dx" in f && (u.left += f.dx), "dy" in f && (u.top += f.dy), "fontSize" in u || (u.fontSize = fabric.Text.DEFAULT_SVG_FONT_SIZE), u.originX || (u.originX = "left");
                        var h = "",
                            m = [];
                        if (!("textContent" in c)) "firstChild" in c && null !== c.firstChild && "data" in c.firstChild && null !== c.firstChild.data && m.push(c.firstChild.data);
                        else if (c.childNodes)
                            for (var w = 0; w < c.childNodes.length; w++) m.push(c.childNodes[w].textContent);
                        else m.push(c.textContent);
                        h = m.join("\n");
                        var N = new fabric.Text(h, u),
                            S = 0;
                        return "left" === N.originX && (S = N.getWidth() / 2), "right" === N.originX && (S = -N.getWidth() / 2), 1 < m.length ? N.set({
                            left: N.getLeft() + S,
                            top: N.getTop() + N.fontSize * (m.length - 1) * (0.18 + N._fontSizeFraction),
                            textAlign: u.originX,
                            lineHeight: 1 < m.length ? 0.965 : 1.16
                        }) : N.set({
                            left: N.getLeft() + S,
                            top: N.getTop() - N.getHeight() / 2 + N.fontSize * (0.18 + N._fontSizeFraction)
                        }), N
                    }
                },
                capture: function(c, u) {
                    var f, h = d.deepMerge(d.deepMerge({}, d.config.fabric), c || {}),
                        m = [],
                        w = {
                            x: 0,
                            y: 0,
                            pX: 0,
                            pY: 0,
                            lX: 0,
                            lY: 0,
                            width: d.setup.chart.divRealWidth,
                            height: d.setup.chart.divRealHeight
                        },
                        N = {
                            loaded: 0,
                            included: 0
                        },
                        S = {
                            items: [],
                            width: 0,
                            height: 0,
                            maxWidth: 0,
                            maxHeight: 0
                        };
                    if (!d.handleNamespace("fabric", {
                            scope: this,
                            cb: d.capture,
                            args: arguments
                        })) return !1;
                    d.modifyFabric(), d.handleCallback(h.beforeCapture, h);
                    var T = d.setup.chart.containerDiv.getElementsByTagName("svg");
                    for (f = 0; f < T.length; f++) {
                        var A = {
                            svg: T[f],
                            parent: T[f].parentNode,
                            children: T[f].getElementsByTagName("*"),
                            offset: {
                                x: 0,
                                y: 0
                            },
                            patterns: {},
                            clippings: {},
                            has: {
                                legend: !1,
                                panel: !1,
                                scrollbar: !1
                            }
                        };
                        A.has.legend = d.gatherClassName(A.parent, d.setup.chart.classNamePrefix + "-legend-div", 1), A.has.panel = d.gatherClassName(A.parent, d.setup.chart.classNamePrefix + "-stock-panel-div"), A.has.scrollbar = d.gatherClassName(A.parent, d.setup.chart.classNamePrefix + "-scrollbar-chart-div"), A = d.gatherElements(A, h, N), m.push(A)
                    }
                    if (d.config.legend) {
                        if ("stock" == d.setup.chart.type)
                            for (f = 0; f < d.setup.chart.panels.length; f++) d.setup.chart.panels[f].stockLegend && d.setup.chart.panels[f].stockLegend.divId && S.items.push(d.setup.chart.panels[f].stockLegend);
                        else d.setup.chart.legend && d.setup.chart.legend.divId && S.items.push(d.setup.chart.legend);
                        for (f = 0; f < S.items.length; f++) {
                            var M = S.items[f],
                                A = {
                                    svg: M.container.container,
                                    parent: M.container.container.parentNode,
                                    children: M.container.container.getElementsByTagName("*"),
                                    offset: {
                                        x: 0,
                                        y: 0
                                    },
                                    legend: {
                                        id: f,
                                        type: -1 == ["top", "left"].indexOf(d.config.legend.position) ? "push" : "unshift",
                                        position: d.config.legend.position,
                                        width: d.config.legend.width ? d.config.legend.width : M.container.div.offsetWidth,
                                        height: d.config.legend.height ? d.config.legend.height : M.container.div.offsetHeight
                                    },
                                    patterns: {},
                                    clippings: {},
                                    has: {
                                        legend: !1,
                                        panel: !1,
                                        scrollbar: !1
                                    }
                                };
                            S.width += A.legend.width, S.height += A.legend.height, S.maxWidth = A.legend.width > S.maxWidth ? A.legend.width : S.maxWidth, S.maxHeight = A.legend.height > S.maxHeight ? A.legend.height : S.maxHeight, A = d.gatherElements(A, h, N), m[A.legend.type](A)
                        } - 1 == ["top", "bottom"].indexOf(d.config.legend.position) ? -1 == ["left", "right"].indexOf(d.config.legend.position) ? (w.height += S.height, w.width += S.maxWidth) : (w.width += S.maxWidth, w.height = S.height > w.height ? S.height : w.height) : (w.width = S.maxWidth > w.width ? S.maxWidth : w.width, w.height += S.height)
                    }
                    if (d.drawing.enabled = h.drawing.enabled = "draw" == h.action, d.drawing.buffer.enabled = d.drawing.enabled, d.setup.wrapper = document.createElement("div"), d.setup.wrapper.setAttribute("class", d.setup.chart.classNamePrefix + "-export-canvas"), d.setup.chart.containerDiv.appendChild(d.setup.wrapper), "stock" == d.setup.chart.type) {
                        var F = {
                            top: 0,
                            right: 0,
                            bottom: 0,
                            left: 0
                        };
                        d.setup.chart.leftContainer && (w.width -= d.setup.chart.leftContainer.offsetWidth, F.left = d.setup.chart.leftContainer.offsetWidth + 2 * d.setup.chart.panelsSettings.panelSpacing), d.setup.chart.rightContainer && (w.width -= d.setup.chart.rightContainer.offsetWidth, F.right = d.setup.chart.rightContainer.offsetWidth + 2 * d.setup.chart.panelsSettings.panelSpacing), d.setup.chart.periodSelector && -1 != ["top", "bottom"].indexOf(d.setup.chart.periodSelector.position) && (w.height -= d.setup.chart.periodSelector.offsetHeight + d.setup.chart.panelsSettings.panelSpacing, F[d.setup.chart.periodSelector.position] += d.setup.chart.periodSelector.offsetHeight + d.setup.chart.panelsSettings.panelSpacing), d.setup.chart.dataSetSelector && -1 != ["top", "bottom"].indexOf(d.setup.chart.dataSetSelector.position) && (w.height -= d.setup.chart.dataSetSelector.offsetHeight, F[d.setup.chart.dataSetSelector.position] += d.setup.chart.dataSetSelector.offsetHeight), d.setup.wrapper.style.paddingTop = d.numberToPx(F.top), d.setup.wrapper.style.paddingRight = d.numberToPx(F.right), d.setup.wrapper.style.paddingBottom = d.numberToPx(F.bottom), d.setup.wrapper.style.paddingLeft = d.numberToPx(F.left)
                    }
                    d.setup.canvas = document.createElement("canvas"), d.setup.wrapper.appendChild(d.setup.canvas);
                    var D = d.removeFunctionsFromObject(d.deepMerge({
                        width: w.width,
                        height: w.height,
                        isDrawingMode: !0
                    }, h));
                    for (d.setup.fabric = new fabric.Canvas(d.setup.canvas, D), d.deepMerge(d.setup.fabric, h), d.deepMerge(d.setup.fabric.freeDrawingBrush, h.drawing), d.deepMerge(d.drawing, h.drawing), d.drawing.handler.change(h.drawing), d.setup.fabric.on("mouse:down", function(E) {
                            d.gatherPosition(E.e, 1);
                            d.drawing.buffer.pressedTS = +new Date, d.isPressed(E.e), d.drawing.buffer.isDrawing = !1, d.drawing.buffer.isDrawingTimer = setTimeout(function() {
                                d.drawing.buffer.isSelected || (d.drawing.buffer.isDrawing = !0)
                            }, 200)
                        }), d.setup.fabric.on("mouse:move", function(E) {
                            var I = d.gatherPosition(E.e, 2);
                            if (d.isPressed(E.e), d.drawing.buffer.isPressed && !d.drawing.buffer.isSelected && (d.drawing.buffer.isDrawing = !0, !d.drawing.buffer.line && "pencil" != d.drawing.mode && (5 < I.xD || 5 < I.yD) && (d.setup.fabric.isDrawingMode = !1, d.setup.fabric._isCurrentlyDrawing = !1, d.drawing.buffer.ignoreUndoOnMouseUp = !0, d.setup.fabric.freeDrawingBrush.onMouseUp(), d.setup.fabric.remove(d.setup.fabric._objects.pop()), d.drawing.buffer.line = d.drawing.handler.line({
                                    x1: I.x1,
                                    y1: I.y1,
                                    x2: I.x2,
                                    y2: I.y2,
                                    arrow: "line" != d.drawing.mode && d.drawing.arrow,
                                    action: "config"
                                }))), d.drawing.buffer.isSelected && (d.setup.fabric.isDrawingMode = !1), d.drawing.buffer.line) {
                                var P, O, B, G = d.drawing.buffer.line;
                                for (G.x2 = I.x2, G.y2 = I.y2, f = 0; f < G.group.length; f++) P = G.group[f], P instanceof fabric.Line ? P.set({
                                    x2: G.x2,
                                    y2: G.y2
                                }) : P instanceof fabric.Triangle && (G.angle = d.getAngle(G.x1, G.y1, G.x2, G.y2) + 90, "start" == G.arrow ? (O = G.y1 + G.width / 2, B = G.x1 + G.width / 2) : "middle" == G.arrow ? (O = G.y2 + G.width / 2 - (G.y2 - G.y1) / 2, B = G.x2 + G.width / 2 - (G.x2 - G.x1) / 2) : (O = G.y2 + G.width / 2, B = G.x2 + G.width / 2), P.set({
                                    top: O,
                                    left: B,
                                    angle: G.angle
                                }));
                                d.setup.fabric.renderAll()
                            }
                        }), d.setup.fabric.on("mouse:up", function(E) {
                            if (!d.drawing.buffer.isDrawing) {
                                var I = d.setup.fabric.findTarget(E.e);
                                I && I.selectable && d.setup.fabric.setActiveObject(I)
                            }
                            if (d.drawing.buffer.line) {
                                for (f = 0; f < d.drawing.buffer.line.group.length; f++) d.drawing.buffer.line.group[f].remove();
                                delete d.drawing.buffer.line.action, delete d.drawing.buffer.line.group, d.drawing.handler.line(d.drawing.buffer.line)
                            }
                            d.drawing.buffer.line = !1, d.drawing.buffer.hasLine = !1, d.drawing.buffer.isPressed = !1, clearTimeout(d.drawing.buffer.isDrawingTimer), d.drawing.buffer.isDrawing = !1
                        }), d.setup.fabric.on("object:selected", function(E) {
                            d.drawing.buffer.isSelected = !0, d.drawing.buffer.target = E.target, d.setup.fabric.isDrawingMode = !1
                        }), d.setup.fabric.on("selection:cleared", function() {
                            d.drawing.buffer.target = !1, d.drawing.buffer.isSelected && (d.setup.fabric._isCurrentlyDrawing = !1), d.drawing.buffer.isSelected = !1, d.setup.fabric.isDrawingMode = !0
                        }), d.setup.fabric.on("path:created", function(E) {
                            var I = E.path;
                            if (!d.drawing.buffer.isDrawing || d.drawing.buffer.hasLine) return d.setup.fabric.remove(I), void d.setup.fabric.renderAll()
                        }), d.setup.fabric.on("object:added", function(E) {
                            var I = E.target,
                                P = d.deepMerge(d.getState(I), {
                                    cfg: {
                                        color: d.drawing.color,
                                        width: d.drawing.width,
                                        opacity: d.drawing.opacity,
                                        fontSize: d.drawing.fontSize
                                    }
                                });
                            return P = JSON.stringify(P), I.recentState = P, d.drawing.buffer.ignoreUndoOnMouseUp || !d.drawing.buffer.isDrawing ? void(d.drawing.buffer.ignoreUndoOnMouseUp = !1) : void(I.selectable && !I.known && !I.ignoreUndo && (I.isAnnotation = !0, d.drawing.undos.push({
                                action: "added",
                                target: I,
                                state: P
                            }), d.drawing.undos.push({
                                action: "added:modified",
                                target: I,
                                state: P
                            }), d.drawing.redos = []), I.known = !0, d.setup.fabric.isDrawingMode = !0)
                        }), d.setup.fabric.on("object:modified", function(E) {
                            var I = E.target;
                            console.log(I);
                            var P = JSON.parse(I.recentState),
                                O = d.deepMerge(d.getState(I), {
                                    cfg: P.cfg
                                });
                            O = JSON.stringify(O), I.recentState = O, d.drawing.undos.push({
                                action: "modified",
                                target: I,
                                state: O
                            }), d.drawing.redos = []
                        }), d.setup.fabric.on("text:changed", function(E) {
                            var I = E.target;
                            clearTimeout(I.timer), I.timer = setTimeout(function() {
                                var P = JSON.stringify(d.getState(I));
                                I.recentState = P, d.drawing.redos = [], d.drawing.undos.push({
                                    action: "modified",
                                    target: I,
                                    state: P
                                })
                            }, 250)
                        }), d.drawing.enabled ? (d.setup.wrapper.setAttribute("class", d.setup.chart.classNamePrefix + "-export-canvas active"), d.setup.wrapper.style.backgroundColor = h.backgroundColor, d.setup.wrapper.style.display = "block") : (d.setup.wrapper.setAttribute("class", d.setup.chart.classNamePrefix + "-export-canvas"), d.setup.wrapper.style.display = "none"), f = 0; f < m.length; f++) {
                        var A = m[f];
                        "stock" == d.setup.chart.type && d.setup.chart.legendSettings.position ? -1 == ["top", "bottom"].indexOf(d.setup.chart.legendSettings.position) ? -1 != ["left", "right"].indexOf(d.setup.chart.legendSettings.position) && (A.offset.y = d.pxToNumber(A.parent.style.top) + w.pY, A.offset.x = d.pxToNumber(A.parent.style.left) + w.pX, A.has.legend ? w.pY += d.pxToNumber(A.has.panel.style.height) + d.setup.chart.panelsSettings.panelSpacing : A.has.scrollbar && (A.offset.y -= d.setup.chart.panelsSettings.panelSpacing)) : A.parent.style.top && A.parent.style.left ? (A.offset.y = d.pxToNumber(A.parent.style.top), A.offset.x = d.pxToNumber(A.parent.style.left)) : (A.offset.x = w.x, A.offset.y = w.y, w.y += d.pxToNumber(A.parent.style.height), A.has.panel ? (w.pY = d.pxToNumber(A.has.panel.style.marginTop), A.offset.y += w.pY) : A.has.scrollbar && (A.offset.y += w.pY)) : ("absolute" == A.parent.style.position ? (A.offset.absolute = !0, A.offset.top = d.pxToNumber(A.parent.style.top), A.offset.right = d.pxToNumber(A.parent.style.right, !0), A.offset.bottom = d.pxToNumber(A.parent.style.bottom, !0), A.offset.left = d.pxToNumber(A.parent.style.left), A.offset.width = d.pxToNumber(A.parent.style.width), A.offset.height = d.pxToNumber(A.parent.style.height)) : A.parent.style.top && A.parent.style.left ? (A.offset.y = d.pxToNumber(A.parent.style.top), A.offset.x = d.pxToNumber(A.parent.style.left)) : A.legend ? ("left" == A.legend.position ? w.x = S.maxWidth : "right" == A.legend.position ? A.offset.x = w.width - S.maxWidth : "top" == A.legend.position ? w.y += A.legend.height : "bottom" == A.legend.position && (A.offset.y = w.height - S.height), A.offset.y += w.lY, w.lY += A.legend.height) : (A.offset.x = w.x, A.offset.y = w.y + w.pY, w.y += d.pxToNumber(A.parent.style.height)), A.has.legend && A.has.panel && A.has.panel.style.marginTop ? (w.y += d.pxToNumber(A.has.panel.style.marginTop), A.offset.y += d.pxToNumber(A.has.panel.style.marginTop)) : d.setup.chart.legend && -1 != ["left", "right"].indexOf(d.setup.chart.legend.position) && (A.offset.y = d.pxToNumber(A.parent.style.top), A.offset.x = d.pxToNumber(A.parent.style.left))), fabric.parseSVGDocument(A.svg, function(E) {
                            return function(I, P) {
                                var O, G = fabric.util.groupSVGElements(I, P),
                                    z = [],
                                    U = {
                                        selectable: !1,
                                        isCoreElement: !0
                                    };
                                for (E.offset.absolute ? (U.top = void 0 === E.offset.bottom ? E.offset.top : w.height - E.offset.height - E.offset.bottom, U.left = void 0 === E.offset.right ? E.offset.left : w.width - E.offset.width - E.offset.right) : (U.top = E.offset.y, U.left = E.offset.x), O = 0; O < G.paths.length; O++) {
                                    var H = null;
                                    if (G.paths[O]) {
                                        if (d.removeImage(G.paths[O]["xlink:href"])) continue;
                                        if (G.paths[O].fill instanceof Object) "radial" == G.paths[O].fill.type && -1 == ["pie", "gauge"].indexOf(d.setup.chart.type) && (G.paths[O].fill.coords.r2 = -1 * G.paths[O].fill.coords.r1, G.paths[O].fill.coords.r1 = 0, G.paths[O].set({
                                            opacity: G.paths[O].fillOpacity
                                        }));
                                        else if ((H = d.isHashbanged(G.paths[O].fill)) && E.patterns && E.patterns[H]) {
                                            var X = E.patterns[H];
                                            N.included++, fabric.Image.fromURL(X.source, function(Z, Q) {
                                                return function($) {
                                                    N.loaded++, $.set({
                                                        top: Z.offsetY,
                                                        left: Z.offsetX,
                                                        width: Z.width,
                                                        height: Z.height
                                                    }), d.setup.fabric._isRetinaScaling() && $.set({
                                                        top: Z.offsetY / 2,
                                                        left: Z.offsetX / 2,
                                                        scaleX: 0.5,
                                                        scaleY: 0.5
                                                    });
                                                    var ee = new fabric.StaticCanvas(void 0, {
                                                        backgroundColor: Z.fill,
                                                        width: $.getWidth(),
                                                        height: $.getHeight()
                                                    });
                                                    ee.add($);
                                                    var te = new fabric.Pattern({
                                                        source: ee.getElement(),
                                                        offsetX: G.paths[Q].width / 2,
                                                        offsetY: G.paths[Q].height / 2,
                                                        repeat: "repeat"
                                                    });
                                                    G.paths[Q].set({
                                                        fill: te,
                                                        opacity: G.paths[Q].fillOpacity
                                                    })
                                                }
                                            }(X, O))
                                        }(H = d.isHashbanged(G.paths[O].clipPath)) && E.clippings && E.clippings[H] && (function(Z, Q) {
                                            var $ = G.paths[Z].toSVG;
                                            G.paths[Z].toSVG = function(ee) {
                                                return $.apply(this, [function(te) {
                                                    return ee(te, E.clippings[Q])
                                                }])
                                            }
                                        }(O, H), G.paths[O].set({
                                            clipTo: function(Z, Q) {
                                                return function($) {
                                                    var ee = E.clippings[Q],
                                                        te = this.transformMatrix || [1, 0, 0, 1, 0, 0],
                                                        ae = {
                                                            top: ee.bbox.y,
                                                            left: ee.bbox.x,
                                                            width: ee.bbox.width,
                                                            height: ee.bbox.height
                                                        };
                                                    "map" == d.setup.chart.type && (ae.top += ee.transform[5], ae.left += ee.transform[4]), ee.bbox.x && te[4] && ee.bbox.y && te[5] && (ae.top -= te[5], ae.left -= te[4]), void 0 !== d.setup.chart.smoothCustomBullets && this.className == d.setup.chart.classNamePrefix + "-graph-bullet" && "image" == G.paths[Z].svg.tagName ? (radius = ee.svg.firstChild.rx.baseVal.value / 2 + 2, $.beginPath(), $.moveTo(ae.left + radius, ae.top), $.lineTo(ae.left + ae.width - radius, ae.top), $.quadraticCurveTo(ae.left + ae.width, ae.top, ae.left + ae.width, ae.top + radius), $.lineTo(ae.left + ae.width, ae.top + ae.height - radius), $.quadraticCurveTo(ae.left + ae.width, ae.top + ae.height, ae.left + ae.width - radius, ae.top + ae.height), $.lineTo(ae.left + radius, ae.top + ae.height), $.quadraticCurveTo(ae.left, ae.top + ae.height, ae.left, ae.top + ae.height - radius), $.lineTo(ae.left, ae.top + radius), $.quadraticCurveTo(ae.left, ae.top, ae.left + radius, ae.top), $.closePath()) : $.rect(ae.left, ae.top, ae.width, ae.height)
                                                }
                                            }(O, H)
                                        }))
                                    }
                                    z.push(G.paths[O])
                                }
                                if (G.paths = z, G.set(U), d.setup.fabric.add(G), E.svg.parentNode && E.svg.parentNode.getElementsByTagName) {
                                    var W = E.svg.parentNode.getElementsByClassName(d.setup.chart.classNamePrefix + "-balloon-div");
                                    for (O = 0; O < W.length; O++)
                                        if (h.balloonFunction instanceof Function) h.balloonFunction.apply(d, [W[O], E]);
                                        else {
                                            var _ = W[O],
                                                Y = fabric.parseStyleAttribute(_),
                                                V = fabric.parseStyleAttribute(_.childNodes[0]),
                                                J = new fabric.Text(_.innerText || _.textContent || _.innerHTML, {
                                                    selectable: !1,
                                                    top: d.pxToNumber(Y.top) + E.offset.y,
                                                    left: d.pxToNumber(Y.left) + E.offset.x,
                                                    fill: V.color,
                                                    fontSize: d.pxToNumber(V.fontSize || V["font-size"]),
                                                    fontFamily: V.fontFamily || V["font-family"],
                                                    textAlign: V["text-align"],
                                                    isCoreElement: !0
                                                });
                                            d.setup.fabric.add(J)
                                        }
                                }
                                if (E.svg.nextSibling && "A" == E.svg.nextSibling.tagName) {
                                    var _ = E.svg.nextSibling,
                                        Y = fabric.parseStyleAttribute(_),
                                        J = new fabric.Text(_.innerText || _.textContent || _.innerHTML, {
                                            selectable: !1,
                                            top: d.pxToNumber(Y.top) + E.offset.y,
                                            left: d.pxToNumber(Y.left) + E.offset.x,
                                            fill: Y.color,
                                            fontSize: d.pxToNumber(Y.fontSize || Y["font-size"]),
                                            fontFamily: Y.fontFamily || Y["font-family"],
                                            opacity: Y.opacity,
                                            isCoreElement: !0
                                        });
                                    E.has.scrollbar || d.setup.fabric.add(J)
                                }
                                if (m.pop(), !m.length) var q = +new Date,
                                    K = setInterval(function() {
                                        var Z = +new Date;
                                        (N.loaded == N.included || Z - q > d.config.fabric.loadTimeout) && (clearTimeout(K), d.handleBorder(h), d.handleCallback(h.afterCapture, h), d.setup.fabric.renderAll(), d.handleCallback(u, h))
                                    }, AmCharts.updateRate)
                            }
                        }(A), function(E, I) {
                            var P, O = d.gatherAttribute(E, "class"),
                                B = d.gatherAttribute(E, "visibility"),
                                G = d.gatherAttribute(E, "clip-path");
                            I.className = O + "", I.classList = (O + "").split(" "), I.clipPath = G, I.svg = E;
                            var z = ["fill", "stroke"];
                            for (P = 0; P < z.length; P++) {
                                var U = z[P],
                                    H = (E.getAttribute(U) || "none") + "",
                                    X = +(E.getAttribute(U + "-opacity") || "1"),
                                    W = d.getRGBA(H);
                                "hidden" == B && (I.opacity = 0, X = 0), W && (W.pop(), W.push(X), I[U] = "rgba(" + W.join() + ")", I[U + d.capitalize("opacity")] = X)
                            }
                            d.handleCallback(h.reviver, I, E)
                        })
                    }
                },
                toCanvas: function(c, u) {
                    var f = d.deepMerge({}, c || {}),
                        h = d.setup.canvas;
                    return d.handleCallback(u, h, f), h
                },
                toImage: function(c, u) {
                    var f = d.deepMerge({
                            format: "png",
                            quality: 1,
                            multiplier: d.config.multiplier
                        }, c || {}),
                        h = f.data,
                        m = document.createElement("img");
                    return !!d.handleNamespace("fabric", {
                        scope: this,
                        cb: d.toImage,
                        args: arguments
                    }) && (f.data || (f.lossless || "svg" == f.format ? h = d.toSVG(d.deepMerge(f, {
                        getBase64: !0
                    })) : h = d.setup.fabric.toDataURL(f)), m.setAttribute("src", h), d.handleCallback(u, m, f), m)
                },
                toBlob: function(c, u) {
                    var h, f = d.deepMerge({
                            data: "empty",
                            type: "text/plain"
                        }, c || {}),
                        m = /^data:.+;base64,(.*)$/.exec(f.data);
                    return m && (f.data = m[0], f.type = f.data.slice(5, f.data.indexOf(",") - 7), f.data = d.toByteArray({
                        data: f.data.slice(f.data.indexOf(",") + 1, f.data.length)
                    })), h = f.getByteArray ? f.data : new Blob([f.data], {
                        type: f.type
                    }), d.handleCallback(u, h, f), h
                },
                toJPG: function(c, u) {
                    var f = d.deepMerge({
                        format: "jpeg",
                        quality: 1,
                        multiplier: d.config.multiplier
                    }, c || {});
                    f.format = f.format.toLowerCase();
                    var h;
                    return (/iP(hone|od|ad)/.test(navigator.platform) && (f.multiplier = 1), !!d.handleNamespace("fabric", {
                        scope: this,
                        cb: d.toJPG,
                        args: arguments
                    })) && (h = d.setup.fabric.toDataURL(f), d.handleCallback(u, h, f), h)
                },
                toPNG: function(c, u) {
                    var h, f = d.deepMerge({
                        format: "png",
                        quality: 1,
                        multiplier: d.config.multiplier
                    }, c || {});
                    return (/iP(hone|od|ad)/.test(navigator.platform) && (f.multiplier = 1), !!d.handleNamespace("fabric", {
                        scope: this,
                        cb: d.toPNG,
                        args: arguments
                    })) && (h = d.setup.fabric.toDataURL(f), d.handleCallback(u, h, f), h)
                },
                toSVG: function(c, u) {
                    var w, f = [],
                        h = [],
                        m = d.deepMerge({
                            compress: d.config.compress,
                            reviver: function(T, A) {
                                var M = new RegExp(/\bstyle=(['"])(.*?)\1/),
                                    F = M.exec(T)[0].slice(7, -1),
                                    D = F.split(";"),
                                    E = [];
                                for (i1 = 0; i1 < D.length; i1++)
                                    if (D[i1]) {
                                        var I = D[i1].replace(/\s/g, "").split(":"),
                                            P = I[0],
                                            O = I[1];
                                        if (-1 == ["fill", "stroke"].indexOf(P)) "opactiy" != P && E.push(D[i1]);
                                        else if (O = d.getRGBA(O, !0), O) {
                                            var B = "#" + O.toHex(),
                                                G = O._source[3];
                                            E.push([P, B].join(":")), E.push([P + "-opacity", G].join(":"))
                                        } else E.push(D[i1])
                                    }
                                if (T = T.replace(F, E.join(";")), A && A.svg) {
                                    var z = A.svg.id,
                                        U = 2,
                                        H = T.slice(-U);
                                    "/>" != H && (U = 3, H = T.slice(-U));
                                    var X = T.slice(0, T.length - U),
                                        W = " clip-path=\"url(#" + z + ")\" ",
                                        _ = d.gatherAttribute(A.svg, "class");
                                    if (_ = _ ? _.split(" ") : [], T = -1 == _.indexOf(d.setup.chart.classNamePrefix + "-graph-line") ? "<g " + W + ">" + T + "</g>" : X + W + H, -1 == h.indexOf(z)) {
                                        var Y = new XMLSerializer().serializeToString(A.svg);
                                        f.push(Y), h.push(z)
                                    }
                                }
                                return T
                            }
                        }, c || {});
                    if (!d.handleNamespace("fabric", {
                            scope: this,
                            cb: d.toSVG,
                            args: arguments
                        })) return !1;
                    if (w = d.setup.fabric.toSVG(m, m.reviver), f.length) {
                        var N = w.slice(0, w.length - 6),
                            S = w.slice(-6);
                        w = N + f.join("") + S
                    }
                    return m.compress && (w = w.replace(/[\t\r\n]+/g, "")), m.getBase64 && (w = "data:image/svg+xml;base64," + btoa(w)), d.handleCallback(u, w, m), w
                },
                toPDF: function(c, u) {
                    function f(A) {
                        if ("number" == typeof A || A instanceof Number) A = {
                            left: A,
                            right: A,
                            top: A,
                            bottom: A
                        };
                        else if (!(A instanceof Array)) A = {
                            left: d.defaults.pdfMake.pageMargins,
                            top: d.defaults.pdfMake.pageMargins,
                            right: d.defaults.pdfMake.pageMargins,
                            bottom: d.defaults.pdfMake.pageMargins
                        };
                        else if (2 === A.length) A = {
                            left: A[0],
                            top: A[1],
                            right: A[0],
                            bottom: A[1]
                        };
                        else if (4 === A.length) A = {
                            left: A[0],
                            top: A[1],
                            right: A[2],
                            bottom: A[3]
                        };
                        else throw "Invalid pageMargins definition";
                        return A
                    }
                    function h(A, M) {
                        var F = d.defaults.pdfMake.pageSizes[(A + "").toUpperCase()].slice();
                        if (!F) throw new Error("The given pageSize \"" + A + "\" does not exist!");
                        return "landscape" == M && F.reverse(), F
                    }
                    var w, m = d.deepMerge(d.deepMerge({
                        multiplier: d.config.multiplier || 2,
                        pageOrigin: void 0 === d.config.pageOrigin
                    }, d.config.pdfMake), c || {}, !0);
                    if (/iP(hone|od|ad)/.test(navigator.platform) && (m.multiplier = 1), !d.handleNamespace("pdfMake", {
                            scope: this,
                            cb: d.toPDF,
                            args: arguments
                        })) return !1;
                    if (m.images.reference = d.toPNG(m), !m.content) {
                        var N = [],
                            S = h(m.pageSize, m.pageOrientation),
                            T = f(m.pageMargins);
                        S[0] -= T.left + T.right, S[1] -= T.top + T.bottom, m.pageOrigin && (N.push(d.i18l("label.saved.from")), N.push(window.location.href), S[1] -= 2 * 14.064), N.push({
                            image: "reference",
                            fit: S
                        }), m.content = N
                    }
                    return w = new pdfMake.createPdf(m), u && w.getDataUrl(function(A) {
                        return function() {
                            A.apply(d, arguments)
                        }
                    }(u)), w
                },
                toPRINT: function(c, u) {
                    var f, h = d.deepMerge({
                            delay: 1,
                            lossless: !1
                        }, c || {}),
                        m = d.toImage(h),
                        w = [],
                        N = document.body.childNodes,
                        S = document.documentElement.scrollTop || document.body.scrollTop;
                    for (m.setAttribute("style", "width: 100%; max-height: 100%;"), f = 0; f < N.length; f++) d.isElement(N[f]) && (w[f] = N[f].style.display, N[f].style.display = "none");
                    document.body.appendChild(m), h.delay *= 1e3;
                    var T = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
                    return T && 1e3 > h.delay && (h.delay = 1e3), setTimeout(function() {
                        window.print(), setTimeout(function() {
                            for (f = 0; f < N.length; f++) d.isElement(N[f]) && (N[f].style.display = w[f]);
                            document.body.removeChild(m), document.documentElement.scrollTop = document.body.scrollTop = S, d.handleCallback(u, m, h)
                        }, h.delay)
                    }, h.delay), m
                },
                toJSON: function(c, u) {
                    var f = d.deepMerge({
                            dateFormat: d.config.dateFormat || "dateObject"
                        }, c || {}, !0),
                        h = {};
                    return !!d.handleNamespace("JSON", {
                        scope: this,
                        cb: d.toJSON,
                        args: arguments
                    }) && (f.data = void 0 === f.data ? d.getChartData(f) : f.data, h = JSON.stringify(f.data, void 0, "\t"), d.handleCallback(u, h, f), h)
                },
                toCSV: function(c, u) {
                    var m = d.deepMerge({
                            delimiter: ",",
                            quotes: !0,
                            escape: !0,
                            withHeader: !0
                        }, c || {}, !0),
                        w = [],
                        N = "";
                    return w = d.toArray(m), Object.keys(w).some(function(S) {
                        isNaN(S) || (N += w[S].join(m.delimiter) + "\n")
                    }), d.handleCallback(u, N, m), N
                },
                toXLSX: function(c, u) {
                    function f(T, A) {
                        A && (T += 1462);
                        var M = Date.parse(T),
                            F = 1e3 * (60 * T.getTimezoneOffset());
                        return (M - F - new Date(Date.UTC(1899, 11, 30))) / 86400000
                    }
                    var m = d.deepMerge({
                            name: "amCharts",
                            dateFormat: d.config.dateFormat || "dateObject",
                            withHeader: !0,
                            stringify: !1
                        }, c || {}, !0),
                        w = [],
                        N = "",
                        S = {
                            SheetNames: [],
                            Sheets: {}
                        };
                    return !!d.handleNamespace("XLSX", {
                        scope: this,
                        cb: d.toXLSX,
                        args: arguments
                    }) && (w = d.toArray(m), S.SheetNames.push(m.name), S.Sheets[m.name] = function(T) {
                        for (var M = {}, F = {
                                s: {
                                    c: 1e7,
                                    r: 1e7
                                },
                                e: {
                                    c: 0,
                                    r: 0
                                }
                            }, D = 0; D != T.length; ++D)
                            for (var E = 0; E != T[D].length; ++E) {
                                F.s.r > D && (F.s.r = D), F.s.c > E && (F.s.c = E), F.e.r < D && (F.e.r = D), F.e.c < E && (F.e.c = E);
                                var I = {
                                    v: T[D][E]
                                };
                                if (null != I.v) {
                                    var P = XLSX.utils.encode_cell({
                                        c: E,
                                        r: D
                                    });
                                    "number" == typeof I.v ? I.t = "n" : "boolean" == typeof I.v ? I.t = "b" : I.v instanceof Date ? (I.t = "n", I.z = XLSX.SSF._table[14], I.v = f(I.v)) : I.v instanceof Object ? (I.t = "s", I.v = JSON.stringify(I.v)) : I.t = "s", M[P] = I
                                }
                            }
                        return 1e7 > F.s.c && (M["!ref"] = XLSX.utils.encode_range(F)), M
                    }(w), N = XLSX.write(S, {
                        bookType: "xlsx",
                        bookSST: !0,
                        type: "base64"
                    }), N = "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," + N, d.handleCallback(u, N, m), N)
                },
                toArray: function(c, u) {
                    function h(F) {
                        return "string" == typeof F && (N.escape && (F = F.replace("\"", "\"\"")), N.quotes && (F = ["\"", F, "\""].join(""))), F
                    }
                    var w, N = d.deepMerge({
                            withHeader: !1,
                            stringify: !0,
                            escape: !1,
                            quotes: !1
                        }, c || {}, !0),
                        S = [],
                        T = [],
                        A = [],
                        M = d.config.processData;
                    return N.processData = function(F, D) {
                        var E = D.exportFields || Object.keys(D.dataFieldsMap);
                        for (w = 0; w < E.length; w++) {
                            var I = E[w],
                                P = D.dataFieldsTitlesMap[I];
                            T.push(P)
                        }
                        return M ? d.handleCallback(M, F, D) : F
                    }, N.data = void 0 === N.data ? d.getChartData(N) : d.processData(N), N.withHeader && (A = [], Object.keys(T).some(function(F) {
                        isNaN(F) || A.push(h(T[F]))
                    }), S.push(A)), Object.keys(N.data).some(function(F) {
                        A = [], isNaN(F) || (Object.keys(T).some(function(D) {
                            if (!isNaN(D)) {
                                var D = T[D],
                                    E = N.data[F][D];
                                E = null == E ? "" : N.stringify ? E + "" : E, A.push(h(E))
                            }
                        }), S.push(A))
                    }), d.handleCallback(u, S, N), S
                },
                toByteArray: function(c, u) {
                    function f(D) {
                        var E = D.charCodeAt(0);
                        return E === N ? 62 : E === S ? 63 : E < T ? -1 : E < T + 10 ? E - T + 26 + 26 : E < M + 26 ? E - M : E < A + 26 ? E - A + 26 : void 0
                    }
                    var m = d.deepMerge({}, c || {}),
                        w = "undefined" == typeof Uint8Array ? Array : Uint8Array,
                        N = "+".charCodeAt(0),
                        S = "/".charCodeAt(0),
                        T = "0".charCodeAt(0),
                        A = "a".charCodeAt(0),
                        M = "A".charCodeAt(0),
                        F = function(D) {
                            function E(X) {
                                z[H++] = X
                            }
                            var I, P, O, B, G, z;
                            if (0 < D.length % 4) throw new Error("Invalid string. Length must be a multiple of 4");
                            var U = D.length;
                            G = "=" === D.charAt(U - 2) ? 2 : "=" === D.charAt(U - 1) ? 1 : 0, z = new w(3 * D.length / 4 - G), O = 0 < G ? D.length - 4 : D.length;
                            var H = 0;
                            for (I = 0, P = 0; I < O; I += 4, P += 3) B = f(D.charAt(I)) << 18 | f(D.charAt(I + 1)) << 12 | f(D.charAt(I + 2)) << 6 | f(D.charAt(I + 3)), E((16711680 & B) >> 16), E((65280 & B) >> 8), E(255 & B);
                            return 2 === G ? (B = f(D.charAt(I)) << 2 | f(D.charAt(I + 1)) >> 4, E(255 & B)) : 1 == G && (B = f(D.charAt(I)) << 10 | f(D.charAt(I + 1)) << 4 | f(D.charAt(I + 2)) >> 2, E(255 & B >> 8), E(255 & B)), z
                        }(m.data);
                    return d.handleCallback(u, F, m), F
                },
                removeFunctionsFromObject: function(c) {
                    return Object.keys(c).some(function(u) {
                        "function" == typeof c[u] && delete c[u]
                    }), c
                },
                handleCallback: function(c) {
                    var u, f = [];
                    if (c && c instanceof Function) {
                        for (u = 0; u < arguments.length; u++) 0 < u && f.push(arguments[u]);
                        return c.apply(d, f)
                    }
                },
                handleLog: function(c) {
                    !0 === d.config.debug && console.log(c)
                },
                handleNamespace: function(c, u) {
                    function f() {
                        var S = +new Date;
                        m = !!(c in h), "pdfMake" == c && m && (m = h.pdfMake.vfs), m ? (clearTimeout(N), u.cb.apply(u.scope, u.args), d.handleLog(["AmCharts [export]: Namespace \"", c, "\" showed up in: ", h + ""].join(""))) : S - w < d.libs.loadTimeout ? N = setTimeout(f, 250) : d.handleLog(["AmCharts [export]: Gave up waiting for \"", c, "\" in: ", h + ""].join(""))
                    }
                    var N, h = d.config.scope || window,
                        m = !1,
                        w = +new Date;
                    return m = !!(c in h), m || (d.handleLog(["AmCharts [export]: Could not find \"", c, "\" in: ", h + ""].join("")), f()), m
                },
                handleBorder: function(c) {
                    if (d.config.border instanceof Object) {
                        var u = d.deepMerge(d.defaults.fabric.border, c.border || {}, !0),
                            f = new fabric.Rect;
                        u.width = d.setup.fabric.width - u.strokeWidth, u.height = d.setup.fabric.height - u.strokeWidth, f.set(u), d.setup.fabric.add(f)
                    }
                },
                handleDropbox: function(c) {
                    if (d.drawing.enabled)
                        if (c.preventDefault(), c.stopPropagation(), "dragover" == c.type) d.setup.wrapper.setAttribute("class", d.setup.chart.classNamePrefix + "-export-canvas active dropbox");
                        else if (d.setup.wrapper.setAttribute("class", d.setup.chart.classNamePrefix + "-export-canvas active"), "drop" == c.type && c.dataTransfer.files.length)
                        for (var f, u = 0; u < c.dataTransfer.files.length; u++) f = new FileReader, f.onloadend = function(h) {
                            return function() {
                                d.drawing.handler.add({
                                    url: f.result,
                                    top: c.layerY - 10 * h,
                                    left: c.layerX - 10 * h
                                })
                            }
                        }(u), f.readAsDataURL(c.dataTransfer.files[u])
                },
                handleReady: function(c) {
                    var h = this,
                        m = +new Date;
                    h.handleCallback(c, "data", !1), Object.keys(h.libs.namespaces).some(function(w) {
                        var N = h.libs.namespaces[w];
                        (function(S) {
                            var T = setInterval(function() {
                                var A = +new Date;
                                (A - m > h.libs.loadTimeout || S in window) && (clearTimeout(T), h.handleCallback(c, S, A - m > h.libs.loadTimeout))
                            }, AmCharts.updateRate)
                        })(N)
                    })
                },
                getChartData: function(c) {
                    function u(U, H, X) {
                        function W(_, Y) {
                            return -1 == f.dataFields.indexOf(_) ? _ : W([_, ".", Y].join(""))
                        }
                        U && f.exportTitles && "gantt" != d.setup.chart.type && (h = W(U, X), f.dataFieldsMap[h] = U, f.dataFields.push(h), f.titles[h] = H || h)
                    }
                    var h, m, w, N, T, f = d.deepMerge({
                            data: [],
                            titles: {},
                            dateFields: [],
                            dataFields: [],
                            dataFieldsMap: {},
                            exportTitles: d.config.exportTitles,
                            exportFields: d.config.exportFields,
                            exportSelection: d.config.exportSelection,
                            columnNames: d.config.columnNames
                        }, c || {}, !0),
                        S = ["valueField", "openField", "closeField", "highField", "lowField", "xField", "yField"];
                    if (0 == f.data.length)
                        if ("stock" == d.setup.chart.type) {
                            for (f.data = d.cloneObject(d.setup.chart.mainDataSet.dataProvider), u(d.setup.chart.mainDataSet.categoryField), f.dateFields.push(d.setup.chart.mainDataSet.categoryField), m = 0; m < d.setup.chart.mainDataSet.fieldMappings.length; m++) {
                                var A = d.setup.chart.mainDataSet.fieldMappings[m];
                                for (w = 0; w < d.setup.chart.panels.length; w++) {
                                    var M = d.setup.chart.panels[w];
                                    for (N = 0; N < M.stockGraphs.length; N++) {
                                        var F = M.stockGraphs[N];
                                        for (i4 = 0; i4 < S.length; i4++) F[S[i4]] == A.toField && u(A.fromField, F.title, S[i4])
                                    }
                                }
                            }
                            if (d.setup.chart.comparedGraphs.length) {
                                for (T = [], m = 0; m < f.data.length; m++) T.push(f.data[m][d.setup.chart.mainDataSet.categoryField]);
                                for (m = 0; m < d.setup.chart.comparedGraphs.length; m++) {
                                    var F = d.setup.chart.comparedGraphs[m];
                                    for (w = 0; w < F.dataSet.dataProvider.length; w++) {
                                        var D = F.dataSet.categoryField,
                                            E = F.dataSet.dataProvider[w][D],
                                            I = T.indexOf(E);
                                        if (-1 != I)
                                            for (N = 0; N < F.dataSet.fieldMappings.length; N++) {
                                                var A = F.dataSet.fieldMappings[N],
                                                    h = F.dataSet.id + "_" + A.toField;
                                                f.data[I][h] = F.dataSet.dataProvider[w][A.fromField], f.titles[h] || u(h, F.dataSet.title)
                                            }
                                    }
                                }
                            }
                        } else if ("gantt" == d.setup.chart.type) {
                        u(d.setup.chart.categoryField);
                        var P = d.setup.chart.segmentsField;
                        for (m = 0; m < d.setup.chart.dataProvider.length; m++) {
                            var O = d.setup.chart.dataProvider[m];
                            if (O[P])
                                for (w = 0; w < O[P].length; w++) O[P][w][d.setup.chart.categoryField] = O[d.setup.chart.categoryField], f.data.push(O[P][w])
                        }
                        for (m = 0; m < d.setup.chart.graphs.length; m++) {
                            var F = d.setup.chart.graphs[m];
                            for (w = 0; w < S.length; w++) {
                                var B = S[w],
                                    G = F[B],
                                    z = F.title;
                                u(G, F.title, B)
                            }
                        }
                    } else if (-1 != ["pie", "funnel"].indexOf(d.setup.chart.type)) f.data = d.setup.chart.dataProvider, u(d.setup.chart.titleField), f.dateFields.push(d.setup.chart.titleField), u(d.setup.chart.valueField);
                    else if ("map" != d.setup.chart.type)
                        for (f.data = d.setup.chart.dataProvider, d.setup.chart.categoryAxis && (u(d.setup.chart.categoryField, d.setup.chart.categoryAxis.title), !1 !== d.setup.chart.categoryAxis.parseDates && f.dateFields.push(d.setup.chart.categoryField)), m = 0; m < d.setup.chart.graphs.length; m++) {
                            var F = d.setup.chart.graphs[m];
                            for (w = 0; w < S.length; w++) {
                                var B = S[w],
                                    G = F[B];
                                u(G, F.title, B)
                            }
                        }
                    return d.processData(f)
                },
                getAnnotations: function(c, u) {
                    var h, f = d.deepMerge({}, c || {}, !0),
                        m = [];
                    for (h = 0; h < d.setup.fabric._objects.length; h++)
                        if (!d.setup.fabric._objects[h].isCoreElement) {
                            var w = d.setup.fabric._objects[h].toJSON();
                            d.handleCallback(f.reviver, w, h), m.push(w)
                        }
                    return d.handleCallback(u, m), m
                },
                setAnnotations: function(c, u) {
                    var f = d.deepMerge({
                        data: []
                    }, c || {}, !0);
                    return fabric.util.enlivenObjects(f.data, function(h) {
                        h.forEach(function(m, w) {
                            d.handleCallback(f.reviver, m, w), d.setup.fabric.add(m)
                        }), d.handleCallback(u, f)
                    }), f.data
                },
                processData: function(c) {
                    var f, h, u = d.deepMerge({
                        data: [],
                        titles: {},
                        dateFields: [],
                        dataFields: [],
                        dataFieldsMap: {},
                        dataFieldsTitlesMap: {},
                        dataDateFormat: d.setup.chart.dataDateFormat,
                        dateFormat: d.config.dateFormat || d.setup.chart.dataDateFormat || "YYYY-MM-DD",
                        exportTitles: d.config.exportTitles,
                        exportFields: d.config.exportFields,
                        exportSelection: d.config.exportSelection,
                        columnNames: d.config.columnNames,
                        processData: d.config.processData
                    }, c || {}, !0);
                    if (u.data.length) {
                        for (f = 0; f < u.data.length; f++) Object.keys(u.data[f]).some(function(F) {
                            -1 == u.dataFields.indexOf(F) && (u.dataFields.push(F), u.dataFieldsMap[F] = F)
                        });
                        void 0 !== u.exportFields && (u.dataFields = u.exportFields.filter(function(F) {
                            return -1 != u.dataFields.indexOf(F)
                        }));
                        var m = [];
                        for (f = 0; f < u.data.length; f++) {
                            var w = {},
                                N = !1;
                            for (h = 0; h < u.dataFields.length; h++) {
                                var S = u.dataFields[h],
                                    T = u.dataFieldsMap[S],
                                    A = u.columnNames && u.columnNames[S] || u.titles[S] || S,
                                    M = u.data[f][T];
                                null == M && (M = void 0), u.exportTitles && "gantt" != d.setup.chart.type && A in w && (A += ["( ", S, " )"].join("")), -1 != u.dateFields.indexOf(T) && (u.dataDateFormat && (M instanceof String || "string" == typeof M) ? M = AmCharts.stringToDate(M, u.dataDateFormat) : u.dateFormat && (M instanceof Number || "number" == typeof M) && (M = new Date(M)), u.exportSelection && (M instanceof Date ? (M < t.startDate || M > t.endDate) && (N = !0) : (f < t.startIndex || f > t.endIndex) && (N = !0)), u.dateFormat && "dateObject" != u.dateFormat && M instanceof Date && (M = AmCharts.formatDate(M, u.dateFormat))), u.dataFieldsTitlesMap[T] = A, w[A] = M
                            }
                            N || m.push(w)
                        }
                        u.data = m
                    }
                    return void 0 !== u.processData && (u.data = d.handleCallback(u.processData, u.data, u)), u.data
                },
                capitalize: function(c) {
                    return c.charAt(0).toUpperCase() + c.slice(1).toLowerCase()
                },
                createMenu: function(c, u) {
                    function f(w, N) {
                        var S, T, A = document.createElement("ul");
                        for (S = 0; S < w.length; S++) {
                            var M = "string" == typeof w[S] ? {
                                    format: w[S]
                                } : w[S],
                                F = document.createElement("li"),
                                D = document.createElement("a"),
                                E = document.createElement("img"),
                                I = document.createElement("span"),
                                P = ((M.action ? M.action : M.format) + "").toLowerCase();
                            if (M.format = (M.format + "").toUpperCase(), F.addEventListener("mouseleave", function() {
                                    this.classList.remove("active")
                                }), D.addEventListener("focus", function() {
                                    if (!d.setup.hasTouch) {
                                        d.setup.focusedMenuItem = this;
                                        var X = this.parentNode;
                                        "UL" != X.tagName && (X = X.parentNode);
                                        var W = X.getElementsByTagName("li");
                                        for (S = 0; S < W.length; S++) W[S].classList.remove("active");
                                        this.parentNode.classList.add("active"), this.parentNode.parentNode.parentNode.classList.add("active")
                                    }
                                }), d.config.formats[M.format] ? M = d.deepMerge({
                                    label: M.icon ? "" : M.format,
                                    format: M.format,
                                    mimeType: d.config.formats[M.format].mimeType,
                                    extension: d.config.formats[M.format].extension,
                                    capture: d.config.formats[M.format].capture,
                                    action: d.config.action,
                                    fileName: d.config.fileName
                                }, M) : !M.label && (M.label = M.label ? M.label : d.i18l("menu.label." + P)), -1 != ["CSV", "JSON", "XLSX"].indexOf(M.format) && -1 != ["map", "gauge"].indexOf(d.setup.chart.type)) continue;
                            else if (!d.setup.hasBlob && "UNDEFINED" != M.format && M.mimeType && "image" != M.mimeType.split("/")[0] && "text/plain" != M.mimeType) continue;
                            if ("draw" == M.action) d.config.fabric.drawing.enabled ? (M.menu = M.menu ? M.menu : d.config.fabric.drawing.menu, M.click = function(H) {
                                return function() {
                                    this.capture(H, function() {
                                        this.createMenu(H.menu)
                                    })
                                }
                            }(M)) : M.menu = [];
                            else if (!M.populated && M.action && -1 != M.action.indexOf("draw.")) {
                                var O = M.action.split(".")[1],
                                    B = M[O] || d.config.fabric.drawing[O] || [];
                                for (M.menu = [], M.populated = !0, T = 0; T < B.length; T++) {
                                    var G = {
                                        label: B[T]
                                    };
                                    if ("shapes" == O) {
                                        var z = -1 == B[T].indexOf("//"),
                                            U = (z ? d.config.path + "shapes/" : "") + B[T];
                                        G.action = "add", G.url = U, G.icon = U, G.ignore = z, G["class"] = "export-drawing-shape"
                                    } else "colors" == O ? (G.style = "background-color: " + B[T], G.action = "change", G.color = B[T], G["class"] = "export-drawing-color") : "widths" == O ? (G.action = "change", G.width = B[T], G.label = document.createElement("span"), G.label.style.width = d.numberToPx(B[T]), G.label.style.height = d.numberToPx(B[T]), G["class"] = "export-drawing-width") : "opacities" == O ? (G.style = "opacity: " + B[T], G.action = "change", G.opacity = B[T], G.label = 100 * B[T] + "%", G["class"] = "export-drawing-opacity") : "modes" == O && (G.label = d.i18l("menu.label.draw.modes." + B[T]), G.click = function(H) {
                                        return function() {
                                            d.drawing.mode = H
                                        }
                                    }(B[T]), G["class"] = "export-drawing-mode");
                                    M.menu.push(G)
                                }
                            } else M.click || M.menu || M.items || (d.drawing.handler[P] instanceof Function ? (M.action = P, M.click = function(H) {
                                return function() {
                                    this.drawing.handler[H.action](H), "cancel" != H.action && this.createMenu(this.config.fabric.drawing.menu)
                                }
                            }(M)) : d.drawing.enabled ? M.click = function(H) {
                                return function() {
                                    this.config.drawing.autoClose && this.drawing.handler.done(), this["to" + H.format](H, function(X) {
                                        "download" == H.action && this.download(X, H.mimeType, [H.fileName, H.extension].join("."))
                                    })
                                }
                            }(M) : "UNDEFINED" != M.format && (M.click = function(H) {
                                return function() {
                                    if (H.capture || "print" == H.action || "PRINT" == H.format) this.capture(H, function() {
                                        this.drawing.handler.done(), this["to" + H.format](H, function(X) {
                                            "download" == H.action && this.download(X, H.mimeType, [H.fileName, H.extension].join("."))
                                        })
                                    });
                                    else if (this["to" + H.format]) this["to" + H.format](H, function(X) {
                                        this.download(X, H.mimeType, [H.fileName, H.extension].join("."))
                                    });
                                    else throw new Error("Invalid format. Could not determine output type.")
                                }
                            }(M)));
                            (void 0 === M.menu || M.menu.length) && (D.setAttribute("href", "#"), d.setup.hasTouch && F.classList ? (D.addEventListener("touchend", function(H, X) {
                                return function(W) {
                                    W.preventDefault();
                                    return "draw" != X.action && "PRINT" != X.format && ("UNDEFINED" == X.format || !X.capture) || d.drawing.enabled || isNaN(X.delay) && isNaN(d.config.delay) ? void H.apply(d, [W, X]) : (X.delay = isNaN(X.delay) ? d.config.delay : X.delay, void d.delay(X, H))
                                }
                            }(M.click || function(H) {
                                H.preventDefault()
                            }, M)), D.addEventListener("touchend", function(H) {
                                return function(X) {
                                    function V(te) {
                                        return te.classList.contains("export-main") || te.classList.contains("export-drawing")
                                    }
                                    X.preventDefault();
                                    var J = H.elements.li,
                                        q = function(te) {
                                            var ae = te.parentNode.parentNode,
                                                ie = ae.classList;
                                            return "LI" == ae.tagName && ie.contains("active")
                                        }(J),
                                        K = function(te) {
                                            var ae = te.parentNode.children;
                                            for (S = 0; S < ae.length; S++) {
                                                var ie = ae[S],
                                                    re = ie.classList;
                                                if (ie !== te && re.contains("active")) return re.remove("active"), !0
                                            }
                                            return !1
                                        }(J),
                                        Z = function(te) {
                                            return 0 < te.getElementsByTagName("ul").length
                                        }(J);
                                    if ((V(J) || !Z) && d.setup.menu.classList.toggle("active"), !q || !Z)
                                        for (; m.length;) {
                                            var Q = m.pop(),
                                                $ = V(Q);
                                            $ ? !Z && Q.classList.remove("active") : Q !== J && Q.classList.remove("active")
                                        }
                                    m.push(J), Z && J.classList.toggle("active")
                                }
                            }(M))) : D.addEventListener("click", function(H, X) {
                                return function(W) {
                                    W.preventDefault();
                                    return "draw" != X.action && "PRINT" != X.format && ("UNDEFINED" == X.format || !X.capture) || d.drawing.enabled || isNaN(X.delay) && isNaN(d.config.delay) ? void H.apply(d, [W, X]) : (X.delay = isNaN(X.delay) ? d.config.delay : X.delay, void d.delay(X, H))
                                }
                            }(M.click || function(H) {
                                H.preventDefault()
                            }, M)), F.appendChild(D), d.isElement(M.label) ? I.appendChild(M.label) : I.innerHTML = M.label, M["class"] && (F.className = M["class"]), M.style && F.setAttribute("style", M.style), M.icon && (E.setAttribute("src", (M.ignore || -1 != M.icon.slice(0, 10).indexOf("//") ? "" : t.pathToImages) + M.icon), D.appendChild(E)), M.label && D.appendChild(I), M.title && D.setAttribute("title", M.title), d.config.menuReviver && (F = d.config.menuReviver.apply(d, [M, F])), M.elements = {
                                li: F,
                                a: D,
                                img: E,
                                span: I
                            }, (M.menu || M.items) && "draw" != M.action ? f(M.menu || M.items, F).childNodes.length && A.appendChild(F) : A.appendChild(F))
                        }
                        return A.childNodes.length && N.appendChild(A), A
                    }
                    var m = [];
                    return u || ("string" == typeof d.config.divId ? d.config.divId = u = document.getElementById(d.config.divId) : d.isElement(d.config.divId) ? u = d.config.divId : u = d.setup.chart.containerDiv), d.isElement(d.setup.menu) ? d.setup.menu.innerHTML = "" : d.setup.menu = document.createElement("div"), d.setup.menu.setAttribute("class", d.setup.chart.classNamePrefix + "-export-menu " + d.setup.chart.classNamePrefix + "-export-menu-" + d.config.position + " amExportButton"), d.config.menuWalker && (f = d.config.menuWalker), f.apply(this, [c, d.setup.menu]), d.setup.menu.childNodes.length && u.appendChild(d.setup.menu), d.setup.menu
                },
                delay: function(c, u) {
                    var h, m, f = d.deepMerge({
                            delay: 3,
                            precision: 2
                        }, c || {}),
                        w = +new Date,
                        N = d.createMenu([{
                            label: d.i18l("capturing.delayed.menu.label").replace("{{duration}}", AmCharts.toFixed(f.delay, f.precision)),
                            title: d.i18l("capturing.delayed.menu.title"),
                            "class": "export-delayed-capturing",
                            click: function() {
                                clearTimeout(h), clearTimeout(m), d.createMenu(d.config.menu)
                            }
                        }]),
                        S = N.getElementsByTagName("a")[0];
                    h = setInterval(function() {
                        var T = f.delay - (+new Date - w) / 1e3;
                        0 >= T ? (clearTimeout(h), "draw" != f.action && d.createMenu(d.config.menu)) : S && (S.innerHTML = d.i18l("capturing.delayed.menu.label").replace("{{duration}}", AmCharts.toFixed(T, 2)))
                    }, AmCharts.updateRate), m = setTimeout(function() {
                        u.apply(d, arguments)
                    }, 1e3 * f.delay)
                },
                migrateSetup: function(c) {
                    function u(h) {
                        Object.keys(h).some(function(w) {
                            var N = h[w];
                            "export" == w.slice(0, 6) && N ? f.menu.push(w.slice(6)) : "userCFG" == w ? u(N) : "menuItems" == w ? f.menu = N : "libs" == w ? f.libs = N : "string" == typeof w && (f[w] = N)
                        })
                    }
                    var f = {
                        enabled: !0,
                        migrated: !0,
                        libs: {
                            autoLoad: !0
                        },
                        menu: []
                    };
                    return u(c), f
                },
                clear: function() {
                    var c, u;
                    for (void 0 !== d.setup.fabric && d.setup.fabric.removeListeners(), c = 0; c < d.listenersToRemove.length; c++) u = d.listenersToRemove[c], u.node.removeEventListener(u.event, u.method);
                    d.isElement(d.setup.wrapper) && d.isElement(d.setup.wrapper.parentNode) && d.setup.wrapper.parentNode.removeChild && d.setup.wrapper.parentNode.removeChild(d.setup.wrapper), d.isElement(d.setup.menu) && d.isElement(d.setup.wrapper.parentNode) && d.setup.wrapper.parentNode.removeChild && d.setup.menu.parentNode.removeChild(d.setup.menu), d.listenersToRemove = [], d.setup.chart.AmExport = void 0, d.setup.chart.export = void 0, d.setup = void 0
                },
                loadListeners: function() {
                    function c(u) {
                        u && (u.set({
                            top: u.top + 10,
                            left: u.left + 10
                        }), d.setup.fabric.add(u))
                    }
                    d.config.keyListener && "attached" != d.config.keyListener && (d.docListener = function(u) {
                        function f(D, E) {
                            for (i1 = 0; i1 < D.length; i1++) {
                                var I = D[i1];
                                I.parentNode.classList.remove("active"), 0 != i1 || E || I.focus()
                            }
                        }
                        function h(D) {
                            d.setup.focusedMenuItem && d.setup.focusedMenuItem.nextSibling && (d.setup.focusedMenuItem.parentNode.classList.add("active"), f(d.setup.focusedMenuItem.nextSibling.getElementsByTagName("a"), D))
                        }
                        function m(D) {
                            d.setup.focusedMenuItem && d.setup.focusedMenuItem.parentNode.parentNode.parentNode && (d.setup.focusedMenuItem.parentNode.classList.add("active"), f(d.setup.focusedMenuItem.parentNode.parentNode.parentNode.getElementsByTagName("a"), D))
                        }
                        function w(D) {
                            d.setup.focusedMenuItem && d.setup.focusedMenuItem.parentNode.nextSibling && (d.setup.focusedMenuItem.parentNode.classList.remove("active"), f(d.setup.focusedMenuItem.parentNode.nextSibling.getElementsByTagName("a"), D))
                        }
                        function N(D) {
                            d.setup.focusedMenuItem && d.setup.focusedMenuItem.parentNode.previousSibling && (d.setup.focusedMenuItem.parentNode.classList.remove("active"), f(d.setup.focusedMenuItem.parentNode.previousSibling.getElementsByTagName("a"), D))
                        }
                        function S() {
                            function D(E) {
                                if (d.isElement(E)) {
                                    try {
                                        E.blur()
                                    } catch (I) {}
                                    E.parentNode && E.parentNode.classList.remove("active"), E.classList.contains("amExportButton") || D(E.parentNode)
                                }
                            }
                            d.setup.focusedMenuItem && (D(d.setup.focusedMenuItem), d.setup.focusedMenuItem = void 0)
                        }
                        var T = d.drawing.buffer.target,
                            M = -1 != ["top-left", "bottom-left"].indexOf(d.config.position),
                            F = -1 != ["top-right", "bottom-right"].indexOf(d.config.position);
                        if (d.setup.focusedMenuItem && -1 != [37, 38, 39, 40, 13, 9, 27].indexOf(u.keyCode)) {
                            if (9 == u.keyCode) return void(d.setup.focusedMenuItem.nextSibling ? u.shiftKey && d.setup.focusedMenuItem.parentNode.classList.remove("active") : (d.setup.focusedMenuItem.parentNode.classList.remove("active"), !d.setup.focusedMenuItem.parentNode.nextSibling && (d.setup.focusedMenuItem.parentNode.classList.remove("active"), d.setup.focusedMenuItem.parentNode.parentNode.parentNode.classList.remove("active"))));
                            13 == u.keyCode && d.setup.focusedMenuItem.nextSibling && h(), 37 == u.keyCode && (F ? h() : m()), 39 == u.keyCode && (F ? m() : h()), 40 == u.keyCode && w(), 38 == u.keyCode && N(), 27 == u.keyCode && S()
                        }(8 == u.keyCode || 46 == u.keyCode) && T ? (u.preventDefault(), d.setup.fabric.remove(T)) : 27 == u.keyCode && d.drawing.enabled ? (u.preventDefault(), d.drawing.buffer.isSelected ? d.setup.fabric.discardActiveObject() : d.drawing.handler.done()) : 67 == u.keyCode && (u.metaKey || u.ctrlKey) && T ? d.drawing.buffer.copy = T : 88 == u.keyCode && (u.metaKey || u.ctrlKey) && T ? (d.drawing.buffer.copy = T, d.setup.fabric.remove(T)) : 86 == u.keyCode && (u.metaKey || u.ctrlKey) ? d.drawing.buffer.copy && c(d.drawing.buffer.copy.clone(c)) : 90 == u.keyCode && (u.metaKey || u.ctrlKey) && (u.preventDefault(), u.shiftKey ? d.drawing.handler.redo() : d.drawing.handler.undo())
                    }, d.config.keyListener = "attached", document.addEventListener("keydown", d.docListener), d.addListenerToRemove("keydown", document, d.docListener)), d.config.fileListener && (d.setup.chart.containerDiv.addEventListener("dragover", d.handleDropbox), d.addListenerToRemove("dragover", d.setup.chart.containerDiv, d.handleDropbox), d.setup.chart.containerDiv.addEventListener("dragleave", d.handleDropbox), d.addListenerToRemove("dragleave", d.setup.chart.containerDiv, d.handleDropbox), d.setup.chart.containerDiv.addEventListener("drop", d.handleDropbox), d.addListenerToRemove("drop", d.setup.chart.containerDiv, d.handleDropbox))
                },
                init: function() {
                    clearTimeout(s), s = setInterval(function() {
                        d.setup && d.setup.chart.containerDiv && (clearTimeout(s), d.config.enabled && (d.setup.chart.AmExport = d, d.config.overflow && (d.setup.chart.div.style.overflow = "visible"), d.loadListeners(), d.createMenu(d.config.menu), d.handleReady(d.config.onReady)))
                    }, AmCharts.updateRate)
                },
                construct: function() {
                    d.drawing.handler.cancel = d.drawing.handler.done;
                    try {
                        d.setup.hasBlob = !!new Blob
                    } catch (c) {}
                    window.safari = window.safari ? window.safari : {}, d.defaults.fabric.drawing.fontSize = d.setup.chart.fontSize || 11, d.config.drawing = d.deepMerge(d.defaults.fabric.drawing, d.config.drawing || {}, !0), d.config.border && (d.config.border = d.deepMerge(d.defaults.fabric.border, d.config.border || {}, !0)), d.deepMerge(d.defaults.fabric, d.config, !0), d.deepMerge(d.defaults.fabric, d.config.fabric || {}, !0), d.deepMerge(d.defaults.pdfMake, d.config, !0), d.deepMerge(d.defaults.pdfMake, d.config.pdfMake || {}, !0), d.deepMerge(d.libs, d.config.libs || {}, !0), d.config.drawing = d.defaults.fabric.drawing, d.config.fabric = d.defaults.fabric, d.config.pdfMake = d.defaults.pdfMake, d.config = d.deepMerge(d.defaults, d.config, !0), d.config.fabric.drawing.enabled && void 0 === d.config.fabric.drawing.menu && (d.config.fabric.drawing.menu = [], d.deepMerge(d.config.fabric.drawing.menu, [{
                        "class": "export-drawing",
                        menu: [{
                            label: d.i18l("menu.label.draw.add"),
                            menu: [{
                                label: d.i18l("menu.label.draw.shapes"),
                                action: "draw.shapes"
                            }, {
                                label: d.i18l("menu.label.draw.text"),
                                action: "text"
                            }]
                        }, {
                            label: d.i18l("menu.label.draw.change"),
                            menu: [{
                                label: d.i18l("menu.label.draw.modes"),
                                action: "draw.modes"
                            }, {
                                label: d.i18l("menu.label.draw.colors"),
                                action: "draw.colors"
                            }, {
                                label: d.i18l("menu.label.draw.widths"),
                                action: "draw.widths"
                            }, {
                                label: d.i18l("menu.label.draw.opacities"),
                                action: "draw.opacities"
                            }, "UNDO", "REDO"]
                        }, {
                            label: d.i18l("menu.label.save.image"),
                            menu: ["PNG", "JPG", "SVG", "PDF"]
                        }, "PRINT", "CANCEL"]
                    }])), void 0 === d.config.menu && (d.config.menu = [], d.deepMerge(d.config, {
                        menu: [{
                            "class": "export-main",
                            menu: [{
                                label: d.i18l("menu.label.save.image"),
                                menu: ["PNG", "JPG", "SVG", "PDF"]
                            }, {
                                label: d.i18l("menu.label.save.data"),
                                menu: ["CSV", "XLSX", "JSON"]
                            }, {
                                label: d.i18l("menu.label.draw"),
                                action: "draw",
                                menu: d.config.fabric.drawing.menu
                            }, {
                                format: "PRINT",
                                label: d.i18l("menu.label.print")
                            }]
                        }]
                    })), d.libs.path || (d.libs.path = d.config.path + "libs/"), d.setup.hasClasslist || d.libs.resources.push("classList.js/classList.min.js"), d.isSupported() && (d.loadDependencies(d.libs.resources, d.libs.reload), d.setup.chart.addClassNames = !0, d.setup.chart[d.name] = d, d.init())
                }
            };
            if (r) d.config = r;
            else if (d.setup.chart[d.name]) d.config = d.setup.chart[d.name];
            else if (d.setup.chart.amExport || d.setup.chart.exportConfig) d.config = d.migrateSetup(d.setup.chart.amExport || d.setup.chart.exportConfig);
            else return;
            return d.construct(), d.deepMerge(this, d)
        }
    }(), AmCharts.addInitHandler(function(t) {
        new AmCharts["export"](t)
    }, ["pie", "serial", "xy", "funnel", "radar", "gauge", "stock", "map", "gantt"]);