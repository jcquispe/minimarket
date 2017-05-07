
$(document).ready(function(){
   $("select").select2({width: '100%'});
   $(".partida").select2({width: '150px'});
   $(".producto").select2({width: '200px'});
   $("#inventario").select2('destroy');
   //$("#inventarioe").select2('destroy');
});

// Main Module
var Anb = (function (anb, $) {

    var tmpl_alert = $('#tmpl-alert').html();
    var tmpl_print = $('#tmpl-print').html();
    var $alert_modal = $("#alert-modal");
    var nano = function (template, data) {
        return template.replace(/\{([\w\.]*)\}/g, function (str, key) {
            var keys = key.split("."), v = data[keys.shift()];
            for (var i = 0, l = keys.length;i < l;i++)
                v = v[keys[i]];
            return (typeof v !== "undefined" && v !== null) ? v : "";
        });
    }

    var isIE = function () {
        if (navigator.appName == 'Microsoft Internet Explorer') {
            var re = new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");
            if (re.exec(navigator.userAgent) != null) {
                return parseFloat( RegExp.$1 );
            }
        }
        return -1;
    }
    
    anb.types = ['text', 'textarea', 'file', 'password',  'email', 'search', 'number'];
    anb.$alert_modal = $alert_modal;
    anb.nano = nano;
    anb.ie = isIE();
    
    anb.toType = function (obj) {
        return ({}).toString.call(obj).match(/\s([a-zA-Z]+)/)[1].toLowerCase();
    }
    
    anb.isJson = function (text) {
        return /^[\],:{}\s]*$/.test(text.replace(/\\["\\\/bfnrtu]/g, '@').
               replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
               replace(/(?:^|:|,)(?:\s*\[)+/g, ''));
    }
    
    anb.alert = function (message, callback_ok, title) {
        $alert_modal.html(nano(tmpl_alert, {
            title : title || 'Alerta', 
            message : message, 
            button_cancel : 'hide'
        })).modal();
        if (callback_ok) {
            $alert_modal.find('.modal-footer .btn-primary').on('click', callback_ok);
        }
    }

    anb.confirm = function (message, callback_ok, callback_cancel, title, label_ok, label_cancel) {
        $alert_modal.html(nano(tmpl_alert, {
            title : title || 'Confirmar', 
            message : message, 
            button_cancel : ''
        })).modal();

        var $btn_ok = $alert_modal.find('.modal-footer .btn-primary'),
            $btn_cancel = $alert_modal.find('.modal-footer .btn-default');

        $btn_ok.children('span').html(label_ok || 'Aceptar');
        $btn_cancel.children('span').html(label_cancel || 'Cancelar');
        if (callback_ok) {
            $btn_ok.on('click', callback_ok);
        }
        if (callback_cancel) {
            $btn_cancel.on('click', callback_cancel);
        }
    }

    anb.question = function (message, callback_yes, callback_no, title) {
        Anb.confirm(message, callback_yes, callback_no, title || 'Pregunta', 'Si', 'No');
    }
    
    anb.getParams = function (p, args) {
        var first = p.first.defaultValue,
            second = p.second.defaultValue;
            
        p.first.position = p.first.position || 0;
        p.second.position = p.second.position || 1;
        
        var type = Anb.toType(args[p.first.position]);
        if (type != 'undefined') {          
            if (type == p.first.type) {
                first = args[p.first.position];
                second = Anb.toType(args[p.second.position]) == p.second.type ? args[p.second.position] : p.second.defaultValue;
            } else {
                if (type == p.second.type) {
                    first = Anb.toType(args[p.second.position]) == p.first.type ? args[p.second.position] : p.first.defaultValue;
                    second = args[p.first.position];
                }
            }
        }
        return {
            first : first,
            second : second
        };
    }

    
    
    anb.fullscreen = function () {
        if (!document.fullscreenElement &&    // alternative standard method
        !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }
    }

    return anb;
}(Anb || {}, jQuery));

// Loading
Anb.loading = (function () {

    var $container = $('#loading-ajax');

    var loading = {};

    loading.$container = $container;
    
    loading.show = function (text) {
        $container.html('<i class="fa fa-cog fa-spin"></i>' + (text || 'Cargando...')).css({
            marginLeft : '-' + $container.outerWidth() / 2 + 'px'
        }).fadeIn(200);
    }

    loading.hide = function () {
        $container.fadeOut(200);
    }

    return loading;

}());



Anb.load = (function () {

    function init() {
        var $buttonCollapse = $('.toggle-menu');
        var $asideActive = $('#sidebar .active').parent().parent();
        var $leftPanel = $('#sidebar');
        var mobile = $(window).width() < 768;

        render('body');

        if($asideActive.hasClass('has-submenu')) {
            $asideActive.addClass('active');
        }
        
        $buttonCollapse.on('click', function() {
            $leftPanel.toggleClass('collapsed');
            var collapse = $leftPanel.hasClass('collapsed');
            $('header, footer').toggleClass('collapsed');
            if (!mobile) {
                $('.has-submenu.active > ul')[collapse ? 'hide' : 'show']();
                localStorage.setItem('anb-navbar', collapse ? 'yes' : 'no');
            } else {
                $('.has-submenu.active > ul').show();
            }
            if (collapse) {
                $('.has-submenu .list-unstyled').hide();
            }
        });

        if (!mobile && localStorage.getItem('anb-navbar') == 'yes') {
            $leftPanel.addClass('collapsed');
            $('header, footer').addClass('collapsed');
        }
        
        $leftPanel.find(".navigation > ul > li:has(ul) > a").on('click', function() {
            
            if( $leftPanel.hasClass('collapsed') == false || $(window).width() < 768 ) {
                $leftPanel.find(".navigation > ul > li > ul").slideUp(300);
                $leftPanel.find(".navigation > ul > li").removeClass('active');
            
                if(!$(this).next().is(":visible")) {
                    $(this).next().slideToggle(300);
                    $(this).closest('li').addClass('active');
                }
            
                return false;
            }   
        });

        $leftPanel.find(".navigation li ul").each(function () {
            var $this = $(this);
            if ($this.find('li').length == 0) {
                $this.remove();
            }
        });
        
        var $document = $(document),
            $container = $('#container'),
            $btnBanner = $('#btn-banner'),
            $btnFS = $('#btn-fullscreen'),
            $btnScroll = $('#btn-scroll-top');
            
        $btnFS.on('click', function (e) {
            e.preventDefault();
            Anb.fullscreen();
            $btnFS.toggleClass('active');
            $btnFS.tooltip('destroy').prop('title', $btnFS.hasClass('active') ? 'Salir pantalla completa' : 'Pantalla completa');
            setTimeout(function () {$btnFS.tooltip()}, 300);
        });
        
        var exitFullScreen = function () {
            $btnFS.removeClass('active');
            $btnFS.tooltip('destroy').prop('title', 'Pantalla completa');
            setTimeout(function () {$btnFS.tooltip()}, 300);
        }

        $document.on('scroll', function () {
            $btnScroll[$document.scrollTop() > 200 ? 'fadeIn' : 'fadeOut']();
        });
        
        $btnScroll.on('click', function(e) {
            e.preventDefault();
            $("html, body").animate({ scrollTop: 0 }, 800);
        });
        
        $document.on('keyup', function(e) {
            if (e.keyCode == 27) {
                exitFullScreen();
            }
        });
        
        document.addEventListener("mozfullscreenchange", function () {
            if (!document.mozFullScreen) {
                exitFullScreen();
            }
        }, false);
                
        if (localStorage.getItem('anb-banner') == 'yes' || localStorage.getItem('anb-banner') == null) {
            $btnBanner.addClass('active');
        } else {
            $btnBanner.tooltip('destroy').prop('title', 'Mostrar banner');
            setTimeout(function () {$btnBanner.tooltip()}, 300);
            $container.addClass('logo-off');
            $('#anb-messages').css({top: 50})
        }
        
        $btnBanner.on('click', function (e) {
            e.preventDefault();
            var active = $btnBanner.hasClass('active');
            $container.toggleClass('logo-off');
            $btnBanner.toggleClass('active');
            $btnBanner.tooltip('destroy').prop('title', active ? 'Mostrar banner' : 'Ocultar banner');
            setTimeout(function () {$btnBanner.tooltip()}, 300);
            localStorage.setItem('anb-banner', active ? 'no' : 'yes');
            $('#anb-messages').css({top: active ? 125 : 50});
        });

        if (Anb.ie > 0 && Anb.ie < 10) {
            alert("Usted tiene la versión " + Anb.ie + " de Internet Explorer, el sistema no es compatible con esta versión, por favor use Chrome o Firefox, o una versión mayor o igual a Internet Explorer 10.");
            throw new Error('Navegador no soportado');
        }
    }

    var render = function (container) {
        $(container + ' .required').each(function () {
            var $el = $(this),
                $label = $el.prev('label');
            if ($label.length == 0) {
                $label = $el.parent().prev('label');
            }
            $label.addClass('label-required');
        });
        
        
        $('.number-format').each(function () {
            this.innerHTML = this.innerHTML.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        });

        if ($.fn.tooltip) {
            $(container + ' [data-toggle="tooltip"]').tooltip();
        }
        if ($.fn.popover) {
            $(container + ' [data-toggle="popover"]').popover();
        }
    }

    init(); // begin load

    var load = {};

    load.render = render;

    return load;

}());