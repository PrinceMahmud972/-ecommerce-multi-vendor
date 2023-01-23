$(document).ready(() => {
    $('#formImage').change(function() {
        const image = this.files[0];
        if(image) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#previewImage').attr('src', event.target.result);
            }
            reader.readAsDataURL(image);
        }
    });

    // initiate data-table
    $('#data-table').DataTable();
});