const modalContainer = document.querySelector(".modal-container");
const modalTriggers = document.querySelectorAll(".modal-trigger");

modalTriggers.forEach(trigger => trigger.addEventListener("click", toggleModal))

function toggleModal(){
  modalContainer.classList.toggle("active")
}

filterContenu("all");

function filterContenu(c){
  var x, i;
  x =document.getElementsByClassName("box")
  if (c == "all") c="";
  for (i =0; i < x.length; i++) {
    removeClass(x[i], "show")
    if(x[i].className.indexOf(c) > -1) addClass(x[i], "show")
  }
}

function addClass(element, name){
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++){
    if (arr1.indexOf(arr2[i]) == -1){
      element.className += " " + arr2[i];
    }
  }
}

function removeClass(element, name){
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i= 0; i < arr2.length; i++){
    while(arr1.indexOf(arr2[i]) > -1){
      arr1.splice(arr1.indexOf(arr2[i]), 1)
    }
  }
  element.className = arr1.join(" ");
}


/// Modal localstorage

let nomInput = document.querySelector('#nom');
if (nomInput) {

  if (typeof (localStorage.getItem('nom')) != "null") {
    nomInput.value = localStorage.getItem('nom');
  }

  document.getElementById('email', 'nom', 'prenom');
  nomInput.addEventListener('keyup', function () {
    localStorage.setItem('nom', nomInput.value);
  });

  let emailInput = document.querySelector('#email');

  if (typeof (localStorage.getItem('email')) != "null") {
    emailInput.value = localStorage.getItem('email');
  }

  document.getElementById('email', 'nom', 'prenom');
  emailInput.addEventListener('keyup', function () {
    localStorage.setItem('email', emailInput.value);
  });

  let prenomInput = document.querySelector('#prenom');

  if (typeof (localStorage.getItem('prenom')) != "null") {
    prenomInput.value = localStorage.getItem('prenom');
  }

  document.getElementById('prenom', 'nom', 'prenom');
  prenomInput.addEventListener('keyup', function () {
    localStorage.setItem('prenom', prenomInput.value);
  });
} 

if (typeof boosts == "object") {
  const reduction = 25.99 / 30.99;
  let totalCost = 30.99;

  for (let i = 0; i < boosts.length; i++) {
    const cost = boosts[i];
    const boost = document.getElementById('boost-' + (i + 1));
    boost.addEventListener('change', (event) => {
      if (event.currentTarget.checked) {
        totalCost += cost;
      } else {
        totalCost -= cost;
      }

      document.getElementById("prix1").innerHTML = Math.ceil(totalCost) - 0.01 + '€';
      document.getElementById("prix2").innerHTML = Math.ceil(totalCost * reduction) - 0.01 + '€';
    });
  }
}

function postArticle() {
  document.getElementById("article-content").value = tinymce.get("article-content").getContent();
  document.getElementById("article-submit").click();
}
