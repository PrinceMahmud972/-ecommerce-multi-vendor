/*!
    * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2022 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
// document.getElementById('formImage').addEventListener("change", function () {
//     const image = this.files[0];
//     if(image) {
//         let reader = new FileReader();
//         reader.onload = function(event) {
//             document.getElementById('previewImage').src = event.target.result;
//         }
//         reader.readAsDataURL(image);
//     }
// });

// $('#formImage').change(function() {
//     const image = this.files[0];
//     if(image) {
//         let reader = new FileReader();
//         reader.onload = function(event) {
//             $('#previewImage').attr('src', event.target.result);
//         }
//         reader.readAsDataURL(image);
//     }
// });

function imagePreview(formImage, previewImage) {
    const image = $(formImage).prop('files')[0];
    if(image) {
        let reader = new FileReader();
        reader.onload = function(event) {
            $(previewImage).attr('src', event.target.result);
        }
        reader.readAsDataURL(image);
    }
}


const shopName = $('#inputShopName');
shopName.on('input', function() {
    let shopSlug = $('#inputShopSlug');
    let slug = convertToSlug(shopName.val());
    shopSlug.val(slug);
    if(slug){
        $.ajax({
            type:"GET",
            url: "/vendor/myShop/verifySlug?slug=" + slug,
            dataType: "json",
            success: function(data) {
                if(data.success) {
                    shopSlug.removeClass('border-danger');
                    shopSlug.addClass('border-success');
                    $('#slugError').empty();
                } else {
                    shopSlug.removeClass('border-success');
                    shopSlug.addClass('border-danger');
                    $('#slugError').text('The slug already Exists');
                }
            }
        });
    }
    if(slug == "") {
        shopSlug.removeClass('border-success');
        shopSlug.removeClass('border-danger');
    }
});


function convertToSlug(Text) {
    return Text.toLowerCase()
               .replace(/[^\w ]+/g, '')
               .replace(/ +/g, '-');
}

function checkSlugExists(inputTitle, inputSlug, id=null) {
    const title = $('#'+inputTitle);
    
    let slug = $('#'+inputSlug);
    let convertedSlug = convertToSlug(title.val());
    slug.val(convertedSlug);
    if(convertedSlug){
        $.ajax({
            type:"GET",
            url: "/vendor/product/verifySlug?slug=" + convertedSlug + (id != null ? ('&id='+id) : ''),
            dataType: "json",
            success: function(data) {
                if(data.success) {
                    slug.removeClass('border-danger');
                    slug.addClass('border-success');
                    $('#slugError').empty();
                } else {
                    slug.removeClass('border-success');
                    slug.addClass('border-danger');
                    $('#slugError').text('The slug already Exists');
                }
            }
        });
    }
    if(convertedSlug == "") {
        slug.removeClass('border-success');
        slug.removeClass('border-danger');
    }
}

function getCategories() {
    sectionId = $('#inputSection').val();

    if(sectionId) {
        $.ajax({
            type: "GET",
            url: '/vendor/category/getCategoryAjax/'+sectionId,
            dataType: 'json',
            success: function(data) {
                categorySelect = $('#inputCategory');
                if(data.length) {
                    categorySelect.empty();
                    $.each(data, function(key, val) {
                        categorySelect.append('<option value="'+val.id+'">'+val.title+'</option>');
                    });
                    categorySelect.removeAttr('disabled');
                } else {
                    categorySelect.empty();
                    categorySelect.attr('disabled', true);
                }
            }
        });
    }
}