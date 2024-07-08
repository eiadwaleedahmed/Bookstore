let scrollContainer = document.querySelector(".bookTypes");
let btn1 = document.getElementById("btn1");
let btn2 = document.getElementById("btn2");
scrollContainer.addEventListener("wheel",(evt)=>{
    evt.preventDefault();
    scrollContainer.scrollLeft += evt.deltaY;
});
btn2.addEventListener("click",()=>{
    scrollContainer.style.scrollBehavior ="smooth";
    scrollContainer.scrollLeft += 900;
});
btn1.addEventListener("click",()=>{
    scrollContainer.style.scrollBehavior ="smooth";
    scrollContainer.scrollRight -= 900;
});