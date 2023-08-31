new Vue({
    el: '#form_users',
    data: {
        config: [],
        color: 'rgba(0, 0, 0, 0.71)',
        search: {
            'datos': null,
            'pais': null,
            'pais_text': '--- Todos los paises ---',
            'perfil': null,
            'perfil_text': '--- Todos los Perfiles ---',
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
        roles: [],
        laboratorios: [],
        laboratorios_pais: [],
        user: {
            'nombres': null,
            'codigo': '+51',
            'telefono': null,
            'email': null,
            'password': null,
            'perfil': null,
            'perfil_text': '--- Seleccione una Opción ---',
            'pais': null,
            'pais_text': '--- Seleccione una Opción ---',
            'laboratorio': null,
            'laboratorio_text': '--- Seleccione una Opción ---',
            'activo': 'S',
        },
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
            axios.post('users/datos').then(response => {
                this.paises = response.data.paises;
                this.roles = response.data.roles;
                this.laboratorios = response.data.laboratorios;

                this.listRequest = response.data.users.data;
                this.to_pagination = response.data.users.to;
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
            urlBuscar = 'users/buscar?page=' + page;
            axios.post(urlBuscar, {
                search: this.search.datos,
                pais: this.search.pais,
                perfil: this.search.perfil
            }).then(response => {
                this.listRequest = response.data.users.data;
                this.to_pagination = response.data.users.to;
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
                    this.modal.title = 'NUEVO USUARIO';
                    break;

                case 'edit':
                    this.modal.title = 'EDITAR USUARIO';
                    this.user.perfil = seleccion.rol_id;
                    this.user.perfil_text = seleccion.rol.nombre;
                    this.user.pais = seleccion.pais_id;
                    this.user.pais_text = seleccion.pais.nombre;
                    this.user.nombres = seleccion.nombres;
                    this.user.codigo = seleccion.codigo_tel;
                    this.user.telefono = seleccion.telefono;
                    this.user.activo = seleccion.activo;
                    this.user.email = seleccion.email;

                    this.findLaboratorios(seleccion.laboratorio_id);
                    setTimeout(() => {
                        this.user.laboratorio = seleccion.laboratorio_id;
                        this.user.laboratorio_text = seleccion.laboratorio.nombre;
                    }, 100);
                    break;

                case 'delete':
                    this.user.nombres = seleccion.nombres;
                    break;
                    
                default:
                    this.user.nombres = seleccion.nombres;
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

            this.user = {
                'nombres': null,
                'codigo': '+51',
                'telefono': null,
                'email': null,
                'password': null,
                'perfil': null,
                'perfil_text': '--- Seleccione una Opción ---',
                'pais': null,
                'pais_text': '--- Seleccione una Opción ---',
                'laboratorio': null,
                'laboratorio_text': '--- Seleccione una Opción ---',
                'activo': 'S',
            };
        },
        Store(form) {
            this.Load(form, 'on', 'Guardando Registro ...');

            this.errors = [];
            axios.post('users/store', {
                perfil: this.user.perfil,
                pais: this.user.pais,
                laboratorio: this.user.laboratorio,
                nombres: this.user.nombres,
                codigo: this.user.codigo,
                telefono: this.user.telefono,
                email: this.user.email,
                password: this.user.password,
            }).then(response=> {
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
            axios.post('users/update', {
                id: this.id,
                perfil: this.user.perfil,
                pais: this.user.pais,
                laboratorio: this.user.laboratorio,
                nombres: this.user.nombres,
                codigo: this.user.codigo,
                telefono: this.user.telefono,
                email: this.user.email,
                password: this.user.password,
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
            axios.post('users/delete', {
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
        Alta(form) {
            this.Load(form, 'on', 'Dando de Alta el Registro ...');

            this.errors = [];
            axios.post('users/alta', {
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
        SelectRol(data) {
            this.user.perfil = data.id;
            this.user.perfil_text = data.nombre;
        },
        SelectPais(data) {
            this.user.laboratorio = null;
            this.user.laboratorio_text = '--- Seleccione una Opción ---';

            this.user.pais = data.id;
            this.user.pais_text = data.nombre;

            this.findLaboratorios(data.id);
        },
        findLaboratorios(id) {
            this.laboratorios_pais = (this.laboratorios).filter(item => {
                return item.pais_id == id;
            });
        },
        SelectLab(data) {
            this.user.laboratorio = data.id;
            this.user.laboratorio_text = data.nombre;
        },
        SelectSearchPerfil(data) {
            this.search.perfil = null;
            this.search.perfil_text = '--- Todos los Países ---';

            if (data) {
                this.search.perfil = data.id;
                this.search.perfil_text = data.nombre;
            }
            this.Buscar(this.page);
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
        Fecha(date) {
            if (date) {
                let fecha = date.split('-');
                return fecha[2]+'-'+fecha[1]+'-'+fecha[0];
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