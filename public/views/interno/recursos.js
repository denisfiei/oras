new Vue({
    el: '#form_recursos',
    data: {
        config: [],
        color: 'rgba(0, 0, 0, 0.71)',
        search: {
            'datos': null,
            'pais': null,
            'pais_text': '--- Todos los paises ---',
            'nivel': null,
            'nivel_text': '--- Todos los niveles ---',
        },
        page: 1,

        listRequest: [],
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0,
        },
        to_pagination: 0,

        modal: {
            'size': null,
            'method': null,
            'loading': null,
            'title': null,
        },
        id: null,
        seleccion: [],
        errors: [],

        paises: [],
        centros: [],
        recurso: {
            'pais': null,
            'pais_text': '--- Seleccione una opción ---',
            'centro': null,
            'centro_text': '--- Seleccione una opción ---',
            'titulo': null,
            'descripcion': null,
            'fecha': null,
            'ruta': null,
            'imagen': null,
            'enlace': null,
            'orden': 1,
            'nivel': 0,
            'nivel_text': 'BANNER INICIO',
        },
        imagen_recurso: null,
        niveles: [
            {'id': '1', 'text': 'INICIO: BANNER INICIO'}, 
            {'id': '2', 'text': 'INICIO: PRESENTACIÓN'}, 
            {'id': '4', 'text': 'VIGILANCIA: BANNER'}, 
            {'id': '5', 'text': 'VIGILANCIA: INTRODUCCIÓN'},
            {'id': '6', 'text': 'RED: BANNER'}, 
            {'id': '7', 'text': 'RED: INTRODUCCIÓN'},
            {'id': '9', 'text': 'SECUENCIACIÓN: BANNER'}, 
            {'id': '10', 'text': 'SECUENCIACIÓN: MAPA PAIS'}, 
            {'id': '11', 'text': 'SECUENCIACIÓN: LOGO INSTITUTO'}, 
            {'id': '12', 'text': 'SECUENCIACIÓN: VIDEO'}, 
            {'id': '13', 'text': 'SECUENCIACIÓN: TEMAS DE INTERES'}, 
            {'id': '8', 'text': 'DISTRIBUCIÓN: BANNER'}, 
            {'id': '10', 'text': 'DISTRIBUCIÓN: MAPA PAIS'}, 
            {'id': '11', 'text': 'DISTRIBUCIÓN: LOGO INSTITUTO'}, 
            {'id': '12', 'text': 'DISTRIBUCIÓN: VIDEO'}, 
            {'id': '13', 'text': 'DISTRIBUCIÓN: TEMAS DE INTERES'}, 
            {'id': '20', 'text': 'RECURSO: CENTRO DE INFORMACIÓN'},
        ],
    },
    created() {
        this.Datos();
        $(".my_vue").show();
    },
    methods: {
        changePage(page) {
            this.page = page;
            this.pagination.current_page = page;
            this.Buscar(page);
        },
        Load(id, show, text) {
            if (show == 'on') {
                return $(".a_load").show();
            }
            return $(".a_load").hide();
        },
        Alert(action, title, message) {
            // switch (action) {
            //     case 'success':
            //         toastr.success(message, title, {
            //             positionClass: "toast-top-right",
            //             timeOut: 5e3,
            //             closeButton: !0,
            //             debug: !1,
            //             newestOnTop: !0,
            //             progressBar: !1,
            //             preventDuplicates: !0,
            //             onclick: null,
            //             showDuration: "300",
            //             hideDuration: "500",
            //             extendedTimeOut: "1000",
            //             showEasing: "swing",
            //             hideEasing: "linear",
            //             showMethod: "fadeIn",
            //             hideMethod: "fadeOut",
            //             tapToDismiss: !1
            //         });
            //         break;

            //     case 'error':
            //         toastr.error(message, title, {
            //             positionClass: "toast-top-right",
            //             timeOut: 5e3,
            //             closeButton: !0,
            //             debug: !1,
            //             newestOnTop: !0,
            //             progressBar: !1,
            //             preventDuplicates: !0,
            //             onclick: null,
            //             showDuration: "300",
            //             hideDuration: "1000",
            //             extendedTimeOut: "1000",
            //             showEasing: "swing",
            //             hideEasing: "linear",
            //             showMethod: "fadeIn",
            //             hideMethod: "fadeOut",
            //             tapToDismiss: !1
            //         });
            //         break;
            
            //     default:
            //         toastr.warning(message, title, {
            //             positionClass: "toast-top-right",
            //             timeOut: 5e3,
            //             closeButton: !0,
            //             debug: !1,
            //             newestOnTop: !0,
            //             progressBar: !1,
            //             preventDuplicates: !0,
            //             onclick: null,
            //             showDuration: "300",
            //             hideDuration: "1000",
            //             extendedTimeOut: "1000",
            //             showEasing: "swing",
            //             hideEasing: "linear",
            //             showMethod: "fadeIn",
            //             hideMethod: "fadeOut",
            //             tapToDismiss: !1
            //         });
            //         break;
            // }
        },
        Alert2(action, titulo, texto) {
            switch (action) {
                case 'success':
                    Swal.fire({
                        title: titulo,
                        text: texto,
                        icon: 'success',
                        showConfirmButton: false,
                        customClass: {
                            confirmButton: 'btn btn-success'
                        },
                        timer: 2000
                    });
                break;
                case 'error': 
                    Swal.fire({
                        title: titulo,
                        text: texto,
                        icon: 'error',
                        showConfirmButton: true,
                        customClass: {
                            confirmButton: 'btn btn-danger'
                        }
                    });
                break;
            }
        },
        Datos() {
            axios.post('recursos/datos').then(response => {
                this.paises = response.data.paises;
                this.centros = response.data.centros;

                this.listRequest = response.data.recursos.data;
                this.to_pagination = response.data.recursos.to;
                this.pagination = response.data.pagination;
            }).catch(error => {
                console.log(error);
                let action = 'error';
                let title = 'Error !!';
                let message = 'No se pudo conectar con el servidor, por favor actualice la página.';
                this.Alert2(action, title, message);
            });
        },
        Buscar(page) {
            urlBuscar = 'recursos/buscar?page=' + page;
            axios.post(urlBuscar, {
                search: this.search.datos,
                pais: this.search.pais,
                nivel: this.search.nivel
            }).then(response => {
                this.listRequest = response.data.recursos.data;
                this.to_pagination = response.data.recursos.to;
                this.pagination = response.data.pagination;
            }).catch(error => {
                console.log(error)

                let action = 'error';
                let title = 'Error !!';
                let message = 'No se pudo conectar con el servidor, por favor actualice la página.';
                this.Alert2(action, title, message);
            });
        },
        Modal(size, metodo, id, seleccion) {
            $("#formularioModal").modal('show');
            this.modal.size = size;
            this.modal.method = metodo;
            this.id = id;
            this.color = 'rgba(236, 120, 0, 0.98)'

            switch (metodo) {                
                case 'create':
                    this.modal.title = 'NUEVO RECURSO';
                    break;

                case 'edit':
                    this.modal.title = 'EDITAR RECURSO';
                    if (seleccion.nivel >= 20) {
                        this.recurso.pais = seleccion.pais_id;
                        this.recurso.pais_text = seleccion.pais.nombre;
                        this.recurso.centro = seleccion.centro_id;
                        this.recurso.centro_text = seleccion.centro.nombre;
                    }
                    this.recurso.titulo = seleccion.titulo;
                    if (seleccion.descripcion) {
                        this.recurso.descripcion = seleccion.descripcion;
                    }
                    this.recurso.fecha = seleccion.fecha;
                    this.recurso.enlace = seleccion.enlace;
                    this.recurso.orden = seleccion.orden;
                    this.recurso.nivel = seleccion.nivel;
                    this.recurso.nivel_text = this.FindNivel(seleccion.nivel);
                    this.imagen_recurso = 'storage/'+seleccion.ruta+'/'+seleccion.imagen;
                    break;

                case 'delete':
                    this.modal.title = 'ELIMINAR RECURSO';
                    this.recurso.titulo = seleccion.titulo;
                    break;
                    
                default:
                    this.recurso.titulo = seleccion.titulo;
                    break;
            }
        },
        CloseModal() {
            $("#formularioModal").modal('hide');
            this.color = 'rgba(0, 0, 0, 0.71)';
            this.modal = {
                'size': null,
                'method': null,
                'loading': null,
                'title': null,
            };
            this.id = null;
            this.seleccion = [];
            this.errors = [];

            this.recurso = {
                'pais': null,
                'pais_text': '--- Seleccione una opción ---',
                'centro': null,
                'centro_text': '--- Seleccione una opción ---',
                'titulo': null,
                'descripcion': null,
                'fecha': null,
                'ruta': null,
                'imagen': null,
                'enlace': null,
                'orden': 1,
                'nivel': 0,
                'nivel_text': 'BANNER INICIO'
            };
            this.imagen_recurso = null;
            $("#imagen").val('');
        },
        Store(form) {
            this.Load(form, 'on', 'Guardando Registro ...');
            this.errors = [];

            formdata = new FormData();
            formdata.append('pais', this.recurso.pais);
            formdata.append('centro', this.recurso.centro);
            formdata.append('titulo', this.recurso.titulo);
            formdata.append('descripcion', this.recurso.descripcion);
            formdata.append('fecha', this.recurso.fecha);
            formdata.append('orden', this.recurso.orden);
            formdata.append('nivel', this.recurso.nivel);
            formdata.append('imagen', this.recurso.imagen);
            formdata.append('enlace', this.recurso.enlace);

            axios.post('recursos/store', formdata).then(response=> {
                this.Load(form, 'off', null);

                let action = response.data.action;
                let title = response.data.title;
                let message = response.data.message;
                this.Alert2(action, title, message)

                if (action == 'success') {
                    $('#formularioModal').modal('hide');
                    this.CloseModal();
                    this.Buscar(this.page);
                }
            }).catch(error => {
                console.log(error)
                this.Load(form, 'off', null);
                this.imagen_recurso = null;
                $("#imagen").val('');

                if (error.response.status == 422) {
                    this.errors = error.response.data.errors;
                } else {
                    let action = 'error';
                    let title = 'Ops error !!';
                    let message = 'No se pudo conectar con el servidor, por favor actualice la página.';

                    this.Alert2(action, title, message);
                }
            });
        },
        Update(form) {
            this.Load(form, 'on', 'Actualizando Registro ...');
            this.errors = [];

            formdata = new FormData();
            formdata.append('id', this.id);
            formdata.append('pais', this.recurso.pais);
            formdata.append('centro', this.recurso.centro);
            formdata.append('titulo', this.recurso.titulo);
            formdata.append('descripcion', this.recurso.descripcion);
            formdata.append('fecha', this.recurso.fecha);
            formdata.append('orden', this.recurso.orden);
            formdata.append('nivel', this.recurso.nivel);
            formdata.append('imagen', this.recurso.imagen);
            formdata.append('enlace', this.recurso.enlace);

            axios.post('recursos/update', formdata).then(response=> {
                this.Load(form, 'off', null);

                let action = response.data.action;
                let title = response.data.title;
                let message = response.data.message;
                this.Alert2(action, title, message);

                if (action == 'success') {
                    $('#formularioModal').modal('hide');
                    this.CloseModal();
                    this.Buscar(this.page);
                }
            }).catch(error => {
                console.log(error)
                this.Load(form, 'off', null);
                this.imagen_recurso = null;
                $("#imagen").val('');

                if (error.response.status == 422) {
                    this.errors = error.response.data.errors;
                } else {
                    let action = 'error';
                    let title = 'Ops error !!';
                    let message = 'No se pudo conectar con el servidor, por favor actualice la página.';

                    this.Alert2(action, title, message);
                }
            });
        },
        Delete(form) {
            this.Load(form, 'on', 'Eliminando Registro ...');

            this.errors = [];
            axios.post('recursos/delete', {
                id: this.id,
            }).then(response=> {
                this.Load(form, 'off', null);

                let action = response.data.action;
                let title = response.data.title;
                let message = response.data.message;
                this.Alert2(action, title, message);

                if (action == 'success') {
                    $('#formularioModal').modal('hide');
                    this.CloseModal();
                    this.Buscar(this.page);
                }
            }).catch(error => {
                console.log(error)
                this.Load(form, 'off', null);

                let action = 'error';
                let title = 'Ops error !!';
                let message = 'No se pudo conectar con el servidor, por favor actualice la página.';

                this.Alert2(action, title, message);
            });
        },
        SelectSearchPais(data) {
            this.search.pais = null;
            this.search.pais_text = '--- Todos los Países ---';

            if (data) {
                this.search.pais = data.id;
                this.search.pais_text = data.nombre;
            }
            this.Buscar(this.page);
        },
        SelectSearchNivel(data) {
            this.search.nivel = null;
            this.search.nivel_text = '--- Todos los niveles ---';
            
            if (data) {
                this.search.nivel = data.id;
                this.search.nivel_text = data.text;
            }
            this.Buscar(this.page);
        },
        SelectNivel(data) {
            this.recurso.nivel = data.id;
            this.recurso.nivel_text = data.text;
        },
        FindNivel(id) {
            let idx = this.niveles.findIndex((nivel) => nivel.id == id);
            return this.niveles[idx]['text'];
        },
        SelectPais(data) {
            this.recurso.pais = data.id;
            this.recurso.pais_text = data.nombre;
        },
        SelectCentro(data) {
            this.recurso.centro = data.id;
            this.recurso.centro_text = data.nombre;
        },
        Imagen() {
            this.errors = [];
            let file = event.target.files[0];

            if (file.type === 'image/png' || file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/webp') {
                this.recurso.imagen= file;
                var reader2 = new FileReader();
                 
                let self = this;
                reader2.onload = (function(theFile) {
                    return function(e) {
                        self.imagen_recurso = e.target.result;
                    };
                })(file);
         
                reader2.readAsDataURL(file);
            } else {
                $('#imagen').val('');
                this.recurso.imagen= null;
                this.imagen_recurso = null;

                this.errors['imagen'] = ['El archivo seleccionado no es imagen.'];
            }
        },
        Fecha(date) {
            if (date) {
                let fecha = date.split('-');
                return fecha[2]+'/'+fecha[1]+'/'+fecha[0];
            }
            return '';
        },
        FechaHora(doc) {
            let date = new Date(doc);
            let day = this.zeroFill(date.getDate(), 2);
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
            let hour = date.getHours();
            let min = this.zeroFill(date.getMinutes(), 2);

            hour = this.zeroFill(hour, 2);

            if (month < 10) {
                return (`${day}/0${month}/${year} ${hour}:${min}`)
            } else {
                return (`${day}/${month}/${year} ${hour}:${min}`)
            }
        },
        zeroFill(number, width) {
            width -= number.toString().length;
            if (width > 0) {
                return new Array(width + (/\./.test(number) ? 2 : 1)).join('0') + number;
            }
            return number + "";
        },
    }
});