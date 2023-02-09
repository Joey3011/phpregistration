// Select The Elements
var toggle_btn;
var big_wrapper;
var navLinks;
var menuOpenBtn;
var menuCloseBtn;
var navbar;
var i;

function declare() {
  toggle_btn = document.querySelector(".toggle-btn");
  bg_wrapper = document.querySelector(".bg-wrapper");
  navbar = document.querySelector(".navbar");
  navLinks = document.querySelector(".nav-links");
  menuOpenBtn = document.querySelector(".navbar .fa-bars");
  menuCloseBtn = document.querySelector(".nav-links .fa-close");
}

const main = document.querySelector("main");

declare();

let dark = false;

function toggleAnimation() {
  // Clone the wrapper
  dark = !dark;
  let clone = bg_wrapper.cloneNode(true);

  if (localStorage.getItem("dark")==='true') {
    clone.classList.remove("light");
    clone.classList.add("dark");
  } else {
    clone.classList.remove("dark");
    clone.classList.add("light");
  }
  clone.classList.add("copy");
  main.appendChild(clone);
  document.body.classList.add("stop-scrolling");

  clone.addEventListener("animationend", () => {
    document.body.classList.remove("stop-scrolling");
    bg_wrapper.remove();
    clone.classList.remove("copy");
    // Reset Variables
    declare();
   events();
  });
}

function checkStatus(){
  if(localStorage.getItem("dark")==='true'){
    localStorage.setItem("dark", 'false');
  }else{
    localStorage.setItem("dark", 'true');
}
toggleAnimation();
}



function events() { 
  toggle_btn.addEventListener("click", () => {
    checkStatus();
  });
  menuOpenBtn.addEventListener("click", () => {
    navLinks.style.left = "0";
  });
  menuCloseBtn.addEventListener("click", () => {
    navLinks.style.left = "-100%";
  });
}
window.addEventListener("load", () => {
  toggleAnimation();
});
events();



// //Make the DIV element draggagle:
// dragElement(document.getElementById("dragger"));

// function dragElement(elmnt) {
//   var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
//   if (document.getElementById(elmnt.id + "header")) {
//     /* if present, the header is where you move the DIV from:*/
//     document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
//   } else {
//     /* otherwise, move the DIV from anywhere inside the DIV:*/
//     elmnt.onmousedown = dragMouseDown;
//   }

//   function dragMouseDown(e) {
//     e = e || window.event;
//     e.preventDefault();
//     // get the mouse cursor position at startup:
//     pos3 = e.clientX;
//     pos4 = e.clientY;
//     document.onmouseup = closeDragElement;
//     // call a function whenever the cursor moves:
//     document.onmousemove = elementDrag;
//   }

//   function elementDrag(e) {
//     e = e || window.event;
//     e.preventDefault();
//     // calculate the new cursor position:
//     pos1 = pos3 - e.clientX;
//     pos2 = pos4 - e.clientY;
//     pos3 = e.clientX;
//     pos4 = e.clientY;
//     // set the element's new position:
//     elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
//     elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
//   }

//   function closeDragElement() {
//     /* stop moving when mouse button is released:*/
//     document.onmouseup = null;
//     document.onmousemove = null;
//   }
// }

