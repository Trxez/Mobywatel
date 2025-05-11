console.log('rozwijka.js');
const lo = document.querySelector('#lo');
const content = document.querySelector('#rogo');
const arrow = document.querySelector('#rotation');

var contentinner = content.innerHTML;
content.innerHTML = '';

lo.addEventListener('click', function () {
    if (lo.style.borderRadius == "12px 12px 0px 0px") {
        lo.style = "border-radius: 12px;";
        content.innerHTML = '';
        arrow.style = "transform: rotate(0deg);";
    }
    else {
        lo.style = "border-radius: 12px 12px 0 0;";
        content.innerHTML = contentinner;
        arrow.style = "transform: rotate(-90deg);";
    }
});