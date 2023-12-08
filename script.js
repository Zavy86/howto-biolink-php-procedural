window.addEventListener('DOMContentLoaded',function(){
  document.querySelectorAll('.removeLink').forEach(function(el){
    el.addEventListener('click',function(){removeLink(el)});
  })
});

function removeLink(el) {
  let div = el.parentNode;
  div.parentNode.removeChild(div);
}

function addLink() {
  let newLink = document.getElementById('linkTemplate').cloneNode(true);
  newLink.classList.remove('hidden');
  newLink.id = '';
  newLink.querySelector('.removeLink').addEventListener('click',function(){removeLink(this)});
  document.getElementById('links').appendChild(newLink);
}
