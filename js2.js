function clickBtn1(){
    var input = document.querySelector('.inp_q');
    if(input.value == 1){
        return input.value = 1;
    }else{
        return input.value = input.value - 1;
    }
  }

  function clickBtn2(){
    var input = document.querySelector('.inp_q');
        return input.value = Number(input.value) + 1;
  }