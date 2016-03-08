function validate() {

  if( document.myForm.yourname.value == "" ) {
    alert( "Please provide your name!" );
    document.myForm.yourname.focus() ;
    return false;
  }

  if( document.myForm.subject.value == "" ) {
    alert( "Please provide a subject." );
    document.myForm.subject.focus() ;
    return false;
  }

  if( document.myForm.email.value == "" ) {
    alert( "Please provide your Email!" );
    document.myForm.email.focus() ;
    return false;
  }

  var emailID = document.myForm.email.value;
  atpos = emailID.indexOf("@");
  dotpos = emailID.lastIndexOf(".");

  if (atpos < 1 || ( dotpos - atpos < 2 )) {
    alert("Please enter correct email ID")
    document.myForm.email.focus() ;
    return false;
  }

  if( document.myForm.comments.value == "" ) {
    alert( "Please provide your comments." );
    document.myForm.comments.focus() ;
    return false;
  }


  return( true );
}
