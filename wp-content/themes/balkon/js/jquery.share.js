/**

 * jQuery.share - social media sharing plugin

 * ---

 * @author Carol Skelly (http://in1.com)

 * @version 1.3.1

 * @license MIT license (http://opensource.org/licenses/mit-license.php)

 * ---

 */

! function(t, e) {

    var s = e.document;

    t.fn.share = function(i) {

        var r = {

                init: function(i) {

                    this.share.settings = t.extend({}, this.share.defaults, i);

                    var r = (this.share.settings, this.share.settings.networks),

                        o = this.share.settings.theme,

                        a = this.share.settings.orientation,

                        u = this.share.settings.affix,

                        h = this.share.settings.margin,

                        l = this.share.settings.title || t(s).attr("title"),

                        c = this.share.settings.urlToShare || t(location).attr("href"),

                        p = "";

                    return t.each(t(s).find('meta[name="description"]'), function(e, s) {

                        p = t(s).attr("content")

                    }), this.each(function() {

                        var s, i = t(this),

                            m = i.attr("id"),

                            d = encodeURIComponent(c),

                            f = l.replace("|", ""),

                            g = p.substring(0, 250);

                        r.forEach(function(e) {

                        	if(typeof n.networkDefs[e] != 'undefined'){
                                s = n.networkDefs[e].url, s = s.replace("|u|", d).replace("|t|", f).replace("|d|", g).replace("|140|", f.substring(0, 130)), t("<a href='" + s + "' title='Share this page on " + e + "' class='pop share-" + o + " share-" + o + "-" + e + "'></a>").appendTo(i)
                            }

                        }), t("#" + m + ".share-" + o).css("margin", h), "horizontal" != a ? t("#" + m + " a.share-" + o).css("display", "block") : t("#" + m + " a.share-" + o).css("display", "inline-block"), "undefined" != typeof u && (i.addClass("share-affix"), -1 != u.indexOf("right") ? (i.css("left", "auto"), i.css("right", "0px"), -1 != u.indexOf("center") && i.css("top", "40%")) : -1 != u.indexOf("left center") && i.css("top", "40%"), -1 != u.indexOf("bottom") && (i.css("bottom", "0px"), i.css("top", "auto"), -1 != u.indexOf("center") && i.css("left", "40%"))), t(".pop").click(function() {

                            return e.open(t(this).attr("href"), "t", "toolbar=0,resizable=1,status=0,width=640,height=528"), !1

                        })

                    })

                }

            },

            n = {

                networkDefs: {

                	youtube: {

                        url: "http://youtube.com/"

                    },

                    instagram: {

                        url: "https://instagram.com/"

                    },


                    facebook: {

                        url: "http://www.facebook.com/share.php?u=|u|"

                    },

                    twitter: {

                        url: "https://twitter.com/share?text=|140|"

                    },

                    linkedin: {

                        url: "http://www.linkedin.com/shareArticle?mini=true&url=|u|&title=|t|&summary=|d|"

                    },

                    in1: {

                        url: "http://www.in1.com/cast?u=|u|",

                        w: "490",

                        h: "529"

                    },

                    tumblr: {

                        url: "http://www.tumblr.com/share?v=3&u=|u|"

                    },

                    digg: {

                        url: "http://digg.com/submit?url=|u|&title=|t|"

                    },

                    googleplus: {

                        url: "https://plusone.google.com/_/+1/confirm?hl=en&url=|u|"

                    },

                    reddit: {

                        url: "http://reddit.com/submit?url=|u|"

                    },

                    pinterest: {

                        url: "http://pinterest.com/pin/create/button/?url=|u|&media=&description=|d|"

                    },

                    posterous: {

                        url: "http://posterous.com/share?linkto=|u|&title=|t|"

                    },

                    stumbleupon: {

                        url: "http://www.stumbleupon.com/submit?url=|u|&title=|t|"

                    },

                    email: {

                        url: "mailto:?subject=|t|"

                    },

                    vk: {

                        url: "http://vk.com/share.php?url=|u|&title=|t|&description=|d|"

                    },

                }

            };

        return r[i] ? r[i].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof i && i ? void t.error('Method "' + i + '" does not exist in social plugin') : r.init.apply(this, arguments)

    }, t.fn.share.defaults = {

        networks: ["in1", "facebook", "twitter", "linkedin"],

        theme: "icon",

        autoShow: !0,

        margin: "3px",

        orientation: "horizontal",

        useIn1: !0

    }, t.fn.share.settings = {}

}(jQuery, window);
