import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

    const dropzone = new Dropzone('#dropzone', {
        dictDefaultMessage: "Sube aqui tu imagen",
        acceptedFiles: ".png, .jpg, .jpeg, .gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        maxFiles: 1,
        uploadMultiple: false,

        init: function(){
            // alert("dropzone creado");
            if(document.querySelector('[name="imagen"]').value.trim()){
                const imagenPublicada = {};
                //tiene que tener un tamaño size
                imagenPublicada.size = 1234;
                //tiene que tener un nombre
                imagenPublicada.name = document.querySelector('[name="imagen"]').value;

                //call manda a llamar
                this.options.addedfile.call(this,imagenPublicada);
                this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`);
                // this.options.thumbnail.call(this, imagenPublicada, /uploads/${imagenPublicada.name});

                imagenPublicada.previewElement.classList.add("dz-success","dz-complete");
            }
        },
    });

    // dropzone.on('sending', function (file, xhr, formData) {
    //     console.log(formData);
    // });

    dropzone.on('success', function (file, response) {
        // console.log(response.imagen)
        document.querySelector('[name="imagen"]').value = response.imagen;
    })

    // dropzone.on('error', function (file, message) {
    //     console.log(message)
    // })

    dropzone.on('removedfile', function () {
        document.querySelector('[name="imagen"]').value = "";
    })

