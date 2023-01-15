const $deleteButtons = document.querySelectorAll(".btn-danger");

const deleteClicked = (e) => {
 const x = confirm("Действительно удалить?");
 if (x == true) {
    const form = e.target.closest("form");    
    form.querySelector('input[name="isDelete"]').value = 1
    form.submit();
 }
 return false;
}

$deleteButtons.forEach(function (plus, idx) {
    plus.addEventListener( "click", deleteClicked );
})
