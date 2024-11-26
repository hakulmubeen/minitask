function viewFile(url, type, title) {
    $('#viewFileModal').modal('show');
    if (type == 'image') {
        $('.modal-title').html(title);
        $('.viewFile-modal').html('<img class="img-fluid mx-auto w-100 d-block" src="' + url + '" alt="Image">');
    } else if (type == 'pdf') {
        $('.modal-title').html(title);
        $('.viewFile-modal').html('<iframe class="mx-auto w-100" src="' + url + '" style="width: 100%; height: 80vh;"></iframe>');
    }
}

// viewFile
$(document).on('click','.view-file',function(){
    let file = $(this).attr('data-file');
    let type = $(this).attr('data-type');
    let title = $(this).attr('data-title');
    viewFile(file,type,title);
})