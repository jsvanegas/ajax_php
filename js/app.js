var app = _ = {
    READY_STATE_UNINITIALIZED: 0,
    READY_STATE_LOADING: 1,
    READY_STATE_LOADED: 2,
    READY_STATE_INTERACTIVE: 3,
    READY_STATE_COMPLETE: 4,
    findById: function(element) {
        return document.getElementById(element);
    },
    findByClass: function(element) {
        return document.getElementsByClassName(element);
    },
    findByTag: function(element) {
        return document.getElementsByTagName(element);
    },
    ajax: function(args) {
        var _http = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

        _http.onreadystatechange = function() {
            if (_http.readyState === _.READY_STATE_COMPLETE) {
                switch (_http.status) {
                    case 200:
                        console.log(_http);
                        _.fade('loader', false);
                        var resp = JSON.parse(_http.response);
                        if (resp.cod < 0) {
                            _.onError(_http);
                        } else {
                            args.success(resp);
                        }

                        break;
                    case 404:
                        console.error(_http.response);
                        break;
                }

            } else {
                var loader = _.findById('loader');
                loader.innerText = 'Cargando';
                _.fade('loader', true);
            }
        }
        _http.open(args.method, args.url, true);
        _http.send(  );
    },
    fade: function(element, show) {
        if (show) {
            _.findById(element).classList.remove('hide');
        } else {
            _.findById(element).classList.add('hide');
        }
    }
};