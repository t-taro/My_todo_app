'use strict';

const searchBtn = document.getElementById('openSearch');
const searchArea = document.getElementById('searchArea');
const searchAreaClose = document.getElementById('searchAreaClose');

searchBtn.addEventListener('click', ()=>{
  searchArea.classList.add('open');
})

searchAreaClose.addEventListener('click', ()=>{
  searchArea.classList.remove('open');
})



