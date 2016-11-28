(function() {
    var imagesList = [];
    Dropzone.options.imageDropzone = {
        url : '/dropzone/store',
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,
        acceptedFiles: ".jpg, .png",
        init: function () {
            var submitButton = document.querySelector("#submit-all");
            var wrapperThis = this;

            submitButton.addEventListener("click", function () {
                // event.preventDefault();
                // wrapperThis.processQueue();
            });

            this.on("addedfile", function (file) {
                // Create the remove button
                var removeButton = Dropzone.createElement("<button class='btn btn-xs btn-link'>Remove</button>");

                // Listen to the click event
                removeButton.addEventListener("click", function (e) {
                    // Make sure the button click doesn't submit the form:
                    e.preventDefault();
                    e.stopPropagation();

                    // Remove the file preview.
                    wrapperThis.removeFile(file);
                    // If you want to the delete the file on the server as well,
                    // you can do the AJAX request here.
                });

                // Add the button to the file preview element.
                file.previewElement.appendChild(removeButton);
            });

            this.on('successmultiple', function(file, response) {
                imagesList.push(response.images);
            });
        }
    };
    var formSubmit = $('#apartment-adding-form');
    formSubmit.on('submit', function(event){
        event.preventDefault();
        var apartmentRaw = {};
        var a = formSubmit.serializeArray();
        $.each(a, function() {
            if (apartmentRaw[this.name]) {
                if (!apartmentRaw[this.name].push) {
                    apartmentRaw[this.name] = [apartmentRaw[this.name]];
                }
                apartmentRaw[this.name].push(this.value || '');
            } else {
                apartmentRaw[this.name] = this.value || '';
            }
        });
        if(imagesList.length > 0){
            apartmentRaw.images = JSON.stringify(imagesList[0]);
        }
        var $createApartment = $.post($(this).attr('action'), apartmentRaw);
        $createApartment.then(function (response) {
            console.log(response);
        });

    });
})();