function notifySuccess(content)
{
    const toastPlacementExample = document.querySelector('.toast-ex')

    toastPlacementExample.classList.remove('bg-danger');   
    toastPlacementExample.classList.add('bg-success');   
    
    $('.toast-body').html(content)
    $('.toast-heading').html('Success')

    toastPlacement = new bootstrap.Toast(toastPlacementExample);
    toastPlacement.show();
}

function notifyWarning(content)
{
    const toastPlacementExample = document.querySelector('.toast-ex')

    toastPlacementExample.classList.remove('bg-success');   
    toastPlacementExample.classList.add('bg-danger');   
    
    $('.toast-body').html(content)
    $('.toast-heading').html('Warning')

    toastPlacement = new bootstrap.Toast(toastPlacementExample);
    toastPlacement.show();
}