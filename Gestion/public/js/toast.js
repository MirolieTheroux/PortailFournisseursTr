'use strict';

// let toast = document.querySelector(".toast");
// let closeIcon = document.querySelector(".close");
// let progress = document.querySelector(".progress");

// let timer1, timer2;

// button.addEventListener("click", () => {
//   toast.classList.add("active");
//   progress.classList.add("active");

//   timer1 = setTimeout(() => {
//     toast.classList.remove("active");
//   }, 5000); //1s = 1000 milliseconds

//   timer2 = setTimeout(() => {
//     progress.classList.remove("active");
//   }, 5300);
// });

// closeIcon.addEventListener("click", () => {
//   toast.classList.remove("active");

//   setTimeout(() => {
//     progress.classList.remove("active");
//   }, 300);

//   clearTimeout(timer1);
//   clearTimeout(timer2);
// });



let toast = document.querySelector(".toast");
let progress = document.querySelector(".progress");

let timer;
let timer2;


toast.classList.add("active");
progress.classList.add("active");


timer = setTimeout(() => {
  toast.classList.remove("active");
  progress.classList.remove("active");
}, 3000); 

timer2 = setTimeout(() => {
  toast.classList.add("d-none");
}, 3360); 
