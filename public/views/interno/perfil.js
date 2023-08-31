new Vue({
    el: '#form_perfil',
    data: {
        errors: [],

        perfil: {
            'nombres': my_perfil.nombres,
            'telefono': my_perfil.telefono,
            'email': my_perfil.email,
            'password': null,
        },
    },
    methods: {
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
        Store(form) {
            this.errors = [];
            axios.post('perfil/store', {
                nombres: this.perfil.nombres,
                telefono: this.perfil.telefono,
                email: this.perfil.email,
                password: this.perfil.password,
            }).then(response=> {
                this.buttonKey++;

                let action = response.data.action;
                let title = response.data.title;
                let message = response.data.message;
                this.Alert2(action, title, message);
            }).catch(error => {
                console.log(error)

                let action = 'error';
                let title = 'Ops error !!';
                let message = 'No se pudo conectar con el servidor, por favor actualice la página.';
                this.Alert2(action, title, message);
            });
        },
    }
});