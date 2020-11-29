
var $input    = document.getElementById('user_picture'),
    $fileName = document.getElementById('user_picture--name');

$fileName.textContent = 'jkhkdsh';

$input.addEventListener('change', function(){
  $fileName.textContent = this.value;
});