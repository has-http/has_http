const outer = document.querySelector('.banner');
const innerList = document.querySelector('.inner-list');
const inners = document.querySelectorAll('.inner-banner');
const circles = document.querySelectorAll('.circle');
let currentIndex = 0; // 현재 슬라이드 화면 인덱스

inners.forEach((inner) => {
    inner.style.width = `${outer.clientWidth}px`; 
    // inner의 width를 모두 outer의 width로 만들기
  })
  
innerList.style.width = `${outer.clientWidth * inners.length}px`; 
  // innerList의 width를 inner의 width * inner의 개수로 만들기


function setIndex(initial_index, final_index){
  inners.forEach((inner) => {
    inner.style.width = `${outer.clientWidth}px`; 
    // inner의 width를 모두 outer의 width로 만들기
    })
    
  innerList.style.width = `${outer.clientWidth * inners.length}px`; 
  // innerList의 width를 inner의 width * inner의 개수로 만들기

  let circle = document.querySelector(`.circle${initial_index}`);
    circle.classList.remove("showing_circle");


    circle = document.querySelector(`.circle${final_index}`);
    circle.classList.add("showing_circle");

    

    innerList.style.marginLeft = `-${outer.clientWidth * final_index}px`;

}

const getInterval = () => {
return setInterval(() => {
  const lastIndex = currentIndex;
  currentIndex++;
  currentIndex = currentIndex >= inners.length ? 0 : currentIndex;
  setIndex(lastIndex, currentIndex);
    
}, 4000);
}
  
function setBtnIndex(index){
  setIndex(currentIndex, index);
  currentIndex = index;
  clearInterval(interval);
  interval = getInterval();
}

for (var j=0; j < circles.length; j++){
  (function(m){
    document.querySelector('.circle' + j).addEventListener("click", function(){
      setBtnIndex(m)
  });
  })(j);
}

let interval = getInterval(); 
