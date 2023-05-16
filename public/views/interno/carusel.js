new Vue({
    el: '#form_carusel',
    data: {
        config: [],
        buttonKey: 1,
        color: 'rgba(0, 0, 0, 0.71)',
        search: {
            'datos': null
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
        },
        id: null,
        seleccion: [],
        errors: [],

        carusel: {
            'titulo': null,
            'resaltar': null,
            'descripcion': null,
            'boton': null,
            'link': null,
            'imagen': null,
            'mostrar': 'S',
        },
        img: null
    },
    created() {
        this.Buscar();
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
                        timer: 3000
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
            urlBuscar = 'carusel/buscar?page=' + page;
            axios.post(urlBuscar, {
                search: this.search.datos
            }).then(response => {
                this.listRequest = response.data.caruseles.data;
                this.to_pagination = response.data.caruseles.to;
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
                    break;

                case 'edit':
                    this.carusel.titulo = seleccion.titulo;
                    this.carusel.resaltar = seleccion.resaltar ? seleccion.resaltar : null;
                    this.carusel.descripcion = seleccion.descripcion;
                    if (seleccion.boton) {
                        this.carusel.boton = seleccion.boton;
                        this.carusel.link = seleccion.link;
                    }
                    this.carusel.mostrar = seleccion.mostrar;
                    this.img = 'storage/'+seleccion.imagen;
                    break;

                case 'delete':
                    this.carusel.titulo = seleccion.titulo;
                    break;
                    
                default:
                    this.carusel.titulo = seleccion.titulo;
                    break;
            }
            setTimeout(() => {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }, 1000);
        },
        CloseModal() {
            $("#formularioModal").modal('hide');
            this.color = 'rgba(0, 0, 0, 0.71)';
            this.modal = {
                'size': null,
                'method': null,
                'loading': null,
            };
            this.id = null;
            this.seleccion = [];
            this.errors = [];

            this.carusel = {
                'titulo': null,
                'resaltar': null,
                'descripcion': null,
                'boton': null,
                'link': null,
                'imagen': null,
                'mostrar': 'S',
            };
            this.img = null;
        },
        Store(form) {
            this.errors = [];

            formdata = new FormData();
            formdata.append('titulo', this.carusel.titulo);
            formdata.append('resaltar', this.carusel.resaltar);
            formdata.append('descripcion', this.carusel.descripcion);
            formdata.append('boton', this.carusel.boton);
            formdata.append('link', this.carusel.link);
            formdata.append('imagen', this.carusel.imagen);
            formdata.append('mostrar', this.carusel.mostrar);

            axios.post('carusel/store', formdata).then(response=> {
                console.log(response.data)
                this.buttonKey++;

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
        Update(form) {
            this.errors = [];

            formdata = new FormData();
            formdata.append('id', this.id);
            formdata.append('titulo', this.carusel.titulo);
            formdata.append('resaltar', this.carusel.resaltar);
            formdata.append('descripcion', this.carusel.descripcion);
            formdata.append('boton', this.carusel.boton);
            formdata.append('link', this.carusel.link);
            formdata.append('imagen', this.carusel.imagen);
            formdata.append('mostrar', this.carusel.mostrar);

            axios.post('carusel/update', formdata).then(response=> {
                this.buttonKey++;

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
        Delete(form) {
            this.errors = [];
            axios.post('carusel/delete', {
                id: this.id,
            }).then(response=> {
                this.buttonKey++;

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
                this.buttonKey++;

                let action = 'error';
                let title = 'Ops error !!';
                let message = 'No se pudo conectar con el servidor, por favor actualice la página.';
                this.Alert2(action, title, message);
            });
        },
        Imagen() {
            this.errors = [];
            let file = event.target.files[0];

            if (file.type === 'image/png' || file.type === 'image/jpeg' || file.type === 'image/jpg' || file.type === 'image/webp') {
                this.carusel.imagen = file;
                var reader = new FileReader();
                 
                let self = this;
                reader.onload = (function(theFile) {
                    return function(e) {
                        self.img = e.target.result;
                    };
                })(file);
         
                reader.readAsDataURL(file);
            } else {
                $('#imagen').val('');
                this.carusel.imagen = null;
                this.img = null

                this.errors['imagen'] = ['El archivo seleccionado no es imagen.'];
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