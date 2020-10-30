<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <style>
        form{
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="col-md-6 offset-md-3 col-sm-12">

            <form action="{{ route('register') }}" method="POST" class="register">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name">
                  </div>
                <div class="form-group">
                  <label for="email">E-mail</label>
                  <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                  <label for="password">Senha</label>
                  <input type="password" name="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary btn-submit">Cadastrar!</button>
            </form>
        </div>
    </div>


    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="/js/jquery.validate.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    var formValidation = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let axiosSubmit =  function(form){

            $('.btn-submit').attr('disabled', true);

            axios({
                method: form.method,
                url:    form.action,
                data:   $(form).serialize(),
                config: {header: {'Content-Type': 'multipart/form-data'}}

            }).then(function(response){

                if( response.status === 201 ) {

                    const formControls          =   document.querySelectorAll('.form-control');
                    formControls.forEach((element) => element.classList.remove('is-valid', 'is-invalid'));

                    const errorMessages         =   document.querySelectorAll('.is-invalid');
                    errorMessages.forEach((element) => element.textContent = '');
                    swal({
                        icon: "success",
                        title: "Sucesso!",
                        text: response.data.message,
                        showLoaderOnConfirm: true,
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                    }).then(async (result) => {
                        if (result) {
                            window.location = '/auth/register'
                        }
                    });
                }

            }).catch(function(error){
                $('.btn-submit').attr('disabled', false);
                if(error.request === undefined) return;
                if(error.request.status === 500)
                {
                    swal(
                        'Erro!',
                        error.response.data.message,
                        'error'
                    );
                    return;
                }

                const errors                =   error.response.data.errors;
                const firstItem             =   Object.keys(errors)[0];
                const firstItemDOM          =   document.getElementById(firstItem);
                const firstErrorMessage     =   errors[firstItem][0];

                // scroll to the error messsage
                firstItemDOM.scrollIntoView({ behavior: 'smooth' });

                // remove all error messages
                const errorMessages         =   document.querySelectorAll('.is-invalid');
                errorMessages.forEach((element) => element.textContent = '');

                // show error message
                firstItemDOM.insertAdjacentHTML('afterend', `<div class="is-invalid">${firstErrorMessage}</div>`);

                // remove all from controls with highlited errors text bos
                const formControls          =   document.querySelectorAll('.form-control');
                formControls.forEach((element) => element.classList.remove('is-invalid'));

                // highlight the form control with the error
                firstItemDOM.classList.add('is-invalid');
            });
        }

        let addUser = function(){

            $('.register').validate({
                errorClass: "is-invalid",
                validClass: "is-valid",
                errorElement: "div",
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        minlength: 8,
                        maxlength: 30,
                        required: true,
                    },
                },
                messages: {
                    name: {required: 'Nome obrigatório'},
                    email: {required: 'E-mail obrigatório'},
                    password: {
                        required: 'Senha obrigatória',
                        minlength: 'Insira pelo menos {0} caracteres',
                        maxlength: 'Tamanho maximo de {0} caracteres'
                    },
                },

                submitHandler: function (form, e) {
                    e.preventDefault();
                    axiosSubmit(form);
                }
            });
        };

        return {
            init: function() {
                addUser();
            }
        }
    }();

    $(document).ready(function(){
        formValidation.init();
    });
    </script>
</body>
</html>
