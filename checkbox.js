'use strict';

const checkboxes = document.querySelectorAll('.checkbox');

checkboxes.forEach(checkbox =>{
  if(checkbox.getAttribute('value') == 1){
    checkbox.setAttribute('checked', ''); 
  }else{
    checkbox.removeAttribute('checked', ''); 
  };
  
  checkbox.addEventListener('click', ()=>{
    if(checkbox.getAttribute('value') == 0){
      checkbox.setAttribute('value', 1); 
      // checkbox.setAttribute('checked', ''); 
      
    }else{
      checkbox.setAttribute('value', 0); 
      // checkbox.removeAttribute('checked', ''); 
    };
    console.log(checkbox.getAttribute('value'));
    
    function clickCheckboxSubmit(){
      checkbox.parentNode.lastElementChild.click();
      console.log("submit is clicked!");
    }
    
    setTimeout(clickCheckboxSubmit, 10);
  })
})