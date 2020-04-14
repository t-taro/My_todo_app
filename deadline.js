'use strict';

const deadlineDates = document.querySelectorAll('.deadline');
const currentDate = new Date();

const todayDateTime = currentDate.getTime();

currentDate.setDate(currentDate.getDate() + 1);
currentDate.setHours(0);
currentDate.setMinutes(0);
currentDate.setSeconds(0);
currentDate.setMilliseconds(0);
const tomorrowDateTime = currentDate.getTime();


deadlineDates.forEach(deadline => {  
  
  let deadlineString = deadline.textContent.split('-');
  let deadlineDateTime = new Date(deadlineString[0], deadlineString[1] - 1, deadlineString[2]).getTime();
  
  
  if (tomorrowDateTime === deadlineDateTime){
    deadline.style.color = 'blue';
  } else if (todayDateTime > deadlineDateTime){
    deadline.style.color = 'red';
  };
  
  
});