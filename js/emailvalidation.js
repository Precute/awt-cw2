$(document).ready(function(){ 

 $("#myform").validate({

  rules: {
    email: {
      required: true,
      email: true
    } 
  },

  messages: {

    email: "Please enter a valid email address"
            },
            submitHandler: submitForm
        });
 });

function submitForm (){
  form.submit();
}
