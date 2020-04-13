'use strict';

const completeBtns = document.querySelectorAll('.completeCheck');
completeBtns.forEach(btn => {
  btn.addEventListener('click', (e)=>{
    let title = btn.parentNode.children[1].textContent;
    
    // postするデータを作成
    let postData = new FormData();
    postData.append('title', title);
    
    if (btn.classList.contains('notComplete')){
      postData.append('state', 0);
    }else{
      postData.append('state', 1);
    };
    
    const xhr = new XMLHttpRequest();
    
    // post後の処理
    // dbが更新された後にUIが変わる
    xhr.addEventListener("load",function(e){
      if (this.readyState === 4) {
        if (this.status === 200){
          if (btn.classList.contains('notComplete')){
              btn.classList.remove('notComplete');
              btn.classList.add('completed');
              btn.textContent = 'Completed';
              
              console.log(this.response);
              
            } else {
              
              btn.classList.remove('completed');
              btn.classList.add('notComplete');
              btn.textContent = 'Not complete';
              
              console.log(this.response);
          };
          
          
          
        }else {
          console.log(xhr.statusText);
        }
      }
    });
    
    xhr.open('POST', '/status_update_ajax.php');
    
    xhr.send(postData);
  });
});