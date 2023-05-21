new Vue({
    el: '#form_config',
    data: {
        config: [],
        buttonKey: 1,
        color: 'rgba(0, 0, 0, 0.71)',
        imagen: null,
        imagen_login: null,
        form: [],
        errors: []
    },
    created() {
        this.Buscar();
        $(".my_vue").show();
    },
    methods: {
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
        Buscar(page) {
            urlBuscar = 'config/buscar?page=' + page;
            axios.post(urlBuscar, {

            }).then(response => {
                this.form = response.data.config;
                if (this.form.logo) {
                    this.imagen = "storage/" + this.form.logo;
                }
                if (this.form.logo_login) {
                    this.imagen_login = "storage/" + this.form.logo_login;
                }
            }).catch(error => {
                console.log(error)

                let action = 'error';
                let title = 'Error !!';
                let message = 'No se pudo conectar con el servidor, por favor actualice la página.';
                this.Alert2(action, title, message);
            });
        },
        Update(form) {
            this.errors = [];

            formdata = new FormData();
            formdata.append('nombre', this.form.nombre);
            formdata.append('descripcion', this.form.descripcion);
            formdata.append('direccion', this.form.direccion);
            formdata.append('telefono_1', this.form.telefono_1);
            formdata.append('telefono_2', this.form.telefono_2);
            formdata.append('whatsapp', this.form.whatsapp);
            formdata.append('email', this.form.email);
            formdata.append('facebook', this.form.facebook);
            formdata.append('twitter', this.form.twitter);
            formdata.append('instagram', this.form.instagram);
            formdata.append('youtube', this.form.youtube);
            formdata.append('dominio', this.form.dominio);
            formdata.append('logo', this.form.logo);
            formdata.append('logo_login', this.form.logo_login);

            axios.post('config/update', formdata).then(response=> {
                $("#logo").val('');
                $("#logo_login").val('');
                let action = response.data.action;
                let title = response.data.title;
                let message = response.data.message;
                this.Alert2(action, title, message)
                this.buttonKey++;
            }).catch(error => {
                console.log(error)
                this.buttonKey++;
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
        Imagen() {
            this.errors = [];
            let file = event.target.files[0];

            if (file.type === 'image/png' || file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/webp') {
                this.form.logo = file;
                var reader = new FileReader();
                 
                let self = this;
                reader.onload = (function(theFile) {
                    return function(e) {
                        self.imagen = e.target.result;
                    };
                })(file);
         
                reader.readAsDataURL(file);
            } else {
                $('#logo').val('');
                this.form.logo = null;
                this.imagen = null

                this.errors['logo'] = ['El archivo seleccionado no es imagen.'];
            }
        },
        ImagenDark() {
            this.errors = [];
            let file = event.target.files[0];

            if (file.type === 'image/png' || file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/webp') {
                this.form.logo_login = file;
                var reader2 = new FileReader();
                 
                let self = this;
                reader2.onload = (function(theFile) {
                    return function(e) {
                        self.imagen_login = e.target.result;
                    };
                })(file);
         
                reader2.readAsDataURL(file);
            } else {
                $('#logo_login').val('');
                this.form.logo_login = null;
                this.imagen = null

                this.errors['logo_login'] = ['El archivo seleccionado no es imagen.'];
            }
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