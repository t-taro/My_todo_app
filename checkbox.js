'use strict';

const checkboxes = document.querySelectorAll('.checkbox');

checkboxes.forEach(checkbox =>{
  if(checkbox.getAttribute('value') == 1){
    checkbox.setAttribute('checked', ''); 
  }else{
    checkbox.removeAttribute('checked', ''); 
  };
  
  const clickCheckboxSubmit= () => {
    checkbox.parentNode.lastElementChild.click();
  }
  
  checkbox.addEventListener('click', ()=>{
    if(checkbox.getAttribute('value') == 0){
      checkbox.setAttribute('value', 1);
      clickCheckboxSubmit();    
    }else{
      checkbox.setAttribute('value', 0);
      clickCheckboxSubmit(); 
    };
  })
})