
$('.js-delete').click(function() {
    var res = confirm('Точно удалить?');
    if (!res) return false;
});

$('.del-item').on('click', function(){
    var res = confirm('Подтвердите действие');
    if(!res) return false;
    var $this = $(this),
        id = $this.data('id'),
        src = $this.data('src');
    $.ajax({
        url: adminpath + '/product/delete-gallery',
        data: {id: id, src: src},
        type: 'POST',
        beforeSend: function(){
            $this.closest('.file-upload').find('.overlay').css({'display':'block'});
        },
        success: function(res){
            setTimeout(function(){
                $this.closest('.file-upload').find('.overlay').css({'display':'none'});
                if(res == 1){
                    $this.fadeOut();
                }
            }, 1000);
        },
        error: function(){
            setTimeout(function(){
                $this.closest('.file-upload').find('.overlay').css({'display':'none'});
                alert('Ошибка');
            }, 1000);
        }
    });
});

$('.sidebar-menu a').each(function() {
    var loc = window.location;
    var adminLocation = loc.protocol + '//' + loc.host + loc.pathname;
    var link = this.href;
    if (link == adminLocation) {
        $(this).parent().addClass('active');
        $(this).closest('.treeview').addClass('active');
    }
});

$('textarea#editor1').ckeditor();

$('#reset-filter').click(function(e) {
    e.preventDefault();
    $('#filter input[type=radio]').prop('checked', false);
});

$(".select2").select2({
    placeholder: "Начните вводить наименование товара",
    //minimumInputLength: 2,
    cache: true,
    ajax: {
        url: adminpath + "/product/related-product",
        delay: 250,
        dataType: 'json',
        data: function (params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function (data, params) {
            return {
                results: data.items,
            };
        },
    },
});

//
// Images upload
//


if ($('div').is('#single')) {
    var buttonSingle = $("#single"),
        file;
}

if (buttonSingle) {
    new AjaxUpload(buttonSingle, {
        action: adminpath + buttonSingle.data('url') + "?upload=1",
        data: {name: buttonSingle.data('name')},
        name: buttonSingle.data('name'),
        onSubmit: function(file, ext) {
            if (! (ext && /^(jpg|png|jpeg|gif)$/i.test(ext))){
                alert('Ошибка! Разрешены только картинки');
                return false;
            }
            buttonSingle.closest('.file-upload').find('.overlay').css({'display':'block'});
        },
        onComplete: function(file, response){
            console.log(response);
            setTimeout(function() {
                buttonSingle.closest('.file-upload').find('.overlay').css({'display':'none'});

                response = JSON.parse(response);
                $('.' + buttonSingle.data('name')).html('<img src="/uploads/' + response.file + '" style="max-height: 150px;">');
            }, 1000);
        }
    });
}
// END. images upload

$('#add').on('submit', function(){
    if(!isNumeric( $('#category_id').val() )){
        alert('Выберите категорию');
        return false;
    }
});

function isNumeric(n) {
   return !isNaN(parseFloat(n)) && isFinite(n);
}
