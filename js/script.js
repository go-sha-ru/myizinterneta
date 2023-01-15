const $pluses = document.querySelectorAll(".plus");
const plusClicked = (e) => {
    e.stopPropagation();
    e.target.innerText = (e.target.innerText === "+") ? "|" : "+";
    e.target.parentNode.querySelector("ul").classList.toggle("show");
}
$pluses.forEach(function (plus, idx) {
    plus.addEventListener( "click", plusClicked );
})

const $titles = document.querySelectorAll(".title");
const $descriptions = document.querySelectorAll(".description");
const hideDescAll = () => {
    $descriptions.forEach(function (desc, idx) {
        desc.classList.remove("show");
    })
}


const titleClicked = (e) => {
    hideDescAll();
    const id = "desc_" + e.target.id;
    document.getElementById(id).classList.add("show");
}

$titles.forEach(function (title, idx) {
    title.addEventListener( "click", titleClicked );
})
