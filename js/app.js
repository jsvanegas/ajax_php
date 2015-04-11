//es un objeto global que sirve para hacer peticiones ajax y buscar objetos
var app = _ = {
 
 	//Estados de la petición AJAX
    READY_STATE_UNINITIALIZED: 0,
    READY_STATE_LOADING: 1,
    READY_STATE_LOADED: 2,
    READY_STATE_INTERACTIVE: 3,
    READY_STATE_COMPLETE: 4,
	
	//método que busca una etiqueta de HMTL, por su id
	findById: function(element) {
        return document.getElementById(element);
    },
	
	//método que busca varias etiquetas HTML, que cumplan con la clase especificada
    findByClass: function(element) {
        return document.getElementsByClassName(element);
    },
	
	//Busca todas las etiquetas de un mismo nombre
    findByTag: function(element) {
        return document.getElementsByTagName(element);
    },
	
	//se encarga de enviar una petición al servidor
    ajax: function(args) {
		//se construye el objeto XMLHTTP para enviar peticiones en cualquier navegador
        var _http = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		
		//se ejecuta esta función, cada vez que cmabia el estado de petición READY_STATE
        _http.onreadystatechange = function() {
			//si el estado es 4
            if (_http.readyState === _.READY_STATE_COMPLETE) {
				
                switch (_http.status) {
                    case 200:
                        _.fade('loader', false);						
                        var resp = JSON.parse(_http.response);
                        if (resp.codigoRespuesta < 0) {
                            _.onError(resp);
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
    },
	
	onError:function(resp){
		/*
		var notificacion = _.findById('notificacion');	
		notificacion.innerText = resp.mensaje;
		notificacion.style.display = 'block';	
		*/
		console.error(resp);
	},
	
	
	detenerEvento:function(e){
		if(e.preventDefault){
			e.preventDefault();
		}else if(e.stopPropagation){
			e.stopPropagation();
		}else {
			e.returnValue = false;	
		}
	}
	
	
	
};